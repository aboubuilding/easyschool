	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-megaphone me-2"></i> Nouvelle Annonce
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf

        <div class="modal-body pb-0">
            <div class="row">
                <!-- Titre -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-heading me-1"></i> Titre <span class="text-danger">*</span>
                        </label>
                        <input type="text" class="form-control" name="titre" id="titre" placeholder="Ex: Réunion parents d’élèves">
                    </div>
                </div>

                <!-- Contenu -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-message-dots me-1"></i> Contenu <span class="text-danger">*</span>
                        </label>
                        <textarea class="form-control" name="contenu" id="contenu" rows="4" placeholder="Rédigez ici le message de l’annonce..."></textarea>
                    </div>
                </div>

                <!-- Date de publication -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-calendar-event me-1"></i> Date de publication <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" name="date_publication" id="date_publication">
                    </div>
                </div>

                <!-- Audience -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-users me-1"></i> Audience ciblée <span class="text-danger">*</span>
                        </label>
                        <select class="form-select" name="audience" id="audience">
                            <option value="">-- Sélectionner --</option>
                            <option value="tous">Tous</option>
                            <option value="parents">Parents</option>
                            <option value="enseignants">Enseignants</option>
                            <option value="eleves">Élèves</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <input type="hidden" id="idAnnonce">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerAnnonce">
                <i class="ti ti-x"></i> Annuler
            </button>

            <button type="submit" class="btn btn-primary" id="updateAnnonce">
                <i class="ti ti-pencil"></i> Modifier
            </button>

            <button type="submit" class="btn btn-primary" id="ajouterAnnonce">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
