<style>
	.ui-autocomplete {
	    max-height: 100px;
	    overflow-y: auto;
	    overflow-x: hidden;
	    padding-right: 20px;
	    z-index: 1200;
	}
	* html .ui-autocomplete {
	    height: 100px;
	}
	.alert.alert-dismissable.growl-animated{
		z-index: 1201 !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Reportes</h1>
		</div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label for="">Seleccionar tipo de reporte</label>
					<select id="select-tipo-de-reporte" name="" class="form-control selectpicker">
						<option value="" selected>Seleccionar</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reporteTasaAsistencia')); ?>">Tasa de Asistencia y RI del Alumno</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reporteCumplimientoAsistencia')); ?>">Cumplimiento de Registro de Asistencia Docente</option>
					</select>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card" id="contenedor-encabezado">
	<div class="card-body card-padding">
		
	</div>
</div>
<div class="card" id="contenedor-grilla" style="display: none;">
	<div class="card-body card-padding">
		
	</div>
</div>
<script>
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif',array('width'=>'50%')); ?>');
	$('#select-tipo-de-reporte').on('change',function (event) {
		if (event.target.value != '') {
			$('#contenedor-encabezado .card-body').html('<div align="center"></div>');
			$('#contenedor-encabezado .card-body div').html(imagen_cargando);
			$.ajax({
				url: event.target.value,
				type: 'POST',
				dataType: 'html',
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
				$('#contenedor-encabezado .card-body').empty();
				$('#contenedor-grilla').hide();
			})
			.always(function(view) {
				$('#contenedor-encabezado .card-body').html(view);
				$('#contenedor-grilla').hide();
			});
		}
	});
	$('#form-filtro-basico').off('submit');
	$('body').on('submit','#form-filtro-basico',function (event) {
		form = $(this);
		event.preventDefault();
		error = 0;
		form.find('[mandatory]').each(function(index, el) {
			if($(this).val() == ''){
				notifyUser($(this).attr('text-error'),'danger');
				error++;
			}
		});
		if (error == 0) {
			$('#contenedor-grilla .card-body').html('<div align="center"></div>');
			$('#contenedor-grilla .card-body div').html(imagen_cargando);
			$('#contenedor-grilla').show();
			$.ajax({
				url: form.attr('action'),
				type: 'POST',
				dataType: 'html',
				data:form.serialize(),
			})
			.fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','info');
				$('#contenedor-grilla .card-body').empty();
			})
			.always(function(view) {
				$('#contenedor-grilla .card-body').html(view);
			});
		}
	});	
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
	$('.time-picker').datetimepicker({
		format: 'LT'
	});
</script>