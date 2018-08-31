<?php
// menù 
ini_set('default_charset', 'utf-8');
echo '
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon"/>
	<!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Custom styles -->
    <link href="../bootstrap/css/small-business.css" rel="stylesheet">
	<link href="./style.css" rel="stylesheet">
	
';
echo "
<script> 
function apriPop(url) { 
	newin = window.open(url,'titolo','scrollbars=yes,resizable=yes, width=1000,height=1000,status=no,location=no,toolbar=no');
} 
</script>
";
$pulsanteAdmin=$pulsanteNuovo=$pulsanteArchivio=$pulsanteArchivioCondiviso='';
if ($_SESSION['level'] >2) $pulsanteAdmin='<li><a href="admin.php" class="bottoneMenu">Gestione<img src="img/utenti.gif" width="18" height="20" border="0" /></a> </li>';
if ($_SESSION['entity']!='11111111111' && $_SESSION['username']!='bpmn') {
	$pulsanteArchivio='<li><a href="archivio.php" class="bottoneMenu">Apri &nbsp; &nbsp; &nbsp; <img src="img/archivio.png" width="23" height="20" border="0" /></a> </li>';
	if ($_SESSION['level'] >1) 		 	$pulsanteNuovo='<li><a href="modeler.php?operazione=Nuovo" class="bottoneMenu">Nuovo &nbsp; <img src="img/new.png" width="23" height="20" border="0" /></a> </li>';
	if ($_SESSION['tipoEnte']=='PA') 	$pulsanteArchivioCondiviso='<li><a href="archivioCondiviso.php" class="bottoneMenu">Condiviso<img src="img/archivioCondiviso.png" width="13" height="20" border="0" /></a> </li>';
} else {
	$pulsanteArchivio='<li><a href="index_bpmn.php" class="bottoneMenu">Apri &nbsp; &nbsp; <img src="img/archivio.png" width="23" height="20" border="0" /></a> </li>';
}	
if (empty($_SESSION['denominazioneEnte'])) $_SESSION['denominazioneEnte']='';

echo '
<br /><br />
<nav class="navbar navbar-inverse bg-primary navbar-expand-lg fixed-top">
	<div class="container-fluid">
		<div class="navbar-header">
			<a class="navbar-brand" href="index.html" style="float:left;"><img src="img/exit.png" width="40" height="40" border="0" /></a>
		</div>
		<ul class="nav navbar-nav">
			'.$pulsanteAdmin.'
			'.$pulsanteNuovo.'
			'.$pulsanteArchivio.'
			'.$pulsanteArchivioCondiviso.'
			<li><a href="javascript:apriPop(\'Guida.html\');" class="bottoneMenu">Guida  &nbsp; <img src="img/help.png" width="23" height="20" border="0" /></a></li>
		</ul>
		<h1 align="center" style="color:white; "> &nbsp; BPMN 2.0</h1>
		<div style="color:white; ">&nbsp;  Utente: <strong>'.$utente.'</strong> &nbsp; - &nbsp; <strong>'.$_SESSION['denominazioneEnte'].'</strong></div>
	</div> 
</nav>
';
?>
