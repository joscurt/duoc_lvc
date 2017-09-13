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
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reporteNominaClasesRecuperarAdelantar')); ?>">Nómina Diaria de Clases a Recuperar y Adelantar</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reporteNominaClasesProgramadas')); ?>">Nómina Diaria de Clases Programadas</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reportePeriodicoClasesProgramadas')); ?>">Reportes Periódicos de Clases Programadas (realizadas y no realizadas)</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reportePeriodicoClasesAdelantadasRecuperadas')); ?>">Reportes Periódicos de Clases Adelantadas y Recuperadas (realizadas y no realizadas)</option>
						<option value="<?php echo $this->Html->url(array('controller'=>'reportes','action'=>'reportePresenciaDocente')); ?>">Reporte de Presencia Docente</option>
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
<script type="text/javascript">
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif',array('width'=>'50%')); ?>');
	$('#select-tipo-de-reporte').on('change',function (event) {
		if (event.target.value != '') {
			$('#contenedor-encabezado .card-body').html('<div align="center"></div>');
			$('#contenedor-encabezado .card-body div').html(imagen_cargando);
			$.ajax({
				url: event.target.value,
				type: 'POST',
				dataType: 'html',
			}).fail(function(error_reader) {
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
				$('#contenedor-encabezado .card-body').empty();
				$('#contenedor-grilla').hide();
			}).always(function(view) {
				$('#contenedor-encabezado .card-body').html(view);
				$('#contenedor-grilla').hide();
			});
		}
	});
	
	$('body').on('submit','#form-filtro-basico',function (event) {
		form = $(this);
		event.preventDefault();
		$('#contenedor-grilla .card-body').html('<div align="center"></div>');
		$('#contenedor-grilla .card-body div').html(imagen_cargando);
		$('#contenedor-grilla').show();
		$.ajax({
			url: form.attr('action'),
			type: 'POST',
			dataType: 'html',
			data:form.serialize(),
		}).fail(function(error_reader) {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','info');
			$('#contenedor-grilla .card-body').empty();
		}).always(function(view) {
			$('#contenedor-grilla .card-body').html(view);
		});
	});

	$('.time-picker').datetimepicker({
		format: 'LT'
	});
</script>