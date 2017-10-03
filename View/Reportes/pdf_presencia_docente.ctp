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
		<td><h4 class="titulo">REPORTES PRESENCIA DOCENTE</h4></td>
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
					<th class="una-linea">Fecha</th>
					<th>Sede</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Secci&oacute;n</th>
					<th class="una-linea">Rut docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Sala</th>
					<th>Horario</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
		  			foreach ($registros as $key => $value): ?>
				  	<tr>
					    <td><?php echo $key+1; ?></td>
					    <td><?php echo date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></td>
					    <td><?php echo $value['Sede']['NOMBRE']; ?></td>
					    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
					    <td><?php echo $value['ProgramacionClase']['SIGLA_SECCION']; ?></td>
					    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
					    <td><?php echo utf8_encode($value['Docente']['APELLIDO_PAT']); ?></td>
					    <td><?php echo utf8_encode($value['Docente']['APELLIDO_MAT']); ?></td>
					    <td><?php echo utf8_encode($value['Docente']['NOMBRE']); ?></td>
					    <td><?php echo !empty($value['Sala']['TIPO_SALA'])?$value['Sala']['TIPO_SALA']:$value['SalaReemplazo']['TIPO_SALA']; ?></td>
					    <td>
					    	<?php 
					    		echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).' a '.
					    		date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); 
					    	?>	
					    </td>
				  	</tr>
			  	<?php endforeach ?>
		  	</tbody>
		</table>
	</div>
</div>
