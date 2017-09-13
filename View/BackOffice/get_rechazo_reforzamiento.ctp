<div class="row">
	<div class="col-md-12">
		<h3 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Motivo Rechazo Reforzamiento</h3>
	</div>
	<div class="col-md-12">
		<?php if (!empty($rechazos_reforzamientos)): ?>
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
			  		<?php foreach ($rechazos_reforzamientos as $key => $motivo): ?>
					  	<tr class="odd" id="tr-<?php echo $motivo['MotivosRechazoReforzamiento']['ID'];?>">
					    	<td><?php echo $key+1 ?></td>
						    <td><?php echo $motivo['MotivosRechazoReforzamiento']['MOTIVO'] ?></td>
						    <td>
						    	<a 
						    		class="btn btn-info"
						    		send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>'editarRechazo',$motivo['MotivosRechazoReforzamiento']['COD'])); ?>"
						    		title="Editar">
						    		<i class="fa fa-pencil-square" aria-hidden="true"></i>
						    	</a>
						    </td>
					    	<td>
					    		<?php 
					    			$class_btn = 'btn-success';
					    			$title = 'Activar';
					    			$action_url= 'desactivarRechazo';
					    			$icon= 'fa-check';
					    			$active= 'active';
					    			if ($motivo['MotivosRechazoReforzamiento']['ACTIVO'] == 1): 
					    				$class_btn = 'btn-danger';
					    				$title = 'Desactivar';
					    				$action_url= 'desactivarRechazo';
					    				$icon= 'fa-times';
					    				$active= '';
					    			endif;
					    		?>
					    		<a 
						    		class="btn <?php echo $class_btn; ?>" 
									send-ajax="true"
									type-response="html"
									href="<?php echo $this->Html->url(array('action'=>$action_url,$motivo['MotivosRechazoReforzamiento']['COD'],$active)); ?>"
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
			href="<?php echo $this->Html->url(array('action'=>'agregarRechazo')); ?>" 
			class="btn btn-success"><i class="fa fa-plus"></i>&nbsp;Agregar</a>
	</div>
</div>