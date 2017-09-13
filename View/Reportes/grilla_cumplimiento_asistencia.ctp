<?php echo $this->Html->script('tablesorter'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
		<label for="" class="">Ordenar por:</label>
			<select name="data[Filter][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
				<option value="" >Seleccionar</option>
				<option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut Docente</option>
				<option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno </option>
				<option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno </option>
				<option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre Docente</option>
				<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre Asignatura</option>
				<option value="AsignaturaHorario.SIGLA_SECCION" <?php echo $ordenar == 'AsignaturaHorario.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Sección</option>
				<option value="clases_regulares" <?php echo $ordenar == 'clases_regulares' ? 'selected="selected"':''; ?> >Clases Regulares</option>
				<option value="clases_suspendidas" <?php echo $ordenar == 'clases_suspendidas' ? 'selected="selected"':''; ?> >Clases Suspendidas</option>
				<option value="clases_registradas" <?php echo $ordenar == 'clases_registradas' ? 'selected="selected"':''; ?> >Clases Registradas</option>
				<option value="porcentaje_cumplimiento" <?php echo $ordenar == 'porcentaje_cumplimiento' ? 'selected="selected"':''; ?> >Porcentaje Cumplimiento</option>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" id="table-list-cumplimiento-asistencia" >
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Sección</th>
					<th class="una-linea">Rut Docente</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th class="clases_regulares">Clases Regulares</th>
					<th class="clases_suspendidas">Clases Suspendidas</th>
					<th class="clases_registradas">Clases Registradas</th>
					<th class="porcentaje_cumplimiento">% Cumplimiento</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
		  			foreach ($registros as $key => $value): 
		  				$indicadores = isset($indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']])?$indicadores_sigla_seccion[$value['AsignaturaHorario']['COD_ASIGNATURA_HORARIO']]:array();
				?>
				  	<tr>
					    <td><?php echo $key+1; ?></td>
					    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
					    <td><?php echo $value['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
					    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
					    <td><?php echo utf8_encode ($value['Docente']['APELLIDO_PAT']); ?></td>
					    <td><?php echo utf8_encode ($value['Docente']['APELLIDO_MAT']); ?></td>
					    <td><?php echo utf8_encode ($value['Docente']['NOMBRE']); ?></td>
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
					    	<?php 
					    		$porcentaje = !empty($indicadores)?$indicadores['CLASES_REGISTRADAS']*100/$indicadores['CLASES_REGULARES']:null;
					    		echo !empty($porcentaje)? number_format($porcentaje,2,'.',',').'%':0; 
					    	?>
					    </td>
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
					href="<?php echo $this->Html->url(array('action'=>'excelCumplimientoAsistencia')); ?>"
					><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
				<button 
					class="btn btn-success btn-exportable" 
					href="<?php echo $this->Html->url(array('action'=>'pdfCumplimientoAsistencia')); ?>"
					><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</button>
				<button 
					class="btn btn-success btn-exportable" 
					href="<?php echo $this->Html->url(array('action'=>'imprimirCumplimientoAsistencia')); ?>"
					><i class="fa fa-print"></i>&nbsp;Imprimir</button>
			</form>
		</div>
	</div>
</div>
<script>
	$('#table-list-cumplimiento-asistencia').tablesorter({
		headers: { 
			0: {sorter: false}, 
			1: {sorter: false}, 
			2: {sorter: false},
			3: {sorter: false},
			4: {sorter: false},
			5: {sorter: false},
			6: {sorter: false},
			7: {lockedOrder: "asc"},
			8: {lockedOrder: "asc"},
			9: {lockedOrder: "asc"},
			10: {lockedOrder: "asc"},
		}
	});
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
        if (event.target.value == 'clases_regulares' || event.target.value == 'clases_suspendidas' || event.target.value == 'clases_registradas' || event.target.value == 'porcentaje_cumplimiento') {
			$('#table-list-cumplimiento-asistencia').find('th.'+event.target.value).trigger('sort');
        }else{
        	$('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
        	$('#form-filtro-basico').submit();
        }
    });
</script>