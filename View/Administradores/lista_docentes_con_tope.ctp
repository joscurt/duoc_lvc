<div class="col-md-12">
	<h4>Listado Docentes</h4>
	<h6 class="subtitle"><?php echo count($docentes);?> de <?php echo count($docentes); ?> Docentes con tope</h6>
</div>
<<?php 
#debug($this->getLastQuery());exit();
?>
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
					<td style="text-align: center;"><?php echo $docente['A']['NOMBRE']; ?></td>
					<td style="text-align: center;"><?php echo $docente['A']['APELLIDO_PAT'].' '.$docente['A']['APELLIDO_MAT']; ?></td>
					<td style="text-align: center;"><?php echo $docente['A']['CORREO']; ?></td>
					<td style="text-align: center;"><?php echo $docente['A']['ID'] ?></td>

				</tr>
			<?php } ?>
		</tbody>
	</table>
</div>