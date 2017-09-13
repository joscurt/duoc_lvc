<select id="filterSala" name="data[Filter][SALA]" class="form-control selectpicker" data-live-search="true">
	<option value="">Seleccione</option>
	<?php foreach ($dataSalas as $key => $value): ?>
	<option value="<?php echo $value['id']; ?>"><?php echo $value['sala']; ?></option>
	<?php endforeach; ?>
</select>
<script type="text/javascript">$('#filterSala').selectpicker();</script>