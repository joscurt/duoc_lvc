<form method="POST">
	<div class="modal-header" >
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: <?php echo !empty($justificacion_legal_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION']) ? $justificacion_legal_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION'] : ''; ?></h4>
	</div>
	<br>
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<label for="">Nombre:</label>
					<input type="text" class="form-control" name="data[Justificacion][TIPO_JUSTIFICACION]" placeholder="Nombre de la justificacion legal" value="<?php echo !empty($justificacion_legal_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION']) ? $justificacion_legal_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION'] : ''; ?>">
					<input type="hidden" name="data[Justificacion][ID]" value="<?php echo !empty($justificacion_legal_bd['TipoJustificacionLegal']['ID']) ? $justificacion_legal_bd['TipoJustificacionLegal']['ID'] : ''; ?>">
				</div>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'editarJustificacionLegal',$justificacion_legal_bd['TipoJustificacionLegal']['COD'])); ?>"
			class="btn btn-sm btn-success"
			><i class="fa fa-save"></i>&nbsp;Guardar</a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>