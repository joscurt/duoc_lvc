<?php 
	$porcentaje_minimo_ri = 75;
?>
<style>
	.hand{
		cursor: pointer;
	}
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
		border-right:1px solid #ddd !important; 
		border-left:1px solid #ddd !important; 
		padding: 5px !important;
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
		padding: 5px 3px !important;
	}
	.td-danger{
		background: #e9594a;
		color: #fff;
		font-weight: bold;
	}
	#tabla-ri tbody>tr>td{
		padding: 4px !important;
		vertical-align: middle;
	}
	.table > thead > tr > th:first-child{
    	padding-left: 15px !important;
	}
</style>
<br>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />
<div class="card">
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<form 
	action="<?php echo $this->Html->url(array('action'=>'saveReprobadoInasistencia',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" method="POST" enctype="multipart/form-data">
	<div class="card">
		<div class="card-body card-padding">
			<div id="ver_curso" class="tab-pane" role="tabpanel">
				<div class="table-responsive" style="overflow-x: hidden;">
					<br>
					<div class="row">
						<div class="col-md-12" style="background: #34495e;color:#fff;margin-bottom: 1%;">
							<!-- <div class="col-md-3" style="padding:3px;"><label>Clases Regulares Registradas: </label>&nbsp;<strong><?php #echo $asignatura_horario['AsignaturaHorario']['CLASES_REGISTRADAS']; ?></strong></div> -->
							<div class="col-md-3" style="padding:3px;"><label>Clases Regulares Registradas: </label>&nbsp;<strong><?php echo $clases_regulares_registradas; ?></strong></div> 
							<div class="col-md-3" style="padding:3px;"><label>Clases Regulares: </label>&nbsp;<strong><?php echo $clases_regulares; ?></strong></div>
							<div class="col-md-3" style="padding:3px;"><label>Clases Regulares Suspendidas: </label>&nbsp;<strong><?php echo $clases_suspendidas; ?></strong></div>
							<div class="col-md-3" style="padding:3px;"><label>Asistencia Promedio: </label>&nbsp;<strong><?php echo $asignatura_horario['AsignaturaHorario']['ASIST_PROMEDIO']; ?>%</strong></div>
						</div>
						<div class="col-md-12 text-center" style="margin-bottom: 1%;">
							<div class="col-md-4">
								<label class="radio radio-inline m-r-20">
									<input type="radio" name="inlineRadioOptions" value="option2" id="todos" checked="">
									<i class="input-helper"></i>  
								</label>
								&nbsp;<label for="todos" class="hand">Todos los alumnos</label>
							</div>
							<div class="col-md-4">
								<label class="radio radio-inline m-r-20">
									<input type="radio" name="inlineRadioOptions" value="option2" id="mostrar">
									<i class="input-helper"></i>  
								</label>
								&nbsp;<label for="mostrar"  class="hand">Alumnos reprobados por inasistencia</label><br>
							</div>
							<div class="col-md-4">
								<label class="radio radio-inline m-r-20">
									<input type="radio" name="inlineRadioOptions" value="option3" id="mostrar-2">
									<i class="input-helper"></i>  
								</label>
								&nbsp;<label for="mostrar-2"  class="hand">Alumnos que no cumplen con porcentaje de asistencia</label>
							</div>
						</div>
					</div>


					<div class="col-md-12">
						<table class="table table-striped table-bordered table-hover" id="tabla-ri">
							<thead>
								<tr>
									<th class="td-app text-center" ><span title="Reprobado por Inasistencia">RI</span></th>
									<th class="td-app text-center">Rut Alumno</th>
									<th class="td-app text-left">Apellido Paterno</th>
									<th class="td-app text-left">Apellido Materno</th>
									<th class="td-app text-left">Nombres</th>
									<th class="td-app text-center">Clases Regulares Presente</th>
									<th class="td-app text-center">Clases Regulares Ausente</th>
									<th class="td-app text-center">Asistencia</th>
									<th class="td-app text-left">Comentarios al Director de Carrera (Opcional)</th>
								</tr>
							</thead>
							<tbody>
								<?php 
									foreach ($alumnos as $key => $value): 
										# CALCULO EL PORCENTAJE DE ASISTENCIA DEL ALUMNO ================================================================================
										$porcentaje = 0;
										if (isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])) {
											if($clases_regulares_registradas>0){ 
											#02-10-2017 Luis Adan Agrega esta validacion debido que daba error por division de cero
												$porcentaje = $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']*100/$clases_regulares_registradas;	}
										}  # ============================================================================================================================

										$color = ($porcentaje < $porcentaje_minimo_ri)?'red':'inherit';
										
										$checkbox2 = ($porcentaje === 100)?'disabled':null;
										
										$checkbox = ($porcentaje < $porcentaje_minimo_ri)?'checked="checked"':null; 
										$observaciones = '';
										if (!empty($value['RI']['ID'])) {
											$checkbox = ((int)$value['RI']['R_I'] === 1)?'checked="checked"':null; 
											//$disabled = "disabled";
											$observaciones = $value['RI']['OBSERVACIONES'];
										}
								?>
									<tr >
										<input type="hidden" name="data[Alumno][<?php echo $key; ?>][ID_ALUMNO]" value="<?php echo $value['Alumno']['ID'] ?>">
										<td class="text-center">
											<label class="checkbox checkbox-inline">
												<input <?php echo $checkbox; ?> <?php echo $checkbox2; ?> type="checkbox" value="1" name="data[Alumno][<?php echo $key; ?>][RI]" ><i class="input-helper"></i>
											</label>
										</td>
										<td class="text-center"><?php echo strtoupper($value['Alumno']['RUT']); ?></td>
										<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_PAT']); ?></td>
										<td class="text-left"><?php echo strtoupper($value['Alumno']['APELLIDO_MAT']); ?></td>
										<td class="text-left">
											<?php echo strtoupper($value['Alumno']['NOMBRES']); ?>
										</td>
			<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_PRESENTE']:0; ?></td>
			<td class="text-center" ><?php echo isset($indicadores_alumnos[$value['Alumno']['COD_ALUMNO']])? $indicadores_alumnos[$value['Alumno']['COD_ALUMNO']]['CLASES_AUSENTE']:0; ?></td>
										<td class="text-center <?php echo $porcentaje < $porcentaje_minimo_ri  ? 'td-danger' : ''; ?>" >
											<?php 
												echo ($porcentaje > 100) ? '100%' : round($porcentaje,2).'%';
											?>
										</td>
										<td class="text-left">
											<div class="form-group" style="margin-bottom: 0;">
												<div class="fg-line">
													<input 
														class="form-control"
														maxlength="300"
														name="data[Alumno][<?php echo $key; ?>][OBSERVACIONES]"
														placeholder="M&aacute;x. 300 car&aacute;cteres..."
														type="text"
														value="<?php echo $observaciones; ?>" />
												</div>
											</div>
										</td>
									</tr>
								<?php endforeach ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-12 text-left">
						<strong style="color:#e9594a; display: none;" id="leyenda_reprobados">* Se muestran los Alumnos que el docente marc&oacute; en la columna RI</strong>
						<strong style="color:#e9594a; display: none;" id="leyenda_reprobados_2">* Se muestra destacado en rojo todos aquellos alumnos que no cumplen con la condici&oacute;n de asistencia de la asignatura</strong>
					</div>
				</div>
			</div>
		</div>
		<div class="card-body card-padding">
			<div class="row">
				<div class="col-md-12" align="center">
					<a href="#" id="btn-volver" class="btn btn-info btn-sm waves-effect waves-float"><i class="fa fa-arrow-left"></i>&nbsp;Salir sin Guardar</a>

					<?php 
					$date_now = date('Y-m-d H:i');
					$fecha_actual = strtotime($date_now);
					$fecha_inicio = strtotime($asignatura_horario['Periodo']['FECHA_INICIO_RI']);
					$fecha_fin = strtotime($asignatura_horario['Periodo']['FECHA_FIN_RI']);
					$fecha_inicio2 = date('d-m-Y', $fecha_inicio);	
					$fechafin2 = date('d-m-Y', $fecha_fin);


					#echo "Fecha Inicio : ".$fecha_inicio;
					#echo "Fecha Corte : ".$fecha_fin;

					if (($fecha_inicio <= $fecha_actual) && ($fecha_fin >= $fecha_actual)) { ?>

									<button 
											class="btn bgm-green waves-effect btn-sm waves-float" 
											type="submit"><i class="fa fa-send"></i>&nbsp;Enviar RI a Director de Carrera</button>

					<?php }else{
					echo "<a id='btn-alert' class='btn btn-warning waves-effect btn-sm waves-float' ><i class='fa fa-clock-o' aria-hidden='true'></i>&nbsp;Enviar RI a Director de Carrera</a>";
						} ?>

<!-- 					<a class="btn btn-primary" style="background-color:#1F7244;" data-toggle="modal" href="#myModal2">
				     <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;Importar Excel de Alumnos
				  
				    </a> -->

						<!--<a class='btn btn-warning waves-effect btn-sm waves-float' href="<?php echo $this->Html->url(array('controller'=>'Docentes','action'=>'reprobadoInacistenciaImport',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])) ?>"><i class='fa fa-send' aria-hidden='true'></i>&nbsp;Import Excel</a>-->

				</div>
			</div>
		</div>
	</div>
</form>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" style="overflow: hidden;">
        <div class="modal-header" style="padding-bottom:5px;">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModal2Label">Agregar Excel</h4>
          <legend></legend>
        </div>
        <div class="modal-body" style="max-height: 386px; overflow-y: auto;padding-bottom: 20px;">

		<form action="<?php echo $this->Html->url(array('action'=>'reprobadoInacistencia',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>" method="POST" class="dropzone" id="ImageReprobadoInacistenciaForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
		<div style="display:none;">
		<input type="hidden" name="_method" value="POST"></div>
		<fieldset style="float: left;margin-top: -13px;">
              <div class="input file"><br>
              <input type="file" name="data[Image][submittedfile]" id="excel_type"></div>
              <!--<input type="file" name="field" id="excel_type"></div>-->
        </fieldset>
				       <a style="float: right;margin-left: 5px;" data-toggle="modal" class="btn btn-warning" href="#myModal3""> <i class="fa fa-picture-o" aria-hidden="true"></i>&nbsp;Ver Formato</a>	
         <div class="submit" style="float: right;">
         <input class="btn btn-primary" type="submit" id="subm" value="Procesar"></div>
         </form>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>


<div class="modal fade" id="myModal3" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true" style="display: none;">
    <div style="width: 850px;" class="modal-dialog">
      <div class="modal-content" style="overflow: hidden;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModal2Label">Excel Formato</h4>
          <legend style="margin-bottom: 0px;"></legend>
        </div>
        <div class="modal-body" style="max-height: 386px; overflow-y: auto;">
			<img style="border:1px solid #ddd;" src="../../img/formato_excel.png">
			<ul style="list-style:none;font-size:20px;margin-top: 15px;">
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;Campos Obligatorios RUT, Nombres, Clases Presente, Clases Registradas, Sigla Secci&oacute;n.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;No puedes dejar campos Obligatorios en blanco.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;Recuerda que los campos Clases Registradas y Clases Presente son n&uacute;mericos.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;El campo RUT debe ser de un Alumno de esta secci&oacute;n.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;La Sigla Secci&oacute;n debe corresponder a la Sigla de la Clase.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;El archivo Excel debe contener la Cabecera con los t&iacute;tulos del campo en el orden de la imagen.
				</li>
				<li style="list-style:none;">
					<i class="fa fa-check" style="color:green" aria-hidden="true"></i>&nbsp;&nbsp;El archivo Excel debe contener la Cabecera con los t&iacute;tulos del campo en el orden de la imagen.
				</li>
			</ul>

        </div>
        <div class="modal-footer">
			<a data-rel="tooltip" data-original-title="Ac&aacute; puedes descargar el formato del excel que debes importar" style="background-color:#1F7244;float:left;" download="formato_plantilla_<?php echo $asignatura_horario['AsignaturaHorario']['SIGLA_SECCION']; ?>.xlsx" class="btn btn-warning" href="../../files/formato_plantilla.xlsx""> <i class="fa fa-file-excel-o" aria-hidden="true"></i>&nbsp;Descargar Formato Plantilla</a>	

          <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>



<script>



 $('#ImageReprobadoInacistenciaForm').validate({
        rules: {},
        messages: {
        	'data[Image][submittedfile]': "Debes seleccionar un documento"

        },
        submitHandler: function () {
            return false
        }
    });
    $('input[name^="data[Image][submittedfile]"]').rules('add', {
        required: true,
        accept: "xls, xlsx"
    });


		/*		jQuery.validator.setDefaults({
				  debug: true,
				  success: "valid"
				});
				$( "#ImageReprobadoInacistenciaForm" ).validate({
				  rules: {
				    'data[Image][submittedfile]': {
				      required: true
				      //accept: "xls, xlsx"
				      //accept: "audio/*"
				    }
				  },
				  messages:{
				  	'data[Image][submittedfile]' : "Debes Seleccionar un archivo Excel"
				  },
				  submitHandler: function () {
          			  return false
      			  }
				});*/
		$('#excel_type').change(
            function () {
            var fileExtension = ['xlsx','xls'];
                    if ($.inArray($(this).val().split('.').pop().toLowerCase(), fileExtension) == -1) {
                        swal({
                        	title: "Solo se permite formato Excel.",
                        	type: "warning",	
                        });
                        this.value = ''; // Clean field
                        return false;
                    }
            
        });
		

	$('.auto-size').autosize();
	$('#btn-volver').on('click',function (event) {
		swal({   
            title: "<?php echo __('¿Esta seguro que desea salir sin guardar?'); ?>",   
            text: "<?php echo __(''); ?>",
            type: "warning",
            showCancelButton: true, 
            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
            confirmButtonColor: "#DD6B55",   
            confirmButtonText: "S&iacute;, Estoy Seguro!",   
            closeOnConfirm: false,
        }, function(){
        	window.location = "<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['AsignaturaHorario']['COD_PERIODO'])); ?>";
        });
	});
	$('#btn-alert').on('click',function (event) {
		var fechainicio = "<?php echo $fecha_inicio2; ?>";
		var fechafin = "<?php echo $fechafin2 ?>";
		notifyUser("No puedes Enviar RI a Director de Carrera estas fuera del rango de Fechas. Desde " +fechainicio+" Hasta "+fechafin+"");
	});
	$(function() {
		$('#mostrar').click(function(event) {
			$('#leyenda_reprobados').show();
			$('#leyenda_reprobados_2').hide();
			$('#tabla-ri tbody tr').hide();
			$('#tabla-ri tbody input:checked').each(function(index, el) {
				$(this).parents('tr').show();
			});
		});
		$('#todos').click(function(event) {
			$('#leyenda_reprobados').hide();
			$('#leyenda_reprobados_2').hide();
			$('#tabla-ri tbody tr').show();
		});
		$('#mostrar-2').click(function(event) {
			$('#leyenda_reprobados').hide();
			$('#leyenda_reprobados_2').show();
			$('#tabla-ri tbody tr').hide();
			$('#tabla-ri tbody tr td.td-danger').each(function(index, el) {
				$(this).parents('tr').show();
			});
		});
	});
</script>