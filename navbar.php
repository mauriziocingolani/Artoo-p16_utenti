<!-- class="active" -->
<?php
$page = $_SERVER['SCRIPT_NAME'];

function active($link) {
    if ($link == $page) :
        echo 'active';
    endif;
}
?>


<a class="<?php active('/ArtooP16-Utenti/index.php'); ?>" href="/ArtooP16-Utenti/index.php">Home</a>
-
<a class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ArtooP16-Utenti/utenti.php') echo 'active'; ?>" href="/ArtooP16-Utenti/utenti.php">Utenti</a>
-
<a class="<?php if ($_SERVER['SCRIPT_NAME'] == '/ArtooP16-Utenti/post.php') echo 'active'; ?>" href="/ArtooP16-Utenti/post.php">Post</a>