<?php

class Utente {

    public $UtenteID;
    public $Creato;
    public $Modificato;
    public $RuoloID;
    public $NomeUtente;
    public $Nome;
    public $Cognome;
    public $Email;
    public $Abilitato;
    private static $nome_tabella = 'utenti';

    public static function CreaNuovoUtente(Database $db, array $parametri) {
        # creare la stringa con l'istruzione SQL che inserisce il nuovo record in base ai dati passati sul parametro $parametri
        $query = "INSERT INTO " . self::$nome_tabella . " (Created,RuoloID,NomeUtente,Nome,Cognome,Email,Abilitato) " .
                "VALUES (NOW(),{$parametri['ruolo']},'{$parametri['nomeutente']}','{$parametri['nome']}'," .
                " '{$parametri['cognome']}','{$parametri['email']}'," .
                (isset($parametri['abilitato']) ? 1 : 0) .
                ")";
        return $query;
    }

}
