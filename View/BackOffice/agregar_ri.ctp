<form method="POST">
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de Porcenta RI</h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Escuela</label>
					<select name="data[escuela]" class="form-control select-picker select-escuelas" data-live-search="true">
						<option value=""></option>
						<?php foreach ($escuelas as $key => $value): ?>
							<option value="<?php echo $key; ?>"><?php echo strtoupper($value); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Carrera</label>
					<select name="data[carrera]" class="form-control select-picker select-carrera" data-live-search="true">
						<option value=""></option>
						<?php foreach ($carreras as $key => $value): ?>
							<option value="<?php echo $value['Carrera']['COD_PLAN']; ?>"><?php echo strtoupper($value['Carrera']['COD_PLAN'].'-'.$value['Carrera']['NOMBRE']); ?></option>
						<?php endforeach ?>
					</select>
				</div>
			</div>
			<div class="col-md-12">
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
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Porcentaje</label>
					<input type="text" name="data[porcentaje]" class="form-control" />
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'agregarRi')); ?>"
			class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>
<script>
	$('.select-picker').selectpicker();
	$('body').on('change','.select-escuelas', function(event) {
		event.preventDefault();
		$('.label-cargando').show();
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getCarrerasByEscuela')); ?>'+'/'+event.target.value,
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
		})
		.always(function(view) {
			$('select.select-carrera').html(view);
			$('select.select-carrera').selectpicker('refresh');
			$('.label-cargando').hide();
		});
	});
</script>