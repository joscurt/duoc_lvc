<?php 
	$deltaA=0;
	$deltaB=0;
	if (!empty($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])) {
		$inicio_real = strtotime($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION']);
		$inicio_programado = strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO']);
		$deltaA = $inicio_real-$inicio_programado;
		if ($deltaA < 0) {
			$deltaA = 0;
		}
	}
	if (!empty($programacion_clase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])) {
		$fin_real = strtotime($programacion_clase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION']);
		$fin_programado = strtotime($programacion_clase['ProgramacionClase']['HORA_FIN']);
		$deltaB = $fin_programado-$fin_real;
		if ($deltaB < 0) {
			$deltaB = 0;
		}
	}
	$minutos = ($deltaA+$deltaB)/60;
	$modulos = $minutos/45;
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Asistencia Docente</h1>
		</div>	
	</div>
</div>


<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Editar:</label>
					<select name="" id="" class="form-control select-modal selectpicker" data-live-search="true">
						<option>Seleccionar</option>
						<option value="registro-inicio-fin">Editar Registro de inicio y fin</option>
						<option value="recuperar-atrasos">Registro de Inicio y Fin</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Docente:</h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Rut</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombres</th>
							<?php if (!empty($docente_reemplazo)): ?>
								<th>Docente Reemplazo</th>
							<?php endif ?>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['Docente']['RUT'].'-'.$programacion_clase['Docente']['DV']; ?></td>
							<td><?php echo utf8_encode($programacion_clase['Docente']['APELLIDO_PAT']); ?></td>
							<td><?php echo utf8_encode($programacion_clase['Docente']['APELLIDO_MAT']); ?></td>
							<td><?php echo utf8_encode($programacion_clase['Docente']['NOMBRE']); ?></td>
							<?php if (!empty($docente_reemplazo)): ?>
								<td>
									<?php 
										echo ($docente_reemplazo['Docente']['NOMBRE'].' '.
											$docente_reemplazo['Docente']['APELLIDO_PAT'].' '.
											$docente_reemplazo['Docente']['APELLIDO_MAT']).' <br>'.
											$docente_reemplazo['Docente']['RUT'].'-'.$docente_reemplazo['Docente']['DV'];
									?>	
								</td>
							<?php endif ?>
						</tr>	
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Nombre asignatura</th>
							<th>Sigla-Secci&oacute;n</th>
							<th>Jornada</th>
							<th>Fecha programada</th>
							<th>Horario</th>
							<th>Sala</th>
							<?php if (!empty($programacion_clase['ProgramacionClase']['SALA_REEMPLAZO'])): ?>
								<th>Sala Reemplazo</th>
							<?php endif ?>
							<th>Tipo</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['Asignatura']['NOMBRE']; ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['SIGLA_SECCION']; ?></td>
							<td><?php echo $asignatura_horario['AsignaturaHorario']['COD_JORNADA'] == 'D'?'DIURNA':'VESPERTINO'; ?></td>
							<td><?php echo date('d-m-Y',strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])); ?></td>
							<td><?php echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' a '.date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])); ?></td>
							<td><?php echo $programacion_clase['ProgramacionClase']['SALA']; ?></td>
							<?php if (!empty($programacion_clase['ProgramacionClase']['SALA_REEMPLAZO'])): ?>
								<td><?php echo  $programacion_clase['ProgramacionClase']['SALA_REEMPLAZO']; ?></td>
							<?php endif ?>
							<td><?php echo $programacion_clase['ProgramacionClase']['TIPO_EVENTO']; ?></td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Estado</th>
							<th>Motivo</th>
							<th>M&oacute;dulos programados</th>
							<th>M&oacute;dulos por recuperar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td><?php echo $programacion_clase['EstadoProgramacion']['NOMBRE']; ?></td>
							<td><?php echo $programacion_clase['Detalle']['DETALLE'] ?></td>
							<td><?php echo number_format($modulos,0,',','.'); ?></td>
							<td><?php echo number_format($modulos,0,',','.'); ?></td>
						</tr>	
					</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Modificaciones:</h2>
				<?php foreach ($logs_evento as $key => $log): ?>
					<div class="bloque">
						<div class="bloque-top">
							<div class="column">
								<label>Detalle: </label><?php echo $log['LogEvento']['DETALLE']; ?>
							</div>
							<div class="column">
								<label>Creada por: </label><?php echo $log['LogEvento']['USUARIO_CREADOR']; ?>
							</div>
							<div class="column last">
								<label>Fecha: </label><?php echo date('d-m-Y H:i',strtotime($log['LogEvento']['CREATED'])); ?>
							</div>
						</div>
						<div class="bloque-bottom">
							<?php if (!empty($log['LogEvento']['CAMBIO_HORARIO_INICIO'])): ?>
								<div class="column">
									<label> <?php echo $log['LogEvento']['CAMBIO_HORARIO_INICIO']; ?></label>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['CAMBIO_HORARIO_FIN'])): ?>
								<div class="column">
									<label> <?php echo $log['LogEvento']['CAMBIO_HORARIO_FIN']; ?></label>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['MOTIVO'])): ?>
								<div class="column">
									<label>Motivo:  <?php echo $log['LogEvento']['MOTIVO']; ?></label>
								</div>
							<?php endif ?>
							<?php if (!empty($log['LogEvento']['OBSERVACIONES'])): ?>
								<div class="column">
									<label><?php echo $log['LogEvento']['OBSERVACIONES']; ?></label> 
								</div>
							<?php endif ?>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<a href="<?php echo $this->Html->url(array('action'=>'asistenciaDocente')); ?>"
						id="link-salir-sin-guardar"
						class="btn btn-default">VOLVER</a>
				</div>
			</div>
		</div>
	</div>
</div>


<div class="modal" id="recuperar_atrasos_retiros" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Registro de Inicio y Fin</h4>
            </div>
            <form action="<?php echo $this->Html->url(array('action'=>'saveRecuperarAtrasoRetiro', $programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12">
	                		<div class="form-group">
	                			<label for="">M&oacute;dulos a Recuperar:</label>
	                			<input type="number"
	                				required="required"
	                				name="data[ProgramacionClase][MODULOS]"
	                				max="<?php echo $programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>" 
	                				class="form-control" />
	                		</div>
	                		<div class="form-group">
	                			<label for="">Motivo:</label>
	                			<select name="data[ProgramacionClase][MOTIVO]" class="form-control selectpicker" data-live-search="true">
	                				<option value=""></option>
	                				<?php foreach ($motivos as $key => $value): ?>
	                					<option value="<?php echo $key; ?>"><?php echo $value; ?></option>
	                				<?php endforeach ?>
	                			</select>
	                		</div>
	                		<div class="form-group">
	                			<label for="">Observaciones:</label>
	                			<textarea name="data[ProgramacionClase][OBSERVACIONES]" rows="5" class="form-control"></textarea>
	                		</div>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="submit" class="btn btn-success">GUARDAR</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">SALIR</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<div class="modal" id="registro_inicio_fin" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Registro de Inicio y Fin</h4>
            </div>
            <form name="dataForm" id="dataForm" action="<?php echo $this->Html->url(array('action'=>'saveCambioHorario',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
	            <div class="modal-body">
	                <div class="row">
	                	<div class="col-md-12">
	                		<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
								<thead>
									<tr>
										<th>Hora inicio</th>
										<th>Hora fin</th>
										<th>Registro inicio</th>
										<th>Registro fin</th>
										<th>Total a recuperar</th>
										<th>M&oacute;dulos a recuperar</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td>
											<input type="text" 
												id="horaInicial"
												disabled="disabled" 
												value="<?php echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])); ?>"
												class="form-control text-center"
											/>
										</td>
										<td>
											<input type="text" 
												id="horaFinal"
												disabled="disabled" 
												value="<?php echo date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])); ?>"
												class="form-control text-center"
											/>
										</td>
										<td>
											<input type="text" 
												name="data[Horario][FECHA_INICIO_PROGRAMACION]" 
												id="registroInicial"
												required="required" 
												maxlength="5"
												value="<?php echo (!empty($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])? date('H:i',strtotime($programacion_clase['ProgramacionClase']['FECHA_INICIO_PROGRAMACION'])):null); ?>" 
												class="form-control text-center calculaDeltas"
											/>
										</td>
										<td>
											<input type="text" 
												name="data[Horario][FECHA_FINALIZADA_PROGRAMACION]"
												id="registroFinal"
												required="required" 
												maxlength="5" 
												value="<?php echo (!empty($programacion_clase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])? date('H:i',strtotime($programacion_clase['ProgramacionClase']['FECHA_FINALIZADA_PROGRAMACION'])):null); ?>" 
												class="form-control text-center calculaDeltas"
											/>
										</td>
										<td>
							    			<input 
							    				type="text" 
							    				id="totalRecuperar" 
							    				value="<?php echo number_format($minutos,0,',','.').' min'; ?>" 
							    				class="form-control text-center" 
							    				disabled="disabled" 
							    			/>
										</td>
										<td>
							    			<input 
							    				type="hidden" 
							    				id="validarModulos" 
							    				value="<?php echo $programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>" 
							    				disabled="disabled" 
							    			/>
							    			<input 
							    				type="text" 
							    				id="validarRecuperar" 
							    				value="<?php echo number_format($modulos,0,',','.'); ?>" 
							    				class="form-control text-center" 
							    				disabled="disabled" 
							    			/>
							    		</td>
									</tr>
									<tr>
										<td height="30" colspan="6">
				                			<p id="imgLoader" class="text-center" style="display: none;">
				                				<?php echo ($this->Html->image('ajax-loader.gif', array('height' => 22))); ?>
				                			</p>
										</td>
									</tr>	
								</tbody>
							</table>
	                	</div>
	                </div>
	            </div>
	            <div class="modal-footer">
	                <button type="button" id="btnSubmit" class="btn btn-success">guardar</button>
	                <button type="button" class="btn btn-default" data-dismiss="modal">salir</button>
	            </div>
            </form>
        </div>
    </div>
</div>
<?php echo $this->Html->script(array("../material/js/jquery.mask.js",)); ?>
<script type="text/javascript">
	function setearHora(hora){
		var ini, fin, aux;
		ini=parseInt( hora.substring(0, 2) );
		fin=parseInt( hora.substring(3, 5) );
		//alert(hora+'ini='+ini+'fin='+fin);
		aux=hora.substring(0, 2)+':';
		if(ini>23) aux='23:';
		if(fin>59) { 
			aux=aux+'59';
		}else{
			aux=aux+hora.substring(3, 5);
		}
		return aux;
	}	

	$(function(){
		
		$('.select-modal').change(function () {
			if ($(this).val() == "recuperar-atrasos") {
				$('#recuperar_atrasos_retiros').modal('show');
			}
			if ($(this).val() == "registro-inicio-fin") {
				$('#registro_inicio_fin').modal('show');
			}
		});

		$('.calculaDeltas').mask('00:00');

		$("#btnSubmit").click(function() {
			var error;
            if( $("#registroInicial").val().length==5 && $("#registroFinal").val().length==5){
            	
            	$("#registroInicial").val( setearHora( $("#registroInicial").val() ) );
				$("#registroFinal").val( setearHora( $("#registroFinal").val() ) );

				$("#imgLoader").show();
	            $.ajax({
	                url: '<?php echo $this->Html->url(array('action'=>'getDeltas')); ?>',
	                type: 'POST',
	                dataType: 'json',
	                data:{ 
	                	inicio_programado : "<?php echo $programacion_clase['ProgramacionClase']['HORA_INICIO']; ?>", 
	                	fin_programado : "<?php echo $programacion_clase['ProgramacionClase']['HORA_FIN']; ?>", 
	                	inicio_real : $("#registroInicial").val(), 
	                	fin_real : $("#registroFinal").val()
	                },
	            }).fail(function() {
	            	$("#imgLoader").hide();
	                notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
	            }).always(function(response) {
					$("#totalRecuperar").val(response.minutos+' min.');
					$("#validarRecuperar").val(response.modulos);
					
	            	//console.log(response);
					if (response.mensaje != '') {
						notifyUser(response.mensaje, 'info');
						$(".alert-info").css("z-index", "20000");
						$("#imgLoader").hide();
						return false;
					}
					if (response.modulos>$("#validarModulos").val()) {
						notifyUser('Solo se permite un m&aacute;ximo: '+$("#validarModulos").val()+' M&oacute;dulos a recuperar.','info');
						$(".alert-info").css("z-index", "20000");
						$("#imgLoader").hide();
						return false;
					}
					$( "#dataForm" ).submit();
	            }); 
            }else{
				notifyUser('Por favor verifique los formatos de fecha.', 'info');
				$(".alert-info").css("z-index", "20000");
				return false;
            }
		});
	});
</script>



