# Piattaforma-libera-per-la-mappatura-dei-processi-organizzativi-in-BPMN-2.0

Vedi al link http://bpmn.uniupo.it/bpmn/index.html

Realizzata nel Project Work del Master in Management del Software Libero.

La piattaforma include e adatta uno strumento libero (bpmn-js) di modellazione di Camunda. La stampa/visualizzazione dei modelli definisce gli attori dei singoli processi e permette di determinare il percorso minimo (in termini di tempo e costo) attraverso il riconoscimento di parole chiave nelle notazioni economiche dei task. 

Si rivolge alla Pubblica amministrazione ma anche alle aziende private che vogliano illustrare i propri processi sia per scopi conoscitivi e applicativi all'intero della propria organizzazione sia per fini comunicativi rivolti all'esterno.

ISTRUZIONI DI INSTALLAZIONE:

  . installare il web-server APACHE con PHP v7.0 e character set UTF8
  
  . copiare l'intero progetto in una directory (visibile dal'esterno);
  
  . decomprimere i file compressi archivio.zip, users.zip, img.zip e bower_components.zip;
  
  . modificare gli account di posta per le comunicazioni nel file popInfo.php :
  
      alla riga 270 inserire l'indirizzo email della comunicazione
      alla riga 271 inserire la password email della comunicazione (il sistema per l'invio si appoggia al server smtp di google)
      alla riga 278 inserire eventuale indirizzo email che dovrà ricevere le comunicazioni.
	  
  . modificare/sostituire le immagini contenute nella cartella img (quelle presenti sono riferite al progetto di UNIUPO);
  
  . verificare i permessi di lettura/scrittura dei file: 
      quelli nella directory principale e nelle sotto-directory img e bower_components devono avere i permessi di lettura;
      quelli nelle sotto directory archivio e users devono avere anche il premesso in scrittura da parte dell'utente apache.
  
  ISTRUZIONI DI UTILIZZO:
  
    La gestione degli utenti avviene direttamente su file e la navigazione è controllata dalla sessione 
	
    L'utente ospite di default è "BPMN".
	
    In fase di registrazione degli utenti: 
      viene creata una directory in archivio che conterra i diagrammi XML dell'entita;
      nella directory users viene creato un file degli utenti (le password sono registrate in MD5);
	  
    Se erroneamente viene registrata un'ente o una società: 
      cancellare in users/entity.inc.php la corrispondente riga di dettaglio;
      cancellare in users il file degli utenti users.partitaIVA.php;
      cancellare sotto archivio la sotto directory di archiviazione archivio_partitaIVA
	  
    L'utente amministratore (di default il primo che fa la registrazione) può creare altri utenti con profilo di accesso uguale o inferiore sola lettura/gestione dei diagrammi.
	
    I diagrammi condivisi possono essere cancellati dal creatore del diagramma o possono essere modificati ricaricando con altro nome.
	
    Per modificare eventuali informazioni modificare la pagina popInfo.php.
	
    La pagina Guida.html contiene una guida sintetica del linguaggio di modellazione BPMN e di utilizzo della piattaforma

    Per modificare eventuali informazioni modificare la pagina popInfo.php.
    La pagina Guida.html contiene una guida sintetica del linguaggio di modellazione BPMN e di utilizzo della piattaforma
    
    
  
Dott. Leonardo Dorio 
