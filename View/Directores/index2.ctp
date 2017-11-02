<style>
    .ui-autocomplete {
        max-height: 140px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
        z-index: 1200;
    }
    * html .ui-autocomplete {
        height: 100px;
    }
</style>
<?php 
	$filtros_posibles = array(
		'Docente.RUT'=>'Rut docente',
		'Docente.NOMBRE'=>'Nombre docente',
		'Docente.COD_FUNCIONARIO'=>'ID docente',
		'Asignatura.NOMBRE'=>'Nombre asignatura',
		'ProgramacionClase.SIGLA_SECCION'=>'Sigla - Secci&oacute;n',
		'ProgramacionClase.PERIODO'=>'Periodo',
		'ProgramacionClase.COD_JORNADA'=>'Jornada',
		'ProgramacionClase.detalle'=>'Detalle',
		'ProgramacionClase.sub_estado'=>'Sub-Estado',
	);
	$display_card_multiple = isset($filtro_multiple) && $filtro_multiple == 1 ? '':'display:none;';
	$display_card_simple = empty($display_card_multiple)? 'display:none;':'';
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Autorizaci&oacute;n de Clases</h1>
		</div>  
	</div>
</div>
<div id="filtro_simple" class="card" style="<?php echo $display_card_simple; ?>">
	<div class="card-body card-padding">
		<div class="row">
			<?php 
				echo $this->element('filtros_simples',array(
					'filtros_posibles'=>$filtros_posibles,
					'url_action'=>'index',
					'datos_filtro'=>$datos_filtro,
				)); 
			?>
			<div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-default cambiar-filtro-multiple" style="margin-top: 27px;">Filtro m&uacute;ltiple</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="filtro_multiple" class="card" style="<?php echo $display_card_multiple; ?>">
	<div class="card-body card-padding">
		<?php 
			echo $this->element('filtros_multiples',array(
				'url_action'=>'index',
				'datos_filtro'=>$datos_filtro,
				'filtro_tipo_evento'=>false,
				'sub_estado_required'=>true,
				'periodo_required'=>true,
				'filtro_estado_programacion'=>false,
			)); 
		?>
	</div>
</div>
<?php if (empty($datos_tabla)): ?>
	<div class="card">
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-12">
					<label for="">*No se han encontrado registros.</label>
				</div>
			</div>
		</div>
	</div>
<?php else: ?>
	<form action="<?php echo $this->Html->url(array('action'=>'autorizacionClaseExcel')) ?>" method='POST' id="form-autorizacionClase">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-12">
						<div class="pull-right">
						<label for="" class="">Ordenar por:</label>
							<select name="data[Filter][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
								<option value="" >Seleccionar</option>
								<option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut docente</option>
								<option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno docente</option>
								<option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno docente</option>
								<option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre docente</option>
								<option value="Docente.COD_DOCENTE" <?php echo $ordenar == 'Docente.COD_DOCENTE' ? 'selected="selected"':''; ?>>ID docente</option>
								<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
								<option value="ProgramacionClase.SIGLA_SECCION" <?php echo $ordenar == 'ProgramacionClase.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Secci&oacute;n</option>
								<option value="ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE"<?php echo $ordenar == 'ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE' ? 'selected="selected"':''; ?> >Periodo</option>
								<option value="ProgramacionClase.HORA_INICIO" <?php echo $ordenar == 'ProgramacionClase.HORA_INICIO' ? 'selected="selected"':''; ?>>Horario</option>
								<option value="ProgramacionClase.TIPO_EVENTO" <?php echo $ordenar == 'ProgramacionClase.TIPO_EVENTO' ? 'selected="selected"':''; ?>>Tipo</option>
								<option value="Detalle.DETALLE" <?php echo $ordenar == 'Detalle.DETALLE' ? 'selected="selected"':''; ?>>Detalle</option>
								<option value="Estado.NOMBRE" <?php echo $ordenar == 'Estado.NOMBRE' ? 'selected="selected"':''; ?>>Estado</option>
								<option value="SubEstado.NOMBRE" <?php echo $ordenar == 'SubEstado.NOMBRE' ? 'selected="selected"':''; ?>>Sub-Estado</option>
							</select>
						</div>
					</div>  
				</div>
			</div>
			<div class="card-body card-padding">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
							<thead>
								<tr>
									<th>
										<div class="checkbox m-b-15">
											<label>
												<input id="check-all" type="checkbox" value="">
												<i class="input-helper"></i>
											</label>
										</div>
									</th>
									<th class="una-linea">Fecha</th>
									<th>Nombre Asignatura</th>
									<th class="una-linea">Sigla-Secci&oacute;n</th>
									<th>Jornada</th>
									<th>Modalidad</th>
									<th class="una-linea">Rut docente</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Nombres</th>
									<th>Sala</th>
									<th>Horario</th>
									<th>Detalle</th>
									<th>Sub-Estado</th>
									<th>Editar</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 0; foreach ($datos_tabla as $key => $dato): $count++; ?>
									<tr class="odd" <?php echo isset($dato['ProgramacionClase']['TOPE_HORARIO']) ? 'style="background-color: #b7b7b7 !important; "' : ''; ?>>
										<td>
											<div class="checkbox m-b-15">
												<label>
													<input class="check-clase" name="data[Autorizacion][<?php echo $count ?>][cod_asigntura_seleccionada]" type="checkbox" value="<?php echo $dato['ProgramacionClase']['COD_PROGRAMACION']; ?>">
													<i class="input-helper"></i>
												</label>
											</div>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][fechaClase]" 
												value="<?php echo isset($dato['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y', strtotime($dato['ProgramacionClase']['FECHA_CLASE'])): '';?>">		
											</input>
											<?php 
												echo isset($dato['ProgramacionClase']['FECHA_CLASE'])
												? date('d-m-Y', strtotime($dato['ProgramacionClase']['FECHA_CLASE'])): '';
											?>		
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][nombreAsignatura]" 
												value="<?php echo isset($dato['Asignatura']['NOMBRE']) ? $dato['Asignatura']['NOMBRE'] : '';?>">		
											</input>
											<?php 
												echo isset($dato['Asignatura']['NOMBRE']) 
												? $dato['Asignatura']['NOMBRE']: ''; 
											?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][siglaSeccion]" 
												value="<?php echo isset($dato['ProgramacionClase']['SIGLA_SECCION']) ? $dato['ProgramacionClase']['SIGLA_SECCION'] : '';?>">		
											</input>
											<?php 
												echo isset($dato['ProgramacionClase']['SIGLA_SECCION']) 
												? $dato['ProgramacionClase']['SIGLA_SECCION']: ''; 
											?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][jornada]" 
												value="<?php echo isset($dato['ProgramacionClase']['COD_JORNADA']) && $dato['ProgramacionClase']['COD_JORNADA'] == 'D' ? 'Diurno' : 'Vespertino';?>">		
											</input>
											<?php echo $dato['ProgramacionClase']['COD_JORNADA'] == 'D' ? 'Diurno' : 'Vespertino'; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][modalidad]" 
												value="<?php echo isset($dato['AsignaturaHorario']['TEO_PRA']) ? ($dato['AsignaturaHorario']['TEO_PRA']) : '';?>">		
											</input>
											<?php echo isset($dato['AsignaturaHorario']['TEO_PRA']) ? $dato['AsignaturaHorario']['TEO_PRA']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][rutDocente]" 
												value="<?php echo isset($dato['Docente']['RUT']) ? $dato['Docente']['RUT'].'-'.$dato['Docente']['DV'] : '';?>">		
											</input>
											<?php echo isset($dato['Docente']['RUT']) ? $dato['Docente']['RUT'].'-'.$dato['Docente']['DV']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][apellidoPat]" 
												value="<?php echo isset($dato['Docente']['APELLIDO_PAT']) ? $dato['Docente']['APELLIDO_PAT'] : '';?>">		
											</input>
											<?php echo isset($dato['Docente']['APELLIDO_PAT']) ? $dato['Docente']['APELLIDO_PAT']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][apellidoMat]" 
												value="<?php echo isset($dato['Docente']['APELLIDO_MAT']) ? $dato['Docente']['APELLIDO_MAT'] : '';?>">		
											</input>	
											<?php echo isset($dato['Docente']['APELLIDO_MAT']) ? $dato['Docente']['APELLIDO_MAT']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][nombreDocente]" 
												value="<?php echo isset($dato['Docente']['NOMBRE']) ? $dato['Docente']['NOMBRE'] : '';?>">		
											</input>
											<?php echo isset($dato['Docente']['NOMBRE']) ? $dato['Docente']['NOMBRE']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][sala]" 
												value="<?php echo isset($dato['ProgramacionClase']['SALA']) ? $dato['ProgramacionClase']['SALA'] : '';?>">		
											</input>
											<?php echo !empty($dato['Sala']['TIPO_SALA']) ? $dato['Sala']['TIPO_SALA']:$dato['SalaReemplazo']['TIPO_SALA']; ?></td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][horaInicio]" 
												value="<?php echo isset($dato['ProgramacionClase']['HORA_INICIO']) ? date('H:i',strtotime($dato['ProgramacionClase']['HORA_INICIO'])) : '';?>">		
											</input>
											<?php 
												echo isset($dato['ProgramacionClase']['HORA_INICIO']) 
												? date('H:i',strtotime($dato['ProgramacionClase']['HORA_INICIO'])): ''; 
											?>
											-
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][horaFin]" 
												value="<?php echo isset($dato['ProgramacionClase']['HORA_FIN']) ? date('H:i',strtotime($dato['ProgramacionClase']['HORA_FIN'])) : '';?>">		
											</input>
											<?php 
												echo isset($dato['ProgramacionClase']['HORA_FIN']) 
												? date('H:i', strtotime($dato['ProgramacionClase']['HORA_FIN'])): ''; 
											?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][detalle]" 
												value="<?php echo isset($dato['Detalle']['DETALLE']) ? $dato['Detalle']['DETALLE'] : '';?>">		
											</input>
											<?php echo isset($dato['Detalle']['DETALLE']) ? $dato['Detalle']['DETALLE']: ''; ?>
										</td>
										<td>
											<input 
												type="hidden" 
												name="data[Excel][<?php echo $count ?>][subEstado]" 
												value="<?php echo isset($dato['SubEstado']['NOMBRE']) ? $dato['SubEstado']['NOMBRE'] : '';?>">		
											</input>		
											<?php echo isset($dato['SubEstado']['NOMBRE']) ? $dato['SubEstado']['NOMBRE']: ''; ?>
										</td>
										<td>
											<a 
												class="btn btn-info btn-sm" 
												href="<?php echo $this->Html->url(array('action'=>'autorizacionFichaDetalle', $dato['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
												data-toggle="tooltip"
												title="Editar">
												<i class="fa fa-pencil-square-o" aria-hidden="true"></i>
											</a>
										</td>
									</tr>
								<?php endforeach ?> 
							</tbody>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<?php $tope_horario = false; ?>
						<?php foreach ($datos_tabla as $key => $value): ?>
							<?php if (isset($value['ProgramacionClase']['TOPE_HORARIO']) == 'true' && !$tope_horario): ?>
								<?php $tope_horario = true; ?>
							<?php endif ?>
						<?php endforeach ?>
						<?php if ($tope_horario): ?>
							<a class="btn btn-success " validate-select="true" data-toggle="modal" data-target="#autorizar_clase">Autorizar Clase</a> 
						<?php else: ?>
							<a class="btn btn-success autorizar-clase" validate-select="true" data-toggle="modal" data-target="#">Autorizar Clase</a>
						<?php endif ?>
						<button type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
					</div>
				</div>
			</div>
		</div>
	</form>
<?php endif ?>
<div class="modal" id="autorizar_clase" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<h2 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Autorizaci&oacute;n de Clases</h2>
			</div>
			<div class="modal-body">
				<p>Algunas clases persentan tope de horario.</p>
				<p>Deber&aacute; des-seleccionar las clases que presentan problemas con el fin de que &eacute;stas se mantengan en la grilla para su posterior gesti&oacute;n individual.</p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-success pull-left" data-dismiss="modal">OK</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('#select-order').on('change', function(event) {
        event.preventDefault();
        var filtro_multiple = <?php echo (int)$filtro_multiple; ?>;
        if (filtro_multiple == 1) {
            $('#form-filtro-multiple').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-multiple').submit();
        }else{
            $('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-basico').submit();
        }
    });
	$('.autorizar-clase').click(function(event) {
		if ($('input.check-clase[type="checkbox"]:checked').length === 0) {
			event.preventDefault();
			notifyUser('Debe seleccionar almenos un evento.', 'danger');
		}else{
			var input_filtros = $('#form-filtro-basico').find('[name*=data]');
			$('#form-autorizacionClase').attr('action', "<?php echo $this->Html->url(array('action'=>'autorizacionClase')) ?>");
			$('#form-autorizacionClase').append('<label style="display:none;" id="label-filtros"></label>');
			$('#form-autorizacionClase #label-filtros').append(input_filtros);
			$('#form-autorizacionClase').submit();
		}
	});
	$('#check-all').on('click',function() {
        if ($(this).is(':checked')) {
            $('.check-clase').prop('checked', true);
        } else {
            $('.check-clase').prop('checked', false);
        }
    });
	$('#ordenar_por').keypress(function(event) {
		var value = $('#ordenar_por').val();
	});
	$("#buscar-tipo").trigger('keypress');
	
	//filtro multiple*
	$(".buscar-tipo").keypress(function(event) {
		var url='';
		var tipo_filtro = $(this).attr('tipo_filtro');
		$(".buscar-tipo").autocomplete({
			source: "<?php echo $this->Html->url(array('action'=>'autocompletarDatos')) ?>/"+tipo_filtro,
			minLength: 1,
			select: function( event, ui ) {
				$('#hidden-uuid').val(ui.item.uuid);
				$('#usuario').val(ui.item.nombre_usuario!= '' ? ui.item.nombre_usuario:'');
			},
		});
	});
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
	$('.time-picker').datetimepicker({
		format: 'LT'
	});
	$('.cambiar-filtro-multiple').on("click", function () {
		$('#filtro_multiple').show();
		$('#filtro_simple').hide();
	});
	$('.cambiar-filtro-simple').on("click", function () {
		$('#filtro_multiple').hide();
		$('#filtro_simple').show();
	});
</script>