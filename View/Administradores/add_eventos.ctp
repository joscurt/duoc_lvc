<style>
	.panel-eventos .panel{
		border:1px solid #ccc;
		display: inline-block;
		vertical-align: top;
	}
	.panel-eventos .panel.panel-list{
		width: 20%;
	}
	.panel-eventos .panel.panel-list ul{
		list-style: none;
		margin: 0;
		padding: 0;
		text-align: center;
	}
	.panel-eventos .panel.panel-list ul li:last-child a{
		border-bottom: 0px;
	}
	.panel-eventos .panel.panel-list ul li a{
		height: 80px;
		display: block;
		padding: 30px;
		border-bottom: 1px solid #ccc;
		font-size: 1.3em;
		color: black;
	}
	.panel-eventos .panel.panel-list ul li a.active{
		background: #002952;
		border: 1px solid #002952 !important;
		color: white;
	}
	.panel-eventos .panel.panel-content{
		width: 79%;
	}
	.panel-eventos .panel.panel-content .panel-html{
		padding: 10px;
		height: 320px;
	}
	.panel-eventos .panel.panel-content .panel-html h3{
		text-decoration: underline;
	}
	.panel-eventos .panel.panel-content .panel-html .asignatura{
		margin: 3px 0px 3px 0px;
		border: 1px solid #ddd;		
		padding: 8px;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
		background: #ecf0f1;
	}
	.panel-eventos .panel.panel-content .panel-html .asignatura.active{
		background: #002952;
	    border: 1px solid #002952 !important;
	    color: white;
	}
</style>
<br>
<div class="card">
	<div class="card-header">
		<h2 style="font-weight: bold; color:#ccc; font-size: 1.8em;"><i class="fa fa-plus"></i>&nbsp;Crear Eventos no Programados.</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12 panel-eventos">
				<div class="panel-list panel">
					<ul>
						<li>
							<a id="boton_suspension"href="#suspension" class="active">Suspension</a>
						</li>
						<li>
							<a href="#atraso">Atraso</a>
						</li>
						<li>
							<a href="#reforzamiento">Reforzamiento</a>
						</li>
						<li>
							<a id="boton_otros"href="#otros">Adelantar Clase Programada</a>
						</li>
					</ul>
				</div>
				<div class="panel-content panel">
					<div class="panel-html " id="suspension">
						<div class="row">
							<div class="col-md-6">
								<h3>Buscar Eventos Suspendidos</h3>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="select">
										<label for="">Seleccione un Docente</label>
										<select class="form-control selectpicker"  data-live-search="true" id="">
											<option value=""></option>
											<?php foreach ($docentes as $key => $value): ?>
												<option value=""><?php echo $value['rut'].' / '.$value['nombre']; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="select">
										<label for="">Seleccione una Asignatura</label>
										<select class="form-control selectpicker"  data-live-search="true" id="">
											<option value=""></option>
											<option value=""> INU100 - Ingles I</option>
											<option value=""> MAT100 - Matematicas I</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<button class="pull-right btn bgm-green btn-sm"><i class="fa fa-search"></i> Buscar</button>
							</div>
						</div>
						<div class="row m-t-20">
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V001</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-titulo-asignatura" style="display: none;">
							<div class="col-md-12">
								<h3 > Crear Evento: LPII102-V001 / Lenguajes de Programaci&oacute;n I</h3>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="div-content-horario">
									
								</div>
							</div>
						</div>
					</div>
					<div class="panel-html " id="otros" style="display: none;">
						<div class="row">
							<div class="col-md-6">
								<h3>Adelantar Clase Programada</h3>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<div class="select">
										<label for="">Seleccione un Docente</label>
										<select class="form-control selectpicker"  data-live-search="true" id="">
											<option value=""></option>
											<?php foreach ($docentes as $key => $value): ?>
												<option value=""><?php echo $value['rut'].' / '.$value['nombre']; ?></option>
											<?php endforeach ?>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<div class="select">
										<label for="">Seleccione una Asignatura</label>
										<select class="form-control selectpicker"  data-live-search="true" id="">
											<option value=""></option>
											<option value=""> INU100 - Ingles I</option>
											<option value=""> MAT100 - Matematicas I</option>
										</select>
									</div>
								</div>
							</div>
							<div class="col-md-12">
								<button class="pull-right btn bgm-green btn-sm"><i class="fa fa-search"></i> Buscar</button>
							</div>
						</div>
						<div class="row m-t-20">
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V001</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-3 ">
								<div class="asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;">LPII102-V</strong>	
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;">Sala 001</strong>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span>Lenguajes de Programaci&oacute;n I</span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Pr&oacute;xima Clase</span>&nbsp;16-09-2015 10:00</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-building"></i>&nbsp;INFORMATICA</span>	
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span><i class="fa fa-home"></i>&nbsp;Analista Programador</span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;" class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;">Alvaro Guerrero</span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:yellow" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="row row-titulo-asignatura" style="display: none;">
							<div class="col-md-12">
								<h3 > Crear Evento: LPII102-V001 / Lenguajes de Programaci&oacute;n I</h3>
								<br>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div id="div-content-horario">
									
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<script>
	/*$('#boton_otros').click(function(event) {
		$('#suspension').hide();
		$('#boton_suspension').removeClass('active');
		$(this).addClass('active');
		$('#otros').show();
	});*/
	$('#boton_suspension').click(function(event) {
		$('#otros').hide();
		$('#boton_otros').removeClass('active');
		$(this).addClass('active');
		$('#suspension').show();
	});
	$('.asignatura').on('click',function(){
		$('.asignatura').removeClass('active');
		$(this).addClass('active');
		$('#div-content-horario').load("<?php echo $this->Html->url(array('action'=>'viewAjax','admin')); ?>");
		$('#div-content-horario').show();
		$('.row-titulo-asignatura').show();
	});
</script>