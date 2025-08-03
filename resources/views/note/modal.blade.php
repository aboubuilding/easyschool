	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">
            <i class="ti ti-pencil me-2"></i> Ajouter une Note
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="formNote" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">

                <!-- Élève -->
                <div class="col-md-12 mb-3">
                    <label for="eleve_id" class="form-label">
                        <i class="ti ti-user"></i> Élève
                    </label>
                    <select class="form-select" name="eleve_id" id="eleve_id">
                        <option value="">-- Sélectionner un élève --</option>
                        <!-- Options dynamiques ici -->
                    </select>
                </div>

                <!-- Matière -->
                <div class="col-md-12 mb-3">
                    <label for="matiere_id" class="form-label">
                        <i class="ti ti-book"></i> Matière
                    </label>
                    <select class="form-select" name="matiere_id" id="matiere_id">
                        <option value="">-- Sélectionner une matière --</option>
                        <!-- Options dynamiques ici -->
                    </select>
                </div>

                <!-- Enseignant -->
                <div class="col-md-12 mb-3">
                    <label for="enseignant_id" class="form-label">
                        <i class="ti ti-users"></i> Enseignant
                    </label>
                    <select class="form-select" name="enseignant_id" id="enseignant_id">
                        <option value="">-- Sélectionner un enseignant --</option>
                        <!-- Options dynamiques ici -->
                    </select>
                </div>

                <!-- Devoir -->
                <div class="col-md-12 mb-3">
                    <label for="devoir_id" class="form-label">
                        <i class="ti ti-file-text"></i> Devoir (optionnel)
                    </label>
                    <select class="form-select" name="devoir_id" id="devoir_id">
                        <option value="">-- Lier à un devoir --</option>
                        <!-- Options dynamiques ici -->
                    </select>
                </div>

                <!-- Note -->
                <div class="col-md-12 mb-3">
                    <label for="valeur" class="form-label">
                        <i class="ti ti-star"></i> Note (/20) <span class="text-danger">*</span>
                    </label>
                    <input type="number" min="0" max="20" step="0.01" class="form-control" name="valeur" id="valeur" placeholder="Ex : 16.5">
                </div>

                <!-- Date de la note -->
                <div class="col-md-12 mb-3">
                    <label for="date_note" class="form-label">
                        <i class="ti ti-calendar"></i> Date de la note <span class="text-danger">*</span>
                    </label>
                    <input type="date" class="form-control" name="date_note" id="date_note">
                </div>

            </div>
        </div>

        <input type="hidden" id="idNote">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerNote">
                <i class="ti ti-x"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary" id="updateNote">
                <i class="ti ti-edit"></i> Modifier
            </button>
            <button type="submit" class="btn btn-primary" id="ajouterNote">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
