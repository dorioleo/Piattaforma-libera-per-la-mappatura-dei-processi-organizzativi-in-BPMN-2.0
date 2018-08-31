<html>
<head>
<link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon"/>
<!-- Bootstrap core CSS -->
<?php 
ini_set('default_charset', 'utf-8');

echo '
	<title>'.$name.'</title>
	<div class="no-print">
	<nav class="navbar navbar-inverse bg-primary navbar-expand-lg fixed-top">
	<div class="container-fluid">
		<ul class="nav navbar-nav">
			<li><a href="javascript:window.close()"><img src="./img/close.png" alt="back" width="40" height="40" border="0" /></a> &nbsp;  &nbsp;  &nbsp;  &nbsp;  &nbsp; &nbsp;  &nbsp;  &nbsp; </li>
			<li><a href="javascript:window.print()"><img src="./img/print.png" alt="print" id="print-button" width="40" height="40" border="0" /></a></li>
		</ul>
		<h1 align="center" style="color:white; "> &nbsp; BPMN 2.0</h1>
		<div style="color:white; ">&nbsp;  Utente: <strong>'.$utente.'</strong> &nbsp; - &nbsp; <strong>'.$_SESSION['denominazioneEnte'].'</strong></div>
	</div> 
	</nav>
	</div>';

echo '<div class="container">';
echo '<br /><h2 style="color:#0000e6;">'.substr($name,0,-4).'</h2>';

if (!empty($_POST['diagrammaServizio']))    echo '<div style="font-size:20px;">Area: <strong>'.$_POST['diagrammaServizio'].'</strong></div><br />';
if (!empty($_POST['diagrammaDescrizione'])) echo '<div style="font-size:20px;">Descrizione: <strong>'.$_POST['diagrammaDescrizione'].'</strong></div>';
  
  
function tempiCostiVal ($stringa,$cosa) {
	if ($cosa=='tempi') {
		$stringa=strtoupper($stringa); 
		$find=array(": "," M"," S"," O");
		$replace=array(":","M","S","O");
		$stringa=str_replace($find,$replace,$stringa);
		if (strpos($stringa,' ')>0) $fine=strpos($stringa,' ');
		else if (strpos($stringa,';')>0) $fine=strpos($stringa,';');
		else if (strpos($stringa,')')>0) $fine=strpos($stringa,')');
		else $fine=strlen($stringa);
		$subStringa=substr($stringa,0,$fine);
		$subStringa=str_replace(' ','',$subStringa);
		preg_match_all('!\d+!', $subStringa, $result);
		if (@$numero=$result[0][0]) {	 
			$valuta=substr($subStringa,strripos($subStringa,$numero)+strlen($numero),2);
			if (substr($valuta,0,1)=='G') $secondi=$numero*86400;
			else if (substr($valuta,0,1)=='O') $secondi=$numero*3600;
			else if (substr($valuta,0,1)=='M') $secondi=$numero*60;
			else if (substr($valuta,0,1)=='S') $secondi=$numero;
			else $secondi=0;
			return $secondi;
		} else return 0;
	} else {
		if (strpos($stringa,'€')) $subStringa=substr($stringa,0,strpos($stringa,'€'));
		else $subStringa=$stringa;
		$subStringa=str_replace(' ','',$subStringa);
		preg_match_all('!\d+!', $subStringa, $result);
		$numero=$result[0][0];	 
		return $numero;
	}	 
}
  
function secToStr($secs) {
	$r = '';
	if ($secs >= 86400) {
		$days = floor($secs/86400);
		$secs = $secs%86400;
		$r .= $days . ' giorni';
		if ($secs > 0) $r .= ', ';
	}
	if ($secs >= 3600) {
		$hours = floor($secs/3600);
		$secs = $secs%3600;
		$r .= $hours . ' ore';
		if ($secs > 0) $r .= ', ';
	}
	if ($secs>=60) {
		$minutes = floor($secs/60);
		$secs = $secs%60;
		$r .= $minutes . ' minuti';
		if ($secs > 0) $r .= ', ';
	}
	if ($secs>0) $r .=' '.$secs . ' secondi';
	return $r;
}



// stampa i diversi percorsi ricorsivamente
//------------------------------------------
/*
foreach ($xxx->children() as $child1) {
	if ($child1->getName()=='startEvent') {
		$findIncoming=false;
		$outgoingValue=array();
		foreach($child1->children() as $child2){
			if ($child2->getName()=='outgoing' ) $outgoingValue[]=$child2->__toString();
		}
		foreach($outgoingValue as $key => $incomingValue) {
			$percorsi= findName($xxx,$incomingValue,'');
		}
	}
}
function findName($yyy,$findIncoming,$percorso) {
	foreach ($yyy->children() as $child1) {
		$trovato=0;
		$arrayOutgoing=array();
		foreach($child1->children() as $child2 ){
			if ($child2->getName()=='incoming' && $child2->__toString()==$findIncoming) $trovato=1; 
			if ($child2->getName()=='outgoing')  {
				$arrayOutgoing[]=$child2->__toString();			
			}
		}
		if ($trovato==1 && !empty($arrayOutgoing) ) {
			if ($child1->getName()=='task') {
				echo ' ---><strong>'.$child1->getName().'</strong> '.$child1['name'];
			}	
			foreach($arrayOutgoing as $key => $incomingValue) {
				echo '<br>'.findName($yyy,$incomingValue,$percorso);
			}
		}
	}
}
*/
//------------------------------------------


// ricerca del percorso minimo algoritmo di Dijkstra
function dijkstra($graph_array, $source, $target) {
    $vertices = array();
    $neighbours = array();
    foreach ($graph_array as $edge) {
        array_push($vertices, $edge[0], $edge[1]);
        $neighbours[$edge[0]][] = array("end" => $edge[1], "cost" => $edge[2]);
        $neighbours[$edge[1]][] = array("end" => $edge[0], "cost" => $edge[2]);
    }
    $vertices = array_unique($vertices);
    foreach ($vertices as $vertex) {
        $dist[$vertex] = INF;
        $previous[$vertex] = NULL;
    }
    $dist[$source] = 0;
    $Q = $vertices;
    $verificaLoop=0;
	while (count($Q) > 0) {
		$verificaLoop++;
        $min = INF; 
 		foreach ($Q as $vertex){
		    
		    if ($dist[$vertex] < $min) {
                $min = $dist[$vertex];
 				$u = $vertex;
            }
        }
		$Q = array_diff($Q, array($u));
		if ($dist[$u] == INF or $u == $target) break;
		if (isset($neighbours[$u])) {
			foreach ($neighbours[$u] as $arr) {
				$alt = $dist[$u] + $arr["cost"];
				if ($alt < $dist[$arr["end"]]) {
					$dist[$arr["end"]] = $alt;
					$previous[$arr["end"]] = $u;
				}
			}
		}
      if ($verificaLoop>1000)  break;
	}
    $path = array();
    $u = $target;
    while (isset($previous[$u])) {
        array_unshift($path, $u);
        $u = $previous[$u];
    }
    array_unshift($path, $u);
    return $path;
}

// trasforma il file xml in un array per applicare la funzione di Dijkstra 
// passaggio del file xml e la parola chiave sulla quale quantificare il peso del nodo (il valoreTempo è il costo orario con chiave tutto)
function xmlToArray($xxx,$keyWord,$valoreTempo) {
	$arrayDj=array();
	foreach ($xxx->children() as $child1) {
		if ($child1->getName()!='laneSet' && $child1->getName()!='textAnnotation' && $child1->getName()!='sequenceFlow' && $child1->getName()!='extensionElements' ) {
			if ($child1->getName()=='startEvent') {
				foreach($child1->children() as $child2){
					if ($child2->getName()=='outgoing' ) { $outgoing=$child2->__toString(); $arrayDj[]=array("startEvent","$outgoing",1); } 
				}
			} 
			$tempo=$costo=1;
			$peso=0;
			if ($child1->getName()=='task' || $child1->getName()=='intermediateCatchEvent') {
				if ($keyWord=='tempo' || $keyWord=='tutto' ) $tempo=cercaAnnotation($xxx,$child1['id'],$keyWord);
				if ($keyWord=='costo' || $keyWord=='tutto' ) $costo=cercaAnnotation($xxx,$child1['id'],$keyWord); 
				if ($keyWord=='tempo' ) $peso=$tempo;
				else if ($keyWord=='costo' ) $peso=$costo;
					 else $peso=($tempo/3600)+$costo;  

			}
			
			$incoming=$outgoing='';
			foreach($child1->children() as $child2){
				if ($child2->getName()=='incoming' ) $incoming=$child2->__toString();
				if ($child2->getName()=='outgoing' ) $outgoing=$child2->__toString();
				if (!empty($incoming) && !empty($outgoing)) $arrayDj[]=array("$incoming","$outgoing",$peso); 
			}
			if ($child1->getName()=='endEvent') {
				foreach($child1->children() as $child2){
					if ($child2->getName()=='incoming' ) { $incoming=$child2->__toString(); $arrayDj[]=array("$incoming","endEvent",0); }
				}
			}
		}	
	}
	return $arrayDj;
}

// estrae il valore numerico da una stringa
function estraiValore($subStringa) {
	preg_match_all('!\d+!', $subStringa, $result);
	if (!empty($result[0][0])) $numero=$result[0][0];
	else $numero=0;
	return $numero;
}	

// explode e calcola i tempi e costi le parole devono essere separate da ;
//////// esempi di parole chiave /////////
// tempo:___;
// costo:___;
// risorsa:___ + costo orario:___   + ore:___ ;
// risorsa:___ + costo unitario:___ + qta:___ ;
// r:___ + co:___ + o:___ ;
// r:___ + cu:___ + q:___ ;
// r__ + ___ + ___
function calcolaPesi($text,$keyWord) {
	$tempi=$costi=0;
	$stringhe = explode(";", $text);
	foreach ($stringhe as $val) {
		if (strpos($val,'+')) {
			$subStringhe=explode("+", $val);
			$costoOrario=$costoUnitario=$qtaOre=0;
			if (!empty($subStringhe[1]) && !empty($subStringhe[2])) {
				$costoOrario=tempiCostiVal($subStringhe[1],'costi');
				$qtaOre=estraiValore($subStringhe[2]);
				$costi+=$costoOrario*$qtaOre;
			} 	
		} else {		
			if (($keyWord=='tempo' || $keyWord=='tutto' ) && strpos(strtolower($val),'empo:')) {
				$tempoOrario=tempiCostiVal(substr($val,(strpos(strtolower($val),'tempo:'))),'tempi');
				$tempi+=$tempoOrario;
			}
			if (($keyWord=='costo' || $keyWord=='tutto' ) && strpos(strtolower($val),'osto:')) { 
				$costi+=tempiCostiVal(substr($val,(strpos(strtolower($val),'costo:'))),'costi'); 
			}
		}
	}
		
	if ($keyWord =='tempo') return $tempi;
	else 				    return $costi;
}
	
// cerca le parole chiave nei nodi di annotazione
function cercaAnnotation ($xxx,$idTask,$keyWord) {
	$tempi=$costi=0;
	foreach ($xxx->children() as $child ) {
		if ($child->getName()=='association' && trim($child['sourceRef'])==trim($idTask)) {
			foreach ($xxx->children() as $child1) {
				if ($child1->getName()=='textAnnotation' && trim($child1['id'])==trim($child['targetRef'])) {
					$child2=$child1->children();
					if ($keyWord=='tempo') $tempi+=calcolaPesi($child2->__toString(),$keyWord);
					else 				   $costi+=calcolaPesi($child2->__toString(),$keyWord);
				}	
			}
		}
	}
	if ($keyWord=='tempo') return $tempi;
	else 				   return $costi;	
}

// costruisce il percorso  
function descriviPercorso ($xxx,$keyWord,$valoreTempo) {
	$txtPath='';
	if (($keyWord=='tempo' || $keyWord=='tutto' ) && empty($valoreTempo)) $valoreTempo=0; // valore di default 0€ orari 
	$graph_array=xmlToArray($xxx,$keyWord,$valoreTempo);
	if ($path = dijkstra($graph_array,"startEvent","endEvent")) {
		$tempi=$costi=0;
		$txtPath.=strtoupper($keyWord).': <strong>Start Event</strong>';
		foreach($path as $key => $value) {
			foreach ($xxx->children() as $child1) {
				foreach($child1->children() as $child2) {
					if ($child2->getName()=='incoming' && $child2->__toString()==$value) {
						$txtPath.=' --> <strong>'.ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0',$child1->getName())).'</strong> '.$child1['name'];
						
						if ($child1->getName()=='task' || $child1->getName()=='intermediateCatchEvent') {
							if ($keyWord=='tempo') $tempi+=cercaAnnotation($xxx,$child1['id'],$keyWord);
							else 				   $costi+=cercaAnnotation($xxx,$child1['id'],$keyWord);					
						}
					}	 
				}
				
				
			}	
		}
		if ($txtPath=='TEMPO: <strong>Start Event</strong>') $txtPath='';
		else {
			$txtPath.=' <div style="color:blue;">';
			if ($keyWord=='tempo' && !empty($tempi)) $txtPath.='TOT. TEMPO: <strong>'.secToStr($tempi).'</strong>'; 
			if ($keyWord=='costo' && !empty($costi)) $txtPath.='TOT. COSTO: <strong>'.$costi.'€</strong>';
			if ($keyWord=='tutto' && (!empty($tempi) || !empty($costi))) $txtPath.='TOT. COSTO e TEMPO: <strong>'.round($costi,2).'€</strong>';
			$txtPath.='</div>';
		}
	}
	return $txtPath;
}


// controlla che il diagramma non è vuoto
if ($output!='<?xml version=\"1.0\" encoding=\"UTF-8\"?><definitions xmlns=\"http://www.omg.org/spec/BPMN/20100524/MODEL\" xmlns:bpmndi=\"http://www.omg.org/spec/BPMN/20100524/DI\" xmlns:omgdc=\"http://www.omg.org/spec/DD/20100524/DC\" xmlns:xsi=\"http://www.w3.org/2001/XMLSchema-instance\" xmlns:di=\"http://www.omg.org/spec/DD/20100524/DI\" targetNamespace=\"\" xsi:schemaLocation=\"http://www.omg.org/spec/BPMN/20100524/MODEL http://www.omg.org/spec/BPMN/2.0/20100501/BPMN20.xsd\"><collaboration id=\"Collaboration_1n4rzdn\"><participant id=\"Participant_1hmd977\" processRef=\"Process_12njqzu\" /></collaboration><process id=\"Process_12njqzu\"><startEvent id=\"StartEvent_1kyz244\" /></process><bpmndi:BPMNDiagram id=\"sid-74620812-92c4-44e5-949c-aa47393d3830\"><bpmndi:BPMNPlane id=\"sid-cdcae759-2af7-4a6d-bd02-53f3352a731d\" bpmnElement=\"Collaboration_1n4rzdn\"><bpmndi:BPMNShape id=\"Participant_1hmd977_di\" bpmnElement=\"Participant_1hmd977\"><omgdc:Bounds x=\"100\" y=\"66\" width=\"600\" height=\"250\" /></bpmndi:BPMNShape><bpmndi:BPMNShape id=\"StartEvent_1kyz244_di\" bpmnElement=\"StartEvent_1kyz244\"><omgdc:Bounds x=\"141\" y=\"169\" width=\"36\" height=\"36\" /><bpmndi:BPMNLabel><omgdc:Bounds x=\"159\" y=\"208\" width=\"0\" height=\"13\" /></bpmndi:BPMNLabel></bpmndi:BPMNShape></bpmndi:BPMNPlane><bpmndi:BPMNLabelStyle id=\"sid-e0502d32-f8d1-41cf-9c4a-cbb49fecf581\"><omgdc:Font name=\"Arial\" size=\"11\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle><bpmndi:BPMNLabelStyle id=\"sid-84cb49fd-2f7c-44fb-8950-83c3fa153d3b\"><omgdc:Font name=\"Arial\" size=\"12\" isBold=\"false\" isItalic=\"false\" isUnderline=\"false\" isStrikeThrough=\"false\" /></bpmndi:BPMNLabelStyle></bpmndi:BPMNDiagram></definitions>') 
{	

// riduce il file xml racchiuso tra i tag <process>
$diagrammaO=$output;
$diagrammaOO=substr($diagrammaO,strpos($diagrammaO,'<process'),strpos($diagrammaO,'<bpmndi'));
$diagrammaOO=substr($diagrammaOO,0,strpos($diagrammaOO,'</process>')+10);

// calcolo del percorso minimo
if (!empty($_POST['percorsoMinimo'])) {
	if (substr_count($diagrammaOO,'</process') > 1) {
		echo '<br />';
		echo substr_count($diagrammaOO,'</process').' Processi esecutivi; separare per il calcolo del percorso minimo';
		echo '<br />';
	} else if (substr_count($diagrammaOO,'<startEvent') > 1) {
		echo '<br />';
		echo ' Più eventi Start; unire per il calcolo del percorso minimo';
		echo '<br />';
	} else { 
		try {
			$xxx = @new SimpleXMLElement($diagrammaOO); 
			echo '<br />';
			if (descriviPercorso($xxx,'tempo','')=='') {
				echo 'PERCORSO MINIMO non definito possibile ciclo.<br />';
			} else {
				echo 'PERCORSO MINIMO in:';
				echo '<ul>';
				echo '<li>'.descriviPercorso($xxx,'tempo','').'</li>';
				echo '<li>'.descriviPercorso($xxx,'costo','').'</li>';
				echo '<li>'.descriviPercorso($xxx,'tutto',10).'</li>';
				echo '</ul>';
			}
		}catch (Exception $e) {
			echo $e;
		}
	}	
}



/////////////////////  
try {
  $sxe1 = @new SimpleXMLElement($output);
  $sxe2 = @new SimpleXMLElement($output);
  $sxe3 = @new SimpleXMLElement($output);
  $xxx = @new SimpleXMLElement($diagrammaOO); 
  
  $tempiTot=$costiTot=0;
  $bloccoBr='';
  foreach ($sxe1->children() as $child1) {
	if ($child1->getName()=='collaboration') {
		echo '<br /><div style="font-size:20px;">Collaboration:</div><ul>';
		foreach ($child1->children() as $subChild1) {
			if ($subChild1->getName()=='participant') {
				
				echo '<li/><strong>'.ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0',$subChild1->getName())).'</strong> - '.$subChild1['name'];
				$tempi=$costi=0;
				if (strpos($output,'<laneSet>')>0) {
					foreach ($sxe2->children() as $child2) {
						if (trim($child2['id'])==$subChild1['processRef'] ) {
							echo '<ul>';
								foreach ($child2->children() as $subChild2) {
									if ($subChild2->getName()=='laneSet') {
										foreach ($subChild2->children() as $subChild3) {
											echo '<ul>'.$subChild3['name'];
											foreach ($subChild3->children() as $subChild4) {
												foreach ($sxe3->children() as $child3) {
													foreach ($child3->children() as $subChild31) {
														
														if (trim($subChild31['id'])==$subChild4->__toString() ) {
															echo '<li/><strong>'.ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0',$subChild31->getName())).'</strong> - '.$subChild31['name'].'</li>';
															$bloccoBr.='<br />';
															if ($subChild31->getName()=='task' || $subChild31->getName()=='intermediateCatchEvent') {
																$tempi+=cercaAnnotation($xxx,$subChild31['id'],'tempo');
																$costi+=cercaAnnotation($xxx,$subChild31['id'],'costo');					
															}
														}	
													}	
												}	
											}
											echo '<div style="color:blue;">';
											if ($tempi>0) { echo 'TEMPO: <strong>'.secToStr($tempi).'</strong>'; $tempiTot+=$tempi; }
											if ($costi>0) { echo ' &nbsp; COSTO: <strong>'.$costi.'€</strong>'; $costiTot+=$costi; }
											echo '</div>';
											echo '</ul>';
										}	
									} 
								}
							echo '</ul>';
						}	
					}
					
				} else {
					foreach ($sxe2->children() as $child2) {
						if (trim($child2['id'])==$subChild1['processRef'] ) {
							echo '<ul>';
							
							foreach ($child2->children() as $subChild2) {
								if (!empty($subChild2['name'])) { 
									echo '<li/><strong>'.ucfirst(preg_replace('/(?<!\ )[A-Z]/', ' $0',$subChild2->getName())).'</strong> - '.$subChild2['name'].'</li>';
									$bloccoBr.='<br />';
									if ($subChild2->getName()=='task' || $subChild2->getName()=='intermediateCatchEvent') {
										$tempi+=cercaAnnotation($xxx,$subChild2['id'],'tempo');
										$costi+=cercaAnnotation($xxx,$subChild2['id'],'costo');					
									}	
								}
							}
							echo '<div style="color:blue;">';
							if ($tempi>0) { echo 'TEMPO: <strong>'.secToStr($tempi).'</strong>'; $tempiTot+=$tempi; }
							if ($costi>0) { echo ' &nbsp; COSTO: <strong>'.$costi.'€</strong>'; $costiTot+=$costi; }
							echo '</div>';
							echo '</ul>';
						}	
					}
				}		
				echo '</li>';
			}
		}
		echo '<br /><div style="color:blue;">';
		if ($tempiTot>0) echo 'TOT. TEMPO: <strong>'.secToStr($tempiTot).'</strong>';
		if ($costiTot>0) echo ' &nbsp; COSTO: <strong>'.$costiTot.'€</strong>';
		echo '</div>';
		echo '</ul>';
	}	
  }
} catch (Exception $e) {
	echo 'anomalia lettura file XML';
} 

  
?>
  	
  <style type="text/css">
    
	#canvas { width:100%; height:100%; margin:0px; border:0; overflow:hidden; display:block; }
	
	ul {
		display: block;
		list-style-type: disc;
		margin-top: 1em;
		margin-bottom: 1em;
		margin-left: 0;
		margin-right: 0;
		padding-left: 100px;
	}		
	
	
	@media print {    
		.no-print, .no-print * { display: none;	}
		@page {	size: auto;}	
	}

	div.orizzontale {
		width: 100%;
		height: 90%;  
		padding: 10px; 
	}
	
	div.verticale {
		width: 90%;
		height: 90%;
		position:relative;
		right:200px; 
		
		-ms-transform: rotate(90deg); /* IE 9 */
		-webkit-transform: rotate(90deg); /* Safari 3-8 */
		transform: rotate(90deg);
		margin:0px;
		padding:0px;
	}

	
  </style>
	<link rel="stylesheet" href="bower_components/bpmn-js/dist/assets/diagram-js.css">
    <link rel="stylesheet" href="bower_components/bpmn-js/dist/assets/bpmn-font/css/bpmn-embedded.css">
	<?php 
	 
	if (isset($_POST['verticale'])) {
		echo '</div>';
		echo '<br style="page-break-before:always" />';
		echo '<div class="container" id="verticale" padding:0; "> 
				<div class="verticale">
					<div id="canvas"></div>
				</div>
			  </div>';
	} else {
		echo '</div><br /><br /><br /><br /><br /><br />';
		echo '<br style="page-break-before:always" />';
		echo '<div id="orizzontale"> 
				<div class="orizzontale">
					<div id="canvas"></div>
				</div>
			  </div>';	
	}
	?>
	<script src="bower_components/bpmn-js/dist/bpmn-viewer-print.js"></script>
	<script>  

	(function(BpmnModeler) {
	  // create modeler
	  var bpmnModeler = new BpmnModeler({
		container: '#canvas'
	  });
	  // import function
	  function importXML(xml) {
		// import diagram
		bpmnModeler.importXML(xml, function(err) {
		  var canvas = bpmnModeler.get('canvas');
		  canvas.zoom('fit-viewport');
		});
	  }
	  <?php
		$diagramma=$output;
		$search=array('"',"\n","\r","\r\n");
		$replac=array('\"','','','');
		$diagramma=str_replace($search, $replac, $diagramma);
	  ?>
	  var diagramXML = "<?php echo $diagramma; ?>";
	  // import xml
	  importXML(diagramXML);

	})(window.BpmnJS);

	</script>
<?php 
} else echo '<div align="center" class="alert alert-info"><h3>Diagramma Vuoto o Non Salvato</h3></div>';
?>
