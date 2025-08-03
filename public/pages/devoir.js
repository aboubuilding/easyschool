jQuery(document).ready(function () {
    // Ouvrir le modal
    $("#lancerDevoir").click(function (e) {
        e.preventDefault();
        lancerDevoir();
    });

    // Ajout méthode personnalisée pour type
    $.validator.addMethod("oneOf", function (value, element, param) {
        return this.optional(element) || param.includes(parseInt(value));
    }, "Le type de devoir est invalide.");

    // Validation du formulaire
    $('#form').validate({
        rules: {
            contenu: {
                required: true,
                maxlength: 10000
            },
            date_rendu: {
                required: true,
                dateISO: true
            },
            type: {
                oneOf: [1, 2, 3]
            }
        },
        messages: {
            contenu: {
                required: "Le contenu du devoir est obligatoire.",
                maxlength: "Le contenu est trop long."
            },
            date_rendu: {
                required: "La date de rendu est obligatoire.",
                dateISO: "La date doit être valide."
            },
            type: {
                oneOf: "Le type de devoir est invalide (1 = Devoir, 2 = Contrôle, 3 = Examen)."
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

    // Enregistrer
    $('#ajouterDevoir').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerDevoir();
        }
    });

    // Modifier
    $(document).on('click', '.modifierDevoir', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.get("/devoirs/modifier/" + id, function (devoir) {
            $('#defaultModalLabel').text('Modifier un devoir');
            let modal = $('#addDevoir');
            $(modal).find('[name="contenu"]').val(devoir.contenu);
            $(modal).find('[name="date_rendu"]').val(devoir.date_rendu);
            $(modal).find('[name="type"]').val(devoir.type);
            $(modal).find('[name="classe_id"]').val(devoir.classe_id);
            $(modal).find('[name="matiere_id"]').val(devoir.matiere_id);
            $(modal).find('[name="enseignant_id"]').val(devoir.enseignant_id);
            $('#idDevoir').val(devoir.id);
            $("#ajouterDevoir").hide();
            $("#updateDevoir").show();
            $(modal).modal('toggle');
        }, 'json');
    });

    // Update
    $('#updateDevoir').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateDevoir();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerDevoir', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteConfirmation(id);
    });

    clearData();
});

// ---------- Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idDevoir').val('');
    $("#ajouterDevoir").show();
    $("#updateDevoir").hide();
}

function lancerDevoir() {
    clearData();
    $('#defaultModalLabel').text('Ajouter un devoir');
    $('#addDevoir').modal('toggle');
}

function validerDevoir() {
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/devoirs/save",
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

function updateDevoir() {
    let id = $('#idDevoir').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/devoirs/update/" + id,
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
        title: "Supprimer ce devoir ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "/devoirs/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.devoir) {
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
        onHidden: function () {
            location.reload();
        }
    };
    toastr.success(message);
}

function gererErreurs(xhr) {
    if (xhr.status === 422) {
        let errors = xhr.responseJSON.errors;
        let messages = [];
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
