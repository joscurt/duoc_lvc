<?php echo $this->Html->script(array('../material/vendors/bootgrid/jquery.bootgrid.js')); ?>
<style>
	.ui-autocomplete {
	    max-height: 100px;
	    overflow-y: auto;
	    overflow-x: hidden;
	    padding-right: 20px;
	    z-index: 1200;
	}
	* html .ui-autocomplete {
	    height: 100px;
	}
	.alert.alert-dismissable.growl-animated{
		z-index: 1201 !important;
	}
	#data-table-permisos > thead > tr > th span{
		color: white !important; 
		font-size: 1.2em;
	}
	.actionBar {
    	display: none !important;
	}
</style>
<div class="row">
	<form method="POST" action="<?php echo $this->Html->url(array('action'=>'asignarPermisos')); ?>">
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Nombre Usuario <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input 
					type="text" 
					id="nombre-usuario-filtro"
					name="data[Filter][username]"
					value="<?php echo isset($this->data['Filter']['username'])?$this->data['Filter']['username']:null ?>" 
					class="form-control autocomplete-nombre-usuario">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Nombres <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input 
					type="text"
					id="nombre-filtro"
					name="data[Filter][nombre]"
					value="<?php echo isset($this->data['Filter']['nombre'])?$this->data['Filter']['nombre']:null ?>" 
					class="form-control autocomplete-nombre-1">
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Rut <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input
					type="text"
					id="rut-filtro"
					name="data[Filter][rut]"
					value="<?php echo isset($this->data['Filter']['rut'])?$this->data['Filter']['rut']:null ?>" 
					class="form-control autocomplete-rut">
				<input 
					type="hidden"
					id="input-filtro-cod-funcionario" 
					value="<?php echo isset($this->data['COD_FUNCIONARIO'])?$this->data['COD_FUNCIONARIO']:null ?>" 
					name="data[COD_FUNCIONARIO]" />
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label style="margin-bottom: 9px;">Rol</label>
				<select 
					name="data[ROL]"
					id="select-rol-permisos" 
					class="form-control selectpicker" 
					data-live-search="true">
					<option value="">Seleccionar</option>
					<?php foreach ($roles as $key => $value): ?>
						<option 
							<?php echo isset($this->data['ROL']) &&  $key == $this->data['ROL']? 'selected="selected"':null; ?>
							value="<?php echo $key; ?>"><?php echo $value; ?></option>
					<?php endforeach ?>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label style="margin-bottom: 9px;">Estado</label>
				<select 
					name="data[ESTADO]"
					id="select-estado-permisos" 
					class="form-control selectpicker" 
					data-live-search="true">
					<option value="">Seleccionar</option>
					<option <?php echo isset($this->data['ESTADO']) && $this->data['ESTADO']=='activo'?'selected="selected"':null ?> value="activo">ACTIVO</option>
					<option <?php echo isset($this->data['ESTADO']) && $this->data['ESTADO']=='inactivo'?'selected="selected"':null ?> value="inactivo">INACTIVO</option>
				</select>
			</div>
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<button  
					class="btn btn-success" id="btn-submit-form-filter-permisos" style="margin-top: 27px;">Buscar</button>
			</div>
		</div>
	</form>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table table-hover table-striped" id="data-table-permisos" data-ajax="true" data-url="<?php echo $this->Html->url(array('controller'=>'Perfilamiento','action'=>'getDataForDataTable',$conditions['Permiso.COD_FUNCIONARIO'],$conditions['Permiso.ACTIVO'],$conditions['Permiso.ROL_ID'])); ?>">
			<thead>
				<tr>
					<th class="th-cabecera" data-column-id="username" >Nombre de usuario</th>
					<th class="th-cabecera" data-column-id="nombre1" data-sortable="false" >Nombre</th>
					<th class="th-cabecera" data-column-id="rol" data-sortable="false" >Rol</th>
					<th class="th-cabecera" data-column-id="estado" data-sortable="false" >Estado</th>
					<th class="th-cabecera" data-column-id="editar" data-sortable="false" data-formatter="editar" align="center">Editar</th>
					<th class="th-cabecera" data-column-id="activar" data-sortable="false" data-formatter="activar" style="width: 10%;">Activar/Desactivar</th>
				</tr>
			</thead>
		</table>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_usuario"><i class="fa fa-plus"></i>&nbsp;Agregar Nuevo Usuario</button>
		</div>
	</div>
</div>
<div class="modal" id="modal_agregar_usuario" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Agregar Nuevo Usuario</h4>
			</div>
			<br>
			<form action="<?php echo $this->Html->url(array('action'=>'savePermiso')); ?>" method="POST">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="vista">Nombre de Usuario <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
								<input
									type="text"
									id="add-nombre-usuario"
									class="form-control autocomplete-nombre-usuario">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="vista">Nombres <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
								<input 
									type="text"
									id="add-nombre"
									class="form-control autocomplete-nombre-1">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="vista">Rut <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
								<input
									id="add-rut"
									type="text"
									class="form-control autocomplete-rut">
								<input type="hidden" id="input-cod-funcionario-add" name="data[Permiso][COD_FUNCIONARIO]" />
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="rol-id">Rol</label>
								<select id="rol-id" name="data[Permiso][ROL_ID]" class="form-control selectpicker">
									<option>Seleccionar</option>
									<?php foreach ($roles as $key => $value): ?>
										<option value="<?php echo $key ?>"><?php echo strtoupper($value); ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="estado-permiso">Estado</label>
								<select id="estado-permiso" name="data[Permiso][ACTIVO]" class="form-control selectpicker">
									<option>Seleccionar</option>
									<option value="1">ACTIVO</option>
									<option value="0">INACTIVO</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cod-sede">Sede</label>
								<select id="cod-sede" name="data[Sede][COD_SEDE]" class="form-control selectpicker">
									<option>Seleccionar</option>
									<?php foreach ($sedes as $key => $value): ?>
										<option value="<?php echo $value['Sede']['COD_SEDE']; ?>"><?php echo $value['Sede']['NOMBRE']; ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="select-escuelas">Escuela</label>
								<select id="select-escuelas" add-edit="add" name="data[Escuela][COD_ESCUELA]" class="select-escuelas form-control selectpicker">
									<option>Seleccionar</option>
									<option value="ALL">TODAS</option>
									<?php foreach ($escuelas as $key => $value): ?>
										<option value="<?php echo $value['Escuela']['COD_ESCUELA']; ?>"><?php echo strtoupper($value['Escuela']['NOMBRE_ESCUELA']); ?></option>
									<?php endforeach ?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="select-carrera">Carrera <span style="display: none" class="label-cargando"><i class="fa fa-spin fa-cog"></i></span></label>
								<select id="select-carrera" name="data[Carrera][COD_CARRERA]" class="select-carrera-add form-control selectpicker">
									<option>Seleccionar</option>
									<option value="ALL">TODAS</option>
								</select>
							</div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-info" style="display:none" id="buscar-otro-usuario"><i class="fa fa-refresh"></i> BUSCAR OTRO USUARIO</button>
					<button type="submit" class="btn btn-sm btn-success" id="btn-submit-add-permiso"><i class="fa fa-save"></i>&nbsp;GUARDAR</button>
					<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
				</div>
			</form>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_usuario" >
	<div class="modal-dialog">
		<div class="modal-content"></div>
	</div>
</div>
<script>
		$("#data-table-permisos").bootgrid({
	        header:false,
	        caseSensitive:false,
	        rowCount:[<?php echo empty($numero_rows_por_pagina)? 100:$numero_rows_por_pagina; ?>],
			actions:null,
	        labels: {
	            all: "TODOS",
	            infos: "Mostrando de {{ctx.start}} a {{ctx.end}} de un total de {{ctx.total}} registros",
	            loading: "CARGANDO...",
	            noResults: "NO HAY RESULTADOS!",
	            refresh: "REFRESCAR",
	            search: "BUSCAR"
	        },
	        css: {
	            icon: 'md icon',
	            iconColumns: 'md-view-module',
	            iconDown: 'md-expand-more',
	            iconRefresh: 'md-refresh',
	            iconUp: 'md-expand-less',
	        },
	        formatters: {
	            "editar": function(column, row) {
	                return 	'<a onclick="javascript:editar(\'<?php echo $this->Html->url(array('action'=>'editarPermiso')) ?>/'+row.editar+'\')" class="btn btn-info btn-editar-permiso"><i class="md md-edit"></i></a>';
	            },
	            "activar": function(column, row) {
	                var class_btn = 'success';
	                var class_i = 'check';
	                if (row.estado == 'ACTIVO') {
	                	class_i = 'delete';
	                	class_btn = 'danger';

	                }
	                return 	'<a onclick="javascript:editar(\'<?php echo $this->Html->url(array('action'=>'eliminarPermiso')) ?>/'+row.editar+'\')" class="btn btn-'+class_btn+'"><i class="md md-'+class_i+'"></i></a>';
	            }
	        }
	    });	
	$('#btn-submit-form-filter-permisos').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		if ($('#rut-filtro').val() == '' && $('#nombre-filtro').val() == '' && $('#nombre-usuario-filtro').val() == '') {
			$('#input-filtro-cod-funcionario').val('');
		}
		var form = elemento_click.parents('form');
		$('#contenedor-vistas .card-body').html('<div align="center"></div>');
		$('#contenedor-vistas .card-body div').html(imagen_cargando);
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'html',
			data:form.serialize(),
		})
		.fail(function(error){
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
			$('#contenedor-vistas .card-body').html('');
		})
		.always(function(view){
			$('#contenedor-vistas .card-body').html(view);
		});
	});
	$('#select-estado-permisos, #select-rol-permisos').selectpicker();
	$('[data-toggle="tooltip"]').tooltip();
		function editar(url){
			$('#modal_editar_usuario .modal-content').html('<div align="center"></div>');
			$('#modal_editar_usuario .modal-content div').html(imagen_cargando);
			$('#modal_editar_usuario').modal('show');
			$.ajax({
				url: url,
				type: 'POST',
				dataType: 'html',
			})
			.fail(function(error){
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
				$('#modal_editar_usuario').modal('hide');
			})
			.always(function(view){
				$('#modal_editar_usuario .modal-content').html(view);
			});
		}
	$('#btn-submit-add-permiso').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		elemento_click.html('<i class="fa fa-cog fa-spin"></i>').prop('disabled',true);
		if(elemento_click.parents('form').find('#input-cod-funcionario-add').val()!=''){
			$.ajax({
				url: elemento_click.parents('form').attr('action'),
				type: 'POST',
				dataType: 'json',
				data:elemento_click.parents('form').serialize(),
			})
			.fail(function() {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
			})
			.always(function(response) {
				$('#select-vista').change();
				notifyUser(response.mensaje,response.status);
				$('body').removeClass('modal-open').removeAttr('style');
			});
		}else{
			notifyUser('Debe seleccionar un usuario del listado autocompletable.','info');
			elemento_click.html('<i class="fa fa-save"></i> GUARDAR').prop('disabled',false);
		}
	});
	$('body').on('change','.select-escuelas', function(event) {
		event.preventDefault();
		selector_carreras = $(this).attr('add-edit');
		$('.label-cargando').show();
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getCarrerasByEscuela')); ?>'+'/'+event.target.value,
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
		})
		.always(function(view) {
			$('select.select-carrera-'+selector_carreras).html(view);
			$('select.select-carrera-'+selector_carreras).selectpicker('refresh');
			$('.label-cargando').hide();
		});
	});
	$('#buscar-otro-usuario').on('click', function(event) {
		$(this).hide();
		$('#input-cod-funcionario-add').val('');
		$('#add-rut').val('').prop('disabled',false);
		$('#add-nombre').val('').prop('disabled',false);
		$('#add-nombre-usuario').val('').prop('disabled',false);
	});
	$('#modal_agregar_usuario select.selectpicker').selectpicker();
	$('.autocomplete-nombre-1').autocomplete({
		source:"<?php echo $this->Html->url(array('action'=>'autocompleteFuncionario','NOMBRE1')); ?>" ,
		minLength: 2,
		select: function( event, ui ) {
			$('#input-filtro-cod-funcionario, #input-cod-funcionario-add').val(ui.item.uuid);
			completarDatosAdd(ui.item.obj);
		},
	});
	$('.autocomplete-nombre-usuario').autocomplete({
		source:"<?php echo $this->Html->url(array('action'=>'autocompleteFuncionario','USERNAME')); ?>" ,
		minLength: 2,
		select: function( event, ui ) {
			$('#input-filtro-cod-funcionario, #input-cod-funcionario-add').val(ui.item.uuid);
			completarDatosAdd(ui.item.obj);
		},
	});
	$('.autocomplete-rut').autocomplete({
		source:"<?php echo $this->Html->url(array('action'=>'autocompleteFuncionario','RUT')); ?>" ,
		minLength: 2,
		select: function( event, ui ) {
			$('#input-filtro-cod-funcionario, #input-cod-funcionario-add').val(ui.item.uuid);
			completarDatosAdd(ui.item.obj);
		},
	});
	function completarDatosAdd(argument) {
		$('#add-rut').val(argument.Funcionario.RUT).prop('disabled',true);
		var nombre_funcionario = argument.Funcionario.NOMBRE1+' '+argument.Funcionario.APELLIDO_PAT+' '+argument.Funcionario.APELLIDO_MAT;
		//alert(nombre_funcionario);
		$('#add-nombre').val(nombre_funcionario).prop('disabled',true);
		$('#add-nombre-usuario').val(argument.Funcionario.USERNAME).prop('disabled',true);
		$('#buscar-otro-usuario').show();
	}
</script>