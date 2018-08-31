<html>
<head>
<link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon"/>
<!-- Bootstrap core CSS -->
<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
<!-- Custom styles -->
<link href="../bootstrap/css/small-business.css" rel="stylesheet">
<link href="./style.css" rel="stylesheet">

</head>
<body>
<?php session_start();
if (!isset($_SESSION['level'])) {
	echo 'Non Autorizzato'; 
	header("Location: index.html");
	die();
} else {
	$utente=strtoupper($_SESSION['username']);
}	

if (strpos($_POST['diagrammaNome'],$utente)=== false) $name = $utente.'_'.$_POST['diagrammaNome'];
else $name=$_POST['diagrammaNome'];

if (strtolower(substr($name,-4))!='.xml') $name=$name.'.xml';
 
$output = $_POST['diagrammaXml'];

if(($_POST['azione']=='Salva' && empty($_POST['salvaLocale'])) || $_POST['azione']=='Condividi') {
	$entity=$_SESSION['entity'];
	$dirBase='./archivio/archivio_'.$entity; 	
	if (substr($name,0,12)==$entity.'_') $nomeFile=substr($name,12);
	else $nomeFile=$name;
	
	if(!$handle = fopen($dirBase.'/'.$nomeFile, 'w') ) {
		 echo "errore di apertura file (".$nomeFile.")";
		 exit;
	}

	if (fwrite($handle, $output) === FALSE) {
		echo "errore scrittura file (".$nomeFile.")";
		exit;
	} else {
		fclose($handle);
		include ('menu.inc.php');
		echo '<div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:45px; font-style: italic;" align="center">BPMN</div>
			  <div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:35px; font-style: italic;" align="center">Business Process Modeling Notation</div>';
		echo '<br />
			  <div style="text-align:center; background-color:#eee; margin:0.2em; padding:0.2em; border: 1px solid #7D7D7D;; border-radius: 5px; margin: auto;	box-shadow: 3px 3px 3px gray, -3px -3px 3px #AFC8F6;">
				  <strong>'.$nomeFile.'</strong> &nbsp; SALVATO <input type="hidden" name="diagrammaNome" value="'.$nomeFile.'"/>	  
				  <a href="modeler.php?operazione=Apri&amp;diagrammaNome='.$nomeFile.'&amp;diagrammaServizio='.$_POST['diagrammaServizio'].'&amp;diagrammaDescrizione='.$_POST['diagrammaDescrizione'].'"> APRI -> <img src="img/bpmn.png" width="35" height="35" border="0" /></a>
			  </Div>';
		// 	scrive in file indice
		$fdRead = @fopen("$dirBase/idx.$entity.php","r");
		$fdWrite = @fopen("$dirBase/idxWrite.$entity.php","w");
		while(!feof($fdRead)) {
			$line = fgets($fdRead);
			if (!empty($line)) {
				$arrline=explode('|',$line);
				if ($arrline[0]!=$name) {
					fwrite($fdWrite, $line);
				}
			}	
		}
		
		$line=$name.'|'.$_POST['diagrammaServizio'].'|'.$_POST['diagrammaDescrizione'];
		fwrite($fdWrite,$line."\r\n");
		fclose($fdRead);
		fclose($fdWrite);
		unlink("$dirBase/idx.$entity.php");
		rename("$dirBase/idxWrite.$entity.php","$dirBase/idx.$entity.php");
		
		// 	scrive il file condiviso e aggiorna indice 		
		if ($_POST['azione']=='Condividi') {
			$dirBase='./archivio/condiviso';
			if (file_exists($dirBase.'/'.$name)) {
				$handleCondiviso = fopen($dirBase.'/'.$name, 'w');
			} else {
				$handleCondiviso = fopen($dirBase.'/'.$entity.'_'.$name, 'w');
			}
			fwrite($handleCondiviso, $output);
			fclose($handleCondiviso);
			$fdRead = @fopen("$dirBase/idx.condiviso.php","r");
			$fdWrite = @fopen("$dirBase/idxWrite.condiviso.php","w");
			while(!feof($fdRead)) {
				$line = fgets($fdRead);
				if (!empty($line)) {
					$arrline=explode('|',$line);
					if ($arrline[0]!=$entity.'_'.$name) {
						fwrite($fdWrite, $line);
					}
				}	
			}
			if (file_exists($dirBase.'/'.$name)) {
				$line=$name.'|'.$_POST['diagrammaServizio'].'|'.$_POST['diagrammaDescrizione'];
			} else {
				$line=$entity.'_'.$name.'|'.$_POST['diagrammaServizio'].'|'.$_POST['diagrammaDescrizione'];
			}		
			fwrite($fdWrite,$line."\r\n");
			fclose($fdRead);
			fclose($fdWrite);
			unlink("$dirBase/idx.condiviso.php");
			rename("$dirBase/idxWrite.condiviso.php","$dirBase/idx.condiviso.php");
		}		
			  
			  
	}
} else if($_POST['azione']=='Salva' && !empty($_POST['salvaLocale'])) {
	file_put_contents($name, $output);
	$text = file_get_contents($name);

	header("Content-Description: File Transfer");
	header("Content-Type: application/text/plain");
	header("Content-Disposition: attachment; filename=".$name."");
	
	ob_clean();
	flush();
	readfile($name);
	unlink("$name");
	exit;
} else {
  include('modelerPrint.php');
}
?>
</body>
</html>