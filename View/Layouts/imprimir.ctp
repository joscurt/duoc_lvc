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
				"../material/css/app.min.2.css"
			));
			echo $this->Html->script(array(
				'../material/js/jquery-2.1.1.min.js',
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
	<body style="padding-top:4px;">
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<?php echo $this->Flash->render(); ?>
					<?php echo $this->fetch('content'); ?>
				</div>
			</div>
		</div>
		<script>
			window.print();
		</script>
	</body>
</html>

