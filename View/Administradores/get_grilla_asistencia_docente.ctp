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
			<th>Editar</th>
		</tr>
	</thead>
  	<tbody>
  		<?php 
  			$contador=0;
  			foreach ($programacion_clases as $key => $programacion): 
  				$contador++;
  				$horaInicio=date('H:i', strtotime($programacion['ProgramacionClase']['HORA_INICIO']));
  				$horaFin=date('H:i', strtotime($programacion['ProgramacionClase']['HORA_FIN']));
  			?>
	  		<tr class="odd">
	    		<td><?php echo $contador; ?></td>
	    		<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y',strtotime($programacion['ProgramacionClase']['FECHA_CLASE'])):null; ?></td>
	    		<td><?php echo $programacion['ProgramacionClase']['SIGLA_SECCION']; ?></td>
	    		<td><?php echo $programacion['Docente']['COD_DOCENTE']; ?></td>
	    		<td><?php echo $programacion['Docente']['RUT'].'-'.$programacion['Docente']['DV']; ?></td>
	    		<td><?php echo $programacion['Detalle']['DETALLE']; ?></td>
	    		<td><?php echo $programacion['Estado']['NOMBRE']; ?></td>
				<td><?php echo $horaInicio; ?></td>
				<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']) ? date('H:i',strtotime($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])):null; ?></td>
				<td><?php echo $horaFin; ?></td>
	    		<td><?php echo !empty($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']) ? date('H:i',strtotime($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])):null; ?></td>
	    		<td align="center">
	    			<?php 
	    				$delta_minutos_inicio = $delta_minutos_fin = 0;
	    				if (!empty($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])) {
	    					$inicio_programado = strtotime($programacion['ProgramacionClase']['HORA_INICIO']);
	    					$inicio_real = strtotime($programacion['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']);
	    					$delta_minutos_inicio = $inicio_real-$inicio_programado;
	    					if ($delta_minutos_inicio < 0) {
	    						$delta_minutos_inicio = 0;
	    					}
	    				}
	    				if (!empty($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])) {
	    					$fin_programado = strtotime($programacion['ProgramacionClase']['HORA_FIN']);
	    					$fin_real = strtotime($programacion['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']);
	    					$delta_minutos_fin = $fin_programado-$fin_real;
	    					if ($delta_minutos_fin < 0) {
	    						$delta_minutos_fin = 0;
	    					}
	    				}
	    				$minutos = ($delta_minutos_inicio+$delta_minutos_fin)/60;
	    				echo number_format($minutos,1,',','.').' min';
	    			?>
	    		</td>
	    		<td align="center">
	    			<?php
	    				$modulos = $minutos/45;
	    				echo number_format($modulos,0,',','.');
	    			?>
	    		</td>
		    	<td>
		    		<a class="btn btn-info btn-xs" 
		    			href="<?php echo $this->Html->url(array('action'=>'fichaAsistenciaDocenteDetalle',$programacion['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
		    			title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>
		    		</a>
		    	</td>
	  		</tr>
  		<?php endforeach; ?>
  	</tbody>
</table>
<div class="card-header">
	<?php $sigla_seccion = empty($sigla_seccion) ? '0':$sigla_seccion; ?>
	<?php $cod_docente = empty($cod_docente) ? '0':$cod_docente; ?>
	<a href="<?php echo $this->Html->url(array('action'=>'pdfAsistenciaDocente',$cod_docente,$sigla_seccion,$fecha_desde,$fecha_hasta)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
	<a href="<?php echo $this->Html->url(array('action'=>'excelAsistenciaDocente',$cod_docente,$sigla_seccion,$fecha_desde,$fecha_hasta)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR EXCEL</a>
	<a href="<?php echo $this->Html->url(array('action'=>'imprimirAsistenciaDocente',$cod_docente,$sigla_seccion,$fecha_desde,$fecha_hasta)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;IMPRIMIR</a>
</div>