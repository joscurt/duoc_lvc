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
		padding: 10px !important;
		text-align: center;
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
		background-color:#26A65B;;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#2574A9;;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#EC644B;;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 10px !important;
		padding-right: 5px !important;
	}
</style>
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
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-8">
				<table class="table">
					<thead>
						<tr>
							<th></th>
							<th style="background: #34495e; color:#fff; text-align: center;">Nº Clases Realizadas</th>
							<th style="background: #34495e; color:#fff; text-align: center;">Nº Clases Programadas</th>
							<th style="background: #34495e; color:#fff; text-align: center;">% de Avance</th>
							<th style="background: #34495e; color:#fff; text-align: center;">% Asistencia Promedio</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="background: #34495e; color:#fff;">Clases Regulares</td>
							<td style="border: 1px solid #ddd; text-align: center;">10</td>
							<td style="border: 1px solid #ddd; text-align: center;">49</td>
							<td style="border: 1px solid #ddd; text-align: center;">20%</td>
							<td style="border: 1px solid #ddd; text-align: center;">80%</td>
						</tr>
						<tr>
							<td style="background: #34495e; color:#fff;">Clases no Regulares</td>
							<td style="border: 1px solid #ddd; text-align: center;">1</td>
							<td style="border: 1px solid #ddd; text-align: center;">1</td>
							<td style="border: 1px solid #ddd; text-align: center;">100%</td>
							<td style="border: 1px solid #ddd; text-align: center;">64%</td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-4">
				<span class="leyenda" style="background: #95A5A6;"><i class="fa fa-info" style="color:#fff;"></i></span><span class="texto_leyenda">Evento editabes</span>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-header">
		<h2>Selección de clase a registrar</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-2" style="">
				<strong class="titulo_mes">MARZO</strong>
				<br><br>
				<table class="table mes-calendario">
					<thead>
						<tr>
							<th>L</th>
							<th>M</th>
							<th>M</th>
							<th>J</th>
							<th>V</th>
							<th>S</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td>2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td style="color:red;">6</td>
						</tr>
						<tr>
							<td style="background: #95A5A6; color: #fff;">7</td>
							<td>8</td>
							<td style="background: #95A5A6; color: #fff;">9</td>
							<td>10</td>
							<td style="background: #95A5A6; color: #fff;">11</td>
							<td>12</td>
							<td style="color:red;">14</td>
						</tr>
						<tr>
							<td style="background: #95A5A6; color: #fff;">15</td>
							<td>16</td>
							<td style="background: #95A5A6; color: #fff;">17</td>
							<td>18</td>
							<td>19</td>
							<td>20</td>
							<td style="color:red;">21</td>
						</tr>
						<tr>
							<td>22</td>
							<td>13</td>
							<td style="background: #95A5A6; color: #fff;">24</td>
							<td>25</td>
							<td style="background: #95A5A6; color: #fff;">26</td>
							<td>27</td>
							<td style="color:red;">28</td>
						</tr>
						<tr>
							<td>29</td>
							<td style="background: #95A5A6; color: #fff;">30</td>
							<td>31</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-2 col-md-2-calendar" >
				<strong class="titulo_mes">ABRIL</strong>
				<br><br>
				<table class="table  mes-calendario">
					<thead>
						<tr>
							<th >L</th>
							<th>M</th>
							<th>M</th>
							<th>J</th>
							<th>V</th>
							<th>S</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td >2</td>
							<td>3</td>
							<td>4</td>
							<td>5</td>
							<td style="color:red;">6</td>
						</tr>
						<tr>
							<td >7</td>
							<td>8</td>
							<td>9</td>
							<td >10</td>
							<td>11</td>
							<td>12</td>
							<td style="color:red;">14</td>
						</tr>
						<tr>
							<td>15</td>
							<td >16</td>
							<td>17</td>
							<td >18</td>
							<td>19</td>
							<td>20</td>
							<td style="color:red;">21</td>
						</tr>
						<tr>
							<td >22</td>
							<td>13</td>
							<td >24</td>
							<td>25</td>
							<td>26</td>
							<td>27</td>
							<td style="color:red;">28</td>
						</tr>
						<tr>
							<td >29</td>
							<td>30</td>
							<td>31</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class="col-md-2 col-md-2-calendar" >
				<strong class="titulo_mes">MAYO</strong>
				<br><br>
				<table class="table mes-calendario">
					<thead>
						<tr>
							<th>L</th>
							<th>M</th>
							<th>M</th>
							<th>J</th>
							<th>V</th>
							<th>S</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td >2</td>
							<td>3</td>
							<td >4</td>
							<td>5</td>
							<td style="color:red;">6</td>
						</tr>
						<tr>
							<td >7</td>
							<td>8</td>
							<td >9</td>
							<td>10</td>
							<td >11</td>
							<td>12</td>
							<td style="color:red;">14</td>
						</tr>
						<tr>
							<td >15</td>
							<td>16</td>
							<td >17</td>
							<td>18</td>
							<td >19</td>
							<td>20</td>
							<td style="color:red;">21</td>
						</tr>
						<tr>
							<td>22</td>
							<td >13</td>
							<td>24</td>
							<td>25</td>
							<td>26</td>
							<td>27</td>
							<td style="color:red;">28</td>
						</tr>
						<tr>
							<td>29</td>
							<td>30</td>
							<td>31</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-md-2 col-md-2-calendar">
				<strong class="titulo_mes">JUNIO</strong>
				<br><br>
				<table class="table mes-calendario">
					<thead>
						<tr>
							<th>L</th>
							<th>M</th>
							<th>M</th>
							<th>J</th>
							<th>V</th>
							<th>S</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td >2</td>
							<td>3</td>
							<td >4</td>
							<td>5</td>
							<td style="color:red;">6</td>
						</tr>
						<tr>
							<td >7</td>
							<td>8</td>
							<td >9</td>
							<td>10</td>
							<td >11</td>
							<td>12</td>
							<td style="color:red;">14</td>
						</tr>
						<tr>
							<td >15</td>
							<td>16</td>
							<td >17</td>
							<td>18</td>
							<td >19</td>
							<td>20</td>
							<td style="color:red;">21</td>
						</tr>
						<tr>
							<td>22</td>
							<td >13</td>
							<td>24</td>
							<td>25</td>
							<td>26</td>
							<td>27</td>
							<td style="color:red;">28</td>
						</tr>
						<tr>
							<td>29</td>
							<td>30</td>
							<td>31</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>
			<div class=" col-md-2 col-md-2-calendar">
				<strong class="titulo_mes">JULIO</strong>
				<br><br>
				<table class="table mes-calendario">
					<thead>
						<tr>
							<th>L</th>
							<th>M</th>
							<th>M</th>
							<th>J</th>
							<th>V</th>
							<th>S</th>
							<th>D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td></td>
							<td>1</td>
							<td >2</td>
							<td>3</td>
							<td >4</td>
							<td>5</td>
							<td style="color:red;">6</td>
						</tr>
						<tr>
							<td >7</td>
							<td>8</td>
							<td >9</td>
							<td>10</td>
							<td >11</td>
							<td>12</td>
							<td style="color:red;">14</td>
						</tr>
						<tr>
							<td >15</td>
							<td>16</td>
							<td >17</td>
							<td>18</td>
							<td >19</td>
							<td>20</td>
							<td style="color:red;">21</td>
						</tr>
						<tr>
							<td>22</td>
							<td >13</td>
							<td>24</td>
							<td>25</td>
							<td>26</td>
							<td>27</td>
							<td style="color:red;">28</td>
						</tr>
						<tr>
							<td>29</td>
							<td>30</td>
							<td>31</td>
							<td></td>
							<td></td>
							<td></td>
							<td></td>
						</tr>
					</tbody>
				</table>
			</div>

		</div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<table class="table table-hover table-striped">
			<thead>
				<tr>
					<th style="background: #34495e; color:#fff;">Evento</th>
					<th style="background: #34495e; color:#fff;">Horario</th>
					<th style="background: #34495e; color:#fff;">Sala</th>
					<th style="background: #34495e; color:#fff;">Tipo de Clase</th>
					<th style="background: #34495e; color:#fff;">Registro de Clase</th>
					<th style="background: #34495e; color:#fff;">Fecha de Clase</th>
					<th style="background: #34495e; color:#fff;">Fecha de Registro</th>
					<th style="background: #34495e; color:#fff;">Registro</th>
				</tr>
			</thead>
			<tbody>
				<tr>
					<td>MAT100-009(T) - Nivelación Matemática</td>
					<td>8:31 - 10:00</td>
					<td>AO-311</td>
					<td>TEO</td>
					<td>Regular</td>
					<td>01-04-16</td>
					<td>01-04-16</td>
					<td><button id="boton-editar" class="btn btn-sm btn-info"><i class="fa fa-edit"></i></button></td>
				</tr>
			</tbody>
		</table>
	</div>
</div>
<div class="card" id="div-asistencia" style="margin-top: 1%; display:none;">
	<div class="card-header">
		<h2>Editar Asistencia</h2>
		<br>
		<div class="row">
			<div class="col-md-3">
				<label for="">Alumnos Presente</label><br>
				<label class="checkbox checkbox-inline m-r-20"><input disabled type="checkbox" checked="checked" value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label>		
			</div>
			<div class="col-md-3">
			<label for="">Alumnos Ausente</label><br>
				<label class="checkbox checkbox-inline m-r-20"><input disabled type="checkbox"  value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label>
			</div>
		</div>
		
	</div>
	<div class="card-body card-padding">
		<div class="table-responsive" style="overflow: hidden;" tabindex="1">
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th class="td-app"><strong>Rut</strong></th>
						<th class="td-app"><strong>Apellido Paterno</strong></th>
						<th class="td-app"><strong>Apellido Materno</strong></th>
						<th class="td-app"><strong>Nombres</strong></th>
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
							<td><label class="checkbox checkbox-inline m-r-20"><input type="checkbox" <?php echo $key == 0 || $key == 3 ? '' : 'checked';  ?> value="" name="data[Alumno][uuid]"><i class="input-helper"></i></label></td>
							<td><?php echo strtoupper($alumno['carrera']); ?></td>
							<td>
								<div class="fg-line">
									<input type="text" class="form-control" <?php echo $key == 0 || $key == 3 ? 'value="Alumno recupera con trabajo" ' : '';  ?> >
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
		<a  style="margin-right: 10px;" class="volver btn btn-sm btn-info"><i class="fa fa-arrow-left"></i>&nbsp;Salir sin guardar</a>
		<a  class=" btn btn-success btn-sm btn-warning "><i class="fa fa-plus"></i>&nbsp;Agregar Bitácora</a>
		<a 	style="margin-left: 10px;"class=" btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar Asistencia</a>
	</div>
</div>
<script>
	$(function() {
		$('.volver').click(function(event) {
			var href = '<?php echo $this->Html->url(array('action'=>'verClase	')); ?>';
			if (confirm('Se dispone a salir de la pagina sin guardar la asistencia.')) {
				$(this).attr('href',href);
			}
		});
		$('#boton-editar').click(function(event) {
			$('#div-asistencia').show();
			/* Act on the event */
		});
	});
</script>