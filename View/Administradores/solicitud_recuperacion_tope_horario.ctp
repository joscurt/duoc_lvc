<form action="<?php echo $this->Html->url(array('action'=>'crearSolicitudRecuperacion',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST" id="form-crear-reforzamiento">
	<style>
		label.cargando-hidden{
			width:100%;
		}
		#content-inline {
			position: relative;
		}
		#content-inline a.inline{
		    position: absolute;
		    right: 9px;
		    top: 28%;
		    display: block;
		}
	</style> 
	<div class="row">
		<div class="col-md-12">
			<div class="block-header">
				<h1>Solicitud de Recuperación</h1>
			</div>
		</div>
	</div>
	<div class="card">
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 virtual presencial">
							<div class="form-group">
								<label for="">Motivo:</label>
								<select 
									name="data[ProgramacionClase][MOTIVO_ID]"
									id="select-motivo-id" 
									class="form-control selectpicker form-select-motivo-jusitifacion" 
									data-target-justify="#form-textarea-observacion-justificacion"
									data-live-search="true">
									<option value=""></option>
									<?php foreach ($motivos as $key => $motivo): ?>
										<option 
											value="<?php echo $motivo['MotivoSolicitudRecuperacion']['ID']; ?>"><?php echo $motivo['MotivoSolicitudRecuperacion']['MOTIVO']; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						</div>
						<div class="col-md-12 ">
							<div class="form-group">
								<label>Tipo Clase</label>
								<select 
									name="data[ProgramacionClase][TIPO]" 
									id="select-tipo-clase"
									class="form-control selectpicker" 
									data-live-search="true">
									<option value=""></option>
									<option value="presencial">PRESENCIAL</option>
									<option value="virtual">VIRTUAL</option>
								</select>
							</div>
						</div>
						<div class="col-md-12 virtual presencial">
							<div class="form-group">
								<label class="checkbox checkbox-inline m-r-20">
				                    <input 
				                    	type="checkbox" 
				                    	name="data[ProgramacionClase][DOCENTE_TITULAR]" 
				                    	class="form-control"
				                    	value="1" 
				                    	id="check-docente-titular">
				                    <i class="input-helper"></i>    
			                    	DOCENTE TITULAR
			                	</label>
							</div>
							<div class="form-group">
								<label for="input-nombre-docente">Nombre Docente:</label>
								<div id="div-docente-alternativo">
									<select name="data[ProgramacionClase][COD_DOCENTE_ALTERNATIVO]" id="select-" class="form-control selectpicker" data-live-search="true">
										<option value=""></option>
										<?php foreach ($docentes as $key => $docente): ?>
											<option value="<?php echo $docente['Docente']['COD_DOCENTE']; ?>">
												<?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT'];  ?>
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
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="row">
						<div class="col-md-12 virtual presencial">
							<label for="input-datetimepicker-fecha-clase">Fecha Programada:</label>
					 		<div class="input-group form-group">
			                    <span class="input-group-addon"><i class="md md-event"></i></span>
			                        <div class="dtp-container dropdown">
			                        <input 
			                        	type="text"
			                        	class="form-control date-time-picker" 
			                        	data-toggle="dropdown" 
			                        	id="input-datetimepicker-fecha-clase"
			                        	name="data[ProgramacionClase][FECHA_CLASE]"
			                        	placeholder="Haga click...">
			                    </div>
			                </div>
						</div>
						<div class="col-md-6 presencial">
							<label for="select-hora-inicio" class="cargando-hidden">Hora inicio: <span style="display:none;float:right"></span></label>
							<div class="form-group">
		                        <select 
		                        	class="form-control selectpicker "
		                        	name="data[ProgramacionClase][HORA_INICIO]" 
		                        	data-live-search="true"
		                        	disabled="disabled"
		                        	id="select-hora-inicio">
		                        	<option value=""></option>
		                        	<?php foreach ($horarios as $key => $value): ?>
		                        		<option value="<?php echo $value['hora_inicio']; ?>"><?php echo $value['hora_inicio']; ?></option>
		                        	<?php endforeach ?>
		                        </select>
		                    </div>
						</div>
						<div class="col-md-6 presencial">
							<label for="select-hora-fin" class="cargando-hidden">Hora termino: <span style="display:none;float:right"></span></label>
							<div class="form-group">
		                        <select 
		                        	class="form-control selectpicker "
		                        	data-live-search="true"
		                        	disabled="disabled" 
		                        	name="data[ProgramacionClase][HORA_FIN]" 
		                        	id="select-hora-fin">
		                        	<option value=""></option>
		                        	<?php foreach ($horarios as $key => $value): ?>
		                        		<option value="<?php echo $value['hora_fin']; ?>"><?php echo $value['hora_fin']; ?></option>
		                        	<?php endforeach ?>
		                        </select>
		                    </div>
						</div>
						<div class="col-md-12 m-b-20 content-detalle-labels">
						<!-- CD005 José Morandé -->
							<label class="label-modulos">MODULOS A RECUPERAR: <?php echo round($programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']); ?></label><br>
							<!-- <label class="label-tope">TOPE HORARIO: 8 de 35 alumnos presentar tope</label> -->
						</div>
						<div class="col-md-12 presencial" id="content-inline">
							<div class="form-group inline" style="width: 90%;">
								<label for="select-sala" class="cargando-hidden-salas">Sala: <span style="display:none;float:right"></span></label>
								<select
									name="data[ProgramacionClase][SALA]"
									id="select-sala"
									disabled="disabled"
									class="form-control selectpicker"
									data-live-search="true">
									<option value=""></option>
								</select>
								<span id="result-count-salas"></span>
							</div>
							<a
								href=""
								data-rel="tooltip"
								title="Buscar salas disponibles"
								id="button-get-salas"
								class="inline btn bgm-orange btn-sm"><i class="md md-history"></i></a>
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="">Observaciones:</label>
						<textarea 
							name="data[ProgramacionClase][OBS_SOLICITUD_RECUPERACION]" class="form-control" id="form-textarea-observacion-justificacion" cols="30" rows="10"></textarea>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<button class="btn btn-success" type="submit">GUARDAR</button>
						<button class="btn btn-info presencial" id="btn-tope" type="button">TOPE HORARIO ALUMNOS</button>
						<button class="btn btn-info presencial" id="btn-tope_docentes" type="button">TOPE HORARIO DOCENTES</button>
						<a 
							href="<?php echo $this->Html->url(array('action'=>'solicitudRecuperacion')); ?>"
							id="link-salir-sin-guardar"
							class="btn btn-default">SALIR</a>
					</div>
				</div>
			</div>
			<div class="row" id="content-lista-alumnos">
				
			</div>
			<div class="row" id="content-lista-docentes">
				
			</div>
		</div>
	</div>
</form>
<script>
	$(function(){
		$('#button-get-salas').on('click',function(event){
			event.preventDefault();
			completarSalas();	
		});

	});

	//Boton tope Horario Alumnos ========================================================================================
	$('#btn-tope').on('click',function(event){
		if (completarSalas(true)) {
			$('#content-lista-alumnos').empty();
			var elemento_click = $(this);
			elemento_click.html("<i class='fa fa-cog fa-spin'></i>");
			$('#content-lista-alumnos').load("<?php echo $this->Html->url(array('action'=>'listaAlumnosConTope',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>",function(){
				elemento_click.html("TOPE HORARIO");
			});
		}
	});

	//Boton tope Horario Docentes ========================================================================================
	$('#btn-tope_docentes').on('click',function(event){
		if (completarSalas(true)) {
			  event.preventDefault();
		var fecha = $('#input-datetimepicker-fecha-clase').val();
		var hora_inicio = $('#select-hora-inicio').val();
		var hora_fin = $('#select-hora-fin').val();
		$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'listaDocentesConTope',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
				type: 'POST',
				dataType: 'json',
				data:{fecha:fecha,hora_inicio:hora_inicio,hora_fin:hora_fin},
				success: function () {
				 alert('Estamos');
				       				}
					})
			$('#content-lista-docentes').empty();
			var elemento_click = $(this);
			elemento_click.html("<i class='fa fa-cog fa-spin'></i>");
			$('#content-lista-docentes').load("<?php echo $this->Html->url(array('action'=>'listaDocentesConTope',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>",function(){
				var fecha = $('#input-datetimepicker-fecha-clase').val();
				var hora_inicio = $('#select-hora-inicio').val();
				var hora_fin = $('#select-hora-fin').val();
				elemento_click.html("TOPE HORARIO DOCENTES");
			});
		}
	});


	$('#select-hora-fin').on('change', function(event) {
		if ($('#select-hora-inicio').val() == '') {
			notifyUser('Debe seleccionar una hora de inicio','info');
			resetHoraFin();
			return false;
		}
		var minutos = calcularMinutos($('#select-hora-inicio').val(),$('#select-hora-fin').val());
		modulos = minutos / 45;
		if (modulos <=0) {
			notifyUser('Debe seleccionar un horario de término que almenos recupere 1 modulo','info');
			resetHoraFin();
			return false;
		}
		if (modulos > <?php echo (int)$programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>) {
			resetHoraFin();
			notifyUser('La cantidad de modulos no puede ser mayor a <?php echo (int)$programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>','danger');
		}
	});
	function resetHoraFin() {
		$('#select-hora-fin').val('');
		$('#select-hora-fin').selectpicker('refresh');
	}
	function calcularMinutos(hora_inicio,hora_termino) {
		hora_termino=  '2016-12-21 '+ hora_termino + ":00";
		hora_inicio= '2016-12-21 '+ hora_inicio + ":00";
		var a = new Date(hora_termino);
		var b = new Date(hora_inicio);
		var c = ((a-b)/1000);
		return c / 60; 
	}
	$('#button-get-salas').tooltip();
	$('#select-tipo-clase').on('change', function(event) {
		event.preventDefault();
		if (event.target.value != '') {
			if(event.target.value == 'presencial'){
				$('.virtual').hide();
				$('.presencial').show();
			}else{
				$('.presencial').hide();
				$('.virtual').show();
			}
		}
	});
	$('#input-datetimepicker-fecha-clase').on('blur',function(event){
		if (event.target.value != '') {
			$('#select-hora-inicio, #select-hora-fin').prop('disabled',false);
			$('#select-hora-inicio, #select-hora-fin').selectpicker('refresh');
		}else{
			$('#select-hora-inicio, #select-hora-fin').prop('disabled',true);
			$('#select-hora-inicio, #select-hora-fin').val('');
			$('#select-hora-inicio, #select-hora-fin').selectpicker('refresh');	
		}
	});
	var completarSalas = function (sobrecarga) {
		fecha = $('#input-datetimepicker-fecha-clase').val();
		hora_inicio = $('#select-hora-inicio').val();
		hora_fin = $('#select-hora-fin').val();
		$('.content-detalle-labels').show();
		if (fecha != '') {
			if (hora_inicio != '') {
				if (hora_fin != '') {
					if (sobrecarga === true) {
						return true;
					}
					$('label.cargando-hidden-salas span').html("<i class='fa fa-cog fa-spin'></i>").show();
					$('#result-count-salas').empty();
					$.ajax({
						url: '<?php echo $this->Html->url(array('action'=>'getSalasDisponiblesByHorarioProg')); ?>',
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
								$('#select-sala').append("<option value='"+response.data[index]["C"].COD+"'>"+response.data[index]["C"].SALA+"</option>").prop('disabled',false);
							});
							$('#select-sala').selectpicker('refresh');
							$('#result-count-salas').html('Se encontraron '+response.data.length+' salas disponibles' );
							$('label.cargando-hidden-salas span').hide();
						}else{
							notifyUser(response.message,response.status);
						}
					});
				}else{
					notifyUser('Seleccione una hora de fin','info');
				}				
			}else{
				notifyUser('Seleccione una hora de inicio','info');
			}
		}else{
			notifyUser('Seleccione una fecha del calendario','info');
		}
		return false;
	}
	var completarDocentes = function (sobrecarga) {
		fecha = $('#input-datetimepicker-fecha-clase').val();
		hora_inicio = $('#select-hora-inicio').val();
		hora_fin = $('#select-hora-fin').val();
		$('.content-detalle-labels').show();
		if (fecha != '') {
			if (hora_inicio != '') {
				if (hora_fin != '') {
					if (sobrecarga === true) {
						return true;
					}
					$('label.cargando-hidden-salas span').html("<i class='fa fa-cog fa-spin'></i>").show();
					$('#result-count-salas').empty();
					$.ajax({
						url: '<?php echo $this->Html->url(array('action'=>'listaDocentesConTope')); ?>',
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
								$('#select-sala').append("<option value='"+response.data[index][0].COD+"'>"+response.data[index][0].NOMBRE_SALA+"</option>").prop('disabled',false);
							});
							$('#select-sala').selectpicker('refresh');
							$('#result-count-salas').html('Se encontraron '+response.data.length+' salas disponibles' );
							$('label.cargando-hidden-salas span').hide();
						}else{
							notifyUser(response.message,response.status);
						}
					});
				}else{
					notifyUser('Seleccione una hora de fin','info');
				}				
			}else{
				notifyUser('Seleccione una hora de inicio','info');
			}
		}else{
			notifyUser('Seleccione una fecha del calendario','info');
		}
		return false;
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
	var data_docente = <?php echo json_encode($programacion_clase); ?>;
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
	$('.form-select-motivo-jusitifacion').on('change', function(event) {
		var select = $(this);
		if (event.target.value != '') {
			option_selected = select.find('option:selected');
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
	});

/* CD003 JL.Morandé C */
	$(function(){
        $("#form-crear-reforzamiento").submit(function( event ) {
            var error='';
            if ($.trim($('#select-motivo-id').val()).length < 1) {
                error+='Debe seleccionar el motivo.<br>';
            }
             if ($.trim($('#input-datetimepicker-fecha-clase').val()).length < 1) {
                error+='Debe Seleccionar la Fecha Programada.<br>';
            }
            if ($.trim($('#form-textarea-observacion-justificacion').val()).length < 1) {
                error+='Debe adicionar una observación.<br>';
            }
            if ($.trim($('#select-tipo-clase').val()).length < 1) {
                error+='Debe Seleccionar el Tipo de Clase.<br>';
            }

            if ($('#select-tipo-clase').val()=='presencial') {
	               if ($.trim($('#select-hora-inicio').val()).length < 1) {
	                error+='Debe Seleccionar la hora de inicio.<br>';
	            }
	            	if ($.trim($('#select-hora-fin').val()).length < 1) {
	                error+='Debe Seleccionar la hora final.<br>';
	            }
            }
                             
            if(document.getElementById('check-docente-titular').checked == false){
				if ($.trim($('#select-').val()).length < 1) {
               	 error+='Debe Seleccionar el Docente.<br>';
           		 }
            }
           /* if ($.trim($('#select-sala').val()).length < 1) {
                error+='Debe Seleccionar la Sala.<br>';
            }*/


                     if (error!='') {
                event.preventDefault();
                notifyUser(error, 'info');
                $(".alert-info").css("z-index", "2000");
                return false;                
            }
        });
    });
  /****/  
</script>