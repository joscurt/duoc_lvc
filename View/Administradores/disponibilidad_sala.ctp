<?php //debug($this->data); ?>
<style type="text/css">.div-responsive{max-height: 50px;}</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header"><h1>Disponibilidad Sala</h1></div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<form action="<?php echo $this->Html->url(array('action'=>'disponibilidadSala')); ?>" method="POST">
			<div class="row">
				<div class="col-md-2">
					<div class="form-group">
			 			<label for="">Período:</label>
			 			<select id="select-periodo" name="data[Filter][PERIODO]" class="form-control selectpicker" data-live-search="true">
			 				<option value=""></option>
			 				<?php foreach ($periodos as $key => $value): ?>
			 					<option 
			 						<?php if (!empty($periodo_seleccionado) && $periodo_seleccionado == $value['Periodo']['ID']): ?>
			 							selected="selected"
			 						<?php endif ?>
			 						value="<?php echo $value['Periodo']['ID']; ?>" ><?php echo $value['Periodo']['ANHO']."-".$value['Periodo']['SEMESTRE']; ?></option>
			 				<?php endforeach ?>
			 			</select>
			 		</div>	
				</div>


				<?php if (isset($this->data['Filter']['PERIODO'])): ?>
					<div class="col-md-2" id="contenedor-select-semana">
						<div class="form-group">
				 			<label for="">Semana:</label>
				 			<select
				 				name="data[Filter][SEMANA]" 
				 				class="form-control selectpicker" 
				 				data-live-search="true">
				 				<option value="" ></option>
				 				<?php foreach ($semanas_listado as $key => $value): ?>
				 					<option 
				 						<?php if (isset($this->data['Filter']['SEMANA']) && $this->data['Filter']['SEMANA'] == $value['Semana']['ID']): ?>
				 							selected="selected"
				 						<?php endif ?>
				 						value="<?php echo $value['Semana']['ID']; ?>" >
				 							SEMANA <?php echo $value['Semana']['NUMERO_SEMANA'].' / '.date('d-m-Y',strtotime($value['Semana']['FECHA_INICIO'])).' - '.date('d-m-Y',strtotime($value['Semana']['FECHA_FIN'])); ?>	
				 					</option>
				 				<?php endforeach ?>
				 			</select>
				 		</div>	
					</div>
				<?php else: ?>
					<div class="col-md-2" id="contenedor-select-semana">
						<div class="form-group">
			 				<label for="">Semana:</label>
			 				<select class="form-control" >
			 					<option value="">Requiere Período</option>
			 				</select>
		 				</div>
		 			</div>
		 		<?php endif; ?>

				<div class="col-md-2">
					<div class="form-group">
			 			<label for="">Capacidad:</label>
			 			<select id="capacidad" name="data[Filter][CAPACIDAD]" class="form-control selectpicker" data-live-search="true">
			 				<option value="">Seleccione</option>
			 				<?php 
			 					foreach ($capacidades as $key => $value): ?>
			 					<option 
									<?php if (isset($this->data['Filter']['CAPACIDAD']) && (!empty($this->data['Filter']['CAPACIDAD'])) && ((int)$this->data['Filter']['CAPACIDAD'] == (int)$value)): ?>
			 							selected="selected"
			 						<?php endif ?>
			 						value="<?php echo ($value); ?>"> <?php echo 'Capacidad: '.($value); ?> </option>
			 				<?php endforeach; ?>
			 			</select>
			 		</div>	
				</div>

				<div class="col-md-2">
					<div class="form-group">
			 			<label for="">Sala:</label>
			 			<div id="getSalas">
				 			<select id="filterSala" name="data[Filter][SALA]" class="form-control selectpicker" data-live-search="true">
				 				<option value="">Seleccione</option>
				 			</select>
			 			</div>
			 		</div>	
				</div>

				<div class="col-md-1">
					<div class="form-group">
			 			<label for="">Desde:</label>
			 			<select name="data[Filter][HORA_INICIO]" class="form-control selectpicker" data-live-search="true">
			 				<option value=""></option>
			 				<?php 
			 					sort($horarios_modulos);
			 					foreach ($horarios_modulos as $key => $value): ?>
			 					<option 
									<?php if (isset($this->data['Filter']['HORA_INICIO']) && $this->data['Filter']['HORA_INICIO'] == $value['HorarioModulo']['ID']): ?>
			 							selected="selected"
			 						<?php endif ?>
			 						value="<?php echo $value['HorarioModulo']['ID']; ?>"><?php echo $value['HorarioModulo']['HORA_INICIO']; ?></option>
			 				<?php endforeach; ?>
			 			</select>
			 		</div>	
				</div>

				<div class="col-md-1">
					<div class="form-group">
			 			<label for="">Hasta:</label>
			 			<select name="data[Filter][HORA_FIN]" class="form-control selectpicker" data-live-search="true">
			 				<option value=""></option>
			 				<?php 
			 					sort($horarios_modulos);
			 					foreach ($horarios_modulos as $key => $value): ?>
			 					<option 
									<?php if (isset($this->data['Filter']['HORA_FIN']) && $this->data['Filter']['HORA_FIN'] == $value['HorarioModulo']['ID']): ?>
			 							selected="selected"
			 						<?php endif ?>
			 						value="<?php echo $value['HorarioModulo']['ID']; ?>"><?php echo $value['HorarioModulo']['HORA_FIN']; ?></option>
			 				<?php endforeach; ?>
			 			</select>
			 		</div>	
				</div>

				<div class="col-md-2">
					<div class="form-group">
						<button type="submit" class="btn btn-success" style="margin-top: 24px;">BUSCAR</button>
			 		</div>	
				</div>
				
			</div>
		</form>
	</div>
</div>
<div class="card">
	<?php if (!empty($salas)): ?>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-12">
					<?php 
						$class_responsive = '';
						$nro_salas = count($salas);
						if ($nro_salas > 15):
							$class_responsive = 'div-responsive';
							echo "<div style='overflow:auto'>";
						else:
							$nro_salas = 10;
						endif; 
					?>
					<div class="tabs-content <?php echo $class_responsive; ?>" style="width:<?php echo $nro_salas*30;?>px;">
						<?php
							$sala_selected = isset($sala_selected) && !empty($sala_selected) ? $sala_selected : $salas[0]['Sala']['COD_SALA'];
							foreach ($salas as $key => $sala): 
						?>
							<div class="tab tab-<?php echo $key; ?> div-content-link-change-sala <?php echo $sala['Sala']['COD_SALA']==$sala_selected?'active':null; ?>">
								<a 
									href="#cambiar-sala" 
									data-cod="<?php echo $sala['Sala']['COD_SALA']; ?>"

									class="link-change-sala "
									>Sala <?php echo $sala['Sala']['COD_SALA']; ?></a>
							</div>
						<?php endforeach; ?>
					</div>	
					<?php if ($nro_salas > 15):
						echo "</div>";
					endif; ?> 
				</div>
				<div class="col-md-12">
					<div class="paginador-semanas">
						<a href="#move-week" data-action="left" title="Semana Anterior"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
						<div class="botones-semanas">
							<?php 
								$contador_show=0;
								$semana_selected = isset($semana_selected) && !empty($semana_selected) ? $semana_selected : $semanas[0]['Semana']['ID'];
								foreach ($semanas as $key => $value): 
									$contador_show++;
							?>
								<a href="#change-week" 
									style="display:<?php echo $contador_show > 3?'none':'inline-block'; ?>" 
									class="link-change-week pager <?php echo $value['Semana']['ID']==$semana_selected?'active':null; ?> "
									data-cod="<?php echo $value['Semana']['ID']; ?>"
									data-nro-semana="<?php echo $value['Semana']['NUMERO_SEMANA']; ?>"
									>
									Semana 
									<?php echo $value['Semana']['NUMERO_SEMANA']; ?> 
									/ Lun <?php echo date('d-m-y',strtotime($value['Semana']['FECHA_INICIO'])); ?> a 
									Sáb <?php echo date('d-m-y',strtotime($value['Semana']['FECHA_FIN'])); ?>	
								</a>
							<?php endforeach; ?>
						</div>
						<a href="#move-week" data-action="right" title="Semana Siguiente"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
					</div>
					<div class="content-tablas" id="contenedor-calendario-salas">
					</div>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>




<script type="text/javascript">
	$(function(){
		var options='<select id="filterSala" name="data[Filter][SALA]" class="form-control selectpicker" data-live-search="true">';
			options+='<option value="">Seleccione</option>';
			options+='</select>';
		$('#capacidad').on('change',function(e){
			$('#getSalas').html(options);
			if ($(this).val()!='') {
				$.ajax({
					method: "POST",
					url: "<?php echo $this->Html->url(array('action'=>'optenerSalasPorCapacidad')); ?>",
					data: { capacidad: $(this).val() },
					dataType: "html"
				}).fail(function(error_reader) {
					notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
				}).always(function(htmlOptions) {
					if (htmlOptions.indexOf("<error>") >= 0){
						var mensaje_error = htmlOptions.replace('<error>','');
						 mensaje_error = mensaje_error.replace('</error>','');
						notifyUser(mensaje_error,"danger");		 
					}else{
						$('#getSalas').html(htmlOptions);
					}
				});
			}
		});
	});

	$('#select-periodo').on('change',function(e){
		var periodo_seleccionado_id = $(this).val();
		if(periodo_seleccionado_id == ''){
			$('#contenedor-select-semana').html('<div class="form-group"><label for="">Semana:</label><select class="form-control"><option value="">Requiere Período</option></select></div>');
			return false;
		}
		$.ajax({
			url: '<?php echo $this->Html->url(array("controller"=>"semanas","action"=>"getSemanasPorPeriodo"))?>'+'/'+periodo_seleccionado_id,
			type: 'GET',
			dataType: 'html'
		}).fail(function() {
			notifyUser("Ha ocurrido un error al intentar obtner los datos, favor intente más tarde.","danger");
		}).always(function(html) {
			var textHtml = html;
			if (textHtml.indexOf("<error>") >= 0){
				var mensaje_error = textHtml.replace('<error>','');
				 mensaje_error = mensaje_error.replace('</error>','');
				notifyUser(mensaje_error,"danger");		 
			}else{
				$('#contenedor-select-semana').html(html);
			}
		});
		
	})
	<?php if (!empty($salas)): ?>
		refrescarCalendario();
	<?php endif;?>
	$('.date-time-picker').datetimepicker({
		format: 'DD/MM/YYYY',
	});
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	$('.link-change-sala').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		$('.div-content-link-change-sala').removeClass('active');
		elemento_click.parents('.div-content-link-change-sala').addClass('active');
		refrescarCalendario();
	});
	$('.link-change-week').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		$('.link-change-week').removeClass('active');
		elemento_click.addClass('active');
		refrescarCalendario();
	});
	$('a[href="#move-week"]').on('click', function(event) {
		event.preventDefault();
		moveWeek($(this));
	});
	var left_week = 1;
	var right_week = 3;
	function moveWeek(elemento_click){
		if(elemento_click.attr('data-action')=='left'){
			if(left_week>1){
				$('.link-change-week[data-nro-semana="'+(left_week-1)+'"]').show();
				$('.link-change-week[data-nro-semana="'+(right_week)+'"]').hide();
				left_week = left_week-1;
				right_week = right_week-1;
			}
		}else{
			if ($('.link-change-week[data-nro-semana="'+(right_week+1)+'"]')[0]) {
				$('.link-change-week[data-nro-semana="'+(left_week)+'"]').hide();
				$('.link-change-week[data-nro-semana="'+(right_week+1)+'"]').show();
				left_week = left_week+1;
				right_week = right_week+1;
			}
		}
	}
	var id_semana_default = '<?php echo $semana_selected;?>';
	function refrescarCalendario(){
		$('#contenedor-calendario-salas').html('<div align="center"></div>');
		$('#contenedor-calendario-salas div').html(imagen_cargando);
		var cod_sala = $('.div-content-link-change-sala.active').find('.link-change-sala').attr('data-cod');
		var id_semana = $('a.active[href="#change-week" ]').attr('data-cod');
		var hora_inicio = '<?php echo isset($this->data['Filter']['HORA_INICIO'])?$this->data['Filter']['HORA_INICIO']:null; ?>';
		var hora_fin = '<?php echo isset($this->data['Filter']['HORA_FIN'])?$this->data['Filter']['HORA_FIN']:null; ?>';
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getAgendaSalasDisponibles')); ?>'+'/'+cod_sala+'/'+id_semana+'/'+hora_inicio+'/'+hora_fin,
			type: 'POST',
			dataType: 'html',
		})
		.fail(function(error_reader) {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
			$('#contenedor-calendario-salas').empty();
		})
		.always(function(view) {
			$('#contenedor-calendario-salas').html(view);
		});
	}
</script>
