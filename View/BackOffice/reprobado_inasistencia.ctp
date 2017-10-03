<div class="row">
	<div class="col-md-12">
		<form id="form-filtros-ri">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Sede</label>
						<select name="data[sede]" class="form-control select-picker" data-live-search="true">
							<option value=""></option>
							
							
							<?php foreach ($sedes as $key => $value): ?>
								<option value="<?php echo $value['Sede']['COD_SEDE']; ?>"><?php echo strtoupper($value['Sede']['NOMBRE']) ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Escuela</label>
						<select name="data[escuela]" class="form-control select-picker" data-live-search="true">
							<option value=""></option>
							<?php foreach ($escuelas as $key => $value): ?>
								<option value="<?php echo $key; ?>"><?php echo strtoupper($value); ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="">Carrera</label>
						<select name="data[carrera]" class="form-control select-picker" data-live-search="true">
							<option value=""></option>
							<?php foreach ($carreras as $key => $value): ?>
								<option value="<?php echo $value['Carrera']['COD_PLAN']; ?>"><?php echo strtoupper($value['Carrera']['COD_PLAN'].'-'.$value['Carrera']['NOMBRE']); ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
				<div class="col-md-3">
					<button 
						type="button" 
						id="btn-filter-ri"
						class="btn btn-success m-t-20">BUSCAR</button>
				</div>
			</div>
		</form>
	</div>
	<div class="col-md-12">
		<?php if (!empty($reprobados)): ?>
			<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Sede</th>
						<th>Escuela</th>
						<th>Carrera</th>
						<th>Porcentaje</th>
						<th>Editar</th>
						<th>Activar/Desactivar</th>
					</tr>
				</thead>
			  	<tbody class="tbody_tr">
				  	<?php foreach ($reprobados as $key => $ri): ?>
					  	<tr>
					    	<td><?php echo $key+1 ?></td>
						    <td><?php echo $ri['BoRi']['COD_SEDE']=='ALL'?'TODOS':$ri['Sede']['NOMBRE']; ?></td>
						    <td><?php echo $ri['BoRi']['COD_ESCUELA']=='ALL'?'TODOS':$ri['Escuela']['NOMBRE_ESCUELA']; ?></td>
						    <td><?php echo $ri['BoRi']['COD_CARRERA']=='ALL'?'TODOS':$ri['BoRi']['COD_CARRERA'].'-'.$ri['Carrera']['NOMBRE']; ?></td>
						    <td><?php echo $ri['BoRi']['PORCENTAJE'].'%'; ?></td>
						    <td>
						    	<a 
						    		class="btn btn-info"
						    		send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>'editarRi',$ri['BoRi']['COD'])); ?>"
						    		title="Editar">
						    		<i class="fa fa-pencil-square" aria-hidden="true"></i>
						    	</a>
						    </td>
						    <td>
					    		<?php 
					    			$class_btn = 'btn-success';
					    			$title = 'Activar';
					    			$action_url= 'desactivarBoRi';
					    			$icon= 'fa-check';
					    			$active= 'active';
					    			if ($ri['BoRi']['ACTIVO'] == 1): 
					    				$class_btn = 'btn-danger';
					    				$title = 'Desactivar';
					    				$action_url= 'desactivarBoRi';
					    				$icon= 'fa-times';
					    				$active= '';
					    			endif; 
					    		?>
					    		<a 
						    		class="btn <?php echo $class_btn; ?>" 
									send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>$action_url,$ri['BoRi']['COD'],$active)); ?>"
						    		title="<?php echo $title ?>">
						    		<i class="fa <?php echo $icon; ?>" aria-hidden="true"></i>
						    	</a>
						    </td>
				 	 	</tr>
			 	 	<?php endforeach ?>	
			  	</tbody>
			</table>
		<?php else: ?>
			<h6>* No hay registros</h6>
		<?php endif; ?>
	</div>
	<div class="col-md-12">
		<a 
			send-ajax="true"
			type-response="html"
			href="<?php echo $this->Html->url(array('action'=>'agregarRi')); ?>" 
			class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
	</div>
</div>
<script>
	$('.select-picker').selectpicker();
	$('#btn-filter-ri').on('click', function(event) {
		event.preventDefault();
		var formulario = $('#form-filtros-ri').serialize();
		$('#contenedor-vistas .card-body').html('<div align="center"></div>');
		$('#contenedor-vistas .card-body div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'reprobadoInasistencia')); ?>',
			type: 'POST',
			dataType: 'html',
			data: formulario,
		})
		.fail(function(error_reader) {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
			$('#contenedor-vistas .card-body').empty();
		})
		.always(function(view) {
			$('#contenedor-vistas .card-body').html(view);
		});
	});
</script>