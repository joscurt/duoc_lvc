<style>
	.display-none{
		display: none;
	}
</style>
<div class="row">
<?php $FechaActual=date('d-m-Y H:i'); # FECHA ACTUAL Y HORA ********************************** ?>
	<div class="col-md-12 m-b-30">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="td-app">Hora Actual</th>
					<th class="td-app">Horario</th>
					<th class="td-app">Sala</th>
					<th class="td-app">Detalle</th>
					<th class="td-app">Estado</th>
					<th class="td-app">Sub Estado</th>
					<th class="td-app">Fecha Clase</th>
					<th class="td-app">Fecha Registro</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				<td><?php echo date('H:i'); ?></td>
					<td>
					<?php 
				//	echo  "HORA INI ".$programacion_clase['ProgramacionClase']['HORA_INICIO']."-- ";
				//	$nuevafecha = strtotime ( '-15 minute' ,  $programacion_clase['ProgramacionClase']['HORA_INICIO'] ) ;
				//	echo date('H:i',$nuevafecha);
					?>
					<?php echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])); ?></td>
					<td><?php echo !empty($programacion_clase['Sala']['TIPO_SALA']) ? $programacion_clase['Sala']['TIPO_SALA']:$programacion_clase['SalaReemplazo']['TIPO_SALA']; ?></td>
					<td><?php echo $programacion_clase['Detalle']['DETALLE']; ?></td>
					<td><?php echo $programacion_clase['EstadoProgramacion']['NOMBRE']; ?></td>
					<td><?php echo $programacion_clase['SubEstadoProgramacion']['NOMBRE']; ?></td>
					<td><?php echo date('d-m-Y',strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
					<td id="td-app-fecha-registro-programacion">
						<?php 
							if (!empty($programacion_clase['ProgramacionClase']['FECHA_REGISTRO'])) {
								echo date('d-m-Y',strtotime($programacion_clase['ProgramacionClase']['FECHA_REGISTRO']));
							}
						?>
					</td>
				</tr>
			</tbody>
		</table>	
	</div>
</div>
<?php $disabled_registrar = ($programacion_clase['ProgramacionClase']['WF_ESTADO_ID']>=1)? 'disabled':''; ?>
<div class="row" style="display:<?php echo !empty($disabled_registrar)? 'block':'none'; ?>;" id="div-asistencia">
<!-- 	<div class="col-md-12 m-b-30" align="center">
		<label class="checkbox checkbox-inline m-r-20">
			<input disabled type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i>
			Alumno Presente
		</label>
		<label class="checkbox checkbox-inline m-r-20">
			<input disabled type="checkbox"  value="" name="data[Alumno][uuid]"><i class="input-helper"></i>
			Alumno Ausente
		</label>	
	</div> -->
	<div class="col-md-12 m-b-30">
		<form 
			id="form-asistencia-alumnos"
			action="<?php echo $this->Html->url(array('action'=>'saveAsistenciaAlumnos',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
			method="POST">
			<table class="table table-striped" id="table-eventos" >
				<thead>
					<tr>
					<th class="td-app"><strong>N&deg;</strong></th>
						<th class="td-app"><strong>Rut</strong></th>
						<th style="text-align: left;" class="td-app"><strong>Apellido Paterno</strong></th>
						<th style="text-align: left;" class="td-app"><strong>Apellido Materno</strong></th>
						<th style="text-align: left;" class="td-app"><strong>Nombres</strong></th>
						
						<th class="td-app text-left"><strong>Carrera del Alumno</strong></th>
						<th class="td-app"><strong>Asistencia</strong></th>
						<th class="td-app text-left"><strong>Observaciones</strong></th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($alumnos as $key => $alumno): ?>
						<tr>
							<?php if (!empty($alumno['Asistencia']['ID'])): ?>
								<input 
									type="hidden" 
									name="data[Asistencia][<?php echo $alumno['Alumno']['ID']; ?>][presente]"
									value="<?php echo $alumno['Asistencia']['ID']; ?>"
									/>
							<?php endif; ?>
							<td class="text-center"><?php echo $key +1;?></td>
							<td><?php echo $alumno['Alumno']['RUT'];?></td>
							<td class="text-left"><?php echo (strtoupper($alumno['Alumno']['APELLIDO_PAT'])); ?></td>
							<td class="text-left"><?php echo (strtoupper($alumno['Alumno']['APELLIDO_MAT'])); ?></td>
							<td class="text-left"><?php echo (strtoupper($alumno['Alumno']['NOMBRES'])); ?></td>

							

							<td class="text-left"><?php echo strtoupper($alumno['Carrera']['COD_PLAN'].' - '.$alumno['Carrera']['NOMBRE']); ?></td>
						

					

<!-- =================================== ASISTENCIA CHECKBOX ======================================-->

              <td class="text-center">

              	<!-- AUSENTE ================================ -->
                  <label class="radio radio-inline m-r-20" style="margin-top: 0px;">
                    <input type="radio" value="0"
                     <?php if (!empty($alumno['Asistencia']['ID'])): ?>
                      <?php if ($alumno['Asistencia']['ASISTENCIA'] == 0): ?>
                        checked="checked"
                      <?php endif; ?>
                   
                    <?php endif; ?>

                    name="data[Asistencia][<?php echo $alumno['Alumno']['ID']; ?>][presente]"

                      <?php if ($alumno['Asistencia']['ASISTENCIA'] == 1) { ?>
                      <?php $dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']))/3600,2);
                      if ($dif>48)
							{ # bloquea los presentes despues de 48 horas para que no pueda editar ?>
								disabled
						<?php	}}
                       ?>

                    ><i class="input-helper"></i>Ausente
                  </label>

                <!-- PRESENTE ================================ -->
                  <label class="radio radio-inline m-r-20" style="margin-top: 0px;">
                    <input type="radio" value="1" 

                     <?php if (!empty($alumno['Asistencia']['ID'])): ?>
                      <?php if ($alumno['Asistencia']['ASISTENCIA'] == 1): ?>
                     
                        checked="checked"
                      <?php endif; ?>
                    <?php else: ?>
                      checked="checked"
                    <?php endif; ?>

                    name="data[Asistencia][<?php echo $alumno['Alumno']['ID']; ?>][presente]"

                     <?php $dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']))/3600,2);
                      if ($dif>48)
							{ # bloquea los presentes despues de 48 horas para que no pueda editar ?>
								disabled
						<?php	}
                       ?>

                    ><i class="input-helper"></i>Presente
                  </label>

                <!-- JUSTIFICADO ================================ -->
                  <label class="radio radio-inline m-r-20" style="margin-top: 0px;">
                    <input type="radio" value="2" 

                     <?php if (!empty($alumno['Asistencia']['ID'])): ?>
                      <?php if ($alumno['Asistencia']['ASISTENCIA'] == 2): ?>
                        checked="checked"
                      <?php endif; ?>
                  
                    <?php endif; ?>

                    name="data[Asistencia][<?php echo $alumno['Alumno']['ID']; ?>][presente]"

                       <?php if ($alumno['Asistencia']['ASISTENCIA'] == 1) { ?>
                      <?php $dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']))/3600,2);
                      if ($dif>48)
							{ # bloquea los presentes despues de 48 horas para que no pueda editar ?>
								disabled
						<?php	}}
                       ?>

                    ><i class="input-helper"></i> Justificado
              	  </label>
          
              </td>
<!-- ================================ END ASISTENCIA CHECKBOX =====================================-->
				<td class="text-left">
								<div class="fg-line">
									<input 
										name="data[Asistencia][<?php echo $alumno['Alumno']['ID']; ?>][observacion]"
										type="text" 
										class="form-control" 
										value="<?php echo $alumno['Asistencia']['OBSERVACION']; ?>"
										placeholder="Maximo 300 caracteres"
										maxlength="300" />
								</div>
							</td>

				
						</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</form>
	</div>
</div>
<div class="row">
	<div class="col-md-12" align="center">
		<?php $is_add = empty($programacion_clase['ProgramacionClase']['WF_ESTADO_ID'])?true:false; ?>
		
		<!-- RFD11 VALIDA BOTON INICIAR CLASE SI NO ESTA A LA ESPERA DE AUTORIZACION - MP 14-08 =================================================================== -->
		<?php if ($programacion_clase['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']=='1') { ?>
		<a  id="btn-iniciar-clase" class=" btn btn-sm btn-success disabled " ><i class="fa fa-exclamation-circle"></i>&nbsp;Autorizaci&oacute;n Pendiente</a>
		<?php } 
		else { 

			$a = strtotime('-15 min', strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']));
			$b = date('d-m-Y H:i:s', $a);
			$c = strtotime($FechaActual);
			$d = date('d-m-Y H:i:s',$c);
			$e = time();
			$f = strtotime('d-m-Y H:i:s', $e);

			if ($a < $c)
			{
		?>

		<a  id="btn-iniciar-clase" class=" btn btn-sm btn-success <?php echo $is_add?null:'display-none'; ?>" ><i class="fa fa-play"></i>&nbsp;Iniciar Clase</a>
		
		<?php } else { ?>

			<a  id="MSG1" class=" btn btn-sm btn-danger" ><i class="fa fa-hourglass-half"></i>&nbsp;Iniciar Clase</a>

		<?php } } ?>
		<!-- FIN VALIDACION BOTON INICIAR CLASE ================================================= -->

		<a  id="btn-finalizar-clase"  class=" btn btn-sm bgm-lightgreen disabled <?php echo $is_add?null:'display-none'; ?>"><i class="md md-done-all"></i>&nbsp;Finalizar Clase</a>
		<a  id="btn-agregar-bitacora" class="btn bgm-blue btn-sm <?php echo $is_add?'display-none':null; ?> animated fadeIn"><i class="fa fa-plus"></i>&nbsp;Agregar Bit&aacute;cora</a>
		<a  id="btn-registrar-asistencia" class=" btn btn-sm bgm-orange disabled <?php echo $is_add?null:'display-none'; ?>"><i class="md md-assignment"></i>&nbsp;Registrar Asistencia</a>
		<a  id="btn-guardar-asistencia" class=" btn btn-sm btn-success animated fadeIn <?php echo $is_add?'display-none':null; ?>"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a>
		<a  id="btn-salir" class="btn btn-sm btn-info btn-salir-listado"><i class="fa fa-arrow-left"></i>&nbsp;Salir</a>
		
		
	</div>
</div>

<script>
			// DO009 15 MINUTOS ANTES DE CLASES
			$('#MSG1').on('click', function(event){
				event.preventDefault();
				notifyUser('El bot&oacute;n estar&aacute; activo 15 minutos antes de la hora de inicio de la clase');
			});
			</script>


<script>
	hay_modificaciones = false;
	clase_finalizada = true;
	//clase_finalizada = <?php echo !empty($programacion_clase['ProgramacionClase']['WF_ESTADO_ID'])? 'true':'false'; ?>;
	$('.checkbox-asistencias').on('change',function(event){
		if (!hay_modificaciones) {
			hay_modificaciones = true;
		}
	});
	$('body').on('click','.btn-salir-listado',function(event) {
		var href = '<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])); ?>';
		if(clase_finalizada){
			if (hay_modificaciones) {
				swal({
		            title: "<?php echo __('¿Est&aacute; seguro de salir sin guardar los datos de la asistencia de los alumnos?'); ?>",   
		            text: "<?php echo __(''); ?>",
		            type: "warning",
		            showCancelButton: true, 
		            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
		            confirmButtonColor: "#DD6B55",   
		            confirmButtonText: "S&iacute;, estoy seguro!",   
		            closeOnConfirm: false,
		        }, function(){
		        	window.location = href;
		        });
	        }else{
	        	window.location = href;
	        }
        }else{
        	notifyUser('Debe finalizar la clase antes de salir.','info');
        	event.preventDefault();
        }
	});
	$('#btn-iniciar-clase').on('click',function(event){
		event.preventDefault();
		elemento_click = $(this);
		elemento_click.addClass('disabled');
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'iniciarClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type: 'POST',
			dataType: 'json',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
			elemento_click.removeClass('disabled');
		})
		.always(function(response) {
			if(response.status == 'success'){
				$('#btn-finalizar-clase, #btn-registrar-asistencia').removeClass('disabled');
				clase_finalizada = false;
			}else{
				elemento_click.removeClass('disabled');
			}
			notifyUser(response.mensaje,response.status);
		});
	});
	$('#btn-finalizar-clase').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		elemento_click.addClass('disabled');
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'finalizarClase',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type: 'POST',
			dataType: 'json',
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
			elemento_click.removeClass('disabled');
		})
		.always(function(response) {
			if(response.status != 'success'){
				elemento_click.removeClass('disabled');
			}else{
				clase_finalizada = true;
			}
			notifyUser(response.mensaje,response.status);
		});
	});
	$('#btn-guardar-asistencia').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		elemento_click.addClass('disabled');
		form = $('form#form-asistencia-alumnos');
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'json',
			data: form.serialize(),
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(response) {
			notifyUser(response.message,response.status);
			elemento_click.removeClass('disabled');
			hay_modificaciones = false;
		});
	});
	$('#btn-agregar-bitacora').on('click', function(event) {
		event.preventDefault();
		$('#modal-bitacora').find('.modal-content').html("<div align='center'></div>");
		$('#modal-bitacora').find('.modal-content div').html(img_cargando);
		$('#modal-bitacora').modal('show');
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'addBitacoraModal',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type: 'POST',
			dataType: 'html',
		})
		.fail(function() {
			$('#modal-bitacora').modal('hide');
		})
		.always(function(view) {
			$('#modal-bitacora').find('.modal-content').html(view);
		});
	});
	$('#btn-registrar-asistencia').on('click',function(event) {
		event.preventDefault();
		elemento_click = $(this);
		elemento_click.addClass('disabled');
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'registrarAsistencia',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>',
			type: 'POST',
			dataType: 'json',
		})
		.fail(function() {
			elemento_click.removeClass('disabled');
		})
		.always(function(response) {
			if (response.status == 'ok') {
				elemento_click.removeClass('disabled').hide();
				$('#btn-iniciar-clase').removeClass('disabled').hide();
				$('#btn-agregar-bitacora, #btn-guardar-asistencia , #div-asistencia').show();
			}else{
				elemento_click.removeClass('disabled');
			}
		});
		
	});
</script>