<?php

class Ruolo {

    public $RuoloID;
    public $Nome;
    public $Colore;
    private static $nome_tabella = 'ruoli';

    public static function GetAll(Database $db) {
        $records = $db->executeQuery("SELECT * FROM " . self::$nome_tabella);
        $data = array();
        foreach ($records as $n => $obj) :
            $a = new Ruolo;
            $a->RuoloID = $obj->RuoloID;
            $a->Nome = $obj->Nome;
            $a->Colore = $obj->Colore;
            $data[] = $a;
        endforeach;
        return $data;
    }

}
