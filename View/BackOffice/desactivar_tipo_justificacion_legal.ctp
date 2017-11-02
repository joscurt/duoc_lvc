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
		&iquest;Seguro que desea <?php echo $accion; ?> <strong><?php if(!empty($justificacion_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION']))
		{
			echo utf8_decode($justificacion_bd['TipoJustificacionLegal']['TIPO_JUSTIFICACION']);
		}else{
			echo '';
		}
		  ?>&#63;</strong>
		<input type="hidden" name="data[Justificacion][COD]" value="<?php echo $justificacion_bd['TipoJustificacionLegal']['COD']; ?>">
        <input type="hidden" name="data[Justificacion][ACTIVO]" value="<?php echo $active; ?>">
	</div>
	<div class="modal-footer">
		<a 
            send-ajax="true"
            type-response="json"
            href="<?php echo $this->Html->url(array('action'=>'desactivarJustificacionLegal')); ?>"
            class="btn btn-<?php echo $color_btn;?>"><?php echo $accion ?></a>
	    <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
	</div>
</form>