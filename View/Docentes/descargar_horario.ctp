<?php  
#GENERA PDF DE HORARIOS DEL DOCENTE ======================00

	#debug($programacion_clases);exit();
?>
<style>
	table{
		width: 100%;
	}
	table.table  tr  th,
	table.table  tr  td {
		vertical-align: middle;
		border-bottom: 2px solid #ddd;
		border: 1px solid #ddd;
		text-align: center;
		width:15%;
	}
</style>
<table style="border-bottom:1px solid #ccc;">
	<tr >
		<td><img src="img/duocuc.png" style="width:150px;" alt=""></td>
		<td><h2 class="titulo">HORARIO DOCENTE SEDE   <?php echo isset($sede['Sede']['ID_TIPO_SEDE']) && $sede['Sede']['ID_TIPO_SEDE'] == '1' ? ' IP' : ' CFT';?> - <?php echo $sede['Sede']['NOMBRE'];?></h2></td>
	</tr>
</table><br>
<?php foreach ($programacion_clases as $key => $value): ?>
	<table style="width:100%;">
		<tr >
			<td>
				<h4>
					<strong>Docente:</strong>&nbsp;
					<?php 
						echo ($docente['Docente']['NOMBRE'].' '.
						$docente['Docente']['APELLIDO_PAT'].' '.
						$docente['Docente']['APELLIDO_MAT']); 
					?>
					<br>
					<strong>Correo:</strong>&nbsp;
					<?php echo $docente['Docente']['CORREO']; ?>
				</h4>
			</td>
			<td align="right">
				<h4  class="pull-right">
					<?php echo date('d-m-Y') ?> a las <?php echo date('H:i'); ?> horas
				</h4>
			</td>
		</tr>
	</table>
	<h3>
		Horario <?php echo date('d-m-Y',strtotime($value['Semana']['FECHA_INICIO'])).' / '.date('d-m-Y',strtotime($value['Semana']['FECHA_FIN'])); ?>
	</h3>
	<br>
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th class="th-titulo">Horario</th>
				<th class="th-dias">Lunes</th>
				<th class="th-dias">Martes</th>
				<th class="th-dias">Miercoles</th>
				<th class="th-dias">Jueves</th>
				<th class="th-dias">Viernes</th>
				<th class="th-dias">Sabado</th>
			</tr>
		</thead>
		<tbody>
			<?php 
	  			$contador=0;
	  			$modulos_siguientes = array();
	  			#debug($horarios_modulos);exit();
	  			foreach ($horarios_modulos as $horario): 
	  				$contador++;
	  				$class_tr = $contador%2==0?'odd':'even';
	  				$hora_inicio = $horario['HorarioModulo']['HORA_INICIO'];
	  		?>

			  	<tr class="<?php echo $class_tr; ?>" align="center">
		    		<td style="vertical-align:middle;"><?php echo $hora_inicio; ?> - <?php echo $horario['HorarioModulo']['HORA_FIN']; ?></td>
				    <?php for ($i=1; $i < 7; $i++): ?>
				    	<td style="vertical-align:middle;">
					    	<?php
					    		if (isset($value['Horarios'][$hora_inicio][$i])):
					    			echo $value['Horarios'][$hora_inicio][$i]['Sede']['NOMBRE'].' <br> '.
					    			$value['Horarios'][$hora_inicio][$i]['ProgramacionClase']['SIGLA_SECCION'].' <br> '.
					    			$value['Horarios'][$hora_inicio][$i]['Asignatura']['NOMBRE'].' <br> '.
					    			$value['Horarios'][$hora_inicio][$i]['ProgramacionClase']['MODALIDAD'];
					    		endif;
					    	?>
					    </td>
					<?php endfor; ?>
			  	</tr>	
		  	<?php endforeach ?>
		</tbody>
	</table>
	<pagebreak />
<?php endforeach ?>