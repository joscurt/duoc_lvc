<div>	
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
							<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;">Modalidad Clase</td>
						</tr>
						<tr>
							<td colspan="2" class="rotar" style="text-align: center;background: #fff !important;"></td>
							<td colspan="4" class="td-app" style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;">Tipo</td>
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
							<th class="td-app" style="border-right: 1px solid #ddd !important;">Nº</th>
							<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Rut Alumno</th>
							<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Paterno</th>
							<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">A. Materno</th>
							<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Nombre</th>
							<th class="td-app" style="text-align: center; border-right: 1px solid #ddd !important;">Asistencia</th>
						</tr>
						<?php foreach ($alumnos as $key => $value): ?>
							<tr 
								data-num="<?php echo $key+1; ?>" 
								class="asistencia-data asistencia-data-1"
								style="height: 40px;">
								<td >

									<?php echo $key+1; ?>
								</td>
								<td ><?php echo $value['Alumno']['RUT'] ?></td>
								<td ><?php echo strtoupper($value['Alumno']['APELLIDO_PAT']); ?></td>
								<td ><?php echo strtoupper($value['Alumno']['APELLIDO_MAT']); ?></td>
								<td >
									<a 
										style="cursor: pointer; " 
										data-dd="<?php echo $value['Alumno']['ID']; ?>"
										class="alumno_active"><?php echo strtoupper($value['Alumno']['NOMBRES']); ?></a>
								</td>
								<?php 
									$clases_presente = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_PRESENTE']:0;
									$clases_totales = isset($indicadores[$value['Alumno']['ID']])?$indicadores[$value['Alumno']['ID']]['CLASES_IMPARTIDAS']:0;
									
									if ($clases_totales == 0 )
										{ 
											$porcentaje = 0;
										}
										else { $porcentaje = round($clases_presente*100/$clases_totales); }

									#debug($porcentaje);exit();

								?>
								<td style="font-weight: bold; color:<?php echo $porcentaje<75?'red':null; ?>;"><?php echo $porcentaje.'%'; ?></td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		<div class="col-md-7 table-responsive p-l-0">
        <?php
		#debug($programacion_clases)."<br>";
		 ?>
		 <!-- Tabla clases grilla por clase /////////////////////////////////////////////////////////////////// -->
			<table class="table table-striped table-bordered table-hover" id="table-todo-asistencia"> 
				<thead>
					<tr>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<th 
								class="on-select" 
								style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important; cursor:pointer;"
								programacion-cod = "<?php echo $value['ProgramacionClase']['COD_PROGRAMACION']; ?>"
							>
								<?php echo $key+1; ?>
							</th>
						<?php endforeach ?>
					</tr>
				</thead>
				<tbody id="tbody_todo">
					<tr>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td 
								class="rotar" 
								style="text-align: center;border-right: 1px solid #ddd !important; text-transform:uppercase"
								programacion-cod = "<?php echo $value['ProgramacionClase']['COD_PROGRAMACION']; ?>"
							>
								<?php echo substr($value['ProgramacionClase']['MODALIDAD'],0,2); ?></td>
						<?php endforeach ?>
					</tr>
					<tr>
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td 
								class="rotar"
							 	style="text-align: center;border-left: 1px solid #ddd !important;border-right: 1px solid #ddd !important;"
							 	programacion-cod = "<?php echo $value['ProgramacionClase']['COD_PROGRAMACION']; ?>"
							 >
							 	R</td>
						<?php endforeach ?>
					</tr>
					<tr style="height: 60px;">
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td 
								class="rotar_fecha"
								style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"
								programacion-cod = "<?php echo $value['ProgramacionClase']['COD_PROGRAMACION']; ?>"
							>
								<label class="fecha"><?php echo date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></label>
							</td>
						<?php endforeach ?>
					</tr>
					<tr style="height: 60px;">
						<?php foreach ($programacion_clases as $key => $value): ?>
							<td 
								class="rotar_fecha" 
								style="text-align: center;border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"
								programacion-cod = "<?php echo $value['ProgramacionClase']['COD_PROGRAMACION']; ?>"
							>
								<label class="fecha"><?php echo !empty($value['ProgramacionClase']['FECHA_REGISTRO'])?date('d-m-y',strtotime($value['ProgramacionClase']['FECHA_REGISTRO'])):null; ?></label>
							</td>
						<?php endforeach ?>
					</tr>
					<tr >
						<?php foreach ($programacion_clases as $key => $value): ?>
							<?php 
								if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
									echo '<th class="td-app" programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #e67e22 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase Suspendida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
								}else if(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
									if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
										#GRIS
										echo '<th class="td-app" programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"  style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #c4c4c4;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase no impartida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
										#AMARILLO
										echo '<th class="td-app" programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"  style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #f1c40f !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase no registrada"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
									}else{
										echo '<th class="td-app" programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"  style="height:39px;text-align: center; border-right: 1px solid #ddd !important;"></th>';
									}
								}else{
									echo '<th class="td-app" programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;"></th>';
								}
								#echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important; background: #f1c40f !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Registrada"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
								#echo '<th class="td-app" style="height:39px;text-align: center; border-right: 1px solid #ddd !important;background: #c4c4c4 !important;"><a href="#" style="cursor: pointer;height: 100%;width: 100%;"data-rel="tooltip" title="Clase No Impartida"><i style="color:#fff;"class="fa fa-info"></i></a></th>';
							?>
						<?php endforeach; ?>
					</tr>
					<?php 
						$count= 0;
						foreach ($alumnos as $key => $alumno): 
							$count++;
						?>
						<tr data-num="<?php echo $key; ?>" class="asistencia asistencia-1" style="height: 40px;">
							<?php foreach ($programacion_clases as $key => $value): ?>
								<?php 
									if ($value['ProgramacionClase']['DETALLE_ID']==4 || $value['ProgramacionClase']['WF_ESTADO_ID']==5) {
										$text_suspendida = '';
										if ((count($alumnos)/2) == $count) {
											$text_suspendida = '<div class="clase">CLASE SUSPENDIDA</div>';
										}
										echo "<td programacion-cod='".$value['ProgramacionClase']['COD_PROGRAMACION']."'  style='vertical-align: middle;border-top:0!important; background: #e67e22;color: #fff;' >".$text_suspendida."</td>";
									}else if(strtotime(date('Y-m-d H:i')) > strtotime(date('Y-m-d H:i',strtotime($value['ProgramacionClase']['FECHA_CLASE'])))){
										if (is_null($value['ProgramacionClase']['WF_ESTADO_ID'])) {
											#GRIS
											$text_no_impartida = '';
											if ((count($alumnos)/2) == $count) {
												$text_no_impartida = '<div class="clase">CLASE NO IMPARTIDA</div>';
											}
											echo "<td programacion-cod='".$value['ProgramacionClase']['COD_PROGRAMACION']."' style='vertical-align: middle;border-top:0!important; background: #c4c4c4;color: #fff;' >".$text_no_impartida."</td>";
										}else if($value['ProgramacionClase']['WF_ESTADO_ID'] > 1 && $value['ProgramacionClase']['WF_ESTADO_ID'] != 4){
											#AMARILLO
											$text_no_registrada = '';
											if ((count($alumnos)/2) == $count) {
												$text_no_registrada = '<div class="clase">CLASE NO REGISTRADA</div>';
											}
											echo "<td programacion-cod='".$value['ProgramacionClase']['COD_PROGRAMACION']."' style='vertical-align: middle;border-top:0!important; background: #f1c40f;color: #fff;' >".$text_no_registrada."</td>";
										}else{
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
											}elseif($asistencia ==2){
											$asistencia = 'exclamation-circle';
											$color = 'green';
											}								
											echo '<td programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'" class="rotar" style=" text-align: center; border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"><i '.$color.' class="fa fa-'.$asistencia.'"></i></td>';
										}
									}else{
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
										echo '<td programacion-cod="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'" class="rotar" style=" text-align: center; border-right: 1px solid #ddd !important;border-left: 1px solid #ddd !important;"><i '.$color.' class="fa fa-'.$asistencia.'"></i></td>';
									}
									
								?>
							<?php endforeach; ?>
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<p><strong>* Se muestra todos los eventos asociados a la Asignatura/Sección</strong></p>
			<p><strong>* Asistencia: Porcentaje de asistencia promedio del Alumno a la fecha de un nuevo registro (asistencia).</strong></p>
			<p>
				<ul class="ul-leyenda-colores">
					<li><div class="leyenda-color naranjo"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase suspendida</span></li>
					<li><div class="leyenda-color amarillo"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase no registrada</span></li>
					<li><div class="leyenda-color gris"> </div> <span style="vertical-align:middle;display:inline-block;margin-top:5px;">Clase no impartida</span></li>
				</ul>
			</p>
		</div>
	</div>
	<div class="row m-t-30 m-b-30">
		<div class="col-md-12" align="center">
			<a 
				class="btn btn-sm btn-info" 
				href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])) ?>"
				><i class="fa fa-arrow-left"></i>&nbsp;Volver a Eventos</a>
			<a
				id="btn-exportar-excel" 
				class="btn btn-sm btn-default" 
				href="#"
				><i  style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR A EXCEL</a>	
			<a 
				id="btn-exportar-pdf"
				class="btn btn-sm btn-default" 
				href="#"
				><i  style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;EXPORTAR A PDF</a>	
		</div>
	</div>
</div>
<script>
	$('a[data-rel="tooltip"]').tooltip();
	$('.on-select').on('click',function(event){
		event.preventDefault();
		var cod = $(this).attr('programacion-cod');
		$('th, td').removeClass('active');
		$('th[programacion-cod="'+cod+'"], td[programacion-cod="'+cod+'"]').addClass('active');
	});
	$('.alumno_active').on('click',function(event) {
		event.preventDefault();
		cod_alumno = $(this).attr('data-dd');
		if (cod_alumno!='' && cod_alumno!=undefined) {
			$('#select-change-alumno').selectpicker('val', cod_alumno);
			$('#select-change-alumno').selectpicker('refresh');
			$('#select-change-alumno').trigger('change');
			$('a[href="#ver_alumno"]').trigger('click');
		}
	});



	$('#btn-exportar-pdf').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'historicoAsistenciaTodoPdf',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>
		window.location ='<?php echo $url ?>' ;
	});

	$('#btn-exportar-excel').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'historicoAsistenciaTodoExcel',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>
		window.location ='<?php echo $url ?>' ;
		setTimeout(function(){ 
			$('#elementLoader').hide();
		}, 3000);
	});



</script>