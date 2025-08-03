$(document).ready(function () {

    // Ouvrir la modale d'ajout
    $('#lancerRole').click(function (e) {
        e.preventDefault();
        lancerRole();
    });

    // Validation du formulaire
    $('#form').validate({
        rules: {
            nom: {
                required: true,
                maxlength: 255
            }
        },
        messages: {
            nom: {
                required: "Le nom du rôle est obligatoire.",
                maxlength: "Le nom ne doit pas dépasser 255 caractères."
            }
        },
        errorPlacement: function () {
            return false;
        },
        invalidHandler: function (event, validator) {
            const erreurs = validator.errorList.map(e => e.message);
            verifierFormulaire(erreurs);
        }
    });

    // Soumission création
    $('#ajouterRole').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerRole();
        }
    });

    // Soumission modification
    $('#updateRole').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateRole();
        }
    });

    // Charger un rôle pour modification
    $(document).on('click', '.modifierRole', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.get('/roles/modifier/' + id, function (role) {
            $('#form').find('input[name="nom"]').val(role.nom);
            $('#idRole').val(role.id);

            $('#defaultModalLabel').text('Modifier un rôle');
            $('#ajouterRole').hide();
            $('#updateRole').show();
            $('#addRole').modal('toggle');
        });
    });

    // Suppression
    $(document).on('click', '.supprimerRole', function (e) {
        e.preventDefault();
        deleteConfirmation($(this).data('id'));
    });

    clearData();
});

// Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idRole').val('');
    $('#ajouterRole').show();
    $('#updateRole').hide();
}

function lancerRole() {
    clearData();
    $('#defaultModalLabel').text('Ajouter un rôle');
    $('#addRole').modal('toggle');
}

function validerRole() {
    const form = document.getElementById('form');
    const formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/roles/save',
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            notifierSuccesEtRecharger(response.message);
        },
        error: function (xhr) {
            gererErreurs(xhr);
        }
    });
}

function updateRole() {
    const id = $('#idRole').val();
    const form = document.getElementById('form');
    const formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/roles/update/' + id,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            notifierSuccesEtRecharger(response.message);
        },
        error: function (xhr) {
            gererErreurs(xhr);
        }
    });
}

function deleteConfirmation(id) {
    Swal.fire({
        title: "Supprimer ce rôle ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: '/roles/delete/' + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (response) {
                    if (response.role) {
                        Swal.fire("Succès", response.message, "success");
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        Swal.fire("Erreur", response.message, "error");
                    }
                }
            });
        }
    });
}

function verifierFormulaire(erreurs) {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "3000"
    };
    erreurs.forEach(msg => toastr.error(msg));
}

function notifierSuccesEtRecharger(message = "Opération réussie.") {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "2000",
        onHidden: () => location.reload()
    };
    toastr.success(message);
}

function gererErreurs(xhr) {
    if (xhr.status === 422) {
        const errors = xhr.responseJSON.errors;
        let messages = [];
        for (let field in errors) {
            messages = messages.concat(errors[field]);
        }
        verifierFormulaire(messages);
    } else {
        const message = xhr.responseJSON?.message || "Une erreur inconnue s’est produite.";
        toastr.error(message, "Erreur");
        console.error("Erreur :", message);
    }
}
