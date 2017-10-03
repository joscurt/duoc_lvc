<style>
	.textarea-editar{
		display: none;
	}
</style>
<div class="modal-header">
	<h4 class="modal-title">Bit&aacute;cora Clase <?php echo $programacion_clase['ProgramacionClase']['SIGLA_SECCION']; ?>(T) - <?php echo $programacion_clase['Asignatura']['NOMBRE']; ?></h4>
</div>
<form 
	id="form-bitacora-send"
	action="<?php echo $this->Html->url(array('action'=>'editarBitacoras',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
	method="POST">
	<div class="modal-body">
		<div class="form-group textareas-readonly" style="max-height: 500px;overflow: auto;">
			<?php 
			if( isset($bitacoras) and count($bitacoras)>0  ):
				foreach ($bitacoras as $key => $bitacora): 
				?>
				<div class="fg-line m-t-20">
					<span class="badge">
						<?php echo date('H:i',strtotime($bitacora['Bitacora']['CREATED'])); ?>
						(<?php echo date('d-m-Y',strtotime($bitacora['Bitacora']['CREATED'])); ?>)
						</span>
					<?php if (strtotime($bitacora['Bitacora']['CREATED']) != strtotime($bitacora['Bitacora']['MODIFIED'])): ?>
						<span class="badge bgm-green">
							&Uacute;ltima edici&oacute;n <?php echo date('H:i',strtotime($bitacora['Bitacora']['MODIFIED'])); ?>
							(<?php echo date('d-m-Y',strtotime($bitacora['Bitacora']['MODIFIED'])); ?>)
						</span>
					<?php endif ?>
					<br>
					<label class="label-description-bitacora" style="text-align:justify">
						<?php echo $bitacora['Bitacora']['DESCRIPCION']; ?>
					</label>
					<input type="hidden" 
						name="data[Bitacora][<?php echo $key ?>][ID]" 
						value="<?php echo $bitacora['Bitacora']['ID']; ?>" />
					<textarea class="form-control textarea-editar" 
						name="data[Bitacora][<?php echo $key ?>][DESCRIPCION]" 
						cols="30" 
						rows="5"><?php echo $bitacora['Bitacora']['DESCRIPCION']; ?></textarea>
				</div>
			<?php 
				endforeach;
			endif;
			?>
		</div>
	</div>

	<div class="modal-footer">
		<?php if( isset($bitacoras) and count($bitacoras)>0 ): ?>
		<a href="<?php echo $this->Html->url(array('action'=>'exportarBitacoraExcelClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
			target="_blank"
			class="btn btn-xs btn-default">
			<i style="color:green;" 
				class="fa fa-file-excel-o"></i>&nbsp;Exportar Bit&aacute;cora</a>
		<a href="<?php echo $this->Html->url(array('action'=>'exportarBitacoraPdfClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
			class="btn btn-xs btn-default" 
			target="_blank"
			><i style="color:red;" class="fa fa-file-pdf-o"></i>&nbsp;Exportar Bit&aacute;cora</a>
		<button type="button" class="btn btn-xs btn-info" id="btn-editar-bitacora"><i class="fa fa-edit"></i>&nbsp;Editar Bit&aacute;cora</button>
		<button type="submit" class="btn btn-xs btn-success" style="display:none;" id="btn-guardar-bitacora"><i class="fa fa-save"></i>&nbsp;Guardar Bit&aacute;cora</button>
		<?php endif; ?>
		<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
	</div>
</form>
<script>
	$('#btn-editar-bitacora').on('click', function(event) {
		event.preventDefault();
		$(this).hide();
		$('#btn-guardar-bitacora').show();
		$('.label-description-bitacora').hide();
		$('.textarea-editar').show();
	});
	$('#form-bitacora-send').on('submit',function(event){
		event.preventDefault();
		form = $(this);
		$('#modalDefault .modal-content').html('<div align="center"></div>');
		$('#modalDefault .modal-content div').html(img_cargando);
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data:form.serialize(),
		})
		.fail(function(error) {
			notifyUser('Ha ocurrido un error inesperdo', 'info');
			$('#modalDefault').modal('hide');
		})
		.always(function(response) {
			notifyUser(response.message, response.status);
			$('#modalDefault').modal('hide');
		});
	});
</script>