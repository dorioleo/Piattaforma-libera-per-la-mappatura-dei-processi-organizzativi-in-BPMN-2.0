<?php session_start();
	if (!isset($_SESSION['level']) && $_SESSION['level']<3) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		$utente=strtoupper($_SESSION['username']);
	}	
?>
<html>
<head>
<title>BPMN</title>
<script>
function confirmDelete(delUrl) {
  if (confirm("Sei sicuro di eliminare utente? ")) {
   document.location = delUrl;
  }
}
</script>

<script>
	function editUser(n) {
		url = "admin_edituser.php?name="+n;
		var dummy = window.open(url,"EditUser","width=550,height=400");
	}
	function delUser(n) {
		url = "admin_deluser.php?name="+n;
		var dummy = window.open(url,"DelUser","width=500,height=130");
	}
	function addUser() {
		url = "admin_adduser.php";
		var dummy = window.open(url,"AddUser","width=550,height=400");
	}
</script>
</head>
<body>
<?php 
include ('menu.inc.php');
?>
<br /><br />	
<div style="text-shadow: 5px 5px 5px gray; font-family: Times, serif; font-size:35px; font-style: italic;" align="center">Business Process Modeling Notation</div>
<div style="width:50%;" class="container">
<div border=1 style="margin: auto; box-shadow: 5px 5px 5px gray, -3px -2px 2px #AFC8F6; text-align:center; background-color:#cfcfcf; ">
<a href="javascript: addUser();"><strong>Nuovo Utente</strong><img src="img/utente.gif" width="30" height="30" border="0" /></a>
</div>
<br />
<table border=1 width=400 style="margin: auto;	box-shadow: 2px 2px 2px gray, -3px -3px 3px #AFC8F6;" class="table table-striped">
<tr><td colspan=4 align="center" class="adminHead"><font face="Arial" size=3><b>Gestione Utenti</b> &nbsp; <img src="img/utenti.gif" width="20" height="20" border="0" /></font></td></tr>
<tr><td class="adminHead" width=230>Nome Utente</td><td class="adminHead" width=50>Livello</td><td class="adminHead">Edit</td><td class="adminHead">Del</td></tr>
<?php
	$entity=$_SESSION['entity'];
	$userlist = file("./users/users.$entity.php");
	for ($i=1; $i<count($userlist); $i++) {
		list($n,$p,$a) = explode(':',chop($userlist[$i]));
		if ($n!='bpmn.help')  {
			echo "<tr>";
			echo "<td>$n</td><td align=center>$a</td>
			 	 <td align=center><a href=\"javascript: editUser('$n');\"><img src=\"img/edit.png\" width=\"20\" height=\"20\" border=\"0\" /></a></td>
			 	 <td align=\"center\">";
			if (strtoupper($n)!=$utente) echo "<a href=\"javascript:confirmDelete('admin_deluser.php?name=$n')\"><img src=\"img/del.jpg\" width=\"20\" height=\"20\" border=\"0\" /></a>";
			echo "</td>";
			echo "</tr>";
		}
	}
?>
<tr><td colspan="4">Livello:<br />1=Solo Visualizzazione<br />2=Gestione Diagrammi<br />3=Gestione Diagrammi e Utenti</td></tr>
</table>
</div>
</body>
</html>
