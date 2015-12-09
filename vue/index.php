<?php
session_start();
?>
<!doctype html>

<html class="">
<!--<![endif]-->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Tâche</title>
<link href="../Styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../Styles/work.css" rel="stylesheet" type="text/css">


<?php

include_once('../modele/connexion_sql.php');
include_once('../modele/get_prompts.php');

$prompts = get_prompt(0, 10);

foreach($prompts as $cle => $prompt)
{
$prompts[$cle]['Id'] = htmlspecialchars($prompt['Id']);
$prompts[$cle]['phrase'] =
nl2br(htmlspecialchars($prompt['phrase']));
}
// On affiche la page (vue)
?>

<script src="../Scripts/respond.min.js"></script>
<script type="text/javascript"
	src="../Scripts/swfobject.js"></script>

<!-- Setup the recorder interface -->
<script type="text/javascript" src="../Scripts/WamiScript/recorder.js"></script>

<script type="text/javascript" src="../Scripts/WamiScript/gui.js"></script>
		<?php
		 if(isset($_GET['next']))
		{$cle = (int)$_GET['next'];
		
		$phrase = $prompts[$cle]['phrase'];
		
		$cle++;} 
		else
		 {$phrase = $prompts[0]['phrase']; 
		 $cle=1;}?>
<script>


        function setupRecorder() {

            Wami.setup({
                id: "wami",
                onReady: setupGUI
            });
        }

        function setupGUI() {
			 Wami.setSettings({ sampleRate: 22050 });
            var gui = new Wami.GUI({
                id: "wami",
                recordUrl: "../recordings/save_file.php?name=<?php echo $_SESSION['id']; ?>_prompt_<?php echo $phrase;?>.wav",
                playUrl: "../recordings/<?php echo $_SESSION['id']; ?>/<?php echo $_SESSION['id']; ?>_prompt_<?php echo $phrase;?>.wav"
            });

            gui.setPlayEnabled(false);
        }

</script>
   <script type="text/javascript">
                <!--
                        function open_infos()
                        {
                                width = 400;
                                height = 400;
                                if(window.innerWidth)
                                {
                                        var left = (window.innerWidth-width)/2;
                                        var top = (window.innerHeight-height)/2;
                                }
                                else
                                {
                                        var left = (document.body.clientWidth-width)/2;
                                        var top = (document.body.clientHeight-height)/2;
                                }
                                window.open('Aide.html','Aide','menubar=no, scrollbars=yes, top='+top+', left='+left+', width='+width+', height='+height+'');
                        }
                -->
                </script>

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.--><script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/abel:n4:default.js" type="text/javascript"></script>
</head>
<body onload="setupRecorder()">
    <div class="gridContainer clearfix">
      
      <header class="fluid header">
      	<h1 class="fluid titre" align="center">
       	Tâche à effectuer 
        </h1>
        
      </header>
      
      <div  align="center" id = "workspace" class="fluid main">
      	
	<h1 id="env">
     	<center>Veuillez répetez 3 fois de suite, pendant l'enregistrement chaque chiffre affiché, en FRANÇAIS ou en DARIJA (Exemple: un..un..un)</center>
        <div  id="help" align="center"> <a href="#" onclick="javascript:open_infos();">
        <img src="../Media/help.png" alt="" style="margin-top: -3px"/>Aide</a></div>
	</h1>
	<div class="sep"></div>
    
		<h3>
		<?php 
		if(isset($_GET['next']))
		{
	     $cle = (int)$_GET['next'];
		echo $prompts[$cle]['Id'] ;
		 $cle++;} 
		else
		{echo $prompts[0]['Id'];
		$cle=1;}
		?>
        / <?php echo count($prompts) ?>
		</h3>
        
        <div id="prompt">
		<p>
		<?php echo $phrase;?>
		<br>
		</p>
        </div>
        
        <!--<div   class="buttons"  id="suiv" align="center">
             <a  href="
			 <?php 
			 if($cle < count($prompts))
			 echo 'index.php?next='.$cle; 
			 else 
			 echo '../vue/Final.html'
			 ?>">
         <img src="../Media/fleche.png" alt=""/>
            Suivant
             </a>   
        </div>
        
       <!-- <div class="fluid buttons" >
        
     <button type="button" class="positive">
        <img src="" alt=""/> 
        Enregistrer
    </button> 
    
       <button  type="button" class="positive">
        <img src="" alt=""/> 
        Ecouter
    </button> 
        </div> -->
        
      </div>
      
      <div id="recorder">
      <div id="wami" align="center" style="margin-top: 330px;">
</div>
	      <div  id="suiv">
<a href="
			 <?php 
			 if($cle < count($prompts))
			 echo 'index.php?next='.$cle; 
			 else 
			 echo '../vue/Final.html'
			 ?>"
              title="Suivant" id="Next"></a>
   	   </div>
    
      </div>
 


      
<footer class="fluid footer buttons">
  	<p align="center"> <a href="../index.php"> Retour à l'Acceuil</a></p>
    
               
      </footer>
      
	</div>
</body>
</html>
