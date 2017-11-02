<style type="text/css">
	.bloque .bloque-top .column:last-child,
	.bloque .bloque-bottom .column:last-child{border:0 !important;}

	#modal-editar .modal{display: block !important;}
	#modal-editar .modal-dialog{overflow-y: initial !important}
	#modal-editar .modal-body{height: 400px;overflow-y: auto;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header"><h1>Autorizaci&oacute;n de Asistencia</h1></div>	
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
								<td><?php echo  $programacion_clase['SalaReemplazo']['TIPO_SALA']; ?></td>
							<?php endif ?>
							<!--<td><?php echo $programacion_clase['ProgramacionClase']['TIPO_EVENTO']; ?></td> -->
						</tr>	
					</tbody>
				</table>
				<br>

				
			</div>
		
			<div class="col-md-12">
				<?php 
					if (!empty($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])){
						$dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']))/3600,2);
					}else{
						$dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']))/3600,2);
					}
					
						$enable_edit_asistencia = true;
					
				?>
				<form action="<?php echo $this->Html->url(array('action'=>'saveAsistenciaFromJustificados', $programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" id="form-send-asistencia" method="POST">
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Alumnos Justificados: </h2>
					<table class="table table-striped">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>Rut</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombres</th>
								<th>Asistencia</th>
								<th>Observacion</th>
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
									
									<div class="checkbox m-b-15" style="margin: 0px;">
            
       
                  					  <label class="radio radio-inline m-r-20" style="margin-top: 0px;">
											<input type="hidden" name="data[Asistencia][<?php echo $contador; ?>][ID_ALUMNO]" value="<?php echo $value['Alumno']['ID']; ?>" />
											<input type="radio" 
												<?php if (!$enable_edit_asistencia): ?>
													disabled="disabled"
												<?php endif ?>
												name="data[Asistencia][<?php echo $contador; ?>][ASISTENCIA]"
												<?php echo $value['Asistencia']['ASISTENCIA'] == 2 ? 'checked="checked"' : null; ?>
												value="2" />
											<i class="input-helper"></i> Autorizar
										</label>
									

									  <label class="radio radio-inline m-r-20" style="margin-top: 0px;">
											<input type="hidden" name="data[Asistencia][<?php echo $contador; ?>][ID_ALUMNO]" value="<?php echo $value['Alumno']['ID']; ?>" />
											<input type="radio" 
												<?php if (!$enable_edit_asistencia): ?>
													disabled="disabled"
												<?php endif ?>
												name="data[Asistencia][<?php echo $contador; ?>][ASISTENCIA]"
												<?php echo $value['Asistencia']['ASISTENCIA'] == 0 ? 'checked="checked"' : null; ?>
												value="0" />
											<i class="input-helper"></i> Rechazar
										</label>



									</div>
								</td>
								<td><?php echo $value['Asistencia']['OBSERVACION'] ?></td>
							</tr>
					  		<?php endforeach; ?>
					  	</tbody>
					</table>
					<div class="card-header">
						<?php if ($enable_edit_asistencia and count($listado_alumnos)>0): ?>
							<button type="submit" class="btn btn-success <?php echo !$enable_edit_asistencia? ' disabled' : null; ?>">GUARDAR CAMBIOS ASISTENCIA</button>
						<?php endif ?>
						<a href="<?php echo $this->Html->url(array('action'=>'listar_clases_justificados')) ?>" class="btn btn-success" title="Volver">Volver</a>
					</div>
				</form>
			</div>
		
		</div>
	</div>
</div>

<!-- VENTANA MODAL -->


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
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
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
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
			$('#modal-editar').modal('hide');
		}).always(function(response) {
			notifyUser(response.message,response.status);
			$('#modal-editar').modal('hide');
		});
	});
	$('body').on('click','.salir-modal-editar',function(){
		swal({
            title: "<?php echo __('¿Est&aacute; seguro de salir sin guardar?'); ?>",   
            text: "<?php echo __(''); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "S&iacute;, estoy seguro!",   
            closeOnConfirm: true 
        }, function(){
        	$('#modal-editar').modal('hide');
        	//swal("Completado!", "Eliminado con &eacute;xito.", "success"); 
        });
	});
</script>

