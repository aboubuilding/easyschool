jQuery(document).ready(function () {

    // Ouvrir le modal d'ajout d'absence
    $("#lancerAbsence").click(function (event) {
        event.preventDefault();
        lancerAbsence();
    });

    // Méthodes personnalisées
    $.validator.addMethod("regex", function (value, element, regexp) {
        let re = new RegExp(regexp);
        return this.optional(element) || re.test(value);
    });

    $.validator.addMethod("oneOf", function (value, element, param) {
        return this.optional(element) || param.includes(value);
    });

    // Validation du formulaire
    $('#form').validate({
        rules: {
            eleve_id: {
                digits: true
            },
            date_absence: {
                required: true,
                date: true
            },
            heure_absence: {
                regex: /^([01]\d|2[0-3]):([0-5]\d)$/
            },
            retard: {
                oneOf: [0, 1, "0", "1", true, false]
            },
            motif: {
                maxlength: 1000
            },
            justifiee: {
                oneOf: [0, 1, "0", "1", true, false]
            }
        },

        messages: {
            eleve_id: {
                digits: "L'élève sélectionné est invalide."
            },
            date_absence: {
                required: "La date d'absence est obligatoire.",
                date: "La date d'absence doit être une date valide."
            },
            heure_absence: {
                regex: "L'heure d'absence doit être au format HH:MM (ex: 08:30)."
            },
            retard: {
                oneOf: "La valeur de retard doit être vraie ou fausse."
            },
            motif: {
                maxlength: "Le motif est trop long."
            },
            justifiee: {
                oneOf: "La valeur de justification doit être vraie ou fausse."
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
    $(document).on('click', '#ajouterAbsence', function (event) {
        event.preventDefault();
        if ($('#form').valid()) {
            validerAbsence();
        }
    });

    // Modification
    $(document).on('click', '.modifierAbsence', function () {
        event.preventDefault();
        let id = $(this).data('id');
        let url = "/absences/modifier/" + id;

        $.get(url, function (absence) {
            $('#defaultModalLabel').text('Modifier une absence');
            let modal = $('#addAbsence');
            $(modal).find('form').find('[name="eleve_id"]').val(absence.eleve_id);
            $(modal).find('form').find('[name="date_absence"]').val(absence.date_absence);
            $(modal).find('form').find('[name="heure_absence"]').val(absence.heure_absence);
            $(modal).find('form').find('[name="retard"]').prop('checked', absence.retard);
            $(modal).find('form').find('[name="motif"]').val(absence.motif);
            $(modal).find('form').find('[name="justifiee"]').prop('checked', absence.justifiee);
            $('#idAbsence').val(absence.id);

            $("#ajouterAbsence").hide();
            $("#updateAbsence").show();
            $(modal).modal('toggle');
        }, 'json');
    });

    // Update
    $("#updateAbsence").click(function (event) {
        event.preventDefault();
        if ($('#form').valid()) {
            updateAbsence();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerAbsence', function (event) {
        event.preventDefault();
        let id = $(this).data('id');
        deleteConfirmation(id);
    });

    clearData();
});

// ⚙️ Fonctions
function clearData() {
    $('#form')[0].reset();
    $('#idAbsence').val('');
    $("#ajouterAbsence").show();
    $("#updateAbsence").hide();
}

function lancerAbsence() {
    clearData();
    $('#defaultModalLabel').text('Ajouter une absence');
    $('#addAbsence').modal('toggle');
}

function validerAbsence() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/absences/save",
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

function updateAbsence() {
    let id = $('#idAbsence').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/absences/update/" + id,
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
        title: "Voulez-vous supprimer cette absence ?",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler"
    }).then(function (e) {
        if (e.value === true) {
            $.ajax({
                type: 'POST',
                url: "/absences/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.absence) {
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
