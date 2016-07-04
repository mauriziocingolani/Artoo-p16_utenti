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
        try {
            $parametri['nomeutente'] = self::CleanString($parametri['nomeutente']);
            $parametri['nome'] = self::CleanString($parametri['nome']);
            $parametri['cognome'] = self::CleanString($parametri['cognome']);
            $parametri['email'] = self::CleanString($parametri['email']);
            $query = "INSERT INTO " . self::$nome_tabella . " (Creato,RuoloID,NomeUtente,Nome,Cognome,Email,Abilitato) " .
                    "VALUES (NOW(),{$parametri['ruolo']},'{$parametri['nomeutente']}','{$parametri['nome']}'," .
                    " '{$parametri['cognome']}','{$parametri['email']}'," .
                    (isset($parametri['abilitato']) ? 1 : 0) .
                    ")";
            $db->executeQuery($query);
            return true;
        } catch (Exception $e) {
            switch ($e->getCode()) :
                case 1062:
                    return "Nome utente già utilizzato!";
                default :
                    return $e->getMessage() . ' (' . $e->getCode() . ')';
            endswitch;
        }
    }

    public static function LeggiUtente(Database $db, $utenteid) {
        try {
            $query = "SELECT * FROM utenti WHERE UtenteID=" . (int) $utenteid;
            $record = $db->executeQuery($query);
            $utente = null;
            foreach ($record as $r) :
                $utente = new Utente;
                foreach ($r as $prop => $valore) :
                    $utente->$prop = $valore;
                endforeach;
            endforeach;
            return $utente;
        } catch (Exception $ex) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    private static function CleanString($string) {
        return str_replace("'", "''", $string);
    }

}
