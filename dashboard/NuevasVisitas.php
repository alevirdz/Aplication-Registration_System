<?php 
require './Sesiones.php';
require '../config/database.php';
?>
<section class="py-3">
    <div class="container">
        <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="font-weight-bold">Visitas nuevas</h1>
                <p class="lead text-muted" id="subtitle-new-person">Registro de visitas nuevas</p>
            </div>

            <?php if ($rolUser == 1): ?>
                <div class="col-sm-6 col-lg-5 d-flex" id="options_inscriptions_new_person">
                    <a class="btn btn btn-primary white align-self-center d-flex align-icons" id="actionNewPerson" onclick="showRegisterNewPerson()"><ion-icon name="list-outline" size="small"></ion-icon><span id="text-option">Ver Registros</span></a>
                    <a href="../Excel_NewPerson.php" class="btn btn btn-success white d-flex align-icons align-self-center"><ion-icon name="document-text-outline" size="small"></ion-icon><span id="text-option">Descargar Excel</span></a>
                    <a class="btn btn btn-danger  white align-self-center d-flex align-icons" id="inscriptionNewPersonDeleteAll" onclick="inscriptionNewPersonDeleteAll()"><ion-icon name="flame-outline" size="small"></ion-icon><span id="text-option">Restaurar Tabla</span></a>
                </div>
            <?php else:?>
                <div class="col-sm-6 col-lg-5 d-flex">
                    <a class="btn btn btn-primary white align-self-center d-flex align-icons" id="actionNewPerson" onclick="showRegisterNewPerson()"><ion-icon name="list-outline" size="small"></ion-icon><span id="text-option">Ver Registros</span></a>
                </div>
            <?php endif; ?>


        </div>
        </div>
        </div>
    </div>
</section>

<section class="py-3" id="section-personas-nuevas">
                <div class="container">
                    <div class="card">
                        <div class="card-body table-responsive">
                            <div class="row">
                            <div class="content" id="new-people">
                                <form class="form-new-people" id="formG">
                                    <h2 class="text-center">Visitas nuevas</h2>
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Nombres</label>
                                        <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Apellidos</label>
                                        <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Celular (+52)</label>
                                        <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Celular" placeholder="529379000123" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label">Ubicación</label>
                                        <select class="form-select" name="option-location" id="option-location" required>
                                            <option selected disabled>Seleciona una opción</option>
                                            <option value="01">Mérida</option>
                                            <option value="02">Caucel</option>
                                            <option value="03">Kanasín</option>
                                            <option value="04">Umán</option>
                                            <option value="05">Otro</option>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="user" class="form-label">¿Quién visitó?</label>
                                        <select class="form-select" name="option-new-person" id="option-new-person" required>
                                            <option selected disabled>Seleciona una opción</option>
                                            <option value="01">Joven</option>
                                            <option value="02">Adulto(a)</option>
                                        </select>
                                    </div>
                                    <div class="d-grid gap-2">
                                        <a type="button" class="btn btn-dark" name="btn-new-person" id="btn-new-person" onclick="inscriptionNewPerson()">Registrar</a>
                                    </div>
                                </form>
                            </div>

                            </div> 
                        </div>
                    </div>
                </div>
</section>



<!-- Modal Se utiliza en JS-->
<div class="modal fade" id="modalInscriptions" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" id="activeCenter">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-center" id="genericoTitle">Editar Registro</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">

        <div id="contentEdit"></div>

      </div>
    </div>
  </div>
</div>
