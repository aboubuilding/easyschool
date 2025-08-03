$(document).ready(function () {

    // Ouverture de la modale
    $('#lancerNiveau').click(function (e) {
        e.preventDefault();
        lancerNiveau();
    });

    // Validation du formulaire avec jQuery Validate
    $('#form').validate({
        rules: {
            nom: {
                required: true,
                maxlength: 255
            },
            cycle_id: {
                number: true
            },
            annee_id: {
                number: true
            }
        },
        messages: {
            nom: {
                required: "Le nom du niveau est obligatoire.",
                maxlength: "Le nom ne doit pas dépasser 255 caractères."
            },
            cycle_id: {
                number: "Le cycle sélectionné est invalide."
            },
            annee_id: {
                number: "L'année sélectionnée est invalide."
            }
        },
        errorPlacement: function () {
            return false; // Pas d'affichage inline
        },
        invalidHandler: function (event, validator) {
            let erreurs = validator.errorList.map(e => e.message);
            verifierFormulaire(erreurs);
        }
    });

    // Ajout
    $('#ajouterNiveau').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerNiveau();
        }
    });

    // Modification
    $(document).on('click', '.modifierNiveau', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        let url = '/niveaux/modifier/' + id;

        $.get(url, function (niveau) {
            $('#defaultModalLabel').text('Modifier un niveau');

            let modal = $('#addNiveau');
            $(modal).find('input[name="nom"]').val(niveau.nom);
            $(modal).find('select[name="cycle_id"]').val(niveau.cycle_id);
            $(modal).find('select[name="annee_id"]').val(niveau.annee_id);

            $('#idNiveau').val(niveau.id);
            $('#ajouterNiveau').hide();
            $('#updateNiveau').show();

            $(modal).modal('toggle');
        }, 'json');
    });

    // Mise à jour
    $('#updateNiveau').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateNiveau();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerNiveau', function (e) {
        e.preventDefault();
        deleteConfirmation($(this).data('id'));
    });

    // Nettoyage initial
    clearData();
});

// ---------------- FONCTIONS ----------------

function clearData() {
    $('#form')[0].reset();
    $('#idNiveau').val('');
    $('#ajouterNiveau').show();
    $('#updateNiveau').hide();
}

function lancerNiveau() {
    clearData();
    $('#defaultModalLabel').text('Ajouter un niveau');
    $('#addNiveau').modal('toggle');
}

function validerNiveau() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/niveaux/save',
        method: $(form).attr('method'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (reponse) {
            notifierSuccesEtRecharger(reponse.message);
        },
        error: function (xhr) {
            gererErreurs(xhr);
        }
    });
}

function updateNiveau() {
    let id = $('#idNiveau').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/niveaux/update/' + id,
        method: $(form).attr('method'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (reponse) {
            notifierSuccesEtRecharger(reponse.message);
