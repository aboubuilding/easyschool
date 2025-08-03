	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					
					<div class="modal-content">
  <div class="modal-header">
    <h4 class="modal-title">
      <i class="ti ti-layers-difference me-2"></i> Ajouter / Modifier un Niveau
    </h4>
    <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
      <i class="ti ti-x"></i>
    </button>
  </div>

  <form action="#" id="formNiveau" enctype="multipart/form-data">
    @csrf
    <div class="modal-body pb-0">
      <div class="row">

        <!-- Nom -->
        <div class="col-md-12 mb-3">
          <label for="nom" class="form-label">
            <i class="ti ti-tag"></i> Nom du niveau <span class="text-danger">*</span>
          </label>
          <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex : Terminale S">
        </div>

        <!-- Cycle -->
        <div class="col-md-12 mb-3">
          <label for="cycle_id" class="form-label">
            <i class="ti ti-rotate"></i> Cycle associé
          </label>
          <select class="form-select" id="cycle_id" name="cycle_id">
            <option value="">-- Sélectionner un cycle --</option>
            <!-- À remplir dynamiquement avec les cycles -->
          </select>
        </div>

        <!-- Année -->
        <div class="col-md-12 mb-3">
          <label for="annee_id" class="form-label">
            <i class="ti ti-calendar-event"></i> Année scolaire
          </label>
          <select class="form-select" id="annee_id" name="annee_id">
            <option value="">-- Sélectionner une année --</option>
            <!-- À remplir dynamiquement avec les années -->
          </select>
        </div>

      </div>
    </div>

    <input type="hidden" id="idNiveau">
    <div class="modal-footer">
      <button type="button" class="btn btn-secondary me-2" id="annulerNiveau">
        <i class="ti ti-x"></i> Annuler
      </button>
      <button type="submit" class="btn btn-primary" id="updateNiveau">
        <i class="ti ti-edit"></i> Modifier
      </button>
      <button type="submit" class="btn btn-primary" id="ajouterNiveau">
        <i class="ti ti-plus"></i> Ajouter
      </button>
    </div>
  </form>
</div>



				</div>
			</div>
			<!-- /Add Company -->
