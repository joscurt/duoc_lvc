<?php 
	$accion = 'desactivar'; 
	$color_btn = 'danger';
	if ($active == 'active') { 
		$accion = 'activar'; 
		$color_btn = 'success';
	} 
?>
<form id="form_ajax_del_inasistencia">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	</div>
	<div class="modal-body">
		&iquest;Seguro que desea <?php echo $accion; ?> <strong><?php echo !empty($inasistencia_bd['MotivoInasistenciaDocente']['MOTIVO']) ? $inasistencia_bd['MotivoInasistenciaDocente']['MOTIVO']: ''; ?>&#63;</strong>
		<input type="hidden" name="data[Inasistencia][COD]" value="<?php echo $inasistencia_bd['MotivoInasistenciaDocente']['COD']; ?>">
        <input type="hidden" name="data[Inasistencia][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<a 
        	send-ajax="true"
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'desactivarInasistenciaDocente')); ?>"
        	class="btn btn-<?php echo $color_btn;?>"><?php echo $accion ?></a>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>