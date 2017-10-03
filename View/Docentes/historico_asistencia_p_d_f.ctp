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
		<td><h2 class="titulo">ASISTENCIA <?php echo utf8_encode($alumno['Alumno']['NOMBRES'].' '. $alumno['Alumno']['APELLIDO_PAT'].' '. $alumno['Alumno']['APELLIDO_MAT']) .' | '.date('d-m-Y H:i');?></h2></td>
	</tr>
</table><br>
<table class="table table-hover table-striped">
	<thead>
		<tr>
			<th  style="width: 10%;" class="td-app text-center">Fecha de Clase</th>
			<th class="td-app text-center">Modalidad Clases</th>
			<th class="td-app text-center">Horario</th>
			<th class="td-app text-left">Docente</th>
			<th class="td-app text-center">Tipo</th>
			<th style="width: 10%;" class="td-app text-center">Asistencia</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($programacion_clases as $key => $value): ?>
			<tr>
				<td class="text-center"><?php echo date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></td>
				<td class="text-center"><strong><?php echo $value['ProgramacionClase']['MODALIDAD']; ?></strong></td>
				<td class="text-center">
					<?php 
						echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).'-'.
						date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); 
					?>
				</td>
				<td class="text-left">
					<?php 
						echo utf8_encode($value['Docente']['NOMBRE'].' '.
						$value['Docente']['APELLIDO_PAT'].' '.
						$value['Docente']['APELLIDO_MAT']); 
					?>	
				</td>
				<td class="text-center">
					<span class="" ><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></span>
				</td>
				<td class="text-center">
					<?php if ($value['ProgramacionClase']['WF_ESTADO_ID']>2): ?>
						<?php
								if ( $value['Asistencia']['ASISTENCIA']=='' ): ?>	
									<span class="badge" >No Registra</span>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==0 ): ?>
									<span class="badge" >NO</span>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==1 ): ?>
									<span class="badge" >SI</span>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==2 ): ?>
								<span class="badge" >JUSTIFICADO</span>
						<?php endif ?>
					<?php else: ?>
						<span class="badge" >No Impartida</span>
					<?php endif ?>
				</td>
			</tr>
		<?php endforeach ?>
	</tbody>
</table>