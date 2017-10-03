<style type="text/css">
	td{
		cursor: pointer;
	}
	.active_td{
		background: #3FC380;
		color: #fff !important;
	}
	.sigla{
		padding-left: 7px;
		font-size: 2em;
		background: #34495e;
		color: #fff;
	}
	.hora{
		font-size: 2em;
	}
</style>
<br>
<div class="card">
	<div class="card-header">
		<h2>Revisi&oacute;n de atrasos</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-sm-3 m-b-25">
				<p class="f-500 m-b-15 c-black">Docente</p>
				<select class="selectpicker " style="display: none;">
					<option>Ernesto Vivanco</option>
					<option>Marcel Becker</option>
					<option >Gerardo Cerda</option>
				</select>				
			</div>
			
			<div class="col-sm-3 m-b-25">
				<p class="f-500 m-b-15 c-black">Carrera</p>
				<select data-live-search="true" class="selectpicker " style="display: none;">
					<option>Analista Programador</option>
					<option>Tecnico en Redes</option>
					<option>Ingenieria en Informatica</option>
					<option>Ingenieria en Redes</option>
				</select>
			</div>
			
			<div class="col-sm-3 m-b-25">
				<p class="f-500 m-b-15 c-black">Sede</p>
				
				<select class="selectpicker" style="display: none;">
					<optgroup label="Picnic">
						<option>Antonio Varas</option>
						<option>Vespusio</option>
						<option>Republica</option>
					</optgroup>
				</select>
			</div>
											
			<div class="col-sm-3 m-b-25">
				<p class="f-500 c-black m-b-15">Asignatura</p>
				
				<select class="selectpicker" style="display: none;">
					<option disabled="disabled">Programaci&oacute;n I</option>
					<option>Programaci&oacute;n II</option>
					<option>Base de datos</option>
					<option disabled="disabled">Redes I</option>
					<option>CCNA</option>
				</select>
			</div>
			<div class="col-sm-12">
				<a class="btn btn-success pull-right filter"><i class="fa fa-filter"></i>&nbsp;Filtrar</a>
			</div>
		</div>
	</div>
</div>
<div class="card hidden_info" style="display: none;">
	<div class="card-padding card-body">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<strong style="font-size: 1.5em;"><i class="fa fa-user"></i>&nbsp;Ernesto Vivanco</strong>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<strong style="font-size: 1.5em;"><i class="fa fa-graduation-cap"></i>&nbsp;Analista Programador</strong>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<strong style="font-size: 1.5em;"><i class="fa fa-building"></i>&nbsp;Antonio Varas</strong>
				</div>
			</div>
			<div class="col-md-3">
				<div class="form-group">
					<strong style="font-size: 1.5em;"><i class="fa fa-file-text"></i>&nbsp;Programaci&oacute;n II</strong>
				</div>
			</div>
			<table class="table table-striped table-hover" style="margin-top: 8%;">
				<thead>
					<tr>
						<th class="td-app">Clase</th>
						<th class="td-app">Hora</th>
						<th class="td-app"></th>
						<th style="width: 20%;"class="td-app">Agregar Recupertaiva</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Clase I</td>
						<td>8:00-9:30</td>
						<td>9:00</td>
						<td>
							<a href="#modal_recuperativa" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i>&nbsp;Agregar Recuperativa</a>
						</td>
					</tr>
					<tr>
						<td>Clase II</td>
						<td>9:00-10:30</td>
						<td>9:00</td>
						<td>
							<a href="#modal_recuperativa" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i>&nbsp;Agregar Recuperativa</a>
						</td>
					</tr>
					<tr>
						<td>Clase III</td>
						<td>9:30-11:30</td>
						<td>9:00</td>
						<td>
							<a href="#modal_recuperativa" data-toggle="modal" class="btn btn-sm btn-warning"><i class="fa fa-cog"></i>&nbsp;Agregar Recuperativa</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modal_recuperativa" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header" style="background: #ddd;">
				<h3 class="modal-title">Buscar sala para asignar clase recuperativa</h3>
			</div>
			<br><br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12" style="border-radius: 1px solid #ddd;">
						<div class="col-md-12" style="border-bottom: 2px solid #ddd;margin-bottom: 5%;">
							<h4>SALA DISPONIBLES</h4>
						</div>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA I
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA II
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA III
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA 105
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA 303
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA 444
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA 555
						</label>
						<label class="radio radio-inline m-r-20">
							<input type="radio" value="option1" name="inlineRadioOptions">
							<i class="input-helper"></i>  
							SALA 666
						</label>
					</div>
					<div class="col-md-12" style="margin-top: 5%;" align="center">
						<div class="col-md-12" style="border-bottom: 2px solid #ddd;margin-bottom: 5%;">
							<h4 style="float: left;">FECHAS</h4>
						</div>
						<br>
						<br>
						<br>
						<div class="disponibilidad" style="display: none;">
							<div class="cont" align="center" style="margin-bottom: -60px;">
								<i style="color: red;font-size: 1.7em;cursor: pointer;" class="fa fa-arrow-left"></i>
								<h3 style=" display:inline;color:red;margin-right: 20px;margin-left: 20px; ">ABRIL</h3>
								<i style=" color: red;font-size: 1.7em;cursor: pointer;" class="fa fa-arrow-right"></i>
							</div>
							<table class="table " style="margin-top: 12%; ">
								<thead>
									<tr>
										<th style="padding-left: 10px !important;" class="td-app">L</th>
										<th class="td-app">M</th>
										<th class="td-app">M</th>
										<th class="td-app">J</th>
										<th class="td-app">V</th>
										<th class="td-app">S</th>
										<th style="padding-right: 10px !important;"class="td-app ">D</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td class="td_click"style="text-align: center;padding-left: 10px;"></td>
										<td class="td_click"style="text-align: center;">1</td>
										<td class="td_click"style="text-align: center;">2</td>
										<td class="td_click"style="text-align: center;">3</td>
										<td class="td_click"style="text-align: center;">4</td>
										<td class="td_click"style="text-align: center;">5</td>
										<td class="td_click"style="text-align: center; color:red;padding: 10px;">6</td>
									</tr>
									<tr>
										<td class="td_click"style="text-align: center; padding-left: 10px;">7</td>
										<td class="td_click"style="text-align: center;">8</td>
										<td class="td_click"style="text-align: center;" >9</td>
										<td class="td_click"style="text-align: center;">10</td>
										<td class="td_click"style="text-align: center;">11</td>
										<td class="td_click"style="text-align: center;">12</td>
										<td class="td_click"style="text-align: center; padding: 10px; color:red;">14</td>
									</tr>
									<tr>
										<td class="td_click" style="text-align: center; padding-left: 10px;">15</td>
										<td class="td_click" style="text-align: center;">16</td>
										<td class="td_click" style="text-align: center;">17</td>
										<td class="td_click" style="text-align: center;">18</td>
										<td class="td_click" style="text-align: center;">19</td>
										<td class="td_click" style="text-align: center;">20</td>
										<td class="td_click" style="text-align: center; color:red;padding: 10px;">21</td>
									</tr>
									<tr>
										<td class="td_click" style="text-align: center; padding-left: 10px;">22</td>
										<td class="td_click" style="text-align: center;">13</td>
										<td class="td_click" style="text-align: center;">24</td>
										<td class="td_click" style="text-align: center;">25</td>
										<td class="td_click" style="text-align: center;">26</td>
										<td class="td_click" style="text-align: center;">27</td>
										<td class="td_click" style="text-align: center; color:red;padding: 10px;">28</td>
									</tr>
									<tr>
										<td style="text-align: center; padding-left: 10px;">29</td>
										<td style="text-align: center;" class="">30</td>
										<td style="text-align: center;">31</td>
										<td></td>
										<td></td>
										<td></td>
										<td style="text-align: center; color:red;padding: 10px;"></td>
									</tr>
								</tbody>
							</table>
						</div>	
					</div>
				</div>
				<div class="row">
					<div class="col-md-12 fecha" style="display: none; margin-top: 5%; max-height: 250px;overflow: auto;" >
						<div class="col-md-12" style="border-bottom: 2px solid #ddd;margin-bottom: 5%;">
							<h4 style="float: left;">15 ABRIL</h4>
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;09:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;10:30</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;11:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;12:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla" style="background: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;13:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;09:30</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;11:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla">MAT100</span>					
						</div>
						<div class="col-sm-4">
							<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;12:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
							<span class="badge sigla" style="background: green;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-plus"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success" data-dismiss="modal"><i class="fa fa-save"></i>&nbsp;Crear Clase</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal">&nbsp;<i class="fa fa-times"></i>&nbsp;Cerrar</button>
			</div>
		</div>
	</div>
</div>
<script>
	$('.filter').click(function(event) {
		$('.hidden_info').show('fast');
	});
	$('.selectpicker').selectpicker();
</script>
<script>
	$('.radio').change(function(event) {
		$('.disponibilidad').show('fast');
	});
	$('.td_click').each(function(index, el) {
		$(this).click(function(event) {
			$('.td_click').removeClass('active_td');
			$(this).addClass('active_td');
			$('.fecha').show('fast');
		});	
	});
</script>