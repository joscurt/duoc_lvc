<p>Estimado Coordinador(a) Docente <strong><?php echo $coordinador['CoordinadorDocente']['NOMBRES'].' '.$coordinador['CoordinadorDocente']['APELLIDO_PAT'].' '.$coordinador['CoordinadorDocente']['APELLIDO_MAT']; ?></strong>:</p>
<br>
<p>Se ha autorizado y agendado una clase de reforzamiento según lo siguiente:</p>
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
		<td <?php echo $class_label; ?> >Docente</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['Docente']['NOMBRE'].' '.$clase['Docente']['APELLIDO_PAT'].' '.$clase['Docente']['APELLIDO_MAT'] ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Estado</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['EstadoProgramacion']['NOMBRE'] .' a '.$clase['EstadoProgramacion']['NOMBRE']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Sub Estado</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['SubEstadoProgramacion']['NOMBRE'] .' a '.$clase['SubEstadoProgramacion']['NOMBRE']; ?></td>
	</tr>
	<tr>
		<td <?php echo $class_label; ?> >Detalle</td>
		<td <?php echo $class_dato; ?> ><?php echo $clase['Detalle']['DETALLE'] .' a '.$clase['Detalle']['DETALLE']; ?></td>
	</tr>
</table>
<br>
<p>Atte.</p>
<p>Duoc UC</p>