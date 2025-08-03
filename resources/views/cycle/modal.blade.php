	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-cycle me-2"></i> Gestion des Cycles
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">

                <!-- Nom du cycle -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nom" class="form-label">
                            <i class="ti ti-tag me-1"></i> Nom du cycle <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex : Cycle Primaire">
                    </div>
                </div>

                <!-- État -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="etat" class="form-label">
                            <i class="ti ti-toggle-left me-1"></i> État du cycle <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="etat" id="etat">
                            <option value="">-- Sélectionner un état --</option>
                            <option value="1">Actif</option>
                            <option value="0">Inactif</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <input type="hidden" id="idCycle">

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerCycle">
                <i class="ti ti-x"></i> Annuler
            </button>

            <button type="submit" class="btn btn-primary" id="updateCycle">
                <i class="ti ti-pencil"></i> Modifier
            </button>

            <button type="submit" class="btn btn-primary" id="ajouterCycle">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
