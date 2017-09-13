<?php 
	$accion = 'desactivar'; 
	$color_btn = 'danger';
	if ($active == 'active') { 
		$accion = 'activar'; 
		$color_btn = 'success';
	} 
?>
<form method="POST">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		¿Seguro que desea <?php echo $accion; ?> <strong><?php echo !empty($motivo_bd['RecuperarAtrasoRetiro']['MOTIVO']) ? $motivo_bd['RecuperarAtrasoRetiro']['MOTIVO']: ''; ?>?</strong>
		<input type="hidden" name="data[RecuperarAtrasoRetiro][COD]" value="<?php echo $motivo_bd['RecuperarAtrasoRetiro']['COD']; ?>">
        <input type="hidden" name="data[RecuperarAtrasoRetiro][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<a 
        	send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'desactivarRecuperarAtrasoRetiro')); ?>"
        	class="btn btn-<?php echo $color_btn;?>"><?php echo $accion ?></a>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>