<?php
$a = session_id();
if(empty($a)) session_start();
 

function unique_id($numStr)
{
	srand( (double)microtime()*rand(1000000,9999999) ); // Genere un nombre aléatoire
	$arrChar = array(); // Nouveau tableau

	for( $i=65; $i<90; $i++ ) {
		array_push( $arrChar, chr($i) ); // Ajoute A-Z au tableau
		array_push( $arrChar, strtolower( chr( $i ) ) ); // Ajouter a-z au tableau
	}

	for( $i=48; $i<57; $i++ ) {
		array_push( $arrChar, chr( $i ) ); // Ajoute 0-9 au tableau
	}

	for( $i=0; $i< $numStr; $i++ ) {
		$uId .= $arrChar[rand( 0, count( $arrChar ) )]; // Ecrit un aléatoire
	}
	return $uId;
}
