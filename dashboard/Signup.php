<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Nuevo usuario</h1>
							<p class="lead">
								Cree un nuevo usuario con un tipo de perfil
							</p>
						</div>

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form>
										<div class="mb-3">
											<label class="form-label">Nombre</label>
											<input class="form-control form-control-lg" type="text" name="nombre" id="nombre" placeholder="Nombre del usuario" required/>
										</div>
										
										<div class="mb-3">
											<label class="form-label">Correo</label>
											<input class="form-control form-control-lg" type="email" name="correo" id="correo" placeholder="Ingresa el correo" required/>
										</div>
										<div class="mb-3">
											<label class="form-label">Contraseña</label>
											<input class="form-control form-control-lg" type="password" name="contraseña" id="contraseña" placeholder="Ingresa una contraseña" />
										</div>
										<div class="mb-3">
											<label class="form-label">Confirma la contraseña</label>
											<input class="form-control form-control-lg" type="password" name="contraseña_d" id="contraseña_d" placeholder="Confirmar contraseña" />
										</div>
										<div class="mb-3">
											<label class="form-label">Tipo de perfil</label>

											<div class="form-check">
												<input class="form-check-input" type="radio" name="flexRadioDefault" id="t_admin" value="1">
												<label class="form-check-label" for="label_admin">
													Administrador
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="flexRadioDefault" id="t_user" checked value="2">
												<label class="form-check-label" for="label_user">
													Colaborador
												</label>
											</div>
											<div class="form-check">
												<input class="form-check-input" type="radio" name="flexRadioDefault" id="t_receptionist" checked value="3">
												<label class="form-check-label" for="label_receptionist">
													Recepción
												</label>
											</div>

										</div>
										<div class="text-center mt-3">
										<input type="button" class="btn btn-primary" name="btn-register" value="Crear cuenta" onclick="registerdesdeAdmin()">
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>