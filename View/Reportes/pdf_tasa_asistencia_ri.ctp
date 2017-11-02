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
		<td><h4 class="titulo">RI DE ALUMNOS</h4></td>
	</tr>
</table>
<br>
<!-- <h3 style="border-bottom:1px solid #ddd;" ></h3>
<br> -->
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Secci&oacute;n</th>
					<th class="una-linea">Rut Alumno</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Clases Presente</th>
					<th>Clases Ausente</th>
					<th>Clases Justificadas</th>
					<th>Asistencia Actual</th>
					<th>RI</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
		  			foreach ($registros as $key => $value): 
		  				$porcentaje = 0;
						if (isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])) {
							$porcentaje = $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$value['AsignaturaHorario']['CLASES_REGISTRADAS'];	
						}
				?>
				  	<tr>
				  	<?php if($value['RI']['RI_DIRECTOR']==1) {?>
					    <td><?php ?></td>
					    <td><?php echo htmlspecialchars($value['Asignatura']['NOMBRE']); ?></td>
					    <td><?php echo $value['AlumnoAsignatura']['SIGLA_SECCION']; ?></td>
					    <td><?php echo $value['Alumno']['RUT'].'-'.$value['Alumno']['DV_RUT']; ?></td>
					    <td><?php echo htmlspecialchars($value['Alumno']['APELLIDO_PAT']); ?></td>
					    <td><?php echo htmlspecialchars($value['Alumno']['APELLIDO_MAT']); ?></td>
					    <td><?php echo htmlspecialchars($value['Alumno']['NOMBRES']); ?></td>
					    <td class="text-center" ><?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?></td>
						<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
						<td><?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_JUSTIFICADOS']:0; ?></td>
					    <td><?php echo round($porcentaje,2).'%'; ?></td>
					    <td>
					    	<?php 
					    		$check = 'NO';
					    		if ($value['RI']['RI_DIRECTOR']==1) {
					    			$check = 'SI';
					    		}
					    		echo $check;
					    	?>	
					    </td>
					    <?php } ?>
				  	</tr>
			  	<?php endforeach ?>
		  	</tbody>
		</table>
	</div>
</div>
