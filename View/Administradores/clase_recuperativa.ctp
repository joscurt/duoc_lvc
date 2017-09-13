<style>
	td{
		cursor: pointer;
	}
	.active_td{
		background: green;
		color: #fff !important;
	}
	.sigla{
		padding-left: 10px;
		font-size: 2.2em;
	}
	.hora{
		font-size: 2.2em;
	}
</style>
<br>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-2" style="">
				<h3>SALA</h3><br><br>
				<label class="radio radio-inline m-r-20">
					<input type="radio" value="option1" name="inlineRadioOptions">
					<i class="input-helper"></i>  
					SALA I
				</label><br><br>
				<label class="radio radio-inline m-r-20">
					<input type="radio" value="option1" name="inlineRadioOptions">
					<i class="input-helper"></i>  
					SALA II
				</label><br><br>
				<label class="radio radio-inline m-r-20">
					<input type="radio" value="option1" name="inlineRadioOptions">
					<i class="input-helper"></i>  
					SALA III
				</label>
			</div>
			<div class="col-md-4 disponibilidad" style="display: none;">
				<div class="cont" align="center">
					<i style="color: red;font-size: 1.7em;cursor: pointer;" class="fa fa-arrow-left"></i>
					<h3 style=" display:inline;color:red;margin-right: 20px;margin-left: 20px; ">ABRIL</h3>
					<i style=" color: red;font-size: 1.7em;cursor: pointer;" class="fa fa-arrow-right"></i>
				</div>
				<table class="table" style="margin-top: 12%; ">
					<thead>
						<tr>
							<th style="text-align: center; padding-left: 10px;background: #ddd;border:1px solid #fff;">L</th>
							<th style="text-align: center; background: #ddd;border:1px solid #fff;">M</th>
							<th style="text-align: center; background: #ddd;border:1px solid #fff;">M</th>
							<th style="text-align: center; background: #ddd;border:1px solid #fff;">J</th>
							<th style="text-align: center; background: #ddd;border:1px solid #fff;">V</th>
							<th style="text-align: center; background: #ddd;border:1px solid #fff;">S</th>
							<th style="text-align: center; padding: 10px;background: #ddd;border:1px solid #fff;">D</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td style="text-align: center;padding-left: 10px;"></td>
							<td style="text-align: center;">1</td>
							<td style="text-align: center;">2</td>
							<td style="text-align: center;">3</td>
							<td style="text-align: center;">4</td>
							<td style="text-align: center;">5</td>
							<td style="text-align: center; color:red;padding: 10px;">6</td>
						</tr>
						<tr>
							<td class=""style="text-align: center; padding-left: 10px;">7</td>
							<td style="text-align: center;">8</td>
							<td style="text-align: center;" class="">9</td>
							<td style="text-align: center;">10</td>
							<td style="text-align: center;"class="">11</td>
							<td style="text-align: center;">12</td>
							<td style="text-align: center; padding: 10px; color:red;">14</td>
						</tr>
						<tr>
							<td class=""style="text-align: center; padding-left: 10px;">15</td>
							<td style="text-align: center;">16</td>
							<td style="text-align: center;"class="">17</td>
							<td style="text-align: center;">18</td>
							<td style="text-align: center;">19</td>
							<td style="text-align: center;">20</td>
							<td style="text-align: center; color:red;padding: 10px;"class="color:red;">21</td>
						</tr>
						<tr>
							<td style="text-align: center; padding-left: 10px;">22</td>
							<td style="text-align: center;">13</td>
							<td style="text-align: center;"class="">24</td>
							<td style="text-align: center;">25</td>
							<td style="text-align: center;"class="">26</td>
							<td style="text-align: center;">27</td>
							<td style="text-align: center; color:red;padding: 10px;">28</td>
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
			<div class="col-md-offset-1 col-md-5 fecha" style="display: none;">
				<h3>Lunes 15 de Abril</h3><br>
				<div class="col-sm-12">
					<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;09:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="badge sigla">MAT100</span>					
				</div>
				<div class="col-sm-12">
					<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;10:30</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="badge sigla">MAT100</span>					
				</div>
				<div class="col-sm-12">
					<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;11:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="badge sigla">MAT100</span>					
				</div>
				<div class="col-sm-12">
					<strong class="hora"><i class=" fa fa-clock-o"></i>&nbsp;12:00</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<span class="badge sigla" style="background: green;">MAT100</span><a style="margin-bottom: 16px; margin-left: 10px;"class="btn btn-warning btn-sm"><i  class="fa fa-check"></i></a>		
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$('.radio').change(function(event) {
		$('.disponibilidad').show('fast');
	});
	$('td').each(function(index, el) {
		$(this).click(function(event) {
			$('td').removeClass('active_td');
			$(this).addClass('active_td');
			$('.fecha').show('fast');
		});	
	});
</script>