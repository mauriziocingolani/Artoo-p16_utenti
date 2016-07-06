<?php

# restiruisce tutti i record della tabella utenti
# con valore del campo NomeUtente 'simile' al testo di ricerca
# restituisce array di oggetti di classe Utente

require_once './classes/Database.php';
require_once './classes/Utente.php';

$db = new Database('localhost', 'root', 'antani1234', 'utenti');
$utenti = Utente::CercaUtenti($db, $_GET);
$a = array(
    'error' => 0,
    'data' => null,
);
if (is_string($utenti)) :
    $a['error'] = $utenti;
else :
    $a['data'] = $utenti;
endif;
echo json_encode($a);
