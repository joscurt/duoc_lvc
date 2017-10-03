<?php
	$mantenedores_url = array(
		'mantenedor_detalle' => $this->Html->url(array('action'=>'getMantenedorDetalle')),
		'mantenedor_estado' => $this->Html->url(array('action'=>'getMantenedorEstado')),
		'mantenedor_subestado' => $this->Html->url(array('action'=>'getMantenedorSubEstado')),
		'motivo_adelantar_clase' => $this->Html->url(array('action'=>'getMotivoAdelantarClase')),
		'motivo_inasistencia_docente' => $this->Html->url(array('action'=>'getMotivoInasistenciaDocente')),
		'motivo_rechazo_clase' => $this->Html->url(array('action'=>'getMotivoRechazoClase')),
		'motivo_rechazo_reforzamiento' => $this->Html->url(array('action'=>'getRechazoReforzamiento')),
		'motivo_recuperar_atraso_retiro' => $this->Html->url(array('action'=>'getRecuperarAtrasoRetiro')),
		'motivo_reforzamiento' => $this->Html->url(array('action'=>'getMantenedorMotivoReforzamiento')),
		'motivo_suspension_clase' => $this->Html->url(array('action'=>'getMotivoSuspensionClase')),
		'porcentaje_para_ri'=>$this->Html->url(array('action'=>'reprobadoInasistencia')),
		'tipo_justificacion_legal' => $this->Html->url(array('action'=>'getTipoJustificacionLegal')),
	);
	$mantenedores = array(
		'mantenedor_detalle' =>'Mantenedor Detalle',
		'mantenedor_estado' =>'Mantenedor Estado',
		'mantenedor_subestado' =>'Mantenedor Sub-Estado',
		'motivo_adelantar_clase' =>'Motivo Adelantar Clase',
		'motivo_inasistencia_docente' =>'Motivo Inasistencia Docente',
		'motivo_rechazo_clase' =>'Motivo Rechazo Clase',
		'motivo_rechazo_reforzamiento' =>'Motivo Rechazo Reforzamiento',
		'motivo_recuperar_atraso_retiro' =>'Motivo Recuperar Atraso y Retiro',
		'motivo_reforzamiento' =>'Motivo Reforzamiento',
		'motivo_suspension_clase' =>'Motivo Suspensi&oacute;n Clases',
		'porcentaje_para_ri' =>'Porcentaje para RI',
		'tipo_justificacion_legal' =>'Tipo Justificaci&oacute;n Legal',
	);
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Mantenedores</h1>
		</div>  
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="" style="margin-bottom: 8px !important;">Seleccionar una vista:</label>
					<select id="select-vista" name="" id="filtro" class="form-control selectpicker" data-live-search="true">
						<option value="" selected>Seleccionar</option>
						<?php foreach ($mantenedores as $key => $value): ?>
							<option value="<?php echo $mantenedores_url[$key]; ?>"><?php echo strtoupper($value); ?></option>
						<?php endforeach ?>
					</select>
				</div>  
			</div>
		</div>
	</div>
</div>
<div class="card" id="contenedor-vistas" >
	<div class="card-body card-padding">
		
	</div>
</div>
<div class="modal" id="modal-generic" >
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<div class="modal" id="modal-editar-inasistencia">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: "Nombre del Motivo Inasistencia Docente"</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control" placeholder="Nombre del Motivo Inasistencia Docente">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="card" id="filtro_sede" style="display: none;">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Sede</label>
					<select class="form-control selectpicker" data-live-search="true" id="sede" name="sede">
						<option>Seleccionar</option>
						<option>San Carlos de Apoquindo</option>
						<option>San Carlos de Apoquindo</option>
						<option>San Carlos de Apoquindo</option>
					</select>
				</div>	
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Escuela</label>
					<select class="form-control selectpicker" data-live-search="true" id="escuela" name="escuela">
						<option>Seleccionar</option>
						<option>Escuela de Dise&ntilde;o</option>
						<option>Escuela de Dise&ntilde;o</option>
						<option>Escuela de Dise&ntilde;o</option>
					</select>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Carrera</label>
					<select class="form-control selectpicker" data-live-search="true" id="carrera" name="carrera">
						<option>Seleccionar</option>
						<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
						<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
						<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card" id="porcentaje_ri" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Porcentaje para RI</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Sede</th>
							<th>Escuela</th>
							<th>Carrera</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
				  		<tr class="odd">
						    <td>1</td>
						    <td>San Carlos de Apoquindo</td>
						    <td>Escuela de Dise&ntilde;o</td>
						    <td>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</td>
						    <td><a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_editar_porcentaje_ri" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal_eliminar_porcentaje_ri" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
						    <td>2</td>
						    <td>San Carlos de Apoquindo</td>
						    <td>Escuela de Dise&ntilde;o</td>
						    <td>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</td>
							<td><a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_editar_porcentaje_ri" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal_eliminar_porcentaje_ri" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>3</td>
						    <td>San Carlos de Apoquindo</td>
						    <td>Escuela de Dise&ntilde;o</td>
						    <td>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</td>
						    <td><a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_editar_porcentaje_ri" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal_eliminar_porcentaje_ri" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>4</td>
						    <td>San Carlos de Apoquindo</td>
						    <td>Escuela de Dise&ntilde;o</td>
						    <td>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</td>
						    <td><a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_editar_porcentaje_ri" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal_eliminar_porcentaje_ri" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>5</td>
						    <td>San Carlos de Apoquindo</td>
						    <td>Escuela de Dise&ntilde;o</td>
						    <td>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</td>
						    <td><a class="btn btn-info" href="#" data-toggle="modal" data-target="#modal_editar_porcentaje_ri" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="#" data-toggle="modal" data-target="#modal_eliminar_porcentaje_ri" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_porcentaje_ri"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_porcentaje_ri" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando RI</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Sede:</label>
							<select class="form-control selectpicker" id="sede" name="sede">
								<option>Seleccionar</option>
								<option selected>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Escuela:</label>
							<select class="form-control selectpicker" id="escuela" name="escuela">
								<option>Seleccionar</option>
								<option selected>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Carrera:</label>
							<select class="form-control selectpicker" id="carrera" name="carrera">
								<option>Seleccionar</option>
								<option selected>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-control">
							<label for="ri">RI (%)</label>
							<input type="number" class="form-control" name="ri" id="ri" value="75">	
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_porcentaje_ri">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar <strong>San Carlos de Apoquindo</strong> > <strong>Escuela de Dise&ntilde;o</strong> > <strong>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_porcentaje_ri" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de Porcentaje para RI</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Sede:</label>
							<select class="form-control selectpicker" id="sede" name="sede">
								<option>Seleccionar</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Escuela:</label>
							<select class="form-control selectpicker" id="escuela" name="escuela">
								<option>Seleccionar</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Carrera:</label>
							<select class="form-control selectpicker" id="carrera" name="carrera">
								<option>Seleccionar</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-control">
							<label for="ri">RI (%)</label>
							<input type="number" class="form-control" name="ri" id="ri" value="75">	
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
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
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
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
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif',array('width'=>'50%')); ?>');
	$('#select-vista').on('change',function (event) {
		if (event.target.value != '') {
			$('#contenedor-vistas .card-body').html('<div align="center"></div>');
			$('#contenedor-vistas .card-body div').html(imagen_cargando);
			$.ajax({
				url: event.target.value,
				type: 'POST',
				dataType: 'html',
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
				$('#contenedor-vistas .card-body').empty();
			})
			.always(function(view) {
				$('#contenedor-vistas .card-body').html(view);
			});
		}
	});	
</script>