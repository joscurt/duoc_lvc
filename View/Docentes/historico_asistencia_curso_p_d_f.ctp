<style>
	html , body{
  		font-family: 'Roboto';
  		font-size : 0.94rem;
	}
	.titulo{
		color:#092c50;
	}
	table{
		width: 100% !important;
	}
	.table{
		border-spacing: 0;
  		border-collapse: collapse;
  		border: 1px solid #ddd !important;
	}
	.table th,
  	.table td {
    	border: 1px solid #ddd !important;
    	padding: 5px;
    	text-align: center;
  	}
  	.table  tbody  tr:nth-child(odd) {
  		background-color: #f9f9f9;
	}
</style>
<table style="border-bottom:1px solid #ccc;">
	<tr >
		<td><img src="img/duocuc.png" style="width:150px;" alt=""></td>
		<td><h2 class="titulo">CURSO  <?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'].' | '.date('d-m-Y H:i');?></h2></td>
	</tr>
</table><br>
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
					<td class="text-left"><?php echo strtoupper(utf8_encode($value['Alumno']['APELLIDO_PAT'])); ?></td>
					<td class="text-left"><?php echo strtoupper(utf8_encode($value['Alumno']['APELLIDO_MAT'])); ?></td>
					<td class="text-left">
						<a 
							style="cursor: pointer; " 
							data-dd="<?php echo $value['Alumno']['ID']; ?>"
							class="alumno_active"><?php echo strtoupper(utf8_encode($value['Alumno']['NOMBRES'])); ?></a>
					</td>
					<td  class="text-center"><?php echo isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:null; ?></td>
					<td  class="text-center"><?php echo isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_AUSENTE']:null; ?></td>
					<?php 
						$clases_presente = $indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE'];
						$total_hoy = $indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS'];
						$asistencia_actual = $clases_presente*100/$total_hoy;
						$asistencia_actual = round($asistencia_actual,1);
					?>
					<td  class="text-center" <?php echo ($asistencia_actual < 70)? 'style="color:red;"' : null; ?> ><?php echo $asistencia_actual; ?>%</td>
					<?php 
						$asistencia_total = round(($clases_presente*100/$total_clases),1); 
					?>
					<td  class="text-center" <?php echo ($asistencia_total < 70)? 'style="color:red;"' : null; ?> ><?php echo $asistencia_total; ?>%</td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>