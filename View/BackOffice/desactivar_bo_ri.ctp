<?php 
	$accion = 'desactivar'; 
	$color_btn = 'danger';
	if ($active == 'active') { 
		$accion = 'activar'; 
		$color_btn = 'success';
	} 
?>
<form id="form_ajax_del_estado">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		¿Seguro que desea <?php echo $accion; ?>  el registro?</strong>
		<input type="hidden" name="data[BoRi][COD]" value="<?php echo $bo_ri['BoRi']['COD']; ?>">
        <input type="hidden" name="data[BoRi][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<a 
        	send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'desactivarBoRiSave')); ?>"
        	class="btn btn-<?php echo $color_btn;?>"><?php echo $accion ?></a>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>