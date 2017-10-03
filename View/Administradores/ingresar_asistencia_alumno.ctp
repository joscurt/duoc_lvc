<style>
	.leyenda{
		width: 50px;
		padding: 10px;
		display: block;
		margin-top: 5px;
		text-align: center;
	}
	.texto_leyenda{
		font-weight: bold;
		color:#000;
		float: left;
		margin-left: 18%;
		margin-top: -8%;
	}
	td{
		cursor: pointer;
		padding-top: 5px !important;
		text-align: center;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 10px !important;
	}
	th{
		font-weight: 500 !important;
		text-align: center;
	}
	.titulo_mes{
		color: red;
		float: right;
		margin-right: 50%;
		font-size: 1.2em;
	}
	.dia-semana{font-weight: bold;}
	.col-md-2-calendar{
		margin-left: 3.2%;
		border-left: 1px solid #dedede;
	}
	.mes-calendario td:hover{
		background-color:#f1f1f1;
	}
	.mes-calendario .td-active:hover{
		background-color:#26A65B;;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#ccc;;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#ccc;;
	}
	#table-eventos td{
		padding:3px !important;
		vertical-align: middle;
	}
</style>
<div class="modal fade" id="modal_bitacora" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bit&aacute;cora</h4>
			</div>
			<div class="modal-body">
				<form class="addEvent" role="form">
					<div class="col-md-6">
						<label for="">Bit&aacute;cora Docente</label>
						<div class="form-group">
							<div class="fg-line">
								<textarea style="max-height: 300px;height: 300px;"placeholder="Ingrese sus comentarios" rows="5" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<label for="">Ver Bit&aacute;coras</label>
						<div class="form-group" style="max-height: 300px; overflow: auto;">
							<ul>
								<li><span class="badge" style="background: #607D8B;">10:22 (12/03/2016)</span> - <br> Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus. <br> </li>
								<li><span class="badge" style="background: #607D8B;">11:33 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>
								<li><span class="badge" style="background: #607D8B;">13:22 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>
								<li><span class="badge" style="background: #607D8B;">15:22 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>
								<li><span class="badge" style="background: #607D8B;">15:22 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>
								<li><span class="badge" style="background: #607D8B;">15:22 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>
								<li><span class="badge" style="background: #607D8B;">15:22 (12/03/2016)</span> -  Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iste architecto tempore dicta consectetur omnis sequi reiciendis asperiores, maxime et enim non recusandae harum id officiis, numquam, aliquam earum obcaecati. Delectus.</li>

							</ul>
						</div>
					</div>
					<input type="hidden" id="getStart" />
					<input type="hidden" id="getEnd" />
				</form>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-xs btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar Bit&aacute;cora</button>
				<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="card" id="header-fixed" style="left: 1%;position: fixed;right: 1%;top: 12%;z-index: 999;">
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-12">
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SEDE</label>
					<p class="c-black f-500 m-b-20">Antonio Varas</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">CARRERA</label>
					<p class="c-black f-500 m-b-20">Ingenier&iacute;a en Informatica</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">NOMBRE ASIGNATURA</label>
					<p class="c-black f-500 m-b-20">Nivelaci&oacute;n Matem&aacute;ticas</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SIGLA-SECCI&Oacute;N</label>
					<p class="c-black f-500 m-b-20">PL201202V</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">JORNADA</label>
					<p class="c-black f-500 m-b-20">Vespertina</p>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card" style="margin-top: 13%;">
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-4">
				<div class="col-md-12" style="margin-top: 5%;">
					<div class="col-md-4">
						<div class="form-group">
							<strong><i class="fa fa-calendar"></i>&nbsp;Fecha</strong><br>
							<span>12-12-12</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<strong><i class="fa fa-clock-o"></i>&nbsp;Hora</strong><br>
							<span>10:00 - 11:30</span>
						</div>
					</div>
					<div class="col-md-4">
						<div class="form-group">
							<strong><i class="fa fa-building-o"></i>&nbsp;Sala</strong><br>
							<span>303-A</span>
						</div>
					</div>
				</div>	
			</div>
			<div class="col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th style="background: #34495e; color:#fff;">Clases Realizadas</th>
							<th style="background: #34495e; color:#fff;">Clases Programadas</th>
							<th style="background: #34495e; color:#fff;">Avance de Clases</th>
							<th style="background: #34495e; color:#fff;">Asistencia Promedio</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="background: #34495e; color:#fff;">Clases Regulares</td>
							<td style="border: 1px solid #ddd;">10</td>
							<td style="border: 1px solid #ddd;">49</td>
							<td style="border: 1px solid #ddd;">20%</td>
							<td style="border: 1px solid #ddd;">80%</td>
						</tr>
						<tr>
							<td style="background: #34495e; color:#fff;">Clases no Regulares</td>
							<td style="border: 1px solid #ddd;">1</td>
							<td style="border: 1px solid #ddd;">1</td>
							<td style="border: 1px solid #ddd;">100%</td>
							<td style="border: 1px solid #ddd;">64%</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- <div class="card">
	<div class="card-body card-padding">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th class="td-app">Evento</th>
					<th class="td-app">Horario</th>
					<th class="td-app">Sala</th>
					<th class="td-app">Tipo de Clase</th>
					<th class="td-app">Registro de Clase</th>
					<th class="td-app">Fecha de Clase</th>
					<th class="td-app">Fecha de Registro</th>
					<th class="td-app">Registro</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td style="text-align: left;">MAT100-009(T) - Nivelaci&oacute;n Matem&aacute;tica</td>
					<td>8:31 - 10:00</td>
					<td>AO-311</td>
					<td>TEO</td>
					<td>Regular</td>
					<td>01-04-16</td>
					<td>01-04-16</td>
					<td><a href="" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a></td>
				</tr>
			</tbody>
		</table>
	</div>
</div> -->
<div class="card" >
	<div class="card-header">
		<div class="row">
			<div class="col-md-offset-4 col-md-3">
				<label for="">-Presente</label><br>
				<label class="checkbox checkbox-inline m-r-20"><input disabled type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label>		
			</div>
			<div class="col-md-3">
			<label for="">-Ausente</label><br>
				<label class="checkbox checkbox-inline m-r-20"><input disabled type="checkbox"  value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label>
			</div>
		</div>
	</div>
	<div class="card-body card-padding">
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<table class="table table-striped table-hover" id="table-eventos">
				<thead>
					<tr>
						<th class="td-app"><strong>Rut</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Apellido Paterno</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Apellido Materno</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Nombres</strong></th>
						<th class="td-app"><strong>Asistencia</strong></th>
						<th class="td-app"><strong>Carrera del Alumno</strong></th>
						<th class="td-app"><strong>Observaciones</strong></th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($alumnos as $key => $alumno): ?>
						<tr>
							<td><?php echo $alumno['rut'];?></td>
							<td><?php echo strtoupper($alumno['paterno']); ?></td>
							<td><?php echo strtoupper($alumno['materno']); ?></td>
							<td><?php echo strtoupper($alumno['nombre']); ?></td>
							<td><label class="checkbox checkbox-inline m-r-20"><input type="checkbox" checked="" value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label></td>
							<td><?php echo strtoupper($alumno['carrera']); ?></td>
							<td>
								<div class="fg-line">
									<input type="text" class="form-control" placeholder="<?php echo $key == 1 || $key == 4 || $key == 5  ?  'COMENTARIO DE PRUEBA MAQUETAS' : 'Maximo 300 caracteres'; ?>" >
								</div>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
		</div>	
	</div>
</div>
<div class="card">
	<div class="card-padding card-body" align="center">
	<a href="<?php echo $this->Html->url(array('action'=>'verClase')) ?>"  class=" btn  btn-sm btn-info "><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>
		<a data-toggle="modal" data-target="#modalDefault" href="#modalDefault"  class=" btn  btn-sm btn-default "><i class="fa fa-search"></i>&nbsp;Ver Bit&aacute;cora</a>
		<a style="margin-left: 10px;"class=" btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a>
	</div>
</div>
<div class="modal fade" id="modalDefault" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bit&aacute;cora Clase MAT100-009(T) - Nivelaci&oacute;n Matem&aacute;tica</h4>
			</div>
			<div class="modal-body">
				<form class="addEvent" role="form">
					<div class="form-group" style="max-height: 500px;overflow: auto;">
						<label for="eventName">Bit&aacute;cora</label>
						<div class="fg-line">
							<span class="badge">10:00 (12/06/2016)</span><br>
							<textarea disabled="disabled" class="form-control" name="" id="" style="height: 100px;" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quia laboriosam minima autem libero minus numquam sed facere temporibus. Quos unde iusto nulla eaque ad necessitatibus voluptas nemo omnis tempora.</textarea>
							<span class="badge">10:45 (12/06/2016)</span><br>
							<textarea  disabled="disabled"class="form-control" name="" id="" style="height: 100px;" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quia laboriosam minima autem libero minus numquam sed facere temporibus. Quos unde iusto nulla eaque ad necessitatibus voluptas nemo omnis tempora.</textarea>
							<span class="badge">11:20 (12/06/2016)</span><br>
							<textarea disabled="disabled" class="form-control" name="" id="" style="height: 100px;" cols="30" rows="10">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sit quia laboriosam minima autem libero minus numquam sed facere temporibus. Quos unde iusto nulla eaque ad necessitatibus voluptas nemo omnis tempora.</textarea>
						</div>
					</div>
					<input type="hidden" id="getStart" />
					<input type="hidden" id="getEnd" />
				</form>
			</div>
			
			<div class="modal-footer">
				<button type="submit" class="btn btn-xs btn-default" id="addEvent"><i style="color:red;"class="fa fa-file-pdf-o"></i>&nbsp;Exportar Bit&aacute;cora</button>
				<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>