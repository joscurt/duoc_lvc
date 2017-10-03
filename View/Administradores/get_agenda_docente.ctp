<?php 
	$text = $filtro == 'duoc' ? "Carga Ac&aacute;demica": "Carga Ac&aacute;demica de la Sede";
	//$left = 1;
	//$right = 3;
#	debug($semana);
?>
<div class="row content-calendar ">
	<div class="col-md-12">
		<div class="card">
			<div class="card-header">
				<h2 style="border-bottom: 1px solid #0c253d;"><label>
					<?php echo $text ?>:&nbsp;</label>&nbsp;&nbsp;&nbsp;
					<span id="nombre-docente-text">
						<?php echo $docente['Docente']['NOMBRE']." ".$docente['Docente']['APELLIDO_PAT']. " ". $docente['Docente']['APELLIDO_MAT'] ?>
					</span>
				</h2>
			</div>
			<div class="card-body card-padding" style="padding-top: 0px;">
				<div class="row">
					<div class="col-md-12">
						<div class="paginador-semanas">
							<a href="#move-week" data-action="left" title="Semana Anterior"><i class="fa fa-arrow-left" aria-hidden="true"></i></a>
							<div class="botones-semanas">
								<?php 
									
									$contador_show=4;
									$semana_selected = isset($semana['Semana']['ID'])?$semana['Semana']['ID']:null;
									$nro_semana_selected=isset($semana['Semana']['ID'])?$semana['Semana']['NUMERO_SEMANA']:1; 
									#debug($nro_semana_selected);
									$contador_semanas = count($semanas);
									foreach ($semanas as $key => $value): 
										$pintar=false;	
										if ($value['Semana']['NUMERO_SEMANA'] == ($nro_semana_selected-1)) {
											$pintar=true;	
										}else if($value['Semana']['NUMERO_SEMANA'] == ($nro_semana_selected+1)){
											$pintar=true;	
										}else if($value['Semana']['NUMERO_SEMANA'] == ($nro_semana_selected)){
											$pintar=true;	
										}
										if ($nro_semana_selected == 1 && $value['Semana']['NUMERO_SEMANA']==3) {
											$pintar = true;
										}
										if ($nro_semana_selected == $contador_semanas && $value['Semana']['NUMERO_SEMANA']==($nro_semana_selected-2)) {
											$pintar = true;
										}

										/*if($pintar){
											if($value['Semana']['NUMERO_SEMANA'] > 2){
												$left = (int)$value['Semana']['NUMERO_SEMANA'] -1;
												$right = (int)$value['Semana']['NUMERO_SEMANA'] +1;
											}
										}*/
								?>
									<a
										href="#change-week" 
										style="display:<?php echo !$pintar?'none':'inline-block'; ?>" 
										class="link-change-week pager <?php echo $value['Semana']['ID']==$semana_selected?'active':null; ?> "
										data-cod="<?php echo $value['Semana']['ID']; ?>"
										data-nro-semana="<?php echo $value['Semana']['NUMERO_SEMANA']; ?>"
										>
										Semana
										<?php echo $value['Semana']['NUMERO_SEMANA']; ?> 
										/ Lun <?php echo date('d-m-y',strtotime($value['Semana']['FECHA_INICIO'])); ?> a 
										S&aacute;b <?php echo date('d-m-y',strtotime($value['Semana']['FECHA_FIN'])); ?>	
									</a>
								<?php endforeach; ?>
							</div>
							<a href="#move-week" data-action="right" title="Semana Siguiente"><i class="fa fa-arrow-right" aria-hidden="true"></i></a>
						</div>
						<div class="content-tablas" id="contenedor-calendario-semanas">
							<table border="0" cellpadding="0" cellspacing="0" class="table table-striped big size-7 borde disponibilidadSala">
								<thead>
									<tr>
										<th style="text-align:center">Semana</th>
										<th style="text-align:center">Lunes</th>
										<th style="text-align:center">Martes</th>
										<th style="text-align:center">Mi&eacute;rcoles</th>
										<th style="text-align:center">Jueves</th>
										<th style="text-align:center">Viernes</th>
										<th style="text-align:center">S&aacute;bado</th>
									</tr>
								</thead>
							  	<tbody>
							  		<?php 
							  			$contador=0;
							  			$modulos_siguientes = array();
							  			foreach ($horarios_modulos as $key => $horario): #debug($horario);
							  				$contador++;
							  				$class_tr = $contador%2==0?'odd':'even';
							  				$hora_inicio = $horario['HorarioModulo']['HORA_INICIO'];
							  		?>
									  	<tr class="<?php echo $class_tr; ?>" align="center">
								    		<td style="vertical-align:middle;"><?php echo $hora_inicio; ?> - <?php echo $horario['HorarioModulo']['HORA_FIN']; ?></td>
										    <?php for ($i=1; $i < 7; $i++): ?>
										    	<td style="vertical-align:middle;">
											    	<?php 
											    		if (isset($programacion_clases[$hora_inicio][$i])):
											    			echo $programacion_clases[$hora_inicio][$i]['ProgramacionClase']['SIGLA_SECCION'].' <br> '.
											    			$programacion_clases[$hora_inicio][$i]['Asignatura']['NOMBRE'];
											    			if ($filtro == 'duoc') {
											    				echo ' <br> '.$programacion_clases[$hora_inicio][$i]['Sede']['NOMBRE'];
											    			}
											    		endif;
											    	?>
											    <!-- <td class="gris">TAI2011- 002D(P)<br /> T&Eacute;CNICA DE ARQ... <br /><strong>SEDE:ALAMEDA</strong></td> -->
											    </td>
											<?php endfor; ?>
									  	</tr>	
								  	<?php endforeach ?>
							  	</tbody>
							</table>
							<?php if (isset($semana['Semana']['ID'])): ?>

								<div class="card-header">
									<a href="<?php echo $this->Html->url(array('action'=>'pdfHorarioCargaDocente',$cod_docente,$filtro,$semana['Semana']['ID'])); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a>
									<a href="<?php echo $this->Html->url(array('action'=>'excelHorarioCargaDocente',$cod_docente,$filtro,$semana['Semana']['ID'])); ?>" target="_blank" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;EXPORTAR EXCEL</a>
									<a href="<?php echo $this->Html->url(array('action'=>'imprimirHorarioCargaDocente',$cod_docente,$filtro,$semana['Semana']['ID'])); ?>" target="_blank" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;IMPRIMIR</a>
								</div>
							<?php endif ?>
						</div>		
					</div>
				</div>
			</div>
		</div>
	</div>	
</div>
<script type="text/javascript">
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
	$('.link-change-week').on('click', function(event) {
		event.preventDefault();
		elemento_click = $(this);
		$('.link-change-week').removeClass('active');
		elemento_click.addClass('active');
		id_semana = $('.botones-semanas').find('a.active[href="#change-week" ]').attr('data-cod');
		refrescarCalendario();
	});
	$('a[href="#move-week"]').on('click', function(event) {
		event.preventDefault();
		moveWeek($(this));
	});
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	/*function refrescarCalendario(elemento_click){
		if ($('#hidden-uuid-docente').val() != '') {
			var id_semana = $('.paginador-semanas').find('.active[href="#change-week" ]').attr('data-cod');
			$('#contenedor-calendario').html('<div align="center"></div>');
			$('#contenedor-calendario div').html(imagen_cargando);
			
			var periodo_id = $('#select-periodo').val();
			if(id_semana == undefined){
				id_semana = $('#select-semanas').val();
				if(id_semana == undefined || id_semana == 0) {
					id_semana='';
				}
			}
			if(periodo_id == undefined){
				periodo_id = $('#select-periodo').val();
				if(periodo_id == undefined || periodo_id == 0) {
					periodo_id='';
				}
			}
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'getAgendaDocente')); ?>'+'/'+$('#hidden-uuid-docente').val()+'/'+filtro+'/'+id_semana+'/'+periodo_id,
				type: 'POST',
				dataType: 'html',
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
				$('#contenedor-calendario').empty();
			})
			.always(function(view) {
				$('#contenedor-calendario').html(view);
				$('span#nombre-docente-text').show();
				$('.content-calendar').show();
			});
		}else{
			notifyUser('Es necesario ingresar al menos un campo de b&uacute;squeda referente a la informaci&oacute;n del docente', 'info');
		}
	}*/

</script>