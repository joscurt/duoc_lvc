<?php 
	$controller = strtolower($this->request->params['controller']);
	$action = $this->request->params['action'];
	$session_data = $this->Session->read('CoordinadorLogueado');
	$session_data2 = $this->Session->read('DirectorLogueado');

	$in_home = $controller == "administradores" && $action == "index" ? "active" : "";
	$in_home = $controller == "administradores" && $action == "crearReforzamiento" ? "active" : $in_home;
	$in_home = $controller == "administradores" && $action == "fichaDetalleClase" ? "active" : $in_home;
	$in_disponibilidad_sala = $controller == "administradores" && $action == "disponibilidadSala" ? "active" : "";
	$in_horario_carga_docente = $controller == "administradores" && $action == "horarioCargaDocente" ? "active" : "";
	$in_asistencia_docente = $controller == "administradores" && $action == "asistenciaDocente" ? "active" : "";
	$in_asistencia_docente = $controller == "administradores" && $action == "fichaAsistenciaDocenteDetalle" ? "active" : $in_asistencia_docente;
	$in_solicitud_recuperacion = $controller == "administradores" && $action == "solicitudRecuperacion" ? "active" : "";
	$in_solicitud_recuperacion = $controller == "administradores" && $action == "solicitudRecuperacionTopeHorario" ? "active" : $in_solicitud_recuperacion;
	$in_reportes = $controller == "administradores" && $action == "reportes" ? "active" : "";

	#debug($session_data);exit();
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
				// 'docentes.css',
				'coordinadores.css',
				'tooltip.css',
				"../fa/css/font-awesome.min.css",
				"../fa/material-icons/material-design-iconic-font.css",
				"../material/vendors/animate-css/animate.min.css",
				"../material/vendors/sweet-alert/sweet-alert.min.css",
				"../material/vendors/material-icons/material-design-iconic-font.min.css",
				"../material/vendors/socicon/socicon.min.css",
				'../material/vendors/chosen/chosen.css',
				"../material/vendors/noUiSlider/jquery.nouislider.min.css",
				"../material/vendors/farbtastic/farbtastic.css",
				"../material/css/app.min.1.css",
				"../material/css/app.min.2.css",
				//'jquery-ui.css',
			));
			echo $this->Html->script(array(
				"../material/js/jquery-2.1.1.min.js",
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
				'../material/vendors/chosen/chosen.jquery.js',
				'../material/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
				"jquery.price_format.2.0.min.js",
				"../material/js/charts.js",
				/*"../material/js/functions.js",*/
				"../material/js/demo.js",
				"quicksearch.js",
				"docentes.js",
				"dropzone.js",
				//'jquery-ui.js',

			));
			if ($action != 'solicitudRecuperacionTopeHorario') {
				echo $this->Html->script(array(
					'jquery-ui.js',
				));
				echo $this->Html->css(array(
					'jquery-ui.css',
				));
			}
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
						<label>Usuario: </label><?php echo $session_data['CoordinadorDocente']['NOMBRES'].' '.$session_data['CoordinadorDocente']['APELLIDO_PAT'].' '.$session_data['CoordinadorDocente']['APELLIDO_MAT']; ?>
						<a href="<?php echo $this->Html->url(array('controller'=>'login','action'=>'logoutCoordinador')); ?>"><i class="fa fa-power-off" ></i> Cerrar Sesión 1</a>					
					</div>
					<div class="">		
						<?php echo $this->Html->image('logo-duoc-v2.png',array('class'=>'logo')); ?>
					</div>
				</div>
			</header>
			<div class="row column">
				<br><br>
				<div class="left">
					<div class="col-md-2 card">
						<div class="fecha"><i class="fa fa-calendar-o" aria-hidden="true"></i><?php $FechaActual=date('d-m-Y h:i A'); echo $FechaActual; ?></div>
						<ul class="menu menu-coordinador">
							<?php foreach ($funcionalidades as $key => $value) {
								$action = $value['Funcionalidad']['ACTION'];
								$controller = $value['Funcionalidad']['CONTROLLER'];
								if ($value['Funcionalidad']['VISTA_ID'] == $session_data['Vista']['ID'] && $value['Funcionalidad']['ACTIVO'] == 1) {
														
							?>
							<li><a href="<?php echo $this->Html->url(array("controller" => "".$controller."","action" => "".$action."")) ?>"><?php echo $value['Funcionalidad']['NOMBRE']; ?></a></li>
							<?php }} ?>



							<!--<?php if (isset($funcionalidades[7])): ?>
								<li class="<?php echo $in_home;?>"><a href="<?php echo $this->Html->url(array('action'=>'index')) ?>" title="Gestión de clases" >Gestión de clases</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[8])): ?>
								<li class="<?php echo $in_disponibilidad_sala ?>"><a href="<?php echo $this->Html->url(array('action'=>'disponibilidadSala')) ?>" title="Disponibilidad Sala">Disponibilidad Sala</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[9])): ?>
								<li class="<?php echo $in_horario_carga_docente ?>"><a href="<?php echo $this->Html->url(array('action'=>'horarioCargaDocente')) ?>" title="Horario y carga docente" >Horario y carga docente</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[10])): ?>
								<li class="<?php echo $in_asistencia_docente ?>"><a href="<?php echo $this->Html->url(array('action'=>'asistenciaDocente')) ?>" title="Asistencia docente" >Asistencia docente</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[11])): ?>
								<li class="<?php echo $in_solicitud_recuperacion ?>"><a href="<?php echo $this->Html->url(array('action'=>'solicitudRecuperacion')) ?>" title="Solicitud de recuperación" >Solicitud de recuperación</a></li>
							<?php endif; ?>
							<?php if (isset($funcionalidades[61])): ?>
								<li class="<?php echo $in_reportes ?>"><a href="<?php echo $this->Html->url(array('action'=>'reportes')) ?>" title="Reportes" >Reportes</a></li>
							<?php endif; ?>-->
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
		<script>
			$(function(){
				$('.date-time-picker').datetimepicker({
					format: 'DD-MM-YYYY'
				});

		        $('.picker-a').datetimepicker();
		        $('.picker-b').datetimepicker({
		            useCurrent: false //Important! See issue #1075
		        });
		        $(".picker-a").on("dp.change", function (e) {
		            $('.picker-b').data("DateTimePicker").minDate(e.date);
		        });
		        $(".picker-b").on("dp.change", function (e) {
		            $('.picker-a').data("DateTimePicker").maxDate(e.date);
		        });
			});
		</script>
	</body>
</html>

