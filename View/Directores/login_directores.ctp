<div class="lc-block toggled caja-login z-depth-5" id="l-login">
	<span class="titulo bs-item z-depth-3" style="padding: 5px; font-size: 20px;font-weight: bold;">Libro Virtual de Clases</span>
	<div class="input-group m-b-20">
		<span class="input-group-addon"><i class="md md-person"></i></span>
		<div class="fg-line">
			<input type="text" class="form-control" placeholder="Usuario">
		</div>
	</div>
	<div class="input-group m-b-20">
		<span class="input-group-addon"><i class="md md-accessibility"></i></span>
		<div class="fg-line">
			<input type="password" class="form-control" placeholder="Contraeña">
		</div>
	</div>
	<div class="clearfix"></div>
	<div class="checkbox">
		<label>
			<input type="checkbox" value="">
			<i class="input-helper"></i>
			Recordar Contraseña
		</label>
	</div>
	<a href="<?php echo $this->Html->url(array('controller'=>'Directores','action'=>'index')) ?>" style="background: #34495e;border: 2px solid #ddd;" class="btn btn-login btn-danger btn-float"><i style="color: #FCA60A;"class="md md-arrow-forward"></i></a>
</div>