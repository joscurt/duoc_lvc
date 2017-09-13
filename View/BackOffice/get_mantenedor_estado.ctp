<div class="row">
	<div class="col-md-12">
		<h3 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Mantenedor de estados</h3>
	</div>
	<div class="col-md-12">
		<?php if (!empty($estados)): ?>
			<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombre</th>
						<th>Editar</th>
						<th>Activar/Desactivar</th>
					</tr>
				</thead>
			  	<tbody class="tbody_tr">
				  	<?php foreach ($estados as $key => $estado): ?>
					  	<tr class="odd" id="tr-<?php echo $estado['Estado']['ID'];?>">
					    	<td><?php echo $key+1 ?></td>
						    <td><?php echo $estado['Estado']['NOMBRE']; ?></td>
						    <td>
						    	<a 
						    		class="btn btn-info"
									send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>'editarMantenedorEstado',$estado['Estado']['COD'])); ?>"
						     		title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i>
						     	</a>
						     </td>
						    <td>
						     	<?php 
					    			$class_btn = 'btn-success';
					    			$title = 'Activar';
					    			$action_url= 'desactivarMantenedorEstado';
					    			$icon= 'fa-check';
					    			$active= 'active';
					    			if ($estado['Estado']['ACTIVO'] == 1): 
					    				$class_btn = 'btn-danger';
					    				$title = 'Desactivar';
					    				$action_url= 'desactivarMantenedorEstado';
					    				$icon= 'fa-times';
					    				$active= '';
					    			endif; 
					    		?>
					    		<a 
						    		class="btn <?php echo $class_btn; ?>" 
									send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>$action_url,$estado['Estado']['COD'],$active)); ?>"
						    		title="<?php echo $title ?>">
						    		<i class="fa <?php echo $icon; ?>" aria-hidden="true"></i>
						    	</a>
						    </td>					    
				 	 	</tr>
			 	 	<?php endforeach ?>	
			  	</tbody>
			</table>
		<?php else: ?>
			<h6>* No hay registros</h6>
		<?php endif ?>
	</div>
	<div class="col-md-12">
		<a 
			send-ajax="true"
			type-response="html"
			href="<?php echo $this->Html->url(array('action'=>'agregarEstado')); ?>"
			class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
	</div>
</div>
<script>
	/*$('body').on('click','.edit-estado',function(){
		$('#form_ajax_edit_estado').html('<div align="center"></div>');
		$('#form_ajax_edit_estado div').html(imagen_cargando);
        var cod = $(this).attr('data-cod');
        if (cod!='') {
	        $.ajax({
	            url: '<?php echo $this->Html->url(array('action'=>'editarMantenedorEstado')) ?>'+'/'+cod,
	            type: 'POST',
	        })
	        .fail(function() {
	            notify("Ha ocurrido un error. Intente nuevamente.","danger");
	        })
	        .always(function(view) {
	            // $('#modal-editar-reforzamiento').find('.modal-dialog').addClass('modal-lg').removeClass('modal-custom');
	            $('#modal-editar-mantenedor-estado').find('.modal-content').html(view);
	        });	
        }
    });
    $('body').on('click','.desactivar-estado',function(){
    	$('#form_ajax_del_estado').html('<div align="center"></div>');
		$('#form_ajax_del_estado div').html(imagen_cargando);
    	var active = $(this).attr('data-active');
        var cod = $(this).attr('data-cod');
        if (active == "active") {
        	$url = '<?php echo $this->Html->url(array('action'=>'desactivarMantenedorEstado')) ?>'+'/'+cod+'/'+active
        }else{
        	$url = '<?php echo $this->Html->url(array('action'=>'desactivarMantenedorEstado')) ?>'+'/'+cod
        }
        if (cod!='') {
    		$.ajax({
	            url: $url,
	            type: 'POST',
	        })
	        .fail(function() {
	            notify("Ha ocurrido un error. Intente nuevamente.","danger");
	        })
	        .always(function(view) {
	            // $('#modal-editar-reforzamiento').find('.modal-dialog').addClass('modal-lg').removeClass('modal-custom');
	            $('#modal-eliminar-mantenedor-estado').find('.modal-content').html(view);
	        });	
        }
    });*/
</script>