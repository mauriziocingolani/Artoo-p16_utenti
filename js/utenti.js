$('.delete_utente').on('click', function (event) {
    if (!confirm('Sei sicuro di voler eliminare questo utente?')) {
        event.preventDefault();
    }
});
$('#cerca_utenti button').click(function (event) {
    var text = $('#cerca_utenti_input').val();
    var risultati = $('#cerca_utenti_risultati');
    if (text.length > 0) {
        risultati.empty();
        $.ajax({
            url: 'ajax_cerca_utenti.php',
            dataType: 'html',
            method: 'get',
            data: {
                text_ricerca: text
            },
            success: function (html) {
                risultati.html(html);
//                if (json.error === 0) {
//                    if (json.data.length > 0) {
//                        var ul = $('<ul>');
//                        $.each(json.data, function (index, element) {
//                            $('<li><a href="/ArtooP16-Utenti/utente.php?utenteid=' + element.UtenteID + '">' +
//                                    element.NomeUtente + '</a></li>').appendTo(ul);
//                        });
//                        ul.appendTo(risultati);
//                    } else {
//                        risultati.html('<em>La ricerca non ha prodotto risultati.</em>');
//                    }
//                } else {
//                    risultati.html(json.error);
//                }
            },
            error: function (error) {
                risultati.html(error.responseText);
            }
        });
    }
});