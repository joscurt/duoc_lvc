<form 
    action="<?php echo $this->Html->url(array('action'=>'ajusteEliminacionEstado',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>"
    method="POST"
    >
    <div class="modal-header">
        <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Ajustes de Estado</h4>
    </div>
    <div class="modal-body">
        <div class="row">
        	<div class="col-md-12">
        		<div class="form-group">
        			<label for="select-estado">Estados:</label>
                    <select 
                        name="data[LogEvento][ESTADO_ID]" 
                        id="select-estado" 
                        class="form-control selectpicker" 
                        data-live-search="true">
                        <option value="">Seleccionar</option>
                        <?php foreach ($estados as $key => $estado): ?>
                            <option value="<?php echo $estado['Estado']['ID']; ?>">
                                <?php echo $estado['Estado']['NOMBRE']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
        		</div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="select-sub-estado">Sub Estados:</label>
                    <select 
                        name="data[LogEvento][SUB_ESTADO_ID]" 
                        id="select-sub-estado" 
                        class="form-control" 
                        data-live-search="true">
                        <option value="">Seleccionar</option>
                        <?php foreach ($sub_estados as $key => $sub_estado): ?>
                            <option value="<?php echo $sub_estado['SubEstado']['ID']; ?>">
                                <?php echo $sub_estado['SubEstado']['NOMBRE']; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <label for="select-detalle">Detalles:</label>
                        <select 
                            name="data[LogEvento][DETALLE_ID]" 
                            id="select-detalle" 
                            class="form-control" 
                            data-live-search="true">
                            <option value="">Seleccionar</option>
                            <?php foreach ($detalles as $key => $detalle): ?>
                                <option value="<?php echo $detalle['Detalle']['ID']; ?>">
                                    <?php echo $detalle['Detalle']['DETALLE']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-success">guardar</button>
        <button type="button" class="btn btn-default salir-modal-editar">salir</button>
    </div>
</form>
<script>
    $(function(){
        $('#select-estado, #select-sub-estado, #select-detalle').selectpicker();
    });
</script>