<?php session_start();

function authUser($name, $pass, $entity) {
	$userlist = @file("./users/users.$entity.php");
	$done  = false;
	$auth  = false;
	$found = false;
	$i = 1;
	while (!$done && !$found) {
		@list($n,$p,$a) = explode(':',$userlist[$i]);
		$found = ($n==$name);
		$auth  = $found && ($p == md5($pass));
		$done  = $auth || ($i>=count($userlist));
		if($n==$name) {
			$_SESSION['entity']=$entity;
			$_SESSION['username']=$name;
			$_SESSION['password']=$pass;
			$_SESSION['level']=$a;
		}	
		$i++;
	}
	return $auth;
}


if ( authUser($_POST['username'],$_POST['userpass'],$_POST['pIva']) ) {
	$myfile = fopen("./users/entity.inc.php", "r");
	while(!feof($myfile)) {
	    $riga=fgets($myfile);
	    $valore=explode(':',$riga);
	    if ($valore[0]==$_POST['pIva']) { 
			$_SESSION['tipoEnte']=$valore[1];
			$_SESSION['denominazioneEnte']=$valore[2];
	    }	
	}
	fclose($myfile);
	header("Location: index_bpmn.php");
} else {
	echo '<script type="text/javascript">confirm("Credenziali errate o Ente/Impresa non registrata");
	window.location.href="index.html"</script>';
}	
?>
