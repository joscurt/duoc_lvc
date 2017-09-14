<form id="dataForm" action="<?php echo $this->Html->url(array('action'=>'justificacionLegal',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST" >
    <div class="modal-header">
        <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Justificación Legal</h4>
    </div>
    <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
        			<label for="select-tipo-justificacion">Tipo de justificación legal:</label>
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
                    <label for="select-docente-reemplazo">Nombre Docente:</label>
                    <select 
                        name="data[LogEvento][DOCENTE_REEMPLAZO]" 
                        id="select-docente-reemplazo" 
                        class="form-control selectpicker" 
                        data-live-search="true">
                        <option value="">Seleccionar</option>
                        <?php foreach ($docentes as $key => $value): ?>
                            <option value="<?php echo $value['Docente']['COD_DOCENTE'];; ?>">
                            <?php echo $value['Docente']['NOMBRE'].' '.$value['Docente']['APELLIDO_PAT'].' '.$value['Docente']['APELLIDO_MAT']; ?>

                            </option>
                        <?php endforeach ?>
                    </select>
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
        }else{
            $('#contenedor-select-docente-reemplazo').hide();
        }
    });

    $(function(){
        $("#dataForm").submit(function( event ) {
            var error='';
            if ($.trim($('#select-tipo-justificacion').val()).length < 1) {
                error+='Debe seleccionar tipo de justificación.<br>';
            }
            if ($.trim($('#textarea-observaciones').val()).length < 1) {
                error+='Debe adicionar una observación.<br>';
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