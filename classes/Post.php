<?php

class Post {
    public $PostID;
    public $Creato;
    public $Modificato;
    public $UtenteID;
    public $Titolo;
    public $Contenuto;
    public $Utente; # oggetto di classe Utente corrispondente
    
    public static function GetAll(Database $db) {
        
    }
}