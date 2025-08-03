	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-school me-2"></i> Gestion des Classes
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf

        <div class="modal-body pb-0">
            <div class="row">

                <!-- Nom de la classe -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nom" class="form-label">
                            <i class="ti ti-tag me-1"></i> Nom de la classe <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: 6ème A, Terminale C">
                    </div>
                </div>

                <!-- Cycle -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="cycle_id" class="form-label">
                            <i class="ti ti-refresh me-1"></i> Cycle
                        </label>
                        <select id="cycle_id" name="cycle_id" class="form-select">
                            <option value="">-- Sélectionner un cycle --</option>
                            <!-- Options dynamiques à insérer ici -->
                        </select>
                    </div>
                </div>

                <!-- Niveau -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="niveau_id" class="form-label">
                            <i class="ti ti-stairs me-1"></i> Niveau
                        </label>
                        <select id="niveau_id" name="niveau_id" class="form-select">
                            <option value="">-- Sélectionner un niveau --</option>
                            <!-- Options dynamiques à insérer ici -->
                        </select>
                    </div>
                </div>

                <!-- Année -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="annee_id" class="form-label">
                            <i class="ti ti-calendar me-1"></i> Année scolaire
                        </label>
                        <select id="annee_id" name="annee_id" class="form-select">
                            <option value="">-- Sélectionner une année --</option>
                            <!-- Options dynamiques à insérer ici -->
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" id="idClasse">

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerClasse">
                <i class="ti ti-x"></i> Annuler
            </button>

            <button type="submit" class="btn btn-primary" id="updateClasse">
                <i class="ti ti-pencil"></i> Modifier
            </button>

            <button type="submit" class="btn btn-primary" id="ajouterClasse">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
