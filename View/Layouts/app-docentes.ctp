<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		LVC - Libro Virtual de Clases 
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
		$docente = $this->Session->read('DocenteLogueado');
		echo $this->Html->meta('icon');
		echo $this->Html->css(array(
			'../fonts/font.css',
			'docentes.css',
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
			'../material/vendors/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js',
			'../material/vendors/chosen/chosen.jquery.js',
			"jquery.price_format.2.0.min.js",
			"../material/js/charts.js",
			/*"../material/js/functions.js",*/
			"../material/js/demo.js",
			"quicksearch.js",
			"docentes.js",
			"jquery.freezeheader.js",
			"jquery.validate.min.js"
		));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<style type="text/css">
		body , a ,.tooltip,.popover{
			font-family: 'roboto_condensedregular', sans-serif !important;
		}
		.icono{
			color:#fff;
			font-size: 2em;
			margin-top: 20px;
		}
		.link_icono{
			border:1px solid #fff;
			padding: 1.1em;
			border-radius: 5px;
			margin-right: 10px;
			background: #6C7A89;
		}
		.notificacion{
			position: absolute;
			background: red;
			color: #fff;
			height: 25px;
			width: 25px;
			border-radius: 50%;
			font-weight: bold;
			top: 8px;
			text-align: center;
		}
		.logo_corporativo{
			height: 50px;
			width: 150px;
			margin-top: -10px;
			margin-left: 10px;
		}
		.li-user-info:hover:before{
			background: inherit !important;
			-webkit-transform: none !important;
		    -moz-transform: none !important;
		    -ms-transform: none !important;
		    -o-transform: none !important;
		    transform: none !important;
		}
		.li-user-info{
			color: white;
			text-align: right;
			font-size:1.1em;
			padding-right: 10px;
		}
		.li-user-info span{
			display: block;
		}
		.back{
			margin-top: 0;
			display: block;
			position: fixed;
			width: 98.19%;
			min-height: 50px;
			z-index: 998;
			background: #EEEEEE !important;
		}
		.header-docente.card{
			margin-top: 16px;
			position: fixed;
			width: 98.19%;
			z-index: 999;
		}
		#elementLoader{
			display: none;
			position: fixed;
			padding: 10px;
			width: 380px;
			height: 320px;
			left: 50%; 
			top:  50%;
			margin: -160px auto auto -190px;			
			background: rgba( 238,  238,  238, 0.7);
			font-family: "Helvetica Neue",Helvetica,Arial,sans-serif;
			font-weight: bold;
			font-size: 14px;
			color: #655081;
			text-align: center;
			vertical-align: middle;
			z-index: 1002;
			border: solid 1px #fff;
			-webkit-border-radius: 6px;
			   -moz-border-radius: 6px;
				 -o-border-radius: 6px;
					border-radius: 6px;
			-webkit-box-shadow: 0px 0px 20px 0px rgba(80, 119, 149, 0.3);
			   -moz-box-shadow: 0px 0px 20px 0px rgba(80, 119, 149, 0.3);
				 -o-box-shadow: 0px 0px 20px 0px rgba(80, 119, 149, 0.3);
					box-shadow: 0px 0px 20px 0px rgba(80, 119, 149, 0.3);
		}
	</style>
</head>
<body>
    <div id="elementLoader">
        <center>
        	<?php echo $this->Html->image('loading.gif', array('class' => 'img-responsive')); ?><br>
        </center>
    </div>
	<div id="container">
		<header id="header" style="background: #003964;">
            <ul class="header-inner">    
	            <li class="logo hidden-xs">
	                    <?php echo $this->Html->image('logo-duoc-v2.png',array('class'=>'logo_corporativo')); ?>
	            </li>
                <li class="pull-right">
	                <ul class="top-menu">
	                	<li class="li-user-info">
	                		<div >
	                			Docente: <?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']; ?> 
	                			<!--<span><?php echo $docente['Docente']['CORREO']; ?></span>-->
	                			<span><?php $FechaActual=date('d-m-Y h:i A'); echo $FechaActual; ?></span>
	                		</div>
	                	</li>
	                    <li class="dropdown">
	                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
	                        <ul class="dropdown-menu dm-icon pull-right">
	                            <li>
	                                <a href="<?php echo $this->Html->url(array('controller'=>'docentes','action'=>'getEventos')); ?>"><i style="color:gray;"class="md md-home"></i>Programación de Clases</a>
	                            </li>
	                            <li>
	                                <a data-action="fullscreen" href="<?php echo $this->Html->url(array('controller'=>'Login','action'=>'login')) ?>"><i style="color:red;"class="md md-settings-power"></i>Salir</a>
	                            </li>
	                        </ul>
	                    </li>
                    </ul>
                </li>
            </ul>
        </header>
		<div id="row">
			<!--<nav class="navegacion_app">
				<ul class="ul_navegacion_app">
					<li class="link_active li_navegacion_app"><a class="a_navegacion_app" href="<?php echo $this->Html->Url(array('controller'=>'Docentes','action'=>'getEventos')) ?>"><i class="icono_nav icono_active fa fa-book"></i></a></li>
					<li class="li_navegacion_app"><a class="a_navegacion_app" href=""><i class=" icono_nav fa fa-cog"></i></a></li>
					<li class="li_navegacion_app"><a class="a_navegacion_app" href=""><i class="icono_nav fa fa-edit"></i></a></li>
					<li class="li_navegacion_app"><a class="a_navegacion_app" href=""><i class="icono_nav fa fa-file"></i></a></li>
					<li class="li_navegacion_app"><a class="a_navegacion_app" href=""><i class="icono_nav fa fa-file-text"></i></a></li>
					<li class="li_navegacion_app"><a class="a_navegacion_app" href=""><i class="icono_nav fa fa-power-off"></i></a></li>
				</ul>
			</nav>-->
			<div class="col-md-12">
				<?php echo $this->Flash->render(); ?>
				<?php echo $this->fetch('content'); ?>
			</div>
		</div>
		<div id="footer">
		</div>
		<script type="text/javascript">
			if($('.tag-select')[0]) {
				$('.tag-select').chosen({
					width: '100%',
					allow_single_deselect: true
				});
			}
			if($('a[data-rel="tooltip"]')[0]){
				$('a[data-rel="tooltip"]').tooltip();
			}
		</script>
	</div>
	<?php #echo $this->element('sql_dump'); ?>
</body>
</html>
