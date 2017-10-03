<style>
	#card-ri table *{
		vertical-align: middle;
		font-size:13px;
	}
	#card-ri table .td-danger{
		background: #e9594a;
		color: #fff;
		font-weight: bold;
		padding-bottom: 0px;
	}
	table;
</style>
<?php 
	$porcentaje_minimo_ri = 75;
	$editable = false;
	if ($asignatura_horario['AsignaturaHorario']['RI_ENVIADO_A_SAP'] == 0) {
		$editable = true;
	}
?>
<div class="row">
    <div class="col-md-12">
        <div class="block-header">
            <h1>Reprobados por inasistencia</h1>
        </div>  
    </div>
</div>
<div class="card" id="card-ri">
	<div class="card-body card-padding">
		<?php if ($editable): ?>
			<form action="<?php echo $this->Html->url(array('action'=>'sendRiSap',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" method="POST">
		<?php endif ?>
			<div class="row">
				<div class="col-md-12">
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Docente:</h2>
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>Rut</th>
								<th>Nombre Docente</th>
								<th>ID Docente</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><?php echo $asignatura_horario['Docente']['RUT'].'-'.$asignatura_horario['Docente']['DV']; ?></td>
								<td><?php echo $asignatura_horario['Docente']['NOMBRE']. ' '.$asignatura_horario['Docente']['APELLIDO_PAT'].' '.$asignatura_horario['Docente']['APELLIDO_MAT']; ?></td>
								<td><?php echo $asignatura_horario['Docente']['COD_DOCENTE']; ?></td>
							</tr>	
						</tbody>
					</table>
					<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th>Nombre asignatura</th>
								<th>Sigla-Secci&oacute;n</th>
								<th>Periodo</th>
								<th>Jornada</th>
								<th>Tipo de clase</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td><?php echo $asignatura_horario['Asignatura']['NOMBRE']; ?></td>
								<td><?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
								<td><?php echo $asignatura_horario['Periodo']['SEMESTRE'].'-'.$asignatura_horario['Periodo']['ANHO']; ?></td>
								<td><?php echo $asignatura_horario['AsignaturaHorario']['COD_JORNADA']; ?></td>
								<td><?php echo $asignatura_horario['AsignaturaHorario']['TEO_PRA']; ?></td>
							</tr>	
						</tbody>
					</table>
					<br />
					<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
						<thead>
							<tr>
								<th style="text-align: center;">Clases Regulares Registradas</th>
								<th style="text-align: center;">Clases Regulares </th>
								<th style="text-align: center;">Clases Regulares Suspendidas</th>
								<th style="text-align: center;">Cantidad de 	Alumnos RI</th>
								<th style="text-align: center;">Asistencia Promedio</th>
							</tr>
						</thead>
						<tbody>
							<tr class="odd">
								<td style="text-align: center;"><?php 
								echo (int)$asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS']; ?></td>
								<td style="text-align: center;"><?php echo $clases_regulares; ?></td>
								<td style="text-align: center;"><?php echo $clases_suspendidas; ?></td>
								<td style="font-size: 12px;text-align: center;">
									<?php 
									$i = 0;
										foreach ($alumnos as $key => $value) {
											
											if ($asignatura_horario['AsignaturaHorario']['RI_IMPORT'] == 1) {
												$porcentaje = 0;
											$porcentaje = $value['RI_IM']['CLASES_PRESENTE']*100/$value['RI_IM']['CLASES_REGISTRADAS'];
											if($porcentaje < $porcentaje_minimo_ri)	{
											$i++;
											}
											}else{

											if (isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])) {
											$porcentaje = $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS'];	
												}

											if($porcentaje < $porcentaje_minimo_ri)	{
											$i++;
											}
											}
										}
										echo $i;
									 ?>

								</td>
								<td style="text-align: center;"><?php echo (float)$asignatura_horario['AsignaturaHorario']['ASIST_PROMEDIO'] ?>%</td>
							</tr>	
						</tbody>
					</table>
				</div>
				<div class="col-md-12 m-t-30 text-center">
					<div class="checkboxes ">
						<div class="radio-inline">
							<label for="todos">
								<input type="radio" name="data[filtro_table]" id="todos" checked />Todos los alumnos
							</label>
						</div>
						<div class="radio-inline">
							<label for="mostrar">
								<input type="radio" name="data[filtro_table]" id="mostrar" >Alumnos reprobados por inasistencia
							</label>
						</div>
						<div class="radio-inline">
							<label for="mostrar-2">
								<input type="radio" name="data[filtro_table]" id="mostrar-2">Alumnos que no cumplen con porcentaje de asistencia
							</label>
						</div>
					</div>
				</div>
				<div class="col-md-12 m-t-30">
					<table class="table table-striped table-bordered table-hover" id="tabla-ri">
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
							$i = 0;
								foreach ($alumnos as $key => $value): 
										if ($asignatura_horario['AsignaturaHorario']['RI_IMPORT'] == 1) {
											$porcentaje = 0;
										$clases_ausentes = $value['RI_IM']['CLASES_REGISTRADAS'] - $value['RI_IM']['CLASES_PRESENTE'];
										$porcentaje = $value['RI_IM']['CLASES_PRESENTE']*100/$value['RI_IM']['CLASES_REGISTRADAS'];
										/*if (isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])) {
											$porcentaje = $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS'];	
										}*/
										$color = ($porcentaje < $porcentaje_minimo_ri)?'red':'inherit';
										
										$checkbox2 = ($porcentaje === 100)?'disabled':null;
										
										$checkbox = ($porcentaje < $porcentaje_minimo_ri)?'checked="checked"':null; 
										
										if ($porcentaje < $porcentaje_minimo_ri) {
											$i++;
										}
										$observaciones = '';
										if (!empty($value['RI_IM']['RI'])  &&  $porcentaje <> 100) {
											$checkbox = ((int)$value['RI_IM']['RI'] === 1 )?'checked="checked"':null; 
											//$disabled = "disabled";
											$observaciones = $value['RI_IM']['OBSERVACIONES'];
										}
										}else{


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
										if ((int)$value['RI']['BORRADOR'] === 1) {
											$checkbox = ((int)$value['RI']['RI_DIRECTOR']===1)? 'checked="checked"':null; 
										}
										if ($porcentaje < $porcentaje_minimo_ri) {
											$i++;
										}	
									}
							?>
								<tr >
									<input type="hidden" name="data[Alumno][<?php echo $key; ?>][ID_ALUMNO]" value="<?php echo $value['Alumno']['ID'] ?>">
									<td class="text-center">
										<label class="checkbox checkbox-inline">
											<input 
												<?php echo $checkbox; ?> 
												type="checkbox" 
												value="1" 
												<?php echo $editable ? '':'disabled'; ?>
												name="data[Alumno][<?php echo $key; ?>][RI]" 
												><i class="input-helper"></i>
										</label>
									</td>
									<td class="text-center"><?php echo strtoupper($value['Alumno']['RUT']); ?></td>
									<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_PAT']); ?></td>
									<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_MAT']); ?></td>
									<td class="text-left">
										<?php echo strtoupper($value['Alumno']['NOMBRES']); ?>
									</td>
									<?php if ($asignatura_horario['AsignaturaHorario']['RI_IMPORT'] == 1) { ?>
										<td class="text-center" ><?php echo isset($value['RI_IM'])? $value['RI_IM']['CLASES_PRESENTE']:0; ?></td>
									<td class="text-center" ><?php echo $clases_ausentes; ?></td>	
									<?php }else{ ?>
									
									<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?></td>
									<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
<?php } ?>

									<td class="text-center <?php echo $porcentaje < $porcentaje_minimo_ri  ? 'td-danger' : ''; ?>" >
										<?php 
											echo round($porcentaje,2).'%';
										?>
									</td>
									<td class="text-left">
										<div class="form-group" style="margin-bottom: 0;">
											<div class="fg-line">
												<input 
													type="text" 
													name="data[Alumno][<?php echo $key; ?>][OBSERVACIONES]" 
													class="form-control "
													disabled="disabled" 
													value="<?php echo $observaciones; ?>"
													placeholder="M&aacute;x. 300 caracteres" />
											</div>
										</div>
									</td>
								</tr>
							<?php endforeach ?>
						</tbody>

					</table>
				</div>
				<div class="col-md-12 m-t-30">
					<?php if ($editable): ?>
						<button class="btn btn-success" id="btn-submit">Enviar RI A SAP</button>
						<button class="btn btn-success" id="btn-guardar">GUARDAR</button>
					<?php else: ?>
						<label class="pull-right">
							<?php 
								echo "Enviado el ";
								echo date('d-m-Y',strtotime($asignatura_horario['AsignaturaHorario']['FECHA_ENVIO_SAP'])); 
								echo " a las ".date('H:i',strtotime($asignatura_horario['AsignaturaHorario']['FECHA_ENVIO_SAP']));
								echo " por el director ";
								echo $asignatura_horario['DirectorEnvioSap']['NOMBRES'];
								echo " ".$asignatura_horario['DirectorEnvioSap']['APELLIDO_PAT'];
								echo " ".$asignatura_horario['DirectorEnvioSap']['APELLIDO_MAT'];
							?>
						</label>
					<?php endif ?>
					<?php if ($editable): ?>
						<div class="pull-right">
					<?php endif ?>
						<a 
							class="btn btn-success" 
							href="<?php echo $this->Html->url(array('action'=>'reprobadoExcelDetalle',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>" class="btn btn-default">EXPORTAR EXCEL</a>
						<a 
							class="btn btn-success" 
							target="_blank"
							href="<?php echo $this->Html->url(array('action'=>'reprobadoPdfDetalle',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>" class="btn btn-default">EXPORTAR PDF</a>
					<?php if ($editable): ?>
						</div>
					<?php endif ?>
					<a href="<?php echo $this->Html->url(array('action'=>'reprobados')) ?>" class="btn btn-default">Salir</a>
				</div>
			</div>
		<?php if ($editable): ?>
			</form>
		<?php endif ?>
	</div>
</div>
<script>
	<?php if($editable): ?>
		$('#btn-guardar').on('click', function(event) {
			event.preventDefault();
			form = $(this).parents('form');
			form.append('<input name="data[borrador]" type="hidden" value="1" /> ');
			form.submit();
		});
		$('#btn-submit').on('click', function(event) {
			event.preventDefault();
			form = $(this).parents('form');
			swal({   
	            title: "<?php echo __('¿Esta seguro que desea enviar los datos a sap?'); ?>",   
	            text: "<?php echo __('Este cambio es irreversible'); ?>",
	            type: "warning",
	            showCancelButton: true, 
	            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "S&iacute;, Estoy Seguro!",   
	            closeOnConfirm: false,
	        }, function(){
	        	form.append('<input name="data[borrador]" type="hidden" value="0" /> ');
	        	form.submit();
	        }); 
		});
	<?php endif; ?>
	$('#mostrar').click(function(event) {
		$('#leyenda_reprobados').show();
		$('#leyenda_reprobados_2').hide();
		$('#tabla-ri tbody tr').hide();
		$('#tabla-ri tbody input:checked').each(function(index, el) {
			$(this).parents('tr').show();
		});
	});
	$('#todos').click(function(event) {
		$('#leyenda_reprobados').hide();
		$('#leyenda_reprobados_2').hide();
		$('#tabla-ri tbody tr').show();
	});
	$('#mostrar-2').click(function(event) {
		$('#leyenda_reprobados').hide();
		$('#leyenda_reprobados_2').show();
		$('#tabla-ri tbody tr').hide();
		$('#tabla-ri tbody tr td.td-danger').each(function(index, el) {
			$(this).parents('tr').show();
		});
	}); 
</script>