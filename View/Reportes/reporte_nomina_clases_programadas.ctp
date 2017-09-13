<div class="row">
	<div class="col-md-12">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">
			<label>Nómina Diaria de Clases Programadas</label>
		</h2>				
	</div>
</div>
<?php 
	echo $this->element('filtros_reportes',array(
		'datos_filtro'=>isset($datos_filtro)?$datos_filtro:array(),
		'filtro_fecha_termino'=>false,
		'label_fecha_inicio'=>'Fecha',
		'url_action'=>'grillaNominaClasesProgramadas',
	)); 
?>