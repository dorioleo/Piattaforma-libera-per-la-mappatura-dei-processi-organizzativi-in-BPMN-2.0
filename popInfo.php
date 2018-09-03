<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BPMN">
    <meta name="author" content="Dorio Leonardo">

    <title>BPMN</title>
    <link rel="shortcut icon" href="./img/favicon.png" type="image/x-icon"/>
    
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- Custom styles -->
    <link rel="stylesheet" href="./small-business.css">
    <link rel="stylesheet" href="./style.css">

	
  </head>

  <body>
<?php

$progetto=$servizi=$contatti=$scopo=$noteLegali='';
switch ($_GET['visualizza']) {
    case 'Progetto': $progetto=' class="activePage" '; break;
	case 'Servizi':  $servizi=' class="activePage" ';  break;
	case 'Scopo':    $scopo=' class="activePage" ';    break;
	case 'Contatti': $contatti=' class="activePage" '; break;
	case 'noteLegali': $noteLegali=' class="activePage" '; break;
}	
?>
  
    <!-- Navigation -->
    <!-- <nav class="navbar navbar-expand-lg navbar-dark fixed-top" > -->
    <br /><br /><br />
	<nav class="navbar navbar-inverse bg-primary navbar-expand-lg fixed-top">  
	  <div class="container">
        <a class="navbar-brand" href="https://www.uniupo.it"><img src="img/UPO.png" width="90" height="45" border="0" /></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        
		<div id="top-menu">
		  <ul class="nav menu nav-pills topmenu ml-auto">
					<li>
					  <a class="nav-link" href="index.html">Home
						<span class="sr-only">(current)</span>
					  </a>
					</li>
					<li <?php echo $progetto; ?> >
					  <a class="nav-link" href="popInfo.php?visualizza=Progetto">Progetto</a>
					</li>
					<li <?php echo $servizi; ?> >
					  <a class="nav-link" href="popInfo.php?visualizza=Servizi">Servizi</a>
					</li>
					<li <?php echo $scopo; ?> >
					  <a class="nav-link" href="popInfo.php?visualizza=Scopo">Scopo</a>
					</li>					
					<li <?php echo $contatti; ?>>
					  <a class="nav-link" href="popInfo.php?visualizza=Contatti">Contatti</a>
					</li>
					<li <?php echo $noteLegali; ?>>
					  <a class="nav-link" href="popInfo.php?visualizza=noteLegali">Note Legali</a>
					</li>

					<li class="nav-item">
						<div class="icon-circle"> &nbsp; &nbsp; &nbsp; 
							<a href="https://www.facebook.com/bpmn.bpmn.52" class="ifacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a>
							<a href="https://www.linkedin.com" class="iLinkedin" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a>
						</div>					
					</li>
					
		  </ul>
		</div>		
		
      </div>
    </nav>
<?php
switch ($_GET['visualizza']) {
    case 'Progetto':
?>
	<div style="width:95%;" class="container">
		<div class="account-wall" style="padding-left:50px;">
		<h3>Piattaforma libera per la mappatura dei processi organizzativi in BPMN 2.0</h3>
		<br />
		<h4>
		Realizzata nel Project Work del Master in Management del Software Libero.
		<br /><br />
		Dott. Leonardo Dorio (Ambito Tecnologico) 
		<br /> 
		Dott. Enrico Fava (Ambito Organizzativo)
		<br /> 
		Dott.ssa Elena Giusta (Ambito Giuridico)
		<br /><br />
		Direttore del Master: Prof. Roberto Candiotto
		<br /><br />
		Tutor di formazione e supporto al progetto:
		<ul>
			<li>Prof. Antonio Servetti (ambito Tecnologico)</li>
			<li>Prof. Leonardo Favario (ambito Tecnologico)</li>
			<li>Prof.ssa Silvia Gandini (ambito Economico)</li>
			<li>Prof.ssa Barbara Veronese (ambito Giuridico)</li>
		</ul>
		<br /><br />
		Descrizione Tecnica
		<br />
		La piattaforma include e adatta uno strumento libero (<a href="https://bpmn.io/license/" target="_blank">bpmn-js</a>) di modellazione di Camunda.
		La stampa/visualizzazione dei modelli definisce gli attori dei singoli processi 
		e permette di determinare il percorso minimo (in termini di tempo e costo) attraverso il riconoscimento di parole chiave nelle notazioni economiche dei task.  
		</h4>
		</div>
	</div>
<?php
	break;
	case 'Servizi':
?>
	<div style="width:95%;" class="container">
		<div class="account-wall" style="padding-left:50px;">
		<h3>Piattaforma libera per la mappatura dei processi organizzativi in BPMN 2.0</h3>
		<br />
		<h4>
Si rivolge alla Pubblica amministrazione ma anche alle aziende private 
che vogliano illustrare i propri processi sia per scopi conoscitivi e applicativi 
all'intero della propria organizzazione sia per fini comunicativi rivolti all'esterno, 
ad esempio in relazione agli obblighi di trasparenza e anticorruzione di cui al 
<a href="http://www.gazzettaufficiale.it/eli/id/2013/04/05/13G00076/sg" target="_blank">D. Lgs 33/2013</a> 
e alla <a href="http://www.gazzettaufficiale.it/eli/id/2012/11/13/012G0213/sg" target="_blank">L. 190/2012</a>.
<br />
In questi anni l’<a href="http://www.anticorruzione.it/portal/public/classic/" target="_blank">ANAC</a> (Autorità Nazionale Anticorruzione) 
ha ribadito più volte l’importanza di mappare i processi in relazione alle misure anticorruzione 
perchè  “la mappatura assume carattere strumentale a fini dell’identificazione, 
della valutazione e del trattamento dei rischi corruttivi”  
(consulta i <a href="http://www.anticorruzione.it/portal/public/classic/AttivitaAutorita/Anticorruzione/PianoNazionaleAnticorruzione" target="_blank">Piani nazionali Anticorruzione e le linee di indirizzo adottati annualmente dall’Autorità</a>)

		<br /><br />
		Puoi usare la piattaforma senza registrazione per creare i tuoi schemi di processo che potrai salvare in locale.
Se decidi di registrarti, potrai avvalerti dei servizi aggiuntivi finalizzati a: 
		<br />
		<ul>
			<li>Creazione/archiviazione dei modelli BPMN </li>
			<li>Gestione degli utenti con accesso differenziato (visualizzatore, creatore e amministratore)</li>
			<li>Condivisione (solo per le P.A.) dei modelli</li>
			<li>Creazione e salvataggi in locale dei modelli</li>
			<li>Riconoscimento di parole chiave nelle notazioni delle attività (in tempo, costo e risorse) per il calcolo del percorso minimo</li>
		</ul>
		</h4>
		</div>
	</div>
<?php
	break;
	case 'noteLegali':
?>

	<div style="width:95%;" class="container">
		<div class="account-wall" style="padding-left:50px;">
		<h3>Piattaforma libera per la mappatura dei processi organizzativi in BPMN 2.0</h3>
		<br />
		<h4>La piattaforma viene fornita "cosi' com'è", senza garanzie di alcun tipo, esplicite o implicite, ivi incluse, in via esemplificativa, le garanzie di commerciabilità, idoneità a un fine particolare e non violazione dei diritti altrui. In nessun caso gli autori potranno essere ritenuti responsabili per qualsiasi reclamo, danno e/o altro tipo di responsabilità, a seguito di azione contrattuale, illecito o altro, derivante da o in connessione alla piattaforma, al suo utilizzo o ad altre operazioni con la stessa.
		</h4>
		</div>
	</div>
<?php
	break;
	case 'Scopo':
?>

	<div style="width:95%;" class="container">
		<div class="account-wall" style="padding-left:50px;">
		<h3>Piattaforma libera per la mappatura dei processi organizzativi in BPMN 2.0</h3>
		<br />
		<h4>
			Perche' e' utile modellare un processo?
			<br /><br />
			Modellare un processo esistente (AS IS) consente di verificare l’aderenza del proprio agire ad una prescrizione normativa, ad un assetto organizzativo ovvero ad una procedura aziendale, identificare gli eventuali punti di debolezza e definire percorsi di riorganizzazione e reingegnerizzazione dei processi aziendali (TO BE), anche in  relazione alla loro eventuale informatizzazione.   
			<br /><br />
			Non basta descriverlo in un testo?
			<br /><br />
			Mappare un processo e' un approccio di sintesi, di visione unitaria che non si sostituisce ad un elaborato descrittivo ma che ne supera i limiti; descrivere testualmente un processo infatti:
			<ul>
			<li/>- non consente uno sguardo di insieme
			<li/>- non consente di individuare con immediatezza le fasi in cui si costituisce il processo
			<li/>- non supera i limiti linguistici di chi ne puo' potenzialmente fruire 
			<li/>- richiede normalmente molto tempo sia di redazione che di lettura, oltre che di aggiornamento.
			</ul>
			<br />
			Perche' il linguaggio BPMN?
			<br /><br />
			Il linguaggio BPMN, acronimo di Business Modeling Process Notation,  e' un linguaggio internazionale e standardizzato basato su pochi simboli che, combinati tra loro, consentono di descrivere qualsiasi processo appartenente a qualsiasi area aziendale.
			<br />
			I simboli base sono 4: un cerchio, un rettangolo, un rombo, una freccia. 
			Consente di comunicare un'elevata quantita' di informazioni a un'ampia platea d'interlocutori.
			<br /><br />
			
			Specifiche giuridiche:
			<br /><br />
			<ul>
				<li/>Il sistema si basa su un’architettura web, e il web server libero adottato è Apache HTTP Server, o più comunemente Apache (da cui prende il nome) con licenza di software libero Apache V. 2.0 compatibile con licenza GPL scritta dalla Apache Software Foundation (ASF); 
				<li/>La parte applicativa (lato server) è stata implementata con linguaggio di scripting PHP (acronimo di Hypertext Preprocessor - preprocessore di ipertesti) le cui librerie sono distribuite sotto la PHP License V. 3.01, licenza open source, certificata da Open Source Initiative (OSI), licenza in stile BSD (Berkeley Software Distribution);
				<li/>Il modulo che consente il disegno dei diagrammi denominato bpmn-js è stato scaricato da github (la più ampia community di open source) ed è rilasciato dalla comunità Camunda con lo strumento del dual licensing, la versione community, che è stata utilizzata, è in licenza Apache V. 2.0 con il vincolo di mantenere il suo logo all’interno dell’opera derivata (è stato mantenuto dove utilizzato);
				<li/>Per l’aspetto grafico è stato utilizzato il framework Bootstrap (raccolta di strumenti liberi per la creazione di siti e applicazioni per il web, compatibile con tutti i browser) rilasciato sotto licenza accademica MIT, ideata dal Massachussetts Institute of technology.
			</ul>
			Si evince che tutte le licenze utilizzate: la licenza Apache 2.0 del modulo bpmn-js e del web server Apache, la licenza MIT del framework boostrap e la licenza PHP v. 3.1 BSD-style appartengono alla famiglia delle licenze open source permissive; non presentano politiche conservative (copyleft debole) e non sono in conflitto fra loro.
			<br /><br />
			La piattaforma è stata rilasciata con licenza da definire e il codice sorgente (sviluppato con componenti e linguaggi open) è stato caricato nel repository open condiviso "github" al link <a href="https://github.com/dorioleo/Piattaforma-libera-per-la-mappatura-dei-processi-organizzativi-in-BPMN-2.0" target="_blank"> 
	
		</h4>
		</div>
	</div>
<?php
	break;
	case 'Contatti':
	if (empty($_GET['operazione'])) { 
	  	$formMail='<form method="get" action="popInfo.php">
					<input type="hidden" name="visualizza" value="Contatti" >
					<input type="hidden" name="operazione" value="sendMail" >
					<div class="row">
						<div class="col-sm-12 form-group">
							<label for="message"> Messaggio:</label>
							<textarea class="form-control" type="textarea" name="message" id="message" maxlength="6000" rows="7"></textarea>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-6 form-group">
							<label for="name"> Nome:</label>
							<input type="text" class="form-control" id="name" name="name" required>
						</div>
						<div class="col-sm-6 form-group">
							<label for="email"> Email:</label>
							<input type="email" class="form-control" id="email" name="email" required>
						</div>
					</div>
					<div class="row" style="font-size:medium" align="center">
					<div class="col-sm-12 form-group">
					il nome e l\'indirizzo mail che hai indicato saranno utilizzati esclusivamente per rispondere alle tue richieste
					</div>
					</div>
					<div class="row">
						<div class="col-sm-12 form-group" align="center">
							<button type="submit" class="btn btn-primary btn-lg" >Invia a &rarr; bpmn.help@gmail.com</button>
						</div>
					</div>
				</form>';
		echo '<div style="width:95%;" class="container">
				  <div class="account-wall" style="padding-left:50px;">
				  <h3>Piattaforma libera per la mappatura dei processi organizzativi in BPMN 2.0</h3>
				  <br /><h4>'.$formMail.'<br /></h4>
				  </div>
			  </div>';				
	} else {
		require_once('class.phpmailer.php');
		$destinatario = 'bpmn.help@gmail.com';
		$nomeDestinatario = 'bpmn-help';
		$mittente = $_GET['email'];
		$messaggio = $_GET['message'];
		$nomeMittente = $_GET['name'];
		$oggetto='Richiesta da contatti BPMN';
		$corpoMessaggio=$oggetto;
		$mail=new PHPMailer();
		$mail->Port = 465;
		$mail->SMTPSecure = "ssl";
		$mail->IsSMTP();
		$mail->SMTPDebug = 1;
		$mail->Debugoutput = 'html';
		$mail->Host = "smtp.gmail.com";
		$mail->SMTPAuth = true;
		$mail->Username = "gruppo@gmail.com";
		$mail->Password = "---------";
		$mail->Body = $messaggio;
		$mail->WordWrap = 50;
		$mail->IsHTML(true);
		$mail->Sender = $mittente; 
		$mail->setFrom($mittente, $nomeMittente);
		$mail->addAddress($destinatario, $nomeDestinatario);
		$mail->addAddress('secondo.destinatario@gmail.com', $nomeDestinatario);
		// $mail->addReplyTo('....@.it', 'Rispondi A');
		$mail->Subject = $oggetto;
		$mail->msgHTML($messaggio);
		$mail->AltBody = $corpoMessaggio;
		// $mail->AddAttachment($allegatoLocale);
		if (!$mail->send()) {
			echo '<br /><br /><br /><h3><div class="alert alert-success">Errore Invio Messaggio</div>'.$mail->ErrorInfo.'</h3>';
		} else {
			echo '<br /><br /><br /><h3><div class="alert alert-success">Messaggio inviato correttamente la sua richiesta è stata presa in carico</div></h3>';
		}

	}
	
	break;
}
?>
</body>
</html>	
