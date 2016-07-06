<?php

class Post {

    public $PostID;
    public $Creato;
    public $Modificato;
    public $UtenteID;
    public $Titolo;
    public $Contenuto;
    public $Utente; # oggetto di classe Utente corrispondente
    private static $nome_tabella = 'posts';

    public static function GetAll(Database $db) {
        try {
//            $query="SELECT posts.*,utenti.Creato AS UCreato,utenti.Modificato AS UModificato,NomeUtente,Nome,Cognome, FROM posts ".
//                    "JOIN utenti USING(UtenteID) ".
//                    "ORDER BY posts.Creato DESC";
            $query = "SELECT * FROM " . self::$nome_tabella . " " .
                    "ORDER BY Creato DESC";
            $posts = $db->executeQuery($query);
            $data = array();
            foreach ($posts as $post) :
                $p = new Post;
                foreach ($post as $prop => $valore) :
                    $p->$prop = $valore;
                endforeach;
                $p->Utente = Utente::LeggiUtente($db, $p->UtenteID);
                $data[] = $p;
            endforeach;
            return $data;
        } catch (Exception $e) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    public static function CreaNuovoPost(Database $db, array $parametri) {
        try {
            $parametri['titolo'] = str_replace("'", "''", $parametri['titolo']);
            $parametri['contenuto'] = str_replace("'", "''", $parametri['contenuto']);
            $query = "INSERT INTO " . self::$nome_tabella .
                    "(Creato,UtenteID,Titolo,Contenuto) VALUES " .
                    "(NOW(),{$parametri['utenteid']},'{$parametri['titolo']}','{$parametri['contenuto']}')";
            $db->executeQuery($query);
            return true;
        } catch (Exception $e) {
            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

    public static function EliminaPostDiUtente(Database $db, $utenteid) {
        try {
            $query = "DELETE FROM " . self::$nome_tabella . " WHERE UtenteID=" . (int) $utenteid;
            $db->executeQuery($query);
            return true;
        } catch (Exception $e) {
            throw $e;
//            return $e->getMessage() . ' (' . $e->getCode() . ')';
        }
    }

}
