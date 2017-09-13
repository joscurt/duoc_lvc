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
    );
    $display_card_multiple = isset($filtro_multiple) && $filtro_multiple == 1 ? '':'display:none;';
    $display_card_simple = empty($display_card_multiple)? 'display:none;':'';
?>
<div class="row">
    <div class="col-md-12">
        <div class="block-header">
            <h1>Reprobados por inasistencia</h1>
        </div>  
    </div>
</div>
<div id="filtro_simple" class="card" style="<?php echo $display_card_simple; ?>">
    <div class="card-body card-padding">
        <div class="row">
            <?php 
                echo $this->element('filtros_simples2',array(
                    'filtros_posibles'=>$filtros_posibles,
                    'url_action'=>'reprobados',
                    'datos_filtro'=>$datos_filtro,
                )); 
            ?>
            <div class="col-md-3">
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
            echo $this->element('filtros_multiples2',array(
                'url_action'=>'reprobados',
                'datos_filtro'=>$datos_filtro,
                'filtro_tipo_evento'=>false,
                'filtro_estado_programacion'=>false,
                'filtro_horario'=>false,
                'filtro_sub_estado_programacion'=>false,
                'filtro_detalle'=>false,
                'periodo_required'=>true,
                'filtro_modalidades'=>true,
            )); 
        ?>
    </div>
</div>
<div class="card">
    <div class="card-body card-padding">
        <?php if (!empty($datos_tabla)): ?>
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
                        </select>
                    </div>
                </div>
                <div class="col-md-12">
                    <table class="table table-striped" border="0" cellpadding="0" cellspacing="0" >
                        <thead>
                            <tr>
                                <th>&nbsp;</th>
                                <th>Nombre Asignatura</th>
                                <th class="una-linea">Sigla-Sección</th>
                                <th>Jornada</th>
                                <th class="una-linea">Rut docente</th>
                                <th>Apellido Paterno</th>
                                <th>Apellido Materno</th>
                                <th>Nombres</th>
                                <th>N° Clases Registradas </th>
                                <th>Asistencia Promedio</th>
                                <th>Reprobado por Inasistencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $count = 0; foreach ($datos_tabla as $key => $value): $count++; ?>
                                <tr>
                                    <td><?php echo $count; ?></td>
                                    <td><?php echo $value['Asignatura']['NOMBRE']; ?></td>
                                    <td><?php echo $value['AsignaturaHorario']['SIGLA_SECCION']; ?></td>
                                    <td><?php echo $value['AsignaturaHorario']['COD_JORNADA']; ?></td>
                                    <td><?php echo $value['Docente']['RUT'].'-'.$value['Docente']['DV']; ?></td>
                                    <td><?php echo utf8_encode($value['Docente']['APELLIDO_PAT']); ?></td>
                                    <td><?php echo utf8_encode($value['Docente']['APELLIDO_MAT']); ?></td>
                                    <td><?php echo utf8_encode($value['Docente']['NOMBRE']); ?></td>
                                    <td><?php echo $value['AsignaturaHorario']['CLASES_REGISTRADAS']; ?></td>
                                    <td><?php echo (float)$value['AsignaturaHorario']['ASIST_PROMEDIO'].'%'; ?></td>
                                    <td align="center">
                                        <?php 
                                            $editable = false;
                                            if ($value['AsignaturaHorario']['RI_ENVIADO_A_SAP'] == 0) {
                                                $editable = true;
                                            }
                                        ?>
                                        <a 
                                            class="btn btn-<?php echo $editable?'danger':'success'; ?> btn-sm" 
                                            href="<?php echo $this->Html->url(array('action'=>'reprobadoFichaDetalle',$key)); ?>" 
                                            title="<?php echo $editable? 'Editar':'Ver'; ?>"
                                            ><i class="fa fa-<?php echo $editable?'info-circle':'search'; ?>" aria-hidden="true"></i></a></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-12">
                    <button 
                        href="<?php echo $this->Html->url(array('action'=>'reprobadosExcel')); ?>"
                        class="btn btn-success btn-exportar"><i class="fa fa-file-excel-o"></i>&nbsp;Exportar Excel</button>
                    <button 
                        href="<?php echo $this->Html->url(array('action'=>'reprobadosPdf')); ?>"
                        class="btn btn-success btn-exportar"><i class="fa fa-file-pdf-o"></i>&nbsp;Exportar PDF</button>
                    <button 
                        href="<?php echo $this->Html->url(array('action'=>'reprobadosImprimir')); ?>"
                        class="btn btn-success btn-exportar"><i class="fa fa-print"></i>&nbsp;Imprimir</button>
                </div>
            </div>
        <?php else: ?>
            <div class="row">
                <div class="col-md-12">
                    <label for="">*No se han encontrado registros.</label>
                </div>
            </div>
        <?php endif; ?>
    </div>
</div>
<script>
    $('table tr td a[title]').tooltip();
    $('#select-order').on('change', function(event) {
        event.preventDefault();
        var filtro_multiple = <?php echo (int)$filtro_multiple; ?>;
        if (filtro_multiple == 1) {
            $('#form-filtro-multiple').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-multiple').submit();
        }else{
            $('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+event.target.value+"' />");
            $('#form-filtro-basico').removeAttr('target');
            $('#form-filtro-basico').submit();
        }
    });
    $('.btn-exportar').on('click', function(event) {
        event.preventDefault();
        elemento_click = $(this);
        $('#form-filtro-basico').append("<input type='hidden' name='data[ordenar]' value='"+$('#select-order').val()+"' />");
        $('#form-filtro-basico').attr('action',elemento_click.attr('href'));
        $('#form-filtro-basico').attr('target','_blank');
        $('#form-filtro-basico').submit();
    });
    $("#buscar-tipo").keypress(function(event) {
        var url='';
        var tipo_filtro = $("#filtro").val();
        $("#buscar-tipo").autocomplete({
            source: "<?php echo $this->Html->url(array('action'=>'autocompletarDatos')) ?>/"+tipo_filtro,
            minLength: 1,
            select: function( event, ui ) {
                $('#hidden-uuid').val(ui.item.uuid);
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