<style type="text/css">
	.btn_exportar{
		padding: 1.5em;
		border:2px solid #ddd;
		border-radius: 5px;
		color:red;
		margin:10px;
	}
	.btn_exportar:hover {
		color: red;
	}
	#tabla-bitacora tbody>tr>td{
		padding: 3px !important;
	}
</style>
<br>
<div class="card">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h2>Clases</h2>
	</div>
	<div class="card-body card-padding">
		<div class="table-responsive">
			<table class="table table-hover table-striped" id="tabla-bitacora">
				<thead>
					<tr>
						<th class="td-app text-center">Fecha Clase</th>
						<th class="td-app text-center">Fecha Registro</th>
						<th class="td-app text-center">Modalidad Clases</th>
						<th class="td-app text-center">Horario</th>
						<th class="td-app text-left">Docente</th>
						<th class="td-app text-center">Tipo</th>
						<th class="td-app text-center" align="center">Bit&aacute;cora Registrada</th>
						<th class="td-app text-center">Bit&aacute;cora Docente</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($programacion_clases as $key => $clase): ?>
						<tr class="tr-<?php echo $key; ?>">
							<td class="text-center"><?php echo date('d-m-Y',strtotime($clase['ProgramacionClase']['FECHA_CLASE']));?></td>
							<td class="text-center">
								<?php echo !empty($clase['ProgramacionClase']['FECHA_REGISTRO'])? date('d-m-Y',strtotime($clase['ProgramacionClase']['FECHA_REGISTRO'])):null;?>	
							</td>
							<td class="text-center"><?php echo strtoupper($clase['ProgramacionClase']['MODALIDAD']);?></td>
							<td class="text-center"><?php echo date('H:i',strtotime($clase['ProgramacionClase']['HORA_INICIO'])).'-'.date('H:i',strtotime($clase['ProgramacionClase']['HORA_FIN']));?></td>
							<td class="text-left"><?php echo ($clase['Docente']['NOMBRE'].' '.$clase['Docente']['APELLIDO_PAT'].' '.$clase['Docente']['APELLIDO_MAT']);?></td>
							<td class="text-center"><?php echo strtoupper($clase['ProgramacionClase']['TIPO_EVENTO']); ?></td>
							<td class="text-center content-icon" >
								<?php 
									$color = 'red';
									$fa = 'minus';
									if ($clase['bitacora']) {
										$color = 'green';
										$fa = 'check';
									}
								?>
								<i 
									style="color:<?php echo $color; ?>;"
									class="fa fa-<?php echo $fa; ?>"></i>
							</td>
							<td class="text-center">
								<a 
									data-target="#modalDefault" 
									href="<?php echo $this->Html->url(array('action'=>'verBitacoraDetalle',$clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
									data-toggle="modal"  
									class="btn btn-sm btn-default ver-bitacora" 
									style="color: #2196f3;"
									><i class="fa fa-search"></i>&nbsp;<?php echo 'Ver Bit&aacute;cora'; ?></a>
								<a   
									data-target="#modalvacio" 
									href="<?php echo $this->Html->url(array('action'=>'addBitacoraModal',$clase['ProgramacionClase']['COD_PROGRAMACION'],TRUE)); ?>" 
									data-toggle="modal"  
									data-cod="<?php echo $key; ?>"
									class="btn btn-sm btn-default ver-bitacora" 
									style="color: #2196f3;"
									><i class="fa fa-search"></i>&nbsp;<?php echo 'Ingresar Bit&aacute;cora'; ?></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>	
		</div>
	</div>
</div>
<div class="card" >
	<div class="card-body card-padding" align="center">
		<a class="btn btn-sm btn-info" href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])) ?>"><i class="fa fa-arrow-left"></i>&nbsp;Volver a Eventos</a>
		<a id="btn-exportar-pdf" class="btn btn-sm btn-default" href="#" target="_blank"><i  style="color:red;"class="fa fa-file-pdf-o"></i>&nbsp;EXPORTAR A PDF</a>	
		<a id="btn-exportar-excel" class="btn btn-sm btn-default" href="#"><i style="color:green;" class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR A EXCEL</a>
	</div>
</div>
<div class="modal fade" id="modalDefault" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<div class="modal fade" id="modalvacio" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
		</div>
	</div>
</div>
<script>
	var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
	var bitacora_context = '';
	$('.ver-bitacora').on('click',  function(event) {
		event.preventDefault();event.stopImmediatePropagation();event.stopPropagation();
		elemento_click = $(this);
		bitacora_context = $(this).attr('data-cod');
		$('#modalDefault .modal-content').html('<div align="center"></div>');
		$('#modalDefault .modal-content div').html(img_cargando);
		$('#modalDefault').modal('show');
		$.ajax({
			url: elemento_click.attr('href'),
			type: 'POST',
			dataType: 'html',
		})
		.fail(function(error) {
			notifyUser('Ha ocurrido un error inesperdo', 'info');
			$('#modalDefault').modal('hide');
		})
		.always(function(view) {
			$('#modalDefault .modal-content').html(view);
		});
	});

	$('#btn-exportar-pdf').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'exportarBitacoraPdf', $asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>
		window.location ='<?php echo $url ?>' ;
	});

	$('#btn-exportar-excel').on('click',  function(event) {
		$('#elementLoader').show();
		<?php $url= $this->Html->url(array('action'=>'exportarBitacoraExcel', $asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>
		window.location ='<?php echo $url ?>' ;
		setTimeout(function(){ 
			$('#elementLoader').hide();
		}, 3000);
		
	});











</script>