<style>
	a{
		color: #000;
	}
	.asignatura{
		/*height: 100px;*/
		margin: 10px 10px 10px 25px;
		border: 1px solid #ddd;		
		padding: 8px;
		border-top-left-radius: 10px;
		border-top-right-radius: 10px;
		background: #ecf0f1;
	}
</style>
<br>
<div class="card">
	<div class="card-header">
		<h2 ><i class="fa fa-home"></i>&nbsp;Aprobar Clases no Programadas</h2>
	</div>
	<div class="card-body card-padding">
			<div id="pestana_hoy" class="tab-pane active" role="tabpanel">
				<br>
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<div class="fg-line">
								<label for="">Estado del Evento</label>
								<div class="select">
									<select data-live-search="true" class="form-control selectpicker"  id="select_asignatura">
										<option value="">TODOS</option>
										<option value="">APROBADO</option>
										<option value="">POR APROBAR</option>
										<option value="">RECHAZADO</option>
									</select>
								</div>
							</div>
						</div>
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label class="fg-label">Fecha</label>
							<div class="fg-line">
								<input type="text" class="form-control date-time-picker" value="11-04-2016"  />
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group" align="right">
							<a class=" btn btn-sm btn-success filtrar"><i class="fa fa-filter"></i>&nbsp;Filtrar</a>
						</div>
					</div>
				</div>
				<br><br>
				<div class="row view_asignaturas" style="display:none;">
					<div class="col-md-12">
						<ul style="display: inline-block;list-style: none;margin-left: 0; padding-left: 0;">
							<li style="display: inline-block; margin-left: 0px;"><i style="font-size:1.3em;color:#1abc9c" class="fa fa-circle"></i>&nbsp;Aprobado</li>
							<li style="display: inline-block; margin-left: 20px;" ><i style="font-size:1.3em;color:#f1c40f" class="fa fa-circle"></i>&nbsp;Por Aprobar</li>
							<li style="display: inline-block; margin-left: 20px;" ><i style="font-size:1.3em;color:#e74c3c" class="fa fa-circle"></i>&nbsp;Rechazado</li>
						</ul>
					</div>
					<div class="col-md-offset-7 col-md-5">
						<div class="input-group">
                            <span class="input-group-addon"><i class="md md-search"></i></span>
                            <div class="fg-line">
                                    <input type="text" class="form-control quicksearch" placeholder="digite el evento que desa buscar">
                            </div>
                        </div>
					</div>
					<br>
					<div class="col-md-12 container_asignaturas" >
						<?php foreach ($array as $key => $value): ?>
							<?php 
								if ($key == 1 || $key == 4 ) {
									$color = '#e74c3c';
								}elseif ($key == 0 || $key == 7) {
									$color = '#f1c40f';
								}else{
									$color = '#1abc9c';
								}
							 ?>
							 <a href="<?php echo $this->Html->url(array('action'=>'aprobarClases')); ?>">
								<div class="col-md-2 asignatura">
									<div class="row">
										<div class="col-xs-6">
											<strong style="font-weight: bold;"><?php echo $value['seccion']; ?></strong>
										</div>
										<div class="col-xs-6" align="right">
											<strong style="font-weight: bold;"><?php echo $value['sala']; ?></strong>
										</div>
									</div>
									<div class="row">
										<div class="col-xs-12">
											<span ><?php echo $value['nombre']; ?></span>	
										</div>
									</div>
									<div class="row" style="margin-top: 10px;">
										<div class="col-xs-12">
											<span ><i class="fa fa-calendar"></i>&nbsp;<span style="font-weight: bold;">Fecha y Hora</span>&nbsp;<?php echo $value['fecha_real']; ?> 10:00</span>	
										</div>
									</div>
									<div class="row" >
										<div class="col-xs-12">
											<span ><i class="fa fa-building"></i>&nbsp;<?php echo $value['escuela']; ?></span>	
										</div>
									</div>
									<div class="row" >
										<div class="col-xs-12">
											<span ><i class="fa fa-home"></i>&nbsp;<?php echo $value['carrera']; ?></span>	
										</div>
									</div>
									<div class="row" style="position: relative;bottom: 0;right: 0;left: 0;padding: 0px;">
										<div class="col-xs-10">
											<i style="color:#34495e;"class="fa fa-graduation-cap"></i>&nbsp;<span style="font-weight: bold;"><?php echo $value['docente']; ?></span>
										</div>
										<div class="col-xs-2">
											<i style="font-size:1.3em;color:<?php echo $color; ?>" class="fa fa-circle"></i>
										</div>
									</div>
								</div>
							</a>
						<?php endforeach ?>
					</div>	
				</div>
			</div>
		</div>	
	</div>
</div>
<script>
$('.quicksearch').quicksearch('.container_asignaturas');
$('.filtrar').on('click', function(event) {
	$('.view_asignaturas').show();
});
$('.date-time-picker').datetimepicker({

});
</script>