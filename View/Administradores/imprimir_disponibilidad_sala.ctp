<style>
	#tabla-imprimir td, #tabla-imprimir th{
		border: 1px solid #ccc !important;
	}
</style>
<table class="table table-striped f-500" id="tabla-imprimir">
	<thead>
		<tr>
			<th style="text-align:center">Semana</th>
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