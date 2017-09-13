<?php 
	$filtros_posibles = array(
		'Docente.RUT'=>'Rut docente',
		'Docente.NOMBRE'=>'Nombre docente',
		'Docente.COD_FUNCIONARIO'=>'ID docente',
		'ProgramacionClase.SIGLA_SECCION'=>'Sigla - Sección'
	);
	$datos_filtro = null;
	$date = new DateTime($periodoActual['Periodo']['FECHA_INICIO']);
	$datos_filtro['Filtro']['fecha_inicio']=$date->format('d-m-Y');
	$date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
	$datos_filtro['Filtro']['fecha_fin']=$date->format('d-m-Y');
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header"><h1>Asistencia Docente</h1></div>	
	</div>
</div>
<div id="filtro_simple" class="card">
	<div class="card-body card-padding">
		<div class="row">
			<?php 
				echo $this->element('filtros_simples',array(
					'filtros_posibles'=>$filtros_posibles,
					'url_action'=>'getGrillaAsistenciaDocente',
					'datos_filtro'=>$datos_filtro,
				)); 
			?>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<div class="content-tablas" id="contenedor-grilla">
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// -----------------------------------------------------------------
	<?php
		$date = new DateTime($periodoActual['Periodo']['FECHA_INICIO']);
		$FI = $date->format('d-m-Y');
		$date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
		$FF = $date->format('d-m-Y');
	?>
	var periodo_ini = "<?php echo $FI ?>";
	var periodo_fin = "<?php echo $FF ?>";
	// -----------------------------------------------------------------	
	restaFechas = function(f1,f2) {
		 var aFecha1 = f1.split('-'); 
		 var aFecha2 = f2.split('-'); 
		 var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
		 var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
		 var dif = fFecha2 - fFecha1;
		 var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
		 return dias;
	 }
	 // -----------------------------------------------------------------
	 $(function(){
	 	var dias=0;
        $(".fecha-inicio").blur(function() {
        	$(".fecha-inicio").val( $(this).val() );
            dias=parseInt( restaFechas( periodo_ini, $(this).val() ) );
            if(dias<0){
            	$(".fecha-inicio").val( periodo_ini );
            	$('.fecha-termino').data("DateTimePicker").minDate(periodo_ini);
            	notifyUser('Se tomará como fecha de inicio: '+periodo_ini+', que corresponde al periodo actual.','info');
            }
        });
        $(".fecha-termino").blur(function() {
        	$(".fecha-termino").val( $(this).val() );
            dias=parseInt( restaFechas( periodo_fin, $(this).val() ) );
            if(dias>0){
            	$(".fecha-termino").val( periodo_fin );
            	$('.fecha-inicio').data("DateTimePicker").maxDate(periodo_fin);
            	notifyUser('Se tomará como fecha final: '+periodo_fin+', que corresponde al periodo actual.','info');
            }
        });
	});
	// -----------------------------------------------------------------
	$('.date-time-picker').datetimepicker({
		format: 'DD-MM-YYYY',
	});
	// -----------------------------------------------------------------
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	$('#form-filtro-basico').on('submit', function(event) {
		event.preventDefault();
		var form = $(this);
		$('#contenedor-grilla').html('<div align="center"></div>');
		$('#contenedor-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getGrillaAsistenciaDocente')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
		})
		.always(function(view) {
			$('#contenedor-grilla').html(view);
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