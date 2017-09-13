<?php $accion = ''; if ($active == 'active') { $accion = 'activar'; }else{ $accion = 'desactivar';} ?>
<form id="form_ajax_del_estado">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		¿Seguro que desea <?php echo $accion; ?> <strong><?php echo !empty($estado_bd['Estado']['NOMBRE']) ? $estado_bd['Estado']['NOMBRE']: ''; ?>?</strong>
		<input type="hidden" name="data[Estado][COD]" value="<?php echo $estado_bd['Estado']['COD']; ?>">
        <input type="hidden" name="data[Estado][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<?php if ($active == 'active'): ?>
            <a id="btn_del_ajax_estado" class="btn btn-success">Activar</a>
        <?php else: ?>
            <a id="btn_del_ajax_estado" class="btn btn-danger">Eliminar</a>
        <?php endif ?>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>