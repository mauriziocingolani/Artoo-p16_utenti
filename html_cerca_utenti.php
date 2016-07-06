<?php
/* @var $utenti Utente[] */
?>

<?php if (is_string($utenti)) : ?>

    <span style="color: red;"><?= $utenti; ?></span>

<?php else : ?>

    <?php if (count($utenti) > 0) : ?>

        <ul>
            <?php foreach ($utenti as $elemento) : ?>
                <li>
                    <a href="/ArtooP16-Utenti/utente.php?utenteid=<?= $elemento->UtenteID; ?>">
                        <?= $elemento->NomeUtente; ?>
                    </a>                
                </li>
            <?php endforeach; ?>
        </ul>

    <?php else : ?>

        <em>La ricerca non ha prodotto risultati.</em>

    <?php endif; ?>

<?php endif; ?>
