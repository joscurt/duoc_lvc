<div class="modal-header">
	<h2 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Listado Docentes con Tope de Horario</h2>
	<p><?php echo count($docentes);?> Docentes con tope</p>
</div>
<div class="modal-body">
    <div class="row">
<div class="col-md-12">
	<table class="table table-striped" >
		<thead >
			<tr>
				<th style="text-align: center;">Rut</th>
				<th style="text-align: center;">Nombres</th>
				<th style="text-align: center;">Apellidos</th>
				<th style="text-align: center;">Correo</th>
				<th style="text-align: center;">ID</th>
			</tr>
		</thead>
		<tbody>
			<?php foreach($docentes as $key => $docente){ ?>
				<tr>
					<td style="text-align: center;"><?php echo $docente['A']['RUT'].'-'.$docente['A']['DV']; ?></td>
					<td style="text-align: center;"><?php echo ($docente['A']['NOMBRE']); ?></td>
					<td style="text-align: center;"><?php echo ($docente['A']['APELLIDO_PAT']).' '.($docente['A']['APELLIDO_MAT']); ?></td>
					<td style="text-align: center;"><?php echo $docente['A']['CORREO']; ?></td>
					<td style="text-align: center;"><?php echo $docente['A']['ID'] ?></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div></div></div>