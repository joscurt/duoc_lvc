
<form id="form-login" method="POST">
	<div class="lc-block toggled caja-login z-depth-5" id="l-login">
		<span class="titulo bs-item z-depth-3" style="padding: 5px; font-size: 20px;font-weight: bold;">Libro Virtual de Clases</span>
		<div class="row">
			<div class="col-md-2 p-t-10 ">
				<i class="md md-person" style="font-size: 1.5em;"></i>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<select id="select-person" class="form-control selectpicker">
						<option value="">SELECCIONE UNA VISTA</option>
						<option value="<?php echo $this->Html->url(array('action'=>'loginBackOffice')); ?>">BACKOFFICE</option>
						<option value="<?php echo $this->Html->url(array('action'=>'loginCoordinador')); ?>">COORDINADOR DOCENTE</option>
						<option value="<?php echo $this->Html->url(array('action'=>'login')); ?>">DOCENTE</option>
						<option value="<?php echo $this->Html->url(array('action'=>'loginDirector')); ?>">DIRECTORES</option>
					</select>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 p-t-10 ">
				<i class="md md-accessibility" style="font-size: 1.5em;"></i>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<div class="fg-line">
						<input 
							type="text" 
							required="required" 
							class="form-control" 
							name="data[User][username]"
							placeholder="Usuario">
					</div>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-2 p-t-10 ">
				<i class="md md-lock" style="font-size: 1.5em;"></i>
			</div>
			<div class="col-md-10">
				<div class="form-group">
					<div class="fg-line">
						<input 
							type="password" 
							class="form-control"
							required="required"  
							name="data[User][password]"
							placeholder="Contraseña">
					</div>
				</div>
			</div>
		</div>
		<button 
			type="submit" 
			style="background: #34495e;border: 2px solid #ddd;" 
			class="btn btn-login btn-danger btn-float">
			<i style="color: #FCA60A;" class="md md-arrow-forward"></i></button>
			<span><strong>Versión QA 3 - Fecha:14/09/2017</strong></span>
	</div>
</form>
<script>
	$('#select-person').selectpicker();
	/*var layoutStatus = localStorage.getItem('material-select-vista-login');
	if (layoutStatus != '' && layoutStatus != undefined) {
		//$('#select-person').val(layoutStatus).selectpicker('refresh');
	}*/
	$('#select-person').on('change', function(event) {
		event.preventDefault();
		if ($('#select-person').val()!='') {
			$('form#form-login').attr('action',$('#select-person').val());
			//localStorage.setItem('material-select-vista-login',$('#select-person').val());
		}
	});
</script>