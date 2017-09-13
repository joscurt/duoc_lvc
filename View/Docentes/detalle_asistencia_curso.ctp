<br><br>
<div class="table-responsive"  style="overflow-x:hidden;" >
	<table class="table table-striped table-bordered">
		<thead>
			<tr>
				<th class="td-app text-center">Nº</th>
				<th class="td-app text-center">Rut Alumno</th>
				<th class="td-app text-left">Apellido Paterno</th>
				<th class="td-app text-left">Apellido Materno</th>
				<th class="td-app text-left">Nombres</th>
				<th class="td-app text-center">Clases Presente</th>
				<th class="td-app text-center">Clases Ausente</th>
				<th class="td-app text-center">Asistencia Actual</th>
				<th class="td-app text-center">Asistencia</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($alumnos as $key => $value): ?>
				<tr>
					<td class="text-center"><?php echo $key +1;?></td>
					<td class="text-center"><?php echo strtoupper($value['Alumno']['RUT']); ?></td>
					<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_PAT']); ?></td>
					<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_MAT']); ?></td>
					<td class="text-left">
						<a 
							style="cursor: pointer; " 
							data-dd="<?php echo $value['Alumno']['ID']; ?>"
							class="alumno_active"><?php echo strtoupper($value['Alumno']['NOMBRES']); ?></a>
					</td>
					<td  class="text-center"><?php echo isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:0; ?></td>
					<td  class="text-center"><?php echo isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_AUSENTE']:0; ?></td>
					<?php 
						$clases_presente = isset($indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE'])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:0;
						$total_hoy = isset($indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS'])?$indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS']:1;
						$asistencia_actual = $clases_presente*100/$total_hoy;
						$asistencia_actual = round($asistencia_actual,1);
					?>
					<td  class="text-center" <?php echo ($asistencia_actual < 70)? 'style="color:red;"' : null; ?> ><?php echo $asistencia_actual; ?>%</td>
					<?php 
						$asistencia_total = round(($clases_presente*100/$total_clases),1); 
						#echo $total_clases;
					?>
					<td  class="text-center" <?php echo ($asistencia_total < 70)? 'style="color:red;"' : null; ?> ><?php echo $asistencia_total; ?>%</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
	<br>
	<div class="row">
		<div class="col-md-12">
			<ul>
				<li>La "Asistencia" considera solo las Clases Regulares de la asignatura sección, descontando las clases suspendidas</li>
				<li>La "Asistencia Actual" considera la asistencia del alumno solo a las Clases Regulares en las que se ha registrado la asistencia</li>
			</ul>
		</div>
	</div>
	<div class="row m-t-30 m-b-30">
		<div class="col-md-12" align="center">
			<a 
				class="btn btn-sm btn-info" 
				href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])) ?>"
				><i class="fa fa-arrow-left"></i>&nbsp;Volver a Eventos</a>
			<a
				id="btn-exportar-pdf"
				class="btn btn-sm btn-default" 
				href="#"
				><i  style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;EXPORTAR A PDF</a>
			<a
				id="btn-exportar-excel" 
				class="btn btn-sm btn-default" 
				href="#"
				><i  style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR A EXCEL</a>	
		</div>
	</div>
</div>
<script>
	$('.alumno_active').on('click',function(event) {
		event.preventDefault();
		cod_alumno = $(this).attr('data-dd');
		if (cod_alumno!='' && cod_alumno!=undefined) {
			$('#select-change-alumno').selectpicker('val', cod_alumno);
			$('#select-change-alumno').selectpicker('refresh');
			$('#select-change-alumno').trigger('change');
			$('a[href="#ver_alumno"]').trigger('click');
		}
	});

	$('#btn-exportar-pdf').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'historicoAsistenciaCursoPDF',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>
		window.location ='<?php echo $url ?>' ;
	});

	$('#btn-exportar-excel').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'historicoAsistenciaCursoExcel',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>
		window.location ='<?php echo $url ?>' ;
		setTimeout(function(){ 
			$('#elementLoader').hide();
		}, 3000);
	});


</script>