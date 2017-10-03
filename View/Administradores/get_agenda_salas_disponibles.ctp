<table border="0" cellpadding="0" cellspacing="0" class="table table-striped big size-7 borde disponibilidadSala">
	<thead>
		<tr>
			<th style="text-align:center">Horario</th>
			<th style="text-align:center">Lunes</th>
			<th style="text-align:center">Martes</th>
			<th style="text-align:center">Mi&eacute;rcoles</th>
			<th style="text-align:center">Jueves</th>
			<th style="text-align:center">Viernes</th>
			<th style="text-align:center">S&aacute;bado</th>
		</tr>
	</thead>
  	<tbody>
  		<?php 
  			$contador=0;
  			$modulos_siguientes = array();
  			#debug($horarios_modulos);exit();
  			foreach ($horarios_modulos as $key => $horario): 
  				$contador++;
  				$class_tr = $contador%2==0?'odd':'even';
  				$hora_inicio = $horario['HorarioModulo']['HORA_INICIO'];
  		?>

		  	<tr class="<?php echo $class_tr; ?>" align="center">
	    		<td style="vertical-align:middle;"><?php echo $hora_inicio; ?> - <?php echo $horario['HorarioModulo']['HORA_FIN']; ?></td>
			    <?php for ($i=1; $i < 7; $i++): ?>
			    	<td style="vertical-align:middle;">
				    	<?php
				    		if (isset($programacion_clases[$hora_inicio][$i])):
				    			echo $programacion_clases[$hora_inicio][$i]['ProgramacionClase']['SIGLA_SECCION'].' <br> '.
				    			$programacion_clases[$hora_inicio][$i]['Asignatura']['NOMBRE'];
				    		endif;
				    	?>
				    </td>
				<?php endfor; ?>
		  	</tr>	
	  	<?php endforeach ?>
  	</tbody>
</table>
<div class="card-header">
	<a href="<?php echo $this->Html->url(array('action'=>'pdfDisponibilidadSala',$sala['Sala']['COD_SALA'],$semana['Semana']['ID'],$hora_inicio,$hora_fin)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
	<a href="<?php echo $this->Html->url(array('action'=>'excelDisponibilidadSala',$sala['Sala']['COD_SALA'],$semana['Semana']['ID'],$hora_inicio,$hora_fin)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR EXCEL</a>
	<a href="<?php echo $this->Html->url(array('action'=>'imprimirDisponibilidadSala',$sala['Sala']['COD_SALA'],$semana['Semana']['ID'],$hora_inicio,$hora_fin)); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;IMPRIMIR</a>
</div>