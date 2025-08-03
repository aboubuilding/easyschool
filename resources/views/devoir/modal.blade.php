	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-book me-2"></i> Ajouter un Devoir
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">

                <!-- Classe -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="classe_id" class="form-label">
                            <i class="ti ti-building me-1"></i> Classe
                        </label>
                        <select name="classe_id" id="classe_id" class="form-select">
                            <option value="">-- Sélectionner une classe --</option>
                            <!-- options dynamiques ici -->
                        </select>
                    </div>
                </div>

                <!-- Matière -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="matiere_id" class="form-label">
                            <i class="ti ti-book-2 me-1"></i> Matière
                        </label>
                        <select name="matiere_id" id="matiere_id" class="form-select">
                            <option value="">-- Sélectionner une matière --</option>
                            <!-- options dynamiques ici -->
                        </select>
                    </div>
                </div>

                <!-- Enseignant -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="enseignant_id" class="form-label">
                            <i class="ti ti-user me-1"></i> Enseignant
                        </label>
                        <select name="enseignant_id" id="enseignant_id" class="form-select">
                            <option value="">-- Sélectionner un enseignant --</option>
                            <!-- options dynamiques ici -->
                        </select>
                    </div>
                </div>

                <!-- Contenu -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="contenu" class="form-label">
                            <i class="ti ti-text-size me-1"></i> Contenu du devoir <span class="text-danger">*</span>
                        </label>
                        <textarea name="contenu" id="contenu" class="form-control" rows="4" placeholder="Ex : Sujet du devoir..."></textarea>
                    </div>
                </div>

                <!-- Date de rendu -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="date_rendu" class="form-label">
                            <i class="ti ti-calendar me-1"></i> Date de rendu <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" name="date_rendu" id="date_rendu">
                    </div>
                </div>

                <!-- Type -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="type" class="form-label">
                            <i class="ti ti-layers me-1"></i> Type de devoir
                        </label>
                        <select name="type" id="type" class="form-select">
                            <option value="">-- Choisir un type --</option>
                            <option value="1">Devoir</option>
                            <option value="2">Contrôle</option>
                            <option value="3">Examen</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" id="idDevoir">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerDevoir">
                <i class="ti ti-x"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary" id="updateDevoir">
                <i class="ti ti-edit"></i> Modifier
            </button>
            <button type="submit" class="btn btn-primary" id="ajouterDevoir">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
