$(document).ready(function () {

    // Ouvrir le modal
    $('#lancerUtilisateur').click(function (e) {
        e.preventDefault();
        lancerUtilisateur();
    });

    // Validation jQuery
    $('#form').validate({
        rules: {
            nom: {
                required: true,
                maxlength: 100
            },
            prenom: {
                required: true,
                maxlength: 100
            },
            email: {
                required: true,
                email: true,
                maxlength: 255
            },
            password: {
                minlength: 6
            },
            password_confirmation: {
                equalTo: "#password"
            },
            role_id: {
                digits: true
            }
        },
        messages: {
            nom: {
                required: "Le nom est requis.",
                maxlength: "Le nom ne doit pas dépasser 100 caractères."
            },
            prenom: {
                required: "Le prénom est requis.",
                maxlength: "Le prénom ne doit pas dépasser 100 caractères."
            },
            email: {
                required: "L'adresse email est requise.",
                email: "L'adresse email est invalide.",
                maxlength: "L'adresse email ne doit pas dépasser 255 caractères."
            },
            password: {
                minlength: "Le mot de passe doit contenir au moins 6 caractères."
            },
            password_confirmation: {
                equalTo: "La confirmation du mot de passe ne correspond pas."
            },
            role_id: {
                digits: "Le rôle sélectionné est invalide."
            }
        },
        errorPlacement: function () { return false; },
        invalidHandler: function (event, validator) {
            const erreurs = validator.errorList.map(e => e.message);
            verifierFormulaire(erreurs);
        }
    });

    // Ajouter
    $('#ajouterUtilisateur').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerUtilisateur();
        }
    });

    // Modifier
    $('#updateUtilisateur').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateUtilisateur();
        }
    });

    // Chargement données à modifier
    $(document).on('click', '.modifierUtilisateur', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.get('/utilisateurs/modifier/' + id, function (data) {
            $('#form input[name="nom"]').val(data.nom);
            $('#form input[name="prenom"]').val(data.prenom);
            $('#form input[name="email"]').val(data.email);
            $('#form select[name="role_id"]').val(data.role_id);

            $('#idUtilisateur').val(data.id);
            $('#defaultModalLabel').text('Modifier un utilisateur');

            $('#ajouterUtilisateur').hide();
            $('#updateUtilisateur').show();
            $('#addUtilisateur').modal('toggle');
        });
    });

    // Supprimer
    $(document).on('click', '.supprimerUtilisateur', function (e) {
        e.preventDefault();
        deleteConfirmation($(this).data('id'));
    });

    clearData();
});

// ---------------- Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idUtilisateur').val('');
    $('#ajouterUtilisateur').show();
    $('#updateUtilisateur').hide();
}

function lancerUtilisateur() {
    clearData();
    $('#defaultModalLabel').text('Ajouter un utilisateur');
    $('#addUtilisateur').modal('toggle');
}

function validerUtilisateur() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/utilisateurs/save',
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

function updateUtilisateur() {
    let id = $('#idUtilisateur').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/utilisateurs/update/' + id,
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

function deleteConfirmation(id) {
    Swal.fire({
        title: "Voulez-vous supprimer cet utilisateur ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: '/utilisateurs/delete/' + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (reponse) {
                    if (reponse.utilisateur) {
                        Swal.fire("Succès", reponse.message, "success");
                        setTimeout(() => location.reload(), 2000);
                    } else {
                        Swal.fire("Erreur", reponse.message, "error");
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
        let message = xhr.responseJSON?.message || "Une erreur inconnue s’est produite.";
        toastr.error(message, "Erreur");
        console.error("Erreur :", message);
    }
}
