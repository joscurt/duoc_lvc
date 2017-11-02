<form id="dataForm" action="<?php echo $this->Html->url(array('action'=>'justificacionLegal',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST" >
    <div class="modal-header">
        <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Justificaci&oacute;n Legal</h4>
    </div>
    <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
        			<label for="select-tipo-justificacion">Tipo de justificaci&oacute;n legal:</label>
        			<select name="data[LogEvento][TIPO_JUSTIFICACION_ID]" id="select-tipo-justificacion" class="form-control selectpicker" data-live-search="true">
                        <option value="">SELECCIONAR</option>
                        <?php foreach ($tipo_justificacion_legal as $tipo_id => $tipo): ?>
                            <option value="<?php echo $tipo_id; ?>"><?php echo $tipo; ?></option>
                        <?php endforeach ?>
        			</select>
        		</div>
        		<div class="form group">
        			<label for="textarea-observaciones">Observaciones:</label>
        			<textarea 
                        name="data[LogEvento][OBSERVACIONES]" 
                        id="textarea-observaciones" 
                        rows="7" 
                        class="form-control"></textarea>
        		</div>
        		<div class="form-group m-t-10">
                    <label class="checkbox checkbox-inline">
                        <input 
                            name="data[LogEvento][REEMPLAZO_DOCENTE]" 
                            type="checkbox" 
                            id="checkbox-reemplazo-docente"
                            class="form-control" 
                            value="1">
                        <i class="input-helper"></i>    
                        REEMPLAZO DOCENTE
                    </label>
                </div>
        		<div class="form-group" id="contenedor-select-docente-reemplazo" style="display:none;">
                    <label for="select-docente-reemplazo" class="cargando-hidden-docentes">Nombre Docente:</label>
                       <div id="div-docente-alternativo">
                            <select 
                        name="data[LogEvento][DOCENTE_REEMPLAZO]" 
                        id="select-docente-reemplazo" 
                        class="form-control selectpicker" 
                        data-live-search="true">
                                <option value=""></option>
<!--                                 <?php foreach ($docentes as $key => $docente): ?>
                                    <option value="<?php echo $docente['Docente']['COD_DOCENTE']; ?>">
                                        <?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT'];  ?>
                                    </option>
                                <?php endforeach ?> -->
                            </select>
                            <label class="indicador-docentes"></label>
                        </div>
                        <div id="div-docente-titular" style="display:none;">
                            <input type="text" name="data[ProgramacionClase][DOCENTE]" id="input-nombre-docente" class="form-control" />
                            <input type="hidden" name="data[ProgramacionClase][COD_DOCENTE]" id="input-hidden-cod-docente" value="" />
                            <input type="hidden" value="<?php echo $programacion_clase['ProgramacionClase']['FECHA_CLASE']; ?>" id="input-date-fecha-programada">
                            <input type="hidden" value="<?php echo $programacion_clase['ProgramacionClase']['HORA_INICIO']; ?>"" id="select-hora-inicio">
                            <input type="hidden" value="<?php echo $programacion_clase['ProgramacionClase']['HORA_FIN']; ?>" id="select-hora-fin">
                        </div>

                </div>
        	</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">GUARDAR</button>
        <button type="button" class="btn btn-default salir-modal-editar" >SALIR</button>
    </div>
</form>  
<script type="text/javascript">
    $('#select-tipo-justificacion, #select-docente-reemplazo').selectpicker();
    $('#checkbox-reemplazo-docente').on('change', function(event) {
        if ($(this).is(':checked')) {
            $('#contenedor-select-docente-reemplazo').show();
            completarDocentes();
        }else{
            $('#contenedor-select-docente-reemplazo').hide();
        }
    });

    var completarDocentes = function () {
        fecha = $('#input-date-fecha-programada').val();
        hora_inicio = $('#select-hora-inicio').val();
        hora_fin = $('#select-hora-fin').val();
        if (fecha != '') {
            if (hora_inicio != '') {
                $('label.cargando-hidden-docentes span').html("<i class='fa fa-cog fa-spin'></i>").show();
                $.ajax({
                    url: '<?php echo $this->Html->url(array('action'=>'getDocDisponiblesByHorarioProg')); ?>',
                    type: 'POST',
                    contentType: 'application/x-www-form-urlencoded;charset=utf-8',
                    dataType: 'json',
                    data:{fecha:fecha,hora_inicio:hora_inicio,hora_fin:hora_fin},
                }).fail(function() {
                    notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
                }).always(function(response) {
                    if(response.status=='success'){
                        $('#select-docente-reemplazo').empty().append("<option value=''></option>");
                        $.each(response.data,function(index, el) {
                            $('#select-docente-reemplazo').append("<option value='"+response.data[index]["Docente"].COD_DOCENTE+"'>"+response.data[index]["Docente"].RUT+' - '+response.data[index]["Docente"].NOMBRE+' '+response.data[index]["Docente"].APELLIDO_PAT+' '+response.data[index]["Docente"].APELLIDO_MAT+"</option>").prop('disabled',false);
                            $('#select-docente-reemplazo').selectpicker('refresh');
                        });
                        $('label.cargando-hidden-docentes span').hide();
                        $('label.indicador-docentes').html('Se han encontrado '+response.data.length+' Docentes disponibles.').show();
                    }else{
                        notifyUser(response.message,response.status);
                    }
                });
            }else{
                notifyUser('Seleccione una hora de inicio','info');
            }
        }else{
            notifyUser('Seleccione una fecha del calendario','info');
        }
    }
    $(function(){
        $("#dataForm").submit(function( event ) {
            var error='';
            if ($.trim($('#select-tipo-justificacion').val()).length < 1) {
                error+='Debe seleccionar tipo de justificaci&oacute;n.<br>';
            }
            if ($.trim($('#textarea-observaciones').val()).length < 1) {
                error+='Debe adicionar una observaci&oacute;n.<br>';
            }
            if( $('#checkbox-reemplazo-docente').prop('checked') ) {
                if ($("#select-docente-reemplazo").val()=='') {
                    error+='Debe seleccionar un docente.<br>';
                }
            }
            if (error!='') {
                event.preventDefault();
                notifyUser(error, 'info');
                $(".alert-info").css("z-index", "2000");
                return false;                
            }
        });
    });
</script>