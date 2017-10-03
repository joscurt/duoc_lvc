<?php 
	$filtros_posibles = array(
		'Docente.RUT'=>'Rut docente',
		'Docente.NOMBRE'=>'Nombre docente',
		'Docente.COD_FUNCIONARIO'=>'ID docente',
		'Asignatura.NOMBRE'=>'Nombre asignatura',
		'ProgramacionClase.SIGLA_SECCION'=>'Sigla - Secci&oacute;n',
		'ProgramacionClase.COD_JORNADA'=>'Jornada',
		'ProgramacionClase.horario'=>'Horario',
		'ProgramacionClase.detalle'=>'Detalle',
		'ProgramacionClase.sub_estado'=>'Sub-Estado',
	);
	$datos_filtro = null;
	/*$asd = date('d-m-Y',strtotime($prog_ade['ProgramacionClase']['FECHA_CLASE']));

	$date = new DateTime($periodoActual['Periodo']['FECHA_INICIO']);
	$datos_filtro['Filtro']['fecha_inicio']=$date->format('d-m-Y');*/


	$datos_filtro['Filtro']['fecha_inicio'] = date('d-m-Y',strtotime($periodoActual['Periodo']['FECHA_INICIO']));
	$date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
	$datos_filtro['Filtro']['fecha_fin']=$date->format('d-m-Y');
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Solicitud de Recuperaci&oacute;n</h1>
		</div>	
	</div>
</div>
<div id="filtro_simple" class="card">
	<div class="card-body card-padding">
		<div class="row">
			<?php 
				echo $this->element('filtros_simples',array(
					'filtros_posibles'=>$filtros_posibles,
					'url_action'=>'getTableSolicitudRecuperacion',
					'datos_filtro'=>$datos_filtro,
				)); 
			?>
			<div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-default cambiar-filtro-multiple" style="margin-top: 27px;">Filtro m&uacute;ltiple</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div id="filtro_multiple" class="card" style="display:none">
	<div class="card-body card-padding">
		<?php 
			echo $this->element('filtros_multiples',array(
				'url_action'=>'index',
				'datos_filtro'=>$datos_filtro,
				'filtro_tipo_evento'=>true,
				'filtro_estado_programacion'=>true,
				'periodo_required'=>true,
			)); 
		?>
	</div>
</div>
<div id="card-content-grilla">&nbsp;</div>



<script type="text/javascript">
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	// -----------------------------------------------------------------
	$('#form-filtro-basico').on('submit',function(event){
		event.preventDefault();
		var form = $(this);
		/*var fecha_inicio = $('#form-filtro-basico .fecha-inicio').val();
		var fecha_termino = $('#form-filtro-basico .fecha-termino').val();
		if(!fechaCorrecta(fecha_inicio,fecha_termino)){
			notifyUser('La fecha de t&eacute;rmino no puede ser mayor a la fecha de inicio.','danger');
			return false;	
		}*/
		var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableSolicitudRecuperacion')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		}).fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		}).always(function(view) {
			$('#card-content-grilla').html(view);
		});
	});
	// -----------------------------------------------------------------
	$('#form-filtro-multiple').on('submit', function(event) {
		event.preventDefault();
		var form = $(this);
		var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
		/*var fecha_inicio = $('#form-filtro-multiple .fecha-inicio').val();
		var fecha_termino = $('#form-filtro-multiple .fecha-termino').val();
		if(!fechaCorrecta(fecha_inicio,fecha_termino)){
			notifyUser('La fecha de t&eacute;rmino no puede ser mayor a la fecha de inicio.','danger');
			return false;	
		}*/
		
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableSolicitudRecuperacion')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		}).fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		}).always(function(view) {
			$('#card-content-grilla').html(view);
		});
	});
	// -----------------------------------------------------------------
	$('#select-order').on('change', function(event) {
		event.preventDefault();
		var form = $('#form-ordenar');
		/* Act on the event */
		var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableSolicitudRecuperacion')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente m&aacute;s tarde.','danger');
		})
		.always(function(view) {
			$('#card-content-grilla').html(view);
		});
	});
	// -----------------------------------------------------------------
	$('#filtro').change(function() {
		$('#buscar-tipo').val('');
	});
	// -----------------------------------------------------------------
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY'
	});
	// -----------------------------------------------------------------
	$('.time-picker').datetimepicker({
		format: 'LT'
	});
	// -----------------------------------------------------------------
	$('.cambiar-filtro-multiple').on("click", function () {
		$('#filtro_multiple').show();
		$('#filtro_simple').hide();
	});
	// -----------------------------------------------------------------
	$('.cambiar-filtro-simple').on("click", function () {
		$('#filtro_multiple').hide();
		$('#filtro_simple').show();
	});
	// -----------------------------------------------------------------
	<?php
		$date = new DateTime($periodoActual['Periodo']['FECHA_INICIO']);
		$FI = $date->format('d-m-Y');
		$date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
		$FF = $date->format('d-m-Y');
	?>
	var periodo_ini = "<?php echo $FI ?>";	//"06-03-2017"
	var periodo_fin = "<?php echo $FF ?>";	//"21-07-2017"	
	restaFechas = function(f1,f2) {
		 var aFecha1 = f1.split('-'); 
		 var aFecha2 = f2.split('-'); 
		 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
		 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
		 var dif = fFecha2 - fFecha1;
		 var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
		 return dias;
	 }
	 $(function(){
	 	var dias=0;
        $(".fecha-inicio").blur(function() {
        	$(".fecha-inicio").val( $(this).val() );
            dias=parseInt( restaFechas( periodo_ini, $(this).val() ) );
            if(dias<0){
            	$(".fecha-inicio").val( periodo_ini );
            	$('.fecha-termino').data("DateTimePicker").minDate(periodo_ini);
            	notifyUser('Se tomar&aacute; como fecha de inicio: '+periodo_ini+', que corresponde al periodo actual.','info');
            }
        });
        $(".fecha-termino").blur(function() {
        	$(".fecha-termino").val( $(this).val() );
            dias=parseInt( restaFechas( periodo_fin, $(this).val() ) );
            if(dias>0){
            	$(".fecha-termino").val( periodo_fin );
            	$('.fecha-inicio').data("DateTimePicker").maxDate(periodo_fin);
            	notifyUser('Se tomar&aacute; como fecha final: '+periodo_fin+', que corresponde al periodo actual.','info');
            }
        });
	});
	// -----------------------------------------------------------------
	$(function(){
		<?php if (!empty($retorno_filtros)) { ?>
			$("#buscar-tipo").val("<?php echo $retorno_filtros['autocomplete']; ?>");
			$("#fecha_inicio").val("<?php echo $retorno_filtros['fecha_inicio']; ?>");
			$("#fecha_fin").val("<?php echo $retorno_filtros['fecha_fin']; ?>");
			$('#filtro > option[value="<?php echo $retorno_filtros['filtro']; ?>"]').attr('selected', 'selected');
			$("#buscar-tipo").val("<?php echo $retorno_filtros['autocomplete']; ?>");
			$("#hidden-uuid").val("<?php echo $retorno_filtros['value']; ?>");
			$("#btnBuscar").trigger("click");
		<?php } ?>
	});
	// -----------------------------------------------------------------
</script>