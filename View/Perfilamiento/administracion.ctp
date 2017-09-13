<style>
	table.admin { text-align: left;}
	table.admin td {border: 1px solid #ccc; text-align: left;}
	table.admin td.first {text-align: left;}
	table.admin i.fa {font-size: 1.3em; margin: 0 2px;}
	.infografia {font-size: 1.4em; overflow: hidden; padding-bottom: 20px;}
	.infografia .inside {width: 410px; margin: 0 auto!important;}
	.infografia .dato {float: left; width: 33.333%;}
	table.admin *{ font-size: 1.2rem; }
	table.admin i.fa-plus-square, .infografia i.fa-plus-square {color: #4caf50;}
	table.admin i.fa-pencil-square, .infografia i.fa-pencil-square {color: #00bcd4;}
	table.admin i.fa-eye, .infografia i.fa-eye {color: #f8b31c;}
	table.admin tr.tr-head {background: #003964; color: #FFF; text-transform: uppercase; text-align: left;}
	table.admin tr.tr-head:hover {background: #003964;}
	table.admin tr.tr-head td {border-color: #003964;}
	table.admin thead {border: 1px solid #34495e }
	table.admin thead th {width: 8.888%;}
	table.admin thead th.first {width: 20%;}
	.disabled{opacity: 0.4;}
</style>
<?php #debug($permisos_funcionalidades); ?>
<div class="row">
	<div class="col-md-12">
		<div class="infografia">
			<div class="inside">
			<?php foreach ($perfiles as $key => $value): ?>
				<div class="dato dato-1"><i class="<?php echo $value['Perfil']['ICON']; ?>" aria-hidden="true" title="<?php echo $value['Perfil']['NOMBRE'] ?>"></i> = <?php echo $value['Perfil']['NOMBRE'] ?></div>
			<?php endforeach ?>
		</div>
	</div>
	<div class="col-md-12">
		<table border="0" cellpadding="0" cellspacing="0" class="admin table table-striped">
			<thead>
			  	<tr>
				    <th class="first"></th>
				    <?php foreach ($roles as $key => $value): ?>
				    	<th><?php echo $value; ?></th>
					<?php endforeach; ?>
			  	</tr>
			</thead>
			<tbody>
				<?php foreach ($vistas as $vista_id => $vista): ?>	
				  	<tr class="tr-head">
				    	<td colspan="<?php echo count($roles)+1; ?>"><?php echo $vista; ?></td>
				  	</tr>
				  	<?php foreach ($funcionalidades as $funcionalidad): ?>
				  		<?php if ($funcionalidad['Funcionalidad']['VISTA_ID'] == $vista_id): ?>
					  		<tr class="odd">
							    <td class="first"><?php echo $funcionalidad['Funcionalidad']['NOMBRE']; ?></td>
							    <?php 
							    	foreach ($roles as $rol_id => $rol): 
							    		$objeto = array();
							    		if(isset($permisos_funcionalidades[$rol_id][$funcionalidad['Funcionalidad']['ID']])){
							    			$objeto = $permisos_funcionalidades[$rol_id][$funcionalidad['Funcionalidad']['ID']];
										}
							    ?>
								    <td>
									    <form method="POST">
								    		<input type="hidden" name="data[FUNCIONALIDAD_ID]" value="<?php echo $funcionalidad['Funcionalidad']['ID']; ?>" />
								    		<input type="hidden" name="data[ROL_ID]" value="<?php echo $rol_id; ?>" />
								    		<input type="hidden" name="data[ID]" value="<?php echo !empty($objeto)? $objeto['PermisoFuncionalidad']['ID']:null; ?>" />
										    <?php foreach ($perfiles as $perfil_id => $perfil): ?>
									    		<a
													send-ajax="true"
													type-response="json"
													data-toggle="tooltip"
													title="<?php echo !empty($objeto) && $objeto['PermisoFuncionalidad'][$perfil['Perfil']['NOMBRE']] == 1? 'DESACTIVAR':'ACTIVAR'; ?>"
													class="btn-cambiar-permiso-1-0 <?php echo !empty($objeto) && isset($objeto['PermisoFuncionalidad'][$perfil['Perfil']['NOMBRE']]) && $objeto['PermisoFuncionalidad'][$perfil['Perfil']['NOMBRE']]== 1? null:'disabled'; ?>"
													href="<?php echo $this->Html->url(array('action'=>'savePerfilPermiso',$perfil['Perfil']['NOMBRE'])); ?>"
									    			>
									    			<input 
									    			type="hidden" 
									    			name="data[<?php echo $perfil['Perfil']['NOMBRE']; ?>]" 
									    			value="<?php echo !empty($objeto)? $objeto['PermisoFuncionalidad'][$perfil['Perfil']['NOMBRE']]:null; ?>" />
									    			<i 
									    				class="<?php echo $perfil['Perfil']['ICON']; ?>" 
									    				aria-hidden="true" ></i>
									    		</a>
											<?php endforeach ?>
										</form>
								    </td>
								<?php endforeach ?>
						  	</tr>
					  	<?php endif ?>
				  	<?php endforeach ?>
				  	<!--  -->
			  	<?php endforeach ?>
		 	</tbody> 
		</table>
	</div>
</div>
<script>
	$('[data-toggle="tooltip"]').tooltip();
	$('.btn-cambiar-permiso-1-0').on('click', function(event) {
		event.preventDefault();

		if($(this).find('input').val()==1){
			$(this).find('input').val(0);
		}else{
			$(this).find('input').val(1);
		}
	});
</script>