<div class="row">
	<div class=" col-md-2">
		<div class="form-group">
			<label for="">SEDE</label>
			<p class="c-black f-500 m-b-20">
				<?php echo isset($asignatura_horario['Sede']['NOMBRE'])?$asignatura_horario['Sede']['NOMBRE']:null;  ?>
			</p>
		</div>
	</div>
	<div class="col-md-4">
		<div class="form-group">
			<label for="">NOMBRE ASIGNATURA</label>
			<p class="c-black f-500 m-b-20">
				<?php echo isset($asignatura_horario['Asignatura']['NOMBRE'])?$asignatura_horario['Asignatura']['NOMBRE']:null;  ?>
			</p>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="">SIGLA-SECCIÓN</label>
			<p class="c-black f-500 m-b-20">
				<?php echo isset($asignatura_horario['AsignaturaHorario']['SIGLA_SECCION'])?$asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']:null;  ?>
			</p>
		</div>
	</div>
	<div class="col-md-2">
		<div class="form-group">
			<label for="">JORNADA</label>
			<p class="c-black f-500 m-b-20">
				<?php echo isset($asignatura_horario['AsignaturaHorario']['COD_JORNADA']) && $asignatura_horario['AsignaturaHorario']['COD_JORNADA']=='V'?'VESPERTINA':'DIURNA';  ?>
			</p>
		</div>
	</div>
</div>
