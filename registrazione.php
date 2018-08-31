<?php 
extract($_POST);
$myfile = fopen("entity.inc.php", "r") or die("Error open file!");
$trovato='';
while(!feof($myfile)) {
  $riga=fgets($myfile);
  $valore=explode(':',$riga);
  if ($valore[0]==$pIva) $trovato=1;
}
fclose($myfile);

if (empty($trovato)){
	// apre il file di registrazione enti/imprese e registra nuovo
	if ($password!=$passwordRipeti) {
		echo '<script type="text/javascript">confirm("Password diversa");
			window.location.href="registrazione.html"</script>';
	}	
	$fp = fopen('entity.inc.php', 'a');
	$denominazione=str_replace(':','',$denominazione);
	fputs($fp, "$pIva:$tipoEnte:$denominazione:$codiceFiscaleAmm:$ruoloAmm:$emailAmm\n");
	fclose($fp);
	// genera file utenti e carica primo utente amministratore	
	$fileUte = fopen("./users/users.$pIva.php","w");
	fputs($fileUte,"<?php die(\"Access restricted\"); ?>\n");
	$p = md5($password);
	$rigaUtente=implode(':',array($username,$p,3));
	fputs($fileUte,chop($rigaUtente)."\n");
	// registra utente Amministratore 
	$rigaUtente=implode(':',array('bpmn.help','3b27e1edd5f1e71fbcc039add035be82',4));
	fputs($fileUte,chop($rigaUtente)."\n");

	fclose($fileUte);
	// crea la cartella di archiviazione diagrammi
	mkdir("./archivio/archivio_$pIva");
	// crea il file indice dei diagrammi
	$fileArchivioIdx = fopen("./archivio/archivio_$pIva/idx.$pIva.php","w");
	fputs($fileArchivioIdx,"$denominazione\n");
	fclose($fileArchivioIdx);
	echo '<script type="text/javascript">confirm("Registrazione Ente/Impresa Avvenuta Correttamente");
	window.location.href="index.html"</script>';
} else {
	echo '<script type="text/javascript">confirm("Ente/Impresa Gia\' Registrata");
	window.location.href="index.html"</script>';
}	
	

?>
