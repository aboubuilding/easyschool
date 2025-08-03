	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title">
            <i class="ti ti-mail"></i> Rédiger un Message
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Fermer">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="" id="formMessage" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">

                <!-- Expediteur -->
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="expediteur_id">
                        <i class="ti ti-user-up"></i> Expéditeur
                    </label>
                    <select name="expediteur_id" id="expediteur_id" class="form-select">
                        <option value="">-- Sélectionner l'expéditeur --</option>
                        <!-- À remplir dynamiquement -->
                    </select>
                </div>

                <!-- Destinataire -->
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="destinataire_id">
                        <i class="ti ti-user-down"></i> Destinataire
                    </label>
                    <select name="destinataire_id" id="destinataire_id" class="form-select">
                        <option value="">-- Sélectionner le destinataire --</option>
                        <!-- À remplir dynamiquement -->
                    </select>
                </div>

                <!-- Objet -->
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="objet">
                        <i class="ti ti-heading"></i> Objet
                    </label>
                    <input type="text" class="form-control" name="objet" id="objet" placeholder="Sujet du message">
                </div>

                <!-- Contenu -->
                <div class="col-md-12 mb-3">
                    <label class="form-label" for="contenu">
                        <i class="ti ti-message-dots"></i> Contenu du message <span class="text-danger">*</span>
                    </label>
                    <textarea name="contenu" id="contenu" class="form-control" rows="5" placeholder="Votre message ici..."></textarea>
                </div>

                <!-- Lu -->
                <div class="col-md-12 mb-3">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" id="lu" name="lu" value="1">
                        <label class="form-check-label" for="lu">
                            <i class="ti ti-eye-check"></i> Marquer comme lu
                        </label>
                    </div>
                </div>

            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerMessage">
                <i class="ti ti-x"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary" id="envoyerMessage">
                <i class="ti ti-send"></i> Envoyer
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
