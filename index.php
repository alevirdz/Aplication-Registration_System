<?php 
session_start ();
include 'resources/layouts/links-header-index.php'; 
?>
<section id="Description">
      <div class="container-fluid">
        <div class="row ">      
          <!-- Aqui agregar un script para cambiar la imagen automaticamente  --> 
          <div class="col-lg-6 content order-lg-1 order-1" style="background: url('./assets/theme/img_login/default1.jpg'); height: 100vh; background-size: cover; background-position: center;">
            <div class="sidenav d-flex justify-content-center align-items-center">
              <div class="white">
                <h2><?php echo TITLE_APP_WEB ?></h2>
                <p><?php echo DESCRIPTION_APP_WEB ?></p>
              </div>
            </div>
            
          </div>

          <div class="col-lg-6 background order-lg-2 order-2 center-block mx-auto m-auto content-login">
            <div class="content-login-sesion">
                <div class="card">
                  <div class="card-body">
                  <h2>Inicia sesión</h2>

                    <form id="formG">
                    <div class="form-group ">
                      <label for="email" class="">Correo electrónico</label>
                      <input type="email" class="form-control" id="correo" name="correo" id="correo" placeholder="Correo" required >
                    </div>

                    <div class="form-group">
                      <label for="password" class="">Contraseña</label>
                      <input type="password" class="form-control" id="contraseña" name="contraseña" id="contraseña" placeholder="Contraseña" required>
                      <a class="btn btn-link" href="#!"> ¿Olvidaste tu contraseña?</a>
                    </div>

                    <div class="form-group row mb-0">
                      <div class="col-md-6 offset-md-4">
                        <button type="button" class="btn btn-secondary" onclick="login()">
                          Iniciar sesión
                        </button>
                      </div>
                    </div>
                    </form>


                  </div>
              </div>
            </div>
            
          </div>

        </div>
</section>
<?php 
include 'resources/layouts/links-footer-index.php';
?>

