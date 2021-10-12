<?php 
require './Sesiones.php';
require '../config/database.php';
//BD Consulta Configuraciones
$stmt = $BD->prepare("SELECT * FROM configuraciones");
$stmt->execute();
$result = $stmt->fetchAll(PDO::FETCH_OBJ);
$limitConfigInscriptions = $result[0]->limite_inscripciones;
?>

<section class="py-3">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-7">
                        <h1 class="font-weight-bold">Inscripciones de Evento</h1>
                        <p class="lead text-muted" id="subtitle-inscriptions">Registro para las inscripciones</p>
                    </div>
                    <?php if ($rolUser == 1): ?>
                    <div class="col-sm-6 col-lg-5 d-flex" id="options_inscriptions">
                        <a class="btn btn btn-primary white align-self-center d-flex align-icons" id="actionInscriptions" onclick="showInscriptions()"><ion-icon name="list-outline" size="small"></ion-icon><span id="text-option">Ver Inscripciones</span></a>
                        <a href="../Excel_Inscriptions.php" class="btn btn btn-success white d-flex align-icons align-self-center"><ion-icon name="document-text-outline" size="small"></ion-icon><span id="text-option">Descargar Excel</span></a>
                        <a class="btn btn btn-danger  white align-self-center d-flex align-icons" id="inscriptionDeleteAll" onclick="inscriptionDeleteAll()"><ion-icon name="flame-outline" size="small"></ion-icon><span id="text-option">Restaurar tabla</span></a>
                    </div>
                    <?php else:?>
                    <div class="col-sm-6 col-lg-5">
                        <button class="btn btn btn-primary white d-flex align-self-center" id="actionInscriptions" onclick="showInscriptions()">Ver registros</button>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="card col-sm-12">
            <div class="card-body">
                <div class="row">

                    <div class="content" id="">
                        <form class="form-limit" id="formG">
                            <div class="col-sm-8 col-lg-8 d-flex">
                                <label for="limit" class="form-label m-auto">Límite: </label>
                                <input type="number" class="form-control" name="limit" id="limit" placeholder="0" value="<?php echo $limitConfigInscriptions ?>" required>
                                <a type="button" class="btn btn-dark" name="btn-limite" id="btn-limite" onclick="limitInscripcions()">Guardar</a>
                            </div>                            
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>



<section class="py-3" id="section-inscription">
    <div class="container">
        <div class="card">
            <div class="card-body table-responsive">
                <div class="row">
                <div class="content" id="inscription">
                    <form class="form-donation" id="formG">
                        <h2 class="text-center">Ingrese los datos del solicitante</h2>
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombres</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Apellidos</label>
                            <input type="text" class="form-control" name="apellidos" id="apellidos" placeholder="Apellidos" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Edad</label>
                            <input type="number" class="form-control" name="edad" id="edad" placeholder="Edad" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Celular (+52)</label>
                            <input type="number" class="form-control" name="telefono" id="telefono" placeholder="Celular" placeholder="529379000123" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Tipo de Asignación</label>
                            <select class="form-select" name="asignacion" id="asignacion" required>
                                <option selected>Seleciona una opción</option>
                                <option value="01">Invitado</option>
                                <option value="02">Servidor(a)</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Abono</label>
                            <input type="number" class="form-control" name="abono" id="abono" placeholder="¿Cuánto abonó?" required>
                        </div>
                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-inscription" onclick="inscriptions()">¡Inscribirme!</a>
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
