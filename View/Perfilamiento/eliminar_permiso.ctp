<form action="" method="POST">
	<div class="modal-body">
		<div class="row">
			<div class="col-md-12">
				<?php 
	    			$color = 'danger';
	    			$text = 'Desactivar';
	    			$icon = 'trash';
	    			if ($permiso['Permiso']['ACTIVO']==0) {
	    				$color = 'success';
	    				$text = 'activar';
	    				$icon = 'check';
	    			}
	    		?>
				<h5>¿Est&aacute; seguro que desea <strong><?php echo strtoupper($text); ?></strong> el permiso?</h5>
				<input type="hidden" name="data[Permiso][COD]" value="<?php echo $permiso['Permiso']['COD']; ?>">
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<a 
			send-ajax="true" 
			type-response="json"
			href="<?php echo $this->Html->url(array('action'=>'eliminarPermiso',$permiso['Permiso']['COD'])); ?>" 
			class="btn btn-sm btn-<?php echo $color; ?>" 
			><i class="fa fa-<?php echo $icon; ?>"></i>&nbsp;<?php echo $text ?></a>
		<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
	</div>
</form>
