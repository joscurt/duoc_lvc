<?php
	$model = '';
	$nombre = '';
	if(!empty($permiso['CoordinadorDocente']['USERNAME'])):
		$model = 'CoordinadorDocente';
		$nombre = $permiso[$model]['NOMBRES'].' '.$permiso[$model]['APELLIDO_PAT'].' '.$permiso[$model]['APELLIDO_MAT'];
	elseif(!empty($permiso['Director']['USERNAME'])):
		$model = 'Director';
		$nombre = $permiso[$model]['NOMBRES'].' '.$permiso[$model]['APELLIDO_PAT'].' '.$permiso[$model]['APELLIDO_MAT'];;
	elseif(!empty($permiso['AccesoBackOffice']['USERNAME'])):
		$model = 'AccesoBackOffice';
		$nombre = $permiso[$model]['NOMBRES'].' '.$permiso[$model]['APELLIDOS'];
	elseif (!empty($permiso['Docente']['USERNAME'])): 
		$model = 'Docente';
		$nombre = $permiso[$model]['NOMBRE'].' '.$permiso[$model]['APELLIDO_PAT'].' '.$permiso[$model]['APELLIDO_MAT'];
	endif;
?>
<div class="modal-header" >
	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editar Permiso</h4>
</div>
<br>
<form action="" method="POST">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="vista">Nombre de Usuario</label>
					<input 
						type="text"
						disabled="disabled"
						value="<?php echo $permiso[$model]['USERNAME']; ?>" 
						class="form-control" >
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="vista">Nombres</label>
					<input 
						type="text"
						disabled="disabled"
						value="<?php echo $nombre; ?>" 
						class="form-control">
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="vista">Rut</label>
					<input
						type="text"
						disabled="disabled"
						value="<?php echo $permiso[$model]['RUT']; ?>" 
						class="form-control">
					<input type="hidden" name="data[Permiso][COD_FUNCIONARIO]" value="<?php echo $permiso['Permiso']['COD_FUNCIONARIO']; ?>" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="rol-id">Rol</label>
					<select id="rol-id" name="data[Permiso][ROL_ID]" class="form-control selectpicker">
						<option>Seleccionar</option>
						<?php foreach ($roles as $key => $value): ?>
							<option <?php echo $permiso['Permiso']['ROL_ID']==$key?'selected="selected"':null; ?> value="<?php echo $key ?>"><?php echo strtoupper($value); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="estado-permiso">Estado</label>
					<select id="estado-permiso" name="data[Permiso][ACTIVO]" class="form-control selectpicker">
						<option>Seleccionar</option>
						<option <?php echo $permiso['Permiso']['ACTIVO']==1?'selected="selected"':null; ?> value="1">ACTIVO</option>
						<option <?php echo $permiso['Permiso']['ACTIVO']==0?'selected="selected"':null; ?> value="0">INACTIVO</option>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="cod-sede">Sede</label>
					<select id="cod-sede" name="data[Sede][COD_SEDE]" class="form-control selectpicker">
						<option>Seleccionar</option>
						<option
							<?php echo isset($permiso[$model]['COD_SEDE']) && $permiso[$model]['COD_SEDE']=='ALL'?'selected="selected"':null; ?>  
							value="ALL">TODAS</option>
						<?php foreach ($sedes as $key => $value): ?>
							<option 
								<?php echo isset($permiso[$model]['COD_SEDE']) && $permiso[$model]['COD_SEDE']==$value['Sede']['COD_SEDE']?'selected="selected"':null; 
								//echo $value['Sede']['TIPO_SEDE'];
								?>
								value="<?php echo $value['Sede']['COD_SEDE']; ?>"><?php echo $value['Sede']['NOMBRE']; ?>(<?php if($value['Sede']['ID_TIPO_SEDE']==1){
									echo "IP";
								}else {
									echo "CFT";
								}

								 ?>)</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="select-escuelas">Escuela</label>
					<select id="select-escuelas" add-edit="edit" name="data[Escuela][COD_ESCUELA]" class="select-escuelas form-control selectpicker">
						<option>Seleccionar</option>
						<option
							<?php echo $permiso['Permiso']['COD_ESCUELA']=='ALL'?'selected="selected"':null; ?> 
							value="ALL">TODAS</option>
						<?php foreach ($escuelas as $key => $value): ?>
							<option 
								<?php echo $permiso['Permiso']['COD_ESCUELA']==$value['Escuela']['COD_ESCUELA']?'selected="selected"':null; ?>
								value="<?php echo $value['Escuela']['COD_ESCUELA']; ?>"><?php echo strtoupper($value['Escuela']['NOMBRE_ESCUELA']); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label for="select-carrera">Carrera <span style="display: none" class="label-cargando"><i class="fa fa-spin fa-cog"></i></span></label>
					<select id="select-carrera" name="data[Carrera][COD_CARRERA]" class="select-carrera-edit form-control selectpicker">
						<option>Seleccionar</option>
						<option 
							<?php echo $permiso['Permiso']['COD_CARRERA']=='ALL'?'selected="selected"':null; ?>
							value="ALL">TODAS</option>
						<?php foreach ($carreras as $key => $value): ?>
							<option 
								<?php echo $permiso['Permiso']['COD_CARRERA']==$value['Carrera']['COD_PLAN']?'selected="selected"':null; ?>
								value="<?php echo $value['Carrera']['COD_PLAN']; ?>"><?php echo strtoupper($value['Carrera']['COD_PLAN'].' - '.$value['Carrera']['NOMBRE']); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true" 
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'savePermiso',$permiso['Permiso']['COD'])); ?>" 
			class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;GUARDAR</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>
<script>
	$('#modal_editar_usuario select').selectpicker();
</script>