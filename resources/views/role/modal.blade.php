	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-user-shield me-2"></i> Gestion des Rôles
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf

        <div class="modal-body pb-0">
            <div class="row">
                <!-- Nom du rôle -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label for="nom" class="form-label">
                            <i class="ti ti-tag me-1"></i> Nom du rôle <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" id="nom" name="nom" placeholder="Ex: Administrateur, Enseignant...">
                    </div>
                </div>
            </div>
        </div>

        <!-- Champ caché pour l'update -->
        <input type="hidden" id="idRole">

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerRole">
                <i class="ti ti-x"></i> Annuler
            </button>

            <button type="submit" class="btn btn-primary" id="updateRole">
                <i class="ti ti-pencil"></i> Modifier
            </button>

            <button type="submit" class="btn btn-primary" id="ajouterRole">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
