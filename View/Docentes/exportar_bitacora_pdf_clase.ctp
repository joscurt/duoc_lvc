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
		<td>
			<?php echo $this->Html->image('duocuc.png',array("style"=>"width:150px;")); ?>
		</td>
		<td><h2 class="titulo">BIT&Aacute;CORA EVENTO</h2></td>
	</tr>
</table>
<br>
<table>
	<tr>
		<td><strong>SEDE:&nbsp;</strong><?php echo $programacion_clase['Sede']['NOMBRE']; ?></td>
		<td><strong>Asignatura:&nbsp;</strong><?php echo $programacion_clase['Asignatura']['NOMBRE']; ?></td>
		<td><strong>Sigla:&nbsp;</strong><?php echo $programacion_clase['ProgramacionClase']['SIGLA_SECCION']; ?></td>
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
					<th>#</th>
					<th>Fecha Clase</th>
					<th>Fecha Registro</th>
					<th>Modalidad Clases</th>
					<th>Horario</th>
					<th>Docente</th>
					<th>Tipo</th>
					<th>Bitacora</th>
					<th>Fecha Ingreso Bitacora</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($programacion_clase['ProgramacionClase']['bitacoras']) && !empty($programacion_clase['ProgramacionClase']['bitacoras'])): ?>
					<?php foreach ($programacion_clase['ProgramacionClase']['bitacoras'] as $key => $detalle): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo date('d-m-Y', strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
							<td><?php echo !empty($programacion_clase['ProgramacionClase']['FECHA_REGISTRAR_ASISTENCIA']) ? date('d-m-Y', strtotime($programacion_clase['ProgramacionClase']['FECHA_REGISTRAR_ASISTENCIA'])) : ''; ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['MODALIDAD']; ?></td>
							<td><?php echo date('H:i', strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i', strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])) ?></td>
							<td><?php echo utf8_encode($programacion_clase['Docente']['NOMBRE'].' '.$programacion_clase['Docente']['APELLIDO_PAT'].' '.$programacion_clase['Docente']['APELLIDO_MAT']); ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['TIPO_EVENTO']; ?></td>
							<td><?php echo $detalle['Bitacora']['DESCRIPCION']; ?></td>
							<td><?php echo date('d-m-Y H:i', strtotime($detalle['Bitacora']['CREATED'])); ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
