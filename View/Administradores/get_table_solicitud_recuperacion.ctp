<?php if(!empty($programacion_clases)): ?>
<div class="card" style="padding:1em 0.8em;">
	<div class="row">
		<div class="col-md-8" align="left"></div>
		<div class="col-md-4" style="padding:0 2.7em;"><label for="" class="pull-left">Ordenar por:</label></div>
		<div class="col-md-8" align="left"></div>
		<div class="col-md-4">
			<form method="POST" action="" id="form-ordenar">
				<?php if(!empty($fecha_desde)): ?>
					<input type="hidden" value="<?php echo $fecha_desde; ?>" name="data[Filtro][fecha_inicio]" />
				<?php endif; ?>
				<?php if(!empty($fecha_hasta)): ?>
					<input type="hidden" value="<?php echo $fecha_hasta ?>" name="data[Filtro][fecha_fin]" />
				<?php endif; ?>
				<?php if(!empty($filtro)): ?>
					<input type="hidden" value="<?php echo $filtro; ?>" name="data[Filtro][filtro]" />
				<?php endif; ?>
				<?php if(!empty($valor_filtros)): ?>
					<input type="hidden" value="<?php echo $valor_filtros ?>" name="data[Filtro][valor_filtro]" />
				<?php endif; ?>
				<div class="form-group" style="padding:0 2em;">
					<select name="data[Filtro][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
						<option value="" >Seleccionar</option>
						<option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut docente</option>
						<option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno docente</option>
						<option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno docente</option>
						<option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre docente</option>
						<option value="Docente.COD_DOCENTE" <?php echo $ordenar == 'Docente.COD_DOCENTE' ? 'selected="selected"':''; ?>>ID docente</option>
						<option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
						<option value="ProgramacionClase.SIGLA_SECCION" <?php echo $ordenar == 'ProgramacionClase.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Secci&oacute;n</option>
						<option value="ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE"<?php echo $ordenar == 'ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE' ? 'selected="selected"':''; ?> >Periodo</option>
						<option value="ProgramacionClase.COD_JORNADA" <?php echo $ordenar == 'ProgramacionClase.COD_JORNADA' ? 'selected="selected"':''; ?>>Jornada</option>
						<option value="ProgramacionClase.HORA_INICIO" <?php echo $ordenar == 'ProgramacionClase.HORA_INICIO' ? 'selected="selected"':''; ?>>Horario</option>
						<option value="ProgramacionClase.TIPO_EVENTO" <?php echo $ordenar == 'ProgramacionClase.TIPO_EVENTO' ? 'selected="selected"':''; ?>>Tipo</option>
						<option value="Detalle.DETALLE" <?php echo $ordenar == 'Detalle.DETALLE' ? 'selected="selected"':''; ?>>Detalle</option>
						<option value="EstadoProgramacion.NOMBRE" <?php echo $ordenar == 'EstadoProgramacion.NOMBRE' ? 'selected="selected"':''; ?>>Estado</option>
					</select>
				</div>
			</form>
		</div>
	</div>
	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-md-12">
					<table border="0" cellpadding="0" cellspacing="0" class="table table-striped solicitudRecuperacion">
						<thead>
							<tr>
								<th>&nbsp;</th>
								<th>ID</th>
								<th>Fecha</th>
								<th>Nombre Asignatura</th>
								<th>Sigla-Secci&oacute;n</th>
								<th>Jornada</th>
								<th>Rut docente</th>
								<th>Apellido Paterno</th>
								<th>Apellido Materno</th>
								<th>Nombres</th>
								<th>Sala</th>
								<th>Horario</th>
								<th>Tipo</th>
								<th>Detalle</th>
								<th>Estado</th>
								<th>Solicitar</th>
							</tr>
						</thead>
					  	<tbody>
					  		<?php 
					  			$contador=0;
					  			foreach ($programacion_clases as $key => $value): 
					  				$contador++;
					  		?>
					  			<tr class="">
								    <td><?php echo $contador ?></td>
								    <td><?php echo $value['ProgramacionClase']['ID']; ?></td>
								    <td>
								    	<?php echo !empty($value['ProgramacionClase']['FECHA_CLASE'])? date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])):null;  ?>
								    </td>
								    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
								    <td><?php echo $value['ProgramacionClase']['SIGLA_SECCION']; ?></td>
								    <td><?php echo $value['ProgramacionClase']['COD_JORNADA']; ?></td>
								    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
								    <td><?php echo utf8_encode($value['Docente']['APELLIDO_PAT']); ?></td>
								    <td><?php echo utf8_encode($value['Docente']['APELLIDO_MAT']); ?></td>
								    <td><?php echo utf8_encode($value['Docente']['NOMBRE']); ?></td>
								    <td><?php echo !empty($value['SalaReemplazo']['TIPO_SALA'])?$value['SalaReemplazo']['TIPO_SALA']:$value['Sala']['TIPO_SALA']; ?></td>
								    <td><?php echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).' '.date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); ?></td>
								    <td><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></td>
								    <td><?php echo $value['Detalle']['DETALLE']; ?></td>
								    <td><?php echo $value['EstadoProgramacion']['NOMBRE']; ?></td>
								    <td>
								    	<a
									    	class="btn btn-info btn-xs"
									    	href="<?php echo $this->Html->url(array('action'=>'solicitudRecuperacionTopeHorario',$value['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
									    	title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
								    </td>
						  		</tr>
					  		<?php endforeach; ?>
					  	</tbody>
					</table>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a 
						href="<?php echo $this->Html->url(array('action'=>'excelSolicitudRecuperacion')); ?>" 
						class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR EXCEL</a>
					<a 
						href="<?php echo $this->Html->url(array('action'=>'imprimirSolicitudRecuperacion')); ?>" 
						class="btn btn-success"><i class="fa fa-print"></i>&nbsp;IMPRIMIR</a>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(function(){
		$('.selectpicker').selectpicker();
		$('#select-order').on('change', function(event) {
		event.preventDefault();
		var form = $('#form-ordenar');
		/* Act on the event */
		var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableSolicitudRecuperacion')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(view) {
			$('#card-content-grilla').html(view);
		});
	});
	});
</script>

<?php else: ?>
	<h4>* No hay registros para los filtros seleccionados.</h4>
<?php endif; ?>

