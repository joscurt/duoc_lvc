<div class="col-md-12">
	<h4>Listado Docentes</h4>
	<h6 class="subtitle"><?php echo count($docentes);?> de <?php echo count($docentes); ?> Docentes con tope</h6>
</div>

<div class="col-md-12">
	<table class="table table-striped">
		<thead>
			<tr>
				<th>Rut</th>
				<th>Nombres</th>
				<th>Usuario</th>
				<th>Correo</th>
				<th>ID</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($docentes as $key => $docente){ ?>
				<tr>
					<td><?php echo $docente['A']['RUT'].'-'.$docente['A']['DV']; ?></td>
					<td><?php echo $docente['A']['NOMBRE']; ?></td>
					<td><?php echo $docente['A']['USERNAME']; ?></td>
					<td><?php echo $docente['A']['CORREO']; ?></td>
					<td><?php echo $docente['A']['ID'] ?></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>