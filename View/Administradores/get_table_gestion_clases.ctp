<?php if (!empty($clases)): ?>
	<div class="card">
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-8">		
					<label for="" class="pull-right">Ordenar por:</label>
				</div>
				<div class="col-md-4">
					<form method="POST" action="" id="form-ordenar">
						<?php if(!empty($fecha_desde)): ?>
							<input type="hidden" value="<?php echo $fecha_desde; ?>" name="data[Filtro][fecha_inicio]" />
						<?php endif; ?>
						<?php if(!empty($fecha_hasta)): ?>
							<input type="hidden" value="<?php echo $fecha_hasta ?>" name="data[Filtro][fecha_fin]" />
						<?php endif; ?>
						<?php if(!empty($filtro)): ?>
							<input type="hidden" value="<?php echo $filtro; ?>" name="data[Filtro][filtro]" />
						<?php endif; ?>
						<?php if(!empty($valor_filtros)): ?>
							<input type="hidden" value="<?php echo $valor_filtros ?>" name="data[Filtro][value]" />
						<?php endif; ?>
						<div class="form-group">
							<select name="data[Filtro][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
								<option value="" >Seleccionar</option>
								<option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut docente</option>
								<option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno docente</option>
								<option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno docente</option>
								<option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre docente</option>
								<option value="Docente.COD_DOCENTE" <?php echo $ordenar == 'Docente.COD_DOCENTE' ? 'selected="selected"':''; ?>>ID docente</option>
								<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
								<option value="ProgramacionClase.SIGLA_SECCION" <?php echo $ordenar == 'ProgramacionClase.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Sección</option>
								<option value="ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE"<?php echo $ordenar == 'ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE' ? 'selected="selected"':''; ?> >Periodo</option>
								<option value="ProgramacionClase.COD_JORNADA" <?php echo $ordenar == 'ProgramacionClase.COD_JORNADA' ? 'selected="selected"':''; ?>>Jornada</option>
								<option value="ProgramacionClase.HORA_INICIO" <?php echo $ordenar == 'ProgramacionClase.HORA_INICIO' ? 'selected="selected"':''; ?>>Horario</option>
								<option value="ProgramacionClase.TIPO_EVENTO" <?php echo $ordenar == 'ProgramacionClase.TIPO_EVENTO' ? 'selected="selected"':''; ?>>Tipo</option>
								<option value="Detalle.DETALLE" <?php echo $ordenar == 'Detalle.DETALLE' ? 'selected="selected"':''; ?>>Detalle</option>
								<option value="Estado.NOMBRE" <?php echo $ordenar == 'Estado.NOMBRE' ? 'selected="selected"':''; ?>>Estado</option>
								<option value="SubEstado.NOMBRE" <?php echo $ordenar == 'SubEstado.NOMBRE' ? 'selected="selected"':''; ?>>Sub-Estado</option>
							</select>
						</div>
					</form>
				</div>
				<div class="col-md-12">
					<table class="table table-striped gestionClase">
						<thead style="background: #34495e !important;">
							<tr>
								<th>&nbsp;</th>
								<th>
									<div class="checkbox m-b-15">
									    <label>
									        <input type="checkbox" value="" id="checkbox-select-all">
									        <i class="input-helper"></i>
									    </label>
									</div>
								</th>
								<th>Fecha</th>
								<th>Nombre Asignatura</th>
								<th>Sigla-Sección</th>
								<th>Jornada</th>
								<th>Modalidad</th>
								<th>Rut docente</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombres</th>
								<th>Sala</th>
								<th>Horario</th>
								<th>Tipo</th>
								<th>Detalle</th>
								<th>Estado</th>
								<th>Sub-Estado</th>
								<th>Editar</th>
								<th>ID</th>
							</tr>
						</thead>
					  	<tbody>
						  	<?php 
						  		$contador_rows = 0;
						  		foreach ($clases as $clase): 
						  			$contador_rows++;
						  			?>
							  	<tr class="odd">
								    <td><?php echo $contador_rows; ?></td>
								    <td>
								    	<div class="checkbox m-b-15">
					                        <label>
					                            <input 
					                            	type="checkbox" 
					                            	class="checkbox-select-evento-unidad"
					                            	value="<?php echo $clase['ProgramacionClase']['COD_PROGRAMACION']; ?>">
					                            <i class="input-helper"></i>
					                        </label>
					                    </div>
				                    </td>
								    <td><?php echo date('d-m-Y',strtotime($clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
								    <td><?php echo $clase['Asignatura']['NOMBRE']; ?></td>
								    <td><?php echo $clase['ProgramacionClase']['SIGLA_SECCION']; ?></td>
								    <td><?php
										# Agregado por Luis Adan 25-07-2017 Diurno y vestpernino En referencia a DG001
								   	 	echo $clase['ProgramacionClase']['COD_JORNADA'] == 'D' ? 'Diurno' : 'Vespertino' ; 
                                   ?></td>
                                    <td><?php 
									# Agregado por Luis Adan 25-07-2017 se elimina  utf8_encode por acentuacion En referencia a DG001
									echo isset($clase['AsignaturaHorario']['TEO_PRA']) ? $clase['AsignaturaHorario']['TEO_PRA']: '';
									 ?></td>
								    <td><?php echo $clase['Docente']['RUT'].'-'.$clase['Docente']['DV']; ?></td>
								    <td><?php echo utf8_encode($clase['Docente']['APELLIDO_PAT']); ?></td>
								    <td><?php echo utf8_encode($clase['Docente']['APELLIDO_MAT']); ?></td>
								    <td><?php echo utf8_encode($clase['Docente']['NOMBRE']); ?></td>
								    <td>
								    	<?php 
								    		if (isset($salas_list[$clase['ProgramacionClase']['SALA']])) {
								    			echo $salas_list[$clase['ProgramacionClase']['SALA']];
								    		}else if(isset($salas_reemplazo_list[$clase['ProgramacionClase']['SALA']])){
								    			echo $salas_reemplazo_list[$clase['ProgramacionClase']['SALA']];
								    		}else if(isset($salas_list[$clase['ProgramacionClase']['SALA_REEMPLAZO']])){
								    			echo $salas_list[$clase['ProgramacionClase']['SALA_REEMPLAZO']];
								    		}else if(isset($salas_reemplazo_list[$clase['ProgramacionClase']['SALA_REEMPLAZO']])){
								    			echo $salas_reemplazo_list[$clase['ProgramacionClase']['SALA_REEMPLAZO']];
								    		}
								    	?>	
								    </td>
								    <td><?php echo date('H:i',strtotime($clase['ProgramacionClase']['HORA_INICIO'])).' '.date('H:i',strtotime($clase['ProgramacionClase']['HORA_FIN'])); ?></td>
								    <td><?php echo $clase['ProgramacionClase']['TIPO_EVENTO']; ?></td>
								    <td><?php echo $clase['Detalle']['DETALLE']; ?></td>
								    <td><?php echo $clase['Estado']['NOMBRE']; ?></td>
								    <td><?php echo $clase['SubEstado']['NOMBRE']; ?></td>
								    <td>
								    	<a
								    		class="btn btn-info btn-sm" 
								    		href="<?php echo $this->Html->url(array('action'=>'fichaDetalleClase',$clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
								    		title="Editar"
								    		><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
								    	</a>
								    </td>
								    <td><?php echo $clase['ProgramacionClase']['ID']; ?></td>
							  	</tr>
						  	<?php endforeach; ?>
					  	</tbody>
					</table>
					<div class="card-header">
						<a href="#suspension-masiva" data-toggle="modal" data-target="#suspension-masiva" class="btn btn-danger">Suspensión</a>
						
						<a href="<?php echo $this->Html->url(array('action'=>'excelGestionClases',$filtro,$tipo_fitrar,$fecha_desde,$fecha_hasta,$valor_filtros)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR EXCEL</a>

					
					</div>	
				</div>
			</div>
		</div>
	</div>
	<div class="modal " id="suspension-masiva" tabindex="-1" role="dialog" aria-hidden="false">
	    <div class="modal-dialog ">
	        <div class="modal-content">
	        	<div class="modal-header">
	        		<h4 style="border-bottom:1px solid #c4c4c4;">Suspensión
	        			<span class="close" data-dismiss="modal" style="font-size: 2em !important;margin-top: -18px;">&times;</span>
	        		</h4>
	        		<p>Se aplicará la suspensión a todas las clases seleccionadas <strong id="numero-check-list"></strong></p>
	        	</div>
	        	<div class="modal-body">
	        		<form 
	        			action="<?php echo $this->Html->url(array('action'=>'suspenderMasivo')); ?>" 
	        			id="formulario-suspender-masivo"
	        			method="POST">
		        		<div class="row">
		        			<div class="col-md-12">
		        				<div class="form-group">
		        					<label for="select-motivo-id-suspension">MOTIVO:</label>
		        					<select 
		        						name="data[ProgramacionClase][MOTIVO_ID]" 
		        						class="form-control selectpicker "
		        						required="required" 
		        						data-live-search="true" 
		        						id="select-motivo-id-suspension">
		        						<option value=""></option>
		        						<?php foreach ($motivos as $key => $value): ?>
		        							<option 
		        								value="<?php echo $value['MotivoSuspensionClase']['ID']; ?>"><?php echo $value['MotivoSuspensionClase']['MOTIVO']; ?></option>
		        						<?php endforeach; ?>
		        					</select>
		        				</div>
		        			</div>
		        			<div class="col-md-12">
		        				<div class="form-group">
		        					<label for="textarea-observaciones-suspension">OBSERVACIONES:</label>
		        					<textarea
		        						required="required"
		        						name="data[ProgramacionClase][OBSERVACIONES]" 
		        						class="form-control auto-size"
		        						id="form-textarea-observacion-justificacion"></textarea>
		        				</div>
		        			</div>
		        			<div class="col-md-12">
		        				<button
		        					type="submit" 
		        					class="btn bgm-red btn-sm">SUSPENDER</button>
		        				<button 
		        					type="button" 
		        					id="button-cerrar-modal-suspension"
		        					class="btn btn-default">SALIR</button>
		        			</div>
		        		</div>
	        		</form>
	        	</div>
	        </div>
	    </div>
	</div>
	<script>
		$('.selectpicker').selectpicker();
		$('#checkbox-select-all').on('change', function(event) {
			event.preventDefault();
			if ($(this).is(':checked')) {
				$('.checkbox-select-evento-unidad').prop('checked',true);
			}else{
				$('.checkbox-select-evento-unidad').prop('checked',false);
			}
		});
		$('#button-cerrar-modal-suspension').on('click', function(event) {
			event.preventDefault();
			swal({
				title: "<?php echo __('¿Esta seguro que desea Salir?'); ?>",   
	            text: "<?php echo __(''); ?>",
	            type: "warning",
	            showCancelButton: true, 
	            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "Sí, Estoy Seguro!",   
	            closeOnConfirm: true 
			},function(){
				$('#suspension-masiva').modal('hide');
			});
		});
		$('#select-order').on('change', function(event) {
			event.preventDefault();
			var form = $('#form-ordenar');
			/* Act on the event */
			var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
			$('#card-content-grilla').html('<div align="center"></div>');
			$('#card-content-grilla div').html(imagen_cargando);
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'getTableGestionClases')); ?>',
				type: 'POST',
				dataType: 'html',
				data: form.serialize(),
			})
			.fail(function() {
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
			})
			.always(function(view) {
				$('#card-content-grilla').html(view);
			});
		});
		$('a[href="#suspension-masiva"]').on('click', function(event) {
			$('.modal#suspension-masiva #numero-check-list').html('('+$('.checkbox-select-evento-unidad:checked').length+')');
			$('#formulario-suspender-masivo input[type="hidden"]').remove();
			$('.checkbox-select-evento-unidad:checked').each(function() {
				elemento = $(this);
				$('#formulario-suspender-masivo').append('<input type="hidden" name="data[ProgramacionClase][IDS][]" value="'+elemento.val()+'" />');
			});
		});
	</script>
<?php else: ?>
	<h4>* No hay registros para los filtros seleccionados.</h4>
<?php endif; ?>