<form id="form-filtro-basico" 
	action="<?php echo $this->Html->url(array('action'=>$url_action)) ?>" 
	method="POST">
	<input type="hidden" name="data[Filtro][tipo_fitrar]" value="simple" />
	<div class="col-md-3">
		<div class="form-group">
			<label for="data[Filtro][filtro]" style="margin-bottom: 8px !important;">Filtro:</label>
			<select id="filtro" name="data[Filtro][filtro]" class="form-control selectpicker" data-live-search="true" required="">
				<option value="">Seleccionar</option>
				<?php foreach ($filtros_posibles as $key => $value): ?>
					<option 
						<?php echo !empty($datos_filtro['Filtro']['filtro']) && $datos_filtro['Filtro']['filtro'] == $key ? 'selected="selected"' : '';?>
						value="<?php echo $key ?>" ><?php echo $value; ?></option>
				<?php endforeach; ?>
			</select>
		</div>  
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<label for="">Buscar: <span title="Se desplegar&aacute; un listado de opciones coincidentes con su b&uacute;squeda. Debe seleccionar una." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
			<input id="buscar-tipo" 
				class="form-control" 
				type="text" 
				value="<?php echo !empty($datos_filtro['Filtro']['autocomplete']) ? $datos_filtro['Filtro']['autocomplete'] : '';  ?>" 
				name="data[Filtro][autocomplete]"
				style="text-transform:uppercase;" 
				tipo-filtro="" 
				autocomplete="off"
				required="" 
			>
			<input type="hidden" 
				name="data[Filtro][value]" 
				value="<?php echo !empty($datos_filtro['Filtro']['value']) ? $datos_filtro['Filtro']['value'] : '';  ?>" 
				id="hidden-uuid" 
			/>
		</div>  
	</div>
	<div class="col-md-3">
		<div class="form-group">
			<button class="btn btn-success btn_buscar" type="submit" style="margin-top: 27px;">Buscar</button>
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

	$('#form-filtro-basico .btn_buscar').on('click', function(event) {
		//event.preventDefault();
	});
</script>