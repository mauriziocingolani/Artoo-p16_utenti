<?php

$host = 'localhost';
$utente = 'root';
$password = 'antani1234';

require_once './Classes/Database.php';
require_once './Classes/Ruolo.php';

try {
    $a = new Database($host, $utente, $password);
    $databases = $a->getDatabases();
    $a->useDatabase('prova');
    $tables = $a->getTables();
    $ruoli = Ruolo::GetAll($a);
    var_dump($ruoli);
    $a->close();
} catch (Exception $e) {
    var_dump($e->getMessage() . ' (' . $e->getCode() . ')');
}
//if($a->connect_errno>0)
//    var_dump($a->connect_error);

//$a = @mysqli_connect($host, $utente, $password);
//if (mysqli_connect_errno() > 0)
//    var_dump (mysqli_connect_error ());

//$a = new mysqli($host, $utente, $password);
