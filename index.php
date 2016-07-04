<?php
$title = 'Titolo della mia pagina';
?>

<html>
    <!-- header html -->
    <?php require './head.php'; ?>
    <body>

        <!-- barra di navigazione -->
        <?php require './navbar.php'; ?>

        <div>
            <?php if (count($array) > 0) : ?>

                <ul>

                    <?php foreach ($array as $k => $elemento) : ?>

                        <li><?= "$k : $elemento"; ?></li>;

                    <?php endforeach; ?>

                </ul>

            <?php else : ?>

                <p >Non ci sono elementi nell'array</p>

            <?php endif; ?>

        </div>
    </body>
</html>
