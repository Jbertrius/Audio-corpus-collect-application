 <?php
session_start();
$_SESSION['id'] = ""; 
?>
<!doctype html>
<!--[if lt IE 7]> <html class="ie6 oldie"> <![endif]-->
<!--[if IE 7]>    <html class="ie7 oldie"> <![endif]-->
<!--[if IE 8]>    <html class="ie8 oldie"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Acceuil</title>

  <link rel="stylesheet" href="Styles/boilerplate.css">

<link href="Styles/index.css" rel="stylesheet" type="text/css">
<!-- 
To learn more about the conditional comments around the html tags at the top of the file:
paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/

<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<script src="Scripts/respond.min.js"></script>
<script src="Scripts/modernizr.js"></script>
<!-- Webforms2 -->
<script src="Scripts/webforms2/webforms2-p.js"></script>
<!-- jQuery  -->
<script src="Scripts/jquery-1.4.3.min.js"></script>
<script src="Scripts/jquery-ui-1.8.5.min.js"></script>
<script>
function controlvide() {
var isChecked=false;
for (i=0; i<document.getElementsByTagName("input").length; i++)
	if (document.getElementsByTagName("input")[i].name=="sexe")
		if (document.getElementsByTagName("input")[i].checked)
			isChecked=true;
if (!isChecked)
{
alert('Vous devez specifier votre sexe !');
return false;
}
}
</script>


<script>var __adobewebfontsappname__="dreamweaver"</script><script src="https://use.edgefonts.net/abel:n4:default.js" type="text/javascript"></script>
</head>

<body>
<div class="gridContainer clearfix">
  <div  class="fluid " align="center">
	<header>
    	<h1 id="header">
        <br>
     	<center>Application de Collecte de corpus audio</center>
		</h1>
        <div id = "desc" > <br>
        Cette application Web/mobile permet la collecte de corpus de parole pour des fins de recherche scientifique en Reconnaissance Automatique de la Parole (RAP).<br><br>
        
        </div>
  	</header>
    <br>
  <main class="container" >
  <form id="signup" method="get" action="controleur/regxml.php" onsubmit="return controlvide();">
    
      
  
  	<h1 id="env">
     	<center>Informations à Remplir</center>
	</h1>	
  
    
    <div class="sep" ></div>
    
    <fieldset  class="inputs " id="form">
    
    <p align="center"><label for="env">Environnement</label>
		<br><select name="env" size="1" id="env"><OPTION selected>Calme<OPTION>Bruyant</select></p>
        
    <p align="center"><label for="age">Age</label>
		<br><input  id="age" type="number" name="age" id="numeric" value="" required></p>
        
    <p align="center"><label>Sexe</label>
    
    <table align="center">
      <tr>
        <td><label for="sexe">
          <input type="radio" name="sexe" value="Homme" id="sexe_0">
          Homme</label></td>
        <td><label for="sexe">
          <input type="radio" name="sexe" value="Femme" id="sexe_1">
          Femme</label></td>
      </tr>
    </table></p>


     <p align="center"><label for="prof">Profession</label>
		<br><select  id="prof" name="prof" size="1">
               <OPTION>Hotellerie, Restauration
               <OPTION>Transport, Logistique
               <OPTION>Agriculture, Pêche, Elevage
               <OPTION>Commerce, Vente
               <OPTION>Banque, Assurance
               <OPTION>Arts, Spectacle
               <OPTION>Communication, Media
               <OPTION>Construction, Batiments, Travaux publics
               <OPTION>Ingenieurie
               <OPTION>Medecine
               <OPTION>Technicien
               <OPTION selected>Etudiant
               <OPTION>Enseignement
               <OPTION>Retraité
              <OPTION>Femme au foyer
               <OPTION>Autres..
       	  </select></p>
    
    <p align="center"><label for="region">Région d'origine</label>
		<br><select  id="region" name="region" size="1">
               <OPTION>Tanger-Tétouan- Al Hoceima
               <OPTION>Oriental
               <OPTION>Fès-Meknès
               <OPTION>Rabat-Salé-Zemmour-Zair
               <OPTION>Béni Mellal-Khénifra
               <OPTION>Casablanca-Settat
               <OPTION>Marrakech-Safi
               <OPTION>Drâa-Tafilalet
               <OPTION>Sous-Massa
               <OPTION>Guelmim-Oued Noun
              <OPTION selected>Laâyoune
               <OPTION>Ed Dakhla
       	  </select></p>
    
    <p align="center"><input type="submit" name = "Submitbut" value="Soumettre formulaire" id="Submitbut"></p>
    </fieldset>
  </form>

  </main>
  <footer>
 
  </footer>
  
  </div>
</div>
</body>
</html>
