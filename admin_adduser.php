<?php session_start();
	if (!isset($_SESSION['level']) && $_SESSION['level']<3) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} 
?>
<html>
<head>
<!-- jquery -->
<script type="text/javascript" src="../bootstrap/js/jquery-min.js"></script>
<!-- bootstrap -->
<link media="screen" rel="stylesheet" href="../bootstrap/css/bootstrap.css">
<script src="../bootstrap/js/bootstrap.js"></script>
<!-- css personalizzato -->
<link rel="stylesheet" href="style.css">

<title>Add User</title>
</head>
<body>
<font face="Arial" size=2>
<?php
if (!isset($_POST['submit'])) {
?>
	<div style="width:95%;" class="container">
		<div class="account-wall">
			<form action="admin_adduser.php" method=post class="form-signin">
			<strong>Nuovo Utente</strong><img src="img/utente.gif" width="20" height="20" border="0" />
			<br />
			Nome <input type="text" name="name" class="form-control" placeholder="Utente" required>
			Password <input type="password" name="pass" class="form-control" placeholder="Password" required>
			Livello <select name="level"><option value="1">1=Visualizzatore</option><option value="2">2=Gestore Diagrammi</option><option value="3">3=Gestore Diagrammi e Utenti</option></select>
			<br /><br /><br />
			<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value=" Set ">Inserisci</button>
			</form>
		</div>
	</div>
<?php
	} else {
		extract($_POST);
		$entity=$_SESSION['entity'];
		$userlist = file("./users/users.$entity.php");
		$done  = false;
		$auth  = false;
		$found = false;
		$i = 0;
		while ((!$found) && ($i<count($userlist))) {
			$i++;
			@list($n,$p,$a) = explode(':',$userlist[$i]);
			$found = ($n==$name);
		}
		if ($found) {
			echo '<h3><div class="alert alert-warning">Errore: Utente <strong>'.$name.'</strong> esistente<br /><br /><button type="button" class="btn btn-default" onclick="javascript:window.close()">Chiudi</button></div></h3>';
		} else {
			$p = md5($pass);
			$a = $level;
			$i = count($userlist);
			$userlist[$i] = implode(':',array($name,$p,$a));
			sort($userlist);
			$fd = fopen("./users/users.$entity.php","w");
			fputs($fd,"<?php die(\"Access restricted\"); ?>\n");
			for ($i=1; $i<count($userlist); $i++) {
				fputs($fd,chop($userlist[$i])."\n");
			}
			fclose($fd);
			echo '<h3><div class="alert alert-success"><b>Caricamento utente '.$name.' eseguito...</b><br /><br /><button type="button" class="btn btn-default" onclick="javascript:window.close()">Chiudi</button></div></h3>';
		}
	}
?>
</font>
</body>
</html>	