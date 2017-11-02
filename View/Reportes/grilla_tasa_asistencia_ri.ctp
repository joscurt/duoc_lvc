<?php echo $this->Html->script('tablesorter'); ?>
<div class="row">
	<div class="col-md-12">
		<div class="pull-right">
		<label for="" class="">Ordenar por:</label>
			<select  name="data[Filter][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
				<option value="" >Seleccionar</option>
				<option value="Alumno.RUT" <?php echo $ordenar == 'Alumno.RUT' ? 'selected="selected"':''; ?> >Rut Alumno</option>
				<option value="Alumno.APELLIDO_PAT" <?php echo $ordenar == 'Alumno.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno </option>
				<option value="Alumno.APELLIDO_MAT" <?php echo $ordenar == 'Alumno.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno </option>
				<option value="Alumno.NOMBRES" <?php echo $ordenar == 'Alumno.NOMBRES' ? 'selected="selected"':''; ?>>Nombre </option>
				<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
				<option value="AlumnoAsignatura.SIGLA_SECCION" <?php echo $ordenar == 'AlumnoAsignatura.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Secci&oacute;n</option>
				<option value="clases_presente" <?php echo $ordenar == 'clases_presente' ? 'selected="selected"':''; ?> >Clases Presente</option>
				<option value="clases_ausente" <?php echo $ordenar == 'clases_presente' ? 'selected="selected"':''; ?> >Clases Ausente</option>
				<option value="asistencia_promedio" <?php echo $ordenar == 'clases_presente' ? 'selected="selected"':''; ?> >Asistencia Actual</option>
				<option value="RI.RI_DIRECTOR DESC" <?php echo $ordenar == 'RI.RI_DIRECTOR DESC' ? 'selected="selected"':''; ?> >RI</option>
			</select>
		</div>
	</div>
	<div class="col-md-12">
		<table class="table table-striped" id="table-list-alumnos-ri" border="0" cellpadding="0" cellspacing="0" >
			<thead>
				<tr>
					<th>&nbsp;</th>
					<th>Nombre Asignatura</th>
					<th class="una-linea">Sigla-Secci&oacute;n</th>
					<th class="una-linea">Modalidad</th>
					<th class="una-linea">Rut Alumno</th>
					<th>Apellido Paterno</th>
					<th>Apellido Materno</th>
					<th>Nombres</th>
					<th class="clases_presente">Clases Presente</th>
					<th class="clases_ausente">Clases Ausente</th>
					<th class="clases_justificadas">Clases Justificadas</th>
					<th class="asistencia_promedio">Asistencia Actual</th>
					<th>RI</th>
				</tr>
			</thead>
		  	<tbody>
		  		<?php 
				#debug($indicadores_alumnos);exit();
		  			foreach ($registros as $key => $value): 
		  				$porcentaje = 0;
						if (isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])) {
							$porcentaje = $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$value['AsignaturaHorario']['CLASES_REGISTRADAS'];	
						}
				?>
				  	<tr>
					    <?php
					    
					    if ($value['RI']['RI_DIRECTOR']==1) {
					    	
					     ?><td><?php ?></td>
					    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
					    <td><?php echo $value['AlumnoAsignatura']['SIGLA_SECCION']; ?></td>
					    <td><?php echo $value['AsignaturaHorario']['TEO_PRA']; ?></td>
					    <td><?php echo $value['Alumno']['RUT'].'-'.$value['Alumno']['DV_RUT']; ?></td>
					    <td><?php echo $value['Alumno']['APELLIDO_PAT']; ?></td>
					    <td><?php echo $value['Alumno']['APELLIDO_MAT']; ?></td>
					    <td><?php echo $value['Alumno']['NOMBRES']; ?></td>
					    <td class="text-center" >
				    	<!-- <?php 
					    	
					    	echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?>
 -->
					    	<?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?>
					    		
					    </td>
						
						<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
					    <td><?php echo isset($indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['AlumnoAsignatura']['COD_HORARIO_ASIGNATURA']][$value['Alumno']['COD_ALUMNO']]['CLASES_JUSTIFICADOS']:0; ?></td>
					    <td><?php echo round($porcentaje,2).'%'; ?></td>
					    
					    <td>
					    	<?php 
					    		$check = '';
					    		if ($value['RI']['RI_DIRECTOR']==1) {
					    			$check = '<i class="fa fa-check"></i>';
					    		}
					    		echo $check;
					    	?>	
					    </td>
					    <?php } ?>
				  	</tr>
			  	<?php endforeach ?>
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
					href="<?php echo $this->Html->url(array('action'=>'excelTasaAsistenciaRi')); ?>"
					><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
				<button 
					class="btn btn-success btn-exportable" 
					href="<?php echo $this->Html->url(array('action'=>'pdfTasaAsistenciaRi')); ?>"
					><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</button>
				<button 
					class="btn btn-success btn-exportable" 
					target="_blank"
					href="<?php echo $this->Html->url(array('action'=>'imprimirTasaAsistenciaRi')); ?>"
					><i class="fa fa-print"></i>&nbsp;Imprimir</button>
			</form>
		</div>
	</div>
</div>
<script>
	$('#table-list-alumnos-ri').tablesorter({
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
			10: {sorter: false},
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
	$('#select-order').selectpicker({width:'250px'});
	$('#select-order').on('change', function(event) {
        event.preventDefault();
        if (event.target.value == 'clases_presente' || event.target.value == 'clases_ausente' || event.target.value == 'asistencia_promedio') {
			$('#table-list-alumnos-ri').find('th.'+event.target.value).trigger('sort');
        }else{
        	$('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
        	$('#form-filtro-basico').submit();
        }
        
    });
    $('body').on('submit','#form-filtro-basico',function () {
		form = $(this);
		event.preventDefault();
		error = 0;
		form.find('[mandatory]').each(function(index, el) {
			if($(this).val() == ''){
				notifyUser($(this).attr('text-error'),'danger');
				error++;
			}
		});
		if (error == 0) {
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				dataType: 'html',
				data:form.serialize(),
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
				$('#contenedor-grilla .card-body').empty();
			})
			.always(function(view) {
				$('#contenedor-grilla .card-body').html(view);
			});
		}
	});	
</script>