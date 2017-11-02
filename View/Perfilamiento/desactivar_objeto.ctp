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
        &iquest;Seguro que desea <?php echo $accion ?> <strong><?php echo $objeto[$model]['NOMBRE']; ?>&#63;</strong>
        <input type="hidden" name="data[<?php echo $model; ?>][COD]" value="<?php echo $objeto[$model]['COD']; ?>">
        <input type="hidden" name="data[<?php echo $model; ?>][ACTIVO]" value="<?php echo $active=='active'?1:0; ?>">
    </div>
    <div class="modal-footer">
        <a 
            send-ajax="true"
            type-response="json"
            href="<?php echo $this->Html->url(array('action'=>'desactivarObjeto',$model,$objeto[$model]['COD'],null)); ?>"
            class="btn btn-<?php echo $color_btn;?>"><?php echo $accion ?></a>
        <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
    </div>
</form>