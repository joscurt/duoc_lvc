<style>
	#autorizar tr th, #autorizar tr td {
		text-align: left !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
            <h1>Autorizaci&oacute;n de Clases</h1>
        </div>
	</div>
</div>
<div class="card">
	<form action="<?php echo $this->Html->url(array('action'=>'autorizacionClase', $info_editar_clase['ProgramacionClase']['COD_PROGRAMACION'])) ?>" method="post">
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-12">
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Docente:</h2>
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>Rut</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombres</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><?php echo isset($info_editar_clase['Docente']['RUT']) ? $info_editar_clase['Docente']['RUT'].'-'.$info_editar_clase['Docente']['DV']: ''; ?></td>
								<td><?php echo isset($info_editar_clase['Docente']['APELLIDO_PAT']) ? utf8_encode($info_editar_clase['Docente']['APELLIDO_PAT']): ''; ?></td>
								<td><?php echo isset($info_editar_clase['Docente']['APELLIDO_MAT']) ? utf8_encode($info_editar_clase['Docente']['APELLIDO_MAT']): ''; ?></td>
								<td><?php echo isset($info_editar_clase['Docente']['NOMBRE']) ? utf8_encode($info_editar_clase['Docente']['NOMBRE']): ''; ?></td>
							</tr>	
						</tbody>
					</table>
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>Nombre asignatura</th>
								<th>Sigla-Secci&oacute;n</th>
								<th>Jornada</th>
								<th>Fecha programada</th>
								<th>Horario</th>
								<th>Sala</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><?php echo isset($info_editar_clase['Asignatura']['NOMBRE']) ? $info_editar_clase['Asignatura']['NOMBRE']: ''; ?></td>
								<td><?php echo isset($info_editar_clase['ProgramacionClase']['SIGLA_SECCION']) ? $info_editar_clase['ProgramacionClase']['SIGLA_SECCION']: ''; ?></td>
								<td><?php echo $$info_editar_clase['ProgramacionClase']['COD_JORNADA'] = 'D' ? 'Diurno' : 'VespertRRino'; ?></td>
								<td><?php echo isset($info_editar_clase['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y', strtotime($info_editar_clase['ProgramacionClase']['FECHA_CLASE'])): ''; ?></td>
								<td>
									<?php echo isset($info_editar_clase['ProgramacionClase']['HORA_INICIO']) ? date('H:i',strtotime($info_editar_clase['ProgramacionClase']['HORA_INICIO'])): ''; ?>
									-
									<?php echo isset($info_editar_clase['ProgramacionClase']['HORA_FIN']) ? date('H:i', strtotime($info_editar_clase['ProgramacionClase']['HORA_FIN'])): ''; ?>
								</td>
								<td><?php echo !empty($info_editar_clase['SalaReemplazo']['TIPO_SALA']) ? $info_editar_clase['SalaReemplazo']['TIPO_SALA']: $info_editar_clase['Sala']['TIPO_SALA']; ?></td>
							</tr>	
						</tbody>
					</table>
					<br>
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>M&oacute;dulos</th>
								<th>M&oacute;dulos programados</th>
								<th>M&oacute;dulos por recuperar</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><?php echo round($info_editar_clase['ProgramacionClase']['CANTIDAD_MODULOS']); ?></td>
								<td><?php echo isset($info_editar_clase['ProgramacionClase']['CANTIDAD_MODULOS']) ? round($info_editar_clase['ProgramacionClase']['CANTIDAD_MODULOS']): '---'; ?></td>
								<td><?php echo round($info_editar_clase['ProgramacionClase']['CANTIDAD_MODULOS']); ?></td>
							</tr>	
						</tbody>
					</table>
					<br>
					<table  id="autorizar" class="table table-striped" border="0" cellpadding="0" cellspacing="0" class="">
						<thead>
							<tr>
								<th>Informaci&oacute;n Recuperaci&oacute;n</th>
							</tr>
						</thead>
						<tbody>
							<tr class="">								<td class="">
									<label>Motivo:</label> 
									<?php 
										echo $info_editar_clase['MotivoSolicitudRecuperacion']['MOTIVO']; 
										echo $info_editar_clase['MotivoReforzamiento']['MOTIVO']; 
										echo $info_editar_clase['MotivoAdelantarClase']['MOTIVO']; 
									?>
								</td>
							</tr>
							<tr class="even">
								<td class="odd">
									<label>Observaciones:</label>
									<?php 
										echo $info_editar_clase['ProgramacionClase']['OBS_SOLICITUD_RECUPERACION']; 
										echo $info_editar_clase['ProgramacionClase']['OBSERVACIONES_REFORZAMIENTO']; 
										echo $info_editar_clase['ProgramacionClase']['OBSERVACIONES_ADELANTAR_CLASE']; 
									?>	
								</td>
							</tr>
							<tr class="odd">
								<td class="odd">
									<label>Tipo de Recuperaci&oacute;n:</label>
									<?php echo $info_editar_clase['ProgramacionClase']['PRESENCIAL']==1?'PRESENCIAL':'VIRTUAL'; ?>
								</td>
							</tr>
							<tr class="even">
								<td class="odd">
									<label>Fecha Programada:</label>
									<?php echo date('d-m-Y',strtotime($info_editar_clase['ProgramacionClase']['FECHA_CLASE'])); ?>
								</td>
							</tr>
						
							<?php if ($info_editar_clase['ProgramacionClase']['PRESENCIAL']==1): ?>
								<tr class="odd">
									<td class="odd">
										<label>Horario:</label>
										<?php echo date('H:i',strtotime($info_editar_clase['ProgramacionClase']['HORA_INICIO'])); ?>
										 a 
										<?php echo date('H:i',strtotime($info_editar_clase['ProgramacionClase']['HORA_FIN'])); ?>
									</td>
								</tr>
							<?php endif; ?>

							<tr>
								<td>
								<label>Fecha Original:</label>
								<?php
							if(isset($info_editar_clase['ProgramacionClase']['COD_PROGRAMACION_PADRE'])){
								echo date('d-m-Y',strtotime($prog_ade[0]['ProgramacionClase']['FECHA_CLASE']));
							}else{
								echo date('d-m-Y',strtotime($info_editar_clase['ProgramacionClase']['FECHA_CLASE']));
							}
							 ?></td>
							</tr>
							<?php if ($info_editar_clase['ProgramacionClase']['PRESENCIAL']==1): ?>
							<tr>
								<td>
							<label>Horario Original:</label>
							<?php if (isset($info_editar_clase['ProgramacionClase']['COD_PROGRAMACION_PADRE'])) {																	echo date('H:i', strtotime($prog_ade[0]['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($prog_ade[0]['ProgramacionClase']['HORA_FIN']));
							}else{
								echo date('H:i',strtotime($info_editar_clase['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($info_editar_clase['ProgramacionClase']['HORA_FIN']));
							}
 							?>
							</td>
							</tr>
						<?php endif; ?>
							<tr class="even">
								<td class="odd">
									<label>M&oacute;dulos a Recuperar:</label>
									<?php echo $info_editar_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>
								</td>
							</tr>
							<?php if ($info_editar_clase['ProgramacionClase']['PRESENCIAL']==1): ?>
								<tr class="odd">
									<td class="odd">
										<label>Sala:</label>
										<?php 
											echo !empty($info_editar_clase['ProgramacionClase']['SALA_REEMPLAZO']) ? 
											$info_editar_clase['SalaReemplazo']['TIPO_SALA']: $info_editar_clase['Sala']['TIPO_SALA']; 
										?>
									</td>
								</tr>
							<?php endif; ?>
							<tr class="even">
								<td class="odd">
									<label>Docente titular:</label>
									<input 
										type="checkbox" 
										<?php echo !empty($info_editar_clase['DocenteReemplazo']['COD_DOCENTE']) ? '' : 'checked="checked"'; ?> 
										/>
								</td>
							</tr>
							<tr class="odd">
								<td class="odd">
									<label>Nombre Docente:</label>
									<?php 
										echo isset($info_editar_clase['DocenteReemplazo']['NOMBRE'])? $info_editar_clase['DocenteReemplazo']['NOMBRE'].' '.$info_editar_clase['DocenteReemplazo']['APELLIDO_PAT'].' '.$info_editar_clase['DocenteReemplazo']['APELLIDO_MAT'] /*SINO ----> */ : $info_editar_clase['Docente']['NOMBRE'].' '.$info_editar_clase['Docente']['APELLIDO_PAT'].' '.$info_editar_clase['Docente']['APELLIDO_MAT']; 
								 	?>
								</td>
							</tr>
							<!--<?php #if ($info_editar_clase['ProgramacionClase']['PRESENCIAL']==1): ?>-->
								<tr class="even">
									<td class="odd">
										<label>Ver tope:</label>
										<a data-toggle="modal" data-target="#tope_horario_alumno" class="btn btn-success modal-tope-horario">Alumno</a>
										<a data-toggle="modal" data-target="#tope_horario_docente" class="btn btn-success modal-tope-horario">Docente</a>
									</td>
								</tr>
							<!--<?php #endif; ?>-->
						</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" value="<?php echo $info_editar_clase ?>">
					<button class="btn btn-success">Autorizar</button>
					<button class="btn btn-danger" type="button" data-toggle="modal" data-target="#rechazar_clase">Rechazar</button> 
					<button class="btn btn-default btn-salir" type="button">Salir</button> 
				</div>
			</div>
		</div>
	</form>
</div>
<div class="modal" id="tope_horario_alumno" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal" id="tope_horario_docente" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal" id="rechazar_clase" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action'=>'rechazarAutorizacion',$info_editar_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
	            <div class="modal-header">
	                <h2 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Rechazar Clase</h2>
	            </div>
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12">
							<div class="form-group">
								<label for="">Motivo:</label>
								<select name="data[ProgramacionClase][MOTIVO_RECHAZO_CLASE_ID]" class="form-control selectpicker" >
									<option value=""></option>
									<?php foreach ($motivos as $key => $value): ?>
										<option value="<?php echo $value['MotivoRechazoClase']['ID']; ?>">
											<?php echo $value['MotivoRechazoClase']['MOTIVO']; ?>
										</option>
									<?php endforeach ?>
								</select>
							</div>
	                	</div>
	                	<div class="col-md-12">
	                		<div class="form-group">
		                		<label for="">Observaciones:</label>
		                		<textarea 
		                			class="form-control"
		                			cols="30" 
		                			name="data[ProgramacionClase][OBSERVACIONES_RECHAZO_REFORZAMIENTO]" 
		                			rows="5" 
		                		></textarea>
		                	</div>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	            	<button type="submit" class="btn btn-success">GUARDAR</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">SALIR</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
<script>
	var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
	$('a[data-target="#tope_horario_alumno"]').on('click',function(event) {
		$('#tope_horario_alumno .modal-content').html('<div align="center"></div>');
		$('#tope_horario_alumno .modal-content div').html(img_cargando);
		$.ajax({
			url:'<?php echo $this->Html->url(array('action'=>'alumnosTope',$info_editar_clase['ProgramacionClase']['SIGLA_SECCION'],$info_editar_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type:'POST',
		}).always(function(view){
			$('#tope_horario_alumno .modal-content').html(view);	
		});
	});
		$('a[data-target="#tope_horario_docente"]').on('click',function(event) {
		$('#tope_horario_docente .modal-content').html('<div align="center"></div>');
		$('#tope_horario_docente .modal-content div').html(img_cargando);
		$.ajax({
			url:'<?php echo $this->Html->url(array('action'=>'listaDocentesConTope',$info_editar_clase['ProgramacionClase']['SIGLA_SECCION'],$info_editar_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type:'POST',
		}).always(function(view){
			$('#tope_horario_docente .modal-content').html(view);	
		});
	});
	$('.btn-salir').on('click',function(event){	
		event.preventDefault();
		swal({
			title: "<?php echo __('¿Esta seguro que desea salir?'); ?>",   
	        text: "<?php echo __(''); ?>",
	        type: "warning",
	        showCancelButton: true, 
	        cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	        confirmButtonColor: "#DD6B55",   
	        confirmButtonText: "S&iacute;, Estoy Seguro!",   
	        closeOnConfirm: false,
		},function(){
			window.location ="<?php echo $this->Html->url(array('action'=>'index')); ?>";
		});
	});
	$('.btn-salir-modal').on('click',function(event){	
		event.preventDefault();
		swal({
			title: "<?php echo __('¿Esta seguro que desea salir sin realizar ning&uacute;n cambio?'); ?>",   
	        text: "<?php echo __(''); ?>",
	        type: "warning",
	        showCancelButton: true, 
	        cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	        confirmButtonColor: "#DD6B55",   
	        confirmButtonText: "S&iacute;, Estoy Seguro!",   
	        closeOnConfirm: true,
		},function(){
			$('#rechazar_reforzamiento').modal('hide');
		});
	});
	$('#link-autorizar-reformzamiento').on('click',function(event){	
		event.preventDefault();
		swal({
			title: "<?php echo __('¿Esta seguro que desea autorizar este reforzamiento?'); ?>",   
	        text: "<?php echo __(''); ?>",
	        type: "warning",
	        showCancelButton: true, 
	        cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	        confirmButtonColor: "#DD6B55",   
	        confirmButtonText: "S&iacute;, Estoy Seguro!",   
	        closeOnConfirm: false,
		},function(){
			window.location ="<?php echo $this->Html->url(array('action'=>'autorizarReforzamiento',$info_editar_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>";
		});
	});
</script>