<style>
	i[green]{
		color: green;
	}
	i[red]{
		color: red;
	}	
	.btn_exportar{
		padding: 1.5em;
		border:2px solid #ddd;
		border-radius: 5px;
		color:red;
		margin:10px;
	}
	.btn_exportar:hover {
		color: red;
	}
	#tbody_todo td{
		border-top:1px solid #fff !important;
		padding: 0px;
		vertical-align: middle !important;
		text-align: center !important;
	}
	.list{
		display: inline-block;
	}
	.fecha{
		-moz-transform: rotate(-90.0deg) !important;  /* FF3.5+ */
		-o-transform: rotate(-90.0deg)!important;  /* Opera 10.5 */
		-webkit-transform: rotate(-90.0deg)!important;  /* Saf3.1+, Chrome */
		filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)!important;  /* IE6,IE7 */
		-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"!important; 
		width: 50px !important;
	}
	.rotar_fecha{
		font-size: 10px;
		padding: 0px !important;
	}
	.clase{
		font-size: 12px;
		font-weight: bold;
		width: 92px !important;
		margin: -34px !important;
		-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
		-o-transform: rotate(-90.0deg);  /* Opera 10.5 */
		-webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
		filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
		-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; 
	}
	.td-app{
		font-weight: 500 !important;
	}
	.radio-inline, .checkbox-inline{
		left: 25% !important;
	}
	#ver_alumno_hiden td{
		padding: 2px !important;
	}
	table > tbody > tr > td{
		padding: 6px !important
	}
	.ul-leyenda-colores{
		list-style: none;
		margin-left: 0;
		padding-left: 5px;
	}
	.ul-leyenda-colores li{
		display: inline-block;
		margin-right: 30px;
	}
	.ul-leyenda-colores div.leyenda-color{
		border-radius: 5px;
		border: 1px solid #c4c4c4;
		display:inline-block; 
		height: 30px;
		margin-top: 4px;
		vertical-align: middle;
		width: 30px;
	}
	.ul-leyenda-colores div.leyenda-color.naranjo{background: #e67e22;}
	.ul-leyenda-colores div.leyenda-color.amarillo{background: #f1c40f;}
	.ul-leyenda-colores div.leyenda-color.gris{background: #c4c4c4;}
</style>
<br>
<div class="card">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-padding card-body">
		<?php  $active_selected = isset($id_html) ? $id_html : ''; ?>
		<div role="tabpanel">
			<ul role="tablist" class="tab-nav" style="overflow: hidden;" tabindex="1">
				<li class="active li_ver_alumno"><a data-toggle="tab" role="tab" aria-controls="ver_alumno" href="#ver_alumno" aria-expanded="false">Ver Alumno</a></li>
				<li class="li_ver_curso"><a data-toggle="tab" role="tab" aria-controls="ver_curso" href="#ver_curso" aria-expanded="false">Ver Curso</a></li>
				<li class="li_ver_todos"><a data-toggle="tab" role="tab" aria-controls="ver_todo" href="#ver_todo" aria-expanded="true">Ver Todo</a></li>
			</ul>
			<div class="tab-content">
				<div id="ver_alumno" class="tab-pane active">
					<br><br>
					<div class="row">
						<div class="col-md-6" >
							<div class="row">
								<div class="col-md-12">
									<label for="">Seleccionar Alumno</label>
									<select id="select-change-alumno" class="form-control selectpicker" data-live-search="true">
										<option value="">SELECCIONE ALUMNO</option>
										<?php foreach ($alumnos as $key => $value): ?>
											<option value="<?php echo $value['Alumno']['ID']; ?>" ><?php echo utf8_encode($value['Alumno']['RUT'].'-'.$value['Alumno']['DV_RUT'].' / '.$value['Alumno']['APELLIDO_PAT'].' '.$value['Alumno']['APELLIDO_MAT'].' '.$value['Alumno']['NOMBRES']); ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-12 animated fadeIn" id="contenido-alumno" style="display: none;">
						</div>
					</div>
				</div>
				<div id="ver_curso" class="tab-pane ">&nbsp;</div>
				<div id="ver_todo" class="tab-pane ">&nbsp;</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('a[data-rel="tooltip"]').tooltip();
	var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
	$('#select-change-alumno').on('change',function(event) {
		$('#contenido-alumno').html('<div align="center"></div>').show();
		$('#contenido-alumno div').html(img_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'detalleAsistenciaAlumno',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>/'+event.target.value,
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(view) {
			$('#contenido-alumno').html(view).show();
		});
	});

	$('a[href="#ver_alumno"]').on('click',function(event) {
		$('#ver_curso, #ver_todo').hide();
		$('#ver_alumno').show();
	});

	$('a[href="#ver_curso"]').on('click',function(event) {
		$('#ver_alumno, #ver_todo').hide();
		$('#ver_curso').empty().html('<div align="center"></div>').show();
		$('#ver_curso div').html(img_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'detalleAsistenciaCurso',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>',
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(view) {
			$('#ver_curso').html(view).show();
		});
	});

	$('a[href="#ver_todo"]').on('click',function(event) {
		$('#ver_curso, #ver_alumno').hide();
		$('#ver_todo').empty().html('<div align="center"></div>').show();
		$('#ver_todo div').html(img_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'detalleAsistenciaTodo',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>',
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(view) {
			$('#ver_todo').html(view).show();
		});
	});
</script>