jQuery(document).ready(function () {

    // Ouvrir le modal d'ajout
    $("#lancerMessage").click(function (e) {
        e.preventDefault();
        lancerMessage();
    });

    // Validation du formulaire
    $('#form').validate({
        rules: {
            objet: {
                maxlength: 255
            },
            contenu: {
                required: true
            },
            lu: {
                oneOf: [0, 1]
            }
        },
        messages: {
            objet: {
                maxlength: "L’objet ne peut pas dépasser 255 caractères."
            },
            contenu: {
                required: "Le contenu du message est obligatoire."
            },
            lu: {
                oneOf: "Le champ 'lu' doit être vrai ou faux."
            }
        },
        errorPlacement: function () { return false; },
        invalidHandler: function (event, validator) {
            let erreurs = validator.errorList.map(e => e.message);
            verifierFormulaire(erreurs);
        }
    });

    // Ajout
    $('#ajouterMessage').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerMessage();
        }
    });

    // Modification
    $(document).on('click', '.modifierMessage', function (e) {
        e.preventDefault();
        let id = $(this).data('id');

        $.get("/messages/modifier/" + id, function (message) {
            $('#defaultModalLabel').text("Modifier un message");
            let modal = $('#addMessage');

            $(modal).find('[name="objet"]').val(message.objet);
            $(modal).find('[name="contenu"]').val(message.contenu);
            $(modal).find('[name="expediteur_id"]').val(message.expediteur_id);
            $(modal).find('[name="destinataire_id"]').val(message.destinataire_id);
            $(modal).find('[name="lu"]').val(message.lu);

            $('#idMessage').val(message.id);
            $("#ajouterMessage").hide();
            $("#updateMessage").show();

            $(modal).modal('toggle');
        }, 'json');
    });

    // Update
    $('#updateMessage').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateMessage();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerMessage', function (e) {
        e.preventDefault();
        deleteConfirmation($(this).data('id'));
    });

    clearData();
});

// ---------- Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idMessage').val('');
    $("#ajouterMessage").show();
    $("#updateMessage").hide();
}

function lancerMessage() {
    clearData();
    $('#defaultModalLabel').text("Envoyer un message");
    $('#addMessage').modal('toggle');
}

function validerMessage() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/messages/save",
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

function updateMessage() {
    let id = $('#idMessage').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/messages/update/" + id,
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
        title: "Voulez-vous supprimer ce message ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "/messages/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.message) {
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

function notifierSuccesEtRecharger(message = "Message enregistré avec succès.") {
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
    if (xhr.status === 422) {
        let messages = [];
        let errors = xhr.responseJSON.errors;
        for (let field in errors) {
            messages = messages.concat(errors[field]);
        }
        verifierFormulaire(messages);
    } else if (xhr.status === 500) {
        toastr.error(xhr.responseJSON?.error || "Erreur serveur");
    } else {
        toastr.error(xhr.responseJSON?.message || "Erreur inconnue.");
    }
}
