<style>
	label.cargando-hidden{
		width:100%;
	}
</style>
<?php foreach ($permisos as $key => $value) {

	if ($value['PermisoFuncionalidad']['FUNCIONALIDAD_ID']==382) {?>
		<?php if($value['Funcionalidad']['ACTIVO']==1 && $value['PermisoFuncionalidad']['LECTURA']==1 && $value['PermisoFuncionalidad']['EDITAR']==1 && $value['PermisoFuncionalidad']['CREAR']==1){	?>
	


<form action="<?php echo $this->Html->url(array('action'=>'crearReforzamiento')); ?>" method="POST" id="form-crear-reforzamiento">
	<div class="row">
		<div class="col-md-12">
			<div class="block-header">
				<h1>Gestión de Clases</h1>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-header">
			<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Crear Reforzamiento</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
						<div class="fg-line">
							<label for="input-sigla-seccion">Sigla Sección: <span title="Se desplegará un listado de opciones coincidentes con su búsqueda." data-toggle="tooltip"><i class="fa fa-info-circle"></i></span></label>
							<input 
								type="text"
								id="input-sigla-seccion" 
								name="data[ProgramacionClase][SIGLA_SECCION]"
								autocomplete="off" 
								class="form-control autocompletar-sigla-seccion" />
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12">
							<label for="input-datetimepicker-fecha-clase">Fecha:</label>
					 		<div class="input-group form-group">
			                    <span class="input-group-addon"><i class="md md-event"></i></span>
			                        <div class="dtp-container dropdown">
			                        <input 
			                        	type="text"
			                        	class="form-control date-time-picker" 
			                        	data-toggle="dropdown" 
			                        	id="input-datetimepicker-fecha-clase"
			                        	name="data[ProgramacionClase][FECHA_CLASE]"
			                        	placeholder="Haga click..."
			                        	disabled="disabled"
			                        >
			                    </div>
			                </div>
						</div>
						<div class="col-md-6">
							<label for="select-hora-inicio" class="cargando-hidden">Hora inicio: <span style="display:none;float:right"></span></label>
							<div class="form-group">
		                        <select 
		                        	class="form-control selectpicker "
		                        	disabled="disabled" 
		                        	name="data[ProgramacionClase][HORA_INICIO]" 
		                        	data-live-search="true"
		                        	id="select-hora-inicio"
		                        	disabled="disabled"
		                        	>
		                        	<option value=""></option>
		                        </select>
		                    </div>
						</div>
						<div class="col-md-6">
							<label for="select-hora-fin" class="cargando-hidden">Hora termino: <span style="display:none;float:right"></span></label>
							<div class="form-group">
		                        <select 
		                        	class="form-control selectpicker "
		                        	disabled="disabled" 
		                        	data-live-search="true"
		                        	name="data[ProgramacionClase][HORA_FIN]" 
		                        	id="select-hora-fin"
		                        	disabled="disabled">

		                        	<option value=""></option>
		                        </select>
		                    </div>
						</div>
						<div class="col-md-12">
							<div class="form-group">
								<label for="select-sala" class="cargando-hidden-salas">Sala: <span style="display:none;float:right"></span></label>
								<select 
									name="data[ProgramacionClase][SALA]" 
									id="select-sala" 
									disabled="disabled" 
									class="form-control selectpicker" 
									data-live-search="true"
									disabled="disabled">
									<option value=""></option>
								</select>
								<label class="indicador-count-salas"></label>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label class="checkbox checkbox-inline m-r-20">
		                    <input 
		                    	type="checkbox" 
		                    	name="data[ProgramacionClase][DOCENTE_TITULAR]" 
		                    	class="form-control"
		                    	value="1" 
		                    	id="check-docente-titular"
		                    	disabled="disabled">
		                    <i class="input-helper"></i>    
	                    	DOCENTE TITULAR
	                	</label>
					</div>
					<div class="form-group">
						<label for="input-nombre-docente">Nombre Docente:</label>
						<div id="div-docente-alternativo">
							<select name="data[ProgramacionClase][COD_DOCENTE_ALTERNATIVO]" id="select-docentes" class="form-control selectpicker" data-live-search="true">
								<option value=""></option>
								<?php foreach ($docentes as $key => $docente): ?>
									<option value="<?php echo $docente['Docente']['COD_DOCENTE']; ?>">
										<?php echo ($docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']);  ?>
									</option>
								<?php endforeach ?>
							</select>
						</div>
						<div id="div-docente-titular" style="display:none;">
							<input 
								id="input-nombre-docente" 
								name="data[ProgramacionClase][DOCENTE]"
								type="text" class="form-control" />
							<input
								type="hidden" 
								value=""
								id="input-hidden-cod-docente"
								name="data[ProgramacionClase][COD_DOCENTE]" />
						</div>
					</div>
					<div class="form-group">
						<label for="">Motivo:</label>
						<select 
							name="data[ProgramacionClase][MOTIVO_ID]"
							disabled="disabled"
							id="select-motivo-id" 
							class="form-control selectpicker form-select-motivo-jusitifacion" 
							data-target-justify="#form-textarea-observacion-justificacion"
							data-live-search="true">
							<option value=""></option>
							<?php foreach ($motivos as $key => $motivo): ?>
								<option 
									<?php //data-justify="<?php echo $motivo['MotivoReforzamiento']['JUSTIFICACION']; ?>
									value="<?php echo $motivo['MotivoReforzamiento']['ID']; ?>"><?php echo $motivo['MotivoReforzamiento']['MOTIVO']; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Observaciones:</label>
						<textarea 
							disabled="disabled" 
							name="data[ProgramacionClase][OBSERVACIONES_REFORZAMIENTO]" 
							class="form-control" 
							id="form-textarea-observacion-justificacion" cols="30" rows="10"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-success" disabled="disabled" type="submit">Guardar</button>
						<a 
							href="<?php echo $this->Html->url(array('action'=>'index')); ?>"
							id="link-salir-sin-guardar"
							class="btn btn-default">Salir</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>
<?php	}
else {
	?>
	<div class="alert alert-danger" role="alert"> <strong>Error!</strong> No tienes permisos para ingresar está sección. </div>
	<div class="row">
				<div class="col-md-12">
					<div class="form-group">

					<a 	href="<?php echo $this->Html->url(array('action'=>'index')); ?>"
							
							class="btn btn-success">Volver a inicio</a>
					</div>
				</div>
			</div>
	<?php
}

}} ?>

<script>

	$(function(){
		$('#input-datetimepicker-fecha-clase').on('blur',completarHorarios);
		$('#select-hora-inicio, #select-hora-fin').on('change',completarSalas);
	});
	var completarHorarios = function () {
		fecha = $('#input-datetimepicker-fecha-clase').val();
		if (fecha != '') {
			$('label.cargando-hidden span').html("<i class='fa fa-cog fa-spin'></i>").show();
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'getHorariosDisponiblesByFecha')); ?>',
				type: 'POST',
				dataType: 'json',
				data:{fecha:fecha},
			})
			.fail(function() {
				notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
			})
			.always(function(response) {
				if(response.status=='success'){
					$('#select-hora-inicio, #select-hora-fin').empty().append("<option value=''></option>").prop('disabled',false);
					$.each(response.data,function(index, el) {
						$('#select-hora-inicio').append("<option value='"+el.hora_inicio+"'>"+el.hora_inicio+"</option>");
						$('#select-hora-fin').append("<option value='"+el.hora_fin+"'>"+el.hora_fin+"</option>");
						$('#select-hora-inicio, #select-hora-fin').selectpicker('refresh');
					});
					$('label.cargando-hidden span').hide();
				}else{
					$('#select-hora-inicio, #select-hora-fin').empty().append("<option value=''></option>").prop('disabled',true);
					notifyUser(response.message,response.status);
				}
			});	
		}
	}
	var completarSalas = function () {
		fecha = $('#input-datetimepicker-fecha-clase').val();
		hora_inicio = $('#select-hora-inicio').val();
		hora_fin = $('#select-hora-fin').val();
		if (fecha != '') {
			if (hora_inicio != '') {
				$('label.cargando-hidden-salas span').html("<i class='fa fa-cog fa-spin'></i>").show();
				$('label.indicador-count-salas').html('<i>Buscando salas disponibles...</i>').show();
				$('button[type="submit"]').addClass('disabled');
				$.ajax({
					url: '<?php echo $this->Html->url(array('action'=>'getSalasDisponiblesByHorario')); ?>',
					type: 'POST',
					dataType: 'json',
					data:{fecha:fecha,hora_inicio:hora_inicio,hora_fin:hora_fin},
				})
				.fail(function() {
					notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
				})
				.always(function(response) {
					if(response.status=='success'){
						$('#select-sala').empty().append("<option value=''></option>");
						$.each(response.data,function(index, el) {
							$('#select-sala').append("<option value='"+el.ID+"'>"+el.NOMBRE+"</option>").prop('disabled',false);
							$('#select-sala').selectpicker('refresh');
						});
						$('label.cargando-hidden-salas span').hide();
						$('button[type="submit"]').removeClass('disabled');
						$('label.indicador-count-salas').html('Se han encontrado '+ response.data.length +' salas disponibles').show();
					}else{
						notifyUser(response.message,response.status);
					}
				});
			}else{
				notifyUser('Seleccione una hora de inicio','info');
			}
		}else{
			notifyUser('Seleccione una fecha del calendario','info');
		}
	}
	$('#link-salir-sin-guardar').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		swal({
			title: "<?php echo __('¿Esta seguro que desea Salir?'); ?>",   
            text: "<?php echo __('Al salir perderá todo el trabajo realizado en esta pantalla.'); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "Sí, Estoy Seguro!",   
            closeOnConfirm: false 
		},function(){
			window.location = elemento_click.attr('href');
		});
	});
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
	var data_docente;
	function completarDataDocenteTitular() {
		if (typeof data_docente === "object") {
			if($('#check-docente-titular').is(':checked')){
				$('#div-docente-titular').show();
				$('#div-docente-alternativo').hide();
				$('#input-hidden-cod-docente').val(data_docente.Docente.COD_DOCENTE);
				$('#input-nombre-docente').prop('disabled',true).val(data_docente.Docente.NOMBRE+' '+data_docente.Docente.APELLIDO_PAT+' '+data_docente.Docente.APELLIDO_MAT);
			}else{
				$('#input-hidden-cod-docente').val('');
				$('#input-nombre-docente').val('');
				$('#div-docente-titular').hide();
				$('#div-docente-alternativo').show();
			}
		}
	}
	$('#check-docente-titular').on('change',function(){
		completarDataDocenteTitular();
	});
	$('.autocompletar-sigla-seccion').autocomplete({
		source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos','ProgramacionClase.SIGLA_SECCION')) ?>",
		minLength: 2,
		select:function(event, ui){
			//quitar los disabled
			$('#form-crear-reforzamiento input').removeAttr('disabled');
			$('#form-crear-reforzamiento #select-motivo-id').removeAttr('disabled');
			$('#form-crear-reforzamiento #select-motivo-id').selectpicker('update');
			$('#form-crear-reforzamiento button').removeAttr('disabled');
			$('#form-crear-reforzamiento textarea').removeAttr('disabled');
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'getDocenteTitular')); ?>/'+ui.item.value,
				type: 'POST',
				dataType: 'json',
			})
			.fail(function() {
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
			})
			.always(function(response) {
				if (response.status == 'danger') {
					notifyUser(response.message,response.status);
				}
				data_docente = response.data;
				completarDataDocenteTitular();
			});
			
		}
	});
	$('[data-toggle="tooltip"]').tooltip();
	$('#form-crear-reforzamiento').on('submit', function(event) {
		if ($('.autocompletar-sigla-seccion').val()=='') {
			notifyUser('Debe seleccionar una sigla sección del listado autocompletable.','info');
			event.preventDefault();
			return false;
		}
		if ($('#input-datetimepicker-fecha-clase').val()=='') {
			notifyUser('Debe seleccionar una fecha para la clase de reforzamiento.','info');
			event.preventDefault();
			return false;
		}
	});
	<?php /*$('.form-select-motivo-jusitifacion').on('change', function(event) {
		var select = $(this);
		console.log(select);
		if (event.target.value != '') {
			console.log(event.target.value);
			option_selected = select.find('option:selected');
			console.log(option_selected);
			if (option_selected.attr('data-justify') != undefined) {
				if(option_selected.attr('data-justify') == 1){
					$(select.attr('data-target-justify')).prop('required',true);
				}else{
					$(select.attr('data-target-justify')).prop('required',false);
				}
			}
		}else{
			if (select.attr('data-target-justify') != undefined) {
				$(select.attr('data-target-justify')).prop('required',false);
			}
		}
	});*/ ?>
</script>