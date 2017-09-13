<style>
    .ui-autocomplete {
        max-height: 140px;
        overflow-y: auto;
        overflow-x: hidden;
        padding-right: 20px;
        z-index: 1200;
    }
    * html .ui-autocomplete {
        height: 100px;
    }
</style>
<?php 
    $filtros_posibles = array(
        'Docente.RUT'=>'Rut docente',
        'Docente.NOMBRE'=>'Nombre docente',
        'Docente.COD_FUNCIONARIO'=>'ID docente',
        'Asignatura.NOMBRE'=>'Nombre asignatura',
        'ProgramacionClase.SIGLA_SECCION'=>'Sigla - Sección',
        'ProgramacionClase.PERIODO'=>'Periodo',
        'ProgramacionClase.COD_JORNADA'=>'Jornada',
        'ProgramacionClase.detalle'=>'Detalle',
        'ProgramacionClase.sub_estado'=>'Sub-Estado',
    );
    $display_card_multiple = isset($filtro_multiple) && $filtro_multiple == 1 ? '':'display:none;';
    $display_card_simple = empty($display_card_multiple)? 'display:none;':'';
?>
<div class="row">
    <div class="col-md-12">
        <div class="block-header">
            <h1>Recuperar Clases</h1>
        </div>  
    </div>
</div>
<div id="filtro_simple" class="card" style="<?php echo $display_card_simple; ?>">
    <div class="card-body card-padding">
        <div class="row">
            <?php 
                echo $this->element('filtros_simples',array(
                    'filtros_posibles'=>$filtros_posibles,
                    'url_action'=>'recuperarClases',
                    'datos_filtro'=>$datos_filtro,
                )); 
            ?>
            <div class="col-md-2">
                <div class="form-group">
                    <button class="btn btn-default cambiar-filtro-multiple" style="margin-top: 27px;">Filtro múltiple</button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="filtro_multiple" class="card" style="<?php echo $display_card_multiple; ?>">
    <div class="card-body card-padding">
        <?php 
            echo $this->element('filtros_multiples',array(
                'url_action'=>'recuperarClases',
                'datos_filtro'=>$datos_filtro,
                'filtro_tipo_evento'=>true,
                'periodo_required'=>true,
                'filtro_estado_programacion'=>false,
            )); 
        ?>
    </div>
</div>
<?php if (isset($datos_tabla) && !empty($datos_tabla)): ?>
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-12">
                    <div class="pull-right">
                    <label for="" class="">Ordenar por:</label>
                        <select name="data[Filter][ordenar]" id="select-order" class="form-control selectpicker" data-live-search="true">
                            <option value="" >Seleccionar</option>
                            <option value="Docente.RUT" <?php echo $ordenar == 'Docente.RUT' ? 'selected="selected"':''; ?> >Rut docente</option>
                            <option value="Docente.APELLIDO_PAT" <?php echo $ordenar == 'Docente.APELLIDO_PAT' ? 'selected="selected"':''; ?> >Apellido Paterno docente</option>
                            <option value="Docente.APELLIDO_MAT" <?php echo $ordenar == 'Docente.APELLIDO_MAT' ? 'selected="selected"':''; ?>>Apellido Materno docente</option>
                            <option value="Docente.NOMBRE" <?php echo $ordenar == 'Docente.NOMBRE' ? 'selected="selected"':''; ?>>Nombre docente</option>
                            <option value="Docente.COD_DOCENTE" <?php echo $ordenar == 'Docente.COD_DOCENTE' ? 'selected="selected"':''; ?>>ID docente</option>
                            <option value="Asignatura.NOMBRE" <?php echo $ordenar == 'Asignatura.NOMBRE' ? 'selected="selected"':''; ?>>Nombre asignatura</option>
                            <option value="ProgramacionClase.SIGLA_SECCION" <?php echo $ordenar == 'ProgramacionClase.SIGLA_SECCION' ? 'selected="selected"':''; ?> >Sigla - Sección</option>
                            <option value="ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE"<?php echo $ordenar == 'ProgramacionClase.ANHO,ProgramacionClase.SEMESTRE' ? 'selected="selected"':''; ?> >Periodo</option>
                            <option value="ProgramacionClase.HORA_INICIO" <?php echo $ordenar == 'ProgramacionClase.HORA_INICIO' ? 'selected="selected"':''; ?>>Horario</option>
                            <option value="ProgramacionClase.TIPO_EVENTO" <?php echo $ordenar == 'ProgramacionClase.TIPO_EVENTO' ? 'selected="selected"':''; ?>>Tipo</option>
                            <option value="Detalle.DETALLE" <?php echo $ordenar == 'Detalle.DETALLE' ? 'selected="selected"':''; ?>>Detalle</option>
                            <option value="Estado.NOMBRE" <?php echo $ordenar == 'Estado.NOMBRE' ? 'selected="selected"':''; ?>>Estado</option>
                            <option value="SubEstado.NOMBRE" <?php echo $ordenar == 'SubEstado.NOMBRE' ? 'selected="selected"':''; ?>>Sub-Estado</option>
                        </select>
                    </div>
                </div>  
            </div>
        </div>
        <div class="card-body card-padding">
            <form action="<?php echo $this->Html->url(array('action'=>'recuperarClasesExcel')) ?>" method="post" id="form-recuperar-clases-exportables" target="_blank">
                <div class="row">
                    <div class="col-md-12">
                        <table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th class="una-linea">Fecha</th>
                                    <th>Nombre Asignatura</th>
                                    <th class="una-linea">Sigla-Sección</th>
                                    <th>Jornada</th>
                                    <th class="una-linea">Rut docente</th>
                                    <th>Apellido Paterno</th>
                                    <th>Apellido Materno</th>
                                    <th>Nombres</th>
                                    <th>Sala</th>
                                    <th>Horario</th>
                                    <th>Tipo</th>
                                    <th>Detalle</th>
                                    <th>Editar</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $count = 0; foreach ($datos_tabla as $key => $dato): $count++;?>
                                    <tr class="odd">
                                        <td>
                                            <?php echo $key+1 ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden" 
                                                name="data[Excel][<?php echo $count ?>][FECHA_CLASE]" 
                                                value="<?php echo isset($dato['ProgramacionClase']['FECHA_CLASE']) ? date('d-m-Y', strtotime($dato['ProgramacionClase']['FECHA_CLASE'])) : ''; ?>">
                                            </input>
                                            <?php 
                                                echo isset($dato['ProgramacionClase']['FECHA_CLASE'])
                                                ? date('d-m-Y', strtotime($dato['ProgramacionClase']['FECHA_CLASE'])): '';
                                            ?>      
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][NOMBRE_ASIGNATURA]"
                                                value="<?php echo isset($dato['Asignatura']['NOMBRE']) ? $dato['Asignatura']['NOMBRE']: ''; ?>">
                                            </input>
                                            <?php 
                                                echo isset($dato['Asignatura']['NOMBRE']) 
                                                ? $dato['Asignatura']['NOMBRE']: ''; 
                                            ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][SIGLA_SECCION]"
                                                value="<?php echo isset($dato['ProgramacionClase']['SIGLA_SECCION']) ? $dato['ProgramacionClase']['SIGLA_SECCION']: ''; ?>">
                                            </input>
                                            <?php 
                                                echo isset($dato['ProgramacionClase']['SIGLA_SECCION']) 
                                                ? $dato['ProgramacionClase']['SIGLA_SECCION']: ''; 
                                            ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][COD_JORNADA]"
                                                value="<?php echo $dato['ProgramacionClase']['COD_JORNADA']; ?>">
                                            </input>
                                            <?php if (!empty($dato['ProgramacionClase']['COD_JORNADA'])): ?>
                                                <?php echo $dato['ProgramacionClase']['COD_JORNADA'] == 'D' ? 'Diurno':''; ?>
                                                <?php echo $dato['ProgramacionClase']['COD_JORNADA'] == 'V' ? 'Vespertino':''; ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][RUT]"
                                                value="<?php echo isset($dato['Docente']['RUT']) ? $dato['Docente']['RUT'].'-'.$dato['Docente']['DV']: ''; ?>">
                                            </input>    
                                            <?php echo isset($dato['Docente']['RUT']) ? $dato['Docente']['RUT'].'-'.$dato['Docente']['DV']: ''; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][APELLIDO_PAT]"
                                                value="<?php echo isset($dato['Docente']['APELLIDO_PAT']) ? $dato['Docente']['APELLIDO_PAT']: ''; ?>">
                                            </input>    
                                            <?php echo isset($dato['Docente']['APELLIDO_PAT']) ? $dato['Docente']['APELLIDO_PAT']: ''; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][APELLIDO_MAT]"
                                                value="<?php echo isset($dato['Docente']['APELLIDO_MAT']) ? $dato['Docente']['APELLIDO_MAT']: ''; ?>">
                                            </input> 
                                            <?php echo isset($dato['Docente']['APELLIDO_MAT']) ? $dato['Docente']['APELLIDO_MAT']: ''; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][NOMBRE_DOCENTE]"
                                                value="<?php echo isset($dato['Docente']['NOMBRE']) ? $dato['Docente']['NOMBRE']: ''; ?>">
                                            </input>     
                                            <?php echo isset($dato['Docente']['NOMBRE']) ? $dato['Docente']['NOMBRE']: ''; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][SALA]"
                                                value="<?php echo !empty($dato['SalaReemplazo']['TIPO_SALA']) ? $dato['SalaReemplazo']['TIPO_SALA']:$dato['Sala']['TIPO_SALA']; ?>">
                                            </input>         
                                            <?php echo !empty($dato['SalaReemplazo']['TIPO_SALA']) ? $dato['SalaReemplazo']['TIPO_SALA']:$dato['Sala']['TIPO_SALA']; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][HORA_INICIO]"
                                                value="<?php echo isset($dato['ProgramacionClase']['HORA_INICIO']) ? $dato['ProgramacionClase']['HORA_INICIO'] : ''; ?>">
                                            </input>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][HORA_FIN]"
                                                value="<?php echo isset($dato['ProgramacionClase']['HORA_FIN']) ? $dato['ProgramacionClase']['HORA_FIN'] : ''; ?>">
                                            </input> 
                                            <?php 
                                                echo isset($dato['ProgramacionClase']['HORA_INICIO']) 
                                                ? date('H:i',strtotime($dato['ProgramacionClase']['HORA_INICIO'])): ''; 
                                            ?>
                                            -
                                            <?php 
                                                echo isset($dato['ProgramacionClase']['HORA_FIN']) 
                                                ? date('H:i', strtotime($dato['ProgramacionClase']['HORA_FIN'])): ''; 
                                            ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][TIPO_EVENTO]"
                                                value="<?php echo isset($dato['ProgramacionClase']['TIPO_EVENTO']) ? $dato['ProgramacionClase']['TIPO_EVENTO']: ''; ?>">
                                            </input>    
                                            <?php echo isset($dato['ProgramacionClase']['COD_PROGRAMACION']) ? $dato['ProgramacionClase']['COD_PROGRAMACION']: ''; ?>
                                        </td>
                                        <td>
                                            <input 
                                                type="hidden"
                                                name="data[Excel][<?php echo $count ?>][DETALLE]"
                                                value="<?php echo isset($dato['Detalle']['DETALLE']) ? $dato['Detalle']['DETALLE']: ''; ?>">
                                            </input>        
                                            <?php echo isset($dato['Detalle']['DETALLE']) ? $dato['Detalle']['DETALLE']: ''; ?>
                                        </td>
                                        <td>
                                            <a
                                                class="btn btn-info btn-sm" 
                                                href="<?php echo $this->Html->url(array('action'=>'editarRecuperacionClase', $dato['ProgramacionClase']['COD_PROGRAMACION'])); ?>" 
                                                title="Editar">
                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <button id="submit_excel" type="submit" class="btn btn-success"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
                        <a id="submit_pdf" class="btn btn-success"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</a> 
                        <a id="submit_imprimir" class="btn btn-success"><i class="fa fa-print"></i>&nbsp;Imprimir</a>
                    </div>
                </div>
            </form>       
        </div>
    </div>
<?php else: ?>
    <div class="card">
        <div class="card-body card-padding">
            <div class="row">
                <div class="col-md-12">
                    <label for="">*No se han encontrado registros.</label>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?>
<script>
    $('#select-order').on('change', function(event) {
        event.preventDefault();
        var filtro_multiple = <?php echo (int)$filtro_multiple; ?>;
        if (filtro_multiple == 1) {
            $('#form-filtro-multiple').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-multiple').submit();
        }else{
            $('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-basico').submit();
        }
    });
    $('#submit_pdf').click(function(event) {
        $('#form-recuperar-clases-exportables').attr('action', "<?php echo $this->Html->url(array('action'=>'recuperarClasesPdf')) ?>");
        $('#form-recuperar-clases-exportables').submit();
    });
    $('#submit_imprimir').click(function(event) {
        $('#form-recuperar-clases-exportables').attr('action', "<?php echo $this->Html->url(array('action'=>'recuperarClasesPdf', TRUE)) ?>");
        $('#form-recuperar-clases-exportables').submit();
    });
    $('#check-all').on('click',function() {
        if ($(this).is(':checked')) {
            $('.check-clase').prop('checked', true);
        } else {
            $('.check-clase').prop('checked', false);
        }
    });
    $("#buscar-tipo").keypress(function(event) {
        var url='';
        var tipo_filtro = $("#filtro").val();
        $("#buscar-tipo").autocomplete({
            source: "<?php echo $this->Html->url(array('action'=>'autocompletarDatos')) ?>/"+tipo_filtro,
            minLength: 1,
            select: function( event, ui ) {
                $('#hidden-uuid').val(ui.item.uuid);
                $('#usuario').val(ui.item.nombre_usuario!= '' ? ui.item.nombre_usuario:'');
            },
        });
    });
    $(".buscar-tipo").keypress(function(event) {
        var url='';
        var tipo_filtro = $(".filtro").attr('tipo_filtro');
        // console.log(tipo_filtro);
        $(".buscar-tipo").autocomplete({
            source: "<?php echo $this->Html->url(array('action'=>'autocompletarDatos')) ?>/"+tipo_filtro,
            minLength: 1,
            select: function( event, ui ) {
                $('#hidden-uuid').val(ui.item.uuid);
                $('#usuario').val(ui.item.nombre_usuario!= '' ? ui.item.nombre_usuario:'');
            },
        });
    });
    $('#filtro').change(function() {
        $('#buscar-tipo').val('');
    });
    $('.date-time-picker').datetimepicker({
        format: 'DD-MM-YYYY'
    });
    $('.time-picker').datetimepicker({
        format: 'LT'
    });
    $('.cambiar-filtro-multiple').on("click", function () {
        $('#filtro_multiple').show();
        $('#filtro_simple').hide();
    });
    $('.cambiar-filtro-simple').on("click", function () {
        $('#filtro_multiple').hide();
        $('#filtro_simple').show();
    });
</script>