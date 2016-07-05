$('.delete_utente').on('click', function (event) {
    if (!confirm('Sei sicuro di voler eliminare questo utente?')) {
        event.preventDefault();
    }
});