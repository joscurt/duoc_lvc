<?php
	$porcentaje_minimo_ri = 75;
?>
<style>
	.btn_exportar{
		padding: 1.5em;
		border:2px solid #ddd;
		border-radius: 5px;
		color:red;
		margin:10px;
	}
	.btn_exportar:hover {
		color: red;
	}
	tr{
		border:1px solid #ddd !important;
	}
	td{
		border:1px solid #ddd !important;
		padding: 10px;
	}
	.list{
		display: inline-block;
	}
	.rotar_fecha{
		font-size: 12px;
		-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
		-o-transform: rotate(-90.0deg);  /* Opera 10.5 */
		-webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
		filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
		-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; 
	}
	.td-app{
		font-weight: 500 !important;
	}
</style>
<br>
<div class="card">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-body">
		<div id="ver_curso" class="tab-pane" role="tabpanel">
			<div class="table-responsive">
				<table id="table-inasistencia" class="table table-striped table-bordered">
					<thead>
						<tr>
							<th class="td-app text-center" ><span title="Reprobado por Inasistencia">RI</span></th>
							<th class="td-app text-center">Rut Alumno</th>
							<th class="td-app text-left">Apellido Paterno</th>
							<th class="td-app text-left">Apellido Materno</th>
							<th class="td-app text-left">Nombres</th>
							<th class="td-app text-center">Clases Regulares Presente</th>
							<th class="td-app text-center">Clases Regulares Ausente</th>
							<th class="td-app text-center">Asistencia</th>
							<th class="td-app text-left">Comentarios al Director de Carrera (Opcional)</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							foreach ($alumnos as $key => $value): 
								$porcentaje = 0;
								if (isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])) {
									$porcentaje = $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS'];	
								}
								$color = ($porcentaje < $porcentaje_minimo_ri)?'red':'inherit';
								$checkbox = ($porcentaje < $porcentaje_minimo_ri)?'checked="checked"':null; 
								$observaciones = '';
								if (!empty($value['RI']['ID'])) {
									$checkbox = ((int)$value['RI']['R_I'] === 1)?'checked="checked"':null; 
									$observaciones = $value['RI']['OBSERVACIONES'];
								}
						?>
							<tr >
								<td class="text-center">
									<label class="checkbox checkbox-inline">
										<input disabled="disabled" <?php echo $checkbox; ?> type="checkbox"  ><i class="input-helper"></i>
									</label>
								</td>
								<td class="text-center"><?php echo strtoupper($value['Alumno']['RUT']); ?></td>
								<td class="text-left"><?php echo (strtoupper($value['Alumno']['APELLIDO_PAT'])); ?></td>
								<td class="text-left"><?php echo (strtoupper($value['Alumno']['APELLIDO_MAT'])); ?></td>
								<td class="text-left"><?php echo strtoupper($value['Alumno']['NOMBRES']); ?></td>
								<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?></td>
								<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
								<td class="text-center <?php echo $porcentaje < $porcentaje_minimo_ri  ? 'td-danger' : ''; ?>" >
									<?php 
											echo ($porcentaje > 100) ? '100%' : round($porcentaje,2).'%';
									?>
								</td>
								<td class="text-left">
									<div class="form-group" style="margin-bottom: 0;">
										<div class="fg-line">
											<input 
												disabled="disabled"
												class="form-control"
												maxlength="300"
												placeholder="M&aacute;x. 300 car&aacute;cteres"
												type="text"
												value="<?php echo $observaciones; ?>" />
										</div>
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12" align="center">
				<a href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])); ?>" class="btn btn-default waves-effect waves-float"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>
				<a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action'=>'reprobadoInasistenciaExcel',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>"><i  style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR A EXCEL</a>
				<a class="btn btn-sm btn-default" href="<?php echo $this->Html->url(array('action'=>'reprobadoInasistenciaPdf',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" target="_blank"><i  style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;EXPORTAR A PDF</a>
			</div>
		</div>
	</div>
</div>
<script>
	$('.auto-size').autosize();
	$(document).ready(function () {
            $("#table-inasistencia").freezeHeader();
        })
</script>