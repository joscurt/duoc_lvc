<form id="form_ajax_edit" method='post'>
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: "<?php echo $reforzamiento_bd['MotivoReforzamiento']['MOTIVO'] ?>"</h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nombre:</label>
					<input type="text" class="form-control" name="data[Reforzamiento][MOTIVO]" placeholder="Nombre del Motivo de Reforzamiento" value="<?php echo !empty($reforzamiento_bd['MotivoReforzamiento']['MOTIVO']) && !empty($reforzamiento_bd['MotivoReforzamiento']['MOTIVO']) ? $reforzamiento_bd['MotivoReforzamiento']['MOTIVO'] : ''; ?>">
					<input type="hidden" class="form-control" name="data[Reforzamiento][ID]" value="<?php echo !empty($reforzamiento_bd['MotivoReforzamiento']['ID']) && !empty($reforzamiento_bd['MotivoReforzamiento']['ID']) ? $reforzamiento_bd['MotivoReforzamiento']['ID'] : ''; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'editarMotivoReforzamiento')); ?>"
			class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Editar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>

	
