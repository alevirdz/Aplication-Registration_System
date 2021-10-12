<!--
* Autor: Alevi                                                                    
* Sistema: Registros                                                                  
* Módulo: Panel principal           
* Generado por: Isaac Alevi Rodriguez Cauich
* Fecha de Generación: 30/08/21
* Descripción: Vista rápida para ver información de cada módulo
 -->
<?php 
include ('../recepcion/form-profile.php');
include ('../recepcion/form-panel.php');
?>
<div class="row mb-2 mb-xl-3">
	<div class="col-auto d-none d-sm-block">
		<h1>¡Qué bueno que regresaste <?php echo $nameUser ?>!</h1>
		<h3><strong>Análisis</strong> Panel</h3>
	</div>
</div>
<div class="row">
<?php if ($rolUser === "1") {?>
				<div class="col-xl-6 col-xxl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Donaciones</h5>
										<h1 class="mt-1 mb-3"><?php echo '$ '. $totalDonation ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Inscritos</h5>
										<h1 class="mt-1 mb-3"><?php echo $inscriptions;  ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Visita nueva</h5>
										<h1 class="mt-1 mb-3"><?php echo $newPerson;  ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Productos</h5>
										<h1 class="mt-1 mb-3">-- --</h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Usuarios</h5>
										<h1 class="mt-1 mb-3"><?php echo $usuarios; ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
						<div class="card-header">

							<h5 class="card-title mb-0">Inscripciones gráfica</h5>
						</div>
						<div class="card-body py-3">
							<div class="chart chart-sm">
								<canvas id="chartjs-dashboard-line"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<!-- <div class="col-12 col-lg-8 col-xxl-9 d-flex"> -->
				<div class="col-12 col-lg-12 col-xxl-12 d-flex">
					<div class="card flex-fill">
						<div class="card-header">

							<h5 class="card-title mb-0">Lista de usuarios</h5>
						</div>
						<table class="table table-hover table-responsive my-0">
							<thead>
								<tr>
									<th>Nombres</th>
									<th class="d-none d-xl-table-cell">Fecha de creación</th>
									<th class="d-none d-xl-table-cell">Perfil</th>
									<th>Estado</th>
									<th class="d-none d-md-table-cell">Correo</th>
								</tr>
							</thead>
							<tbody>
							<?php foreach( $tableUser as $data ){ ?>
								<tr>
									<td><?php echo $data->nombre;?></td>
									<td class="d-none d-xl-table-cell"><?php echo $data->fecha;?></td>
									<td class="d-none d-xl-table-cell"><?php echo $data->perfil;?></td>
									<td><span class="badge <?php echo $data->estado == 'Desactivado' ? 'bg-danger' : 'bg-success'  ?> "><?php echo $data->estado; ?></span></td>
									<td class="d-none d-md-table-cell"><?php echo $data->correo;?></td>
								</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>

<!-- 				<div class="col-12 col-lg-4 col-xxl-3 d-flex">
					<div class="card flex-fill w-100">
						<div class="card-header">

							<h5 class="card-title mb-0">Espacio disponible</h5>
						</div>
						<div class="card-body d-flex w-100">
							<div class="align-self-center chart chart-lg">
								<canvas id="chartjs-dashboard-bar">
								</canvas>
								
							</div>
						</div>
					</div>
				</div>
			</div> -->
<?php } else if ($rolUser === "2"){?>
	<div class="col-xl-6 col-xxl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Donaciones</h5>
										<h1 class="mt-1 mb-3">Balance oculto</h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Inscritos</h5>
										<h1 class="mt-1 mb-3"><?php echo $inscriptions;  ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
						<div class="card-header">

							<h5 class="card-title mb-0">Inscripciones gráfica</h5>
						</div>
						<div class="card-body py-3">
							<div class="chart chart-sm">
								<canvas id="chartjs-dashboard-line"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
<?php } else if ($rolUser === "3") {?>
	<div class="col-xl-6 col-xxl-5 d-flex">
					<div class="w-100">
						<div class="row">
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Visitas nuevas</h5>
										<h1 class="mt-1 mb-3"><?php echo $newPerson; ?></h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="card">
									<div class="card-body">
										<h5 class="card-title mb-4">Total de productos</h5>
										<h1 class="mt-1 mb-3">-- --</h1>
										<div class="mb-1">
											<span class="text-muted">Desde la última semana</span>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xl-6 col-xxl-7">
					<div class="card flex-fill w-100">
						<div class="card-header">

							<h5 class="card-title mb-0">Inscripciones gráfica</h5>
						</div>
						<div class="card-body py-3">
							<div class="chart chart-sm">
								<canvas id="chartjs-dashboard-line"></canvas>
							</div>
						</div>
					</div>
				</div>
			</div>
	<?php }?>

<script>


var ctx = document.getElementById('chartjs-dashboard-line').getContext('2d');
var myChart = new Chart(ctx, {
    type: 'bar',
   data:{
   labels: ["Lunes", "Martes", "Miercoles", "Jueves", "Viernes", "Sabado", "Domingo"],
        datasets: [{
            label: 'Percentage',
            data: [12, 19, 3, 5, 2, 3],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 1
        }]
},
options: {
        scales: {
            x: {
                type: 'time',
                min: new Date('2020-05-26').valueOf(),
                max: new Date('2020-05-27').valueOf()
            },
            y: {
                type: 'linear',
                min: 0,
                max: 100
            }
        }
    }
});





</script>
