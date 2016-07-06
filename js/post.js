$('button.submit').click(function (event) {
    if ($('input[name="titolo"]').val().length == 0) {
        alert('Devi assegnare il titolo al post!');
        event.preventDefault();
    } else {
        if (!confirm('Sei sicuro di voler creare questo post?')) {
            event.preventDefault();
        }
    }
});