<?php 
	if (empty($alumno)) {
		exit();
	}
?>
<div class="row m-t-30" id="content-leyenda-pa" >
	<div class="col-md-12" align="center" style="margin-bottom: 20px;">
		<label class="checkbox checkbox-inline "style="left:0 !important;">
			<input disabled type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i>
			Alumno Presente
		</label>	
		<label class="checkbox checkbox-inline" style="left:0 !important;">
			<input disabled type="checkbox"  value="" name="data[Alumno][uuid]">
			<i class="input-helper"></i>Alumno Ausente</label>
		
<label class="checkbox checkbox-inline" style="left:0 !important;margin-left: -16px;">
			<i style="font-size: 16px;text-align: center;color: darkcyan;margin-right: 5px;" class="fa fa-exclamation-circle" aria-hidden="true"></i>Alumno Justificado	</label>
	</div>
</div>
<div class="row">
	<div class="col-md-12">
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


							#debug($value['Asistencia']['ASISTENCIA']);
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
							<span class="" style="text-align: center; padding:3px 5px;background-color:#DDD ;color:#000;"><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></span>
						</td>
						<td class="text-center">
							<?php if ($value['ProgramacionClase']['WF_ESTADO_ID']>2): ?>
								<?php if ( $value['Asistencia']['ASISTENCIA']=='' ): ?>	
									<span class="badge" style="background:#FFCCCC;color:red;">No registra</span>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==0 ): ?>
									<label class="checkbox checkbox-inline m-r-30">
										<input type="checkbox" disabled="disabled"><i class="input-helper"></i>
									</label>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==1 ): ?>
									<label class="checkbox checkbox-inline m-r-30">
										<input type="checkbox" checked="checked" disabled="disabled"><i class="input-helper"></i>
									</label>
								<?php elseif( $value['Asistencia']['ASISTENCIA']==2 ): ?>
									<label class="checkbox checkbox-inline m-r-30">
									<input type="checkbox" checked="checked" disabled="disabled"><i style="font-size: 20px;text-align: center;margin-right: 30px;color: darkcyan;" class="fa fa-exclamation-circle" aria-hidden="true"></i>
								</label>
								<?php endif ?>
							<?php else: ?>
								<span class="badge" style="background: #DDD;color:#000;">No Impartida</span>
							<?php endif ?>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="row" id="leyenda" style="margin-top: 3%;">
	<div class="col-md-12">
		<ul>
			<li>La "Asistencia" considera solo las Clases Regulares de la asignatura secci&oacute;n, descontando las clases suspendidas</li>
			<li>La "Asistencia Actual" considera la asistencia del alumno solo a las Clases Regulares en las que se ha registrado la asistencia</li>
		</ul>
	</div>
</div>
<div class="row m-t-30">
	<div class="col-md-12" align="center">
		<a class="btn btn-sm btn-info" 
			href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])) ?>"
			><i class="fa fa-arrow-left"></i>&nbsp;Volver a Eventos</a>
		<a class="btn btn-sm btn-default" 
			href="<?php echo $this->Html->url(array('action'=>'historicoAsistenciaPDF',$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],$alumno['Alumno']['ID'])); ?>"
			><i  style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;EXPORTAR A PDF</a>
		<a class="btn btn-sm btn-default" 
			href="<?php echo $this->Html->url(array('action'=>'historicoAsistenciaExcel',$value['ProgramacionClase']['COD_ASIGNATURA_HORARIO'],$alumno['Alumno']['ID'])); ?>"
			><i  style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR A EXCEL</a>	
	</div>
</div>