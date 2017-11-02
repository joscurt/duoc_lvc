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
		<td><h2 class="titulo">CURSO  <?php echo ($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']).' | '.date('d-m-Y H:i');?></h2></td>
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
					</tr>
					<tr>
						<td colspan="2" class="rotar" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;">Tipo Clase</td>
					</tr>
					<tr>
						<td colspan="2" class="rotar" style="text-align: center;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Registro de Clase</td>
					</tr>
					<tr style="height: 60px;">
						<td colspan="2" class="app" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Fecha de Clase</td>
					</tr>
					<tr style="height: 60px;">
						<td colspan="2" class="app" style="text-align: center;border-top:1px solid #fff !important;background: #fff !important;"></td>
						<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;border-bottom: 1px solid #ddd !important;">Fecha Registro de Asistencia</td>
					</tr>
					<tr>
						<th class="td-app" style="border-right: 1px solid #ddd !important;">N&deg;</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Rut Alumno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Nombre</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Paterno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Materno</th>
						<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Asistencia</th>
					</tr>
					<?php foreach ($alumnos as $key => $value): ?>
						<tr 
							data-num="<?php echo $key+1; ?>" 
							class="asistencia-data asistencia-data-1"
							style="height: 40px;">
							<td ><?php echo $key+1; ?></td>
							<td ><?php echo $value['Alumno']['RUT'] ?></td>
							<td >
								<a 
									style="cursor: pointer; " 
									data-dd="<?php echo $value['Alumno']['ID']; ?>"
									class="alumno_active"><?php echo strtoupper(htmlentities($value['Alumno']['NOMBRES'])); ?></a>
							</td>
							<td ><?php echo strtoupper(htmlentities($value['Alumno']['APELLIDO_PAT'])); ?></td>
							<td ><?php echo strtoupper(htmlentities($value['Alumno']['APELLIDO_MAT'])); ?></td>
							<?php 
								$clases_presente = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:0;
								$clases_totales = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS']:0;
								$porcentaje = round($clases_presente*100/$clases_totales);

							?>
							<td style="font-weight: bold; color:<?php echo $porcentaje<75?'red':null; ?>;"><?php echo $porcentaje.'%'; ?></td>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="col-md-7 table-responsive p-l-0">
		<table class="table table-striped table-bordered table-hover" id="table-todo-asistencia">
			<thead>
				<tr>
					<?php foreach ($programacion_clases as $key => $value): ?>
						<th class="" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"><?php echo $key+1; ?></th>
					<?php endforeach ?>
				</tr>
			</thead>
			<tbody id="tbody_todo">
				<tr>
					<?php foreach ($programacion_clases as $key => $value): ?>
						<td class="rotar" style="text-align: center;border-right: 1px solid #ddd !important;"><?php echo $value['ProgramacionClase']['MODALIDAD']=='TEORICO'?'TEO':'PRA'; ?></td>
					<?php endforeach ?>
				</tr>
				<tr>
					<?php foreach ($programacion_clases as $key => $value): ?>
						<td class="rotar" style="text-align: center;border-left: 1px solid #ddd !important;border-right: 1px solid #ddd !important;">R</td>
					<?php endforeach ?>
				</tr>
				<tr style="height: 60px;">
					<?php foreach ($programacion_clases as $key => $value): ?>
						<td class="rotar_fecha" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">
							<label class="fecha"><?php echo date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></label>
						</td>
					<?php endforeach ?>
				</tr>
				<tr style="height: 60px;">
					<?php foreach ($programacion_clases as $key => $value): ?>
						<td class="rotar_fecha" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">
							<label class="fecha"><?php echo !empty($value['ProgramacionClase']['FECHA_REGISTRO'])?date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_REGISTRO'])):null; ?></label>
						</td>
					<?php endforeach ?>
				</tr>
				<tr >
					<?php foreach ($programacion_clases as $key => $value): ?>
						<?php 
							switch($value['ProgramacionClase']['ID']){
								case '':
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #e67e22 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase Suspendida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important; background: #f1c40f !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Registrada"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #c4c4c4 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Impartida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									break;
								default:
									echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;"></th>';
									break;
							}
						?>
					<?php endforeach; ?>
				</tr>
				<?php  $count = 6; ?>
				<?php foreach ($alumnos as $key => $alumno): ?>
					<tr data-num="<?php echo $key; ?>" class="asistencia asistencia-1" style="height: 40px;">
						<?php foreach ($programacion_clases as $key => $value): ?>
							<?php 
								$asistencia = isset($alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']])? $alumno['Asistencia'][$value['ProgramacionClase']['COD_PROGRAMACION']]:null;
								$color = '';
								if (is_null($asistencia)) {
									$asistencia = '';
								}elseif($asistencia ==1){
									$asistencia = 'check';
									$color = 'green';
								}elseif($asistencia ==0){
									$asistencia = 'times';
									$color = 'red';
								}
								switch($value['ProgramacionClase']['ID']){
									case '':
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #e67e22 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase Suspendida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important; background: #f1c40f !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Registrada"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
										echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #c4c4c4 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Impartida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
										break;
									default:
										echo '<td class="rotar" style=" text-align: center; border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"><i '.$color.' class="fa fa-'.$asistencia.'"></i></td>';
										break;
								}
							?>
						<?php endforeach; ?>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
	</div>
</div>