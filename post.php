<?php

require_once './classes/Database.php';
require_once './classes/Utente.php';
require_once './classes/Post.php';

$title = 'Posts';
$db = new Database('localhost', 'root', 'antani1234', 'utenti');
$utenti = Utente::GetAll($db);
$messaggio = null;
if (count($_POST) > 0) :
    # query di insert
    # restituire true oppure stringa di errore
    $ok = Post::CreaNuovoPost($db, $_POST);
    $messaggio = (is_string($ok) ? 'Impossibile creare il post: ' . $ok : 'Post creato!');
endif;
$posts = Post::GetAll($db);

require './views/post-view.php';
?>
