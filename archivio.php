<?php session_start();
	if (!isset($_SESSION['level'])) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		$utente='<strong>'.strtoupper($_SESSION['username']).'</strong>';
	}	
echo '
<html>
<head>
<title>BPMN</title>
<script>
function confirmDelete(delUrl) {
  if (confirm("Sei sicuro di cancellare il diagramma? ")) {
   document.location = delUrl;
  }
}
</script>
</head>
<body>';
if ($_SESSION['level']>1 && isset($_GET['operazione']) && $_GET['operazione']=='Delete') {
	// unlink($_GET['diagrammaNome']);
	rename($_GET['dirBase'].'/'.$_GET['nomeDiagramma'], $_GET['dirBase'].'/'.'___'.date('Ymd').'_'.$_GET['nomeDiagramma']);
	
}	
include ('menu.inc.php');
echo '<br /><br /><br />	
	  <div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:35px; font-style: italic;" align="center">Business Process Modeling Notation</div>';
echo '<div style="width:80%;" class="container">';	  
echo '<h4>
	  <form class="form-inline font-weight-bold" 
	  action="modeler.php" method="post" enctype="multipart/form-data" 
	  style="margin:0.2em; padding:0.2em; border: 1px solid #7D7D7D;; border-radius: 5px; margin: auto; box-shadow: 3px 3px 3px gray, -3px -3px 3px #AFC8F6;">
	  <div class="form-group">Modello Locale: &nbsp; <img src="img/bpmn.png" width="100" height="50" border="0" /></div><div class="form-group"><input type="file" name="diagrammaXml" /></div><input type="submit" name="operazione" value="Apri" class="btn btn-primary btn-lg"  >
      </form></h4>
	  <br />';
$formCerca='<form id="form_search" name="form_search" action="archivio.php" method=post >
				 <div class="input-group">
				  <input class="form-control" placeholder="Cerca ..." type="text" name="cosaCercare"> &nbsp;
					<span class="input-group-btn">
					 <button class="btn btn-default" type="submit" name="Ricerca" value="Ricerca"><img src="img/lente.png" width="20" height="23" border="0" /></button>
					 <input type="checkbox" name="ricercaInterna" ><font color=white> Includi Ricerca Interna</font>
				  </span>
			  </div>
			</form>';
echo '<div class="table-responsive">';			
echo '<table class="table table-striped" border=1 style="margin: auto; box-shadow: 5px 5px 5px gray, -3px -5px 5px #AFC8F6;" >';
echo '<tr><td style="background:#0099ff;" colspan="5">
		  <div class="form-inline">
			<div class="input-group"><font color=white size="5"><strong>Archivio Diagrammi</strong> &nbsp; <img src="img/archivio.png" width="35" height="35" border="0" /></font> &nbsp;</div>
			&nbsp; &nbsp; &nbsp; '.$formCerca.'
		  </div>
		  </td>
	  </tr>
	  <tr><td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Nome</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Area</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Descrizione</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Apri</strong></font></td>';
if ($_SESSION['level']>1) echo '<td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Del</strong></font></td>';		   
echo '</tr>';
$entity=$_SESSION['entity'];
$dirBase='archivio/archivio_'.$entity; 	


$names = array();
// apre la directori e carica nome in array per ordinamento
if ($handle = opendir($dirBase)) {
	while(false !== ($dir = readdir($handle))) { 
		if ($dir != "." && $dir != ".." && substr($dir,0,3)!='idx' && substr($dir,0,3)!='___' || (substr($dir,0,3)=='___' && $_SESSION['username']=='bpmn.help') ) {
			$names[]=$dir;	
		}
	}
	closedir($handle); 
}	

if (!empty($names)) {
	// ordina array dei nomi
	sort($names);
	// costruisce elenco ed effettua ricerca
	foreach ($names as $name) {
		$txtTD=$servizio=$descrizione=$trovatoRicercaInterna='';
		$nomeDiagramma=str_replace(" ","%20",$name);
		$txtTD.= '<tr><td>'.$name.'</td>';
		$fdRead = @fopen("$dirBase/idx.$entity.php","r");
		while(!feof($fdRead)) {
			$line = fgets($fdRead);
			if (!empty($line)) {
				$arrline=explode('|',$line);
				if (str_replace(" ","%20",$arrline[0])==$nomeDiagramma) {
					$servizio=$arrline[1];
					$descrizione=$arrline[2];
				}
			}	
		}
		fclose($fdRead);
		// esegue la ricerca interna
		if (!empty($_POST['ricercaInterna'])) {
			$file= fopen($dirBase.'/'.$name,'r');
			$length=filesize($dirBase.'/'.$name);
			$leggi=fread($file,$length);
			if (strpos($_POST['cosaCercare'],'+')) {
				$stringhe = explode("+", $_POST['cosaCercare']);
				foreach ($stringhe as $val) {
					if (strpos(strtoupper($leggi),strtoupper($val))>0) $trovatoRicercaInterna='si';
				}		
			} else if (strpos(strtoupper($leggi),strtoupper($_POST['cosaCercare']))>0) $trovatoRicercaInterna='si';
			fclose($file);
		}	
		$txtTD.= '<td>'.$servizio.'</td><td>'.$descrizione.'</td>';			
		$txtTD.= '<td align="center"><a href="modeler.php?operazione=Apri&amp;diagrammaNome='.$nomeDiagramma.'&amp;diagrammaServizio='.$servizio.'&amp;diagrammaDescrizione='.$descrizione.'"><img src="img/edit.png" width="25" height="25" border="0" /></a></td>';
		if ($_SESSION['level']>1) $txtTD.= '<td align="center"><a href="javascript:confirmDelete(\'archivio.php?operazione=Delete&amp;dirBase='.$dirBase.'&amp;nomeDiagramma='.$nomeDiagramma.'\')"><img src="img/del.jpg" width="25" height="25" border="0" /></a></td>';		  
		$txtTD.= '</tr>';
		
		if (!empty($_POST['cosaCercare'])) {
			if (strpos(' '.strtoupper($dir), strtoupper($_POST['cosaCercare'])) > 0 
			 || strpos(' '.strtoupper($servizio), strtoupper($_POST['cosaCercare'])) > 0   
			 || strpos(' '.strtoupper($descrizione), strtoupper($_POST['cosaCercare'])) > 0  
			 || $trovatoRicercaInterna=='si' ) echo $txtTD; 
		} else echo $txtTD;		
	}	
}


if ($_SESSION['level']>1) $valoreColspan=5; else $valoreColspan=4;
echo '</table><br />';
echo '</div></div>';
echo '</body></html>';
?>
