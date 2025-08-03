jQuery(document).ready(function () {
    // Ouvrir le modal d'ajout de cycle
    $("#lancerCycle").click(function (e) {
        e.preventDefault();
        lancerCycle();
    });

    // Validation du formulaire avec jQuery Validate
    $('#form').validate({
        rules: {
            nom: {
                required: true,
                maxlength: 255
            },
            
        },
        messages: {
            nom: {
                required: "Le nom du cycle est obligatoire.",
                maxlength: "Le nom ne doit pas dépasser 255 caractères."
            },
           
        },
        invalidHandler: function (event, validator) {
            let erreurs = [];
            $.each(validator.errorList, function (_, error) {
                erreurs.push(error.message);
            });
            verifierFormulaire(erreurs);
        },
        errorPlacement: function () {
            return false; // gestion globale via toastr
        }
    });

    // Soumission pour ajout
    $('#ajouterCycle').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerCycle();
        }
    });

    // Modification
    $(document).on('click', '.modifierCycle', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.get("/cycles/modifier/" + id, function (cycle) {
            $('#defaultModalLabel').text('Modifier un cycle');
            let modal = $('#addCycle');
            $(modal).find('[name="nom"]').val(cycle.nom);
          
            $('#idCycle').val(cycle.id);
            $("#ajouterCycle").hide();
            $("#updateCycle").show();
            $(modal).modal('toggle');
        }, 'json');
    });

    // Mise à jour
    $('#updateCycle').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateCycle();
        }
    });

    // Suppression
    $(document).on('click', '.supprimerCycle', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        deleteConfirmation(id);
    });

    clearData();
});

// ----------------- Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idCycle').val('');
    $("#ajouterCycle").show();
    $("#updateCycle").hide();
}

function lancerCycle() {
    clearData();
    $('#defaultModalLabel').text('Ajouter un cycle');
    $('#addCycle').modal('toggle');
}

function validerCycle() {
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/cycles/save",
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

function updateCycle() {
    let id = $('#idCycle').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);
    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: "/cycles/update/" + id,
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
        title: "Voulez-vous supprimer ce cycle ?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Valider",
        cancelButtonText: "Annuler"
    }).then(function (result) {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: "/cycles/delete/" + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                dataType: 'JSON',
                success: function (reponse) {
                    if (reponse.cycle) {
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
