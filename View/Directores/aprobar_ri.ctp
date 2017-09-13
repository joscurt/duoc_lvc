<style>
	td{
		vertical-align: middle !important;
	}
	#table_horario_docente th{

		border:1px solid #ddd !important;
	}
	#table_horario_docente td{
		border:1px solid #ddd !important;
	}
</style>
<br>
<div class="card">
	<div class="card-header">
		<h2><i class="fa fa-check"></i>&nbsp;Aprobación RI</h2>
		<br><br>
		<div class="row">
			<div class="col-md-10">
				<div class="form-group">
					<label for="">Seleccione Periodo</label><br>
					<select name="" id="" class="selectpicker">
						<option value="">SELECCIONE</option>
						<option value="">PERIODO-01/2016</option>
						<option value="">PERIODO-02/2016</option>
					</select>
				</div>
			</div>
			<div class="col-md-1">
				<a class="btn btn-info btn-sm" href="<?php echo $this->Html->url(array('action'=>'home')) ?>"><i class="fa fa-home"></i>&nbsp;Volver al home</a>
			</div>
		</div>	
	</div>
	<div class="card-body card-padding">
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<table class="table table-striped table-hover table-docente">
				<thead>
					<tr>
						<th style="width: 7%;"class="td-app">Sede</th>
						<th style="width: 7%;"class="td-app">Nombre Asignatura</th>
						<!--<th style="width: 7%;"class="td-app">Correo</th>-->
						<th style="width: 7%;"class="td-app">Tipo Clase</th>
						<th style="width: 7%;"class="td-app">Sigla-Sección</th>
						<th style="width: 7%;"class="td-app">Jornada</th>
						<th style="width: 7%;"class="td-app">Nº Clases Registradas</th>
						<th style="width: 7%;"class="td-app">Asistencia Promedio</th>
						<th style="width: 7%;"class="td-app">Último Registro</th>
						<th style="width: 7%;"class="td-app">Reprobación por Inasistencia</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td >Antonio Varas</td>
						<td>Nivelación Matemáticas</td>
						<!--<td>evivanco@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge" style="background:#336E7B;">TEO</span></td>
						<td>MAT100-009</td>
						<td style="text-align: center;"><span class="badge"style=" background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">8</td>
						<td style="text-align: center;"><span style="color:red;">97%</span></td>
						<td style="text-align: center;">29-03-16</td>
						<td align="center">
							<a 
								data-rel="tooltip" 
								title="Reprobar por Inasistencia" 
								href="<?php echo $this->Html->url(array('action'=>'ri')); ?>" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a>
						</td>
					</tr>
					<tr>
						<td>San Joaquin</td>
						<td>Comunicación Escrita</td>
						<!--<td>jcayala@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge"style="background:#336E7B;">TEO</span></td>
						<td>PLC010-003</td>
						<td style="text-align: center;"><span class="badge"style="background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">15</td>
						<td style="text-align: center;"><span style="color:red;">60%</span></td>
						<td style="text-align: center;">28-03-16</td>
						<td align="center">
							<a 
								data-rel="tooltip" 
								title="Reprobar por Inasistencia" 
								href="<?php echo $this->Html->url(array('action'=>'ri')); ?>" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a>
						</td>
					</tr>
					<tr>
						<td>Plaza Vespusio</td>
						<td>Operaciones Logísticas</td>
						<!--<td>rlavin@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge"style="background:#336E7B;">TEO</span></td>
						<td>LOA1104-001</td>
						<td style="text-align: center;"><span class="badge"style="background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">4</td>
						<td style="text-align: center;"><span style="color:red;">74%</span></td>
						<td style="text-align: center;">16-03-16</td>
						<td align="center"><a data-rel="tooltip" title="Reprobar por Inasistencia" href="" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a></td>
					</tr>
					<tr>
						<td>Valparaíso</td>
						<td>Preparación del Paciente para Toma de Muestras</td>
						<!--<td>mrodriguez@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#f1c40f;">TEO + PRA</span></td>
						<td>PTS1101-002</td>
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">10</td>
						<td style="text-align: center;"><span style="color:red;">95%</span></td>
						<td style="text-align: center;">21-03-16</td>
						<td align="center"><a data-rel="tooltip" title="Reprobar por Inasistencia" href="" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a></td>
					</tr>
					<tr>
						<td>Valparaíso</td>
						<td>Preparación del Paciente para Toma de Muestras</td>
						<!--<td>rramirez@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#f1c40f;">TEO + PRA</span></td>
						<td>PTS1101-002</td>
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">10</td>
						<td style="text-align: center;"><span style="color:red;">95%</span></td>
						<td style="text-align: center;">21-03-16</td>
						<td align="center"><a data-rel="tooltip" title="Reprobar por Inasistencia" href="" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a></td>
					</tr>
					<tr>
						<td>Valparaíso</td>
						<td>Preparación del Paciente para Toma de Muestras</td>
						<!--<td>aguerrero@profesores.duoc.cl</td>-->
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#f1c40f;">TEO + PRA</span></td>
						<td>PTS1101-002</td>
						<td style="text-align: center;"><span class="badge"style="text-align: center;background:#ABB7B7;">D</span></td>
						<td style="text-align: center;">10</td>
						<td style="text-align: center;"><span style="color:red;">95%</span></td>
						<td style="text-align: center;">21-03-16</td>
						<td align="center"><a data-rel="tooltip" title="Reprobar por Inasistencia" href="" class="btn btn-danger btn-sm"><i class="fa fa-info"></i></a></td>
					</tr>				
				</tbody>
			</table>
		</div>
	</div>
</div>