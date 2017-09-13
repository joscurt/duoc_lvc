<style>
    .ui-autocomplete {
        max-height: 140px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
        z-index: 1200;
    }
    * html .ui-autocomplete {height: 100px;}
</style>
<?php 
	$filtros_posibles = array(
		'Docente.RUT'=>'Rut docente',
		'Docente.NOMBRE'=>'Nombre docente',
		'Docente.COD_FUNCIONARIO'=>'ID docente',
		'Asignatura.NOMBRE'=>'Nombre asignatura',
		'ProgramacionClase.SIGLA_SECCION'=>'Sigla - Sección',
		'ProgramacionClase.COD_JORNADA'=>'Jornada',
		'ProgramacionClase.detalle'=>'Detalle',
		'ProgramacionClase.ESTADO_PROGRAMACION_ID' => 'Estado',
		#'ProgramacionClase.estado'=>'Estado',
		'ProgramacionClase.sub_estado'=>'Sub-Estado',
	);
	$datos_filtro = null;

	$date = new DateTime($periodoActual['Periodo']['FECHA_INICIO']);
	$datos_filtro['Filtro']['fecha_inicio']=$date->format('d-m-Y');

	$date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
	$datos_filtro['Filtro']['fecha_fin']=$date->format('d-m-Y');
?>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">

<?php foreach ($permisos as $key => $value) {

	if ($value['PermisoFuncionalidad']['FUNCIONALIDAD_ID']==382) {?>
		<?php if($value['Funcionalidad']['ACTIVO']==1 && $value['PermisoFuncionalidad']['LECTURA']==1){	?>
		<a href="<?php echo $this->Html->url(array('action'=>'crearReforzamiento')) ?>" class="btn bgm-orange btn-lg pull-right">Crear Reforzamiento</a>
<?php	}}} ?>
			<h1>Gestión de Clases</h1>
		</div>	
	</div>
</div>
<div id="filtro_simple" class="card">
	<div class="card-body card-padding">
		<div class="row">
			<?php 
				echo $this->element('filtros_simples',array(
					'filtros_posibles'=>$filtros_posibles,
					'url_action'=>'getTableGestionClases',
					'datos_filtro'=>$datos_filtro,
					
				)); 
			?>
			<div class="col-md-2 text-right">
				<div class="form-group">
					<button class="btn btn-default cambiar-filtro-multiple" style="margin-top: 27px;">Filtro múltiple</button>
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

<div id="card-content-grilla">
	&nbsp;
</div>


<script type="text/javascript">
	$(function(){
		$("#buscar-tipo").focus(function() {
			$("#buscar-tipo, #hidden-uuid").val('');
		});
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
	var imagen_cargando = loadImage('<?php echo $this->Html->image('loading.gif'); ?>');
	$('#form-filtro-basico').on('submit', function(event) {
		event.preventDefault();
		if ( $("#hidden-uuid").val()=='') {
			notifyUser('Ingrese un dato correcto para realizar la consulta.','info');
			$("#card-content-grilla").html('');
			return false;
		}
		var form = $(this);
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);

		
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableGestionClases')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),

		})
		.fail(function() {

			notifyUser('Ha ocurridosssss un error inesperado. Intente más tarde.','danger');
			
		//notifyUser('Ha ocurrido un error inesperado. Intente más tarde.' + error ,'danger');
        //console.log("Post error: " + error);
		})
		.always(function(view) {
			$('#card-content-grilla').html(view);
		});
	});
	
	// -----------------------------------------------------------------
	$('#form-filtro-multiple').on('submit', function(event) {
		event.preventDefault();
		var form = $(this);
		$('#card-content-grilla').html('<div align="center"></div>');
		$('#card-content-grilla div').html(imagen_cargando);
		$.ajax({
			url: '<?php echo $this->Html->url(array('action'=>'getTableGestionClases')); ?>',
			type: 'POST',
			dataType: 'html',
			data: form.serialize(),
		})
		.fail(function() {
			notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
		})
		.always(function(view) {
			$('#card-content-grilla').html(view);
		});
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
</script>
