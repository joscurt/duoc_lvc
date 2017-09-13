<div class="col-md-12">
	<h4>Listado Alumnos</h4>
	<h6 class="subtitle"><?php echo $count_topes; ?> de <?php echo count($alumnos); ?> alumnos con tope</h6>
</div>
<div class="col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Rut</th>
				<th>Apellido Paterno</th>
				<th>Apellido Materno</th>
				<th>Nombres</th>
				<th>Tope</th>
			</tr>
		</thead>
		<tbody>
			<?php $contador = 0; foreach ($alumnos as $key => $alumno):  $contador++; ?>
				<tr>
					<td><?php echo $contador; ?></td>
					<td><?php echo $alumno['Alumno']['RUT'].'-'.$alumno['Alumno']['DV_RUT']; ?></td>
					<td><?php echo $alumno['Alumno']['APELLIDO_PAT']; ?></td>
					<td><?php echo $alumno['Alumno']['APELLIDO_MAT']; ?></td>
					<td><?php echo $alumno['Alumno']['NOMBRES']; ?></td>
					<td><?php echo $alumno['Alumno']['TIENE_TOPE']? '*':''; ?></td>
				</tr>
			<?php endforeach ?>
		</tbody>
	</table>
</div>