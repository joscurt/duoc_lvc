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
			<th>Sigla-Secci&oacute;n</th>
			<th>ID Docente</th>
			<th>Rut docente</th>
			<th>Detalle</th>
			<th>Estado</th>
			<th>Hora Inicio</th>
			<th>Registro inicio</th>
			<th>Hora fin</th>
			<th>Registro fin</th>
			<th>Total a recuperar</th>
			<th>M&oacute;dulos a recuperar</th>
		</tr>
	</thead>
  	<tbody>
  		<?php 
  			$contador=0;
  			foreach ($programacion_clases as $key => $programacion): 
  				$contador++;
  		?>
	  		<tr class="odd">
	    		<td><?php echo $contador; ?></td>
	    		<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y',strtotime($programacion['ProgramacionClase']['FECHA_CLASE'])):null; ?></td>
	    		<td><?php echo $programacion['ProgramacionClase']['SIGLA_SECCION']; ?></td>
	    		<td><?php echo $programacion['Docente']['COD_DOCENTE']; ?></td>
	    		<td><?php echo $programacion['Docente']['RUT'].'-'.$programacion['Docente']['DV']; ?></td>
	    		<td><?php echo $programacion['Detalle']['DETALLE']; ?></td>
	    		<td><?php echo $programacion['Estado']['NOMBRE']; ?></td>
	    		<td><?php echo date('H:i',strtotime($programacion['ProgramacionClase']['HORA_INICIO'])); ?></td>
	    		<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']) ? date('H:i',strtotime($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])):null; ?></td>
	    		<td><?php echo date('H:i',strtotime($programacion['ProgramacionClase']['HORA_FIN'])); ?></td>
	    		<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']) ? date('H:i',strtotime($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])):null; ?></td>
	    		<td>
	    			<?php 
	    				$minutos = '';
	    				if (!empty($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']) && !empty($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])) {
	    					$inicio_ideal = $programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'];
	    					$inicio = $programacion['ProgramacionClase']['HORA_INICIO'];
	    				}
	    				echo $minutos;
	    			?>
	    		</td>
	    		<td>--</td>
	  		</tr>
  		<?php endforeach; ?>
  	</tbody>
</table>