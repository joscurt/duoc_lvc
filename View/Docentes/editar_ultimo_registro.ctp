<br>
<div class="card" >
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SEDE</label>
					<p class="c-black f-500 m-b-20">Antonio Varas</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">CARRERA</label>
					<p class="c-black f-500 m-b-20">Ingeniería en Informatica</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SECCIÓN</label>
					<p class="c-black f-500 m-b-20">PL201202V</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">JORNADA</label>
					<p class="c-black f-500 m-b-20">Vespertina</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">NOMBRE ASIGNATURA</label>
					<p class="c-black f-500 m-b-20">Práctica Laboral</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">METODO</label>
					<p class="c-black f-500 m-b-20">PRÁCTICO</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h2>Editar Asistencia Alumnos<small>Edición de la asistencia.</small></h2>
	</div>
	<div class="card-body card-padding">
		<form action="">
			<div class="table-responsive" style="overflow: hidden;" tabindex="1">
				<table class="table table-striped table-hover table-docente">
					<thead>
						<tr>
							<th class="td-app">Numero Clase</th>
							<th class="td-app">Tipo Clase</th>
							<th class="td-app">Sala</th>
							<th class="td-app">Registro de Clase</th>
							<th class="td-app">Fecha Clase</th>
							<th class="td-app">Horario de Clase</th>
							<th class="td-app">Fecha de Registro</th>
							<th class="td-app">Editar Asistencia</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($array as $key =>$alu): ?>
							<tr>
								<td><?php echo $key+1;?></td>
								<td><span class="badge" style="background:#336E7B;"><?php echo strtoupper($alu['tipo_clase']);?></span></td>
								<td><?php echo strtoupper($alu['sala']);?></td>
								<td><?php echo strtoupper($alu['registro_clase']);?></td>
								<td><?php echo strtoupper($alu['fecha_clase']);?></td>
								<td><?php echo strtoupper($alu['horario']);?></td>
								<td><?php echo strtoupper($alu['fecha_registro']);?></td>
								<td style="text-align: center;">
									<?php if ($key == 0): ?>
										<a href="<?php echo $this->Html->url(array('action'=>'editarAsistencia')) ?>" data-rel="tooltip" title="Editar" class="btn btn-sm btn-warning"href=""><i class="fa fa-edit"></i></a>	
									<?php else: ?>
										<?php echo "---"; ?>
									<?php endif ?>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>	
		</form>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding" align="left">
		<a href="<?php echo $this->Html->url(array('action'=>'getEventos')) ?>"  class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i>&nbsp;Volver a Eventos</a>
	</div>
</div>