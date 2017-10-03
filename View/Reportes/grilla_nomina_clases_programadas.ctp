<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
		<label for="" class="">Ordenar por:</label>
			<select name="data[Filter][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
				<option value="" >Seleccionar</option>
				<option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut docente</option>
				<option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno docente</option>
				<option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno docente</option>
				<option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre docente</option>
				<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
				<option value="ProgramacionClase.SIGLA_SECCION" <?php echo $ordenar == 'ProgramacionClase.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Secci&oacute;n</option>
				<option value="ProgramacionClase.HORA_INICIO" <?php echo $ordenar == 'ProgramacionClase.HORA_INICIO' ? 'selected="selected"':''; ?>>Horario</option>
				<option value="ProgramacionClase.TIPO_EVENTO" <?php echo $ordenar == 'ProgramacionClase.TIPO_EVENTO' ? 'selected="selected"':''; ?>>Tipo</option>
				<option value="ProgramacionClase.SALA" <?php echo $ordenar == 'ProgramacionClase.SALA' ? 'selected="selected"':''; ?>>Sala</option>
				<option value="Detalle.DETALLE" <?php echo $ordenar == 'Detalle.DETALLE' ? 'selected="selected"':''; ?>>Detalle</option>
				<option value="Estado.NOMBRE" <?php echo $ordenar == 'Estado.NOMBRE' ? 'selected="selected"':''; ?>>Estado</option>
				<option value="SubEstado.NOMBRE" <?php echo $ordenar == 'SubEstado.NOMBRE' ? 'selected="selected"':''; ?>>Sub-Estado</option>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th class="una-linea">Fecha</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Secci&oacute;n</th>
					<th class="una-linea">Rut docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th>Sala</th>
					<th>Horario</th>
					<th>Tipo</th>
					<th>Detalle</th>
					<th>Estado</th>
					<th>Sub-Estado</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
		  			foreach ($registros as $key => $value): ?>
				  	<tr>
					    <td><?php echo $key+1; ?></td>
					    <td><?php echo date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></td>
					    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
					    <td><?php echo $value['ProgramacionClase']['SIGLA_SECCION']; ?></td>
					    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
					    <td><?php echo utf8_encode($value['Docente']['APELLIDO_PAT']); ?></td>
					    <td><?php echo utf8_encode($value['Docente']['APELLIDO_MAT']); ?></td>
					    <td><?php echo utf8_encode($value['Docente']['NOMBRE']); ?></td>
					    <td><?php echo !empty($value['Sala']['TIPO_SALA'])?$value['Sala']['TIPO_SALA']:$value['SalaReemplazo']['TIPO_SALA']; ?></td>
					    <td>
					    	<?php 
					    		echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).' a '.
					    		date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); 
					    	?>	
					    </td>
					    <td><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></td>
					    <td><?php echo $value['Detalle']['DETALLE']; ?></td>
					    <td><?php echo $value['Estado']['NOMBRE']; ?></td>
					    <td><?php echo $value['SubEstado']['NOMBRE']; ?></td>
				  	</tr>
			  	<?php endforeach; ?>
		  	</tbody>
		</table>
	</div>
	<div class="col-md-12">
		<div class="form-group">
			<form id="form-exportar" method="POST" target="_blank">
				<?php 
					foreach ($datos_filtro['Filtro'] as $key => $value):
						echo "<input type='hidden' name='data[Filtro][".$key."]' value='".$value."' />";
					endforeach; 
				?>
				<button 
					class="btn btn-success btn-exportable" 
					href="<?php echo $this->Html->url(array('action'=>'excelNominaClasesProgramadas')); ?>"
					><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
				<button 
					class="btn btn-success btn-exportable" 
					href="<?php echo $this->Html->url(array('action'=>'pdfNominaClasesProgramadas')); ?>"
					><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</button>
				<button 
					class="btn btn-success btn-exportable" 
					target="_blank"
					href="<?php echo $this->Html->url(array('action'=>'imprimirNominaClasesProgramadas')); ?>"
					><i class="fa fa-print"></i>&nbsp;Imprimir</button>
			</form>
		</div>
	</div>
</div>
<script>
	$('.btn-exportable').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		if ($('#select-order').val()!= '') {
			$('#form-exportar').append("<input type='hidden' name='data[ordenar]' value='"+$('#select-order').val()+"' />");
		}
		$('#form-exportar').attr('action',elemento_click.attr('href'));
		$('#form-exportar').submit();
	});
	$('#select-order').selectpicker();
	$('#select-order').on('change', function(event) {
        event.preventDefault();
        $('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
        $('#form-filtro-basico').submit();
    });
</script>