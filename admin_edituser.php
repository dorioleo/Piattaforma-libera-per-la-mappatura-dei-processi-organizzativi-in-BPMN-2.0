<?php session_start();
	if (!isset($_SESSION['level']) && $_SESSION['level']<3) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		if (isset($_GET['name'])) $name=$_GET['name'];
		else $name=$_POST['name'];
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

<title>Edit User <?php echo $name; ?></title>
</head>
<body>
<font face="Arial" size=2>
<?php
if (!isset($_POST['submit'])) {
?>
<div style="width:95%;" class="container">


<div class="account-wall">
	<form action="admin_edituser.php" method=post class="form-signin">
	<b>Modifica Utente</b><img src="img/utente.gif" width="20" height="20" border="0" /><h2><?php echo $name; ?></h2>
	Nuova Password<input type="password" name="pass" class="form-control" placeholder="Nuova Password" required>
	Livello
	<?php 
	if (strtoupper($name)==strtoupper($_SESSION['username'])) echo $_SESSION['level'];
	else echo '<select name="level"><option value="1">1=Visualizzatore</option><option value="2">2=Gestore Diagrammi</option><option value="3">3=Gestore Diagrammi e Utenti</option></select>';
    ?>
	<input type="hidden" name="name" value="<?php echo $name; ?>">
	<br /><br /><br />
	<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value=" Set ">Aggiorna</button>
	</form>
</div>
<!--
<form action="admin_edituser.php" method=get>
<table border=1 class="table table-striped">
<tr><td colspan=2 class="HEAD" align="center"><b>Edit user <i><?php echo $name; ?></i></b> <img src="img/edit.png" width="20" height="20" border="0" /></td></tr>
<tr><td class="ROW">New Password </td><td class="ROW"> <input name="pass" size=10></td></tr>
<tr><td class="ROW">Access Level </td><td class="ROW"> <select name="level"><option value="1">1=Visualizzatore</option><option value="2">2=Gestore Diagrammi</option><option value="3">3=Gestore Diagrammi e Utenti</option></select></td></tr>
<tr><td colspan=2 class="FOOT"><input type=submit name="submit" value=" Set "></td></tr>
</table>
<input type=hidden name="name" value="<?php echo $name; ?>">
</form>
-->
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
		list($n,$p,$a) = explode(':',$userlist[$i]);
		$found = ($n==$name);
	}
	if ($pass!="") $p = md5($pass);
	if ($level!="") $a = $level;

	$userlist[$i] = implode(':',array($n,$p,$a));
	$fd = fopen("./users/users.$entity.php","w");
	fputs($fd,"<?php die(\"Access restricted\"); ?>\n");
	for ($i=1; $i<count($userlist); $i++) {
		fputs($fd,chop($userlist[$i])."\n");
	}
	fclose($fd);
	echo '<h3><div class="alert alert-success"><b>Modifica utente '.$name.' eseguita...</b><br /><br /><button type="button" class="btn btn-default" onclick="javascript:window.close()">Chiudi</button></div></h3>';
}
?>
</font>
</body>
</html>	