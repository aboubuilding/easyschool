	<!-- Add Company -->
			<div class="modal fade" id="addPoste">
				<div class="modal-dialog modal-dialog-centered modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h4 class="modal-title" id="defaultModalLabel">Add New Company</h4>
							<button type="button" class="btn-close custom-btn-close p-0" data-bs-dismiss="modal" aria-label="Close">
								<i class="ti ti-x"></i>
							</button>
						</div>
						<form action="" id="form"  enctype="multipart/form-data">

							 @csrf
							<div class="modal-body pb-0">
								<div class="row">

									<div class="col-md-12">
										<div class="mb-3">
											<label class="form-label">Libelle <span class="text-danger"> *</span></label>
											<input type="text" class="form-control" id="libelle" name="libelle">
										</div>
									</div>
									<div class="col-md-12">
										<div class="mb-3">
											<label class="form-label">Description  <span class="text-danger"> *</span></label>
											<textarea id="description" name="description" class="form-control" rows="5"  placeholder="Votre description  ici..."></textarea>
										</div>
									</div>


								</div>
							</div>

							 <input type="hidden" id="idPoste">
							<div class="modal-footer">
								<button type="button" class="btn btn-secondary me-2" id="annulerPoste">Annuler</button>

								<button type="submit" class="btn btn-primary" id="updatePoste">Modifier </button>
								<button type="submit" class="btn btn-primary" id="ajouterPoste">Ajouter </button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- /Add Company -->
