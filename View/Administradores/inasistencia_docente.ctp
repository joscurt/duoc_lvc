<div class="modal-header">
    <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Inasistencia Docente</h4>
</div>
<form id="dataForm" action="<?php echo $this->Html->url(array('action'=>'inasistenciaDocente',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
    <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
        			<label for="select-motivo-inasistencia-docente">Motivo:</label>
        			<select 
                        name="data[LogEvento][MOTIVO_INASISTENCIA_DOCENTE_ID]" 
                        id="select-motivo-inasistencia-docente" 
                        class="form-control selectpicker" 
                        data-live-search="true">
        				<option value="">Seleccionar</option>
                        <?php foreach ($motivos as $motivo_id => $motivo): ?>
                            <option value="<?php echo $motivo_id ?>">
                                <?php echo $motivo; ?>
                            </option>
                        <?php endforeach ?>
        			</select>
        		</div>
        		<div class="form-group">
                    <label for="textarea-observaciones-inasistencia-docente">Observaciones:</label>
        			<textarea 
                        name="data[LogEvento][OBSERVACIONES]" 
                        id="textarea-observaciones-inasistencia-docente" 
                        rows="5" 
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
        			<label for="">Nombre Docente:</label>
        			<?php if (!empty($docentes)): ?>
                        <select 
                            name="data[LogEvento][DOCENTE_REEMPLAZO]" 
                            id="select-docente-reemplazo" 
                            class="form-control selectpicker" 
                            data-live-search="true">
                            <option value="">Seleccionar</option>
                            <?php foreach ($docentes as $key => $docente): ?>
                                <option value="<?php echo $docente['Docente']['COD_DOCENTE']; ?>">
                                    <?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT']; ?>
                                </option>
                            <?php endforeach ?>
                        </select>
                    <?php else: ?>
                        <h5>No hay docentes disponibles para el horario <?php echo date('d-m-Y H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_INICIO'])).' - '.date('H:i',strtotime($programacion_clase['ProgramacionClase']['HORA_FIN'])); ?></h5>
                    <?php endif; ?>
        		</div>
        	</div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">GUARDAR</button>
        <button type="button" class="btn btn-default salir-modal-editar">SALIR</button>
    </div>
</form>
<script type="text/javascript">
    $('#select-motivo-inasistencia-docente, #select-docente-reemplazo').selectpicker();
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
            if ($.trim($('#select-motivo-inasistencia-docente').val()).length < 1) {
                error+='Debe seleccionar el motivo.<br>';
            }
            if ($.trim($('#textarea-observaciones-inasistencia-docente').val()).length < 1) {
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