<?php 
	$url_action = isset($url_action)?$url_action:null;
	$filtro_fecha_inicio = isset($filtro_fecha_inicio)?$filtro_fecha_inicio:true;
	$label_fecha_inicio = isset($label_fecha_inicio)?$label_fecha_inicio:'Fecha inicio';
	$filtro_fecha_termino = isset($filtro_fecha_termino)?$filtro_fecha_termino:true;
	$filtro_nombre_docente = isset($filtro_nombre_docente)?$filtro_nombre_docente:true;
	$filtro_nombre_asignatura = isset($filtro_nombre_asignatura)?$filtro_nombre_asignatura:true;
	$filtro_horarios = isset($filtro_horarios)?$filtro_horarios:false;
?>
<div class="row m-t-20">
	<form 
		id="form-filtro-basico" 
		action="<?php echo $this->Html->url(array('action'=>$url_action)) ?>" 
		method="POST">
		<?php if ($filtro_fecha_inicio): ?>
			<div class="col-md-2">
				<label for=""><?php echo $label_fecha_inicio; ?>:</label>
				<div class="input-group form-group">
					<span class="input-group-addon"><i class="md md-event"></i></span>
						<div class="dtp-container dropdown fg-line">
						<input 
							type='text' 
							class="form-control date-time-picker fecha-inicio" 
							value="<?php echo !empty($datos_filtro['Filtro']['fecha_inicio']) ? $datos_filtro['Filtro']['fecha_inicio'] : date('d-m-Y');?>" 
							name="data[Filtro][fecha_inicio]" 
							autocomplete="off"
							data-toggle="dropdown" 
							placeholder="Haga click..."
							required="required"
							
						>
					</div>
				</div>  
			</div>
		<?php endif ?>
		<?php if ($filtro_fecha_termino): ?>
			<div class="col-md-2">
				<label for="">Fecha t&eacute;rmino:</label>
				<div class="input-group form-group">
					<span class="input-group-addon"><i class="md md-event"></i></span>
						<div class="dtp-container dropdown fg-line">
						<input 
							type='text' 
							class="form-control date-time-picker fecha-termino" 
							value="<?php echo !empty($datos_filtro['Filtro']['fecha_fin']) ? $datos_filtro['Filtro']['fecha_fin'] : date('d-m-Y');?>" 
							name="data[Filtro][fecha_fin]" 
							data-toggle="dropdown" 
							autocomplete="off"
							required="required"
							placeholder="Haga click..."
						>
					</div>
				</div>  
			</div>
		<?php endif ?>
		<?php if ($filtro_horarios): ?>
			<div class="col-md-2">
				<div class="form-group">
					<label class="m-b-10">Horario inicio</label>
					<select 
						class="form-control selectpicker horario-inicio" 
						name="data[Filtro][horario_inicio]"
						data-live-search="true"
						style="text-transform:uppercase;" 
					>
					<option value=""></option>
					<?php foreach ($horarios_modulos as $key => $value): ?>
						<option value="<?php echo $value['hora_inicio']; ?>"><?php echo $value['hora_inicio']; ?></option>
					<?php endforeach ?>
					</select>
				</div>  
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label class="m-b-10">Horario t&eacute;rmino</label>
					<select 
						class="form-control selectpicker horario-termino" 
						name="data[Filtro][horario_termino]"
						data-live-search="true"
						style="text-transform:uppercase;" 
					>
					<option value=""></option>
					<?php foreach ($horarios_modulos as $key => $value): ?>
						<option value="<?php echo $value['hora_fin']; ?>"><?php echo $value['hora_fin']; ?></option>
					<?php endforeach ?>
					</select>
				</div>  
			</div>
		<?php endif; ?>
		<?php if ($filtro_nombre_docente): ?>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Nombre Docente<span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
					<input 
						class="form-control autocompletable-input" 
						type="text" 
						data-field-au="Docente.NOMBRE"
						name="data[Filtro][nombre_docente]"
						style="text-transform:uppercase;" 
						autocomplete="off"
					>
					<input 
						type="hidden"
						id="hidden-cod-docente"
						name="data[Filtro][valor_docente]" 
					>
				</div>  
			</div>
		<?php endif ?>
		<?php if ($filtro_nombre_asignatura): ?>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Nombre Asignatura <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
					<input 
						class="form-control autocompletable-input" 
						type="text" 
						data-field-au="Asignatura.NOMBRE"
						name="data[Filtro][nombre_asignatura]"
						style="text-transform:uppercase;" 
						autocomplete="off"
					>
				</div>  
			</div>
		<?php endif ?>
		<div class="col-md-2">
			<div class="form-group">
				<button class="btn btn-success" id="btn-generar-reporte" type="submit" style="margin-top: 27px;">Ver Reporte</button>
			</div>  
		</div>
	</form>
</div>
<script>
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
	$('#form-filtro-basico .selectpicker').selectpicker();
	$('[data-toggle="tooltip"]').tooltip();
	$('.autocompletable-input').each(function(index, el) {
		var variable_filtro = $(this).attr('data-field-au');
		$(this).autocomplete({
			source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/"+variable_filtro,
			minLength: 2,
			select: function( event, ui ) {
				if (variable_filtro=='Docente.NOMBRE') {
					$('#hidden-cod-docente').val(ui.item.uuid);
				}
			},
		});	
	});
	function fechaCorrecta(fecha1, fecha2){
	    //Split de las fechas recibidas para separarlas
	    var x = fecha1.split("-");
	    var z = fecha2.split("-");
	    
	    //Cambiamos el orden al formato americano, de esto dd/mm/yyyy a esto mm/dd/yyyy
	    fecha1 = x[2] + "-" + x[1] + "-" + x[0];
	    fecha2 = z[2] + "-" + z[1] + "-" + z[0];

	    
	    //Comparamos las fechas
	    
	    if (Date.parse(fecha1) > Date.parse(fecha2)){
	        return false;
	    }else{
	        return true;
	    }
	}

	$('#form-filtro-basico #btn-generar-reporte').on('click', function(event) {
		<?php if($filtro_fecha_inicio && $filtro_fecha_termino): ?>
			var fecha_inicio = $('#form-filtro-basico .fecha-inicio').val();
			var fecha_termino = $('#form-filtro-basico .fecha-termino').val();
			if(!fechaCorrecta(fecha_inicio,fecha_termino)){
				notifyUser('La fecha de t&eacute;rmino no puede ser menor a la fecha de inicio.','danger');
				return false;	
			}
		<?php endif; ?>
		<?php if($filtro_horarios): ?>
			var horario_inicio = $('#form-filtro-basico .horario-inicio').val();
			if(horario_inicio == ''){
				notifyUser('El horario de inicio no puede estar vac&iacute;o.','danger');
				return false;	
			}
			var horario_termino = $('#form-filtro-basico .horario-termino').val();
			if(horario_termino == ''){
				notifyUser('El horario de t&eacute;rmino	 no puede estar vac&iacute;o.','danger');
				return false;	
			}
		<?php endif; ?>
	});
</script>