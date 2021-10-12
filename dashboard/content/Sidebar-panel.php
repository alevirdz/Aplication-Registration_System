<?php
include ('../../config/database.php'); 
include ('../../recepcion/form-panel.php'); 
// include ('../../recepcion/form-profile.php'); 
?>
<nav id="sidebar" class="sidebar">
			<div class="sidebar-content js-simplebar">
				<a class="sidebar-brand" href="Dashboard-panel.php" id="panel">
					<img class="rounded-circle" src="<?php echo $imageUser == '' ? '../../../assets/user/profile/default_1.svg' : $imageUser;  ?>" alt="foto del usuario" id="userImgSB" width="50" height="50">
          			<span class="align-middle"> <?php echo $nameUser ?></span>
        		</a>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						Opciones
					</li>
					<?php if ($rolUser === "1") {?>
					<li class="sidebar-item active" id="item-desktop">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="panel">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Escritorio </span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-donation">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="donations">
              			<i class="align-middle" data-feather="heart"></i> <span class="align-middle">Donaciones</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-inscriptions">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="inscriptions">
              			<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Inscripciones a Eventos</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-new-visit">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="new-visit">
              			<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Personas nuevas</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-profile">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="profile">
              			<i class="align-middle" data-feather="user-check"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-configurations">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="configurations">
              			<i class="align-middle" data-feather="settings"></i> <span class="align-middle">Configuración</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-sms">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="sms">
              			<i class="align-middle" data-feather="message-square"></i> <span class="align-middle">Mensajes</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-user-management">
						<a href="#auth" data-bs-toggle="collapse" class="sidebar-link collapsed">
              			<i class="align-middle" data-feather="users"></i> <span class="align-middle">Gestion de usuarios</span>
            			</a>
						<ul id="auth" class="sidebar-dropdown list-unstyled collapse " data-bs-parent="#sidebar">
							<li class="sidebar-item"><a class="sidebar-link" onclick=actionMenu((this.id)) id="createUser">Crear usuario</a></li>
							<li class="sidebar-item"><a class="sidebar-link" onclick=actionMenu((this.id)) id="showUsers">Ver registros de usuario</a></li>
						</ul>
					</li>
					<li class="sidebar-header">
						Ubicaciones
					</li>

					<li class="sidebar-item" id="item-direction">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="direction">
              			<i class="align-middle" data-feather="bar-chart-2"></i> <span class="align-middle">Dirección</span>
            			</a>
					</li>

					<li class="sidebar-item" id="item-maps">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="maps">
              			<i class="align-middle" data-feather="map"></i> <span class="align-middle">Mapas</span>
            			</a>
					</li>
					<?php }  else if ($rolUser === "2"){ ?>
					<li class="sidebar-item active" id="item-desktop">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="panel">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Escritorio </span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-inscriptions">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="inscriptions">
              			<i class="align-middle" data-feather="calendar"></i> <span class="align-middle">Inscripciones a Eventos</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-donation">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="donations">
              			<i class="align-middle" data-feather="heart"></i> <span class="align-middle">Donaciones</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-profile">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="profile">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>
					<?php }  else if ($rolUser === "3"){?>
						<li class="sidebar-item active" id="item-desktop">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="panel">
              			<i class="align-middle" data-feather="sliders"></i> <span class="align-middle">Escritorio </span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-new-visit">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="new-visit">
              			<i class="align-middle" data-feather="user-plus"></i> <span class="align-middle">Personas nuevas</span>
            			</a>
					</li>
					<li class="sidebar-item" id="item-profile">
						<a class="sidebar-link" onclick=actionMenu((this.id)) id="profile">
              			<i class="align-middle" data-feather="user"></i> <span class="align-middle">Perfil</span>
            			</a>
					</li>
					<?php } ?>


					


				</ul>

				<!-- <div class="sidebar-cta">
					<div class="sidebar-cta-content">
						<strong class="d-inline-block mb-2">Upgrade to Pro</strong>
						<div class="mb-3 text-sm">
							Are you looking for more components? Check out our premium version.
						</div>
						<div class="d-grid">
							<a href="https://adminkit.io/pricing" target="_blank" class="btn btn-primary">Upgrade to Pro</a>
						</div>
					</div>
				</div> -->
			</div>
		</nav>