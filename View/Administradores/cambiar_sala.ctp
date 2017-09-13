<?php #debug($programacion_clase); ?>
<form 
    action="<?php echo $this->Html->url(array('action'=>'cambiarSala',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>"
    method="POST">
<div class="modal-header">
    <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Cambiar Sala</h4>
</div>
<div class="modal-body">
    <div class="row">
    	<div class="col-md-12">
    		<div class="form-group">
    			<label for="select-cambio-sala-reemplazo">Sala:</label>
    			<select 
                    name="data[ProgramacionClase][SALA_REEMPLAZO]" 
                    id="select-cambio-sala-reemplazo" 
                    class="form-control selectpicker" 
                    data-live-search="true">
    				<option value="">Seleccionar</option>
    			</select>
                <label class="informacion-response"></label>
    		</div>
    	</div>
    </div>
    <div class="row">
        <div class="col-md-12" id="cargando">
            
        </div>
    </div>
</div>
<div class="modal-footer">
    <button type="submit" class="btn btn-success disabled" id="btn-guardar-cambio-sala">GUARDAR</button>
    <button type="button" class="btn btn-default salir-modal-editar">SALIR</button>
</div>
</form>
<script>
    $('#select-cambio-sala-reemplazo').selectpicker();
    $(function(){
        $('#cargando').html("<i class='fa fa-cog fa-spin' style='font-size:1.4em;'></i> buscando salas disponibles...").show();
        var fecha = '<?php echo date("d-m-Y",strtotime($programacion_clase["ProgramacionClase"]["FECHA_CLASE"])) ?>';
        var hora_inicio = '<?php echo date("H:i",strtotime($programacion_clase["ProgramacionClase"]["HORA_INICIO"])) ?>';
        var hora_fin = '<?php echo date("H:i",strtotime($programacion_clase["ProgramacionClase"]["HORA_FIN"])) ?>';
        $.ajax({
            url: '<?php echo $this->Html->url(array('action'=>'getSalasDisponiblesByHorario')); ?>',
            type: 'POST',
            dataType: 'json',
            data:{fecha:fecha,hora_inicio:hora_inicio,hora_fin:hora_fin},
        })
        .fail(function() {
            notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
        })
        .always(function(response) {
            if(response.status=='success'){
                $('#select-cambio-sala-reemplazo').empty().append("<option value=''></option>");
                $.each(response.data,function(index, el) {
                    $('#select-cambio-sala-reemplazo').append("<option value='"+el.ID+"'>"+el.NOMBRE+"</option>").prop('disabled',false);
                });
                if (response.data.length == 0) {
                    $('.informacion-response').html('no hay salas disponibles para el horario de la clase.');
                }else{
                    $('#btn-guardar-cambio-sala').removeClass('disabled');
                    $('.informacion-response').html('Se han encontrado '+response.data.length+' salas disponibles');
                }
                $('#select-cambio-sala-reemplazo').selectpicker('refresh');
                $('#cargando').hide();
            }else{
                notifyUser(response.message,response.status);
            }
        });
    });
</script>