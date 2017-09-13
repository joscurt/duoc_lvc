<?php
	$mantenedores_url = array(
		'Rol' => $this->Html->url(array('action'=>'getIndex')),
		'Vista'=>$this->Html->url(array('action'=>'getIndex')),
		'Funcionalidad'=>$this->Html->url(array('action'=>'getIndex')),
		'Perfil'=>$this->Html->url(array('action'=>'getIndex')),
		'Administracion'=>$this->Html->url(array('action'=>'administracion')),
		'AsignarPermiso'=>$this->Html->url(array('action'=>'asignarPermisos')),
	);
	$mantenedores = array(
		'Administracion' =>'ADMINISTRACIÓN',
		'AsignarPermiso'=>'ASIGNAR PERMISOS',
		'Funcionalidad'=>'MANTENEDOR FUNCIONALIDADES',
		'Perfil'=>'MANTENEDOR PERFILES',
		'Rol' =>'MANTENEDOR ROLES',
		'Vista'=>'MANTENEDOR VISTAS',
	);
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Roles y Perfiles</h1>
		</div>  
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="select-vista" style="margin-bottom: 8px !important;">Seleccionar una vista:</label>
					<select id="select-vista" class="form-control selectpicker" data-live-search="true">
						<option value="" selected>Seleccionar</option>
						<?php foreach ($mantenedores as $key => $value): ?>
							<option 
								data-model="<?php echo $key; ?>"
								value="<?php echo $mantenedores_url[$key]; ?>"
								><?php echo strtoupper($value); ?></option>
						<?php endforeach ?>
					</select>
				</div>  
			</div>
		</div>
	</div>	
</div>
<div class="card" id="contenedor-vistas">
	<div class="card-body card-padding"></div>
</div>
<div class="modal" id="modal-generic" >
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<script>
	$('body').on('submit','form',function(event) {
		event.preventDefault();
	});
	$('body').on('click','a[send-ajax="true"]',function(event) {
		event.preventDefault();
		elemento_click = $(this);
		$('#modal-generic .modal-content').html('<div align="center"></div>');
		$('#modal-generic .modal-content div').html(imagen_cargando);
		$('#modal-generic').modal('show');
		$.ajax({
			url: elemento_click.attr('href'),
			type: 'POST',
			dataType: elemento_click.attr('type-response'),
			data:elemento_click.attr('type-response')=='json'? elemento_click.parents('form').serialize():{},
		})
		.fail(function(error_reader) {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
			$('#modal-generic .modal-content').empty();
			$('#modal-generic').modal('hide');
		})
		.always(function(response) {
			if(elemento_click.attr('type-response')=='json'){
				$('#select-vista').trigger('change');
				notifyUser(response.mensaje,response.status);
				$('#modal-generic').modal('hide');
			}else{
				$('#modal-generic .modal-content').html(response);
			}
		});
	});
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	$('#select-vista').on('change',function (event) {
		if (event.target.value != '') {
			$('#contenedor-vistas .card-body').html('<div align="center"></div>');
			$('#contenedor-vistas .card-body div').html(imagen_cargando);
			$.ajax({
				url: event.target.value,
				type: 'POST',
				dataType: 'html',
				data:{model:$('#select-vista').find('option:selected').attr('data-model')}
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
				$('#contenedor-vistas .card-body').empty();
			})
			.always(function(view) {
				$('#contenedor-vistas .card-body').html(view);
			});
		}
	});
</script>