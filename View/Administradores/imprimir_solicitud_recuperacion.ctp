<style>
	#tabla-imprimir td, #tabla-imprimir th{
		border: 1px solid #ccc !important;
	}
</style>
<table class="table table-striped f-500" id="tabla-imprimir">
	<thead>
		<tr>
			<th>&nbsp;</th>
			<th>Fecha</th>
			<th>Nombre Asignatura</th>
			<th>Sigla-Secci&oacute;n</th>
			<th>Jornada</th>
			<th>Rut docente</th>
			<th>Apellido Paterno</th>
			<th>Apellido Materno</th>
			<th>Nombres</th>
			<th>Sala</th>
			<th>Horario</th>
			<th>Tipo</th>
			<th>Detalle</th>
			<th>Estado</th>
		</tr>
	</thead>
  	<tbody>
  		<?php 
  			$contador=0;
  			foreach ($programacion_clases as $key => $value): 
  				$contador++;
  		?>
  			<tr class="">
			    <td><?php echo $contador ?></td>
			    <td>
			    	<?php echo !empty($value['ProgramacionClase']['FECHA_CLASE'])? date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])):null;  ?>
			    </td>
			    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
			    <td><?php echo $value['ProgramacionClase']['SIGLA_SECCION']; ?></td>
			    <td><?php echo $value['ProgramacionClase']['COD_JORNADA']; ?></td>
			    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
			    <td><?php echo $value['Docente']['APELLIDO_PAT']; ?></td>
			    <td><?php echo $value['Docente']['APELLIDO_MAT']; ?></td>
			    <td><?php echo $value['Docente']['NOMBRE']; ?></td>
			    <td><?php echo $value['ProgramacionClase']['SALA']; ?></td>
			    <td><?php echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).' '.date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); ?></td>
			    <td><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></td>
			    <td><?php echo $value['Detalle']['DETALLE']; ?></td>
			    <td><?php echo $value['EstadoProgramacion']['NOMBRE']; ?></td>
	  		</tr>
  		<?php endforeach; ?>
  	</tbody>
</table>