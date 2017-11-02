<form 
	id="form-bitacora-send"
	action="<?php echo $this->Html->url(array('action'=>'saveBitacora',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">
	<div class="modal-header">
		<h4 class="modal-title">Bit&aacute;cora Clase <?php echo $programacion_clase['ProgramacionClase']['SIGLA_SECCION']; ?>-<?php echo $programacion_clase['ProgramacionClase']['MODALIDAD']; ?> - <?php echo $programacion_clase['Asignatura']['NOMBRE']; ?></h4>
	</div>
	<div class="modal-body">
		<div class="form-group" style="max-height: 500px;overflow: auto;">
			<label for="eventName">Bit&aacute;cora</label>
			<div class="fg-line">
				<span class="badge"><?php echo date('H:i').' ('.date('d-m-Y').')'; ?></span><br>
				<textarea 
					class="form-control" 
					name="data[Bitacora][comentarios]" 
					style="height: 100px;" cols="30" rows="10"></textarea>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-xs btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar Bit&aacute;cora</button>
		<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
	</div>
</form>
<script>
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
			if(response.status == 'success' && bitacora_context != ""){
				icon = $('#tabla-bitacora').find('tr.tr-'+bitacora_context+' td.content-icon i');
				if(icon.hasClass('fa-minus')){
					icon.removeClass('fa-minus').addClass('fa-check').css('color','green');
				}
			}
			$('#modalDefault').modal('hide');
		});
	});
</script>