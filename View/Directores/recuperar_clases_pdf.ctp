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
		<td><h2 class="titulo">RECUPERAR CLASES</h2></td>
	</tr>
</table>
<br>
<h3 style="border-bottom:1px solid #ddd;" >Clases por recuperar</h3>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>Nº</th>
					<th>Fecha Clase</th>
					<th>Nombre Asignatura</th>
					<th>Sigla-Sección</th>
					<th>Jornada</th>
					<th>Rut Docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Sala</th>
					<th>Horario</th>
					<th>Tipo</th>
					<th>Detalle</th>
				</tr>
			</thead>
			<tbody>
				<?php if (isset($datos_pdf)): ?>
					<?php foreach ($datos_pdf['Excel'] as $key => $detalle): ?>
						<tr>
							<td><?php echo $key; ?></td>
							<td><?php echo date('d-m-Y', strtotime($detalle['FECHA_CLASE'])); ?></td>
							<td><?php echo $detalle['NOMBRE_ASIGNATURA']; ?></td>
							<td><?php echo $detalle['SIGLA_SECCION']; ?></td>
							<td>
								<?php if (!empty($detalle['COD_JORNADA'])): ?>
                                    <?php echo $detalle['COD_JORNADA'] == 'D' ? 'Diurno':''; ?>
                                    <?php echo $detalle['COD_JORNADA'] == 'V' ? 'Vespertino':''; ?>
                                <?php endif ?>	
							</td>
							<td><?php echo $detalle['RUT'].'-'.$detalle['DV']; ?></td>
							<td><?php echo $detalle['APELLIDO_PAT']; ?></td>
							<td><?php echo $detalle['APELLIDO_MAT']; ?></td>
							<td><?php echo $detalle['NOMBRE_DOCENTE'] ?></td>
							<td><?php echo $detalle['SALA']; ?></td>
							<td><?php echo date('H:m', strtotime($detalle['HORA_INICIO'])).' - '.date('H:m', strtotime($detalle['HORA_FIN'])); ?></td>
							<td><?php echo $detalle['TIPO_EVENTO']; ?></td>
							<td><?php echo $detalle['DETALLE']; ?></td>
						</tr>
					<?php endforeach ?>
				<?php endif ?>
			</tbody>
		</table>
	</div>
</div>
