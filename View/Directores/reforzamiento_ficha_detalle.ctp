<style>
	#reforzamiento tr th, #reforzamiento tr td {
		text-align: left !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
            <h1>Reforzamiento</h1>
        </div>
	</div>
</div>
<div class="card">
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
							<td><?php echo isset($info_editar_recuperacion['Docente']['RUT']) ? $info_editar_recuperacion['Docente']['RUT'].'-'.$info_editar_recuperacion['Docente']['DV']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['APELLIDO_PAT']) ? $info_editar_recuperacion['Docente']['APELLIDO_PAT']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['APELLIDO_MAT']) ? $info_editar_recuperacion['Docente']['APELLIDO_MAT']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['NOMBRE']) ? $info_editar_recuperacion['Docente']['NOMBRE']: ''; ?></td>
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
							<td><?php echo isset($info_editar_recuperacion['Asignatura']['NOMBRE']) ? $info_editar_recuperacion['Asignatura']['NOMBRE']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION']) ? $info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['COD_JORNADA']) ? $info_editar_recuperacion['ProgramacionClase']['COD_JORNADA']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y', strtotime($info_editar_recuperacion['ProgramacionClase']['FECHA_CLASE'])): ''; ?></td>
							<td>
								<?php echo isset($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO']) ? date('H:i',strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO'])): ''; ?>
								-
								<?php echo isset($info_editar_recuperacion['ProgramacionClase']['HORA_FIN']) ? date('H:i', strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_FIN'])): ''; ?>
							</td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['SALA']) ? $info_editar_recuperacion['ProgramacionClase']['SALA']: ''; ?></td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table id="reforzamiento" class="table table-striped" border="0" cellpadding="0" cellspacing="0" class="one-column">
					<thead>
						<tr>
							<th>Editar Reforzamiento</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd"><td class="odd"><label>Sigla-Secci&oacute;n:</label> <?php echo $info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION']; ?></td></tr>
						<tr class="even"><td class="odd"><label>Fecha:</label> <?php echo date('d-m-Y',strtotime($info_editar_recuperacion['ProgramacionClase']['FECHA_CLASE'])); ?></td></tr>
						<tr class="odd"><td class="odd"><label>Horario:</label> <?php echo date('H:i',strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_FIN'])); ?></td></tr>
						<tr class="even"><td class="odd"><label>Sala:</label> <?php echo empty($info_editar_recuperacion['ProgramacionClase']['SALA_REEMPLAZO'])? $info_editar_recuperacion['Sala']['TIPO_SALA']:$info_editar_recuperacion['SalaReemplazo']['TIPO_SALA']; ?></td></tr>
						<tr class="odd"><td class="odd"><label>Docente titular:</label> <?php echo empty($info_editar_recuperacion['ProgramacionClase']['DOCENTE_REEMPLAZO_ID'])?'SI':'NO'; ?></td></tr>
						<tr class="even"><td class="odd"><label>Nombre Docente:</label> <?php echo $info_editar_recuperacion['Docente']['NOMBRE'].' '.$info_editar_recuperacion['Docente']['APELLIDO_PAT'].' '.$info_editar_recuperacion['Docente']['APELLIDO_MAT']; ?></td></tr>
						<tr class="odd"><td class="odd"><label>Motivo:</label> <?php echo $info_editar_recuperacion['MotivoReforzamiento']['MOTIVO']; ?>.</td></tr>
						<tr class="even"><td class="odd"><label>Observaciones:</label> <?php echo $info_editar_recuperacion['ProgramacionClase']['OBSERVACIONES_REFORZAMIENTO']; ?></td></tr>		
						<tr class="odd"><td class="odd"><label>Ver tope horario:</label> <a data-toggle="modal" data-target="#tope_horario" class="btn btn-success">OK</a></td></tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-12 m-t-20">
				<a 
					href="#"
					id="link-autorizar-reformzamiento"
					class="btn btn-success">AUTORIZAR
				</a>
				<a
					class="btn btn-danger" 
					data-toggle="modal" 
					data-target="#rechazar_reforzamiento">RECHAZAR</a> 
				<a
					href="<?php echo $this->Html->url(array('action'=>'reforzamientos')); ?>"
					class="btn btn-default btn-salir" 
					>SALIR</a> 
			</div>
		</div>
	</div>
</div>
<div class="modal" id="tope_horario" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        </div>
    </div>
</div>
<div class="modal" id="rechazar_reforzamiento" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action'=>'rechazarReforzamiento',$info_editar_recuperacion['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
	            <div class="modal-header">
	                <h2 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Rechazar Reforzamiento</h2>
	            </div>
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12">
							<div class="form-group">
								<label for="">Motivo:</label>
								<select name="data[ProgramacionClase][MOTIVO_RECHAZO_REFORZAMIENTO_ID]" class="form-control selectpicker" >
									<option value=""></option>
									<?php foreach ($motivos as $key => $value): ?>
										<option value="<?php echo $value['MotivosRechazoReforzamiento']['ID']; ?>">
											<?php echo $value['MotivosRechazoReforzamiento']['MOTIVO']; ?>
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
	                <button type="button" class="btn btn-default btn-salir-modal">SALIR</button>
	            </div>
	        </form>
        </div>
    </div>
</div>
<script type="text/javascript">
	var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
	$('a[data-target="#tope_horario"]').on('click',function(event) {
		$('#tope_horario .modal-content').html('<div align="center"></div>');
		$('#tope_horario .modal-content div').html(img_cargando);
		$.ajax({
			url:'<?php echo $this->Html->url(array('action'=>'alumnosTope',$info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION'],$info_editar_recuperacion['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type:'POST',
		}).always(function(view){
			$('#tope_horario .modal-content').html(view);	
		});
	});
	$('.btn-salir').on('click',function(event){	
		event.preventDefault();
		swal({
			title: "<?php echo __('¿Esta seguro que desea salir sin registrar cambios?'); ?>",   
	        text: "<?php echo __(''); ?>",
	        type: "warning",
	        showCancelButton: true, 
	        cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	        confirmButtonColor: "#DD6B55",   
	        confirmButtonText: "S&iacute;, Estoy Seguro!",   
	        closeOnConfirm: false,
		},function(){
			window.location ="<?php echo $this->Html->url(array('action'=>'reforzamientos')); ?>";
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
			window.location ="<?php echo $this->Html->url(array('action'=>'autorizarReforzamiento',$info_editar_recuperacion['ProgramacionClase']['COD_PROGRAMACION'])); ?>";
		});
	});
</script>