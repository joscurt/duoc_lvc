<style>
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
		padding: 5px !important;
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
	td{
		cursor: pointer;
		padding-top: 5px !important;
		text-align: center;
		vertical-align: middle !important;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 5px !important;
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
	table.mes-calendario > tbody > tr > td{
		padding: 2px 5px 2px 5px!important;
	}
	.mes-calendario td:hover{
		background-color:#f1f1f1;
	}
	.mes-calendario .td-active:hover{
		background-color:#26A65B;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#ccc;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#ccc;
	}
	#table-eventos td{
		padding:0 0 0 5px !important;
		vertical-align: middle;
	}
</style>
<div class="back">
	<div class="card header-docente">
		<div class="card-padding card-body">
			<?php echo $this->element('header_docente',array('asignatura_horario'=>$asignatura_horario)); ?>
		</div>
	</div>
</div>
<div class="card" style="display: block;margin-top: 12%;">
	<div class="card-padding card-body">
		<div class="row">
			<form id="form-filtro-fecha">
				<div class="col-md-2">
					<div class="form-group fg-line">
						<label for="">Seleccione un rango de fechas</label>
						<input 
							type="text" 
							value="<?php echo date('d-m-Y'); ?>" 
							autocomplete="off" 
							required="required"
							name="data[Filtro][fecha_inicio]"
							class="form-control datetimepicker fecha-inicio" 
							placeholder="Fecha desde..." />
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group fg-line">
						<label for="">&nbsp;</label>
						<input 
							type="text" 
							required="required"
							value="<?php echo date('d-m-Y'); ?>" 
							name="data[Filtro][fecha_fin]"
							autocomplete="off" 
							class="form-control datetimepicker fecha-termino" 
							placeholder="Fecha hasta..."/>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group fg-line">
						<button type="submit" class="btn bgm-green m-t-25"><i class="fa fa-filter"></i>&nbsp;FILTRAR</button>
						<a href="<?php echo $this->Html->url(array('action'=>'getEventos',$asignatura_horario['Periodo']['COD_PERIODO'])); ?>" class="btn btn-info m-t-25 btn-salir-listado"><i class="fa fa-arrow-left"></i>&nbsp;VOLVER</a>
					</div>
				</div>
			</form>
		</div>
		<div class="row">
			<div class="col-md-12" id="content-listado-programacion-clases"></div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal-bitacora" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			
		</div>
	</div>
</div>
<script>
	var hay_modificaciones = false;
	var clase_finalizada = true;
	$(function(event) {
		var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
		$('.datetimepicker').datetimepicker({format: 'DD-MM-YYYY'});
		$('#form-filtro-fecha').on('submit', function(event) {
			event.preventDefault();
			var fecha_inicio = $('#form-filtro-fecha .fecha-inicio').val();
			var fecha_termino = $('#form-filtro-fecha .fecha-termino').val();
			if(!fechaCorrecta(fecha_inicio,fecha_termino)){
				notifyUser('La fecha de término no puede ser mayor a la fecha de inicio.','danger');
				return false;	
			}
			img_cargando.style="width:150px;";
			$('#content-listado-programacion-clases').empty().html('<div align="center"></div>');
			$('#content-listado-programacion-clases div').html(img_cargando);
			$('#div-asistencia').empty();
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'verProgramacionClases',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>',
				type: 'POST',
				dataType: 'html',
				data: $('#form-filtro-fecha').serialize(),
			})
			.fail(function() {
				$('#content-listado-programacion-clases').empty();
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
			})
			.always(function(view) {
				$('#content-listado-programacion-clases').html(view);
			});
		});
		function fechaCorrecta(fecha1, fecha2){
		    //Split de las fechas recibidas para separarlas
		    var x = fecha1.split("-");
		    var z = fecha2.split("-");
		    
		    //Cambiamos el orden al formato americano, de esto dd/mm/yyyy a esto mm/dd/yyyy
		    fecha1 = x[2] + "-" + x[1] + "-" + x[0];
		    fecha2 = z[2] + "-" + z[1] + "-" + z[0];

		    
		    //Comparamos las fechas
		    
		    if (Date.parse(fecha1) > Date.parse(fecha2)){
		        return false;
		    }else{
		        return true;
		    }
		}

		$('#btn-guardar-asistencia').on('click',function (event) {
			swal({   
	            title: "<?php echo __('¿Está seguro que deseas guardar los datos de la asistencia de los alumnos?'); ?>",   
	            text: "<?php echo __(''); ?>",
	            type: "warning",
	            showCancelButton: true, 
	            cancelButtonText: "<?php echo __('Cancelar'); ?>",   
	            confirmButtonColor: "#DD6B55",   
	            confirmButtonText: "Sí, estoy seguro!",   
	            closeOnConfirm: false 
	        }, function(){
	        	location.reload();
	        	//swal("Completado!", "Eliminado con éxito.", "success"); 
	        }); 
		});
	});
</script>