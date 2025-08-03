jQuery(document).ready(function () {

    // Ouvrir le modal d'ajout d'annonce
    $("#lancerAnnonce").click(function (event) {
        event.preventDefault();
        lancerAnnonce();
    });

    // Méthodes personnalisées
    $.validator.addMethod("inList", function (value, element, list) {
        return this.optional(element) || list.includes(value);
    });

    $.validator.addMethod("beforeOrEqualToday", function (value, element) {
        let inputDate = new Date(value);
        let today = new Date();
        inputDate.setHours(0, 0, 0, 0);
        today.setHours(0, 0, 0, 0);
        return inputDate <= today;
    });

    // Validation du formulaire
    $('#form').validate({
        rules: {
            titre: {
                required: true,
                maxlength: 255
            },
            contenu: {
                required: true
            },
            date_publication: {
                required: true,
                date: true,
                beforeOrEqualToday: true
            },
            audience: {
                required: true,
                inList: ['tous', 'parents', 'enseignants', 'eleves']
            }
        },

        messages: {
            titre: {
                required: "Le titre de l’annonce est obligatoire.",
                maxlength: "Le titre ne doit pas dépasser 255 caractères."
            },
            contenu: {
                required: "Le contenu de l’annonce est obligatoire."
            },
            date_publication: {
                required: "La date de publication est obligatoire.",
                date: "La date de publication doit être une date valide.",
                beforeOrEqualToday: "La date de publication ne peut pas être dans le futur."
            },
            audience: {
                required: "L’audience est obligatoire.",
                inList: "L’audience doit être : tous, parents, enseignants ou élèves."
            }
        },

        invalidHandler: function (event, validator) {
            let erreurs = [];
            $.each(validator.errorList, function (_, error) {
                erreurs.push(error.message);
            });
            verifierFormulaire(erreurs);
        },

        errorPlacement: function () {
            return false;
        }
    });

    // Ajout
    $(document).on('click', '#ajouterAnnonce', function (event) {
        event.preventDefault();
        if ($('#form').valid()) {
            validerAnnonce();
        }
    });

    // Modification
    $(document).on('click', '.modifierAnnonce', function () {
        event.preventDefault();
        let id = $(this).data('id');
        let url = "/annonces/modifier/" + id;

        $.get(url, function (annonce) {
            $('#defaultModalLabel').text('Modifier une annonce');
            let modal = $('#addAnnonce');

            $(modal).find('[name="titre"]').val(annonce.titre);
            $(modal).find('[name="contenu"]').val(annonce.contenu);
            $(modal).find('[name="date_publication"]').val(annonce.date_publication);
            $(modal).find('[name="audience"]').val(annonce.audience);

            $('#idAnnonce').val(annonce.id);

            $("#ajouterAnnonce").hide();
            $("#updateAnnonce").show();
            $(modal).modal('toggle');
        }, 'json');
    });

    // Update
    $("#updateAnnonce").click(function (event) {
        event.preventDefault();
        if ($('#form').valid()) {
            updateAnnonce();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerAnnonce', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deleteConfirmation(id);
    });

    clearData();
});

// Fonctions utilitaires
function clearData() {
    $('#form')[0].reset();
    $('#idAnnonce').val('');
    $("#ajouterAnnonce").show();
    $("#updateAnnonce").hide();
}

function lancerAnnonce() {
    clearData();
    $('#defaultModalLabel').text('Ajouter une annonce');
    $('#addAnnonce').modal('toggle');
}

function validerAnnonce() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/annonces/save",
        method: $(form).attr('method'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(form).find('span.error-text').text('');
        },
        success: function (reponse) {
            notifierSuccesEtRecharger(reponse.message);
        },
        error: function (xhr) {
            gererErreurs(xhr);
        }
    });
}

function updateAnnonce() {
    let id = $('#idAnnonce').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/annonces/update/" + id,
        method: $(form).attr('method'),
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            $(form).find('span.error-text').text('');
        },
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
        title: "Voulez-vous supprimer cette annonce ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler"
    }).then(function (e) {
        if (e.value === true) {
            $.ajax({
                type: 'POST',
                url: "/annonces/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.annonce) {
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
        "closeButton": true,
        "progressBar": true,
        "positionClass": "toast-top-right",
        "timeOut": "3000"
    };

    erreurs.forEach(function (message) {
        toastr.error(message);
    });
}

function notifierSuccesEtRecharger(message = "Traitement effectué avec succès !") {
    toastr.options = {
        closeButton: true,
        progressBar: true,
        positionClass: "toast-top-right",
        timeOut: "2000",
        onHidden: function () {
            location.reload();
        }
    };
    toastr.success(message);
}

function gererErreurs(xhr) {
    console.log(xhr);
    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        let messages = [];
        for (let field in errors) {
            messages = messages.concat(errors[field]);
        }
        verifierFormulaire(messages);
    } else if (xhr.status === 500) {
        toastr.error(xhr.responseJSON?.error || "Une erreur s’est produite.");
    } else {
        verifierFormulaire([
            xhr.responseJSON?.message || "Une erreur inconnue s’est produite."
        ]);
    }
}
