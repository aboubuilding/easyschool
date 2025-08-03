	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="defaultModalLabel">
            <i class="ti ti-calendar-off me-2"></i> Gérer une absence
        </h4>
        <button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Close">
            <i class="ti ti-x"></i>
        </button>
    </div>

    <form action="#" id="form" enctype="multipart/form-data">
        @csrf
        <div class="modal-body pb-0">
            <div class="row">
                <!-- Élève -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-user me-1"></i> Élève concerné
                        </label>
                        <select class="form-select" name="eleve_id" id="eleve_id">
                            <option value="">-- Sélectionner un élève --</option>
                            <!-- Options dynamiques via backend -->
                        </select>
                    </div>
                </div>

                <!-- Date d'absence -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-calendar-event me-1"></i> Date d’absence <span class="text-danger">*</span>
                        </label>
                        <input type="date" class="form-control" name="date_absence" id="date_absence">
                    </div>
                </div>

                <!-- Heure d'absence -->
                <div class="col-md-6">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-clock me-1"></i> Heure d’absence
                        </label>
                        <input type="time" class="form-control" name="heure_absence" id="heure_absence">
                    </div>
                </div>

                <!-- Retard -->
                <div class="col-md-6">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="retard" name="retard" value="1">
                        <label class="form-check-label" for="retard">
                            <i class="ti ti-alert-circle me-1"></i> Est-ce un retard ?
                        </label>
                    </div>
                </div>

                <!-- Justifiée -->
                <div class="col-md-6">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="justifiee" name="justifiee" value="1">
                        <label class="form-check-label" for="justifiee">
                            <i class="ti ti-check me-1"></i> Absence justifiée ?
                        </label>
                    </div>
                </div>

                <!-- Motif -->
                <div class="col-md-12">
                    <div class="mb-3">
                        <label class="form-label">
                            <i class="ti ti-message-circle me-1"></i> Motif de l’absence
                        </label>
                        <textarea class="form-control" name="motif" id="motif" rows="4" placeholder="Ex: Maladie, RDV médical, etc."></textarea>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <input type="hidden" id="idAbsence">
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary me-2" id="annulerAbsence">
                <i class="ti ti-x"></i> Annuler
            </button>
            <button type="submit" class="btn btn-primary" id="updateAbsence">
                <i class="ti ti-pencil"></i> Modifier
            </button>
            <button type="submit" class="btn btn-primary" id="ajouterAbsence">
                <i class="ti ti-plus"></i> Ajouter
            </button>
        </div>
    </form>
</div>

				</div>
			</div>
			<!-- /Add Company -->
