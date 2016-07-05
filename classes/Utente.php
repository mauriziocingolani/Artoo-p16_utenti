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

    public static function CreaOAggiornaUtente(Database $db, array $parametri) {
        try {
            $parametri['nomeutente'] = self::CleanString($parametri['nomeutente']);
            $parametri['nome'] = self::CleanString($parametri['nome']);
            $parametri['cognome'] = self::CleanString($parametri['cognome']);
            $parametri['email'] = self::CleanString($parametri['email']);
            if (isset($parametri['utenteid']) && (int) $parametri['utenteid'] > 0) :
                $query = "UPDATE " . self::$nome_tabella . " " .
                        "SET " .
                        "Ruoloid=" . (int) $parametri['ruolo'] . "," .
                        "NomeUtente='{$parametri['nomeutente']}'," .
                        "Nome='{$parametri['nome']}'," .
                        "Cognome='{$parametri['cognome']}'," .
                        "Email='{$parametri['email']}'," .
                        "Abilitato=" . (isset($parametri['abilitato']) ? 1 : 0) . " " .
                        "WHERE UtenteID=" . (int) $parametri['utenteid'];
                $db->executeQuery($query);
                $_SESSION['messaggio_utente'] = 'OK!!! Utente aggiornato!';
                return (int) $parametri['utenteid'];
            else :
                $query = "INSERT INTO " . self::$nome_tabella . " (Creato,RuoloID,NomeUtente,Nome,Cognome,Email,Abilitato) " .
                        "VALUES (NOW(),{$parametri['ruolo']},'{$parametri['nomeutente']}','{$parametri['nome']}'," .
                        " '{$parametri['cognome']}','{$parametri['email']}'," .
                        (isset($parametri['abilitato']) ? 1 : 0) .
                        ")";
                $db->executeQuery($query);
                $_SESSION['messaggio_utente'] = 'OK!!! Utente creato!';
                return (int) $db->insert_id;
            endif;
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
        } catch (Exception $e) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    public static function GetAll(Database $db) {
        try {
            $query = "SELECT * FROM v_utenti";
            $utenti = $db->executeQuery($query);
            $data = array();
            foreach ($utenti as $u) :
                $obj = new stdClass;
                $obj->UtenteID = $u->UtenteID;
                $obj->NomeUtente = $u->NomeUtente;
                $obj->Abilitato = $u->Abilitato;
                $obj->Descrizione = $u->Descrizione;
                $data[] = $obj;
            endforeach;
            return $data;
        } catch (Exception $e) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    public static function EliminaUtente(Database $db, $utenteid) {
        try {
            $query = "DELETE FROM " . self::$nome_tabella . " WHERE UtenteID=" . (int) $utenteid;
            $db->executeQuery($query);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    private static function CleanString($string) {
        return str_replace("'", "''", $string);
    }

}
