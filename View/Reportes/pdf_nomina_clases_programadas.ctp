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
		<td><h4 class="titulo">N&Oacute;MINA DIARIA DE CLASES PROGRAMADAS</h4></td>
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
					<th>Nº</th>
					<th>Fecha Clase</th>
					<th>Nombre Asignatura</th>
					<th>Sigla-Secci&oacute;n</th>
					<th>Jornada</th>
					<th>Rut Docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Sala</th>
					<th>Horario</th>
					<th>Tipo</th>
					<th>Detalle</th>
					<th>Estado</th>
					<th>SubEstado</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($registros)): ?>
					<?php foreach ($registros as $key => $detalle): ?>
						<tr>
							<td><?php echo $key+1; ?></td>
							<td><?php echo date('d-m-Y', strtotime($detalle['ProgramacionClase']['FECHA_CLASE'])); ?></td>
							<td><?php echo htmlspecialchars($detalle['Asignatura']['NOMBRE']); ?></td>
							<td><?php echo $detalle['ProgramacionClase']['SIGLA_SECCION']; ?></td>
							<td><?php echo $detalle['ProgramacionClase']['COD_JORNADA']=='D'?'Diurna':'Vespertina'; ?></td>
							<td><?php echo $detalle['Docente']['RUT'].'-'.$detalle['Docente']['DV']; ?></td>
							<td><?php echo htmlspecialchars($detalle['Docente']['APELLIDO_PAT']); ?></td>
							<td><?php echo htmlspecialchars($detalle['Docente']['APELLIDO_MAT']); ?></td>
							<td><?php echo htmlspecialchars($detalle['Docente']['NOMBRE']); ?></td>
							<td><?php echo !empty($detalle['Sala']['TIPO_SALA'])?htmlspecialchars($detalle['Sala']['TIPO_SALA']):htmlspecialchars($detalle['SalaReemplazo']['TIPO_SALA']); ?></td>
							<td><?php echo date('H:i', strtotime($detalle['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i', strtotime($detalle['ProgramacionClase']['HORA_FIN'])); ?></td>
							<td><?php echo $detalle['ProgramacionClase']['TIPO_EVENTO']; ?></td>
							<td><?php echo $detalle['Detalle']['DETALLE']; ?></td>
							<td><?php echo $detalle['Estado']['NOMBRE']; ?></td>
							<td><?php echo $detalle['SubEstado']['NOMBRE']; ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
