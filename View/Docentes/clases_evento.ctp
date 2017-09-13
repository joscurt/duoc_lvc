<div class="modal fade" id="modal_bitacora" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Bitácora</h4>
			</div>
			<div class="modal-body">
				<form class="addEvent" role="form">
					<div class="col-md-6">
						<label for="">Bitácora Docente</label>
						<div class="form-group">
							<div class="fg-line">
								<textarea style="max-height: 300px;height: 300px;"placeholder="Ingrese sus comentarios" rows="5" class="form-control"></textarea>
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<label for="">Ver Bitácoras</label>
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
				<button type="submit" class="btn btn-xs btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar Bitácora</button>
				<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="card" id="header-fixed" style="left: 1%;position: fixed;right: 1%;top: 11%;z-index: 999;">
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
					<p class="c-black f-500 m-b-20">Ingeniería en Informatica</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<label for="">NOMBRE ASIGNATURA</label>
					<p class="c-black f-500 m-b-20">Nivelación Matemáticas</p>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">SIGLA-SECCIÓN</label>
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
	<div class="card-header">
		<h2 style="display: inline-block;">Clases Regulares</h2>	
	</div>
	<div class="card-body card-padding">
		<form action="">
			<div class="table-responsive" style="overflow: hidden;" tabindex="1">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th class="td-app"><strong>Día</strong></th>
							<th class="td-app"><strong>Horario</strong></th>
							<th class="td-app"><strong>Sala</strong></th>
							<th class="td-app"><strong>Tipo Clase</strong></th>
							<th class="td-app"><strong>Registro Clase</strong></th>
							<th class="td-app"style="width: 14%;"><strong>Registrar Evento</strong></th>
						</tr>
					</thead>
					<tbody>	
						<?php foreach ($clases as $clase): ?>
							<tr>
								<td><?php echo $clase['dia'];?></td>
								<td><?php echo strtoupper($clase['horario']); ?></td>
								<td><?php echo strtoupper($clase['sala']); ?></td>
								<td><span class="badge" style="background:#336E7B;"><?php echo strtoupper($clase['tipo_clase']); ?></span></td>
								<td><span class="badge" style="background:#bdc3c7;"><?php echo strtoupper($clase['registro_clase']); ?></span></td>
								<td style="text-align: center;">
									<a href="<?php echo $this->Html->url(array('action'=>'registrarNuevaClase')) ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
				<!-- <a href="#modal_bitacora" data-toggle="modal" data-target="#modal_bitacora" class="pull-right btn btn-success btn-xs btn-warning "><i class="fa fa-plus"></i>&nbsp;Agregar Bitacora</a> -->
				<!-- <a style="margin-right: 10px;"class="pull-right btn btn-xs btn-success"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a> -->
			</div>	
		</form>	
	</div>
</div>
<div class="card" >
	<div class="card-header">
		<h2 style="display: inline-block;">Clase Recuperativa</h2>	
	</div>
	<div class="card-body card-padding">
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="td-app"><strong>Día</strong></th>
						<th class="td-app"><strong>Horario</strong></th>
						<th class="td-app"><strong>Sala</strong></th>
						<th class="td-app"><strong>Tipo Clase</strong></th>
						<th class="td-app"><strong>Registro Clase</strong></th>
						<th  class="td-app"style="width: 14%;"><strong>Registrar Evento</strong></th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($clases as $key => $clase): ?>
						<tr>
							<td><?php echo $clase['dia'];?></td>
							<td><?php echo strtoupper($clase['horario']); ?></td>
							<td><?php echo strtoupper($clase['sala']); ?></td>
							<td><span class="badge" style="background:#336E7B;"><?php echo strtoupper($clase['tipo_clase']); ?></span></td>
							<td><span class="badge" style="background:#bdc3c7;"><?php echo $key == 0  ? 'ADELANTADA' : 'RECUPERATIVA'; ?></span></td>
							<td style="text-align: center;">
								<a href="<?php echo $this->Html->url(array('action'=>'registrarNuevaClase')) ?>" class="btn btn-sm btn-success"><i class="fa fa-plus"></i></a>
							</td>
						</tr>
					<?php endforeach ?>
				</tbody>
			</table>
			<!-- <a href="#modal_bitacora" data-toggle="modal" data-target="#modal_bitacora" class="pull-right btn btn-success btn-xs btn-warning "><i class="fa fa-plus"></i>&nbsp;Agregar Bitacora</a> -->
			<!-- <a style="margin-right: 10px;"class="pull-right btn btn-xs btn-success"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a> -->
		</div>	
	</div>
</div>
<div class="card">
	<div class="card-body card-padding" align="left">
		<a href="<?php echo $this->Html->url(array('action'=>'getEventos')) ?>"style="margin-right: 10px;"  class=" btn btn-sm btn-info volver"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>	
	</div>
</div>
<script>
	
</script>