<?php 

require '../recepcion/form-profile.php'; //Aqui esta el problema
require 'Alerts.php';

?>
<p class="none" id="id" value="<?php echo $idUser ?>"></p>
<section class="container">
    <div class="row">
        <div class="card">
        <div class="card-body">
        <div class="row">
            <div class="col-lg-7">
                <h1 class="font-weight-bold">Perfil del Usuario</h1>
                <p class="lead text-muted" id="subtitle-configuration">Revisa tus datos</p>
            </div>
        </div>
        </div>
        </div>
    </div>
</section>
<div class="row">
    <div class="col-md-4 col-xl-3">
        <div class="card mb-3">
            <div class="card-header">
                <h5 class="card-title mb-0">Detalles del perfil</h5>
            </div>
            <div class="card-body text-center">
                <div class="img-profile">
                <img  src="<?php echo $imageUser == '' ? '../../assets/user/profile/default_1.svg' : $imageUser;  ?>" alt="Foto de perfil" class=" rounded-circle mb-2" id="userImg" width="128" height="128" />
                <span style="font-size: 15px;vertical-align: middle; position:absolute; top:180px; left:auto;" onclick="updatePhoto(<?php echo $idUser ?>)"><ion-icon name="camera"></ion-icon></span>
                </div>

                <h5 class="card-title mb-0" id="name"><?php echo $nameUser ?></h5>
                <div class="text-muted mb-2"><?php echo $perfilUser ?></div>
            </div>
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Recordatorio <span style="font-size: 15px;vertical-align: middle;" onclick="editRemember(<?php echo $idUser ?>)"><ion-icon name="create-outline"></ion-icon></span></h5>
                <div class="text-muted mb-2" id="remember"><?php echo $rememberUser ?></div>
            </div>
            <hr class="my-0" />
            <hr class="my-0" />
            <div class="card-body">
                <h5 class="h6 card-title">Redes Sociales <span style="font-size: 15px;vertical-align: middle;" onclick="socialMedia(<?php echo $idUser ?>)"><ion-icon name="open"></ion-icon></span></h5>
                <div class="link-social">
                <ul class="list-social">
                    <li><a href="<?php echo $Facebook ?>" target="_blank" id="link-facebook"><ion-icon name="logo-facebook"></ion-icon> Facebook</a></li>
                    <li><a href="<?php echo $Whatsapp ?>" target="_blank" id="link-whatsapp"><ion-icon name="logo-whatsapp"></ion-icon> Whatsapp</a></li>
                    <li><a href="<?php echo $Instagram ?>" target="_blank" id="link-instagram"><ion-icon name="logo-instagram"></ion-icon> Instagram</a></li>
                    <li><a href="<?php echo $Youtube ?>" target="_blank" id="link-youtube"><ion-icon name="logo-youtube"></ion-icon> YouTube</a></li>
                    <li><a href="<?php echo $Web ?>" target="_blank" id="link-web"><ion-icon name="planet-outline"></ion-icon> Web</a></li>
                    <li><a href="mailto:<?php echo $Email ?>" target="_blank" id="link-email"><ion-icon name="mail-outline"></ion-icon> Correo</a></li>
                </ul>
                <h5 class="text-muted mb-2"><i>Obtén acceso más rápido desde un solo lugar.</i></h5>
                </div>
            </div>
            <hr class="my-0" />

        </div>
    </div>
    

    <div class="col-md-8 col-xl-9">
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Nombre de usuario</h5>
            </div>
            <div class="card-body h-100">
            <form class="form-donation" id="formG">
                        <div class="mb-3">
                            <label for="user" class="form-label">Nombre</label>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombres" value="<?php echo $nameUser ?>" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Correo electrónico</label>
                            <input type="email" class="form-control" name="correo" id="correo" placeholder="Correo electrónico" value="<?php echo $mailUser ?>" disabled required>
                        </div>

                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-donation" id="btn-profile" onclick="Updateprofile()">Actualizar mis datos</a>
                            <a type="button" class="btn btn-dark d-none" name="btn-donation" id="btn-profileUpdate" onclick="Saveprofile(<?php echo $idUser ?>)">Guardar</a>
                        </div>
                    </form>
            </div>
        </div>
        <div class="card">
            <div class="card-header">

                <h5 class="card-title mb-0">Restablecer contraseña</h5>
            </div>
            <div class="card-body h-100">
            <form class="form-donation" id="formG">
                        <div class="mb-3">
                            <label for="user" class="form-label">Contraseña actual</label>
                            <input type="password" class="form-control" name="passwordCurrent" id="passwordCurrent" placeholder="Contraseña actual" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Nueva contraseña</label>
                            <input type="password" class="form-control" name="passwordNew" id="passwordNew" placeholder="Nueva contraseña" disabled required>
                        </div>
                        <div class="mb-3">
                            <label for="user" class="form-label">Confirmación de contraseña</label>
                            <input type="password" class="form-control" name="passwordConfirmNew" id="passwordConfirmNew" placeholder="Confirmación de contraseña" disabled required>
                        </div>
                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-dark" name="btn-password" id="btn-password" onclick="Updatepassword()">Cambiar contraseña</a>
                            <a type="button" class="btn btn-dark d-none" name="btn-password" id="btn-passwordUpdate" onclick="Savepassword(<?php echo $idUser ?>)">Guardar</a>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    
    
</div>
<div id="rememberEdit"></div>
<div id="socialUpdate"></div>