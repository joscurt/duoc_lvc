<div class="modal-header">
    <h2 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Tope Horario</h2>
    <p><?php echo $count_topes; ?> de <?php echo count($alumnos); ?> alumnos presentan tope de horario</p>
</div>
<div class="modal-body">
    <div class="row">
    	<div class="col-md-12">
    		<table class="table table-striped">
				<thead>
					<tr>
						<th></th>
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
    </div>
</div>
<div class="modal-footer">
    <div class="row">
    	<div class="col-md-12">
    		<button type="button" class="btn btn-success" data-dismiss="modal">SALIR</button>
    	</div>
    </div>
</div>