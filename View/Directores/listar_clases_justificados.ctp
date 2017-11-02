<!-- INDEX DIRECTOR -->
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
		'ProgramacionClase.COD_JORNADA'=>'Jornada',
		'ProgramacionClase.detalle'=>'Detalle',
		'ProgramacionClase.ESTADO_PROGRAMACION_ID' => 'Estado',
		#'ProgramacionClase.estado'=>'Estado',
		'ProgramacionClase.sub_estado'=>'Sub-Estado',
	);
	$display_card_multiple = isset($filtro_multiple) && $filtro_multiple == 1 ? '':'display:none;';
	$display_card_simple = empty($display_card_multiple)? 'display:none;':'';
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Autorizaci&oacute;n de Justificados</h1>
		</div>  
	</div>
</div>
<div id="filtro_simple" class="card" style="<?php echo $display_card_simple; ?>">
	<div class="card-body card-padding">
		<div class="row">
			<?php 
				echo $this->element('filtros_simples',array(
					'filtros_posibles'=>$filtros_posibles,
					'url_action'=>'listar_clases_justificados',
					'datos_filtro'=>$datos_filtro,
				)); 
			?>
			<!-- <div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-default cambiar-filtro-multiple" style="margin-top: 27px;">Filtro m&uacute;ltiple</button>
				</div>
			</div> -->
		</div>
	</div>
</div>
<div id="filtro_multiple" class="card" style="<?php echo $display_card_multiple; ?>">
	<div class="card-body card-padding">
		<?php 
			echo $this->element('filtros_multiples',array(
				'url_action'=>'listar_clases_justificados',
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
	<form action="<?php echo $this->Html->url(array('action'=>'listar_clases_justificados')) ?>" method='POST' id="form-autorizacionClase">
		<div class="card">
		
			<div class="card-body card-padding" style="padding-top: 18px;">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
							<thead>
								<tr>
									<th>
										
									</th>
									<th style="width: 9%;">Fecha</th>
									<th>Nombre Asignatura</th>
									<th class="una-linea">Sigla-Secci&oacute;n</th>
									<th>Jornada</th>
								
									<th style="width: 10%;">Rut docente</th>
									<th>Apellido Paterno</th>
									<th>Apellido Materno</th>
									<th>Nombres</th>
									<th>Horario</th>
									<th>Estado</th>
									<th style="text-align: center;">Ver</th>
								</tr>
							</thead>
							<tbody>
								<?php $count = 0; foreach ($datos_tabla as $key => $dato): $count++; ?>
									<tr class="odd" <?php echo isset($dato['ProgramacionClase']['TOPE_HORARIO']) ? 'style="background-color: #b7b7b7 !important; "' : ''; ?>>
										<td>
											<?php echo $count; ?>
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
												#echo($dato['ProgramacionClase']['ID']);
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
												name="data[Excel][<?php echo $count ?>][Estado]" 
												value="<?php echo isset($dato['Estado']['NOMBRE']) ? $dato['Estado']['NOMBRE'] : '';?>">		
											</input>
											<?php echo isset($dato['Estado']['NOMBRE']) ? $dato['Estado']['NOMBRE']: ''; ?>
										</td>
									
										<td>
											<a 
												class="btn btn-info btn-sm" 
												href="<?php echo $this->Html->url(array('action'=>'fichaDetalleClaseJustificado', $dato['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
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
			
			</div>
		</div>
	</form>
<?php endif ?>

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
			$('#form-autorizacionClase').attr('action', "<?php echo $this->Html->url(array('action'=>'listar_clases_justificados')) ?>");
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