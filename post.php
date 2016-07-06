<?php

require_once './classes/Database.php';
require_once './classes/Post.php';

$title = 'Posts';
$db = new Database('localhost', 'root', 'antani1234', 'utenti');
if (count($_POST) > 0) :

endif;
$posts = Post::GetAll($db);

require './views/post-view.php';
?>
