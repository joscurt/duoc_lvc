<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		LVC - Libro Virtual de Clases 
		<?php echo $this->fetch('title'); ?>
	</title>
	<?php
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
			"../material/css/app.min.2.css",
			'dropzone.css'
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
			// "../material/js/functions.js",
			"../material/js/demo.js",
			"quicksearch.js",
			'dropzone.js'
		));
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
	<!-- <link href='https://fonts.googleapis.com/css?family=Roboto+Condensed:300' rel='stylesheet' type='text/css'> -->
	<style >
		body , a ,.tooltip,.popover{
			font-family: 'roboto_condensedregular', sans-serif !important;
		}
		.logo_corporativo{
			height: 50px;
			width: 150px;
			margin-top: -10px;
			margin-left: 10px;
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
		.modal-header{
			background: #34495e !important;
		}
		.modal-header h4{
			color:#fff !important;
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
	</style>
</head>
<body>
	<div id="container">
		<header id="header" style="background: #003964;">
            <ul class="header-inner">    
	            <li class="logo hidden-xs">
	                    <?php echo $this->Html->image('logo-duoc-v2.png',array('class'=>'logo_corporativo')); ?>
	            </li>
                <li class="pull-right">
	                <ul class="top-menu">
	                	<li class="li-user-info"><div >Coordinador Docente: Juan Carlos Ayala <span>jcayala@insotec.cl</span></div></li>
	                    <li class="dropdown">
	                        <a data-toggle="dropdown" class="tm-notification" href=""><i class="tmn-counts">9</i></a>
	                        <div class="dropdown-menu dropdown-menu-lg pull-right">
	                            <div class="listview" id="notifications">
	                                <div class="lv-header">
	                                    Notificaciones
	                                    <ul class="actions">
	                                        <li class="dropdown">
	                                            <a href="" data-clear="notification">
	                                                <i class="md md-done-all"></i>
	                                            </a>
	                                        </li>
	                                    </ul>
	                                </div>
	                                <div class="lv-body c-overflow" tabindex="2" style="overflow: hidden; outline: none;">
	                                    <a class="lv-item" href="">
	                                        <div class="media">
	                                            <div class="media-body">
	                                                <div class="lv-title">Notificación</div>
	                                                <small class="lv-small">Cum sociis natoque penatibus et magnis dis parturient montes</small>
	                                            </div>
	                                        </div>
	                                    </a>
	                                    <a class="lv-item" href="">
	                                        <div class="media">
	                                            <div class="media-body">
	                                                <div class="lv-title">Notificación</div>
	                                                <small class="lv-small">Nunc quis diam diamurabitur at dolor elementum, dictum turpis vel</small>
	                                            </div>
	                                        </div>
	                                    </a>
	                                    <a class="lv-item" href="">
	                                        <div class="media">
	                                            <div class="media-body">
	                                                <div class="lv-title">Notificación</div>
	                                                <small class="lv-small">Phasellus a ante et est ornare accumsan at vel magnauis blandit turpis at augue ultricies</small>
	                                            </div>
	                                        </div>
	                                    </a>
	                                    <a class="lv-item" href="">
	                                        <div class="media">
	                                            <div class="media-body">
	                                                <div class="lv-title">Notificación</div>
	                                                <small class="lv-small">Ut vitae lacus sem ellentesque maximus, nunc sit amet varius dignissim, dui est consectetur neque</small>
	                                            </div>
	                                        </div>
	                                    </a>
	                                    <a class="lv-item" href="">
	                                        <div class="media">
	                                            <div class="media-body">
	                                                <div class="lv-title">Notificación</div>
	                                                <small class="lv-small">Proin laoreet commodo eros id faucibus. Donec ligula quam, imperdiet vel ante placerat</small>
	                                            </div>
	                                        </div>
	                                    </a>
	                                </div>
	                                <a class="lv-footer" href="">Ver Todas las Notificaciones</a>
	                            </div>
	                        <div id="ascrail2003" class="nicescroll-rails nicescroll-rails-vr" style="width: 0px; z-index: 9; cursor: default; position: absolute; top: 0px; left: 298px; height: 275px; display: none;"><div class="nicescroll-cursors" style="position: relative; top: 0px; float: right; width: 0px; height: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div></div><div id="ascrail2003-hr" class="nicescroll-rails nicescroll-rails-hr" style="height: 0px; z-index: 9; top: 275px; left: 0px; position: absolute; cursor: default; display: none;"><div class="nicescroll-cursors" style="position: absolute; top: 0px; height: 0px; width: 0px; border: 0px; border-radius: 0px; background-color: rgba(0, 0, 0, 0.498039); background-clip: padding-box;"></div></div></div>
	                    </li>
	                    <li class="dropdown">
	                        <a data-toggle="dropdown" class="tm-settings" href=""></a>
	                        <ul class="dropdown-menu dm-icon pull-right">
	                            <!-- <li>
	                                <a data-action="fullscreen" href="<?php echo $this->Html->url(array('action'=>'revisarAtrasosDocentes')) ?>"><i style="color:#3498db;"class="md md-alarm-add"></i>Revisar Atrasos</a>
	                            </li> -->
	                            <li>
	                                <a data-action="clear-localstorage" href="<?php echo $this->Html->url(array('action'=>'addEventos')) ?>"><i style="color:green;"class="md md-add"></i>Crear Eventos</a>
	                            </li>
	                            <li>
	                                <a data-action="fullscreen" ><i style="color:#34495e;"class="md md-settings-applications"></i> BackOffice</a>
	                            </li>
	                            <li>
	                                <a data-action="clear-localstorage" href="<?php echo $this->Html->url(array('controller'=>'Administradores','action'=>'suspenderMasivo')) ?>"><i style="color:#e67e22;"class="md md-warning"></i>Suspensión de clases</a>
	                            </li>
	                            <li>
	                                <a data-action="fullscreen" href="<?php echo $this->Html->url(array('controller'=>'Administradores','action'=>'login')) ?>"><i style="color:red;"class="md md-settings-power"></i>Salir</a>
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
	</div>
	<script>$('a[data-rel="tooltip"]').tooltip();</script>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
