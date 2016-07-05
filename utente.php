<?php
require_once './classes/Database.php';
require_once './classes/Ruolo.php';
require_once './classes/Utente.php';

session_start();
$db = new Database('localhost', 'root', 'antani1234', 'utenti');
$ruoli = Ruolo::GetAll($db);
$message = null;
$dati = null;
$nuovo = true;
$errore = null;
if (count($_POST) > 0) : # esecuzione POST
    $dati = $_POST;
    $ok = Utente::CreaOAggiornaUtente($db, $_POST);
    if (isset($_POST['utenteid']) && (int) $_POST['utenteid'] > 0) :
        $nuovo = false;
    endif;
    if ($ok === true) :
        $_SESSION['messaggio_utente'] = "OK!!! Utente " . ($nuovo ? 'creato' : 'aggiornato') . '!';
        if ($nuovo) :
            header("Location: /ArtooP16-Utenti/utente.php?utenteid=" . ($nuovo ? $db->insert_id : $_POST['utenteid']));
        endif;
    elseif (is_string($ok)) :
        $message = $ok;
    endif;
else : # non esecuzione di una POST
    if (isset($_GET['utenteid'])) :
        $utente = Utente::LeggiUtente($db, $_GET['utenteid']); # oggetto di classe Utente
        if ($utente == null) :
            $errore = "ERRORE: utente inesistente...";
        elseif (is_string($utente)) :
            $errore = "ERRORE: " . $utente;
        else :
            $nuovo = false;
            $dati = array();
            $dati['ruolo'] = $utente->RuoloID;
            $dati['nomeutente'] = $utente->NomeUtente;
            $dati['nome'] = $utente->Nome;
            $dati['cognome'] = $utente->Cognome;
            $dati['email'] = $utente->Email;
            $dati['abilitato'] = $utente->Abilitato;
        endif;
    endif;
endif;

$title = 'Utente';
?>

<html>
    <!-- header html -->
    <?php
    require './head.php';
    ?>
    <body>

        <!-- barra di navigazione -->
        <?php require './navbar.php'; ?>

        <div>

            <!-- div con messaggio di errore/successo -->
            <?php if (isset($message)) : ?>
                <div><?= $message; ?></div>
            <?php endif; ?>
            <?php if (isset($_SESSION['messaggio_utente'])) : ?>
                <div>
                    <?php
                    echo $_SESSION['messaggio_utente'];
                    unset($_SESSION['messaggio_utente']);
                    ?>
                </div>
            <?php endif; ?>

            <?php if ($errore == null) : var_dump($dati); ?>
                <!-- form -->
                <form action="" method="post">
                    <input name="utenteid" type="hidden"
                           value="<?php echo isset($_GET['utenteid']) ? $_GET['utenteid'] : null; ?>" />
                    <label>Ruolo</label>
                    <select name="ruolo">

                        <?php foreach ($ruoli as $ruolo) : ?>
                            <option value="<?php echo $ruolo->RuoloID; ?>"
                                    <?php echo isset($dati['ruolo']) && $ruolo->RuoloID == $dati['ruolo'] ? 'selected="selected"' : null; ?>>
                                        <?php echo $ruolo->Descrizione; ?>
                            </option>
                        <?php endforeach; ?>

                    </select><br />
                    <label>Nome utente</label>
                    <input name="nomeutente" type="text" 
                           value="<?php echo isset($dati['nomeutente']) ? $dati['nomeutente'] : null; ?>" /><br />
                    <label>Nome</label>
                    <input name="nome" type="text"
                           value="<?php echo isset($dati['nome']) ? $dati['nome'] : null; ?>" /><br />
                    <label>Cognome</label>
                    <input name="cognome" type="text"
                           value="<?php echo isset($dati['cognome']) ? $dati['cognome'] : null; ?>" /><br />
                    <label>Email</label>
                    <input name="email" type="text" 
                           value="<?php echo isset($dati['email']) ? $dati['email'] : null; ?>" /><br />
                    <label for="abilitato">Abilitato</label>
                    <input id="abilitato" name="abilitato" type="checkbox" 
                           <?php echo isset($dati['abilitato']) && $dati['abilitato'] ? 'checked' : null ?> />
                    <br />
                    <button type="submit"><?php echo $nuovo ? 'Crea nuovo utente' : 'Aggiorna utente'; ?></button>
                </form>
            <?php else : ?>
                <div style="color: red;"><?= $errore; ?></div>
            <?php endif; ?>

        </div>

    </body>
</html>