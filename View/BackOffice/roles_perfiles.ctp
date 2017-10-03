<style>
	table.admin { text-align: left;}
	table.admin td {border: 1px solid #ccc; text-align: left;}
	table.admin td.first {text-align: left;}
	table.admin i.fa {font-size: 1.3em; margin: 0 2px;}
	.infografia {font-size: 1.4em; overflow: hidden; padding-bottom: 20px;}
	.infografia .inside {width: 310px; margin: 0 auto!important;}
	.infografia .dato {float: left; width: 33.333%;}

	table.admin i.fa-plus-square, .infografia i.fa-plus-square {color: #4caf50;}
	table.admin i.fa-pencil-square, .infografia i.fa-pencil-square {color: #00bcd4;}
	table.admin i.fa-eye, .infografia i.fa-eye {color: #f8b31c;}
	table.admin tr.tr-head {background: #003964; color: #FFF; text-transform: uppercase; text-align: left;}
	table.admin tr.tr-head:hover {background: #003964;}
	table.admin tr.tr-head td {border-color: #003964;}
	table.admin thead {border: 1px solid #34495e }
	table.admin thead th {width: 8.888%;}
	table.admin thead th.first {width: 20%;}
</style>
<div class="row">
	<div class="col-md-12">
		<div class="block-header">
			<h1>Roles y Perfiles</h1>
		</div>  
	</div>
</div>
<div class="card">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label for="" style="margin-bottom: 8px !important;">Seleccionar una vista:</label>
					<select id="select-vista" name="" id="filtro" class="form-control selectpicker" data-live-search="true">
						<option value="" selected>Seleccionar</option>
						<option value="roles">Roles</option>
						<option value="vistas">Vistas</option>
						<option value="perfil">Perfil</option>
						<option value="administracion">Administraci&oacute;n</option>
						<option value="funcionalidad">Funcionalidad</option>
						<option value="asignar_permisos">Asignar Permisos</option>
					</select>
				</div>  
			</div>
		</div>
	</div>	
</div>
<div class="card" id="roles" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Roles</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Roles</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
					  	<tr class="odd">
						    <td>1</td>
						    <td>Administrador Central</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
						    <td>2</td>
						    <td>Mesa Ayuda</td>
							<td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>3</td>
						    <td>DPT</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>4</td>
						    <td>Docente</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>5</td>
						    <td>Coordinador Docente</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>6</td>
						    <td>Asistente Docente</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>7</td>
						    <td>Director Carrera</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>8</td>
						    <td>Coordinador Programa</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>9</td>
						    <td>Administrativo</td>
						    <td><a class="btn btn-info" href="" data-toggle="modal" data-target="#modal_editar_rol" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" href="" data-toggle="modal" data-target="#modal_eliminar_rol" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_rol"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_rol" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: "Nombre del Rol"</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control" placeholder="Nombre del Rol">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_rol">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar <strong>Nombre del Rol?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_rol" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de Rol</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>

<div class="card" id="vistas" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Vistas</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Vistas</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
					  	<tr class="odd">
						    <td>1</td>
						    <td>Nombre de la Vista</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_vista" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_vista" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
						    <td>2</td>
						    <td>Nombre de la Vista</td>
							<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_vista" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_vista" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>3</td>
						    <td>Nombre de la Vista</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_vista" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_vista" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>4</td>
						    <td>Nombre de la Vista</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_vista" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_vista" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>5</td>
						    <td>Nombre de la Vista</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_vista" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_vista" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_vista"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_vista" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: "Nombre de la Vista"</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control" placeholder="Nombre de la Vista">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_vista">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar <strong>Nombre de la Vista?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_vista" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de Vista</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>

<div class="card" id="perfil" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Perfiles</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Vistas</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
					  	<tr class="odd">
						    <td>1</td>
						    <td>Nombre del Perfil</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_perfil" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_perfil" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
						    <td>2</td>
						    <td>Nombre del Perfil</td>
							<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_perfil" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_perfil" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>3</td>
						    <td>Nombre del Perfil</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_perfil" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_perfil" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
						    <td>4</td>
						    <td>Nombre del Perfil</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_perfil" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_perfil" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
						    <td>5</td>
						    <td>Nombre del Perfil</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_perfil" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
						    <td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_perfil" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_perfil"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_perfil" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando: "Nombre del perfil"</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control" placeholder="Nombre de la perfil">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_perfil">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar <strong>Nombre del perfil?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_perfil" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de perfil</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="">Nombre:</label>
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>

<div class="card" id="administracion" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Administraci&oacute;n</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<div class="infografia">
					<div class="inside">
					<div class="dato dato-1"><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i> = Crear</div>
					<div class="dato dato-1"><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i> = Editar</div>
					<div class="dato dato-1"><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i> = Lectura</div>
					</div>
				</div>
			</div>
			<div class="col-md-12">
				<table border="0" cellpadding="0" cellspacing="0" class="admin table table-striped">
					<thead>
					  	<tr>
						    <th class="first"></th>
						    <th>Administrador Central</th>
						    <th>Mesa Ayuda</th>
						    <th>DPT</th>
						    <th>DPT</th>
						    <th>Coordinador Docente</th>
						    <th>Asistente Docente</th>
						    <th>Director de Carrera</th>
						    <th>Coordinador de Programa</th>
						    <th>Administrativo</th>
					  	</tr>
					</thead>
					<tbody>
					  	<tr class="tr-head">
					    	<td colspan="10">Docentes</td>
					  	</tr>
					  	<tr class="odd">
						    <td class="first">Registrar Asistencia</td>
						    <td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						    <td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
						    <td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
					  	</tr>
					  	<tr class="even">
				    		<td class="first">Editar Registro Asistencia</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Hist&oacute;rico Asistencia</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Bit&aacute;cora Evento</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Reprobados por Inasistencia</td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="tr-head">
				    		<td colspan="10">Coordinador docente</td>
						</tr>
						<tr class="odd">
				    		<td class="first">Gesti&oacute;n de Clases</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Disponibilidad Sala</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Horario y Carga Docente</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Asistencia Docente</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Solicitud de Recuperaci&oacute;n</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="tr-head">
				    		<td colspan="10">Director de Carrera</td>
						</tr>
						<tr class="odd">
				    		<td class="first">Tasa de Asistencia y RI del Alumno</td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Cumplimiento de registro de Asistencia Docente</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Dashboard  de Gesti&oacute;n</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="tr-head">
				    		<td colspan="10">Reportes</td>
						</tr>
						<tr class="odd">
				    		<td class="first">Nomina diaria de Clases a Recuperar y Adelantar.</td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Nomina Diaria de Clases Programadas.</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Reportes peri&oacute;dicos de Clases Programadas (realizadas y no realizadas).</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Reportes peri&oacute;dicos de Clases Adelantadas y Recuperadas (realizadas y no realizadas).</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Reporte de Presencia Docente (en qu&eacute; lugar se encuentra un docente en un horario definido).</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Tasa de Asistencia y RI del Alumno.</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="odd">
				    		<td class="first">Cumplimiento de registro de Asistencia Docente.</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">DashBoard</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="tr-head">
				    		<td colspan="10">BackOffice</td>
						</tr>
						<tr class="odd">
				    		<td class="first">Mantenedores</td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
						</tr>
						<tr class="even">
				    		<td class="first">Roles y Perfiles</td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
				    		<td><i class="fa fa-plus-square" aria-hidden="true" title="Crear"></i><i class="fa fa-pencil-square" aria-hidden="true" title="Editar"></i><i class="fa fa-eye" aria-hidden="true" title="Lectura"></i></td>
					  	</tr>
				 	</tbody> 
				</table>
			</div>
		</div>
	</div>
</div>

<div class="card" id="funcionalidad" style="display: none;">
	<div class="card-header">
		<h2 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Funcionalidad</h2>
	</div>
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>ID</th>
							<th>Vista</th>
							<th>Funcionalidades</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
					  	<tr class="odd">
					    	<td>1</td>
					    	<td>Docente</td>
					    	<td>Registrar Asistencia</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
					    	<td>2</td>
					    	<td>Docente</td>
					    	<td>Editar Registro Asistencia</td>
							<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  <tr class="odd">
					    	<td>3</td>
					    	<td>Docente</td>
					    	<td>Hist&oacute;rico Asistencia</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				  		</tr>
					  	<tr class="even">
					    	<td>4</td>
					    	<td>Docente</td>
					    	<td>Bit&aacute;cora Evento</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				 	 	</tr>
					  	<tr class="odd">
					    	<td>5</td>
					    	<td>Docente</td>
					    	<td>Reprobados por Inasistencia</td>	
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				  		</tr>
				   		<tr class="even">
					    	<td>6</td>
					    	<td>Director de Carrera</td>
					    	<td>Tasa de Asistencia y RI del Alumno</td>
							<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
					    	<td>7</td>
					    	<td>Director de Carrera</td>
					    	<td>Cumplimiento de registro de Asistencia Docente</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="even">
					    	<td>8</td>
					    	<td>Director de Carrera</td>
					    	<td>Dashboard  de Gesti&oacute;n</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_funcionalidad" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_funcionalidad" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_funcionalidad"><i class="fa fa-plus"></i>&nbsp;Agregar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_funcionalidad" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editando Funcionalidad</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="vista">Selecciona Vista:</label>
							<select id="vista" name="vista" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>Docente</option>
								<option>Coordinador Docente</option>
								<option>Director de Carrera</option>
								<option>Backoffice</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="funcionalidad">Ingreso Funcionalidad:</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Registrar Asistencia</option>
								<option>Editar Registro Asistencia</option>
								<option selected>Hist&oacute;rico Asistencia</option>
								<option>Bit&aacute;cora Evento</option>
								<option>Reprobados por Inasistencia</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_funcionalidad">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar esta funcionalidad?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_funcionalidad" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Ingreso de funcionalidad</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label for="vista">Selecciona Vista:</label>
							<select id="vista" name="vista" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Docente</option>
								<option>Coordinador Docente</option>
								<option>Director de Carrera</option>
								<option>Backoffice</option>
							</select>
						</div>
					</div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="funcionalidad">Ingreso Funcionalidad:</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Registrar Asistencia</option>
								<option>Editar Registro Asistencia</option>
								<option>Hist&oacute;rico Asistencia</option>
								<option>Bit&aacute;cora Evento</option>
								<option>Reprobados por Inasistencia</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>

<div class="card" id="filtro_permisos" style="display: none;">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Nombre Usuario</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Nombres</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="" style="margin-bottom: 9px;">Perfil</label>
					<select class="form-control selectpicker" data-live-search="true">
						<option>Seleccionar</option>
						<option>Nombre del perfil</option>
						<option>Nombre del perfil</option>
						<option>Nombre del perfil</option>
					</select>
				</div>	
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="">Rut</label>
					<input type="text" class="form-control">
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<label for="" style="margin-bottom: 9px;">Estado</label>
					<select class="form-control selectpicker" data-live-search="true">
						<option>Seleccionar</option>
						<option>Activo</option>
						<option>Inactivo</option>
					</select>
				</div>
			</div>
			<div class="col-md-2">
				<div class="form-group">
					<button class="btn btn-success" style="margin-top: 27px;">Buscar</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="card" id="asignar_permisos" style="display: none;">
	<div class="card-body card-padding">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
					<thead>
						<tr>
							<th>Nombre de usuario</th>
							<th>Nombre</th>
							<th>Perfil</th>
							<th>Estado</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
				  	<tbody>
					  	<tr class="odd">
						    <td>Nombre de usuario</td>
						    <td>Nombre Apellido Apellido</td>
						    <td>Tipo de perfil</td>
						    <td>Activo</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
						    <td>Nombre de usuario</td>
						    <td>Nombre Apellido Apellido</td>
						    <td>Tipo de perfil</td>
						    <td>Activo</td>
						    <td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
					  	<tr class="odd">
					    	<td>Nombre de usuario</td>
					    	<td>Nombre Apellido Apellido</td>
					    	<td>Tipo de perfil</td>
					    	<td>Inactivo</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
					    	<td>Nombre de usuario</td>
					    	<td>Nombre Apellido Apellido</td>
					    	<td>Tipo de perfil</td>
					    	<td>Activo</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
				  		</tr>
					  	<tr class="odd">
					    	<td>Nombre de usuario</td>
					    	<td>Nombre Apellido Apellido</td>
					    	<td>Tipo de perfil</td>
					    	<td>Activo</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>	
					  	<tr class="even">
					    	<td>Nombre de usuario</td>
					    	<td>Nombre Apellido Apellido</td>
					    	<td>Tipo de perfil</td>
					    	<td>Inactivo</td>
					    	<td><a class="btn btn-info" data-toggle="modal" data-target="#modal_editar_permiso" href="" title="Editar"><i class="fa fa-pencil-square" aria-hidden="true"></i></a></td>
					    	<td><a class="btn btn-danger" data-toggle="modal" data-target="#modal_eliminar_permiso" href="" title="Eliminar"><i class="fa fa-times" aria-hidden="true"></i></a></td>
					  	</tr>
				  	</tbody>
				</table>
			</div>
			<div class="col-md-12">
				<div class="form-group">
					<button class="btn btn-success" data-toggle="modal" data-target="#modal_agregar_usuario"><i class="fa fa-plus"></i>&nbsp;Agregar Nuevo Usuario</button>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_editar_permiso" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Editar: Nombre de Usuario</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Nombre de Usuario</label>
							<input type="text" class="form-control" value="Nombre de usuario">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Nombres</label>
							<input type="text" class="form-control" value="Nombre Apellido Apellido">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Correo Electr&oacute;nico</label>
							<input type="text" class="form-control" value="correo@electronico.cl">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Rut</label>
							<input type="text" class="form-control" value="12.345.678-9">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Perfil</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>Nombre Perfil</option>
								<option>Nombre Perfil</option>
								<option>Nombre Perfil</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Estado</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>Activo</option>
								<option>Inactivo</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Sede</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Escuela</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Carrera</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option selected>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>
<div class="modal" id="modal_eliminar_permiso">
    <div class="modal-dialog ">
        <div class="modal-content">
        	<div class="modal-header">
        		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        	</div>
            <div class="modal-body">
				¿Seguro que desea eliminar al usuario: <strong>Nombre de Usuario</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger">Eliminar</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Salir</button>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="modal_agregar_usuario" >
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header" >
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;" class="modal-title">Agregar Nuevo Usuario</h4>
			</div>
			<br>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Nombre de Usuario</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Nombres</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Correo Electr&oacute;nico</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="vista">Rut</label>
							<input type="text" class="form-control">
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Perfil</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Nombre Perfil</option>
								<option>Nombre Perfil</option>
								<option>Nombre Perfil</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Estado</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Activo</option>
								<option>Inactivo</option>
								<option>Nombre Perfil</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Sede</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
								<option>San Carlos de Apoquindo</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Escuela</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
								<option>Escuela de Dise&ntilde;o</option>
							</select>
						</div>
					</div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="funcionalidad">Carrera</label>
							<select id="funcionalidad" name="funcionalidad" class="form-control selectpicker">
								<option>Seleccionar</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
								<option>T&eacute;cnico en Producci&oacute;n Industrial de Vestuario</option>
							</select>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-sm btn-success"><i class="fa fa-save"></i>&nbsp;Guardar</button>
				<button type="button" class="btn btn-sm btn-default" data-dismiss="modal"><i class="fa fa-times"></i>&nbsp;Salir</button>
			</div>
		</div>
	</div>
</div>

<script>
	$('#select-vista').change(function () {
		if ($(this).val() == "roles") {
			$('#roles').show();
			$('#vistas').hide();
			$('#perfil').hide();
			$('#administracion').hide();
			$('#funcionalidad').hide();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
		if ($(this).val() == "vistas") {
			$('#roles').hide();
			$('#vistas').show();
			$('#perfil').hide();
			$('#administracion').hide();
			$('#funcionalidad').hide();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
		if ($(this).val() == "perfil") {
			$('#roles').hide();
			$('#vistas').hide();
			$('#perfil').show();
			$('#administracion').hide();
			$('#funcionalidad').hide();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
		if ($(this).val() == "administracion") {
			$('#roles').hide();
			$('#vistas').hide();
			$('#perfil').hide();
			$('#administracion').show();
			$('#funcionalidad').hide();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
		if ($(this).val() == "funcionalidad") {
			$('#roles').hide();
			$('#vistas').hide();
			$('#perfil').hide();
			$('#administracion').hide();
			$('#funcionalidad').show();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
		if ($(this).val() == "asignar_permisos") {
			$('#roles').hide();
			$('#vistas').hide();
			$('#perfil').hide();
			$('#administracion').hide();
			$('#funcionalidad').hide();
			$('#filtro_permisos').show();
			$('#asignar_permisos').show();
		}
		if ($(this).val() == "") {
			$('#roles').hide();
			$('#vistas').hide();
			$('#perfil').hide();
			$('#administracion').hide();
			$('#funcionalidad').hide();
			$('#filtro_permisos').hide();
			$('#asignar_permisos').hide();
		}
	});
</script>