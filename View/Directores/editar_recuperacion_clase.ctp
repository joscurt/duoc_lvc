<style>
	#justificacion tr th, #justificacion tr td {
		text-align: left !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
            <h1>Recuperar Clases</h1>
        </div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Docente:</h2>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Rut</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombres</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo isset($info_editar_recuperacion['Docente']['RUT']) ? $info_editar_recuperacion['Docente']['RUT'].'-'.$info_editar_recuperacion['Docente']['DV']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['APELLIDO_PAT']) ? $info_editar_recuperacion['Docente']['APELLIDO_PAT']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['APELLIDO_MAT']) ? $info_editar_recuperacion['Docente']['APELLIDO_MAT']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['Docente']['NOMBRE']) ? $info_editar_recuperacion['Docente']['NOMBRE']: ''; ?></td>
						</tr>	
					</tbody>
				</table>
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Nombre asignatura</th>
							<th>Sigla-Secci&oacute;n</th>
							<th>Jornada</th>
							<th>Fecha programada</th>
							<th>Horario</th>
							<th>Sala</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo isset($info_editar_recuperacion['Asignatura']['NOMBRE']) ? $info_editar_recuperacion['Asignatura']['NOMBRE']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION']) ? $info_editar_recuperacion['ProgramacionClase']['SIGLA_SECCION']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['COD_JORNADA']) ? $info_editar_recuperacion['ProgramacionClase']['COD_JORNADA']: ''; ?></td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y', strtotime($info_editar_recuperacion['ProgramacionClase']['FECHA_CLASE'])): ''; ?></td>
							<td>
								<?php echo isset($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO']) ? date('H:i',strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO'])): ''; ?>
								-
								<?php echo isset($info_editar_recuperacion['ProgramacionClase']['HORA_FIN']) ? date('H:i', strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_FIN'])): ''; ?>
							</td>
							<td><?php echo isset($info_editar_recuperacion['ProgramacionClase']['SALA']) ? $info_editar_recuperacion['ProgramacionClase']['SALA']: ''; ?></td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>M&oacute;dulos</th>
							<th>M&oacute;dulos programados</th>
							<th>M&oacute;dulos por recuperar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Programada</td>
							<td><?php echo $info_editar_recuperacion['ProgramacionClase']['CANTIDAD_MODULOS']; ?></td>
							<td><?php echo $info_editar_recuperacion['ProgramacionClase']['CANTIDAD_MODULOS']; ?></td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table id="justificacion" class="table table-striped" border="0" cellpadding="0" cellspacing="0" class="one-column">
					<thead>
						<tr>
							<th><?php echo $info_editar_recuperacion['Detalle']['DETALLE'] ?></th>
						</tr>
					</thead>
					<tbody>
						<?php $text = ''; ?>
						<?php if ($info_editar_recuperacion['Detalle']['ID']==3): ?>
							<tr class="odd"><td class="odd"><label>Estado:</label> <?php echo $info_editar_recuperacion['EstadoProgramacion']['NOMBRE']; ?></td></tr>
							<tr class="even"><td class="odd"><label>Sub-Estado:</label> <?php echo $info_editar_recuperacion['SubEstadoProgramacion']['NOMBRE']; ?></td></tr>
							<tr class="even"><td class="odd"><label>Detalle:</label> <?php echo $info_editar_recuperacion['Detalle']['DETALLE']; ?></td></tr>
						<?php endif ?>
						<?php if ($info_editar_recuperacion['Detalle']['ID']==4): ?>
							<tr class="odd"><td class="odd"><label>Motivo:</label> <?php echo $info_editar_recuperacion['MotivoSuspensionClase']['MOTIVO']; ?></td></tr>
							<tr class="even"><td class="odd"><label>Observaciones:</label> <?php echo $info_editar_recuperacion['ProgramacionClase']['OBSERVACIONES_ADELANTAR_CLASE']; ?></td></tr>
						<?php endif ?>
						<?php if ($info_editar_recuperacion['Detalle']['ID']==5): ?>
							<tr class="odd"><td class="odd"><label>Tipo de Justificaci&oacute;n Legal:</label> <?php echo $info_editar_recuperacion['TipoJustificacionLegal']['TIPO_JUSTIFICACION']; ?></td></tr>
							<tr class="even"><td class="odd"><label>Observaciones:</label> <?php echo $info_editar_recuperacion['ProgramacionClase']['OBSERVACIONES_ADELANTAR_CLASE']; ?></td></tr>
						<?php endif ?>		
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success" id="cambiar-estado">Cambiar Sub-Estado</button>
				<a href="<?php echo $this->Html->url(array('action'=>'recuperarClases')) ?>" class="btn btn-default">Salir</a> 
			</div>
		</div>
	</div>
</div>
<script>
	$('#cambiar-estado').on('click', function(event) {
		event.preventDefault();
		<?php 
			#FUTURO
			/*if (strtotime($info_editar_recuperacion['ProgramacionClase']['HORA_INICIO']) > strtotime(date('Y-m-d H:i:s'))) {
				$text = 'Dado que aun no llega la fecha de realizaci&oacute;n de la clase esta recuperaci&oacute;n corresponde a un Reemplazo Docente';
			}else{
				$text = 'Dado que ya pas&oacute; la fecha de la clase esta quedar&aacute; como Inasistencia Docente';
			}*/
			$text= '';
		?>
		swal({
            title: "<?php echo __('¿Está seguro?'); ?>",   
            text: "<?php echo __($text); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sí, estoy seguro!",   
            closeOnConfirm: false 
        }, function(){
        	window.location="<?php echo $this->Html->url(array('action'=>'cambioEstadoRecuperacionClase',$info_editar_recuperacion['ProgramacionClase']['COD_PROGRAMACION'])); ?>"
        });
	});
</script>