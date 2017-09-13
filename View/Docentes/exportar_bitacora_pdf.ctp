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
		<td><h2 class="titulo">BITÁCORA EVENTO</h2></td>
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
<h3 style="border-bottom:1px solid #ddd;" >Clases</h3>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>Nº</th>
					<th>Fecha Clase</th>
					<th>Fecha Registro</th>
					<th>Modalidad Clases</th>
					<th>Horario</th>
					<th>Docente</th>
					<th>Tipo</th>
					<th>Bitácora Registrada</th>
					<th>Bitácora Docente</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($programacion_clases)): ?>
					<?php foreach ($programacion_clases as $key => $detalle): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])); ?></td>
							<td><?php echo !empty($detalle['ProgramacionClase']['FECHA_REGISTRAR_ASISTENCIA']) ? date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_REGISTRAR_ASISTENCIA'])) : ''; ?></td>
							<td><?php echo $detalle['ProgramacionClase']['MODALIDAD']; ?></td>
							<td><?php echo date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])) ?></td>
							<td><?php echo utf8_encode($detalle['Docente']['NOMBRE'].' '.$detalle['Docente']['APELLIDO_PAT'].' '.$detalle['Docente']['APELLIDO_MAT']); ?></td>
							<td><?php echo $detalle['ProgramacionClase']['TIPO_EVENTO']; ?></td>
							<td><?php echo $detalle['bitacora']==true ? 'Sí': 'No'; ?></td>
							<td><?php echo 'BITACORA DOCENTE' ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
