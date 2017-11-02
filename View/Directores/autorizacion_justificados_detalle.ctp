<style>
	#autorizar tr th, #autorizar tr td {
		text-align: left !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
            <h1>Autorizaci&oacute;n de Justificados</h1>
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
								<td><?php echo isset($info_editar_clase['Docente']['APELLIDO_PAT']) ? ($info_editar_clase['Docente']['APELLIDO_PAT']): ''; ?></td>
								<td><?php echo isset($info_editar_clase['Docente']['APELLIDO_MAT']) ? ($info_editar_clase['Docente']['APELLIDO_MAT']): ''; ?></td>
								<td><?php echo isset($info_editar_clase['Docente']['NOMBRE']) ? ($info_editar_clase['Docente']['NOMBRE']): ''; ?></td>
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
							<div>
								    <div class="row">
								    	<div class="col-md-12">
								    		<table class="table table-striped">
												<thead>
													<tr>
														<th></th>
														<th>Rut</th>
														<th>Apellido Paterno</th>
														<th>Apellido Materno</th>
														<th>Nombres</th>
														<th>Tope</th>
													</tr>
												</thead>
												<tbody>
													<?php $contador = 0; foreach ($alumnos as $key => $alumno):  $contador++; ?>
														<tr>
															<td><?php echo $contador; ?></td>
															<td><?php echo $alumno['Alumno']['RUT'].'-'.$alumno['Alumno']['DV_RUT']; ?></td>
															<td><?php echo $alumno['Alumno']['APELLIDO_PAT']; ?></td>
															<td><?php echo $alumno['Alumno']['APELLIDO_MAT']; ?></td>
															<td><?php echo $alumno['Alumno']['NOMBRES']; ?></td>
															<td><?php echo $alumno['Alumno']['TIENE_TOPE']? '*':''; ?></td>
														</tr>
													<?php endforeach ?>
												</tbody>
											</table>
								    	</div>
								    </div>
								</div>

						</tbody>
				
					</table>
				</div>
			</div>
		
		</div>
	</form>
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