<?php
require_once './classes/Database.php';
require_once './classes/Ruolo.php';
require_once './classes/Utente.php';

$db = new Database('localhost', 'root', 'antani1234', 'utenti');
$ruoli = Ruolo::GetAll($db);
$message = null;
$dati = null;
$nuovo = true;
if (count($_POST) > 0) :
    $dati = $_POST;
    $ok = Utente::CreaOAggiornaUtente($db, $_POST);
    if (isset($_POST['utenteid']) && (int) $_POST['utenteid'] > 0) :
        $nuovo = false;
    endif;
    if ($ok === true) :
        $message = "OK!!! Utente " . ($nuovo ? 'creato' : 'aggiornato') . '!';
    elseif (is_string($ok)) :
        $message = $ok;
    endif;
elseif (count($_GET) > 0) :
    $nuovo = false;
    $utente = Utente::LeggiUtente($db, $_GET['utenteid']); # oggetto di classe Utente
    $dati = array();
    $dati['ruolo'] = $utente->RuoloID;
    $dati['nomeutente'] = $utente->NomeUtente;
    $dati['nome'] = $utente->Nome;
    $dati['cognome'] = $utente->Cognome;
    $dati['email'] = $utente->Email;
    $dati['abilitato'] = $utente->Abilitato;
endif;

$title = 'Utente';
?>

<html>
    <!-- header html -->
    <?php require './head.php'; ?>
    <body>

        <!-- barra di navigazione -->
        <?php require './navbar.php'; ?>

        <div>

            <!-- div con messaggio di errore/successo -->
            <?php if (isset($message)) : ?>
                <div><?= $message; ?></div>
            <?php endif; ?>

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
                       <?php echo isset($dati['abilitato']) && (int) $dati['abilitato'] == 1 ? 'checked' : null ?> />
                <br />
                <button type="submit"><?php echo $nuovo ? 'Crea nuovo utente' : 'Aggiorna utente'; ?></button>
            </form>

        </div>

    </body>
</html>