<form action="<?php echo $this->Html->url(array('action'=>'loginDirector')) ?>" method="post">
	<div class="lc-block toggled caja-login z-depth-5" id="l-login">
		<span class="titulo bs-item z-depth-3" style="padding: 5px; font-size: 20px;font-weight: bold;">Libro Virtual de Clases</span>
		<div class="input-group m-b-20">
			<span class="input-group-addon"><i class="md md-person"></i></span>
			<div class="fg-line">
				<input type="text" name="data[User][username]" class="form-control" placeholder="Usuario">
			</div>
		</div>
		<div class="input-group m-b-20">
			<span class="input-group-addon"><i class="md md-accessibility"></i></span>
			<div class="fg-line">
				<input type="password" name="data[User][password]" class="form-control" placeholder="Contrae&ntilde;a">
			</div>
		</div>
		<div class="clearfix"></div>
		<button 
			style="background: #34495e;border: 2px solid #ddd;" 
			class="btn btn-login btn-danger btn-float"><i style="color: #FCA60A;" class="md md-arrow-forward"></i>
		</button>
	</div>
</form>