<style>
	html , body{
  		font-family: 'Roboto';
  		font-size : 0.94rem;
	}
	.titulo{
		color:#092c50;
	}
	table{
		width: 100% !important;
	}
	.table{
		border-spacing: 0;
  		border-collapse: collapse;
  		border: 1px solid #ddd !important;
	}
	.table th,
  	.table td {
    	border: 1px solid #ddd !important;
    	padding: 5px;
    	text-align: center;
  	}
  	.table  tbody  tr:nth-child(odd) {
  		background-color: #f9f9f9;
	}
</style>
<table style="border-bottom:1px solid #ccc;">
	<tr >
		<td><img src="img/duocuc.png" style="width:150px;" alt=""></td>
		<td><h4 class="titulo">CUMPLIMIENTO DE REGISTRO DE ASISTENCIA DOCENTE</h4></td>
	</tr>
</table>
<br>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Secci&oacute;n</th>
					<th class="una-linea">Rut Docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Clases Regulares</th>
					<th>Clases Suspendidas</th>
					<th>Clases Registradas</th>
					<th>% Cumplimiento</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
		  			foreach ($registros as $key => $value): 
		  				$indicadores = isset($indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']])?$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]:array();
				?>
				  	<tr>
					    <td><?php echo $key+1; ?></td>
					    <td><?php echo htmlspecialchars($value['Asignatura']['NOMBRE']); ?></td>
					    <td><?php echo htmlspecialchars($value['AsignaturaHorario']['SIGLA_SECCION']); ?></td>
					    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
					    <td><?php echo htmlspecialchars($value['Docente']['APELLIDO_PAT']); ?></td>
					    <td><?php echo htmlspecialchars($value['Docente']['APELLIDO_MAT']); ?></td>
					    <td><?php echo htmlspecialchars($value['Docente']['NOMBRE']); ?></td>
					    <td class="text-center" >
					    	<?php echo !empty($indicadores)? $indicadores['CLASES_REGULARES']:0; ?>
					    </td>
						<td class="text-center" >
							<?php echo !empty($indicadores)? $indicadores['CLASES_SUSPENDIDAS']:0; ?>
						</td>
					    <td>
					    	<?php echo !empty($indicadores)? $indicadores['CLASES_REGISTRADAS']:0; ?>
					    </td>
					    <td>
					    	<?php echo !empty($indicadores)? round(($indicadores['CLASES_REGISTRADAS']*100/$indicadores['CLASES_REGULARES']),2).'%':null; ?>
					    </td>
				  	</tr>
			  	<?php endforeach; ?>
		  	</tbody>
		</table>
	</div>
</div>
