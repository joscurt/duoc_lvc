<style>
	#table_horario_docente_calendario th{
		text-align: center;
		border:1px solid #ddd !important;
	}
	#table_horario_docente_calendario td{
		border:1px solid #ddd !important;
	}
	#table_horario_docente_calendario .td-valor,#table_horario_docente_calendario .th-dias{
		width: 100px;
	}
	#table_horario_docente_calendario .td-valor:last-child{
		padding: 0;
	}
	#table_horario_docente_calendario .td-valor{
		text-align: center;
	}
	#table_horario_docente_calendario .td-titulo,#table_horario_docente_calendario .th-titulo{
		width: 80px !important;
		padding-left:5px !important; 
	}
	#table_horario_docente_calendario .td-titulo{
		text-align: center;
	}
	i[icono-info]{
		color: #2980b9;
	}
	a[font-size-small]{
		font-size: 10px;
		font-weight: bold;
	}
	.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td{
		padding: 5px !important;
	}
	.leyenda{
		vertical-align: top;
		width: 20px !important;
		height: 20px;
		display: inline-block;
		text-align: center;
	}
	.texto_leyenda{
		display: inline-block;
		vertical-align: top;
		font-weight: bold;
		color:#000;
	}
	.table > thead > tr > th:first-child, .table > tbody > tr > th:first-child, .table > tfoot > tr > th:first-child, .table > thead > tr > td:first-child, .table > tbody > tr > td:first-child, .table > tfoot > tr > td:first-child{
		padding-left: 8px !important;
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
		margin-left: 3.8%;
		border-left: 1px solid #dedede;
	}
	.mes-calendario td:hover{
		background-color:#f1f1f1;
	}
	.mes-calendario .td-active:hover{
		background-color:#26A65B;
		cursor: pointer;
	}
	.mes-calendario .td-ocurrido:hover{
		background-color:#ccc;
		cursor: pointer;
	}
	.mes-calendario .x-ocurrir:hover{
		background-color:#ccc;
		cursor: pointer;
	}
	#table-eventos td{
		padding:3px !important;
		vertical-align: middle;
	}
	.error{
		color:red;
	}
	.btn-verde{
		background: #1abc9c !important;
		color: #fff !important;
	}
	.btn-rojo{
		background: #c0392b !important;
		color: #fff !important;
	}
	.li_detalle_hora{
		border: 1px solid #ddd;
	    padding: 5px;
	    background: #f1f1f1;
	    margin-right: 5px;
	    margin-bottom: 3px;
	}
	ul.ul_horas li{
		display: inline-block !important;
	}
	.proxima_fecha{
		height: 70px;
		width: 100px;
		border-top-left-radius: 5px;
		border-top-right-radius: 5px;
		background: #EEEEEE;
		position: relative;
	}
	.fecha{
		font-size: 2em;
		font-weight: bold;
		color:#000;
		display: block;
		text-align: center;
	}
	.mes{
		position: absolute;
		bottom: 0;
		left: 0;
		right: 0;
		background: #e74c3c;
		color:#fff;
		height: 20px;
		font-weight: bold;
		font-size: 1.2em;
		text-align: center;
	}
	.adjuntar{
		height: 100px;
		width: 100%;
		border:3px dashed #ccc;
		text-align: center;
	}
	.adjuntar span{
		color:#ccc;
		font-weight: bold;
		font-size: 1.8em;
	}
	.botonera a{
		width: 200px;
		margin-left: 15px;
	}
	.botonera a{
		padding: 6px 7px;
		font-size: 1em;
		vertical-align: middle;
	}
	.botonera a:hover{
		background-color: #34495e;
		color: white !important;
	}
	.botonera a:hover i{
		color: white !important;
	}
	.td-app{
		font-weight: 500 !important;
	}
	table.mes-calendario > tbody > tr > td{
		padding: 2px 5px 2px 5px!important;
		text-align: center !important; 
	}
	.col-md-special{
		display: inline-block;
		vertical-align: top;
		margin-left: 25px;
		margin-top: 10px;
		margin-bottom: 0; 
	}
	.col-md-special:first-child{
		margin-left: 0;
	}
</style>
<br>
<div class="card" >
	<div class="card-padding card-body">
		<?php echo $this->element('header_docente'); ?>
	</div>
</div>
<div class="card">
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-12" style="margin-bottom: 3%;">
				<div class="col-md-3">
					<label for="">Descargar Horario</label><br>
					<select name="" id="" class="selectpicker" multiple="multiple">
						<option value="">SEMANA 1 / 12-03-16 - 21-03-16</option>
						<option value="">SEMANA 2 / 22-03-16 - 25-03-16</option>
						<option value="">SEMANA 3 / 26-03-16 - 31-03-16</option>
					</select>
				</div>
				<div class="col-md-7">
					<a 
						style="margin-top: 3px;"href="#horario_docente" data-target="#horario_docente" data-toggle="modal"
						class="btn btn-default btn-sm"><i style="color:#2980b9;"class="fa fa-search"></i>&nbsp;&nbsp;Visualizar Horario
					</a>
					<a style="margin-top: 3px;" class="btn btn-sm btn-success" href="<?php echo $this->Html->url(array('controller'=>'docentes','action'=>'descargarHorario')); ?>"  ><i class="fa fa-download"></i>&nbsp;Descargar Horario</a>
					<a 
						style="margin-top: 3px;"href="#carga_docente" data-target="#carga_docente" data-toggle="modal"
						class="btn btn-default btn-sm"><i style="color:#2980b9;"class="fa fa-search"></i>&nbsp;&nbsp;Visualizar Carga Docente
					</a>				
				</div>
			</div>	
			<div class="col-md-12"style="margin-bottom: 3%;">
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-graduation-cap"></i>&nbsp;DOCENTE</label>
						<p class="c-black f-500 m-b-20">Ernesto Eduardo Vivanco Tapia</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;RUT</label>
						<p class="c-black f-500 m-b-20">16.098.765-3</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;ESTADO</label> 
						<p class="c-black f-500 m-b-20">Asistencia</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-calendar"></i>&nbsp;CLASE PROGRAMADA</label>
						<p class="c-black f-500 m-b-20">12/03/2016</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-calendar"></i>&nbsp;CLASES REGISTRADAS</label>
						<p class="c-black f-500 m-b-20">10</p>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for=""><i icono-info class="fa fa-info"></i>&nbsp;PROMEDIO ASISTENCIA</label>
						<p class="c-black f-500 m-b-20">95%</p>
					</div>
				</div>
			</div>
		</div>
		<!-- calendario -->
		<div class="row">
			<div class="col-md-3">
				<h5><strong>Resumen Sección</strong></h5>
			</div>
			<div class="col-md-9" >
				<div class="row">
					<div class="col-md-4">
						<h5><strong>Seleccione fecha en calendario</strong></h5>
					</div>
					<div class="col-md-2" align="right">
						<div class="contendor_leyenda">
							<span class="leyenda" style="background: #2574A9;"><i class="fa fa-info" style="color:#fff;"></i></span>
							<span class="texto_leyenda">Evento ya ocurrido</span>
						</div>	
					</div>
					<div class="col-md-4" align="right">
						<div class="contendor_leyenda">
							<span class="leyenda" style="background: #26A65B;"><i class="fa fa-info" style="color:#fff;"></i></span>
							<span class="texto_leyenda">Evento disponibe para ingresar asistencia</span>
						</div>	
					</div>
					<div class="col-md-2" align="right">
						<div class="contendor_leyenda">
							<span class="leyenda" style="background: #EC644B;"><i class="fa fa-info" style="color:#fff;"></i></span>
							<span class="texto_leyenda">Evento por ocurrir</span>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="row m-t-30">
			<div class="col-md-3">
				<table class="table" >
					<thead>
						<tr>
							<th></th>
							<th style="text-align:center;background: #34495e; color:#fff;">Regular</th>
							<th style="text-align:center;background: #34495e; color:#fff;">No Regular</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style=" text-align:center;background: #34495e; color:#fff;">Clases</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">50</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">1</td>
						</tr>
						<tr>
							<td style=" text-align:center;background: #34495e; color:#fff;">Clases Registradas</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">10</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">1</td>
						</tr>
						<tr>
							<td style=" text-align:center;background: #34495e; color:#fff;">Clases Suspendidas</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">1</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">1</td>
						</tr>
						<tr>
							<td style=" text-align:center;background: #34495e; color:#fff;">Avance de Clases</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">20%</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">100%</td>
						</tr>
						<tr>
							<td style="text-align:center; background: #34495e; color:#fff;">Asistencia Promedio</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">80%</td>
							<td style="vertical-align: middle;text-align:center;border: 1px solid #ddd;">64%</td>
						</tr>
					</tbody>
				</table>
				<!-- <div class="col-md-6">
					<span class="leyenda" style="background: #2574A9;"><i class="fa fa-info" style="color:#fff;"></i></span><span class="texto_leyenda">Evento ya ocurrido</span>
					<span class="leyenda" style="background: #26A65B;"><i class="fa fa-info" style="color:#fff;"></i></span><span class="texto_leyenda">Evento disponibe para ingresar asistencia</span>
					<span class="leyenda" style="background: #EC644B;"><i class="fa fa-info" style="color:#fff;"></i></span><span class="texto_leyenda">Evento por ocurrir</span>
				</div> -->
			</div>
			<div class="col-md-9">
				<div class="col-md-2 " style="border-left: 1px solid #ddd;">
					<strong class="titulo_mes">MARZO</strong>
					<br><br>
					<table class="table  mes-calendario">
						<thead>
							<tr>
								<th class="dia-semana">L</th>
								<th class="dia-semana">M</th>
								<th class="dia-semana">M</th>
								<th class="dia-semana">J</th>
								<th class="dia-semana">V</th>
								<th class="dia-semana">S</th>
								<th style="padding: 10px;">D</th>
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
								<td style="color:red;padding: 10px;">6</td>
							</tr>
							<tr>
								<td class="ocurrido">7</td>
								<td>8</td>
								<td class="ocurrido">9</td>
								<td>10</td>
								<td class="ocurrido">11</td>
								<td>12</td>
								<td style="padding: 10px;">14</td>
							</tr>
							<tr>
								<td class="ocurrido">15</td>
								<td>16</td>
								<td class="ocurrido">17</td>
								<td>18</td>
								<td>19</td>
								<td>20</td>
								<td style="color:red;padding: 10px;"class="color:red;">21</td>
							</tr>
							<tr>
								<td>22</td>
								<td>13</td>
								<td class="ocurrido">24</td>
								<td>25</td>
								<td class="ocurrido">26</td>
								<td>27</td>
								<td style="color:red;padding: 10px;">28</td>
							</tr>
							<tr>
								<td style="padding-bottom: 3px !important;">29</td>
								<td style="padding-bottom: 3px !important;" class="ocurrido">30</td>
								<td style="padding-bottom: 3px !important;">31</td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;color:red;padding: 10px;"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-2 col-md-2-calendar" >
					<strong class="titulo_mes">ABRIL</strong>
					<br><br>
					<table class="table mes-calendario">
						<thead>
							<tr>
								<th >L</th>
								<th>M</th>
								<th>M</th>
								<th>J</th>
								<th>V</th>
								<th>S</th>
								<th style="padding: 10px;">D</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>1</td>
								<td class="td-active">2</td>
								<td>3</td>
								<td>4</td>
								<td>5</td>
								<td style="color:red; padding: 10px;">6</td>
							</tr>
							<tr>
								<td class="x-ocurrir">7</td>
								<td>8</td>
								<td>9</td>
								<td class="x-ocurrir">10</td>
								<td>11</td>
								<td>12</td>
								<td style="color:red; padding: 10px;">14</td>
							</tr>
							<tr>
								<td>15</td>
								<td class="x-ocurrir">16</td>
								<td>17</td>
								<td class="x-ocurrir">18</td>
								<td>19</td>
								<td>20</td>
								<td style="color:red; padding: 10px;">21</td>
							</tr>
							<tr>
								<td class="x-ocurrir">22</td>
								<td>13</td>
								<td class="x-ocurrir">24</td>
								<td>25</td>
								<td>26</td>
								<td>27</td>
								<td style="color:red; padding: 10px;">28</td>
							</tr>
							<tr>
								<td style="padding-bottom: 3px !important;" class="x-ocurrir">29</td>
								<td style="padding-bottom: 3px !important;">30</td>
								<td style="padding-bottom: 3px !important;">31</td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important; color:red;padding: 10px;"></td>
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
								<th style="color:red;padding: 10px;">D</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>1</td>
								<td class="x-ocurrir">2</td>
								<td>3</td>
								<td class="x-ocurrir">4</td>
								<td>5</td>
								<td style="color:red; padding: 10px;">6</td>
							</tr>
							<tr>
								<td class="x-ocurrir">7</td>
								<td>8</td>
								<td class="x-ocurrir">9</td>
								<td>10</td>
								<td class="x-ocurrir">11</td>
								<td>12</td>
								<td style="color:red; padding: 10px;">14</td>
							</tr>
							<tr>
								<td class="x-ocurrir">15</td>
								<td>16</td>
								<td class="x-ocurrir">17</td>
								<td>18</td>
								<td class="x-ocurrir">19</td>
								<td>20</td>
								<td style="color:red; padding: 10px;">21</td>
							</tr>
							<tr>
								<td>22</td>
								<td class="x-ocurrir">13</td>
								<td>24</td>
								<td>25</td>
								<td>26</td>
								<td>27</td>
								<td style="color:red;padding: 10px;">28</td>
							</tr>
							<tr>
								<td style="padding-bottom: 3px !important;">29</td>
								<td style="padding-bottom: 3px !important;">30</td>
								<td style="padding-bottom: 3px !important;">31</td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important; color:red;padding: 10px;"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-2 col-md-2-calendar">
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
								<th style="color:red;padding: 10px;">D</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>1</td>
								<td class="x-ocurrir">2</td>
								<td>3</td>
								<td class="x-ocurrir">4</td>
								<td>5</td>
								<td style="color:red; padding: 10px;">6</td>
							</tr>
							<tr>
								<td class="x-ocurrir">7</td>
								<td>8</td>
								<td class="x-ocurrir">9</td>
								<td>10</td>
								<td class="x-ocurrir">11</td>
								<td>12</td>
								<td style="color:red; padding: 10px;">14</td>
							</tr>
							<tr>
								<td class="x-ocurrir">15</td>
								<td>16</td>
								<td class="x-ocurrir">17</td>
								<td>18</td>
								<td class="x-ocurrir">19</td>
								<td>20</td>
								<td style="color:red; padding: 10px;">21</td>
							</tr>
							<tr>
								<td>22</td>
								<td class="x-ocurrir">13</td>
								<td>24</td>
								<td>25</td>
								<td>26</td>
								<td>27</td>
								<td style="color:red;padding: 10px;">28</td>
							</tr>
							<tr>
								<td style="padding-bottom: 3px !important;">29</td>
								<td style="padding-bottom: 3px !important;">30</td>
								<td style="padding-bottom: 3px !important;">31</td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important; color:red;padding: 10px;"></td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-2 col-md-2-calendar" >
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
								<th style="color:red;padding: 10px;">D</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td></td>
								<td>1</td>
								<td class="x-ocurrir">2</td>
								<td>3</td>
								<td class="x-ocurrir">4</td>
								<td>5</td>
								<td style="color:red; padding: 10px;">6</td>
							</tr>
							<tr>
								<td class="x-ocurrir">7</td>
								<td>8</td>
								<td class="x-ocurrir">9</td>
								<td>10</td>
								<td class="x-ocurrir">11</td>
								<td>12</td>
								<td style="color:red; padding: 10px;">14</td>
							</tr>
							<tr>
								<td class="x-ocurrir">15</td>
								<td>16</td>
								<td class="x-ocurrir">17</td>
								<td>18</td>
								<td class="x-ocurrir">19</td>
								<td>20</td>
								<td style="color:red; padding: 10px;">21</td>
							</tr>
							<tr>
								<td>22</td>
								<td class="x-ocurrir">13</td>
								<td>24</td>
								<td>25</td>
								<td>26</td>
								<td>27</td>
								<td style="color:red;padding: 10px;">28</td>
							</tr>
							<tr>
								<td style="padding-bottom: 3px !important;">29</td>
								<td style="padding-bottom: 3px !important;">30</td>
								<td style="padding-bottom: 3px !important;">31</td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important;"></td>
								<td style="padding-bottom: 3px !important; color:red;padding: 10px;"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div><hr>
		<!-- botonera -->
		<div class="row">
			<div class="col-md-12" align="center">
				<div class="col-md-special"><a  font-size-small href="#modal_registro_atraso" data-toggle="modal" data-target="#modal_registro_atraso" 	class="btn btn-default"><i style="color:#F9690E;"class="fa fa-check "></i>&nbsp;Registrar Atraso</a></div>
				<div class="col-md-special"><a  font-size-small href="#modal_atraso" 	data-toggle="modal" data-target="#modal_atraso" 	class="btn btn-default"><i style="color:#446CB3;"class="fa fa-clock-o "></i>&nbsp;Retiro Anticipado</a></div>
				<div class="col-md-special"><a  font-size-small href="#modal_remlazo"data-toggle="modal" data-target="#modal_remlazo" class="btn btn-default"><i style="color:#e74c3c;"class="fa fa-calendar-times-o "></i>&nbsp;Reemplazar Docente</a><br/><br/></div>
				<div class="col-md-special"><a  font-size-small href="#modal_suspender" data-toggle="modal" data-target="#modal_suspender" 	class="btn btn-default"><i style="color:#F9690E;"class="fa fa-times "></i>&nbsp;Suspención Clase</a></div>
				<div class="col-md-special"><a  font-size-small href="#modal_recurso"data-toggle="modal" data-target="#modal_recurso" class="btn btn-default"><i style="color:green;"class="fa fa-edit "></i>&nbsp;Modificar Recurso</a></div>
				<div class="col-md-special"><a  font-size-small href="<?php echo $this->Html->url(array('action'=>'ingresarAsistenciaAlumno')) ?>"class="btn btn-default"><i style="color:green;"class="fa fa-file-text-o "></i>&nbsp;Ingresar Asistencia </a></div>
				<div class="col-md-special"><a  font-size-small target="_blanck"href="<?php echo $this->Html->url(array('action'=>'modificarAsistencia')); ?>" class="btn btn-default"><i style="color:green;"class="fa fa-edit "></i>&nbsp;Modificar Asistencia </a></div>
			</div>
		</div>
		<br><br>
		<!-- Ver Curso -->
		<div class="row">
			<div class="col-md-12">
				<div class="table-responsive">
					<div class="row" style="background: #ddd; color: #34495e; padding: 10px; margin-bottom: 10px;">
						<div class="col-md-12">
							<div class="col-md-3"><label>Clases Regulares Registradas: </label>&nbsp;<strong>10</strong></div>
							<div class="col-md-3"><label>Clases Regulares: </label>&nbsp;<strong>50</strong></div>
							<div class="col-md-3"><label>Clases Regulares Suspendidas: </label>&nbsp;<strong>1</strong></div>
							<div class="col-md-3"><label>Asistencia Promedio: </label>&nbsp;<strong>64%</strong></div>
						</div>
					</div>
					<table class="table table-striped table-bordered">
						<thead>
							<tr>
								<th class="td-app">Nº</th>
								<th class="td-app" style="text-align: left">Rut Alumno</th>
								<th class="td-app" style="text-align: left">Apellido Paterno</th>
								<th class="td-app" style="text-align: left">Apellido Materno</th>
								<th class="td-app" style="text-align: left">Nombres</th>
								<th align="center"class="td-app">Clases Presente</th>
								<th align="center"class="td-app">Clases Ausente</th>
								<th align="center"class="td-app">Asistencia Actual</th>
								<th align="center"class="td-app">Asistencia</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($alumnos as $key => $value): ?>
								<tr>
									<td><?php echo $key +1;?></td>
									<td><?php echo strtoupper($value['rut']); ?></td>
									<td><?php echo strtoupper($value['paterno']); ?></td>
									<td><?php echo strtoupper($value['materno']); ?></td>
									<td>
										<?php if ($key == 0): ?>
											<!-- <a style="cursor: pointer; "class="alumno_active"><?php echo strtoupper($value['nombre']); ?></a> -->
											<?php echo strtoupper($value['nombre']); ?>
										<?php else: ?>	
											<?php echo strtoupper($value['nombre']); ?>
										<?php endif ?>
									</td>
									<td align="center"><?php echo '10'; ?></td>
									<td align="center"><span class="badge" style="background:#34495e !important;"><?php echo '40'; ?></span></td>
									<td align="center" style="color:red;"><?php echo $key == 0 || $key == 3 || $key == 7 ? '75' : '95'; ?>%</td>
									<td align="center" style="color:red;">100%</td>
								</tr>
							<?php endforeach ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding" align="center">
		<a href="<?php echo $this->Html->url(array('action'=>'index')); ?>" class="btn btn-info btn-sm"><i class="fa fa-arrow-left"></i>&nbsp;Volver</a>	
	</div>
</div>
<div class="modal fade" id="modal_atraso" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #ddd;">
				<h4 class="modal-title">Registrar Retiro</h4>
			</div>
			<br><br>
			<div class="modal-body">
				<div class="row">
					<div class="col-sm-12">
	                    <p class="c-black f-500 m-b-20">Hora de Retiro</p>
	                    <div class="input-group form-group">
	                        <span class="input-group-addon"><i class="md md-access-time"></i></span>
	                            <div class="dtp-container dropdown fg-line">
	                            <input type="text" id="hora"class="form-control time-picker" data-toggle="dropdown" placeholder="Formato 24 horas" aria-expanded="false">
	                        </div>
	                    </div>
	                </div>
	                <div class="col-sm-12" id="ul_hidden" style="display: none; margin-bottom: 2%;">
	                    <p styclass="c-black f-500 m-b-20">Minutos de retiro anticipado</p>
	                    <ul class="ul_horas">
	                    	<li class="li_detalle_hora"><strong>Clase 1</strong><br>&nbsp;<span style="color:red;margin-top:10px;">24 minutos Pendientes</span></li>
	                    	<li class="li_detalle_hora"><strong>Clase 2</strong><br>&nbsp;<span style="color:red;margin-top:10px;">44 minutos Pendientes</span></li>
	                    	<li class="li_detalle_hora"><strong>Clase 3</strong><br>&nbsp;<span style="color:red;margin-top:10px;">64 minutos Pendientes</span></li>
	                    	<li class="li_detalle_hora"><strong>Clase 4</strong><br>&nbsp;<span style="color:red;margin-top:10px;">24 minutos Pendientes</span></li>
	                    	<li class="li_detalle_hora"><strong>Clase 5</strong><br>&nbsp;<span style="color:red;margin-top:10px;">44 minutos Pendientes</span></li>
	                    </ul>
	                </div>
					<div class="col-sm-12">
						<div class="form-group">
							<p class="c-black f-500 m-b-20">Ingrese los motivos por los cuales el docente se retira de la clase.</p>
							<br>
							<div class="fg-line">
								<textarea style="height: 130px;"placeholder="ingrese los motivos por el cual se retira de la clase" rows="" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_registro_atraso" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #ddd;">
				<h4 class="modal-title">Regitrar Atraso</h4>
			</div>
			<br><br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="col-sm-12">
                            <p class="c-black f-500 m-b-20">Hora LLegada</p>
                            <div class="input-group form-group">
                                <span class="input-group-addon"><i class="md md-access-time"></i></span>
                                    <div class="dtp-container dropdown fg-line">
                                    <input id="atraso"type="text" class="form-control time-picker" data-toggle="dropdown" placeholder="Formato 24 horas">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12" id="minutos_atraso" style="display: none;">
		                    <p class="c-black f-500 m-b-20">Cantidad de minutos de atraso</p>
		                    <div class="form-group">
		                        <span class="badge" style="background-color: red;">30 minutos</span>
		                    </div>
		                </div>
					</div>
				</div>
			</div>
			<div class="modal-footer"style="border-top-color: #ddd;">
				<button type="submit" class="btn btn-sm btn-warning" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar Atraso</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_suspender" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" style="background: #ddd;">
				<h4 class="modal-title">Suspender Clase</h4>
			</div>
			<br><br>
			<div class="modal-body">
				<div class="form-group">
					<label for="select_suspender">Seleccione el motivo de la suspensión</label>
					<div class="select">
						<select class="form-control selectpicker" data-live-search="true" id="select_suspender">
							<option value="">Seleccione Motivo de Suspensión </option>
							<option value="">MOTIVO DE SUSPENSIÓN 1</option>
							<option value="">MOTIVO DE SUSPENSIÓN 2</option>
							<option value="">MOTIVO DE SUSPENSIÓN 3</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label for="">Observaciones de la Suspensión de la clase</label>
					<div class="fg-line">
						<textarea style="height: 130px;"placeholder="Ingrese los motivos por los cuales desea suspender la clases" rows="" class="form-control"></textarea>
					</div>
				</div>
				<br><br>
				<form action="" enctype="multipart/data">
					<div class="row">
						<div class="col-md-12"id="myDrop" align="center" style="font-weight: bold;">
							<div action="<?php echo $this->Html->url(array('action'=>'add')); ?>" class="dropzone" id="myId" style="border: 2px dashed #34495e;">
								<input type="file"  style="display: none;" id="file-upload-team"  name="data[Files][]" />
							</div>
						</div>
					</div>
				</form>
				<br>
				<br>
				<br>
			</div>
			<div class="modal-footer"style="border-top-color: #ddd;">
				<button type="submit" class="btn btn-sm btn-warning" id="addEvent"><i class="fa fa-save"></i>&nbsp;Suspender Clase</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_remlazo" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<h4 class="modal-title">Remplazo Docente</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="form-group">
					<div class="fg-line">
						<label for="">Seleccione docente a reemplazar</label>
						<div class="select">
							<select class="form-control selectpicker" data-live-search="true" id="seelect_remplazo_docente">
								<option value="">Seleccione docente</option>
								<option value="">ERNESTO VIVANCO</option>
								<option value="">IGNACIO LAMADRID</option>
								<option value="">JUAN CARLOS AYALA</option>
								<option value="">MARCELA BECKER</option>
								<option value="">DAFNE VANJOREK</option>
								<option value="">CAMILO OYAR</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group" id="select_remplazo"style="display: none;">
					<div class="fg-line">
						<label for="">Seleccione motivo de reemplazo</label>
						<div class="select">
							<select class="form-control selectpicker" data-live-search="true" >
								<option value="">Seleccione Tipo</option>
								<option value="">Atraso</option>
								<option value="">Capacitación DUOC</option>
								<option value="">Docente no informa</option>
								<option value="">Licencia Medica</option>
								<option value="">Problema Personal</option>
								<option value="">Retiro anticipado</option>
							</select>
						</div>
					</div>
				</div>
				<div class="form-group" id="observaciones_reemplazo" style="display: none;">
					<label for="">Observaciones de reemplazo</label>
					<div class="fg-line">
						<textarea style="height: 130px;"placeholder="Ingrese sus comentarios" rows="" class="form-control"></textarea>
					</div>
				</div>
				<div class="row" style="display: none;" id="motivo_suspension">
					<div class="col-md-12">
						<label for="">Motivo de Suspención</label>
						<div class="form-group">
							<div class="fg-line">
								<textarea style="height: 80px;"placeholder="Ingrese sus motivos" rows="" class="form-control"></textarea>
							</div>
						</div>
					</div>
				</div>
				<div class="row" id="docente_remplazo" style="display: none;">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Docente</label>
							<div class="fg-line">
								<div class="select">
									<select class="form-control selectpicker" data-live-search="true">
										<option value="">Seleccione Docente</option>
										<?php foreach ($array as $key => $value): ?>
											<option value=""> <?php echo $value['docente']; ?></option>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-xs btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar el reemplazo</button>
				<button type="button" class="btn btn-xs btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_recurso" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" >
				<h4 class="modal-title">Modificar Recurso</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-3">
						<div class="form-group">
							<label for=""><i class="fa fa-calendar"></i>&nbsp;Fecha</label>
							<input type="text" class="form-control date-picker" data-toggle="dropdown" placeholder="Selececcione Nueva Fecha" value="<?php echo date('d-m-Y');?>" aria-expanded="false">	
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for=""><i class="fa fa-clock-o"></i>&nbsp;Hora Desde</label>
							<input type="text" class="form-control time-picker" data-toggle="dropdown" placeholder="Seleccione Hora Inicio" aria-expanded="false"value="<?php echo '10:30' ;?>" >
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<label for=""><i class="fa fa-clock-o"></i>&nbsp;Hora Hasta</label>
							<input type="text" class="form-control time-picker" data-toggle="dropdown" placeholder="Seleccione Hora Fin" aria-expanded="false"value="<?php echo '10:30' ;?>">	
						</div>	
					</div>
					<div class="col-md-3">
						<div class="form-group">
							<a class="btn_horario btn btn-sm btn-default"><i class="fa fa-search"></i>&nbsp;Ver Disponibilidad</a>
						</div>	
					</div>
					<div class="col-md-6 error_docente"style="color:red; display: none;">
						<div class="form-group" id="mensaje_docente">
								<strong>Sin disponibilidad! debe cambiar al docente</strong>
						</div>	
					</div>
					<div class="col-md-6 error_sala"style="color:red; display: none; ">
						<div class="form-group" id="mensaje_sala">
							<strong>Sin disponibilidad! debe cambiar la sala</strong>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group" >
							<label for=""><i class="fa fa-user"></i>&nbsp;Docente:</label>&nbsp;&nbsp;<span id="docente">Felipe Oyarzún</span>&nbsp;&nbsp;&nbsp;&nbsp;
							<a class="btn_cambio_docente btn btn-xs btn-warning"><i class="fa fa-eye"></i>&nbsp;Cambiar Docente</a>
						</div>	
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for=""><i class="fa fa-dot-circle-o"></i>&nbsp;Sala:</label>&nbsp;&nbsp;<span id="numer_sala">SALA 101</span>&nbsp;&nbsp;&nbsp;&nbsp;
							<a class="btn_cambio_sala btn btn-xs btn-warning"><i class="fa fa-building"></i>&nbsp;Cambiar Sala</a>
						</div>	
					</div>
				</div>
				<div class="dashed" style="padding: 10px;border: 2px #ddd dashed;display: none;"id="select_remplazo_">
					<div class="form-group"  >
						<div class="fg-line">
							<label for="">Seleccione docente</label>
							<div class="select">
								<select class="form-control selectpicker" data-live-search="true" >
									<option value="">Seleccione Docente</option>
									<option value="">ERNESTO VIVANCO</option>
									<option value="">JUAN CARLOS AYALA</option>
									<option value="">JOSE OYARZUN</option>
									<option value="">RODRIGO LAVIN</option>
									<option value="">FERNANDO FLORES</option>
									<option value="">FELIPE CARRASCO</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group" id="select_tipo_remplazo" style="display: none;">
						<div class="fg-line">
							<label for="">Seleccione motivo</label>
							<div class="select">
								<select class="form-control selectpicker" data-live-search="true" >
									<option value="">Seleccione Tipo</option>
									<option value="">Atraso</option>
									<option value="">Capacitación DUOC</option>
									<option value="">Docente no informa</option>
									<option value="">Licencia Medica</option>
									<option value="">Problema Personal</option>
									<option value="">Retiro anticipado</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group" id="observaciones_reemplazo_"style="display: none;" >
						<label for="">Observaciones</label>
						<div class="fg-line">
							<textarea style="height: 130px;"placeholder="Ingrese sus comentarios" rows="" class="form-control"></textarea>
						</div>
						<a style="margin-top: 8px;"class="btn btn-xs pull-right btn-success guardar_docente"><i class="fa fa-save"></i>&nbsp;Guardar Cambio Docente</a>
					</div>
				</div>	
				<div class="col-md-12 horario_salas" style="display: none;">
					<div class="form-wizard-basic fw-container">
                        <ul class="tab-nav text-center fw-nav" tabindex="11" style="overflow: hidden; outline: none;">
                            <li class="active"><a href="#tab1" data-toggle="tab" aria-expanded="true">SALA 100</a></li>
                            <li><a href="#tab2" data-toggle="tab"><strong>SALA 001</strong></a></li>
                            <li><a href="#tab3" data-toggle="tab"><strong>SALA 002</strong></a></li>
                            <li><a href="#tab4" data-toggle="tab"><strong>SALA 003</strong></a></li>
                            <li><a href="#tab5" data-toggle="tab"><strong>SALA 004</strong></a></li>
                            <li><a href="#tab6" data-toggle="tab"><strong>SALA 005</strong></a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane fade active in" id="tab1">                                        
								<table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" id="reservar_sala"title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                            <div class="tab-pane fade" id="tab2">
                                <table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                            <div class="tab-pane fade" id="tab3">
								<table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                            <div class="tab-pane fade" id="tab4">
                                <table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                            <div class="tab-pane fade" id="tab5">
                                <table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                            <div class="tab-pane fade" id="tab6">
                                <table class="table table-hover" id="table_disponibilidad_salas">
									<thead>
										<tr>
											<th>HORARIO</th>
											<th>LUNES</th>
											<th>MARTES</th>
											<th>MIERCOLES</th>
											<th>JUEVES</th>
											<th>VIERNES</th>
											<th>SABADO</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>10:00 - 11:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE" class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>12:00 - 13:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>13:10 - 14:00</td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
										<tr>
											<td>15:30 - 16:00</td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="NO DISPONIBLE"class="btn btn-rojo btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-times-circle"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
											<td><a data-rel="tooltip" title="DISPONIBLE"class="btn btn-verde btn-xs">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></td>
										</tr>
									</tbody>
								</table>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success" id="addEvent"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="carga_docente" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h3 style="color:#fff;" class="modal-title">Carga Docente</h3>
			</div>
			<div class="modal-body">
				<form class="addEvent" role="form">
					<div class="row">
						<br><br>
						<div class="col-md-12">
							<div class="form-group">
								<strong for="">Docente: Ernesto Eduardo Vivanco Tapia</strong>
							</div>
						</div>
						<div class="col-md-12">
							<table class="table table-hover table-striped" id="table_horario_docente">
								<thead>
									<tr>
										<th class="td-app">Sede</th>
										<th class="td-app">Nombre Evento</th>
										<th class="td-app">ID Evento</th>
										<th class="td-app">Sigla-Sección</th>
										<th class="td-app">Tipo Evento</th>
										<th class="td-app">Jornada</th>
										<th class="td-app">Cantidad Horas</th>
										<th class="td-app">Fecha Inicio</th>
										<th class="td-app">Fecha Termino</th>
										<th class="td-app">Categoría Programcación</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($alumnos as $key => $value): ?>
										<tr>
											<td>Antonio Varas</td>
											<td>Matemáticas I</td>
											<td>00213</td>
											<td>MAT100001V</td>
											<td>TEO</td>
											<td>VESPERTINA</td>
											<td align="center">3</td>
											<td>10-04-16 9:00</td>
											<td>10-04-16 9:00</td>
											<td align="center">DOCR</td>
										</tr>
									<?php endforeach ?>
								</tbody>
							</table>
						</div>
					</div>
					<input type="hidden" id="getStart" />
					<input type="hidden" id="getEnd" />
				</form>
			</div>
			<div class="modal-footer">
				<a href="<?php echo $this->Html->url(array('controller'=>'Administradores','action'=>'descargarCarga')); ?>" class="btn btn-default btn-sm"><i style="color: green;"class="fa fa-file-excel-o"></i>&nbsp;Descargar Carga Docente</a>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar  Información</button>
			</div>
		</div>
	</div>
</div>
<div class="modal fade" id="horario_docente" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background:#ddd;">
				<h3 class="modal-title" style="color:white">Horario Docente</h3>
			</div>
			<div class="modal-body">
				<form class="addEvent" role="form">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<h4>Docente</h4>
								<p>Ernesto Vivanco</p>
							</div>
						</div>
						<div class="col-md-12">
							<h3>
								Horario 01-03-2016 - 06-03-2016
								<div class="pull-right">
									<a class="btn btn-default btn-sm btn-info btn-control-horario"  href="#back-week"><i class="fa fa-chevron-left f-500"></i>&nbsp;Anterior</a>
									<a class="btn btn-default btn-sm btn-info btn-control-horario" href="#next-week">Siguiente&nbsp;<i class="fa f-500 fa-chevron-right"></i></a>
								</div>
							</h3>
							<br>
							<table class="table table-bordered" id="table_horario_docente_calendario">
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
									<tr>
										<td class="td-titulo">08:00-09:25</td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"><div>CAL101</div><div>Calculo I</div></td>
									</tr>
									<tr>
										<td class="td-titulo">09:30-10:55</td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"><div>CAL101</div><div>Calculo I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
									</tr>
									<tr>
										<td class="td-titulo">11:00-12:25</td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
									</tr>
									<tr>
										<td class="td-titulo">14:00-15:25</td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"><div>CAL101</div><div>Calculo I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
									</tr>
									<tr>
										<td class="td-titulo">11:00-12:25</td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
										<td class="td-valor"><div>MAT100</div><div>Matematicas I</div></td>
										<td class="td-valor"></td>
										<td class="td-valor"></td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Cerrar  Información</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('#atraso').blur(function(event) {
		$('#minutos_atraso').show();
	});
	$('.guardar_docente').click(function(event) {
		$('.dashed').hide();
		$('#mensaje_docente').empty();
		$('#mensaje_docente').html('<strong style="color:green !important">Docente con Disponibilidad</strong>');
		$('#docente').empty();
		$('#docente').html('Ernesto Vivanco');
	});
	$('#reservar_sala').click(function(event) {
		$('.horario_salas').hide();
		$('#mensaje_sala').empty();
		$('#mensaje_sala').html('<strong style="color:green !important">Sala con Disponibilidad</strong>');
		$('#numer_sala').empty();
		$('#numer_sala').html('Sala 100');
	});
	$('.btn_horario').click(function(event) {
		$('.error_docente').show();
		$('.error_sala').show();
	});
	$('.btn_cambio_docente').click(function(event) {
		$('.error_').hide();
		$('#select_remplazo_').show();
	});
	$('.btn_cambio_sala').click(function(event) {
		$('.horario_salas').show();
	});
	$('#select_remplazo_').change(function(event) {
		$('#select_tipo_remplazo').show();
	});
	$('#select_tipo_remplazo').change(function(event) {
		$('#observaciones_reemplazo_').show();
	});
 	if ($('.date-picker')[0]) {
   		$('.date-picker').datetimepicker({
    		format: 'DD/MM/YYYY'
    	});
    }
	$('#hora').blur(function(event) {
		var value = $(this).val();
		if (value != '') {
			$('#ul_hidden').show();
		}
	});
	$(function() {
		//var myDropzone = new Dropzone("div#myId", { url: "<?php echo $this->Html->url(array('controller'=>'Administradores','action'=>'addFiles')) ?>"});
		var myDropzone = new Dropzone('div#myId', {
			url: '<?php echo $this->Html->url(array('action'=>'addFiles')) ?>',
			paramName: "data[Files]",
			maxFilesize: 2,
			uploadMultiple: true,
			parallelUploads: 2,
			acceptedFiles: "image/*",
			autoProcessQueue: true,
		});
	});
	$('#seelect_remplazo_docente').change(function(event) {
		$('#select_remplazo').show();
		$('#observaciones_reemplazo').show();
	});
	$('.time-picker').datetimepicker({
    	    format: 'LT'
    	});
	$('.suspender').change(function(event) {
		$('#motivo_suspension').show('fast');
		$('#docente_remplazo').hide('fast');
	});
	$('.remplazar').change(function(event) {
		$('#motivo_suspension').hide('fast');
		$('#docente_remplazo').show('fast');
	});
	$('.registrar').change(function(event) {
		$('#motivo_suspension').hide('fast');
		$('#docente_remplazo').hide('fast');
	});
</script>
