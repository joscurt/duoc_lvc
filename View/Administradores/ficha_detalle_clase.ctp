<style type="text/css">
	.bloque .bloque-top .column:last-child,
	.bloque .bloque-bottom .column:last-child{border:0 !important;}

	#modal-editar .modal{display: block !important;}
	#modal-editar .modal-dialog{overflow-y: initial !important}
	#modal-editar .modal-body{height: 400px;overflow-y: auto;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header"><h1>Gesti&oacute;n de Clases</h1></div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Editar:</label>
					<select class="form-control selectpicker select-modal" data-live-search="true">
						<option value="">SELECCIONAR</option>
						<option value="<?php echo $this->Html->url(array('action'=>'cambiarSala',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">CAMBIAR SALA</option>
						<option value="<?php echo $this->Html->url(array('action'=>'inasistenciaDocente',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">INASISTENCIA DOCENTE</option>
						<option value="<?php echo $this->Html->url(array('action'=>'justificacionLegal',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">JUSTIFICACI&Oacute;N LEGAL</option>
				

						<?php 
						if($programacion_clase['EstadoProgramacion']['ID'] == 3 && ($programacion_clase['Detalle']['ID'] == 4 || $programacion_clase['Detalle']['ID'] == 1 || $programacion_clase['Detalle']['ID'] == 5) ){?>


						<option value="<?php echo $this->Html->url(array('action'=>'adelantarClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">ADELANTAR CLASE</option>

						<?php } ?>

						<option value="<?php echo $this->Html->url(array('action'=>'ajusteEliminacionEstado',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">AJUSTES DE ESTADO</option>
					</select>
				</div>
			</div>
			<div class="col-md-1">
				<button class="btn btn-success" id="button-levantar-modal" style="margin-top: 27px;">OK</button>
			</div>
		</div>
	</div>
</div>
<div class="card editarFicha">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Docente:</h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Rut</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombres</th>
							<?php if (!empty($docente_reemplazo)): ?>
								<th>Docente Reemplazo</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['Docente']['RUT'].'-'.$programacion_clase['Docente']['DV']; ?></td>
							<td><?php echo ($programacion_clase['Docente']['APELLIDO_PAT']); ?></td>
							<td><?php echo ($programacion_clase['Docente']['APELLIDO_MAT']); ?></td>
							<td><?php echo ($programacion_clase['Docente']['NOMBRE']); ?></td>
							<?php if (!empty($docente_reemplazo)): ?>
								<td>
									<?php 
										echo ($docente_reemplazo['Docente']['NOMBRE']).' '.
											($docente_reemplazo['Docente']['APELLIDO_PAT']).' '.
											($docente_reemplazo['Docente']['APELLIDO_MAT']).' <br>'.
											$docente_reemplazo['Docente']['RUT'].'-'.$docente_reemplazo['Docente']['DV'];
									?>	
								</td>
							<?php endif ?>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Nombre asignatura</th>
							<th>Sigla-Secci&oacute;n</th>
							<th>Jornada</th>
							<th>Fecha programada</th>
							<th>Horario</th>
							<th>Sala</th>
							<?php if (!empty($programacion_clase['ProgramacionClase']['SALA_REEMPLAZO'])): ?>
								<th>Sala Reemplazo</th>
							<?php endif ?>
							<!-- <th>Tipo</th> -->
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['Asignatura']['NOMBRE']; ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['SIGLA_SECCION']; ?></td>
							<td><?php echo $asignatura_horario['AsignaturaHorario']['COD_JORNADA'] == 'D'?'DIURNA':'VESPERTINO'; ?></td>
							<td><?php echo date('d-m-Y',strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
							<td><?php echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])); ?></td>
							<td><?php echo $programacion_clase['Sala']['TIPO_SALA']; ?></td>
							<?php if (!empty($programacion_clase['ProgramacionClase']['SALA_REEMPLAZO'])): ?>
								<td><?php echo  $programacion_clase['ProgramacionClase']['SALA_REEMPLAZO']; ?></td>
							<?php endif ?>
							<!--<td><?php echo $programacion_clase['ProgramacionClase']['TIPO_EVENTO']; ?></td> -->
						</tr>	
					</tbody>
				</table>
				<br>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Tipo</th>
							<th>Fecha Original</th>
							<th>Horario Original</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['ProgramacionClase']['TIPO_EVENTO']; ?></td>
							<td><?php
							if(isset($programacion_clase['ProgramacionClase']['COD_PROGRAMACION_PADRE'])){
								echo date('d-m-Y',strtotime($prog_ade['ProgramacionClase']['FECHA_CLASE']));
								// ECHO "hola";
							}else{
								// ECHO "hola";
								echo date('d-m-Y',strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE']));
							}
							 ?></td>
							<td>
							<?php if (isset($programacion_clase['ProgramacionClase']['COD_PROGRAMACION_PADRE'])) {																	echo date('H:i', strtotime($prog_ade['ProgramacionClase']['HORA_INICIO'])).' a '.date('H.i',strtotime($prog_ade['ProgramacionClase']['HORA_FIN']));
							}else{
								echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN']));
							}
 ?>
							</td>

						</tr>
					</tbody>
				</table>
				<br>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Estado</th>
							<th>Motivo</th>
							<th>M&oacute;dulos programados</th>
							<th>M&oacute;dulos por recuperar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['EstadoProgramacion']['NOMBRE']; ?></td>
							<td><?php echo $programacion_clase['Detalle']['DETALLE'] ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?></td>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Modificaciones:</h2>
				<?php foreach ($logs_evento as $key => $log): ?>
					<div class="bloque">
						<div class="bloque-top">
							<div class="column">
								<label>Detalle: </label><?php echo $log['LogEvento']['DETALLE']; ?>
							</div>
							<div class="column">
								<label>Creada por: </label><?php echo $log['LogEvento']['USUARIO_CREADOR']; ?>
							</div>
							<div class="column last">
								<label>Fecha: </label><?php echo date('d-m-Y H:i',strtotime($log['LogEvento']['CREATED'])); ?>
							</div>
						</div>
						<div class="bloque-bottom">
							<?php if (!empty($log['LogEvento']['RUT_DOCENTE'])): ?>
								<div class="column">
									<label>Rut: </label> <?php echo $log['LogEvento']['RUT_DOCENTE']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['APELLIDO_PAT_DOCENTE'])): ?>
								<div class="column">
									<label>APELLIDO PATERNO: </label> <?php echo $log['LogEvento']['APELLIDO_PAT_DOCENTE']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['APELLIDO_MAT_DOCENTE'])): ?>
								<div class="column">
									<label>APELLIDO MATERNO: </label> <?php echo $log['LogEvento']['APELLIDO_MAT_DOCENTE']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['NOMBRES_DOCENTE'])): ?>
								<div class="column">
									<label>NOMBRE: </label> <?php echo $log['LogEvento']['NOMBRES_DOCENTE']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['MOTIVO'])): ?>
								<div class="column">
									<label>MOTIVO: </label> <?php echo $log['LogEvento']['MOTIVO']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['SALA_REEMPLAZO'])): ?>
								<div class="column">
									<label>SALA REEMPLAZO: </label> <?php echo $log['LogEvento']['SALA_REEMPLAZO']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['CAMBIO_ESTADO'])): ?>
								<div class="column">
									<?php echo $log['LogEvento']['CAMBIO_ESTADO']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['CAMBIO_SUB_ESTADO'])): ?>
								<div class="column">
									<?php echo $log['LogEvento']['CAMBIO_SUB_ESTADO']; ?>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['CAMBIO_DETALLE'])): ?>
								<div class="column">
									<?php echo $log['LogEvento']['CAMBIO_DETALLE']; ?>
								</div>
							<?php endif ?>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			<div class="col-md-8">
				<?php 
					if (!empty($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])){
						$dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']))/3600,2);
					}else{
						$dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']))/3600,2);
					}
					$enable_edit_asistencia = false;
					if ($dif > 24) {
						$enable_edit_asistencia = true;
					}
				?>
				<form action="<?php echo $this->Html->url(array('action'=>'saveAsistenciaFromFicha', $programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" id="form-send-asistencia" method="POST">
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Asistencia evento: </h2>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>Rut</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombres</th>
								<th>Asistencia</th>
							</tr>
						</thead>
					  	<tbody>
				  			<?php 
				  			$contador = 0;
				  			foreach ($listado_alumnos as $key => $value): 
				  				$contador++;
				  				$class = 'odd';
				  				if ($contador%2 ==0) {
				  					$class = 'even';
				  				} ?>
				  			<tr class="<?php echo $class; ?>">
								<td><?php echo $contador; ?></td>
								<td><?php echo $value['Alumno']['RUT']; ?></td>
								<td><?php echo $value['Alumno']['APELLIDO_PAT']; ?></td>
								<td><?php echo $value['Alumno']['APELLIDO_MAT']; ?></td>
								<td><?php echo $value['Alumno']['NOMBRES']; ?></td>
								<td>
									<div class="checkbox m-b-15">
										<label>
											<input type="hidden" name="data[Asistencia][<?php echo $contador; ?>][ID_ALUMNO]" value="<?php echo $value['Alumno']['ID']; ?>" />
											<input type="checkbox" 
												<?php if (!$enable_edit_asistencia): ?>
													disabled="disabled"
												<?php endif ?>
												name="data[Asistencia][<?php echo $contador; ?>][ASISTENCIA]"
												<?php echo $value['Asistencia']['ASISTENCIA'] == 1 ? 'checked="checked"' : null; ?>
												value="1" />
											<i class="input-helper"></i>
										</label>
									</div>
								</td>
							</tr>
					  		<?php endforeach; ?>
					  	</tbody>
					</table>
					<div class="card-header">
						<?php if ($enable_edit_asistencia and count($listado_alumnos)>0): ?>
							<button type="submit" class="btn btn-success <?php echo !$enable_edit_asistencia? ' disabled' : null; ?>">GUARDAR CAMBIOS ASISTENCIA</button>
						<?php endif ?>
						<a href="<?php echo $this->Html->url(array('action'=>'index')) ?>" class="btn btn-success" title="Volver">Volver</a>
					</div>
				</form>
			</div>
			<div class="col-md-4">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Bit&aacute;cora evento</h2>
				<ul>
					<?php foreach ($bitacora as $key => $bitacora_tmp): ?>
						<li>
							<h6><?php echo date('d-m-Y',strtotime($bitacora_tmp['Bitacora']['CREATED'])); ?></h6>
							<p><?php echo $bitacora_tmp['Bitacora']['DESCRIPCION']; ?></p>
						</li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</div>

<!-- VENTANA MODAL -->
<div class="modal" id="modal-editar" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        </div>
    </div>
</div>

<script type="text/javascript">
	$('.date-time-picker').datetimepicker({});
	$('.time-picker').datetimepicker({
		format: 'LT'
	});
	var data_docente = <?php echo json_encode(array('Docente'=>$programacion_clase['Docente'])); ?>;
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	$('#button-levantar-modal').on('click',function(){
		$('.select-modal').trigger('change');	
	});
	$('.select-modal').on('change',function (event) {
		if (event.target.value!="") {
			$('#modal-editar .modal-content').html('<div align="center"></div>');
			$('#modal-editar .modal-content div').html(imagen_cargando);
			$('#modal-editar').modal('show');
			$.ajax({
				url: event.target.value,
				type: 'POST',
				dataType: 'html',
			}).fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
				$('#modal-editar').modal('hide');
			}).always(function(view) {
				$('#modal-editar .modal-content').html(view);
			});
		}
	});
	$('#form-send-asistencia').on('submit',function (event) {
		elemento_submit = $(this);
		event.preventDefault();
		$('#modal-editar .modal-content').html('<div align="center"></div>');
		$('#modal-editar .modal-content div').html(imagen_cargando);
		$('#modal-editar').modal('show');
		$.ajax({
			url: elemento_submit.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: elemento_submit.serialize(),
		}).fail(function(error_reader) {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
			$('#modal-editar').modal('hide');
		}).always(function(response) {
			notifyUser(response.message,response.status);
			$('#modal-editar').modal('hide');
		});
	});
	$('body').on('click','.salir-modal-editar',function(){
		swal({
            title: "<?php echo __('?Está seguro de salir sin guardar ?'); ?>",   
            text: "<?php echo __(''); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sí, estoy seguro!",   
            closeOnConfirm: true 
        }, function(){
        	$('#modal-editar').modal('hide');
         });
	});
</script>

