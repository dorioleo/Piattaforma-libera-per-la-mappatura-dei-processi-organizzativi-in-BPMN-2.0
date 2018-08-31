<?php session_start();
	if (!isset($_SESSION['level'])) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		$utente=strtoupper($_SESSION['username']);
	}	
?>
<html lang="en">
<head>
<title>BPMN</title>
</head>
<body>
<?php
	
	include ('menu.inc.php');
	if ($_SESSION['entity']=='11111111111' && $_SESSION['username']=='bpmn') {
		$pulsanteApri='<div class="container">
						<div class="col-md-8 col-md-offset-2">
							<h3>Diagramma XML</h3>
							<img src="img/bpmn.png" width="100" height="50" border="0" />
							<form action="modeler.php" method="post" enctype="multipart/form-data" >
								<div class="form-group">
									<div align="center">
									<div class="input-group input-file" name="diagrammaXml">
										&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;  &nbsp; <input type="file" name="diagrammaXml" style="font-size:25px;" accept=".xml">
										<button type="submit" name="operazione" value="Apri" class="btn btn-primary btn-lg">Apri</button>
									</div>
									</div>
								</div>
								<div class="form-group"><hr></div>
								<div class="form-group">
								  <div align="center">							  
									<button type="submit" name="operazione" value="Nuovo" class="btn btn-primary btn-lg">Nuovo</button>
								  </div>
								  
								  <br />
								  <div align="center">							  
									<button type="submit" name="operazione" value="Esempio1" class="btn btn-secondari btn-lg">Esempio 1 - Accesso alla Piattaforma </button>
								  </div>
								  <br />
								  <div align="center">							  
									<button type="submit" name="operazione" value="Esempio2" class="btn btn-secondari btn-lg">Esempio 2 - Notazioni Economiche</button>
								  </div>
								  <br />
								  <div align="center">							  
									<button type="submit" name="operazione" value="Esempio3" class="btn btn-secondari btn-lg">Esempio 3 - Flusso Esecutivo</button>
								  </div>
								  
								</div>
							</form>';
	} else {
		$pulsanteApri='<h3>Diagramma XML</h3>
						<img src="img/bpmn.png" width="100" height="50" border="0" />
						<br />
						<a href="modeler.php?operazione=Nuovo">Nuovo &nbsp; <img src="img/new.png" width="30" height="30" border="0" /></a>
						<br />
					    <a href="archivio.php">Apri &nbsp; &nbsp; &nbsp; <img src="img/archivio.png" width="30" height="30" border="0" /></a>';
	}
	echo '
	<br /><br /><br /><br />
	<div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:45px; font-style: italic;"  align="center">
	Business Process Modeling Notation
	<br />
	<div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:30px; font-style: italic;"  align="center">
	'.$pulsanteApri.'
	</div>
	</div>
	';
?>
</body>
</html>
