<div class="row">
	<div class="col-md-12">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;"><label>Ri del Alumnos</label></h2>				
	</div>
</div>
<div class="row m-t-20">
	<form 
		id="form-filtro-basico" 
		action="<?php echo $this->Html->url(array('action'=>'grillaTasaAsistenciaRi')); ?>" 
		method="POST">
		<div class="col-md-2">
			<label for="">Periodo:</label>
			<select name="data[Filtro][periodo]" class="selectpicker form-control" data-live-search="true" mandatory text-error="Debe seleccionar un periodo">
				<option value="">Seleccione</option>
				<?php foreach ($periodos as $key => $value): ?>
					<option value="<?php echo $value['Periodo']['COD_PERIODO']; ?>"><?php echo $value['Periodo']['ANHO'] .'-'.$value['Periodo']['SEMESTRE']; ?></option>
				<?php endforeach ?>
			</select>
			 
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Sigla Secci&oacute;n <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input 
					class="form-control autocompletable-input" 
					type="text" 
					data-field-au="ProgramacionClase.SIGLA_SECCION"
					name="data[Filtro][sigla_seccion]"
					style="text-transform:uppercase;" 
					autocomplete="off"
				>
			</div>  
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Rut Alumno <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input 
					class="form-control autocompletable-input" 
					type="text" 
					data-field-au="Alumno.RUT"
					name="data[Filtro][alumno_rut]"
					style="text-transform:uppercase;" 
					autocomplete="off"
				>
			</div>  
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<label for="">Nombre Alumno <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
				<input 
					class="form-control autocompletable-input" 
					type="text" 
					data-field-au="Alumno.NOMBRE"
					name="data[Filtro][alumno_nombre]"
					style="text-transform:uppercase;" 
					autocomplete="off"
				>
				<input 
					type="hidden"
					id="hidden-cod-alumno"
					name="data[Filtro][valor_alumno]" 
				>
			</div>  
		</div>
		<div class="col-md-2">
			<div class="form-group">
				<button class="btn btn-success" id="btn-generar-reporte" type="submit" style="margin-top: 27px;">VER REPORTE</button>
			</div>  
		</div>
	</form>
</div>
<script>
	$('.selectpicker').selectpicker();
	$('[data-toggle="tooltip"]').tooltip();
	$('.autocompletable-input').each(function(index, el) {
		var variable_filtro = $(this).attr('data-field-au');
		$(this).autocomplete({
			source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/"+variable_filtro,
			minLength: 2,
			select: function( event, ui ) {
				if (variable_filtro=='Alumno.NOMBRE' || variable_filtro=='Alumno.RUT') {
					$('#hidden-cod-alumno').val(ui.item.uuid);
				}
			},
		});	
	});
	$('#form-filtro-basico').off('submit');
	$('#form-filtro-basico').on('submit',function(event) {
		event.preventDefault();
		elemento_click = $(this);
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
</script>