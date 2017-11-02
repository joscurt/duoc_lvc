<?php $accion = ''; if ($active == 'active') { $accion = 'activar'; }else{ $accion = 'desactivar';} ?>
<form id="form_ajax_del_recuperar_atraso_retiro">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		&iquest;Seguro que desea <?php echo $accion; ?> <strong><?php echo !empty($motivo_bd['RecuperarAtrasoRetiro']['MOTIVO']) ? $motivo_bd['RecuperarAtrasoRetiro']['MOTIVO']: ''; ?>&#63;</strong>
		<input type="hidden" name="data[RecuperarAtrasoRetiro][COD]" value="<?php echo $motivo_bd['RecuperarAtrasoRetiro']['COD']; ?>">
        <input type="hidden" name="data[RecuperarAtrasoRetiro][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<?php if ($active == 'active'): ?>
            <a id="btn_del_ajax_recuperar_atraso_retiro" class="btn btn-success">Activar</a>
        <?php else: ?>
            <a id="btn_del_ajax_recuperar_atraso_retiro" class="btn btn-danger">Eliminar</a>
        <?php endif ?>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>