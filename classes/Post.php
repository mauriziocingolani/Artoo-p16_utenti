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
            $query = "SELECT * FROM " . self::$nome_tabella . " " .
                    "ORDER BY Creato DESC";
            $posts = $db->executeQuery($query);
            $data = array();
            foreach ($posts as $post) :
                $p = new Post;
                foreach ($post as $prop => $valore) :
                    $p->$prop = $valore;
                endforeach;
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

}
