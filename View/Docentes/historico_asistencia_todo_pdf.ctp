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
	.ul-leyenda-colores{
		list-style: none;
		margin-left: 0;
		padding-left: 5px;
	}
	.ul-leyenda-colores li{
		display: inline-block;
		margin-right: 30px;
	}
	.ul-leyenda-colores div.leyenda-color{
		border-radius: 5px;
		border: 1px solid #c4c4c4;
		display:inline-block; 
		height: 30px;
		margin-top: 4px;
		vertical-align: middle;
		width: 30px;
	}
	.ul-leyenda-colores div.leyenda-color.naranjo{background: #e67e22;}
	.ul-leyenda-colores div.leyenda-color.amarillo{background: #f1c40f;}
	.ul-leyenda-colores div.leyenda-color.gris{background: #c4c4c4;}
</style>
<table style="border-bottom:1px solid #ccc;">
	<tr >
		<td><img src="img/duocuc.png" style="width:150px;" alt=""></td>
		<td><h2 class="titulo">CURSO  <?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'].' | '.date('d-m-Y H:i');?></h2></td>
	</tr>
</table><br>
<div class="row">
	<div class="col-md-5 p-r-0">
		<div class="div-contenedor-1">
			<table class="table table-striped table-bordered table-hover table-con-scroll" id="table-todo">
				<tbody id="tbody_todo">
					<tr>
						<td colspan="2" class="" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<th colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Numero Clase</th>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<th class="" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"><?php echo $key+1; ?></th>
						<?php endforeach ?>
					</tr>
					<tr>
						<td colspan="2" class="rotar" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;">Modalidad Clase</td>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td class="rotar" style="text-align: center;border-right: 1px solid #ddd !important;"><?php echo substr($value['ProgramacionClase']['MODALIDAD'],0,2); ?></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<td colspan="2" class="rotar" style="text-align: center;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Tipo</td>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td class="rotar" style="text-align: center;border-left: 1px solid #ddd !important;border-right: 1px solid #ddd !important;">R</td>
						<?php endforeach ?>
					</tr>
					<tr style="height: 60px;">
						<td colspan="2" class="app" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Fecha de Clase</td>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td class="rotar_fecha" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">
								<label class="fecha"><?php echo date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></label>
							</td>
						<?php endforeach ?>
					</tr>
					<tr style="height: 60px;">
						<td colspan="2" class="app" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;border-bottom: 1px solid #ddd !important;">Fecha Registro de Asistencia</td>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td class="rotar_fecha" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">
								<label class="fecha"><?php echo !empty($value['ProgramacionClase']['FECHA_REGISTRO'])?date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_REGISTRO'])):null; ?></label>
							</td>
						<?php endforeach ?>
					</tr>
					<tr>
						<th class="td-app" style="border-right: 1px solid #ddd !important;">N&deg;</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Rut Alumno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Paterno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Materno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Nombre</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Asistencia</th>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<?php 
								if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #e67e22 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase Suspendida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
								}else if(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
									if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
										#GRIS
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #c4c4c4 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase no impartida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
										#AMARILLO
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #f1c40f !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase no registrada"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									}else{
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;"></th>';
									}
								}else{
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;"></th>';
								}
							?>
						<?php endforeach; ?>
					</tr>
					<?php $count_alumnos = count($alumnos); $count= 0; foreach ($alumnos as $key => $alumno): $count++;?>
						<tr 
							data-num="<?php echo $key+1; ?>" 
							class="asistencia-data asistencia-data-1"
							style="height: 40px;">
							<td ><?php echo $key+1; ?></td>
							<td ><?php echo $alumno['Alumno']['RUT'] ?></td>
							<td ><?php echo utf8_encode(strtoupper($alumno['Alumno']['APELLIDO_PAT'])); ?></td>
							<td ><?php echo utf8_encode(strtoupper($alumno['Alumno']['APELLIDO_MAT'])); ?></td>
							<td >
								<?php echo utf8_encode(strtoupper($alumno['Alumno']['NOMBRES'])); ?>
							</td>
							<?php 
								$clases_presente = isset($indicadores[$alumno['Alumno']['ID']])?$indicadores[$alumno['Alumno']['ID']]['CLASES_PRESENTE']:0;
								$clases_totales = isset($indicadores[$alumno['Alumno']['ID']])?$indicadores[$alumno['Alumno']['ID']]['CLASES_IMPARTIDAS']:0;
								$porcentaje = round($clases_presente*100/$clases_totales);

							?>
							<td style="font-weight: bold; color:<?php echo $porcentaje<75?'red':null; ?>;"><?php echo $porcentaje.'%'; ?></td>
							<?php foreach ($programacion_clases as $value): ?>
								<?php 
									if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
										$text_suspendida = '';
										if (($count_alumnos/2) == $count) {
											$text_suspendida = '<div class="clase">CLASE SUSPENDIDA</div>';
										}
										echo "<td  style='vertical-align: middle;border-top:0!important; background: #e67e22;color: #fff;' >".$text_suspendida."</td>";
									}else if(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
										if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
											#GRIS
											$text_no_impartida = '';
											if ((count($alumnos)/2) == $count) {
												$text_no_impartida = '<div class="clase">CLASE NO IMPARTIDA</div>';
											}
											echo "<td  style='vertical-align: middle;border-top:0!important; background: #c4c4c4;color: #fff;' >".$text_no_impartida."</td>";
										}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
											#AMARILLO
											$text_no_registrada = '';
											if ((count($alumnos)/2) == $count) {
												$text_no_registrada = '<div class="clase">CLASE NO REGISTRADA</div>';
											}
											echo "<td  style='vertical-align: middle;border-top:0!important; background: #f1c40f;color: #fff;' >".$text_no_registrada."</td>";
										}else{
											$asistencia = isset($alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']])? $alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']]:null;
											$color = '';
											if (is_null($asistencia)) {
												$asistencia = '';
											}elseif($asistencia ==1){
												$asistencia = 'x';
											}elseif($asistencia ==0){
												$asistencia = '';
											}elseif($asistencia ==2){
												$asistencia = 'J';
											}

											echo '<td class="rotar" style=" text-align: center; border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">'.$asistencia.'</td>';
										}
									}else{
										$asistencia = isset($alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']])? $alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']]:null;
										$color = '';
										if (is_null($asistencia)) {
											$asistencia = '';
										}elseif($asistencia ==1){
											$asistencia = 'x';
										}elseif($asistencia ==0){
											$asistencia = '';
										}
										elseif($asistencia ==2){
											$asistencia = 'J';
										}
										echo '<td class="rotar" style=" text-align: center; border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">'.$asistencia.'</td>';
									}
									
								?>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<p><strong>* Se muestra todos los eventos asociados a la Asignatura/Secci&oacute;n</strong></p>
		<p><strong>* Asistencia: Porcentaje de asistencia promedio del Alumno a la fecha de un nuevo registro (asistencia).</strong></p>
		<!-- <p>
			<ul class="ul-leyenda-colores">
				<li><div class="leyenda-color naranjo"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase suspendida</span></li>
				<li><div class="leyenda-color amarillo"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase no registrada</span></li>
				<li><div class="leyenda-color gris"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase no impartida</span></li>
			</ul>
		</p> -->
	</div>
</div>