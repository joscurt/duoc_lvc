<style>
	#justificacion tr th, #justificacion tr td {
		text-align: left !important;
	}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
            <h1>Recuperar Clases</h1>
        </div>
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Información Docente:</h2>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Rut</th>
							<th>Apellido Paterno</th>
							<th>Apellido Materno</th>
							<th>Nombres</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>12.345.678-9</td>
							<td>Sepúlveda</td>
							<td>Villegas</td>
							<td>Juan Pablo</td>
						</tr>	
					</tbody>
				</table>
				<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Información Clase:</h2>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Nombre asignatura</th>
							<th>Sigla-Sección</th>
							<th>Jornada</th>
							<th>Fecha programada</th>
							<th>Horario</th>
							<th>Sala</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Técnicas de arquitectura de la información</td>
							<td>DID6011-01</td>
							<td>Vespertina</td>
							<td>01-07-2016</td>
							<td>10:01 a 10:46</td>
							<td>208</td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0">
					<thead>
						<tr>
							<th>Módulos</th>
							<th>Módulos programados</th>
							<th>Módulos por recuperar</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd">
							<td>Programada</td>
							<td>4</td>
							<td>4</td>
						</tr>	
					</tbody>
				</table>
				<br>
				<table id="justificacion" class="table table-striped" border="0" cellpadding="0" cellspacing="0" class="one-column">
					<thead>
						<tr>
							<th>Justificación Legal</th>
						</tr>
					</thead>
					<tbody>
						<tr class="odd"><td class="odd"><label>Tipo de Justificación Legal:</label> justificación legal ingresada por el Coordinador Docente.</td></tr>
						<tr class="even"><td class="odd"><label>Observaciones:</label>Descripción ingresada por el Coordinador Docente.</td></tr>		
					</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<button class="btn btn-success">Cambiar Sub-Estado</button>
				<a href="<?php echo $this->Html->url(array('action'=>'recuperarClases')) ?>" class="btn btn-success">Salir</a> 
			</div>
		</div>
	</div>
</div>