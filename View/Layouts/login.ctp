<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>LVC - Libro Virtual de Clases <?php echo $this->fetch('title'); ?></title>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			"../material/css/bootstrap.css",
			"../fa/css/font-awesome.min.css",
			"../material/vendors/animate-css/animate.min.css",
			"../material/vendors/sweet-alert/sweet-alert.min.css",
			"../material/vendors/material-icons/material-design-iconic-font.min.css",
			"../material/vendors/socicon/socicon.min.css",
			'../material/vendors/chosen/chosen.css',
			"../material/css/app.css",
			"../material/css/app.min.1.css",
			"../material/css/app.min.2.css",
			'../fonts/font.css',
			'coordinadores.css',
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
			'docentes.js',
			'../material/vendors/chosen/chosen.jquery.js',
			'../material/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
		));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'>
<style>
	.caja-login{
		margin-top: 36% !important;
	}
	.login-content{
		height: 100% !important;
	}
	.img_login{
		height: 500px;
		width: 900px;
		border: 4px solid #FCA60A;
		margin-top: 10%;
	}
	footer{
		background: #34495e;
		height: 200px;
		width: 100%;
	}
	.img_duoc_uc{
		height: 80px;
		left: 39%;
		position: absolute;
		top: 0;
		width: 240px;
		z-index: 9999;
	}
	.titulo{
		color: #000;
		font-size: 1.8em;
		position: absolute;
		right: 20%;
		top: -15%;
		z-index: 999999;
		width: 60%;
		border: 1px solid #ddd;
		background: #fff;
		
		font-family: Roboto;
		font-weight: bold;
	}
	#l-login{
		width: 400px !important;
	}
</style>
<body class="login-content">
	<header>
		<?php echo $this->Html->image('logo-duoc-v2.png',array('class'=>'img_duoc_uc')); ?>
	</header>
	<div class="col-md-6">
		<figure>
			<?php echo $this->Html->image('lvc.jpg',array('class'=>'img_login')); ?>
		</figure>
	</div>
	<div class="col-md-6" id="fondo" >
		<?php echo $this->Flash->render(); ?>
		<?php echo $this->fetch('content'); ?>
	</div>
</body>
</html>
