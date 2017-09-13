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
		<td><h2 class="titulo">REPROBADOS INASISTENCIA <?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']; ?></h2></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td><strong>SEDE:&nbsp;</strong><?php echo $asignatura_horario['Sede']['NOMBRE']; ?></td>
		<td><strong>Asignatura:&nbsp;</strong><?php echo $asignatura_horario['Asignatura']['NOMBRE']; ?></td>
		<td><strong>Sigla:&nbsp;</strong><?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
		<?php if ($asignatura_horario['AsignaturaHorario']['COD_JORNADA']=='D'): ?>
			<td><strong>JORNADA:&nbsp;</strong>DIURNA</td>
		<?php endif ?>
		<?php if ($asignatura_horario['AsignaturaHorario']['COD_JORNADA']=='V'): ?>
			<td><strong>JORNADA:&nbsp;</strong>VESPERTINA</td>
		<?php endif ?>
		<?php if (empty($asignatura_horario['AsignaturaHorario']['COD_JORNADA'])): ?>
			<td><strong>JORNADA:&nbsp;</strong>---</td>
		<?php endif ?>
	</tr>
</table>
<br>
<h3 style="border-bottom:1px solid #ddd;" >Alumnos</h3>
<div class="row">
	<div class="col-md-12">
		<table class="table">
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
						$checkbox = ($porcentaje < $porcentaje_minimo_ri)?'SI':'NO'; 
						$observaciones = '';
						if (!empty($value['RI']['ID'])) {
							$checkbox = ((int)$value['RI']['R_I'] === 1)?'SI':'NO'; 
							$observaciones = $value['RI']['OBSERVACIONES'];
						}
				?>
					<tr >
						<td class="text-center"><?php echo $checkbox; ?></td>
						<td class="text-center"><?php echo strtoupper($value['Alumno']['RUT']); ?></td>
						<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_PAT']); ?></td>
						<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_MAT']); ?></td>
						<td class="text-left">
							<?php echo strtoupper($value['Alumno']['NOMBRES']); ?>
						</td>
						<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?></td>
						<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
						<td class="text-center <?php echo $porcentaje < $porcentaje_minimo_ri  ? 'td-danger' : ''; ?>" >
							<?php 
								echo round($porcentaje,2).'%';
							?>
						</td>
						<td class="text-left">
							<?php echo $observaciones; ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
