<!-- 
$title : titolo della pagina 
$utenti : array di utenti oppure stringa
$messaggi : eventuale messaggio di errore o successo
-->

<html>
    <!-- header html -->
    <?php require './head.php'; ?>
    <body>

        <!-- barra di navigazione -->
        <?php require './navbar.php'; ?>

        <!-- form post -->
        <?php if (is_array($utenti) && count($utenti) > 0) : ?>

            <?php if ($messaggio != null) : ?>
                <div class="message"><?= $messaggio; ?></div>
            <?php endif; ?>

            <form action="" method="post">
                <!-- campo utente -->
                <label>Utente</label>
                <select name="utenteid">
                    <?php foreach ($utenti as $u) : ?>
                        <option value="<?= $u->UtenteID; ?>">
                            <?= $u->NomeUtente; ?>
                        </option>
                    <?php endforeach; ?>
                </select><br />
                <!-- campo titolo -->
                <label>Titolo</label>
                <input name="titolo" type="text" />
                <br />
                <!-- campo contenuto -->
                <label>Contenuto</label>
                <textarea name="contenuto" rows="3" cols="50"></textarea>
                <br />
                <!-- pulsante -->
                <button class="submit" type="submit">Crea post</button>
            </form>

        <?php else : ?>

            <em>Lista utenti non disponibile... :-(</em>

        <?php endif; ?>

        <!-- lista post -->
        <?php if (is_array($posts)) : ?>

            <?php if (count($posts) > 0) : ?>

                <?php foreach ($posts as $p) : ?>
                    <div>
                        <?= $p->Utente->NomeUtente; ?> - <?= $p->Creato; ?>  
                        <br />
                        <h3><?= $p->Titolo; ?></h3>
                        <p><?= $p->Contenuto; ?></p>
                    </div>
                <?php endforeach; ?>

            <?php else : ?>

                <em>Nessun post da mostrare... :-(</em>

            <?php endif; ?>

        <?php else : ?>

            <div class="message">Lista post non disponibile: 
                <?= $posts; ?>
            </div>

        <?php endif; ?>

    </body>

    <?php
    $file = 'js/post.js';
    require_once './footer.php';
    ?>

</html>