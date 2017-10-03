<form action="<?php echo $this->Html->url(array('action'=>'loginCoordinador')); ?>	" method="POST">
	<div class="lc-block toggled caja-login z-depth-5" id="l-login">
		<span 
			class="titulo bs-item z-depth-3" 
			style="margin-top:-30px;padding: 5px; font-size: 20px;font-weight: bold;"
			>Libro Virtual de Clases
		</span>
		<div class="input-group m-b-20">
			<span class="input-group-addon"><i class="md md-person"></i></span>
			<div class="fg-line">
				<input 
					type="text" 
					class="form-control" 
					name="data[User][username]" 
					placeholder="Usuario" >
			</div>
		</div>
		<div class="input-group m-b-20">
			<span class="input-group-addon"><i class="md md-accessibility"></i></span>
			<div class="fg-line">
				<input 
					type="password" 
					class="form-control" 
					name="data[User][password]" 
					placeholder="Contrae&ntilde;a">
			</div>
		</div>
		<div class="clearfix"></div>
		<button 
			style="background: #34495e;border: 2px solid #ddd;" 
			class="btn btn-login btn-danger btn-float"><i style="color: #FCA60A;" class="md md-arrow-forward"></i></button>
	</div>
</form>