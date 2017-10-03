<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Horario y Carga Docente</h1>
		</div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding" style="padding-top: 10px;">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
		 			<label for="">Per&iacute;odo:</label>
		 			<select name="data[Filter][PERIODO]" id="select-periodo" class="form-control selectpicker" data-live-search="true">
		 				<option value="" ></option>
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
			<div class="col-md-2" id="contenedor-select-semana">
				<div class="form-group">
	 				<label for="">Semana:</label>
 					<label id="label-ningun-periodo">Seleccione un per&iacute;odo</label>
 				</div>
 			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="select-campo">B&uacute;scar en el campo:</label>
					<select name="select-campo" id="select-campo" class="form-control selectpicker">
						<option value="">Seleccione</option>
						<option value="campo_1">B&uacute;scar por ID Docente</option>
						<option value="campo_2">B&uacute;scar por Rut Docente</option>
						<option value="campo_3">B&uacute;scar por Nombre Docente</option>
					</select>
				</div>	
			</div>
			<div class="col-md-2">
				<div id="campo_1" class="form-group" style="display: none;">
		 			<label for="">ID Docente:</label>
		 			<input type="text" autocomplete="off" class="buscar-tipo-id-docente form-control"  />
		 		</div>	
				<div id="campo_2" class="form-group" style="display: none;">
		 			<label for="">Rut Docente:</label>
		 			<input autocomplete="off" type="text" class="buscar-tipo-rut-docente form-control" />
		 		</div>	
				<div id="campo_3" class="form-group" style="display: none;">
		 			<label for="">Nombre Docente:</label>
		 			<input autocomplete="off" type="text" class="buscar-tipo-nombre-docente form-control" />
		 		</div>	
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<input type="hidden" id="hidden-uuid-docente" value="" />
					<button action="sede" class="btn btn-success btn-block btn-submit" style="margin-top: 1px;">VER HORARIO SEDE</button>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<button action="duoc" class="btn btn-success btn-block btn-submit" style="margin-top: 2px;">VER CARGA ACAD&Eacute;MICA</button>
		 		</div>	
			</div>
		</div>
	</div>
</div>
<div id="contenedor-calendario">&nbsp;</div>
<script type="text/javascript">
	$(function(){
		$("#select-campo").change(function(){
		    var campo=$(this).val();
		    $("#campo_1 input[type=text], #campo_2 input[type=text], #campo_3 input[type=text], #hidden-uuid-docente").val('');
		    $("#campo_1, #campo_2, #campo_3").hide();
		    if (campo!='') {
		    	$("#"+campo).show();
		    }
		});
	});
	$(".buscar-tipo-id-docente").autocomplete({
		source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/Docente.COD_FUNCIONARIO",
		minLength: 2,
		select: function( event, ui ) {
			$('#hidden-uuid-docente').val(ui.item.uuid);
			$('span#nombre-docente-text').html(ui.item.nombre).hide();
		},
	});
	$(".buscar-tipo-rut-docente").autocomplete({
		source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/Docente.RUT",
		minLength: 2,
		select: function( event, ui ) {
			$('#hidden-uuid-docente').val(ui.item.uuid);
			$('span#nombre-docente-text').html(ui.item.nombre).hide();
		},
	});
	$(".buscar-tipo-nombre-docente").autocomplete({
		source: "<?php echo $this->Html->url(array('controller'=>'directores','action'=>'autocompletarDatos')) ?>/Docente.NOMBRE",
		minLength: 2,
		select: function( event, ui ) {
			$('#hidden-uuid-docente').val(ui.item.uuid);
			$('span#nombre-docente-text').html(ui.item.nombre).hide();
		},
	});




	$('#select-periodo').on('change',function(e){
		var periodo_seleccionado_id = $(this).val();
		if(periodo_seleccionado_id == ''){
			$('#contenedor-select-semana').html('<div class="form-group"><label for="">Semana:</label><label id="label-ningun-periodo">Seleccione un per&iacute;odo</label></div>');
			return false;
		}
		$.ajax({
			url: '<?php echo $this->Html->url(array("controller"=>"semanas","action"=>"getSemanasPorPeriodo"))?>'+'/'+periodo_seleccionado_id,
			type: 'GET',
			dataType: 'html'
		})
		.fail(function() {
			notifyUser("Ha ocurrido un error al intentar obtner los datos, favor intente m&aacute;s tarde.","danger");
		})
		.always(function(html) {
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
	$('.date-time-picker').datetimepicker({
		format: 'DD/MM/YYYY',
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


	$('.btn-submit').on('click', function(event) {
		filtro = $(this).attr('action');
		refrescarCalendario($(this));
	});
	var filtro = 'duoc';
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	var id_semana = undefined;
	function refrescarCalendario(elemento_click){
		if ($('#hidden-uuid-docente').val() != '') {
			$('#contenedor-calendario').html('<div align="center"></div>');
			$('#contenedor-calendario div').html(imagen_cargando);
			var periodo_id = $('#select-periodo').val();
			if(id_semana == undefined){
				id_semana = $('#select-semanas').val();
				if(id_semana == undefined || id_semana == 0) {
					id_semana=null;
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
	}
</script>