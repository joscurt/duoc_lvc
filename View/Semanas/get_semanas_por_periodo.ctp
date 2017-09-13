<div class="form-group" >
	<label for="select-semanas">Semana:</label>
	<select id="select-semanas" name="data[Filter][SEMANA]" class="form-control selectpicker" data-live-search="true">
		<option value="">TODAS</option>
		<?php 
		foreach ($semanas as $key => $value):  
			extract( $value['Semana'] );
			echo '<option value="'.$ID.'">SEMANA '.$NUMERO_SEMANA.': '.date('d-m-Y',strtotime($FECHA_INICIO)).'&nbsp;&nbsp;|&nbsp;&nbsp;'.date('d-m-Y',strtotime($FECHA_FIN)).'</option>';
		endforeach 
		?>
	</select>
</div>	
<script type="text/javascript">$('#select-semanas').selectpicker();</script>