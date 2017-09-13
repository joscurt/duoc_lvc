<?php 
	$controller = $this->request->params['controller'];
	$session_data = $this->Session->read('DirectorLogueado');
	$session_data2 = $this->Session->read('CoordinadorLogueado');
	$action = $this->request->params['action'];
	$in_home = $controller == "Directores" && $action == "index" || $action == "autorizacionFichaDetalle" ? "active" : "";
	$in_recuperar_clases = $controller == "Directores" && $action == "recuperarClases" || $action == "editarRecuperacionClase" ? "active" : "";
	$in_reforzamientos = $controller == "Directores" && $action == "reforzamientos" || $action == "reforzamientoFichaDetalle" ? "active" : "";
	$in_reprobados = $controller == "Directores" && $action == "reprobados" || $action == "reprobadoFichaDetalle" ? "active" : "";
	$in_reportes = $controller == "Directores" && $action == "reportes" ? "active" : "";


	#DEBUG($session_data);exit();
?>
<!DOCTYPE html>
<html> 
	<head>
		<?php echo $this->Html->charset(); ?>
		<title>
			Gestión de clases | DUOC UC
			<?php echo $this->fetch('title'); ?>
		</title>
		<?php
			echo $this->Html->meta('icon');
			echo $this->Html->css(array(
				'../fonts/font.css',
				'coordinadores.css',
				"../fa/css/font-awesome.min.css",
				"../fa/material-icons/material-design-iconic-font.css",
				"../material/vendors/animate-css/animate.min.css",
				"../material/vendors/sweet-alert/sweet-alert.min.css",
				"../material/vendors/material-icons/material-design-iconic-font.min.css",
				"../material/vendors/socicon/socicon.min.css",
				'../material/vendors/chosen/chosen.css',
				"../material/vendors/noUiSlider/jquery.nouislider.min.css",
				"../material/vendors/farbtastic/farbtastic.css",
				'jquery-ui.css',
				"../material/css/app.min.1.css",
				"../material/css/app.min.2.css",
				'tooltip.css',

			));
			echo $this->Html->script(array(
				"../material/js/jquery-2.1.1.min.js",
				'jquery-ui.js',
				"../material/js/bootstrap.min.js",
				"../material/vendors/flot/jquery.flot.min.js",
				"../material/vendors/flot/jquery.flot.resize.min.js",
				"../material/vendors/flot/plugins/curvedLines.js",
				"../material/vendors/sparklines/jquery.sparkline.min.js",
				"../material/vendors/easypiechart/jquery.easypiechart.min.js",
				"../material/vendors/fullcalendar/lib/moment.min.js",
				"../material/vendors/fullcalendar/fullcalendar.min.js",
				"../material/vendors/simpleWeather/jquery.simpleWeather.min.js",
				"../material/vendors/auto-size/jquery.autosize.min.js",
				"../material/vendors/waves/waves.min.js",
				"../material/vendors/bootstrap-growl/bootstrap-growl.min.js",
				"../material/vendors/sweet-alert/sweet-alert.min.js",
				'../material/vendors/bootstrap-select/bootstrap-select.js',
				"../material/js/flot-charts/curved-line-chart.js",
				"../material/js/flot-charts/line-chart.js",
				'../material/vendors/moment/moment.min.js',
				'../material/vendors/moment/es.js',
				'../material/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
				'../material/vendors/chosen/chosen.jquery.js',
				"jquery.price_format.2.0.min.js",
				"../material/js/charts.js",
				"../material/js/demo.js",
				"quicksearch.js",
				"docentes.js",
			));
			echo $this->fetch('meta');
			echo $this->fetch('css');
			echo $this->fetch('script');
		?>
		<style>
			body , a ,.tooltip,.popover{
				font-family: 'roboto_condensedregular', sans-serif !important;
			}
		</style>
	</head>
	<body>
		<div class="container-fluid">
			<header id="header">
				<div class="inside">
					<div class="pull-right info-usuario">
						<label>Usuario: <?php echo $session_data2['CoordinadorDocente']['NOMBRES'].' '.
								$session_data2['CoordinadorDocente']['APELLIDO_PAT'].' '.
								$session_data2['CoordinadorDocente']['APELLIDO_MAT'].' '.

						$session_data['Director']['NOMBRES'].' '.$session_data['Director']['APELLIDO_PAT'].' '.$session_data['Director']['APELLIDO_MAT']; ?></label>
						<a href="<?php echo $this->Html->url(array('controller'=>'Login','action'=>'logoutDirector')) ?>"><i class="fa fa-power-off" aria-hidden="true"></i> Cerrar Sesión</a>					
					</div>
					<div class="">		
						<?php echo $this->Html->image('logo-duoc-v2.png',array('class'=>'logo')); ?>
					</div>
				</div>
			</header>
			<div class="row column">
			<br>
			<br>
				<div class="left">
					<div class="col-md-2 card">
						<div class="fecha"><i class="fa fa-calendar-o" aria-hidden="true"></i> 12 de Septiembre 2016</div>
						<ul class="menu">

							<?php foreach ($funcionalidades as $key => $value) {
								$action = $value['Funcionalidad']['ACTION'];
								$controller = $value['Funcionalidad']['CONTROLLER'];
								if ($value['Funcionalidad']['VISTA_ID'] == $session_data['Vista']['ID'] && $value['Funcionalidad']['ACTIVO'] == 1) {
														
							?>
							<li><a href="<?php echo $this->Html->url(array("controller" => "".$controller."","action" => "".$action."")) ?>"><?php echo $value['Funcionalidad']['NOMBRE']; ?></a></li>
							<?php }} ?>

							<?php foreach ($funcionalidades as $key => $value) {
								$action = $value['Funcionalidad']['ACTION'];
								$controller = $value['Funcionalidad']['CONTROLLER'];
								if ($value['Funcionalidad']['VISTA_ID'] == $session_data2['Vista']['ID'] && $value['Funcionalidad']['ACTIVO'] == 1) {
														
							?>
							<li><a href="<?php echo $this->Html->url(array("controller" => "".$controller."","action" => "".$action."")) ?>"><?php echo $value['Funcionalidad']['NOMBRE']; ?></a></li>
							<?php }} ?>	



<!-- MENU ANTIGUO -->
<!--
							<?php if (isset($funcionalidades[12])): ?>
								<li class="<?php echo $in_home;?>"><a href="<?php echo $this->Html->url(array('action'=>'index')) ?>" title="Gestión de clases" >Autorización de Clases</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[13])): ?>
								<li class="<?php echo $in_recuperar_clases ?>"><a href="<?php echo $this->Html->url(array('action'=>'recuperarClases')) ?>" >Recuperar Clases</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[14])): ?>
								<li class="<?php echo $in_reforzamientos ?>"><a href="<?php echo $this->Html->url(array('action'=>'reforzamientos')) ?>" >Reforzamientos</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[16])): ?>
								<li class="<?php echo $in_reprobados ?>"><a href="<?php echo $this->Html->url(array('action'=>'reprobados')) ?>" >Reprobados por Inasistencia</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[62])): ?>
								<li class="<?php echo $in_reportes ?>"><a href="<?php echo $this->Html->url(array('action'=>'reportes')) ?>" title="Reportes" >Reportes</a></li>
							<?php endif; ?>-->
							<!-- ### -->
						</ul>				
					</div>
				</div>
				<div class="right">
					<div class="col-md-10">
						<?php echo $this->Flash->render(); ?>
						<?php echo $this->fetch('content'); ?>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>

