<div class="row">
	<div class="col-md-12">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;"><label>N&oacute;mina Diaria de Clases a Recuperar y Adelantar</label></h2>				
	</div>
</div>
<?php 
	echo $this->element('filtros_reportes',array(
		'datos_filtro'=>isset($datos_filtro)?$datos_filtro:array(),
		'url_action'=>'grillaNominaClasesRecuperarAdelantar',
	)); 
?>