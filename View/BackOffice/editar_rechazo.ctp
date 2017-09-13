<form method="POST">
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: <?php echo $rechazo_bd['MotivosRechazoReforzamiento']['MOTIVO'] ?></h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nombre:</label>
					<input type="text" class="form-control" name="data[Rechazo][MOTIVO]" placeholder="Nombre del Motivo Rechazo Reforzamiento" value="<?php echo !empty($rechazo_bd['MotivosRechazoReforzamiento']['MOTIVO']) && !empty($rechazo_bd['MotivosRechazoReforzamiento']['MOTIVO']) ? $rechazo_bd['MotivosRechazoReforzamiento']['MOTIVO'] : ''; ?>">
					<input type="hidden" class="form-control" name="data[Rechazo][ID]" value="<?php echo !empty($rechazo_bd['MotivosRechazoReforzamiento']['ID']) && !empty($rechazo_bd['MotivosRechazoReforzamiento']['ID']) ? $rechazo_bd['MotivosRechazoReforzamiento']['ID'] : ''; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'editarRechazoReforzamiento',$rechazo_bd['MotivosRechazoReforzamiento']['COD'])); ?>"
			class="btn btn-sm btn-success"
			><i class="fa fa-save"></i>&nbsp;Guardar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>