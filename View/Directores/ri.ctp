<style>
	.btn_exportar{
		padding: 1.5em;
		border:2px solid #ddd;
		border-radius: 5px;
		color:red;
		margin:10px;
	}
	.btn_exportar:hover {
		color: red;
	}
	tr{
		border:1px solid #ddd !important; 
	}
	td{
		vertical-align: middle;
	}
	.list{
		display: inline-block;
	}
	.rotar_fecha{
		font-size: 12px;
		-moz-transform: rotate(-90.0deg);  /* FF3.5+ */
		-o-transform: rotate(-90.0deg);  /* Opera 10.5 */
		-webkit-transform: rotate(-90.0deg);  /* Saf3.1+, Chrome */
		filter:  progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083);  /* IE6,IE7 */
		-ms-filter: "progid:DXImageTransform.Microsoft.BasicImage(rotation=0.083)"; 
	}
	.td-app{
		font-weight: 500 !important;
		padding: 7px 3px !important;
	}
	.td-danger{
		background: #e9594a;
		color: #fff;
		font-weight: bold;
	}
	#tabla-asistencia > tbody > tr > td{
		vertical-align: middle;
		padding: 0px 5px;
	}
</style>
<div class="card">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div id="ver_curso" class="tab-pane" role="tabpanel">
			<div class="table-responsive" style="overflow-x:hidden;">
				<br>
				<div class="row">
					<div class="col-md-12" style="background: #34495e;color:#fff;margin-bottom: 1%;">
						<div class="col-md-3" style="padding:3px;"><label>Clases Regulares Registradas: </label>&nbsp;<strong>10</strong></div>
						<div class="col-md-3" style="padding:3px;"><label>Clases Regulares: </label>&nbsp;<strong>50</strong></div>
						<div class="col-md-3" style="padding:3px;"><label>Clases Regulares Suspendidas: </label>&nbsp;<strong>1</strong></div>
						<div class="col-md-3" style="padding:3px;"><label>Asistencia Promedio: </label>&nbsp;<strong>64%</strong></div>
					</div>
					<div class="col-md-12 text-center" style="margin-bottom: 1%;">
						<div class="col-md-4">
							<label class="radio radio-inline m-r-20">
								<input type="radio" name="inlineRadioOptions" value="option2" id="todos" checked="">
								<i class="input-helper"></i>  
							</label>
							&nbsp;<label for="todos" style="cursor:pointer;">Todos los alumnos</label>
						</div>
						<div class="col-md-4">
							<label class="radio radio-inline m-r-20">
								<input type="radio" name="inlineRadioOptions" value="option2" id="mostrar">
								<i class="input-helper"></i>  
							</label>
							&nbsp;<label for="mostrar" style="cursor:pointer;">Alumnos reprobados por inasistencia</label><br>
							<strong style="color:#e9594a; display: none;" id="leyenda_reprobados">* Se muestra destacado en rojo todos aquellos alumnos que no cumplen con la condici&oacute;n de asistencia de la asignatura</strong>
						</div>
						<div class="col-md-4">
							<label class="radio radio-inline m-r-20">
								<input type="radio" name="inlineRadioOptions" value="option3" id="mostrar-2">
								<i class="input-helper"></i>  
							</label>
							&nbsp;<label for="mostrar-2" style="cursor:pointer;">Alumnos que no cumplen con porcentaje de asistencia</label>
						</div>
					</div>
				</div>
				<table class="table table-striped table-bordered table-hover" id="tabla-asistencia">
					<thead>
						<tr>
							<th class="td-app text-center" style="padding: 3px;">Rut Alumno</th>
							<th class="td-app text-left" >Apellido Paterno</th>
							<th class="td-app text-left">Apellido Materno</th>
							<th class="td-app text-left">Nombres</th>
							<th class="td-app text-center">Clases Regulares Presente</th>
							<th class="td-app text-center">Clases Regulares Ausente</th>
							<th class="td-app text-center">Asistencia</th>
							<th class="td-app text-center">Desici&oacute;n Docente</th>
							<th class="td-app text-center">Reprobar</th>
							<th class="td-app text-left" style="text-align: left !important; ">Comentarios</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($alumnos as $key => $value): $color = ($value['porcentaje']<75)?'red':'inherit';$checkbox = ($value['porcentaje']<73)?'checked="checked"':null;?>
							<tr <?php echo $key == 0 || $key == 4  ? 'reprobar' : 'todos'; ?> <?php echo $key == 0 || $key == 4 || $key == 6 || $key == 7  ? 'reprobar-2="true"' : 'todos'; ?> >
								<!-- <td align="center" style="width:2%;vertical-align: middle;">
									<label class="checkbox checkbox-inline m-r-20">
										<input type="checkbox" value="1" name="data[Alumno][uuid]" <?php echo $checkbox; ?> ><i class="input-helper"></i>
									</label>
								</td> -->
								<td class="text-center"><?php echo strtoupper($value['rut']); ?></td>
								<td class="text-left"><?php echo strtoupper($value['paterno']); ?></td>
								<td class="text-left"><?php echo strtoupper($value['materno']); ?></td>
								<td class="text-left">
									<?php if ($key == 0): ?>
										<a href="<?php echo $this->Html->url(array('action'=>'historicoAsistencia','ver_alumno')); ?>" style="cursor: pointer;"class="alumno_active"><?php echo strtoupper($value['nombre']); ?></a>
									<?php else: ?>	
										<?php echo strtoupper($value['nombre']); ?>
									<?php endif ?>
								</td>
								<td class="text-center" ><?php echo $value['clases_registradas']; ?></td>
								<td class="text-center"><?php echo $value['clases_presentes']; ?></td>
								<td class="text-center <?php echo $key == 0 || $key == 4 || $key == 6  ? 'td-danger' : ''; ?>"<?php echo $key == 0 || $key == 4 || $key == 6  ? 'reprobar' : 'todos'; ?> >
									<?php echo $value['porcentaje']; ?>
								</td>
								<td class="text-center">
									<i <?php echo $key == 0 || $key == 4 || $key == 6 ? 'style="color:red;"' : 'style="color:green;"'; ?> class="fa <?php echo $key == 0 || $key == 4 || $key == 6 ? 'fa-ban' : 'fa-check-circle'; ?>"></i>&nbsp;&nbsp;&nbsp;
									<button class="btn btn-xs btn-primary waves-effect waves-button waves-float" data-toggle="popover" data-placement="top" data-content="<?php echo $key == 0 || $key == 4 || $key == 6 ? 'el alumno reprueba por inacistencia' : 'El alumno cumple con el porcentaje minimo de asistecia'; ?>" title="" data-original-title="Comentario Dcente"><i class="fa fa-comment"></i> </button>
								</td>
								<td class="text-center" style="width:2%;vertical-align: middle;">
									<label class="checkbox checkbox-inline ">
										<input type="checkbox" value="1" name="data[Alumno][uuid]" <?php echo $checkbox; ?> ><i class="input-helper"></i>
									</label>
								</td>
								<td>
									<div class="fg-line">
										<input type="text" class="form-control" placeholder="Max. 300 Caracteres">
									</div>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>	
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12" align="center">
				<a  id="btn-volver" href="<?php echo $this->Html->url(array('action'=>'aprobarRi')); ?>" class="btn btn-info btn-sm waves-effect waves-float"><i class="fa fa-arrow-left"></i>&nbsp;Salir Sin Guardar</a>
				<button id="btn-guardar-ri" class="btn bgm-green waves-effect btn-sm waves-float"><i class="fa fa-save"></i>&nbsp;Guardar</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('#btn-guardar-ri').on('click',function (event) {
		swal({   
            title: "<?php echo __('¿Est&aacute; seguro que desea guardar?'); ?>",   
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
	$('#btn-volver').on('click',function (event) {
		event.preventDefault();
		swal({   
            title: "<?php echo __('¿Esta seguro que desea salir sin guardar?'); ?>",   
            text: "<?php echo __(''); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "S&iacute;, Estoy Seguro!",   
            closeOnConfirm: false 
        }, function(){
        	window.location = "<?php echo $this->Html->url(array('action'=>'aprobarRi')); ?>";
        	//swal("Completado!", "Eliminado con &eacute;xito.", "success"); 
        }); 
	});
	$('[data-toggle="popover"]').popover();
	$('.auto-size').autosize();
	$(function() {
		$('#mostrar').click(function(event) {
			$('#leyenda_reprobados').show();
			$('tr[todos]').css('display', 'none');
			$('td[reprobar]').each(function(index, el) {
				$(this).addClass('td-danger');
			});
		})
		$('#mostrar-2').click(function(event) {
			$('#leyenda_reprobados').show();
			$('tr[todos]').css('display', 'none');
			$('tr[reprobar]').css('display', 'none');
			$('tr[reprobar-2]').removeAttr('style');
		})
		$('#todos').click(function(event) {
			$('#leyenda_reprobados').hide();
			
			$('tr[todos]').removeAttr('style');
		});
	});
</script>