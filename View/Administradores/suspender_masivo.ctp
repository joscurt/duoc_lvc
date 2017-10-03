<style>
	/*ul li{
		display: inline-block;
	}*/
</style>
<br>
<div class="card" >
	<div class="card-header">
		<h2><i class="fa fa-warning"></i>&nbsp;Suspender Globalmente</h2>
	</div>
	<div class="card-padding card-body">
		<form action="">
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-4">
						<div class="form-group">
							<label for="sede">Sede</label>
							<select class="form-control selectpicker" id="">
								<option value="">Seleccione Sede</option>
								<option value="">SEDE 1</option>
								<option value="">SEDE 2</option>
								<option value="">SEDE 3</option>
								<option value="">SEDE 4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="sede">Jornada</label>
							<select class="form-control selectpicker" id="">
								<option value="">DIURNO</option>
								<option value="">VESPERTINO</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="sede">Carrera</label>
							<select class="form-control selectpicker" id="">
								<option value="">Seleccione Carrera</option>
								<option value="">CARRERA 1</option>
								<option value="">CARRERA 2</option>
								<option value="">CARRERA 3</option>
								<option value="">CARRERA 4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="sede">Escuela</label>
							<select class="form-control selectpicker" id="">
								<option value="">Seleccione Escuela</option>
								<option value="">ESCUELA 1</option>
								<option value="">ESCUELA 2</option>
								<option value="">ESCUELA 3</option>
								<option value="">ESCUELA 4</option>
							</select>
						</div>
					</div>
					<div class="col-md-4">
						<label for="">Fecha Desde</label>
						<div class="input-group form-group">
                            <span class="input-group-addon"><i class="md md-event"></i></span>
                                <div class="dtp-container dropdown fg-line">
                                <input type="text" class="form-control date-picker" data-toggle="dropdown" placeholder="Seleccione Fecha">
                            </div>
                        </div>
					</div>
					<div class="col-md-4">
						<label for="">Fecha Hasta</label>
						<div class="input-group form-group">
                            <span class="input-group-addon"><i class="md md-event"></i></span>
                                <div class="dtp-container dropdown fg-line">
                                <input type="text" class="form-control date-picker" data-toggle="dropdown" placeholder="Seleccione Fecha">
                            </div>
                        </div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<label for="sede">Docente</label>
							<select class="form-control selectpicker" id="">
								<option value="">Seleccione Docente</option>
								<option value="">DOCENTE 1</option>
								<option value="">DOCENTE 2</option>
								<option value="">DOCENTE 3</option>
								<option value="">DOCENTE 4</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<a class=" btn btn-success pull-right"><i class="fa fa-filter"></i>&nbsp;Verificar Suspensi&oacute;n</a>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="card">
	<div class="card-header" align="center">
		<div class="row">
			<div class="col-md-12">
				<div class="col-md-12" style="margin-bottom: 4%;">
					<div class="col-md-5 alert alert-danger" align="left">
						<p>Para culminar con la suspensi&oacute;n debe ingresar el motivo en el siguiente cuadro de texto y presionar el bot&oacute;n "SUSPENDER", adicionalmente hemos dispuesto un listado de todos los eventos que suspender&aacute; que puede revisar haciendo click en el bot&oacute;n "MOSTRAR EVENTOS"</p>
						<p>Estimado Coordinador est&aacute; a punto de suspender todos los eventos de la sede <b>ANTONIO VARAS</b> entre los d&iacute;as <b>27-04-2016</b> y <b>29-04-2016</b>. La suspensi&oacute;n global es un acto irreversible, por lo que se le ruega ser muy cuidadoso, ya que va a suspender 400 eventos.</p>
					</div>
					<div class="col-md-5" align="left">
						
						<div class="fg-line">
						<label>Ingrese los motivos de la suspensi&oacute;n</label>
						<br/><br/>
							<textarea class="form-control" rows="5" placeholder="Ingrese los motivos de la suspensi&oacute;n"></textarea>
						</div>	
					</div>
					<div class="form-group col-md-2" align="right">
						<button class="btn_filter btn btn-default btn-lg"><i class="fa fa-search-plus"></i>Ver Eventos</button><br/><br/>
						<a href="#modal_suspender_clase" data-toggle="modal" data-target="#modal_suspender_clase"class="btn btn-danger btn-lg"><i class="fa fa-warning"></i>&nbsp;Suspender&nbsp;</a>	
					</div>
				</div>	
				
			</div>
		</div>
	</div>
	<div class="card-padding card-body" style="display: none;"id="hidden_datos">
		<table class="table table-hover table-striped" >
			<thead>
				<tr>
					<th class="td-app">Nº</th>
					<th class="td-app">Sede</th>
					<th class="td-app">Jornada</th>
					<th class="td-app">Carrera</th>
					<th class="td-app">Escuela</th>
					<th class="td-app">Docente</th>
					<th  class="td-app"style="text-align: center;">Suspender Clase</th>
				</tr>
			</thead>
			<tbody>
				<?php foreach ($array as $key => $value): ?>
					<tr>
						<td><?php echo $key;?></td>
						<td><?php echo strtoupper($value['sede']); ?></td>
						<td><?php echo strtoupper($value['carrera']); ?></td>
						<td><?php echo strtoupper($value['jornada']); ?></td>
						<td><?php echo strtoupper($value['escuela']); ?></td>
						<td><?php echo strtoupper($value['docente']); ?></td>
						<td align="center">
							<label class="checkbox checkbox-inline m-r-20"><input type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label>
						</td>
					</tr>
				<?php endforeach ?>
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modal_suspender_clase" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<h4 class="modal-title">Suspender globalmente</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="alert alert-warnig">
					<h4>
						<p>¿Esta seguro de suspender la los eventos seleccionados ?</p><p>Recuerde que esta acci&oacute;n es irreversible.</p>
					</h4>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-danger" id="addEvent"><i class="fa fa-save"></i>&nbsp;Suspender Eventos</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$('.btn_filter').click(function(event) {
		$('#hidden_datos').show();
	});
	if ($('.date-picker')[0]) {
		$('.date-picker').datetimepicker({
			format: 'DD/MM/YYYY'
		});
	}
</script>