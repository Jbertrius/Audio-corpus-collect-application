<?php
session_start();
// Include and instantiate the class.
require_once 'id_generate.php';
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;

// Any mobile device (phones or tablets).
if ( $detect->isMobile() ) {
     $platform = "Mobile";
}elseif( $detect->isTablet() ){
    $platform = "Tablette";
}else 
	 $platform = "Desktop"; 

// Generer date

setlocale(LC_TIME, 'fra_fra');
$date = strftime('%A %d %B %Y'); 

// Instance de la class DomDocument
$doc = new DOMDocument();
 
 $doc->formatOutput = true;
// Definition du prologue :  la version et l'encodage
$doc->version = '1.0';
$doc->encoding = 'UTF-8';
 
 
// Ajout la balise 'metadata' a la racine
$metadata = $doc->createElement('AppliWeb');
$doc->appendChild($metadata);
 
// Creation des elements "balise"
$md_env = $doc->createElement('Environnement',$_GET['env']);
$md_age = $doc->createElement('Age', $_GET['age']);
$md_sexe = $doc->createElement('Sexe', $_GET['sexe']);
$md_region = $doc->createElement('Region', $_GET['region']);
$md_prof = $doc->createElement('Profession', $_GET['prof']);
$md_plat = $doc->createElement('Plateforme', $platform );
$md_date = $doc->createElement('Date', $date );
 
//Specifier que les elements sont dans 'metadata'
$metadata->appendChild($md_env);
$metadata->appendChild($md_age);
$metadata->appendChild($md_prof);
$metadata->appendChild($md_region);
$metadata->appendChild($md_sexe);
$metadata->appendChild($md_plat);
$metadata->appendChild($md_date);
 
// Sauvegarder le document XML
$id = unique_id(11);
$_SESSION['id'] = $id; 
mkdir("../recordings/".$id."", 0755);
$nomxml = $id.'_'.$_GET['sexe'];
$doc->save('../recordings/'.$id.'/'.$nomxml.'.xml');
 
 //Redirection

if ( $detect->isMobile() ) {
     header('location: ../vue/index2.php');
}elseif( $detect->isTablet() ){
  header('location: ../vue/index2.php');
}else 
	 header('location: ../vue/index2.php');
?>