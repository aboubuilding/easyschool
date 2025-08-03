$(document).ready(function () {

    $('#lancerNote').click(function (e) {
        e.preventDefault();
        lancerNote();
    });

    // Validation jQuery selon le FormRequest
    $('#form').validate({
        rules: {
            eleve_id: {
                digits: true
            },
            matiere_id: {
                digits: true
            },
            enseignant_id: {
                digits: true
            },
            devoir_id: {
                digits: true
            },
            valeur: {
                required: true,
                number: true,
                min: 0,
                max: 20
            },
            date_note: {
                required: true,
                date: true
            }
        },
        messages: {
            eleve_id: "L’élève sélectionné est invalide.",
            matiere_id: "La matière sélectionnée est invalide.",
            enseignant_id: "L’enseignant sélectionné est invalide.",
            devoir_id: "Le devoir sélectionné est invalide.",
            valeur: {
                required: "La note est obligatoire.",
                number: "La note doit être un nombre.",
                min: "La note doit être comprise entre 0 et 20.",
                max: "La note doit être comprise entre 0 et 20."
            },
            date_note: {
                required: "La date de la note est obligatoire.",
                date: "La date de la note n’est pas valide."
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

    $('#ajouterNote').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            validerNote();
        }
    });

    $('#updateNote').click(function (e) {
        e.preventDefault();
        if ($('#form').valid()) {
            updateNote();
        }
    });

    $(document).on('click', '.modifierNote', function (e) {
        e.preventDefault();
        let id = $(this).data('id');
        $.get('/notes/modifier/' + id, function (note) {
            $('#form').find('input[name="valeur"]').val(note.valeur);
            $('#form').find('input[name="date_note"]').val(note.date_note);
            $('#form').find('select[name="eleve_id"]').val(note.eleve_id);
            $('#form').find('select[name="matiere_id"]').val(note.matiere_id);
            $('#form').find('select[name="enseignant_id"]').val(note.enseignant_id);
            $('#form').find('select[name="devoir_id"]').val(note.devoir_id);

            $('#idNote').val(note.id);
            $('#defaultModalLabel').text('Modifier une note');
            $('#ajouterNote').hide();
            $('#updateNote').show();
            $('#addNote').modal('toggle');
        });
    });

    $(document).on('click', '.supprimerNote', function (e) {
        e.preventDefault();
        deleteConfirmation($(this).data('id'));
    });

    clearData();
});

// Fonctions

function clearData() {
    $('#form')[0].reset();
    $('#idNote').val('');
    $('#ajouterNote').show();
    $('#updateNote').hide();
}

function lancerNote() {
    clearData();
    $('#defaultModalLabel').text('Ajouter une note');
    $('#addNote').modal('toggle');
}

function validerNote() {
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/notes/save',
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

function updateNote() {
    let id = $('#idNote').val();
    let form = document.getElementById('form');
    let formData = new FormData(form);

    $.ajax({
        dataType: 'json',
        type: 'POST',
        url: '/notes/update/' + id,
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
        title: "Voulez-vous supprimer cette note ?",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "Oui, supprimer",
        cancelButtonText: "Annuler"
    }).then(result => {
        if (result.value) {
            $.ajax({
                type: 'POST',
                url: '/notes/delete/' + id,
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function (reponse) {
                    if (reponse.note) {
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
