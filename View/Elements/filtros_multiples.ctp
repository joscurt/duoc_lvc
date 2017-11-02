<?php 
	$url_action 					= isset($url_action)? $url_action:'/Administradores/getTableGestionClases';
	$filtro_horario 				= isset($filtro_horario)? $filtro_horario:true;
	$filtro_tipo_evento 			= isset($filtro_tipo_evento)? $filtro_tipo_evento:true;
	$filtro_detalle 				= isset($filtro_detalle)? $filtro_detalle:true;
	$filtro_estado_programacion 	= isset($filtro_estado_programacion)? $filtro_estado_programacion:true;
	$filtro_sub_estado_programacion = isset($filtro_sub_estado_programacion)? $filtro_sub_estado_programacion:true;
	$periodo_required 				= isset($periodo_required)? $periodo_required : false;
	$sub_estado_required 			= isset($sub_estado_required)? $sub_estado_required : false;
	$filtro_modalidades 			= isset($filtro_modalidades)? $filtro_modalidades : false;
?>
<form id="form-filtro-multiple" action="<?php echo $this->Html->url(array('action'=>$url_action, TRUE)) ?>" method="POST">
	<input type="hidden" name="data[Filtro][tipo_fitrar]" value="multiple" />
	<input type="hidden" name="data[Filtro][filtro_multiple]" value="1" />
	<div class="row">
		<div class="col-md-4">
			<label for="">Fecha inicio:</label>
			<div class="input-group form-group">
				<span class="input-group-addon"><i class="md md-event"></i></span>
					<div class="dtp-container dropdown fg-line">
					<input type="text"
						class="form-control date-time-picker fecha-inicio" 
						value="<?php echo !empty($datos_filtro['Filtro']['fecha_inicio']) ? $datos_filtro['Filtro']['fecha_inicio'] : date('d-m-Y');?>" 
						name="data[Filtro][fecha_inicio]" 
						data-toggle="dropdown" 
						placeholder="DD-MM-YYYY" />
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<label for="">Fecha termino:</label>
			<div class="input-group form-group">
				<span class="input-group-addon"><i class="md md-event"></i></span>
					<div class="dtp-container dropdown fg-line">
					<input type='text' 
						class="form-control date-time-picker fecha-termino" 
						value="<?php echo !empty($datos_filtro['Filtro']['fecha_fin']) ? $datos_filtro['Filtro']['fecha_fin'] : date('d-m-Y');?>" 
						name="data[Filtro][fecha_fin]" 
						data-toggle="dropdown" 
						placeholder="DD-MM-YYYY" />
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="form-group">
				<a class="btn btn-default pull-right cambiar-filtro-simple" style="margin-top: 27px;">Filtro simple</a>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-3" style="border-right: 1px solid #ccc;">
			<div class="form-group">
				<label for="">Rut Docente:</label>
				<input id="rut"
					type="text"
					class="form-control autocompletable-input"
					data-field-au="Docente.RUT"
					name="data[Filtro][rut]" 
					placeholder="Debe esperar listado autocompletable"
					value="<?php echo !empty($datos_filtro['Filtro']['rut']) ? $datos_filtro['Filtro']['rut'] : '';?>" 
				/>
			</div>
			<div class="form-group">
				<label for="">Nombre Docente:</label>
				<input id="nombre_docente"
					type="text" 
					class="form-control autocompletable-input" 
					data-field-au="Docente.NOMBRE"
					value="<?php echo !empty($datos_filtro['Filtro']['nombre_docente']) ? $datos_filtro['Filtro']['nombre_docente'] : '';?>" 
					name="data[Filtro][nombre_docente]" 
					placeholder="Debe esperar listado autocompletable"
				/>
			</div>
			<div class="form-group">
				<label for="">ID Docente:</label>
				<input id="id_docente"
					type="text" 
					class="form-control autocompletable-input" 
					data-field-au="Docente.COD_FUNCIONARIO"
					value="<?php echo !empty($datos_filtro['Filtro']['id_docente']) ? $datos_filtro['Filtro']['id_docente'] : '';?>" 
					name="data[Filtro][id_docente]" 
					placeholder="Debe esperar listado autocompletable"
				/>
			</div>
			<input type="hidden" 
				name="data[Filtro][value_docente]" 
				id="hidden-docente-uuid-multiple"
				value="<?php echo !empty($datos_filtro['Filtro']['value_docente']) ? $datos_filtro['Filtro']['value_docente'] : '';?>"  
			/>
		</div>
		<div class="col-md-3" style="border-right: 1px solid #ccc;">
			<div class="row">
				<?php if ($filtro_horario): ?>
					<div class="col-md-6">
						<label for="select-hora-inicio">Hora inicio: </label>
						<div class="form-group">
	                        <select 
	                        	class="form-control selectpicker "
	                        	name="data[Filtro][hora_inicio]" 
	                        	data-live-search="true"
	                        	id="select-hora-inicio">
	                        	<option value=""></option>
	                        	<?php foreach ($horarios as $key => $value): ?>
	                        		<option 
	                        			<?php echo !empty($datos_filtro['Filtro']['hora_inicio']) && ($datos_filtro['Filtro']['hora_inicio'] == $value['hora_inicio'])? 'selected="selected"':''; ?>
	                        			value="<?php echo $value['hora_inicio']; ?>"
	                        			><?php echo $value['hora_inicio']; ?></option>
	                        	<?php endforeach ?>
	                        </select>
	                    </div>
					</div>
					<div class="col-md-6">
						<label for="select-hora-fin" >Hora termino: </label>
						<div class="form-group">
	                        <select 
	                        	class="form-control selectpicker "
	                        	data-live-search="true"
	                        	name="data[Filtro][hora_fin]" 
	                        	id="select-hora-fin">
	                        	<option value=""></option>
	                        	<?php foreach ($horarios as $key => $value): ?>
	                        		<option 
	                        			<?php echo !empty($datos_filtro['Filtro']['hora_fin']) && ($datos_filtro['Filtro']['hora_fin'] == $value['hora_fin'])? 'selected="selected"':''; ?>
	                        			value="<?php echo $value['hora_fin']; ?>"><?php echo $value['hora_fin']; ?></option>
	                        	<?php endforeach ?>
	                        </select>
	                    </div>
					</div>
				<?php endif; ?>
			</div>
			<div class="form-group">
				<label for="">Nombre asignatura:</label>
				<input type="text" 
					class="form-control autocompletable-input"  
					value="<?php echo !empty($datos_filtro['Filtro']['nombre_asignatura']) ? $datos_filtro['Filtro']['nombre_asignatura'] : '';?>" 
					name="data[Filtro][nombre_asignatura]" 
					placeholder="Debe esperar listado autocompletable"
					data-field-au="Asignatura.NOMBRE"
				/>
			</div>
			<div class="form-group">
				<label for="">Sigla-Secci&oacute;n:</label>
				<input type="text" 
					class="form-control autocompletable-input"  
					value="<?php echo !empty($datos_filtro['Filtro']['sigla_seccion']) ? $datos_filtro['Filtro']['sigla_seccion'] : '';?>" 
					name="data[Filtro][sigla_seccion]" 
					placeholder="Debe esperar listado autocompletable"
					data-field-au="ProgramacionClase.SIGLA_SECCION"
				/>
			</div>
		</div>
		<div class="col-md-3" style="border-right: 1px solid #ccc;">
			<div class="form-group">
				<label for="">Periodo:</label>
				<select id="form-filtro-periodo-multiple" name="data[Filtro][periodo]" class="form-control selectpicker" data-live-search="true">
					<option value="">Seleccionar...</option>
					<?php foreach ($periodos as $key => $periodo): ?>
						<option 
							<?php echo !empty($datos_filtro['Filtro']['periodo']) && ($datos_filtro['Filtro']['periodo'] == $periodo['Periodo']['COD_PERIODO'])? 'selected="selected"':''; ?>
							value="<?php echo $periodo['Periodo']['COD_PERIODO'] ?>"><?php echo $periodo['Periodo']['ANHO'].'-'.$periodo['Periodo']['SEMESTRE'] ?></option>	
					<?php endforeach ?>
				</select>
			</div>
			<div class="form-group">
				<label for="">Jornada:</label>
				<select name="data[Filtro][jornada]" id="" class="form-control selectpicker" data-live-search="false">
					<option value="">Seleccionar...</option>
					<option <?php echo !empty($datos_filtro['Filtro']['jornada']) && ($datos_filtro['Filtro']['jornada'] == 'D')? 'selected="selected"':''; ?> value="D">DIURNO</option>
					<option <?php echo !empty($datos_filtro['Filtro']['jornada']) && ($datos_filtro['Filtro']['jornada'] == 'V')? 'selected="selected"':''; ?> value="V">VESPERTINO</option>
				</select>
			</div>
			<?php if ($filtro_tipo_evento): ?>
				<div class="form-group">
					<label for="">Tipo Evento:</label>
					<select name="data[Filtro][tipo_evento]" class="form-control selectpicker" data-live-search="false">
						<option value="">Seleccionar...</option>
						<option <?php echo !empty($datos_filtro['Filtro']['tipo_evento']) && ($datos_filtro['Filtro']['tipo_evento'] == 'REGULAR')? 'selected="selected"':''; ?> value="REGULAR">REGULAR</option>
						<option <?php echo !empty($datos_filtro['Filtro']['tipo_evento']) && ($datos_filtro['Filtro']['tipo_evento'] == 'NO REGULAR')? 'selected="selected"':''; ?> value="NO REGULAR">NO REGULAR</option>
					</select>
				</div>
			<?php endif; ?>
		</div>
		<div class="col-md-3">
			<?php if ($filtro_detalle): ?>
				<div class="form-group">
					<label for="">Detalle:</label>
					<select name="data[Filtro][detalle]" id="" class="form-control selectpicker" data-live-search="false">
						<option value="">Seleccionar...</option>
						<?php foreach ($detalles as $key => $detalle): ?>
							<option
								<?php echo !empty($datos_filtro['Filtro']['detalle']) && ($datos_filtro['Filtro']['detalle'] == $detalle['Detalle']['ID'])? 'selected="selected"':''; ?>
								value="<?php echo $detalle['Detalle']['ID'] ?>"><?php echo $detalle['Detalle']['DETALLE'] ?></option>	
						<?php endforeach ?>
					</select>
				</div>
			<?php endif;  ?>
			<?php if ($filtro_estado_programacion): ?>
				<div class="form-group">
					<label for="">Estado:</label>
					<select name="data[Filtro][estado]" id="" class="form-control selectpicker" data-live-search="false">
						<option value="">Seleccionar...</option>
						<?php foreach ($estados as $key => $estado): ?>
							<option 
								<?php echo !empty($datos_filtro['Filtro']['estado']) && ($datos_filtro['Filtro']['estado'] == $estado['Estado']['ID'])? 'selected="selected"':''; ?>
								value="<?php echo $estado['Estado']['ID'] ?>"><?php echo $estado['Estado']['NOMBRE'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			<?php endif ?>
			<?php if ($filtro_sub_estado_programacion): ?>
				<div class="form-group">
					<label for="">Sub-Estado:</label>
					<select name="data[Filtro][sub_estado]" id="form-field-select-sub-estado-multiple" class="form-control selectpicker" data-live-search="false">
						<option value="">Seleccionar...</option>
						<?php foreach ($sub_estados as $key => $sub_estado): ?>
							<option 
								<?php echo !empty($datos_filtro['Filtro']['sub_estado']) && ($datos_filtro['Filtro']['sub_estado'] == $sub_estado['SubEstado']['ID'])? 'selected="selected"':''; ?>
								value="<?php echo $sub_estado['SubEstado']['ID'] ?>"><?php echo $sub_estado['SubEstado']['NOMBRE'] ?></option>
						<?php endforeach ?>
					</select>
				</div>
			<?php endif; ?>
			<?php if ($filtro_modalidades): ?>
				<div class="form-group">
					<label for="">Modalidad:</label>
					<select name="data[Filtro][modalidad]" id="form-field-select-modalidad-multiple" class="form-control selectpicker" data-live-search="false">
						<option value="">Seleccionar...</option>
							<option 
								<?php echo !empty($datos_filtro['Filtro']['modalidad']) && ($datos_filtro['Filtro']['modalidad'] == 'TEORICO')? 'selected="selected"':''; ?>
								value="TEORICO">PRACTICA</option>
							<option 
								<?php echo !empty($datos_filtro['Filtro']['modalidad']) && ($datos_filtro['Filtro']['modalidad'] == 'PRA')? 'selected="selected"':''; ?>
								value="PRA">TE&Oacute;RICA</option>
							<option 
								<?php echo !empty($datos_filtro['Filtro']['modalidad']) && ($datos_filtro['Filtro']['modalidad'] == 'TEO-PRA')? 'selected="selected"':''; ?>
								value="TEO-PRA">TE&Oacute;RICA + PRACTICA</option>
					</select>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<button type="submit" class="btn btn-success btn_buscar">buscar</button>
			</div>
		</div>
	</div>
</form>
<script>
	$('.autocompletable-input').each(function(index, el) {
		var variable_filtro = $(this).attr('data-field-au');
		var filtros_docente = Array('Docente.RUT','Docente.NOMBRE','Docente.COD_DOCENTE');
		$(this).autocomplete({
			source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/"+variable_filtro,
			minLength: 1,
			select: function( event, ui ) {
				if (filtros_docente.indexOf(variable_filtro) > -1) {
					$('#hidden-docente-uuid-multiple').val(ui.item.uuid);
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

	$('#form-filtro-multiple .btn_buscar').on('click', function(event) {
		//event.preventDefault();
		var fecha_inicio = $('#form-filtro-multiple .fecha-inicio').val();
		var fecha_termino = $('#form-filtro-multiple .fecha-termino').val();
		
		if(!fechaCorrecta(fecha_inicio,fecha_termino)){
			notifyUser('La fecha de t&eacute;rmino no puede ser menor a la fecha de inicio.','danger');
			return false;	
		}
		
		<?php if($periodo_required): ?>
			var periodo = $('#form-filtro-periodo-multiple').val();
			if(periodo == ''){
				notifyUser('Debe seleccionar un periodo.','danger');
				return false;	
			}
		<?php endif; ?>
		<?php if($sub_estado_required): ?>
			var sub_estado = $('#form-field-select-sub-estado-multiple').val();
			if(sub_estado == ''){
				notifyUser('Debe seleccionar un sub estado.','danger');
				return false;	
			}
		<?php endif; ?>
	});
</script>