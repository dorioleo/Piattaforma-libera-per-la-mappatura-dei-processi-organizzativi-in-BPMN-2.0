<?php session_start();
	if (!isset($_SESSION['level']) && $_SESSION['level']<3) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		$name=$_GET['name'];
	}		

echo '
<!-- bootstrap personalizzato -->
<link media="screen" rel="stylesheet" href="./bootstrap.css">
<script src="./bootstrap.js"></script>
<!-- css personalizzato -->
<link rel="stylesheet" href="style.css">

';
	
	if (isset($name)) {
		$entity=$_SESSION['entity'];
		$userlist = file("./users/users.$entity.php");
		$fd = fopen("./users/users.$entity.php","w");
		fputs($fd, "<?php die(\"Access Restricted\"); ?>\n"); 

		for ($i=1; $i<count($userlist); $i++) {
			list($n,$p,$a) = explode(':',$userlist[$i]);
			if ($n!=$name) {
				fputs($fd,$userlist[$i]);
			}
		}
		fclose($fd);
	}
	
	echo '<h3><div class="alert alert-success"><strong>Utente Cancellato...</strong> <a href="javascript: history.back();"><button type="button" class="btn btn-default">Chiudi</button></a></div></h3>';
?>
