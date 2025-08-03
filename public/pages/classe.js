jQuery(document).ready(function () {
    // Lancer modal
    $("#lancerClasse").click(function (e) {
        e.preventDefault();
        lancerClasse();
    });

    // Méthode perso pour vérifier un ID numérique (nullable)
    $.validator.addMethod("nullableId", function (value, element) {
        return value === "" || /^\d+$/.test(value);
    });

    // Validation du formulaire
    $('#form').validate({
        rules: {
            nom: {
                required: true,
                maxlength: 255
                // L'unicité est vérifiée côté Laravel uniquement
            },
            cycle_id: {
                nullableId: true
            },
            niveau_id: {
                nullableId: true
            },
            annee_id: {
                nullableId: true
            }
        },
        messages: {
            nom: {
                required: "Le nom de la classe est obligatoire.",
                maxlength: "Le nom ne doit pas dépasser 255 caractères."
            },
            cycle_id: {
                nullableId: "Le cycle sélectionné est invalide."
            },
            niveau_id: {
                nullableId: "Le niveau sélectionné est invalide."
            },
            annee_id: {
                nullableId: "L'année sélectionnée est invalide."
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
    $('#ajouterClasse').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerClasse();
        }
    });

    // Modification
    $(document).on('click', '.modifierClasse', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.get("/classes/modifier/" + id, function (classe) {
            $('#defaultModalLabel').text('Modifier une classe');
            let modal = $('#addClasse');
            $(modal).find('[name="nom"]').val(classe.nom);
            $(modal).find('[name="cycle_id"]').val(classe.cycle_id);
            $(modal).find('[name="niveau_id"]').val(classe.niveau_id);
            $(modal).find('[name="annee_id"]').val(classe.annee_id);
            $('#idClasse').val(classe.id);
            $("#ajouterClasse").hide();
            $("#updateClasse").show();
            $(modal).modal('toggle');
        }, 'json');
    });

    // Update
    $('#updateClasse').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateClasse();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerClasse', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteConfirmation(id);
    });

    clearData();
});

function clearData() {
    $('#form')[0].reset();
    $('#idClasse').val('');
    $("#ajouterClasse").show();
    $("#updateClasse").hide();
}

function lancerClasse() {
    clearData();
    $('#defaultModalLabel').text('Ajouter une classe');
    $('#addClasse').modal('toggle');
}

function validerClasse() {
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/classes/save",
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

function updateClasse() {
    let id = $('#idClasse').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/classes/update/" + id,
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
        title: "Voulez-vous supprimer cette classe ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Oui",
        cancelButtonText: "Annuler"
    }).then(function (e) {
        if (e.value === true) {
            $.ajax({
                type: 'POST',
                url: "/classes/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.classe) {
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
    erreurs.forEach(function (msg) {
        toastr.error(msg);
    });
}

function notifierSuccesEtRecharger(message = "Classe enregistrée avec succès !") {
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
        toastr.error(xhr.responseJSON?.error || "Erreur serveur inattendue");
    } else {
        verifierFormulaire([
            xhr.responseJSON?.message || "Erreur inconnue."
        ]);
    }
}
