<form id="form-filtro-basico" 
	action="<?php echo $this->Html->url(array('action'=>$url_action)) ?>" 
	method="POST">
	<input type="hidden" name="data[Filtro][tipo_fitrar]" value="simple" />
	<div class="col-md-2">
		<label for="">Fecha inicio</label>
		<div class="input-group form-group">
			<span class="input-group-addon"><i class="md md-event"></i></span>
				<div class="dtp-container dropdown fg-line">
				<input type='text' 
					name="data[Filtro][fecha_inicio]" 
					id="fecha_inicio"					
					class="form-control date-time-picker fecha-inicio" 
					value="<?php echo !empty($datos_filtro['Filtro']['fecha_inicio']) ? $datos_filtro['Filtro']['fecha_inicio'] : date('d-m-Y');?>" 
					autocomplete="off"
					data-toggle="dropdown" 
					placeholder="DD-MM-YYYY"
				/>
			</div>
		</div>  
	</div>
	<div class="col-md-2">
		<label for="">Fecha termino</label>
		<div class="input-group form-group">
			<span class="input-group-addon"><i class="md md-event"></i></span>
				<div class="dtp-container dropdown fg-line">
				<input type='text' 
					name="data[Filtro][fecha_fin]" 
					id="fecha_fin"					
					class="form-control date-time-picker fecha-termino" 
					value="<?php echo !empty($datos_filtro['Filtro']['fecha_fin']) ? $datos_filtro['Filtro']['fecha_fin'] : date('d-m-Y');?>" 
					data-toggle="dropdown" 
					autocomplete="off"
					placeholder="DD-MM-YYYY"
				/>
			</div>
		</div>  
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="data[Filtro][filtro]" style="margin-bottom: 8px !important;">Filtro:</label>
			<select name="data[Filtro][filtro]" id="filtro" class="form-control selectpicker" data-live-search="true" required="">
				<option value="">Seleccionar</option>
				<?php foreach ($filtros_posibles as $key => $value): ?>
					<option 
						<?php echo !empty($datos_filtro['Filtro']['filtro']) && $datos_filtro['Filtro']['filtro'] == $key ? 'selected="selected"' : '';?>
						value="<?php echo $key ?>" ><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
		</div>  
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="">Buscar: <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda. Debe seleccionar una." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
			<input name="data[Filtro][autocomplete]" 
				id="buscar-tipo" 
				class="form-control" 
				type="text" 
				value="<?php echo !empty($datos_filtro['Filtro']['autocomplete']) ? $datos_filtro['Filtro']['autocomplete'] : '';  ?>" 
				style="text-transform:uppercase;" 
				tipo-filtro="" 
				autocomplete="off"
				required="" 
			/>
			<input type="hidden" 
				name="data[Filtro][value]" 
				id="hidden-uuid" 
				value="<?php echo !empty($datos_filtro['Filtro']['value']) ? $datos_filtro['Filtro']['value'] : '';  ?>" 
			/>
		</div>  
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<button type="submit" id="btnBuscar" class="btn btn-success btn_buscar" style="margin-top: 27px;">Buscar</button>
		</div>  
	</div>
</form>
<script>
	$('[data-toggle="tooltip"]').tooltip();
	
	$("#buscar-tipo").keypress(function(event) {
		var url='';
		var tipo_filtro = $("#filtro").val();
		if(tipo_filtro!=""){
			$("#buscar-tipo").autocomplete({
				source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/"+tipo_filtro,
				minLength: 3,
				select: function( event, ui ) {
					$('#hidden-uuid').val(ui.item.uuid);
				},
			});
		}
	});

	$( "#filtro" ).change(function() {
		$( "#buscar-tipo, #hidden-uuid" ).val("");
		$('#card-content-grilla').html('');
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

	$('#form-filtro-basico .btn_buscar').on('click', function(event) {
		//event.preventDefault();
		var fecha_inicio = $('#form-filtro-basico .fecha-inicio').val();
		var fecha_termino = $('#form-filtro-basico .fecha-termino').val();
		if(!fechaCorrecta(fecha_inicio,fecha_termino)){
			notifyUser('La fecha de t&eacute;rmino no puede ser menor a la fecha de inicio.','danger');
			return false;	
		}
	});
</script>