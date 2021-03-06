<?php
require_once './classes/Database.php';
require_once './classes/Utente.php';

$db = new Database('localhost', 'root', 'antani1234', 'utenti');
$message = null;
if (count($_POST) > 0) :
    $ok = Utente::EliminaUtente($db, $_POST['utenteid']);
    $message = is_string($ok) ? 'Impossibile eliminare l\'utente: ' . $ok : 'Utente eliminato!';
endif;
$utenti = Utente::GetAll($db);
$title = 'Utenti';
?>

<html>
    <!-- header html -->
    <?php require './head.php'; ?>
    <body>

        <!-- barra di navigazione -->
        <?php require './navbar.php'; ?>

        <div>

            <?php if ($message) : ?>
                <div class="message"><?= $message; ?></div>
            <?php endif; ?>

            <p><a href="/ArtooP16-Utenti/utente.php">Nuovo utente</a></p>

            <!-- errore SQL -->
            <?php if (is_string($utenti)) : ?>

                <div style="color:red;">
                    Impossibile ottenere la lista degli utenti: <?= $utenti; ?>
                </div>

                <!-- lista utenti ok -->
            <?php elseif (is_array($utenti)) : ?>

                <!-- lista utenti piena -->
                <?php if (count($utenti) > 0) : ?>

                    <style>
                        tr.disabilitato {
                            background: red;
                        }
                    </style>

                    <table class="utenti">
                        <thead>
                            <tr>
                                <th>Utente</th>
                                <th>Ruolo</th>
                                <th />
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($utenti as $value) : ?>
                                <tr class="<?php if ($value->Abilitato == 0) echo 'disabilitato'; ?>">
                                    <td>
                                        <a href="/ArtooP16-Utenti/utente.php?utenteid=<?= $value->UtenteID; ?>">
                                            <?= $value->NomeUtente; ?>
                                        </a>
                                    </td>
                                    <td>
                                        <?= $value->Descrizione; ?>
                                    </td>
                                    <td>
                                        <form action="" method="post">
                                            <input name="utenteid" type="hidden" value="<?= $value->UtenteID; ?>" />
                                            <button class="delete_utente" type="submit">Elimina</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>

                    <!-- lista utenti vuota -->
                <?php else : ?>

                    <p><em>Non ci sono utenti nel database...</em></p>

                <?php endif; ?>

            <?php endif; ?>

        </div>

        <?php require './cerca_utenti.php'; ?>

    </body>

    <?php
    $file = 'js/utenti.js';
    require_once './footer.php';
    ?>

</html>
