
<p>Estimado(a) <strong><?php echo $docente_reemplazo['Docente']['NOMBRE'].' '.$docente_reemplazo['Docente']['APELLIDO_PAT'].' '.$docente_reemplazo['Docente']['APELLIDO_MAT'] ?></strong>,</p>
<br>
<p>Según lo coordinado con usted, realizará un reemplazo docente según lo siguiente:<p>
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
		<td <?php echo $class_label; ?> >Horario</td>
		<td <?php echo $class_dato; ?> >
			<?php 
				echo date('H:i',strtotime($clase['ProgramacionClase']['HORA_INICIO'])).
				' a '. date('H:i',strtotime($clase['ProgramacionClase']['HORA_FIN'])); 
			?>
		</td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Sala</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['SALA']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Motivo</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['MotivoInasistenciaDocente']['MOTIVO']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Observaciones</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['ProgramacionClase']['OBS_SOLICITUD_RECUPERACION']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Docente</td>
		<td <?php echo $class_dato; ?> ><?php echo $docente_titular['Docente']['NOMBRE'].' '.$docente_titular['Docente']['APELLIDO_PAT'].' '.$docente_titular['Docente']['APELLIDO_MAT'] ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Docente Reemplazo</td>
		<td <?php echo $class_dato; ?> ><?php echo $docente_reemplazo['Docente']['NOMBRE'].' '.$docente_reemplazo['Docente']['APELLIDO_PAT'].' '.$docente_reemplazo['Docente']['APELLIDO_MAT'] ?></td>
	</tr>
</table>
<br>
<p>Para dudas y/o consultas favor dirigirse a su Coordinador Docente.</p>
<p>Atte.</p>
<p>Duoc UC</p>

