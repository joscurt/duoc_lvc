<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<button class="btn btn-success pull-right">Crear Reforzamiento</button>
			<h1>Gesti&oacute;n de Clases</h1>
		</div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="">Editar:</label>
					<select name="" id="" class="form-control selectpicker" data-live-search="true">
						<option>Seleccionar</option>
						<option value="cambiar-sala" selected="">Cambiar sala</option>
						<option value="inasistencia-docente">Inasistencia docente</option>
						<option value="justificacion-legal">Justificaci&oacute;n legal</option>
						<option value="adelantar-clase">Adelantar clase</option>
						<option value="ajustes-eliminacion">Ajustes o eliminaci&oacute;n de estado</option>
					</select>
				</div>
			</div>
			<div class="col-md-1">
				<button class="btn btn-success" style="margin-top: 27px;">OK</button>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;"><label>Informaci&oacute;n Docente: </label></h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Rut</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombres</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>12.345.678-9</td>
							<td>Bustamante</td>
							<td>Rodr&iacute;guez</td>
							<td>Jos&eacute; Ignacio</td>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Informaci&oacute;n Clase:</h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Nombre asignatura</th>
							<th>Sigla-Secci&oacute;n</th>
							<th>Jornada</th>
							<th>Fecha programada</th>
							<th>Horario</th>
							<th>Sala</th>
							<th>Tipo</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>T&eacute;cnicas de arquitectura de la informaci&oacute;n</td>
							<td>DID6011-01</td>
							<td>Vespertina</td>
							<td>01-07-2016</td>
							<td>10:01 a 10:46</td>
							<td>208</td>
							<td>Regular</td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
						<tr>
							<th>Estado</th>
							<th>Motivo</th>
							<th>M&oacute;dulos programados</th>
							<th>M&oacute;dulos por recuperar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Programada</td>
							<td>Suspendida</td>
							<td>4</td>
							<td>04</td>
						</tr>	
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Modificaciones:</h2>
				<div class="bloque">
					<div class="bloque-top">
						<div class="column">
							<label>Detalle: </label>Reemplazo Docente
						</div>
						<div class="column">
							<label>Creada por: </label>Apellido Apellido Nombre
						</div>
						<div class="column last">
							<label>Fecha: </label>07/2016
						</div>
						<i class="fa fa-angle-down" aria-hidden="true"></i>
					</div>
					<div class="bloque-bottom">
						<div class="column">
							<label>Rut: </label>12.345.678-9
						</div>
						<div class="column">
							<label>Apellido Paterno: </label>Sep&uacute;lveda
						</div>
						<div class="column">
							<label>Apellido Materno: </label>Villegas
						</div>
						<div class="column">
							<label>Nombres: </label>Juan Pablo
						</div>
						<div class="column last">
							<label>Motivo: </label>Inasistencia Docente Titular
						</div>
					</div>
				</div>
				<div class="bloque">
					<div class="bloque-top">
						<div class="column">
							<label>Detalle: </label>Cambio sala
						</div>
						<div class="column">
							<label>Creada por: </label>Apellido Apellido Nombre
						</div>
						<div class="column last">
							<label>Fecha: </label>07/2016
						</div>
						<i class="fa fa-angle-down" aria-hidden="true"></i>
					</div>
					<div class="bloque-bottom">
						<div class="column last">
							<label>Sala reemplazo: </label>208
						</div>
					</div>
				</div>
				<a href="<?php echo $this->Html->url(array('action'=>'index')) ?>" class="btn btn-success" title="Volver">Volver</a>
			</div>
			<div class="col-md-8">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Asistencia evento: </h2>
				<table border="0" cellpadding="0" cellspacing="0" class="table table-striped">
					<thead>
					<tr>
						<th>&nbsp;</th>
						<th>Rut</th>
						<th>Apellido Paterno</th>
						<th>Apellido Materno</th>
						<th>Nombres</th>
						<th></th>
						<th>Editar</th>
					</tr>
					</thead>
				  <tbody>
				  <tr class="odd">
				    <td>1</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="even">
				    <td>2</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>
				  <tr class="odd">
				    <td>3</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="even">
				    <td>4</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="odd">
				    <td>5</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="even">
				    <td>6</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="odd">
				    <td>7</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  <tr class="even">
				    <td>8</td>
				    <td>12.345.678-9</td>
				    <td>Apellido</td>
				    <td>Apellido</td>
				    <td>Nombre Nombre</td>
				    <td>
					    	<div class="checkbox m-b-15">
		                        <label>
		                            <input type="checkbox" value="" checked="">
		                            <i class="input-helper"></i>
		                        </label>
		                    </div>
	                    </td>
				    <td><a class="btn btn-info btn-xs" href="" title="Editar"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a></td>
				  </tr>	
				  </tbody>
				</table>
				<div class="card-header">
					<button class="btn btn-success">Guardar cambios asistencia</button>
				</div>
			</div>
			<div class="col-md-4">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Bit&aacute;cora evento</h2>
				<h3>T&iacute;tulo</h3>
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean euismod bibendum laoreet. Proin gravida dolor sit amet lacus accumsan et viverra justo commodo. Proin sodales pulvinar tempor. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</p>
				<p>Nam fermentum, nulla luctus pharetra vulputate, felis tellus mollis orci, sed rhoncus sapien nunc eget.</p>
			</div>
		</div>
	</div>
</div>