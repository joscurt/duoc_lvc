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
		<?php 
			$fecha_desde = date('d-m-Y',strtotime($semana['Semana']['FECHA_INICIO']));
			$fecha_fin = date('d-m-Y',strtotime($semana['Semana']['FECHA_FIN']));
		?>
		<td>
			<h2 
				class="titulo">
					HORARIO CARGA DOCENTE
			</h2>
		</td>
	</tr>
</table>
<br>
<table>
	<tr >
		<td>
			<label style="border-bottom:1px solid #ccc;">Docente</label>&nbsp;&nbsp;<?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT'] ?>
		</td>
		<?php 
			$fecha_desde = date('d-m-Y',strtotime($semana['Semana']['FECHA_INICIO']));
			$fecha_fin = date('d-m-Y',strtotime($semana['Semana']['FECHA_FIN']));
		?>
		<td>
			<label style="border-bottom:1px solid #ccc;">Semana</label>&nbsp;<?php echo $semana['Semana']['NUMERO_SEMANA'].' '.
						$fecha_desde .' A '.$fecha_fin; ?>
		</td>
	</tr>
</table>		
<br>			
<div class="row">
	<div class="col-md-12">
		<table border="0" cellpadding="0" cellspacing="0" class="table table-striped big size-7 borde disponibilidadSala">
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
			    		<td style="vertical-align:middle;width:16%!important"><?php echo $hora_inicio; ?> - <?php echo $horario['HorarioModulo']['HORA_FIN']; ?></td>
					    <?php for ($i=1; $i < 7; $i++): ?>
					    	<td style="vertical-align:middle;width:16%!important">
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
	</div>
</div>
