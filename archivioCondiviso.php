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
	unlink($_GET['diagrammaNome']);
}	
include ('menu.inc.php');
echo '<br /><br /><br />	
	  <div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:35px; font-style: italic;" align="center">Business Process Modeling Notation</div>';
echo '<div style="width:80%;" class="container">';
$formCerca='<form id="form_search" name="form_search" action="archivioCondiviso.php" method=post >
				 <div class="input-group">
				  <input class="form-control" placeholder="Cerca ..." type="text" name="cosaCercare"> &nbsp;
				  <span class="input-group-btn">
					 <button class="btn btn-default" type="submit" name="Ricerca" value="Ricerca"><img src="img/lente.png" width="20" height="23" border="0" /></button>
					 <input type="checkbox" name="ricercaInterna" ><font color=white> Includi Ricerca Interna</font>
				  </span>
			  </div>
			</form>';	  
echo '<div class="table-responsive">';	  
echo '<table class="table table-striped" width=50% border=1 style="margin: auto; box-shadow: 5px 5px 5px gray, -3px -5px 5px #AFC8F6;">';
echo '<tr><td style="background:#0099ff;" colspan="5">
		  <div class="form-inline">
			<div class="input-group"><font color=white size="5"><strong>Archivio Diagrammi Condivisi</strong> &nbsp; <img src="img/archivioCondiviso.png" width="35" height="35" border="0" /></font> &nbsp;</div>
			&nbsp; &nbsp; &nbsp; '.$formCerca.'
		  </div>
		  </td>
	  </tr>
	  <tr><td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Nome</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Area</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Descrizione</strong></font></td>
		  <td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Apri</strong></font></td>';
echo '<td style="background:#0099ff;" align="center"><font color=white size="4"><strong>Del</strong></font></td>';
echo '</tr>';
$dirBase='archivio/condiviso'; 	
$names = array();
// apre la directori e carica nome in array per ordinamento
if ($handle = opendir($dirBase)) {
	while(false !== ($dir = readdir($handle))) { 
		if ($dir != "." && $dir != ".." && substr($dir,0,3)!='idx' ) {
			$names[]=$dir;	
		}
	}
	closedir($handle); 
}	

sort($names);
// costruisce elenco ed effettua ricerca
foreach ($names as $name) {
	$txtTD=$servizio=$descrizione=$trovatoRicercaInterna='';
	$nomeDiagramma=str_replace(" ","%20",$name);
	$txtTD.= '<tr><td>'.$name.'</td>';
	$fdRead = @fopen("$dirBase/idx.condiviso.php","r");
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
	$txtTD.= '<td align="center"><a href="modeler.php?operazione=Apri&amp;condiviso=si&amp;diagrammaNome='.$nomeDiagramma.'&amp;diagrammaServizio='.$servizio.'&amp;diagrammaDescrizione='.$descrizione.'"><img src="img/edit.png" width="25" height="25" border="0" /></a></td>';
	if ($_SESSION['level']>2 && strpos(strtoupper($name), substr(strtoupper($_SESSION['entity']),1))>0 && strpos(strtoupper($name), strtoupper($_SESSION['username']))>0) $txtTD.= '<td align="center"><a href="javascript:confirmDelete(\'archivioCondiviso.php?operazione=Delete&amp;diagrammaNome='.$dirBase.'/'.$nomeDiagramma.'\')"><img src="img/del.jpg" width="25" height="25" border="0" /></a></td>';		  
	else $txtTD.= '<td></td>';
	$txtTD.= '</tr>';
	
	if (!empty($_POST['cosaCercare'])) {
		if (strpos(' '.strtoupper($name), strtoupper($_POST['cosaCercare'])) > 0 
		 || strpos(' '.strtoupper($servizio), strtoupper($_POST['cosaCercare'])) > 0   
		 || strpos(' '.strtoupper($descrizione), strtoupper($_POST['cosaCercare'])) > 0  
		 || $trovatoRicercaInterna=='si' ) echo $txtTD; 
	} else echo $txtTD;	
	

}

if ($_SESSION['level']>1) $valoreColspan=5; else $valoreColspan=4;
echo '</table><br />';
echo '</div></div>';
echo '</body></html>';
?>
