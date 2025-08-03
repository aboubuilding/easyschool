	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-user-plus me-2"></i>Ajouter un enseignant
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="" method="POST" id="form" enctype="multipart/form-data">
        @csrf

        <div class="modal-body pb-0">
            <div class="row">

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-user-circle me-1"></i>Nom
                        </label>
                        <input type="text" class="form-control" name="nom" id="nom" placeholder="Entrez le nom">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-user me-1"></i>Prénom
                        </label>
                        <input type="text" class="form-control" name="prenom" id="prenom" placeholder="Entrez le prénom">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-phone me-1"></i>Téléphone
                        </label>
                        <input type="text" class="form-control" name="telephone" id="telephone" placeholder="Ex: 90 00 00 00">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-school me-1"></i>Diplôme
                        </label>
                        <select class="form-select" name="diplome" id="diplome">
                            <option value="">-- Sélectionnez --</option>
                            <option value="1">Licence</option>
                            <option value="2">Maîtrise</option>
                            <option value="3">Doctorat</option>
                            <!-- Adaptez selon vos besoins -->
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-calendar-event me-1"></i>Date d'embauche
                        </label>
                        <input type="date" class="form-control" name="date_embauche" id="date_embauche">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-calendar me-1"></i>Date de naissance
                        </label>
                        <input type="date" class="form-control" name="date_naissance" id="date_naissance">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-map-pin me-1"></i>Lieu de naissance
                        </label>
                        <input type="text" class="form-control" name="lieu_naissance" id="lieu_naissance" placeholder="Lieu de naissance">
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-gender-bigender me-1"></i>Sexe
                        </label>
                        <select class="form-select" name="sexe" id="sexe">
                            <option value="">-- Sélectionnez --</option>
                            <option value="0">Femme</option>
                            <option value="1">Homme</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">
                <i class="ti ti-arrow-left"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Enregistrer
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
