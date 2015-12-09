<?php
session_start();
?>
<!DOCTYPE html>

<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Tâche</title>
<link href="../Styles/boilerplate.css" rel="stylesheet" type="text/css">
<link href="../Styles/work2.css" rel="stylesheet" type="text/css">
  <style type='text/css'>
    ul { list-style: none; }
    #recordingslist audio { display: block; margin-bottom: 10px; }
  </style>
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
                                window.open('Aide2.html','Aide','menubar=no, scrollbars=yes, top='+top+', left='+left+', width='+width+', height='+height+'');
                        }
                -->
                </script>

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
  		<?php
		 if(isset($_GET['next']))
		{$cle = (int)$_GET['next'];
		
		$phrase = $prompts[$cle]['phrase'];
		
		$cle++;} 
		else
		 {$phrase = $prompts[0]['phrase']; 
		 $cle=1;}?>
         <script>var __adobewebfontsappname__="dreamweaver"</script><script src="https://use.edgefonts.net/abel:n4:default.js" type="text/javascript"></script>
</head>
<body>
<div class="gridContainer clearfix">
      
      <header class="fluid header">
      	<h1 class="fluid titre" align="center">
       	Tâche à effectuer 
        </h1>
        
      </header>
  
		<div  align="center" id = "workspace" class="fluid main">
		
			<h1 id="env">
     	<center>Veuillez prononcer le chiffre ci-dessous  en DARIJA </center>
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
		
<div class="bouton" style="float:center">
  <button type="bouton" class="IR" id="IRbuttonplay" onclick="startRecording(this);" ><em id="ema"></em>record</button>
  <button type="bouton" class="IR" id="IRbuttonstop" onclick="stopRecording(this);" disabled><em id="emb"></em>stop</button>

  </div>
     <div  id="suiv" >
<a    href="<?php 
			 if($cle < count($prompts))
			 echo 'index2.php?next='.$cle; 
			 else 
			 echo '../vue/Final.html'
			 ?>"
              title="Suivant" id="Next"></a>
   	   </div>
  <div class = "liste">
  <h2>Recordings</h2>
  <ul id="recordingslist">(Vide)</ul>
  </div>
  
 
  <pre id="log"></pre>

  

  
</div>
  <footer class="fluid footer buttons">
  	<p align="center"> <a href="../index.php"> Retour à l'Acceuil</a></p>
    
               
      </footer>
      

  
    <script >
  function __log(e, data) {
    //log.innerHTML += "\n" + e + " " + (data || '');
  }

  var audio_context;
  var recorder;

  function startUserMedia(stream) {
    var input = audio_context.createMediaStreamSource(stream);
    __log('Media stream created.');

    // Uncomment if you want the audio to feedback directly
    //input.connect(audio_context.destination);
    //__log('Input connected to audio context destination.');
    
    recorder = new Recorder(input);
    __log('Recorder initialised.');
  }

  function startRecording(button) {
    recorder && recorder.record();
    button.disabled = true;
	var elmt = document.getElementById("ema");
	elmt.style.backgroundPosition = "-135px -5px";
	
			var elmt2 = document.getElementById("emb");
	elmt2.style.backgroundPosition = "-5px -5px";
    button.nextElementSibling.disabled = false;
    __log('Recording...');

  }

  function stopRecording(button) {
    recorder && recorder.stop();
    button.disabled = true;
	var elmt = document.getElementById("ema");
	elmt.style.backgroundPosition = "-5px -5px";
	var elmt2 = document.getElementById("emb");
	elmt2.style.backgroundPosition = "-135px -5px";
    button.previousElementSibling.disabled = false;
    __log('Stopped recording.');
	
	var myNode = document.getElementById("recordingslist");
	while (myNode.firstChild) {
    myNode.removeChild(myNode.firstChild);
	}
    
    // create WAV download link using audio data blob
   // createDownloadLink();
    exportWAV();
    recorder.clear();
  }
  
   function exportWAV(){
	     recorder.exportWAV(function (blob) {
    var url = (window.URL || window.webkitURL).createObjectURL(blob);
	
	 var audio = document.createElement('audio');
    audio.src = url;
    audio.controls = true;
	audio.style.marginLeft = 'auto';
	audio.style.marginRight = 'auto'; 
    var hf = document.createElement('a');
    hf.href = url;
    hf.download = new Date().toISOString() + '.wav';
	recordingslist.appendChild(audio);
    upload2(blob);   
});
	   }
	   
/*function upload(blob) {
  var xhr=new XMLHttpRequest();
  xhr.onload=function(e) {
      if(this.readyState === 4) {
          __log("Server returned: ",e.target.responseText);
      }
  };
  var fd=new FormData();
  fd.append("filename.wav",blob);
  xhr.open("POST","/recordings/save_fileMob.php",true);
  xhr.send(fd);
  //document.location.href="/recordings/save_fileMob.php";
}*/

function upload2(blob){
	var fileType = 'audio'; // or "audio"
var fileName = '<?php echo $_SESSION['id']; ?>_prompt_<?php echo $phrase;?>.wav';  // or "wav"

var formData = new FormData();
formData.append(fileType + '-filename', fileName);
formData.append(fileType + '-blob', blob);

xhr('../recordings/save.php', formData, function (fName) {
   //window.open(location.href + fName);
});


function xhr(url, data, callback) {
    var request = new XMLHttpRequest();
    request.onreadystatechange = function () {
        if (request.readyState == 4 && request.status == 200) {
            callback(location.href + request.responseText);
        }
    };
    request.open('POST', url);
    request.send(data);
}
	}


   /*function createDownloadLink() {
    recorder && recorder.exportWAV(function(blob) {
      var url = (window.URL || window.webkitURL).createObjectURL(blob);
  
      var li = document.createElement('li');
      var au = document.createElement('audio');
      var hf = document.createElement('a');
      
      au.controls = true;
      au.src = url;
      hf.href = url;
      hf.download = new Date().toISOString() + '.wav';
      hf.innerHTML = hf.download;
      li.appendChild(au);
      li.appendChild(hf);
      recordingslist.appendChild(li);
	
  
    });
  }
*/
  window.onload = function init() {
    try {
      // webkit shim
      window.AudioContext = window.AudioContext || window.webkitAudioContext;
      navigator.getUserMedia = navigator.getUserMedia || navigator.webkitGetUserMedia ||
                  navigator.mozGetUserMedia || navigator.msGetUserMedia;
      window.URL = window.URL || window.webkitURL;
      
      audio_context = new AudioContext;
      __log('Audio context set up.');
      __log('navigator.getUserMedia ' + (navigator.getUserMedia ? 'available.' : 'not present!'));
    } catch (e) {
      alert('No web audio support in this browser!');
    }
    
    navigator.getUserMedia({audio: true}, startUserMedia, function(e) {
      __log('No live audio input: ' + e);
    });
  };
  

  </script>

  <script src="../Scripts/recorder.js"></script>
  
</body>
</html>
