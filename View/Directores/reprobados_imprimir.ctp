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
		<td>
			<?php echo $this->Html->image('duocuc.png',array('style'=>'width:150px;')) ?>
		</td>
		<td><h2 class="titulo">REPROBADOS INASISTENCIA</h2></td>
	</tr>
</table>
<br>
<!-- <h3 style="border-bottom:1px solid #ddd;" ></h3>
<br> -->
<div class="row">
	<div class="col-md-12">
		<table class="table " >
            <thead>
                <tr>
                    <th>&nbsp;</th>
                    <th>Nombre Asignatura</th>
                    <th class="una-linea">Sigla-Sección</th>
                    <th>Jornada</th>
                    <th class="una-linea">Rut docente</th>
                    <th>Apellido Paterno</th>
                    <th>Apellido Materno</th>
                    <th>Nombres</th>
                    <th>N° Clases Registradas </th>
                    <th>Asistencia Promedio</th>
                </tr>
            </thead>
            <tbody>
                <?php $count = 0; foreach ($datos_tabla as $key => $value): $count++; ?>
                    <tr>
                        <td><?php echo $count; ?></td>
                        <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
                        <td><?php echo $value['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
                        <td><?php echo $value['AsignaturaHorario']['COD_JORNADA']; ?></td>
                        <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
                        <td><?php echo $value['Docente']['APELLIDO_PAT']; ?></td>
                        <td><?php echo $value['Docente']['APELLIDO_MAT']; ?></td>
                        <td><?php echo $value['Docente']['NOMBRE']; ?></td>
                        <td><?php echo $value['AsignaturaHorario']['CLASES_REGISTRADAS']; ?></td>
                        <td><?php echo (float)$value['AsignaturaHorario']['ASIST_PROMEDIO'].'%'; ?></td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
	</div>
</div>
