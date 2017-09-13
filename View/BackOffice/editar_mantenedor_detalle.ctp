<form method="POST">
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: <?php echo !empty($detalle_bd['Detalle']['DETALLE']) ? $detalle_bd['Detalle']['DETALLE'] : ''; ?></h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nombre:</label>
					<input type="text" class="form-control" name="data[Detalle][DETALLE]" placeholder="Nombre del detalle a editar" value="<?php echo !empty($detalle_bd['Detalle']['DETALLE']) ? $detalle_bd['Detalle']['DETALLE'] : ''; ?>">
					<input type="hidden" name="data[Detalle][ID]" value="<?php echo !empty($detalle_bd['Detalle']['ID']) ? $detalle_bd['Detalle']['ID'] : ''; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'editarDetalle',$detalle_bd['Detalle']['COD'])); ?>"
			class="btn btn-sm btn-success"
			><i class="fa fa-save"></i>&nbsp;Guardar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>