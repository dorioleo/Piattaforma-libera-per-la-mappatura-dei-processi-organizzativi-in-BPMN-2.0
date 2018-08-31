<?php session_start();
	if (!isset($_SESSION['level'])) {
		echo 'Non Autorizzato'; 
		header("Location: index.html");
		die();
	} else {
		$utente=strtoupper($_SESSION['username']);
	}	
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="content-type" content="text/html; charset=utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>BPMN</title>
  <style type="text/css">
    html, body, #canvas { height: 95%; padding-left:1px; padding-top:10px; }
  </style>
  <link rel="stylesheet" href="bower_components/bpmn-js/dist/assets/diagram-js.css">
  <link rel="stylesheet" href="bower_components/bpmn-js/dist/assets/bpmn-font/css/bpmn-embedded.css">
  <link rel="stylesheet" href="bower_components/bpmn-js/colors/color-picker.css" />

<style>
#mydiv {
    width: 100%;
    height: 100%;
    overflow: hidden;
    left: 100px;
    top: 100px;
    position: absolute;
    opacity: 0.5;
    z-index: 200;
}
#mydiv-container {
    margin-left: auto;
    margin-right: auto;
}
#mydiv-content {
    width: 70%;
    padding: 20px;
    background-color: white;
    border: 1px solid #6089F7;
}
</style>

<script type="text/javascript">
<!--
function toggle_visibility(id) {
    var e = document.getElementById(id);
    if (e.style.display == 'block') e.style.display = 'none';
    else      					    e.style.display = 'block';
}
	

function functionSostituisci() {
	var notazioneEcoTrova=document.getElementById("notazioneEconomica").value; 
	var xmlVal=document.getElementById("diagrammaXml").value; 
	var notazioneEcoSostituisci="";
	if (document.getElementById("tempo").value) notazioneEcoSostituisci=notazioneEcoSostituisci.concat('tempo:', document.getElementById("tempo").value, '; '); 
	if (document.getElementById("costo").value) notazioneEcoSostituisci=notazioneEcoSostituisci.concat('costo:', document.getElementById("costo").value, '; '); 
	var i;
	var vC='';
	for (i = 1; i < 5; i++) {
		var vRis=vC.concat('ris',i);
		var vX=vC.concat('x',i);
		var vY=vC.concat('y',i);
		if (document.getElementById(vRis).value && document.getElementById(vX).value && document.getElementById(vY).value) {
			notazioneEcoSostituisci=notazioneEcoSostituisci.concat(document.getElementById(vRis).value,'+',document.getElementById(vX).value,'+',document.getElementById(vY).value , '; ');
		}		
	}
	var visualizza=vC.concat(' Variabile Economica \"',notazioneEcoTrova,'\"\n\n al Salvataggio verra\' Sostituita con \n\n \"',notazioneEcoSostituisci,'\"');
	alert (visualizza);	
	var xmlValR=xmlVal.replace( notazioneEcoTrova, notazioneEcoSostituisci );
	document.getElementById("diagrammaXml").value=xmlValR;

	toggle_visibility('foo');
	
	// window.location.reload(true);
}

	
//-->
</script>
  
</head>
<body>
  <?php
  include ('menu.inc.php');
 
  if (!empty($_GET['operazione']) && $_GET['operazione']=='Apri') {
	  if (!empty($_GET['condiviso'])) {
		  $dirBase='archivio/condiviso/'; 	
	  } else {	  
		  $entity=$_SESSION['entity'];
		  $dirBase='archivio/archivio_'.$entity; 	
	  }
	  $_POST["diagrammaXml"]=file_get_contents($dirBase.'/'.$_GET["diagrammaNome"]);
	  $_POST['operazione']='Apri';
  } else if (!empty($_POST['operazione']) && $_POST['operazione']=='Apri') {
	  if (empty($_FILES["diagrammaXml"]["tmp_name"])) echo '<br /><div align="center" class="alert alert-info"><h3>!!! Selezionare Diagramma dal pulsante Sfoglia</h3><button class="btn btn-primary" onclick="window.history.go(-1);">Torna</button></div>';  
	  else {	  
		  $_POST['diagrammaNome']=$_FILES['diagrammaXml']['name'];
		  $_POST["diagrammaXml"]=file_get_contents($_FILES["diagrammaXml"]["tmp_name"]);
	  }
  } else {
	  $_POST["diagrammaXml"]='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_1n4rzdn\"><participant id=\"Participant_1hmd977\" processRef=\"Process_12njqzu\" /></collaboration><process id=\"Process_12njqzu\"><startEvent id=\"StartEvent_1kyz244\" /></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_1n4rzdn\"><bpmndi:BPMNShape id=\"Participant_1hmd977_di\" bpmnElement=\"Participant_1hmd977\"><omgdc:Bounds x=\"100\" y=\"66\" width=\"600\" height=\"250\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1kyz244_di\" bpmnElement=\"StartEvent_1kyz244\"><omgdc:Bounds x=\"141\" y=\"169\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"159\" y=\"208\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';
  }
  ?>
  <div id="canvas"></div>
 
  <div align="center">
  <?php
  if(isset($_POST)) extract($_POST);
  if(isset($_GET)) extract($_GET);
  if(empty($diagrammaNome)) $diagrammaNome='Diagramma.xml';
  if(empty($diagrammaServizio)) $diagrammaServizio=''; 
  if(empty($diagrammaDescrizione)) $diagrammaDescrizione='';

  $pulsanteCondividi=$pulsanteArchivia=$pulsanteSalva='';
  if ($_SESSION['level']>1) { 
	  
	  if ($_SESSION['entity']!='11111111111' && $_SESSION['username']!='bpmn') {
		  $pulsanteSalva='<input type="submit" name="azione" value="Salva" class="btn btn-primary btn-sm" > Localmente <input type="checkbox" name="salvaLocale" > &nbsp; &nbsp; ';
		  if ($_SESSION['tipoEnte']=='PA') {
			 $pulsanteCondividi=' <input type="submit" name="azione" value="Condividi" class="btn btn-primary btn-sm" >&nbsp; ';
		  }
	  } else { 
	  		$pulsanteSalva='<input type="submit" name="azione" value="Salva" class="btn btn-primary btn-sm" >&nbsp;<input type="hidden" name="salvaLocale" value="si">';
	  }
  }  
  $notazione=1;
  $tabellaNotazioni='</div>&nbsp;
		<a href="#" onclick="toggle_visibility(\'foo\');"><img type="button" src="img/notazioneEco.png" width="30" height="30" border="0" /></a>&nbsp;
		<div id="foo" style="display:none; position: absolute; left: 30%; bottom:70px; color: blue; font-weight: bold; font-size: small;" >
		<table border="1" cellspacing="4" cellpadding="4" id="myTable">
		  <tr style="background-color:#cce6ff;"><td colspan="3" align="center">NOTAZIONE ECONOMICA: <input type="text" name="notazioneEconomica" id="notazioneEconomica" size="5" placeholder="$..."></td></tr>
		  <tr><td>tempo</td><td colspan="2" align="center"><input type="text" name="tempo" id="tempo"></td></tr>
		  <tr><td>costo</td><td colspan="2" align="center"><input type="text" name="costo"  id="costo"></td></tr>
		  <tr><th>RISORSA</th><th>Costo Orario/Unitario</th><th>ORE/QTA</th></tr>
		  <tr><td><input type="text" name="ris1" id="ris1"></td><td><input type="text" name="x1" id="x1"></td><td><input type="text" name="y1" id="y1"></td></tr>
		  <tr><td><input type="text" name="ris2" id="ris2"></td><td><input type="text" name="x2" id="x2"></td><td><input type="text" name="y2" id="y2"></td></tr>
		  <tr><td><input type="text" name="ris3" id="ris3"></td><td><input type="text" name="x3" id="x3"></td><td><input type="text" name="y3" id="y3"></td></tr>
		  <tr><td><input type="text" name="ris4" id="ris4"></td><td><input type="text" name="x4" id="x4"></td><td><input type="text" name="y4" id="y4"></td></tr>
		</table> 
		<button type="button" class="btn" onclick="functionSostituisci()">Applica Sostituzione</button>
		</div>';
  echo '
	  <footer class="py-2 bg-dark card text-white position-fixed">
	  <div class="form-inline">
	  <form action="modelerSave.php" method="post" class="form-inline" >
		  <textarea id="diagrammaXml" name="diagrammaXml" style="display:none">'.$_POST["diagrammaXml"].'</textarea>  
		  <div class="form-group"><label for="diagrammaNome">&nbsp; Nome &nbsp;</label><input type="text" id="diagrammaNome" name="diagrammaNome" value="'.$diagrammaNome.'"/></div>
		  <div class="form-group"><label for="diagrammaServizio">&nbsp; Area &nbsp;</label><input type="text" name="diagrammaServizio" value="'.$diagrammaServizio.'" placeholder="Servizio" size="10"/></div>
		  <div class="form-group"><label for="diagrammaDescrizione">&nbsp; Descrizione &nbsp;</label><input type="text" name="diagrammaDescrizione" value="'.$diagrammaDescrizione.'" placeholder="Descrizione" size="40"/>
		  '.$tabellaNotazioni.'
		  '.$pulsanteSalva.'
		  '.$pulsanteCondividi.' &nbsp; &nbsp;
		  <input type="hidden" name="orientamento" value="orizzontale" >
		  <button type="submit" name="azione" value="View" class="btn btn-sm center-block" formtarget="_blank"><img type="button" src="img/print.png" width="25" height="25" border="0"/></button>
		   Percorso Minimo <input type="checkbox" name="percorsoMinimo" checked >
		   Verticale <input type="checkbox" name="verticale" >
	  </form>
	  </div>
      </footer>
	  ';

  ?>
  </div>

  <!-- scripts -->
<?php
  if ($_SESSION['level']>1) { 
		echo '<!-- bpmn-js modeler -->
			  <script src="bower_components/bpmn-js/dist/bpmn-modeler.js"></script>';
  } else {
		echo '<!-- bpmn-js viewer -->
			  <script src="bower_components/bpmn-js/dist/bpmn-viewer.js"></script>';
  }
?> 
<script>  
/**
  bpmn-js
*/
(function(BpmnModeler) {
  setInterval(function(){
      bpmnModeler.saveXML({ format: true }, function(err, xml) {
        if (err) {
          console.error('diagram save failed', err);
        } else {
          console.info('diagram saved');
          console.info(xml);
		  save(xml);
        }
      });
    }, 2000);
 
  // create modeler
  var bpmnModeler = new BpmnModeler({
    container: '#canvas'
  });
 
  function save(cosaSalvare) {
	  tx=document.getElementById("diagrammaXml");
	  tx.innerHTML = cosaSalvare;
  }

  // import function
  function importXML(xml) {
	bpmnModeler.importXML(xml, function(err) {
      if (err) {
        return console.error('could not import BPMN 2.0 diagram', err);
      }
      var canvas = bpmnModeler.get('canvas');
      canvas.zoom('fit-viewport');
	  
    });

  }


  <?php
	function normalizzaXml($diagramma){
		$search=array('"',"\n","\r","\r\n");
		$replac=array('\"','','','');
		$diagramma=str_replace($search, $replac, $diagramma);
		return $diagramma;
	}
	if (!empty($_POST['operazione']) && $_POST['operazione']=='Apri') {
		if (!empty($_POST["diagrammaXml"])) $diagramma=$_POST["diagrammaXml"];
		else $diagramma=file_get_contents($_FILES["diagrammaXml"]["tmp_name"]);
		$diagramma=normalizzaXml($diagramma);
	} else if (!empty($_POST['operazione']) && $_POST['operazione']=='Esempio1') {
		$diagramma='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_0b12kpc\"><participant id=\"Participant_05ymp70\" name=\"PA/AZIENDA\" processRef=\"Process_1rovhrn\" /></collaboration><process id=\"Process_1rovhrn\"><startEvent id=\"StartEvent_1ez4m6e\" name=\"INIZIO\"><outgoing>SequenceFlow_0qlmcgf</outgoing></startEvent><userTask id=\"Task_1jmm8o1\" name=\"Creazione primo utente amministratore e area di registrazione diagrammi\"><incoming>SequenceFlow_1fta2ue</incoming><outgoing>SequenceFlow_0u491zj</outgoing></userTask><callActivity id=\"Task_1vxtjgc\" name=\"REGISTRAZIONE al portale\"><incoming>SequenceFlow_0qlmcgf</incoming><outgoing>SequenceFlow_1fta2ue</outgoing></callActivity><sequenceFlow id=\"SequenceFlow_0qlmcgf\" sourceRef=\"StartEvent_1ez4m6e\" targetRef=\"Task_1vxtjgc\" /><sequenceFlow id=\"SequenceFlow_1fta2ue\" sourceRef=\"Task_1vxtjgc\" targetRef=\"Task_1jmm8o1\" /><sequenceFlow id=\"SequenceFlow_0zixyut\" sourceRef=\"Task_1kpim7v\" targetRef=\"EndEvent_1ueke7a\" /><sequenceFlow id=\"SequenceFlow_1aljj0d\" sourceRef=\"Task_1b90gaw\" targetRef=\"EndEvent_1ueke7a\" /><sequenceFlow id=\"SequenceFlow_0y25pfe\" sourceRef=\"Task_08tde1q\" targetRef=\"EndEvent_1ueke7a\" /><exclusiveGateway id=\"ExclusiveGateway_0z4wbh4\"><incoming>SequenceFlow_0u491zj</incoming><outgoing>SequenceFlow_0s0ky6i</outgoing><outgoing>SequenceFlow_0h6sfxe</outgoing><outgoing>SequenceFlow_1bwqscs</outgoing></exclusiveGateway><sequenceFlow id=\"SequenceFlow_0u491zj\" sourceRef=\"Task_1jmm8o1\" targetRef=\"ExclusiveGateway_0z4wbh4\" /><sequenceFlow id=\"SequenceFlow_0s0ky6i\" name=\"LIVELLO=3\" sourceRef=\"ExclusiveGateway_0z4wbh4\" targetRef=\"Task_1b90gaw\" /><sequenceFlow id=\"SequenceFlow_0h6sfxe\" sourceRef=\"ExclusiveGateway_0z4wbh4\" targetRef=\"Task_1kpim7v\" /><sequenceFlow id=\"SequenceFlow_1bwqscs\" sourceRef=\"ExclusiveGateway_0z4wbh4\" targetRef=\"Task_08tde1q\" /><task id=\"Task_1b90gaw\" name=\"Gestione utenti\"><incoming>SequenceFlow_0s0ky6i</incoming><outgoing>SequenceFlow_1aljj0d</outgoing></task><endEvent id=\"EndEvent_1ueke7a\" name=\"FINE\"><incoming>SequenceFlow_0zixyut</incoming><incoming>SequenceFlow_1aljj0d</incoming><incoming>SequenceFlow_0y25pfe</incoming></endEvent><task id=\"Task_1kpim7v\" name=\"Gestione diagrammi\"><incoming>SequenceFlow_0h6sfxe</incoming><outgoing>SequenceFlow_0zixyut</outgoing></task><task id=\"Task_08tde1q\" name=\"Gestione diagrammi Condivisi se P.A.\"><incoming>SequenceFlow_1bwqscs</incoming><outgoing>SequenceFlow_0y25pfe</outgoing></task></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_0b12kpc\"><bpmndi:BPMNShape id=\"Participant_05ymp70_di\" bpmnElement=\"Participant_05ymp70\"><omgdc:Bounds x=\"395\" y=\"44\" width=\"853\" height=\"471\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1ez4m6e_di\" bpmnElement=\"StartEvent_1ez4m6e\"><omgdc:Bounds x=\"444\" y=\"230\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"447\" y=\"269\" width=\"31\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0qlmcgf_di\" bpmnElement=\"SequenceFlow_0qlmcgf\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"480\" y=\"248\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"506\" y=\"248\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"493\" y=\"226.5\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1fta2ue_di\" bpmnElement=\"SequenceFlow_1fta2ue\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"606\" y=\"248\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"641\" y=\"248\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"623.5\" y=\"226.5\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"UserTask_0futdfd_di\" bpmnElement=\"Task_1jmm8o1\"><omgdc:Bounds x=\"641\" y=\"208\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"CallActivity_03s2mxj_di\" bpmnElement=\"Task_1vxtjgc\"><omgdc:Bounds x=\"506\" y=\"208\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_1b90gaw_di\" bpmnElement=\"Task_1b90gaw\"><omgdc:Bounds x=\"852\" y=\"104\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_1kpim7v_di\" bpmnElement=\"Task_1kpim7v\"><omgdc:Bounds x=\"852\" y=\"208\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_08tde1q_di\" bpmnElement=\"Task_08tde1q\"><omgdc:Bounds x=\"852\" y=\"320\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"EndEvent_1ueke7a_di\" bpmnElement=\"EndEvent_1ueke7a\"><omgdc:Bounds x=\"1062\" y=\"230\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1113\" y=\"241\" width=\"24\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0zixyut_di\" bpmnElement=\"SequenceFlow_0zixyut\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"952\" y=\"248\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1062\" y=\"248\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"962\" y=\"226.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1aljj0d_di\" bpmnElement=\"SequenceFlow_1aljj0d\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"952\" y=\"144\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1080\" y=\"144\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1080\" y=\"230\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"971\" y=\"122.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_0y25pfe_di\" bpmnElement=\"SequenceFlow_0y25pfe\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"952\" y=\"360\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1080\" y=\"360\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1080\" y=\"266\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"971\" y=\"338.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"ExclusiveGateway_0z4wbh4_di\" bpmnElement=\"ExclusiveGateway_0z4wbh4\" isMarkerVisible=\"true\"><omgdc:Bounds x=\"770.3658536585366\" y=\"223\" width=\"50\" height=\"50\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"795.3658536585366\" y=\"276\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0u491zj_di\" bpmnElement=\"SequenceFlow_0u491zj\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"741\" y=\"248\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"770\" y=\"248\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"755.5\" y=\"226\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_0s0ky6i_di\" bpmnElement=\"SequenceFlow_0s0ky6i\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"795\" y=\"223\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"795\" y=\"142\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"852\" y=\"142\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"780\" y=\"118\" width=\"57\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_0h6sfxe_di\" bpmnElement=\"SequenceFlow_0h6sfxe\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"820\" y=\"248\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"852\" y=\"248\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"791\" y=\"226.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1bwqscs_di\" bpmnElement=\"SequenceFlow_1bwqscs\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"795\" y=\"273\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"795\" y=\"360\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"852\" y=\"360\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"765\" y=\"310\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';	
	} else if (!empty($_POST['operazione']) && $_POST['operazione']=='Esempio2') {
		$diagramma='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_1n4rzdn\"><participant id=\"Participant_1hmd977\" name=\"Flusso\" processRef=\"Process_12njqzu\" /></collaboration><process id=\"Process_12njqzu\"><task id=\"Task_19ikj33\" name=\"taskA\"><incoming>SequenceFlow_0g102ur</incoming><outgoing>SequenceFlow_1glu2wy</outgoing></task><task id=\"Task_0rp5dd0\" name=\"taskB\"><incoming>SequenceFlow_1r8wu3t</incoming><outgoing>SequenceFlow_0ux8gzp</outgoing></task><task id=\"Task_1oslc8y\" name=\"taskAA\"><incoming>SequenceFlow_1glu2wy</incoming><outgoing>SequenceFlow_0lwnk4d</outgoing></task><task id=\"Task_0ol2dll\" name=\"taskBB\"><incoming>SequenceFlow_0ux8gzp</incoming><outgoing>SequenceFlow_1kt00kv</outgoing></task><task id=\"Task_1d0qlds\" name=\"taskBBB\"><incoming>SequenceFlow_1kt00kv</incoming><outgoing>SequenceFlow_0ou5tmc</outgoing></task><task id=\"Task_1rw584m\" name=\"taskBBBB\"><incoming>SequenceFlow_0ou5tmc</incoming><outgoing>SequenceFlow_03f6mup</outgoing></task><task id=\"Task_1deq58x\" name=\"taskAAA\"><incoming>SequenceFlow_0lwnk4d</incoming><outgoing>SequenceFlow_0cqmzi3</outgoing></task><sequenceFlow id=\"SequenceFlow_02t0yep\" sourceRef=\"StartEvent_1kyz244\" targetRef=\"ExclusiveGateway_0u53w8z\" /><sequenceFlow id=\"SequenceFlow_0g102ur\" sourceRef=\"ExclusiveGateway_0u53w8z\" targetRef=\"Task_19ikj33\" /><sequenceFlow id=\"SequenceFlow_1r8wu3t\" sourceRef=\"ExclusiveGateway_0u53w8z\" targetRef=\"Task_0rp5dd0\" /><sequenceFlow id=\"SequenceFlow_1glu2wy\" sourceRef=\"Task_19ikj33\" targetRef=\"Task_1oslc8y\" /><sequenceFlow id=\"SequenceFlow_0ux8gzp\" sourceRef=\"Task_0rp5dd0\" targetRef=\"Task_0ol2dll\" /><sequenceFlow id=\"SequenceFlow_0lwnk4d\" sourceRef=\"Task_1oslc8y\" targetRef=\"Task_1deq58x\" /><sequenceFlow id=\"SequenceFlow_1kt00kv\" sourceRef=\"Task_0ol2dll\" targetRef=\"Task_1d0qlds\" /><sequenceFlow id=\"SequenceFlow_0ou5tmc\" sourceRef=\"Task_1d0qlds\" targetRef=\"Task_1rw584m\" /><sequenceFlow id=\"SequenceFlow_03f6mup\" sourceRef=\"Task_1rw584m\" targetRef=\"EndEvent_0tmptwn\" /><sequenceFlow id=\"SequenceFlow_0cqmzi3\" sourceRef=\"Task_1deq58x\" targetRef=\"EndEvent_0tmptwn\" /><exclusiveGateway id=\"ExclusiveGateway_0u53w8z\"><incoming>SequenceFlow_02t0yep</incoming><outgoing>SequenceFlow_0g102ur</outgoing><outgoing>SequenceFlow_1r8wu3t</outgoing></exclusiveGateway><endEvent id=\"EndEvent_0tmptwn\"><incoming>SequenceFlow_03f6mup</incoming><incoming>SequenceFlow_0cqmzi3</incoming></endEvent><startEvent id=\"StartEvent_1kyz244\"><outgoing>SequenceFlow_02t0yep</outgoing></startEvent><association id=\"Association_09g968n\" sourceRef=\"Task_19ikj33\" targetRef=\"TextAnnotation_0dc0y7g\" /><association id=\"Association_09vumdt\" sourceRef=\"Task_1oslc8y\" targetRef=\"TextAnnotation_0joc4c4\" /><textAnnotation id=\"TextAnnotation_1sg6chy\"><text>tempo:30; costo:30;</text></textAnnotation><association id=\"Association_1g1x3a3\" sourceRef=\"Task_1deq58x\" targetRef=\"TextAnnotation_1sg6chy\" /><textAnnotation id=\"TextAnnotation_0dc0y7g\"><text>tempo:20; costo:20;</text></textAnnotation><textAnnotation id=\"TextAnnotation_0joc4c4\"><text>tempo:30; costo:30;</text></textAnnotation><textAnnotation id=\"TextAnnotation_0p6apjh\"><text>tempo:10; costo:20;</text></textAnnotation><association id=\"Association_0m48mp7\" sourceRef=\"Task_0rp5dd0\" targetRef=\"TextAnnotation_0p6apjh\" /><association id=\"Association_0btu7m9\" sourceRef=\"Task_0ol2dll\" targetRef=\"TextAnnotation_1r3gm2u\" /><association id=\"Association_03xut21\" sourceRef=\"Task_1d0qlds\" targetRef=\"TextAnnotation_1r3gm2u\" /><textAnnotation id=\"TextAnnotation_1875pzq\"><text>tempo:5; costo:300; Leo+20+2; Enrico+15+3; Elena+15+3;</text></textAnnotation><association id=\"Association_1s2i1en\" sourceRef=\"Task_1rw584m\" targetRef=\"TextAnnotation_1875pzq\" /><textAnnotation id=\"TextAnnotation_1r3gm2u\"><text>Leo+20+2; Enrico+20+1;</text></textAnnotation></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_1n4rzdn\"><bpmndi:BPMNShape id=\"Participant_1hmd977_di\" bpmnElement=\"Participant_1hmd977\"><omgdc:Bounds x=\"1563\" y=\"109\" width=\"937\" height=\"471\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1kyz244_di\" bpmnElement=\"StartEvent_1kyz244\"><omgdc:Bounds x=\"1634\" y=\"282\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1607\" y=\"321\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"ExclusiveGateway_0u53w8z_di\" bpmnElement=\"ExclusiveGateway_0u53w8z\" isMarkerVisible=\"true\"><omgdc:Bounds x=\"1742\" y=\"275\" width=\"50\" height=\"50\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1722\" y=\"328\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_19ikj33_di\" bpmnElement=\"Task_19ikj33\"><omgdc:Bounds x=\"1904\" y=\"207\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0g102ur_di\" bpmnElement=\"SequenceFlow_0g102ur\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"1792\" y=\"300\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1880\" y=\"300\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1880\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1904\" y=\"247\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1850\" y=\"267\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_0rp5dd0_di\" bpmnElement=\"Task_0rp5dd0\"><omgdc:Bounds x=\"1904\" y=\"350\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1r8wu3t_di\" bpmnElement=\"SequenceFlow_1r8wu3t\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"1792\" y=\"300\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1880\" y=\"300\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1880\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1904\" y=\"390\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1850\" y=\"338.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_02t0yep_di\" bpmnElement=\"SequenceFlow_02t0yep\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"1670\" y=\"300\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1742\" y=\"300\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1661\" y=\"278.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1oslc8y_di\" bpmnElement=\"Task_1oslc8y\"><omgdc:Bounds x=\"2036\" y=\"207\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1glu2wy_di\" bpmnElement=\"SequenceFlow_1glu2wy\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2004\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2036\" y=\"247\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1975\" y=\"225\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_0ol2dll_di\" bpmnElement=\"Task_0ol2dll\"><omgdc:Bounds x=\"2028\" y=\"350\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0ux8gzp_di\" bpmnElement=\"SequenceFlow_0ux8gzp\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2004\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2028\" y=\"390\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"1971\" y=\"368\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"EndEvent_0tmptwn_di\" bpmnElement=\"EndEvent_0tmptwn\"><omgdc:Bounds x=\"2397\" y=\"229\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2370\" y=\"268\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_1d0qlds_di\" bpmnElement=\"Task_1d0qlds\"><omgdc:Bounds x=\"2147\" y=\"350\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1kt00kv_di\" bpmnElement=\"SequenceFlow_1kt00kv\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2128\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2147\" y=\"390\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2093\" y=\"368\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1rw584m_di\" bpmnElement=\"Task_1rw584m\"><omgdc:Bounds x=\"2278\" y=\"350\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0ou5tmc_di\" bpmnElement=\"SequenceFlow_0ou5tmc\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2247\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2278\" y=\"390\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2218\" y=\"368\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_03f6mup_di\" bpmnElement=\"SequenceFlow_03f6mup\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2378\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2415\" y=\"390\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2415\" y=\"265\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2351.5\" y=\"368.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1deq58x_di\" bpmnElement=\"Task_1deq58x\"><omgdc:Bounds x=\"2167\" y=\"207\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0lwnk4d_di\" bpmnElement=\"SequenceFlow_0lwnk4d\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2136\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2167\" y=\"247\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2107\" y=\"225\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_0cqmzi3_di\" bpmnElement=\"SequenceFlow_0cqmzi3\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2267\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2332\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2332\" y=\"247\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2397\" y=\"247\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"2302\" y=\"240.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_0dc0y7g_di\" bpmnElement=\"TextAnnotation_0dc0y7g\"><omgdc:Bounds x=\"1904\" y=\"147\" width=\"100\" height=\"38\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_09g968n_di\" bpmnElement=\"Association_09g968n\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"1954\" y=\"207\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1954\" y=\"185\" /></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_0joc4c4_di\" bpmnElement=\"TextAnnotation_0joc4c4\"><omgdc:Bounds x=\"2036\" y=\"147\" width=\"101\" height=\"37\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_09vumdt_di\" bpmnElement=\"Association_09vumdt\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2086\" y=\"207\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2087\" y=\"184\" /></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_1sg6chy_di\" bpmnElement=\"TextAnnotation_1sg6chy\"><omgdc:Bounds x=\"2167\" y=\"147\" width=\"100\" height=\"38\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_1g1x3a3_di\" bpmnElement=\"Association_1g1x3a3\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2217\" y=\"207\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2217\" y=\"185\" /></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_0p6apjh_di\" bpmnElement=\"TextAnnotation_0p6apjh\"><omgdc:Bounds x=\"1904\" y=\"459\" width=\"101\" height=\"46\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_0m48mp7_di\" bpmnElement=\"Association_0m48mp7\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"1954\" y=\"430\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"1955\" y=\"459\" /></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_1r3gm2u_di\" bpmnElement=\"TextAnnotation_1r3gm2u\"><omgdc:Bounds x=\"2047\" y=\"459\" width=\"102\" height=\"45\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_0btu7m9_di\" bpmnElement=\"Association_0btu7m9\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2087\" y=\"430\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2093\" y=\"459\" /></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"Association_03xut21_di\" bpmnElement=\"Association_03xut21\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2154\" y=\"427\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2116\" y=\"459\" /></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"TextAnnotation_1875pzq_di\" bpmnElement=\"TextAnnotation_1875pzq\"><omgdc:Bounds x=\"2278\" y=\"467\" width=\"109\" height=\"79\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"Association_1s2i1en_di\" bpmnElement=\"Association_1s2i1en\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"2330\" y=\"430\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"2331\" y=\"467\" /></bpmndi:BPMNEdge></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';	
	} else if (!empty($_POST['operazione']) && $_POST['operazione']=='Esempio3') {
		$diagramma='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_1n4rzdn\"><participant id=\"Participant_1hmd977\" processRef=\"Process_12njqzu\" /></collaboration><process id=\"Process_12njqzu\"><startEvent id=\"StartEvent_1kyz244\" name=\"INIZIO\"><outgoing>SequenceFlow_077019a</outgoing></startEvent><exclusiveGateway id=\"ExclusiveGateway_1nrmomp\" name=\"gatewai 1\"><incoming>SequenceFlow_077019a</incoming><outgoing>SequenceFlow_0lve1hw</outgoing><outgoing>SequenceFlow_1fhs831</outgoing><outgoing>SequenceFlow_0o29d3r</outgoing></exclusiveGateway><sequenceFlow id=\"SequenceFlow_077019a\" sourceRef=\"StartEvent_1kyz244\" targetRef=\"ExclusiveGateway_1nrmomp\" /><task id=\"Task_0g5h05l\" name=\"task A1\"><incoming>SequenceFlow_0lve1hw</incoming><outgoing>SequenceFlow_1dd8vgv</outgoing></task><sequenceFlow id=\"SequenceFlow_0lve1hw\" name=\"linea1\" sourceRef=\"ExclusiveGateway_1nrmomp\" targetRef=\"Task_0g5h05l\" /><task id=\"Task_0ll3smv\" name=\"task B1\"><incoming>SequenceFlow_1fhs831</incoming><outgoing>SequenceFlow_0dki2gp</outgoing></task><sequenceFlow id=\"SequenceFlow_1fhs831\" name=\"linea2\" sourceRef=\"ExclusiveGateway_1nrmomp\" targetRef=\"Task_0ll3smv\" /><sequenceFlow id=\"SequenceFlow_1dd8vgv\" sourceRef=\"Task_0g5h05l\" targetRef=\"Task_17ru00k\" /><task id=\"Task_04mmu1l\" name=\"task B2\"><incoming>SequenceFlow_0dki2gp</incoming><outgoing>SequenceFlow_1uao553</outgoing></task><sequenceFlow id=\"SequenceFlow_0dki2gp\" sourceRef=\"Task_0ll3smv\" targetRef=\"Task_04mmu1l\" /><sequenceFlow id=\"SequenceFlow_0o29d3r\" sourceRef=\"ExclusiveGateway_1nrmomp\" targetRef=\"Task_1t25o19\" /><sequenceFlow id=\"SequenceFlow_1l2hhpf\" sourceRef=\"Task_1t25o19\" targetRef=\"Task_0ifssgj\" /><sequenceFlow id=\"SequenceFlow_1kdrw8l\" sourceRef=\"Task_1ittryc\" targetRef=\"EndEvent_00wcejf\" /><sequenceFlow id=\"SequenceFlow_1gtzrfb\" sourceRef=\"Task_00k226f\" targetRef=\"EndEvent_00wcejf\" /><sequenceFlow id=\"SequenceFlow_1myl3as\" sourceRef=\"Task_17ru00k\" targetRef=\"Task_1p81cn0\" /><sequenceFlow id=\"SequenceFlow_1s1bbwn\" sourceRef=\"Task_1p81cn0\" targetRef=\"EndEvent_00wcejf\" /><task id=\"Task_17ru00k\" name=\"task A2\"><incoming>SequenceFlow_1dd8vgv</incoming><outgoing>SequenceFlow_1myl3as</outgoing></task><task id=\"Task_1p81cn0\" name=\"task A3\"><incoming>SequenceFlow_1myl3as</incoming><outgoing>SequenceFlow_1s1bbwn</outgoing></task><sequenceFlow id=\"SequenceFlow_1lwkfa7\" sourceRef=\"Task_0ifssgj\" targetRef=\"ExclusiveGateway_1q3wf6a\" /><sequenceFlow id=\"SequenceFlow_19qz7o9\" name=\"SI\" sourceRef=\"ExclusiveGateway_1q3wf6a\" targetRef=\"Task_1ittryc\" /><sequenceFlow id=\"SequenceFlow_153q8zl\" name=\"NO\" sourceRef=\"ExclusiveGateway_1q3wf6a\" targetRef=\"Task_00k226f\" /><task id=\"Task_1t25o19\" name=\"task C1\"><incoming>SequenceFlow_0o29d3r</incoming><outgoing>SequenceFlow_1l2hhpf</outgoing></task><task id=\"Task_0ifssgj\" name=\"task C2\"><incoming>SequenceFlow_1l2hhpf</incoming><outgoing>SequenceFlow_1lwkfa7</outgoing></task><task id=\"Task_00k226f\" name=\"task C3B\"><incoming>SequenceFlow_153q8zl</incoming><outgoing>SequenceFlow_1gtzrfb</outgoing></task><exclusiveGateway id=\"ExclusiveGateway_1q3wf6a\" name=\"gatewai 2\"><incoming>SequenceFlow_1lwkfa7</incoming><outgoing>SequenceFlow_19qz7o9</outgoing><outgoing>SequenceFlow_153q8zl</outgoing></exclusiveGateway><sequenceFlow id=\"SequenceFlow_1uao553\" sourceRef=\"Task_04mmu1l\" targetRef=\"EndEvent_00wcejf\" /><endEvent id=\"EndEvent_00wcejf\" name=\"FINE\"><incoming>SequenceFlow_1kdrw8l</incoming><incoming>SequenceFlow_1gtzrfb</incoming><incoming>SequenceFlow_1s1bbwn</incoming><incoming>SequenceFlow_1uao553</incoming></endEvent><task id=\"Task_1ittryc\" name=\"task C3A\"><incoming>SequenceFlow_19qz7o9</incoming><outgoing>SequenceFlow_1kdrw8l</outgoing></task></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_1n4rzdn\"><bpmndi:BPMNShape id=\"Participant_1hmd977_di\" bpmnElement=\"Participant_1hmd977\"><omgdc:Bounds x=\"100\" y=\"66\" width=\"859\" height=\"433\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1kyz244_di\" bpmnElement=\"StartEvent_1kyz244\"><omgdc:Bounds x=\"141\" y=\"169\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"144\" y=\"208\" width=\"31\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"ExclusiveGateway_1nrmomp_di\" bpmnElement=\"ExclusiveGateway_1nrmomp\" isMarkerVisible=\"true\"><omgdc:Bounds x=\"226\" y=\"162\" width=\"50\" height=\"50\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"258\" y=\"206\" width=\"51\" height=\"26\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_077019a_di\" bpmnElement=\"SequenceFlow_077019a\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"177\" y=\"187\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"226\" y=\"187\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"201.5\" y=\"165\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_0g5h05l_di\" bpmnElement=\"Task_0g5h05l\"><omgdc:Bounds x=\"337\" y=\"86\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0lve1hw_di\" bpmnElement=\"SequenceFlow_0lve1hw\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"162\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"337\" y=\"126\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"215\" y=\"129\" width=\"31\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_0ll3smv_di\" bpmnElement=\"Task_0ll3smv\"><omgdc:Bounds x=\"337\" y=\"189\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1fhs831_di\" bpmnElement=\"SequenceFlow_1fhs831\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"212\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"337\" y=\"229\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"215\" y=\"268\" width=\"31\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_17ru00k_di\" bpmnElement=\"Task_17ru00k\"><omgdc:Bounds x=\"480\" y=\"86\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1dd8vgv_di\" bpmnElement=\"SequenceFlow_1dd8vgv\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"437\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"459\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"459\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"480\" y=\"126\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"429\" y=\"119.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"EndEvent_00wcejf_di\" bpmnElement=\"EndEvent_00wcejf\"><omgdc:Bounds x=\"827\" y=\"211\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"833\" y=\"250\" width=\"24\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_04mmu1l_di\" bpmnElement=\"Task_04mmu1l\"><omgdc:Bounds x=\"466\" y=\"189\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0dki2gp_di\" bpmnElement=\"SequenceFlow_0dki2gp\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"437\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"466\" y=\"229\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"451.5\" y=\"207\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1t25o19_di\" bpmnElement=\"Task_1t25o19\"><omgdc:Bounds x=\"337\" y=\"307\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_0o29d3r_di\" bpmnElement=\"SequenceFlow_0o29d3r\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"212\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"251\" y=\"347\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"337\" y=\"347\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"221\" y=\"273\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_0ifssgj_di\" bpmnElement=\"Task_0ifssgj\"><omgdc:Bounds x=\"466\" y=\"307\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1l2hhpf_di\" bpmnElement=\"SequenceFlow_1l2hhpf\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"437\" y=\"347\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"466\" y=\"347\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"406.5\" y=\"325.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1ittryc_di\" bpmnElement=\"Task_1ittryc\"><omgdc:Bounds x=\"660\" y=\"257\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"Task_00k226f_di\" bpmnElement=\"Task_00k226f\"><omgdc:Bounds x=\"660\" y=\"374\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1kdrw8l_di\" bpmnElement=\"SequenceFlow_1kdrw8l\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"760\" y=\"297\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"785\" y=\"297\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"785\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"827\" y=\"229\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"755\" y=\"256.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1gtzrfb_di\" bpmnElement=\"SequenceFlow_1gtzrfb\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"760\" y=\"414\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"785\" y=\"414\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"785\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"827\" y=\"229\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"755\" y=\"315\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"Task_1p81cn0_di\" bpmnElement=\"Task_1p81cn0\"><omgdc:Bounds x=\"630\" y=\"86\" width=\"100\" height=\"80\" /></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1myl3as_di\" bpmnElement=\"SequenceFlow_1myl3as\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"580\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"606\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"606\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"630\" y=\"126\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"576\" y=\"119.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1s1bbwn_di\" bpmnElement=\"SequenceFlow_1s1bbwn\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"730\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"845\" y=\"126\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"845\" y=\"211\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"742.5\" y=\"104.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNShape id=\"ExclusiveGateway_1q3wf6a_di\" bpmnElement=\"ExclusiveGateway_1q3wf6a\" isMarkerVisible=\"true\"><omgdc:Bounds x=\"592\" y=\"322\" width=\"50\" height=\"50\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"634\" y=\"354\" width=\"51\" height=\"26\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape><bpmndi:BPMNEdge id=\"SequenceFlow_1lwkfa7_di\" bpmnElement=\"SequenceFlow_1lwkfa7\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"566\" y=\"347\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"592\" y=\"347\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"534\" y=\"325.5\" width=\"90\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_19qz7o9_di\" bpmnElement=\"SequenceFlow_19qz7o9\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"617\" y=\"322\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"617\" y=\"297\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"660\" y=\"297\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"626\" y=\"303\" width=\"12\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_153q8zl_di\" bpmnElement=\"SequenceFlow_153q8zl\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"617\" y=\"372\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"617\" y=\"414\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"660\" y=\"414\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"623\" y=\"387\" width=\"18\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge><bpmndi:BPMNEdge id=\"SequenceFlow_1uao553_di\" bpmnElement=\"SequenceFlow_1uao553\"><di:waypoint xsi:type=\"omgdc:Point\" x=\"566\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"697\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"697\" y=\"229\" /><di:waypoint xsi:type=\"omgdc:Point\" x=\"827\" y=\"229\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"712\" y=\"222.5\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNEdge></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';	
	} else {
		$diagramma='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_1n4rzdn\"><participant id=\"Participant_1hmd977\" processRef=\"Process_12njqzu\" /></collaboration><process id=\"Process_12njqzu\"><startEvent id=\"StartEvent_1kyz244\" /></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_1n4rzdn\"><bpmndi:BPMNShape id=\"Participant_1hmd977_di\" bpmnElement=\"Participant_1hmd977\"><omgdc:Bounds x=\"100\" y=\"66\" width=\"600\" height=\"250\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1kyz244_di\" bpmnElement=\"StartEvent_1kyz244\"><omgdc:Bounds x=\"141\" y=\"169\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"159\" y=\"208\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>';
	}
  ?>
  var diagramXML = "<?php echo $diagramma; ?>";
  // import xml
  importXML(diagramXML);

})(window.BpmnJS);  

function stampa(divID) {
	window.print();
}
</script>  

</body>
</html>