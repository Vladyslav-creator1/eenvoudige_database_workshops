const modal = document.getElementById('updateModal');

modal.addEventListener('show.bs.modal', function (event) {

    const button = event.relatedTarget;

    document.getElementById('modal-id').value =
        button.getAttribute('data-id');

    document.getElementById('modal-voornaam').value =
        button.getAttribute('data-voornaam');

    document.getElementById('modal-achternaam').value =
        button.getAttribute('data-achternaam');

});