<style type="text/css">
	td{
		vertical-align: middle !important;
	}
	#table_horario_docente th{
		text-align: center;
		border:1px solid #ddd !important;
	}
	#table_horario_docente td{
		border:1px solid #ddd !important;
	}
	#table_horario_docente .td-valor,#table_horario_docente .th-dias{
		width: 100px;
	}
	#table_horario_docente .td-valor:last-child{
		padding: 0;
	}
	#table_horario_docente .td-valor{
		text-align: center;
	}
	#table_horario_docente .td-titulo,#table_horario_docente .th-titulo{
		width: 80px !important;
		padding-left:5px !important; 
	}
	#table_horario_docente .td-titulo{
		text-align: center;
	}
	table .td-sede{
		text-align: left !important;
		width: 20% !important;
	}
	table .td-asignatura{
		text-align: left !important;
		width: 40% !important;
	}
	table .td-tipo-clase{
		text-align: center !important;
	}
	table .td-sigla-seccion{
		text-align: center !important;
	}
	table .td-jornada{
		text-align: center !important;
	}
	table .td-nro-clases{
		text-align: center !important;
	}
	table .td-asistencia{
		text-align: center !important;
	}
	table .td-ultimo-registro{
		text-align: center !important;
		width: 14% !important;
	}
	#cargando-horario-docente{
		display: none;
		text-align: center;
	    font-size: 4em;
	    height: 250px;
	    padding-top: 100px;
	}
	.chosen-container.chosen-container-multi{
		margin-top: 2px;
	}
</style>
<br>
<div class="card">
	<div class="card-header">
		<h2>Programaci&oacute;n de Clases</h2>
		<br><br>
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="select-filtro-periodo">Seleccione Periodo</label><br>
					<select id="select-filtro-periodo" class="selectpicker">
						<option value="">Seleccione periodo</option>
						<?php foreach ($periodos as $key => $value): ?>
							<option value="<?php echo $value['Periodo']['COD_PERIODO'] ?>" <?php echo $periodo == $value['Periodo']['COD_PERIODO'] ? 'selected="selected"' : null; ?>>
								PERIODO-<?php echo $value['Periodo']['ANHO'].'/'.$value['Periodo']['SEMESTRE']; ?>
							</option>
						<?php endforeach ?>
					</select>
				</div>
			</div>


			<?php if (!empty($periodo_bd) && !empty($horarios)): ?>
				<form id="form-filter-horario">
					<div class="col-md-2 col-md-offset-2">
						<label for="select-filtro-sede">Descargar Horario - Sedes</label><br>
						<select id="select-filtro-sede"
							class="form-control selectpicker"
							name="data[Filtro][SEDE]"
							noSelectedText="Seleccione una sede">
							<?php foreach ($sedes as $key => $value): ?>
								<option value="<?php echo $value['Sede']['COD_SEDE']; ?>" selected><?php echo $value['Sede']['NOMBRE']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="select-filtro-semana">&nbsp;Semanas</label><br>
						<select id="select-filtro-semana"
							class="form-control tag-select" 
							name="data[Filtro][SEMANAS][]"
							multiple="multiple" 
							data-placeholder="Seleccione una o mas alternativas">
							<option value="ALL">TODAS</option>
							<?php foreach ($semanas as $key => $value): ?>
								<option 
									value="<?php echo $value['Semana']['ID']; ?>">
									SEMANA <?php echo $value['Semana']['NUMERO_SEMANA'].' / '.date('d-m-Y',strtotime($value['Semana']['FECHA_INICIO'])).' - '.date('d-m-Y',strtotime($value['Semana']['FECHA_FIN'])); ?>	
								</option>
							<?php endforeach ?>
						</select>
					</div>
				</form>
				<div class="col-md-2 botonera-horarios" align="right">
					<a href="#horario_docente" 
						data-target="#horario_docente" 
						
						id="btn-exportar-horario-docente"
						class="btn btn-success btn-sm btn-block"><i class="fa fa-download"></i>&nbsp;Descargar Horario
					</a>
					<a style="margin-top: 3px;" href="#horario_docente" 
						data-target="#horario_docente" 
						data-toggle="modal"
						id="btn-ver-horario-docente"
						class="btn btn-default btn-sm btn-block"><i class="fa fa-search"></i>&nbsp;&nbsp;Visualizar Horario
					</a>				
				</div>
			<?php endif ?>
		</div>	
	</div>
        <div class="card-body card-padding">
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<?php if (!empty($horarios)): ?>
				<table id ="table-docente" class="table table-striped table-hover table-docente" >
					<thead>
						<tr>
							<th style="width: 7%;" class="td-app">Sede</th>
							<th style="width: 5%;" class="td-app">Nombre Asignatura</th>
							<th style="width: 12%;" class="td-app">Sigla-Secci&oacute;n</th>
							<th style="width: 7%;" class="td-app">Jornada</th>
							<?php if (isset($funcionalidades[2])): ?>
								<th style="width: 7%;" class="td-app">Registrar Clase</th>
							<?php endif; ?>
							<?php if (isset($funcionalidades[4])): ?>
								<th style="width: 7%;" class="td-app">Hist&oacute;rico Asistencia</th>
							<?php endif; ?>
							<?php if (isset($funcionalidades[5])): ?>
								<th style="width: 7%;" class="td-app">Bit&aacute;cora Evento</th>
							<?php endif; ?>
							<th style="width: 7%;" class="td-app">N&deg; Clases Registradas</th>
							<th style="width: 7%;" class="td-app">Asistencia Promedio</th>
							<th style="width: 9%;padding: 14px;" class="td-app">&Uacute;ltimo Registro</th>
							<?php if (isset($funcionalidades[6])): ?>
								<th style="width: 3%;" class="td-app">Reprobaci&oacute;n por Inasistencia</th>
							<?php endif; ?>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($horarios as $key => $horario): ?>
							<tr>
								<td class="td-sede" >
								<!-- <?php echo isset($horario['Sede']['ID_TIPO_SEDE']) && $horario['Sede']['ID_TIPO_SEDE'] == '1' ? ' IP' : ' CFT';?> -  -->
									<?php echo $horario['Sede']['NOMBRE']; ?></td>
								<td class="td-asignatura"><?php echo $horario['Asignatura']['NOMBRE'].' - ('.$horario['AsignaturaHorario']['TEO_PRA'].')'; ?></td>
								<td class="td-sigla-seccion"><?php echo $horario['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
								<td class="td-jornada"><span class="badge"style=" background:#ABB7B7;"><?php echo $horario['AsignaturaHorario']['COD_JORNADA']; ?></span></td>
								<?php if (isset($funcionalidades[2])): ?>
									<td><a href="<?php echo $this->Html->Url(array('action'=>'registrarNuevaClase',$horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>" data-rel="tooltip" title="Registrar Nueva Clase" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a></td>
								<?php endif; ?>
								<?php if (isset($funcionalidades[4])): ?>
									<td><a href="<?php echo $this->Html->url(array('action'=>'historicoAsistencia',$horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" data-rel="tooltip" title="Hist&oacute;rico de Asistencia" class="btn btn-sm btn-default"><i class="md md-find-in-page"></i></a></td>
								<?php endif; ?>
								<?php if (isset($funcionalidades[5])): ?>
									<td><a href="<?php echo $this->Html->url(array('action'=>'bitacoraEvento',$horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>" data-rel="tooltip" title="Bit&aacute;cora Evento" class="btn btn-sm btn-default"><i class="md md-find-in-page"></i></a></td>
								<?php endif; ?>
								<td class="td-nro-clases"><?php echo $horario['AsignaturaHorario']['CLASES_REGISTRADAS']; ?></td>
								<td class="td-asistencia">
									<span style="color:red;">
										<?php echo (int)$horario['AsignaturaHorario']['ASIST_PROMEDIO']; ?>%
									</span>
								</td>
								<td class="td-ultimo-registro">
									<div style="width:60px;"><?php echo !empty($horario['AsignaturaHorario']['ULTIMO_REGISTRO'])?date('d-m-Y',strtotime($horario['AsignaturaHorario']['ULTIMO_REGISTRO'])):null; ?></div>
								</td>
								<?php if (isset($funcionalidades[6])): ?>
									<td align="center">
										<?php if ($horario['AsignaturaHorario']['RI_ENABLE']): ?>
											<a data-rel="tooltip" 
												title="Reprobar por Inasistencia" 
												href="<?php echo $this->Html->url(array('action'=>'reprobadoInacistencia',$horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" class="btn btn-danger btn-sm"><i class="fa fa-info-circle"></i></a>
										<?php else: ?>
											<a data-rel="tooltip" 
												title="Ver RI" 
												href="<?php echo $this->Html->url(array('action'=>'reprobadoInacistencia',$horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" class="btn btn-success btn-sm"><i class="fa fa-search"></i></a>
										<?php endif; ?>
									</td>
								<?php endif; ?>
							</tr>
						<?php endforeach; ?>			
					</tbody>
				</table>
			<?php else: ?>
				<?php if (!empty($periodo)): ?>
					<h4>* No tiene clases registradas para el periodo <?php echo $periodo_bd['Periodo']['SEMESTRE'].'-'.$periodo_bd['Periodo']['ANHO']; ?>.</h4>
				<?php else: ?>
					<h4>* Debe seleccionar un periodo  para listar sus clases.</h4>
				<?php endif ?>
			<?php endif ?>
		</div>
	</div>
</div>
<div class="modal fade" id="horario_docente" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<!-- Carga de contenido -->
		</div>
	</div>
</div>
<script>
	var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
	<?php if (!empty($periodo_bd)): ?>
		

		$('#btn-exportar-horario-docente').on('click', function(event) {
			event.preventDefault();
			var sede_id=$('#select-filtro-sede').val();
			if (sede_id=='') {
				notifyUser('Debe seleccionar una sede.','info');
				return false;
			}
			$('#form-filter-horario').attr("target","_blank");
			//$('#horario_docente .modal-content').empty().html("<div align='center'></div>");
			//$('#form-filter-horario').html(img_cargando);

			$('#form-filter-horario').attr('action','<?php echo $this->Html->url(array('action'=>'descargarHorario',$periodo_bd['Periodo']['COD_PERIODO'])); ?>/'+sede_id);
			$('#form-filter-horario').attr('method','POST');
			$('#form-filter-horario').submit();
		});


		$('#btn-ver-horario-docente').on('click', function(event) {
			event.preventDefault();
			if ( $('#select-filtro-sede').val()=='') {
				notifyUser('Debe seleccionar una sede.','info');
				return false;
			}
			if ( $('#select-filtro-semana').val()=='') {
				notifyUser('Debe seleccionar semana.','info');
				return false;
			}
			$('#horario_docente .modal-content').empty().html("<div align='center'></div>");
			$('#horario_docente .modal-content div').html(img_cargando);
			$.ajax({
				url: '<?php echo $this->Html->url(array( 'action'=>'verHorarioDocente', $periodo_bd['Periodo']['COD_PERIODO'] )); ?>/',
				type: 'POST',
				dataType: 'html',
				data:$('#form-filter-horario').serialize(),
			})
			.always(function(view) {
				var newView=view;
				$('#horario_docente .modal-content').html(newView);
			});
		});

		
	<?php endif; ?>


	$('#select-filtro-periodo').on('change', function(event) {
		event.preventDefault();
        $('#elementLoader').show();
        window.location = "<?php echo $this->Html->url(array('action'=>'getEventos')); ?>"+'/'+event.target.value;
	});
</script>
<script>

	$(document).ready(function () {
            $("#table-docente").freezeHeader();
        })
</script>