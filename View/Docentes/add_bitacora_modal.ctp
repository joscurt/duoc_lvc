<style>
	#modal-bitacora .content-li-bitacora{
		border-top:0px;
		border:1px solid #ccc; 
		height:300px;
		max-height: 300px; 
		overflow: auto; 
	}
	#modal-bitacora .content-li-bitacora ul{
		list-style:none;
		margin-left:0;
		padding-left:0;
		padding:4px;
	}
	#modal-bitacora .content-li-bitacora ul li{
		border-bottom:1px solid #ccc;
		margin-bottom:4px;
	}
	#modal-bitacora .content-li-bitacora ul li:last-child{
		border-bottom:0px !important;
		margin-bottom:4px;
	}
</style>
<form 
	id="form-add-bitacora-modal"
	action="<?php echo $this->Html->url(array('action'=>'saveBitacora',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>">
	<div class="modal-header">
		<h4 class="modal-title">Bitácora
			<span class="close" data-dismiss="modal">x</span>
		</h4>
	</div>
	<div class="modal-body">
		<div class="col-md-6">
			<label for="">Bitácora Docente</label>
			<div class="form-group">
				<div class="fg-line">
					<textarea 
						style="max-height: 300px;height: 300px;"
						placeholder="Ingrese sus comentarios" rows="4" 
						class="form-control"
						required="required" 
						name="data[Bitacora][comentarios]"
						></textarea>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<label for="">Ver Bitácoras</label>
			<div class="form-group content-li-bitacora">
				<ul>
					<?php foreach ($bitacoras as $key => $value): ?>
						<li>
							<span class="badge" style="background: #607D8B;">
							<?php echo date('H:i',strtotime($value['Bitacora']['CREATED'])) ?>
							(<?php echo date('d/m/Y',strtotime($value['Bitacora']['CREATED'])) ?>)</span> - <br> 
							<?php echo $value['Bitacora']['DESCRIPCION']; ?>
							<br> 
						</li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<div class="modal-footer">
		<button type="submit" class="btn btn-xs btn-success" ><i class="fa fa-save"></i>&nbsp;Guardar Bitácora</button>
		<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
	</div>
</form>
<script>
	$('#form-add-bitacora-modal').on('submit', function(event) {
		event.preventDefault();
		form = $(this);
		form.find('button[type="submit"]').addClass('disabled'),
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.fail(function() {
			$('#modal-bitacora').modal('hide');
			notifyUser('Ha ocurrido un error inesperado.Intente más tarde.','danger');
		})
		.always(function(response) {
			notifyUser(response.message,response.status);
			$('#btn-agregar-bitacora').trigger('click');
		});
		
	});
</script>