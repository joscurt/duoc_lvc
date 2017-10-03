<style>
	.btn-verde{
		background: #1abc9c !important;
		color: #fff !important;
	}
	.btn-rojo{
		background: #c0392b !important;
		color: #fff !important;
	}
</style>
<br>
<br>
<div class="card">
		<div class="card-header">
			<h2 class="modal-title">Modificar Recurso</h2>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for=""><i class="fa fa-calendar"></i>&nbsp;Fecha</label>
						<input type="text" class="form-control date-picker" data-toggle="dropdown" placeholder="Selececcione Nueva Fecha" value="<?php echo date('d-m-Y');?>" aria-expanded="false">	
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for=""><i class="fa fa-clock-o"></i>&nbsp;Hora Desde</label>
						<input type="text" class="form-control time-picker" data-toggle="dropdown" placeholder="Seleccione Hora Inicio" aria-expanded="false"value="<?php echo '10:30' ;?>" >
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for=""><i class="fa fa-clock-o"></i>&nbsp;Hora Hasta</label>
						<input type="text" class="form-control time-picker" data-toggle="dropdown" placeholder="Seleccione Hora Fin" aria-expanded="false"value="<?php echo '10:30' ;?>">	
					</div>	
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<a class="btn_horario btn btn-sm btn-default"><i class="fa fa-search"></i>&nbsp;Ver Disponibilidad</a>
					</div>	
				</div>
				
				<div class="col-md-6 error_docente"style="color:red; display: none;">
					<div class="form-group" id="mensaje_docente">
							<strong>Sin disponibilidad! debe cambiar al docente</strong>
					</div>	
				</div>
				<div class="col-md-6 error_sala"style="color:red; display: none; ">
					<div class="form-group" id="mensaje_sala">
						<strong>Sin disponibilidad! debe cambiar la sala</strong>
					</div>
				</div>
				<?php if ($mode_view != 'admin'): ?>
					<div class="col-md-6">
						<div class="form-group" >
							<label for=""><i class="fa fa-user"></i>&nbsp;Docente:</label>&nbsp;&nbsp;<span id="docente">Felipe Oyarz&uacute;n</span>&nbsp;&nbsp;&nbsp;&nbsp;
							<!-- <a class="btn_cambio_docente btn btn-xs btn-warning"><i class="fa fa-eye"></i>&nbsp;Cambiar Docente</a> -->
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for=""><i class="fa fa-dot-circle-o"></i>&nbsp;Sala:</label>&nbsp;&nbsp;<span id="numer_sala">SALA 101</span>&nbsp;&nbsp;&nbsp;&nbsp;
							<!-- <a class="btn_cambio_sala btn btn-xs btn-warning"><i class="fa fa-building"></i>&nbsp;Cambiar Sala</a> -->
						</div>	
					</div>
				<?php endif; ?>	 
			</div>
			<div class="dashed" style="padding: 10px;border: 2px #ddd dashed;display: none;"id="select_remplazo_">
				<div class="form-group"  >
					<div class="fg-line">
						<label for="">Seleccione docente</label>
						<div class="select">
							<select class="form-control selectpicker" data-live-search="true" >
								<option value="">Seleccione Docente</option>
								<option value="">ERNESTO VIVANCO</option>
								<option value="">JUAN CARLOS AYALA</option>
								<option value="">JOSE OYARZUN</option>
								<option value="">RODRIGO LAVIN</option>
								<option value="">FERNANDO FLORES</option>
								<option value="">FELIPE CARRASCO</option>
							</select>
						</div>
					</div>
				</div>
				<?php if ($mode_view != 'admin'): ?>
					<div class="form-group" id="select_tipo_remplazo" >
						<div class="fg-line">
							<label for="">Seleccione motivo</label>
							<div class="select">
								<select class="form-control selectpicker" data-live-search="true" >
									<option value="">Seleccione Tipo</option>
									<option value="">Atraso</option>
									<option value="">Capacitaci&oacute;n DUOC</option>
									<option value="">Docente no informa</option>
									<option value="">Licencia Medica</option>
									<option value="">Problema Personal</option>
									<option value="">Retiro anticipado</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group" id="observaciones_reemplazo_" >
						<label for="">Observaciones</label>
						<div class="fg-line">
							<textarea style="height: 130px;"placeholder="Ingrese sus comentarios" rows="" class="form-control"></textarea>
						</div>
						<a style="margin-top: 8px;"class="btn btn-xs pull-right btn-success guardar_docente"><i class="fa fa-save"></i>&nbsp;Guardar Cambio Docente</a>
					</div>
				</div>
			<?php endif ?>
			<div class="col-md-12 horario_salas" style="display: none;">
                <br><br>
                <ul class="tab-nav text-center " tabindex="11" style="overflow: hidden; outline: none;">
                    <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">SALA 100</a></li>
                    <li><a href="#tab2" data-toggle="tab"><strong>SALA 001</strong></a></li>
                    <li><a href="#tab3" data-toggle="tab"><strong>SALA 002</strong></a></li>
                    <li><a href="#tab4" data-toggle="tab"><strong>SALA 003</strong></a></li>
                    <li><a href="#tab5" data-toggle="tab"><strong>SALA 004</strong></a></li>
                    <li><a href="#tab6" data-toggle="tab"><strong>SALA 005</strong></a></li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane active " id="tab1">                                        
						<table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" id="reservar_sala"title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="tab-pane fade" id="tab2">
                        <table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="tab-pane fade" id="tab3">
						<table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="tab-pane fade" id="tab4">
                        <table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="tab-pane fade" id="tab5">
                        <table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                    <div class="tab-pane fade" id="tab6">
                        <table class="table table-hover" id="table_disponibilidad_salas">
							<thead>
								<tr>
									<th>HORARIO</th>
									<th>LUNES</th>
									<th>MARTES</th>
									<th>MIERCOLES</th>
									<th>JUEVES</th>
									<th>VIERNES</th>
									<th>SABADO</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td>10:00 - 11:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>12:00 - 13:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>13:10 - 14:00</td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
								<tr>
									<td>15:30 - 16:00</td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
									<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
								</tr>
							</tbody>
						</table>
                    </div>
                </div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.btn_horario').click(function(event) {
		$('.horario_salas').show();
		$('#select_remplazo_').show();
	});
	$('[data-rel="tooltip"]').tooltip();
</script>