<div class="modal-header" style="background:#ddd;">
	<div class="row">
		<div class="col-md-10">
			<h3 class="modal-title">
				Horario Docente Sede : <strong> <?php echo isset($sede['Sede']['ID_TIPO_SEDE']) && $sede['Sede']['ID_TIPO_SEDE'] == '1' ? ' IP' : ' CFT';?> - <?php echo $sede['Sede']['NOMBRE']; ?></strong>
			</h3>
		</div>
		<div class="col-md-2 text-right">
			<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar  Informaci&oacute;n</button>
		</div>
	</div>
</div>
<div class="modal-body" >
	<div class="row">
		<div class="col-md-6">
			<h4>
				<strong>Docente:</strong>&nbsp;
				<?php # 
				echo ($docente['Docente']['NOMBRE'].' '. $docente['Docente']['APELLIDO_PAT'].' '. $docente['Docente']['APELLIDO_MAT']); ?>	
			</h4>
			<h4>
				<strong>Correo:</strong>&nbsp;
				<?php echo $docente['Docente']['CORREO']; ?>
			</h4>
		</div>
		<div class="col-md-6">
			<h4  class="pull-right">
				<?php echo date('d-m-Y') ?> a las <?php echo date('H:i'); ?> horas
			</h4>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<h3>
				<?php if( isset($semana['Semana']) ): ?>
					Horario <?php echo date('d-m-Y',strtotime($semana['Semana']['FECHA_INICIO'])).' / '.date('d-m-Y',strtotime($semana['Semana']['FECHA_FIN'])); ?>
				<?php endif; ?>
				<div class="pull-right">
					<?php if ($dibujar_atras and isset($semana['Semana']) ): ?>
						<a class="btn btn-default btn-sm btn-info btn-control-horario" data-week="<?php echo $semana['Semana']['ID']; ?>" href="back-week"><i class="fa fa-chevron-left f-500"></i>&nbsp;Anterior</a>
					<?php endif ?>
					<?php if ($dibujar_adelante and isset($semana['Semana']) ): ?>
						<a class="btn btn-default btn-sm btn-info btn-control-horario" data-week="<?php echo $semana['Semana']['ID']; ?>" href="next-week">Siguiente&nbsp;<i class="fa f-500 fa-chevron-right"></i></a>
					<?php endif; ?>
				</div>
			</h3><br>
			<div id="cargando-horario-docente"><label for=""><i class="fa fa-cog fa-spin"></i></label></div>
			<table class="table table-hover table-striped" id="table_horario_docente">
				<thead>
					<tr>
						<th class="th-titulo">Horario</th>
						<th class="th-dias">Lunes</th>
						<th class="th-dias">Martes</th>
						<th class="th-dias">Miercoles</th>
						<th class="th-dias">Jueves</th>
						<th class="th-dias">Viernes</th>
						<th class="th-dias">Sabado</th>
					</tr>
				</thead>
				<tbody>
					<?php 
					$contador=0;
					$modulos_siguientes = array();
			#debug($horarios_modulos);exit();
				foreach ($horarios_modulos as $key => $horario): 
						$contador++;
						$class_tr = $contador%2==0?'odd':'even';
						$hora_inicio = $horario['HorarioModulo']['HORA_INICIO']; 
						// debug($programacion_clases);
						// debug($horario);
						// debug($key);
						 #*******************
						// echo $hora_inicio;
						?>
						<tr class="<?php echo $class_tr; ?>" align="center">
							<td style="vertical-align:middle;"><?php echo $hora_inicio; ?> - <?php echo $horario['HorarioModulo']['HORA_FIN']; ?></td>
						<?php for ($i=1; $i < 7; $i++): ?>
							<td style="vertical-align:middle;">
							<?php 
						  if (isset($programacion_clases[$hora_inicio][$i])):
									echo $programacion_clases[$hora_inicio][$i]['Sede']['NOMBRE'].'<br>'.$programacion_clases[$hora_inicio][$i]['ProgramacionClase']['SIGLA_SECCION'].'<br>'.$programacion_clases[$hora_inicio][$i]['Asignatura']['NOMBRE']
					#Jos&eacute; Luis Morand&eacute; Solucionado en el model agregue el join para la llamada
					.'<br>'.$programacion_clases[$hora_inicio][$i]['ProgramacionClase']['MODALIDAD'];

					#$a = strtotime('-15 min', strtotime($value['ProgramacionClase']['HORA_INICIO']));
					#$b = date('d-m-Y H:i:s', $a);
					#------------------------------------------
					#$a = strtotime($programacion_clases[$hora_inicio][$i]['ProgramacionClase']['HORA_INICIO']);
					#$b = date('H:i', $a);
								
								endif; 
								?>
							</td>
						<?php endfor; ?>
						</tr>	
					<?php endforeach;exit(); ?>
					<!-- <?php //foreach ($programacion_clases as $horario => $clases): ?>
					<tr>
					<td class="td-titulo"><?php #echo $horario; ?></td>
					<?php #for ($i=1; $i < 7; $i++): ?>
					<td class="td-valor">
					<?php #if (isset($clases[$i])): ?>
					<div><?php #echo $clases[$i]['Asignatura']['SIGLA']; ?></div>
					<div><?php #echo $clases[$i]['Asignatura']['NOMBRE']; ?></div>
					<div><?php #echo $clases[$i]['Sede']['NOMBRE']; ?></div>
					<?php #endif ?>
					</td>
					<?php #endfor; ?>
					</tr>
					<?php #endforeach; ?> -->
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal-footer">
	<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar  Informaci&oacute;n</button>
</div>
<script>
	$(function(){
		$('.btn-control-horario').on('click', function(event) {
			event.preventDefault();
			var arrow = $(this).attr('href');
			var week = $(this).attr('data-week');
			$('#horario_docente .modal-content').empty().html("<div align='center'></div>");
			$('#horario_docente .modal-content div').html(img_cargando);
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'verHorarioDocente',$periodo['Periodo']['COD_PERIODO'])); ?>'+'/'+arrow+'/'+week,
				type: 'POST',
				dataType: 'html',
				data:$('#form-filter-horario').serialize(),
			})
			.always(function(view) {
				$('#horario_docente .modal-content').html(view);
			});
		});
	});
</script>
<script>
    	function setModalMaxHeight(element) {
  this.$element     = $(element);  
  this.$content     = this.$element.find('.modal-content');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
      'overflow': 'hidden'
  });
  
  this.$element
    .find('.modal-body').css({
      'max-height': maxHeight,
      'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  setModalMaxHeight(this);
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});
  </script>