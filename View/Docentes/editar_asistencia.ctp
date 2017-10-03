<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
		padding: 5px !important;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 5px !important;
	}
	.leyenda{
		width: 23px;
		padding: 2px;
		display: inline-block;
		text-align: center;
		margin-right: 5px;
	}
	.texto_leyenda{
		color:#000;
	}
	.background-info{
		background:#00bcd4 !important;
		color: white;
	}
	.background-gray{
		background:#95A5A6 !important;
		color: white;
	}
	.background-gray:hover{
		cursor: default !important;
	}
	td{
		cursor: pointer;
		padding: 5px !important;
		text-align: center !important;
		vertical-align: middle !important;
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
	.col-md-2-calendar{
		margin-left: 3.2%;
		border-left: 1px solid #dedede;
	}
	.mes-calendario td:hover{
		background-color:#f1f1f1;
	}
	.mes-calendario .td-active:hover{
		background-color:#95A5A6;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#95A5A6;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#95A5A6;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 5px !important;
		padding-right: 5px !important;
	}
	#table-edit td{
		padding:0px !important;
		vertical-align: middle !important;
	}
	table.mes-calendario > tbody > tr > td{
		padding: 2px 5px 2px 5px!important;
	}
	#table-eventos td{
		padding:0px !important;
		vertical-align: middle;
	}
	.m-t-100{
		margin-top: 150px;
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
<div class="card header-docente">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding m-t-100">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group fg-line">
					<label for="">Seleccione un rango de fechas</label>
					<input type="text" value="<?php echo date('d-m-Y') ?>" autocomplete="off" class="form-control datetimepicker" placeholder="Fecha desde..." />
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group fg-line">
					<label for="">&nbsp;</label>
					<input type="text" value="<?php echo date('d-m-Y') ?>" autocomplete="off" class="form-control datetimepicker" placeholder="Fecha hasta..."/>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group fg-line">
					<button type="button" class="btn bgm-green m-t-25"><i class="fa fa-filter"></i>&nbsp;FILTRAR</button>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-striped">
					<thead>
						<tr>
							<th class="td-app">Horario</th>
							<th class="td-app">Sala</th>
							<th class="td-app">Tipo de Clase</th>
							<th class="td-app">Detalle</th>
							<th class="td-app">Estado</th>
							<th class="td-app">Fecha Clase</th>
							<th class="td-app">Fecha Registro</th>
							<th class="td-app">Registro</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$arreglo = array(
								array(
									'horario'=>'8:31 - 10:00',
									'sala'=>'AO-311',
									'tipo'=>'Regular',
									'detalle'=>'Suspendida',
									'estado'=>'Realizada',
									'fecha_clase'=>'01-09-2016',
									'fecha_registro'=>'',
									'editado'=>0,
								),
								array(
									'horario'=>'10:01 - 11:30',
									'sala'=>'AO-312',
									'tipo'=>'No Regular',
									'detalle'=>'Recuperada',
									'estado'=>'No Realizada',
									'fecha_clase'=>'01-08-2016',
									'fecha_registro'=>'01-08-2016',
									'editado'=>1,
								),
								array(
									'horario'=>'11:31 - 13:00',
									'sala'=>'AO-120',
									'tipo'=>'Regular',
									'detalle'=>'Adelantada',
									'estado'=>'Programada',
									'fecha_clase'=>'01-10-2016',
									'fecha_registro'=>'29-08-2016',
									'editado'=>1,
								),
							);
						?>
						<?php foreach ($arreglo as $key => $value): ?>
							<tr>
								<td><?php echo $value['horario']; ?></td>
								<td><?php echo $value['sala']; ?></td>
								<td><?php echo $value['tipo']; ?></td>
								<td><?php echo $value['detalle']; ?></td>
								<td><?php echo $value['estado']; ?></td>
								<td><?php echo $value['fecha_clase']; ?></td>
								<td><?php echo $value['fecha_registro']; ?></td>
								<?php if ($value['editado']): ?>
									<td><a href="" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></a></td>	
								<?php else: ?>
									<td><a href="" class="btn btn-sm btn-success boton-editar"><i class="fa fa-plus"></i></a></td>	
								<?php endif ?>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
		
	</div>
</div>
<div class="card" id="div-asistencia" style="margin-top: 1%; display:none;">
	<div class="card-header">
		<div class="row">
			<div class="col-md-2">
				<h2>Editar Asistencia</h2>
			</div>
			<div class="col-md-offset-2 col-md-2">
				<label class="checkbox checkbox-inline m-r-20">
					<input disabled type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i>
					Alumno Presente
				</label>		
			</div>
			<div class="col-md-3">
				<label class="checkbox checkbox-inline m-r-20">
					<input disabled type="checkbox"  value="" name="data[Alumno][uuid]">
					<i class="input-helper"></i>Alumno Ausente
				</label>
			</div>
		</div>
	</div>
	<div class="card-body card-padding p-t-0" >
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<table class="table table-striped table-hover" id="table-eventos" >
				<thead>
					<tr>
						<th class="td-app"><strong>Rut</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Apellido Paterno</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Apellido Materno</strong></th>
						<th style="text-align: left;"class="td-app"><strong>Nombres</strong></th>
						<th class="td-app"><strong>Asistencia</strong></th>
						<th class="td-app text-left"><strong>Carrera del Alumno</strong></th>
						<th class="td-app text-left"><strong>Observaciones</strong></th>
					</tr>
				</thead>
				<tbody>	
					<?php foreach ($alumnos as $key => $alumno): ?>
						<tr>
							<td><?php echo $alumno['rut'];?></td>
							<td class="text-left"><?php echo strtoupper($alumno['paterno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['materno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['nombre']); ?></td>
							<td class="text-center">
								<label class="checkbox checkbox-inline ">
									<input type="checkbox" checked="" value="" name="data[Alumno][uuid]">
									<i class="input-helper"></i>
								</label>
							</td>
							<td class="text-left"><?php echo strtoupper($alumno['carrera']); ?></td>
							<td class="text-left">
								<div class="fg-line">
									<input type="text" class="form-control" placeholder="Maximo 300 caracteres">
								</div>
							</td>
						</tr>
					<?php endforeach ?>
					<?php foreach ($alumnos as $key => $alumno): ?>
						<tr>
							<td><?php echo $alumno['rut'];?></td>
							<td class="text-left"><?php echo strtoupper($alumno['paterno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['materno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['nombre']); ?></td>
							<td class="text-center">
								<label class="checkbox checkbox-inline ">
									<input type="checkbox" checked="" value="" name="data[Alumno][uuid]">
									<i class="input-helper"></i>
								</label>
							</td>
							<td class="text-left"><?php echo strtoupper($alumno['carrera']); ?></td>
							<td class="text-left">
								<div class="fg-line">
									<input type="text" class="form-control" placeholder="Maximo 300 caracteres">
								</div>
							</td>
						</tr>
					<?php endforeach ?>
					<?php foreach ($alumnos as $key => $alumno): ?>
						<tr>
							<td><?php echo $alumno['rut'];?></td>
							<td class="text-left"><?php echo strtoupper($alumno['paterno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['materno']); ?></td>
							<td class="text-left"><?php echo strtoupper($alumno['nombre']); ?></td>
							<td class="text-center">
								<label class="checkbox checkbox-inline ">
									<input type="checkbox" checked="" value="" name="data[Alumno][uuid]">
									<i class="input-helper"></i>
								</label>
							</td>
							<td class="text-left"><?php echo strtoupper($alumno['carrera']); ?></td>
							<td class="text-left">
								<div class="fg-line">
									<input type="text" class="form-control" placeholder="Maximo 300 caracteres">
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
		<a  id="btn-iniciar-clase" class=" btn btn-sm btn-success"><i class="fa fa-play"></i>&nbsp;Iniciar Clase</a>
		<a  id="btn-finalizar-clase" style="display:none;" class=" btn btn-sm bgm-lightgreen"><i class="md md-done-all"></i>&nbsp;Finalizar Clase</a>
		<a  id="btn-registrar-asistencia" style="display:none;" class=" btn btn-sm bgm-orange"><i class="md md-assignment"></i>&nbsp;Registrar Asistencia</a>
		<a  id="btn-agregar-bitacora" style="display:none;" class="btn bgm-blue btn-sm  animated fadeIn"><i class="fa fa-plus"></i>&nbsp;Agregar Bit&aacute;cora</a>
		<a  id="btn-guardar-asistencia" style="display:none;" class=" btn btn-sm btn-success animated fadeIn"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a>
		<a  id="btn-salir" class="btn btn-sm btn-info"><i class="fa fa-arrow-left"></i>&nbsp;Salir</a>
	</div>
</div>
<script>
	$(function() {
		$('#btn-salir').click(function(event) {
			var href = '<?php echo $this->Html->url(array('action'=>'getEventos')); ?>';
			swal({   
	            title: "<?php echo __('¿Estas Seguro de salir sin guardar los datos de la asistencia de los alumnos?'); ?>",   
	            text: "<?php echo __(''); ?>",
	            type: "warning",
	            showCancelButton: true, 
	            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "S&iacute;, Estoy Seguro!",   
	            closeOnConfirm: false 
	        }, function(){
	        	window.location = href;
	        	//swal("Completado!", "Eliminado con &eacute;xito.", "success"); 
	        });
		});
		$('#btn-guardar-asistencia').on('click',function (event) {
			swal({   
	            title: "<?php echo __('¿Estas Seguro que deseas guardar los datos de los alumnos?'); ?>",   
	            text: "<?php echo __(''); ?>",
	            type: "warning",
	            showCancelButton: true, 
	            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "S&iacute;, Estoy Seguro!",   
	            closeOnConfirm: false 
	        }, function(){
	        	location.reload();
	        	//swal("Completado!", "Eliminado con &eacute;xito.", "success"); 
	        });
		});
		$('#btn-iniciar-clase').on('click',function(){
			event.preventDefault();
			$(this).hide();
			$('#btn-finalizar-clase, #btn-registrar-asistencia').show();
		});
		$('.boton-editar').click(function(event) {
			event.preventDefault();
			$('#div-asistencia').show();
		});
		$('#btn-registrar-asistencia').on('click',function(event) {
			event.preventDefault();
			$(this).hide();
			$('#btn-agregar-bitacora, #btn-guardar-asistencia').show();
		});
	});
</script>