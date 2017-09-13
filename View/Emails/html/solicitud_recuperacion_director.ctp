<p>Estimado(a) Director <strong><?php echo $director['NOMBRES'].' '.$director['APELLIDO_PAT'].' '.$director['APELLIDO_MAT']; ?></strong>:</p>
<br>
<p>Se ha creado una solicitud para recuperar una clase según lo siguiente:</p>
<?php
	$class_label = 'style="background:rgb(140, 135, 135);color:white;border:1px solid #c4c4c4;padding:3px 10px 3px 3px; width:80px;"';
	$class_dato = 'style="border:1px solid #c4c4c4;padding:3px 3px 3px 10px; font-weight:900"';
?>
<table id="tabla-send-info-mail" cellpadding="0" cellspacing="0" style="width:80%"; >
	<tr>
		<td <?php echo $class_label; ?> >Sede</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['Sede']['NOMBRE']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Sigla-Sección</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['SIGLA_SECCION']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Fecha</td>
		<td <?php echo $class_dato; ?> ><?php echo date('d-m-Y',strtotime($clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Tipo Clase</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['PRESENCIAL']==1 ? 'Presencial':'Virtual'; ?></td>
	</tr>
	<?php if($clase['ProgramacionClase']['PRESENCIAL']==1): ?>
		<tr>
			<td <?php echo $class_label; ?> >Horario</td>
			<td <?php echo $class_dato; ?> >
				<?php 
					echo date('H:i',strtotime($clase['ProgramacionClase']['HORA_INICIO'])).
					' a '. date('H:i',strtotime($clase['ProgramacionClase']['HORA_FIN'])); 
				?>
			</td>
		</tr>
		<tr>
			<td <?php echo $class_label; ?> >Modulos a Recuperar</td>
			<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?></td>
		</tr>
	<?php endif; ?>
	<tr>
		<td <?php echo $class_label; ?> >Docente</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['Docente']['NOMBRE'].' '.$clase['Docente']['APELLIDO_PAT'].' '.$clase['Docente']['APELLIDO_MAT'] ?></td>
	</tr>
	<?php if($clase['ProgramacionClase']['PRESENCIAL']==1): ?>
		<tr>
			<td <?php echo $class_label; ?> >Sala</td>
			<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['SALA']; ?></td>
		</tr>
	<?php endif; ?>
	<tr>
		<td <?php echo $class_label; ?> >Motivo</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['MotivoSolicitudRecuperacion']['MOTIVO']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Observaciones</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['OBS_SOLICITUD_RECUPERACION']; ?></td>
	</tr>
</table>
<br>
<p>La respuesta de la <b>autorización</b> o <b>rechazo</b> será entregada por parte de su Director de Carrera.</p>
<p>Atte.</p>
<p>Duoc UC</p>