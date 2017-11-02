<form method="POST">
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editar: <?php echo $objeto[$model]['NOMBRE']; ?></h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			<?php if ($model == 'Funcionalidad'): ?>
				<div class="col-md-12">
					<div class="form-group">
						<label for="">Vista:</label>
						<select disabled
							data-live-search="true" 
							name="data[<?php echo $model ?>][VISTA_ID]" 
							class="selectpicker form-control">
							<option value=""></option>
							<?php foreach ($vistas as $key => $value): ?>
								<option 
									<?php echo $objeto[$model]['VISTA_ID'] == $key ? 'selected="selected"':null; ?>
									value="<?php echo $key ?>"><?php echo $value ?></option>
							<?php endforeach ?>
						</select>
					</div>
				</div>
			<?php endif ?>
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nombre:</label>
					<input 
						type="text" 
						class="form-control input_motivo" 
						name="data[<?php echo $model ?>][NOMBRE]" 
						value="<?php echo $objeto[$model]['NOMBRE']; ?>" 
						placeholder="Ingrese nombre" />
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'editarObjeto',$model,$objeto[$model]['COD'])); ?>"
			class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>
<script>
	$('.selectpicker').selectpicker();
</script>