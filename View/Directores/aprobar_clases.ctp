<style>
	i[icono-info]{
		color: #2980b9;
	}
	a[font-size-small]{
		font-size: 10px;
		font-weight: bold;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
		padding: 5px !important;
	}
	.leyenda{
		vertical-align: top;
		width: 20px !important;
		height: 20px;
		display: inline-block;
		text-align: center;
	}
	.texto_leyenda{
		display: inline-block;
		vertical-align: top;
		font-weight: bold;
		color:#000;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 8px !important;
	}
	th{
		font-weight: 500 !important;
		text-align: center;
	}
	.titulo_mes{
		color: red;
		float: right;
		margin-right: 50%;
		font-size: 1.2em;
	}
	.dia-semana{font-weight: bold;}
	.col-md-2-calendar{
		margin-left: 3.8%;
		border-left: 1px solid #dedede;
	}
	.mes-calendario td:hover{
		background-color:#f1f1f1;
	}
	.mes-calendario .td-active:hover{
		background-color:#26A65B;;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#ccc;;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#ccc;;
	}
	#table-eventos td{
		padding:3px !important;
		vertical-align: middle;
	}
	.error{
		color:red;
	}
	.btn-verde{
		background: #1abc9c !important;
		color: #fff !important;
	}
	.btn-rojo{
		background: #c0392b !important;
		color: #fff !important;
	}
	.li_detalle_hora{
		border: 1px solid #ddd;
	    padding: 5px;
	    background: #f1f1f1;
	    margin-right: 5px;
	    margin-bottom: 3px;
	}
	ul.ul_horas li{
		display: inline-block !important;
	}
	.proxima_fecha{
		height: 70px;
		width: 100px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		background: #EEEEEE;
		position: relative;
	}
	.fecha{
		font-size: 2em;
		font-weight: bold;
		color:#000;
		display: block;
		text-align: center;
	}
	.mes{
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		background: #e74c3c;
		color:#fff;
		height: 20px;
		font-weight: bold;
		font-size: 1.2em;
		text-align: center;
	}
	.adjuntar{
		height: 100px;
		width: 100%;
		border:3px dashed #ccc;
		text-align: center;
	}
	.adjuntar span{
		color:#ccc;
		font-weight: bold;
		font-size: 1.8em;
	}
	.botonera a{
		width: 200px;
		margin-left: 15px;
	}
	.botonera a{
		padding: 6px 7px;
		font-size: 1em;
		vertical-align: middle;
	}
	.botonera a:hover{
		background-color: #34495e;
		color: white !important;
	}
	.botonera a:hover i{
		color: white !important;
	}
	.td-app{
		font-weight: 500 !important;
	}
	
</style>
<br>
<div class="card" >
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-12">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SEDE</label>
					<p class="c-black f-500 m-b-20">Antonio Varas</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">CARRERA</label>
					<p class="c-black f-500 m-b-20">Ingenier&iacute;a en Informatica</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SECCI&Oacute;N</label>
					<p class="c-black f-500 m-b-20">PL201202V</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">JORNADA</label>
					<p class="c-black f-500 m-b-20">Vespertina</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">NOMBRE ASIGNATURA</label>
					<p class="c-black f-500 m-b-20">Pr&aacute;ctica Laboral</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-12" style="margin-bottom: 3%;">
				<div class="col-md-3">
					<a 
						style="margin-top: 3px;"id="aprobar" 
						class="btn btn-success btn-sm"><i style="color:#fff;"class="fa fa-check-circle"></i>&nbsp;&nbsp;Aprobar Evento
					</a>
					<a 
						style="margin-top: 3px;"id="rechazar"
						class="btn btn-danger btn-sm"><i style="color:#fff;"class="fa fa-times"></i>&nbsp;&nbsp;Rechazar Evento
					</a>
				</div>
				<div class="col-md-4">
					<strong><i style="font-size: 2em;color: #e67e22;"class="fa fa-user"></i>&nbsp;&nbsp;Cordinador Docente:</strong>
					<span>Juan Lillo</span>
				</div>
			</div>
			<div class="col-md-12"style="margin-bottom: 3%;">
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-graduation-cap"></i>&nbsp;DOCENTE</label>
						<p class="c-black f-500 m-b-20">Ernesto Eduardo Vivanco Tapia</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;RUT</label>
						<p class="c-black f-500 m-b-20">16.098.765-3</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;ESTADO</label> 
						<p class="c-black f-500 m-b-20">Asistencia</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-calendar"></i>&nbsp;CLASE PROGRAMADA</label>
						<p class="c-black f-500 m-b-20">12/03/2016</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;PROMEDIO ASISTENCIA</label>
						<p class="c-black f-500 m-b-20">95%</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-calendar"></i>&nbsp;CLASES REGISTRADAS</label>
						<p class="c-black f-500 m-b-20">10</p>
					</div>
				</div>
			</div>
		<hr>
		<br><br>
		<!-- Ver Curso -->
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<div class="row" style="background: #ddd; color: #34495e; padding: 10px; margin-bottom: 10px;">
						<div class="col-md-12">
							<div class="col-md-3"><label>Clases Regulares Registradas: </label>&nbsp;<strong>10</strong></div>
							<div class="col-md-3"><label>Clases Regulares: </label>&nbsp;<strong>50</strong></div>
							<div class="col-md-3"><label>Clases Regulares Suspendidas: </label>&nbsp;<strong>1</strong></div>
							<div class="col-md-3"><label>Asistencia Promedio: </label>&nbsp;<strong>64%</strong></div>
						</div>
					</div>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="td-app">N&deg;</th>
								<th class="td-app" style="text-align: left">Rut Alumno</th>
								<th class="td-app" style="text-align: left">Apellido Paterno</th>
								<th class="td-app" style="text-align: left">Apellido Materno</th>
								<th class="td-app" style="text-align: left">Nombres</th>
								<th align="center"class="td-app">Clases Presente</th>
								<th align="center"class="td-app">Clases Ausente</th>
								<th align="center"class="td-app">Asistencia Actual</th>
								<th align="center"class="td-app">Asistencia</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($alumnos as $key => $value): ?>
								<tr>
									<td><?php echo $key +1;?></td>
									<td><?php echo strtoupper($value['rut']); ?></td>
									<td><?php echo strtoupper($value['paterno']); ?></td>
									<td><?php echo strtoupper($value['materno']); ?></td>
									<td>
										<?php if ($key == 0): ?>
											<!-- <a style="cursor: pointer; "class="alumno_active"><?php echo strtoupper($value['nombre']); ?></a> -->
											<?php echo strtoupper($value['nombre']); ?>
										<?php else: ?>	
											<?php echo strtoupper($value['nombre']); ?>
										<?php endif ?>
									</td>
									<td align="center"><?php echo '10'; ?></td>
									<td align="center"><span class="badge" style="background:#34495e !important;"><?php echo '40'; ?></span></td>
									<td align="center" style="color:red;"><?php echo $key == 0 || $key == 3 || $key == 7 ? '75' : '95'; ?>%</td>
									<td align="center" style="color:red;">100%</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding" align="center">
		<a href="<?php echo $this->Html->url(array('action'=>'aprobarClasesNoProgramadas')); ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>	
	</div>
</div>
<script>
	$('#aprobar').click(function(event) {
		alert('¿Esta seguro de aprobar el evento?');
	});
	$('#rechazar').click(function(event) {
		alert('¿Esta seguro de rechazar el evento?');
	});
	$('#atraso').blur(function(event) {
		$('#minutos_atraso').show();
	});
	$('.guardar_docente').click(function(event) {
		$('.dashed').hide();
		$('#mensaje_docente').empty();
		$('#mensaje_docente').html('<strong style="color:green !important">Docente con Disponibilidad</strong>');
		$('#docente').empty();
		$('#docente').html('Ernesto Vivanco');
	});
	$('#reservar_sala').click(function(event) {
		$('.horario_salas').hide();
		$('#mensaje_sala').empty();
		$('#mensaje_sala').html('<strong style="color:green !important">Sala con Disponibilidad</strong>');
		$('#numer_sala').empty();
		$('#numer_sala').html('Sala 100');
	});
	$('.btn_horario').click(function(event) {
		$('.error_docente').show();
		$('.error_sala').show();
	});
	$('.btn_cambio_docente').click(function(event) {
		$('.error_').hide();
		$('#select_remplazo_').show();
	});
	$('.btn_cambio_sala').click(function(event) {
		$('.horario_salas').show();
	});
	$('#select_remplazo_').change(function(event) {
		$('#select_tipo_remplazo').show();
	});
	$('#select_tipo_remplazo').change(function(event) {
		$('#observaciones_reemplazo_').show();
	});
 	if ($('.date-picker')[0]) {
   		$('.date-picker').datetimepicker({
    		format: 'DD/MM/YYYY'
    	});
    }
	$('#hora').blur(function(event) {
		var value = $(this).val();
		if (value != '') {
			$('#ul_hidden').show();
		}
	});
	$(function() {
		//var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->Html->url(array('controller'=>'Administradores','action'=>'addFiles')) ?>"});
		var myDropzone = new Dropzone('div#myId', {
			url: '<?php echo $this->Html->url(array('action'=>'addFiles')) ?>',
			paramName: "data[Files]",
			maxFilesize: 2,
			uploadMultiple: true,
			parallelUploads: 2,
			acceptedFiles: "image/*",
			autoProcessQueue: true,
		});
	});
	$('#seelect_remplazo_docente').change(function(event) {
		$('#select_remplazo').show();
		$('#observaciones_reemplazo').show();
	});
	$('.time-picker').datetimepicker({
    	    format: 'LT'
    	});
	$('.suspender').change(function(event) {
		$('#motivo_suspension').show('fast');
		$('#docente_remplazo').hide('fast');
	});
	$('.remplazar').change(function(event) {
		$('#motivo_suspension').hide('fast');
		$('#docente_remplazo').show('fast');
	});
	$('.registrar').change(function(event) {
		$('#motivo_suspension').hide('fast');
		$('#docente_remplazo').hide('fast');
	});
</script>