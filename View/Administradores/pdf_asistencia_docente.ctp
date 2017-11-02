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
		<td>
			<h2 
				class="titulo">
					ASISTENCIA DOCENTE
			</h2>
		</td>
	</tr>
</table>
<br>
<table>
	<tr >
		<td>
			<label style="border-bottom:1px solid #ccc;">Docente</label>&nbsp;&nbsp;<?php echo !empty($docente)?utf8_encode($docente['Docente']['NOMBRE']).' '.utf8_encode($docente['Docente']['APELLIDO_PAT']).' '.utf8_encode($docente['Docente']['APELLIDO_MAT']):null; ?>
		</td>
		<td>
			<label style="border-bottom:1px solid #ccc;">Sigla Secci&oacute;n</label>&nbsp;<?php echo $sigla_seccion; ?>
		</td>
		<td>
			<label style="border-bottom:1px solid #ccc;">Desde</label>&nbsp;<?php echo $fecha_desde; ?>
		</td>
		<td>
			<label style="border-bottom:1px solid #ccc;">Hasta</label>&nbsp;<?php echo $fecha_hasta; ?>
		</td>
	</tr>
</table>		
<br>			
<div class="row">
	<div class="col-md-12">
		<table border="0" cellpadding="0" cellspacing="0" class="table table-striped asistenciaDocente">
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
	</div>
</div>
