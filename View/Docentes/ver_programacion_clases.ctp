<?php if (!empty($programacion_clases)): ?>
	<table class="table table-hover table-striped">
		<thead>
			<tr>
				<th class="td-app">N°</th>
				<th class="td-app">Horario</th>
				<th class="td-app">Sala</th>
				<th class="td-app">Tipo</th>
				<th class="td-app">Detalle</th>
				<th class="td-app">Estado</th>
				<th>ID</th>
				<!-- <th>horaactual</th> -->
				<th class="td-app">Sub Estado</th>
				<th class="td-app">Fecha Clase</th>
				<th class="td-app">Fecha Registro</th>
				<th class="td-app">Registro</th>
				<!--<th class="td-app">botonejemplo</th>-->
			</tr>
		</thead>
		<tbody> 
			<?php 
			#$FechaActual='2017-06-28';
				$FechaActual=date('d-m-Y H:i');
		//	echo $FechaActual."<br>";
			foreach ($programacion_clases as $key => $value):
		#	$FechaActual=date('Y-m-d');
				
			 ?>
				<tr>
					<td class="text-center"><?php echo $key +1;?></td>
					<td><?php echo date('H:i',strtotime($value['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i',strtotime($value['ProgramacionClase']['HORA_FIN'])); ?></td>
					<td><?php echo !empty($value['Sala']['TIPO_SALA']) ? $value['Sala']['TIPO_SALA']:$value['SalaReemplazo']['TIPO_SALA']; ?></td>
					<td><?php echo $value['ProgramacionClase']['TIPO_EVENTO']; ?></td>
					<td><?php echo $value['Detalle']['DETALLE']; ?></td>
					<td><?php echo $value['Estado']['NOMBRE']; ?></td>
					<td><?php  echo $value['ProgramacionClase']['ID']; ?></td>
					<!-- <td><?php # echo $FechaActual; ?></td> -->
					<td><?php echo $value['SubEstado']['NOMBRE']; ?></td>
					<td><?php echo date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_CLASE'])); ?></td>
					<td>
						<?php 
							if (!empty($value['ProgramacionClase']['FECHA_REGISTRO'])) {
								echo date('d-m-Y',strtotime($value['ProgramacionClase']['FECHA_REGISTRO']));
							}
						?>
					</td>


					<td> <!-- BOTON DE ACCION DE UNA CLASE CON CONDICIONES VARIAS |||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||| -->

						<?php 
						# Autorizacion Pendiente DO008
						if ($value['ProgramacionClase']['SUB_ESTADO_PROGRAMACION_ID']=='1') {

							echo '<a href="#" id="M008" class="btn btn-sm btn-warning"><i class="fa fa-calendar-times-o"></i></a>';

						}
						else
						{

						#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
						//if (!empty($value['ProgramacionClase']['WF_ESTADO_ID']))
						//{ 
							if (!empty($value['ProgramacionClase']['FECHA_CLASE']))
							{
								
								$dif=round((strtotime(date('Y-m-d H:i:s')) - strtotime($value['ProgramacionClase']['HORA_INICIO']))/3600,2);
								#echo $dif;
							if ($dif<48)
							{ # Boton permite registrar editar clase

							if ($value['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] == 3 or $value['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] == 1) 
							{ 
						
									$a = strtotime('-15 min', strtotime($value['ProgramacionClase']['HORA_INICIO']));
									$b = date('d-m-Y H:i:s', $a);
									$c = strtotime($FechaActual);
									$d = date('d-m-Y H:i:s',$c);
									$e = time();
									$f = strtotime('d-m-Y H:i:s', $e);		
										
																
									if ($a < $c){

										if ($dif<24)
										{

										echo '<a href="#" class="btn btn-sm btn-success boton-editar" data="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"><i class="fa fa-plus"></i></a>';
										}
										else 
										{

										echo '<a href="#" class="btn btn-sm btn-info boton-editar" data="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"><i class="fa fa-edit"></i></a>';
										
										}

									}

										else{ 
											$horainicio = strtotime($value['ProgramacionClase']['HORA_INICIO']);
											$f = strtotime('-15 min', strtotime($value['ProgramacionClase']['HORA_INICIO']));
											$format_hora_inicio = date('H:i', $horainicio);
											$format_dia_inicio	= date('d-m-Y', $horainicio);

											?>
											<a href="#" class="btn btn-sm btn-danger" onclick="swal('Clase puede ser iniciada solo 15 minutos antes de Hora programada (<?php echo $format_hora_inicio; ?> del <?php echo $format_dia_inicio; ?>)')" data=""><i class="fa fa-hourglass-half"></i></a>
									<?php	}

								} else { ?> 

								<a href="#" class="btn btn-sm btn-info boton-editar " data="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"><i class="fa fa-edit"></i></a>

								<?php
								}}  
								else { # Boton no permite registrar editar clase DEPUES DE 48 HORAS

									if ($value['ProgramacionClase']['ESTADO_PROGRAMACION_ID'] == 1) { ?> <!-- REVISA SI LA CLASE FUE INICIADA Y FINALIZADA -->

									<a href="#" onclick="alert('Clase Finalizada, Ya Realizada')" class="btn btn-sm btn-success"><i class="fa fa-check"></i></a>

									<?php } else { ?> <!-- MUESTRA BOTON QUE INDICA CLASE FUERA DE TIEMPO BLOQUEADA -->

									<a href="#" onclick="swal('Clase no Registrada, Fuera de tiempo')" class="btn btn-sm btn-danger"><i class="fa fa-ban" aria-hidden="true"></i></a>

							<?php }}
							}
							else
							{ 
				
						# ***********************************************
						# ID - DO001
						# Luis Adan Castillo 11-07-2017
						# Se cambia para que se bloquee el icono cuando la fecha es mayo a la actual
						
						/*  #Valores que Existian antes
						$datetime1 = new DateTime(date('Y-m-d'));
						$datetime2 = new DateTime(date('Y-m-d',strtotime($value['ProgramacionClase']['FECHA_CLASE'])));
						$interval = $datetime1->diff($datetime2);
						*/
						$Difer=round((strtotime($FechaActual) - strtotime($value['ProgramacionClase']['FECHA_CLASE']))/3600,2);
							$disabled = 'disabled';
							if ($Difer<0) {
								# Aquí es tiempo futuro, no se permite dar clase.
								#echo '<a href="#" class="btn btn-sm btn-success boton-editar disabled"><i class="fa fa-calendar-times-o"></i></a>';
								echo '<a href="#" id="M001" class="btn btn-sm btn-warning"><i class="fa fa-clock-o"></i></a>';
							}
							
							else
							{
								if  ($value['ProgramacionClase']['ESTADO_PROGRAMACION_ID']=='2')
								{
									#echo '<a href="#" class="btn btn-sm btn-success boton-editar disabled"><i class="fa fa-calendar-times-o"></i></a>';
									echo '<a href="#" id="M002" class="btn btn-sm btn-warning"><i class="fa fa-exclamation-triangle"></i></a>';
								}
								else
								{

							#José Luis Morandé 8/3/2017 DO009
							//date_default_timezone_set("UTC"); 
							$a = strtotime('-15 min', strtotime($value['ProgramacionClase']['HORA_INICIO']));
							$b = date('d-m-Y H:i:s', $a);
							$c = strtotime($FechaActual);
							$d = date('d-m-Y H:i:s',$c);
							$e = time();
							$f = strtotime('d-m-Y H:i:s', $e);
							//echo "Fecha Inicio - 15 min - ".$b;
							//echo "Fecha Actual del servidor - ".$d;
							//echo $b;
							//echo $d;
							
														
							if ($a < $c){

								echo '<a href="#" class="btn btn-sm btn-success boton-editar" data="'.$value['ProgramacionClase']['COD_PROGRAMACION'].'"><i class="fa fa-plus"></i></a>';
								}
								else{
									echo '<a href="#" class="btn btn-sm btn-danger" id="M009" data=""><i class="fa fa-hourglass-half"></i></a>';
								}
								}
							}
						} }
						?>
					</td>

				</tr>
	<?php 
		$horainicio = strtotime($value['ProgramacionClase']['HORA_INICIO']);
		$f = strtotime('-15 min', strtotime($value['ProgramacionClase']['HORA_INICIO']));
		$format_hora_inicio = date('H:i', $horainicio);
		$format_dia_inicio	= date('d-m-Y', $horainicio);
		$t = $f - time();
		$y = date('H:i',$t);
	 ?>
	<?php endforeach; ?>
			<script>
			// DO009 15 MINUTOS ANTES DE CLASES
			 var horaini = "<?php echo $format_hora_inicio ?>"
			 var diaini = "<?php echo $format_dia_inicio ?>"
			$('#M009').on('click', function(event){
				event.preventDefault();
				notifyUser('Recuerda que la hora de inicio es '+horaini+' el dia '+diaini+'.El botón estará activo 15 minutos antes de esa Hora');
			});
			</script>

			<script>
			// DO008 SUB-ESTADO : AUTORIZACION PENDIENTE
			$('#M008').on('click', function(event){
			event.preventDefault();
			notifyUser('Clase con Autorización Pendiente');
			});

			// DO001 FECHA FUTURA
			$('#M001').on('click', function(event){
						event.preventDefault();
						notifyUser('No es posible iniciar la clase en la fecha actual');
					});

			// DO002 ESTADO NO REALIZDA
			$('#M002').on('click', function(event){
						event.preventDefault();
						notifyUser('Clase en estado NO REALIZADA No es posible iniciar clase');
					});

			</script>
		</tbody>
	</table>
	<script>
		var img_cargando = loadImage('<?php echo ($this->Html->image('loading.gif')); ?>');
		$('.boton-editar').on('click', function(event) {
			event.preventDefault();
			elemento_click = $(this);
			img_cargando.style="width:150px;";
			$('#content-listado-programacion-clases').empty().html('<div align="center"></div>');
			$('#content-listado-programacion-clases div').html(img_cargando);
			$('#div-asistencia').empty();
			$.ajax({
				url: '<?php echo $this->Html->url(array('action'=>'listadoAsistenciaAlumnos',$asignatura_horario['AsignaturaHorario']['COD_ASIGNATURA_HORARIO'])); ?>'+'/'+elemento_click.attr('data'),
				type: 'POST',
				dataType: 'html',
			})
			.fail(function() {
				$('#content-listado-programacion-clases').empty();
				notifyUser('Ha ocurrido un error inesperado. Intente más tarde.','danger');
			})
			.always(function(view) {
				$('#content-listado-programacion-clases').html(view);
			});
		});
		
	</script>
<?php else: ?>	
	<h4 >* No hay información para el rango de fecha seleccionado.</h4>
<?php endif ?>