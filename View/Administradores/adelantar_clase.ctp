<?php if($programacion_clase['ProgramacionClase']['PROGRAMACION_ACTIVA']=='SI'): ?>
    <form id="dataForm" action="<?php echo $this->Html->url(array('action'=>'adelantarClase', $programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>" method="POST">
        <div class="modal-header">
            <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Adelantar Clase</h4>
        </div>
        <div class="modal-body">
            <div class="row">
            	<div class="col-md-6">
            		<div class="form-group">
            			<label for="select-motivo-adelantar-clase">Motivo:</label>
                        <select name="data[LogEvento][MOTIVO_ADELANTAR_CLASE_ID]" id="select-motivo-adelantar-clase" class="form-control selectpicker" data-live-search="true">
                            <option value="">Seleccionar</option>
                            <?php foreach ($motivos as $motivo_id => $motivo): ?>
                                <option value="<?php echo $motivo_id ?>">
                                    <?php echo $motivo; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
            		</div>
                </div>
                <div class="col-md-6">
            		<div class="form group">
            			<label for="textarea-observaciones-adelantar-clase">Observaciones:</label>
                        <textarea name="data[LogEvento][OBSERVACIONES]" id="textarea-observaciones-adelantar-clase" rows="3" class="form-control"></textarea>
            		</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
            		<div class="form-group">
            			<label for="data[LogEvento][TIPO_CLASE]">Tipo de Clase:</label>
            			<select name="data[LogEvento][TIPO_CLASE]" id="select-tipo-clase" class="form-control selectpicker" data-live-search="true">
            				<option value="">SELECCIONAR</option>
                            <option value="presencial">PRESENCIAL</option>
                            <option value="virtual">VIRTUAL</option>
            			</select>
                        <span>&nbsp;</span>
            		</div>
                </div>
                <div class="col-md-6">
        	 		<div class="form-group">
                        <label for="input-date-fecha-programada">Fecha Programada:</label>
                        <input type="text" name="data[LogEvento][FECHA_CLASE]" id="input-date-fecha-programada" class="form-control" placeholder="DD-MM-YYYY" />
                        <span id="msjFecha" style="color: green;">&nbsp;</span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 datos-presencial">
        			<div class="form-group">
                        <label for="select-hora-inicio" class="cargando-hidden">Hora inicio: <span ></span></label>
                        <select name="data[LogEvento][HORA_INICIO]" id="select-hora-inicio" class="form-control selectpicker" disabled="disabled" data-live-search="true">
                            <option value=""></option>
                        </select>
                    </div>
        		</div>
        		<div class="col-md-4 datos-presencial">
        			<div class="form-group">
                        <label for="select-hora-fin" class="cargando-hidden">Hora fin: <span ></span></label>
                        <select name="data[LogEvento][HORA_FIN]" id="select-hora-fin" class="form-control selectpicker" disabled="disabled" data-live-search="true">
                            <option value=""></option>
                        </select>
                    </div>
        		</div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="input-clases-recuperar">Módulos a recuperar: </label>
                        <input name="data[LogEvento][CLASES_RECUPERAR]" id="input-clases-recuperar" class="form-control" disabled="disabled" value="<?php echo number_format($programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS'], 0); ?>"/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 datos-presencial">
        			<div class="form-group">
            			<label for="select-sala" class="cargando-hidden-salas">Sala: <span style="display:none;float:right"></span></label>
                        <select name="data[LogEvento][SALA]" id="select-sala" disabled="disabled" class="form-control selectpicker" data-live-search="true">
                            <option value=""></option>
                        </select>
                        <label class="indicador-salas"></label>
            		</div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3">
            		<div class="form-group"><br>
                        <label class="checkbox checkbox-inline">
                            <input type="checkbox" name="data[ProgramacionClase][DOCENTE_TITULAR]" id="check-docente-titular" class="form-control" value="1">
                            <i class="input-helper"></i> DOCENTE TITULAR
                        </label>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="form-group">
                        <label for="input-nombre-docente">Nombre Docente:</label>
                        <div id="div-docente-alternativo">
                            <select name="data[ProgramacionClase][COD_DOCENTE_ALTERNATIVO]" id="select-nombre-docente" class="form-control selectpicker" data-live-search="true">
                                <option value=""></option>
                                <?php foreach ($docentes as $key => $docente): ?>
                                    <option value="<?php echo $docente['Docente']['COD_DOCENTE']; ?>">
                                        <?php echo $docente['Docente']['NOMBRE'].' '.$docente['Docente']['APELLIDO_PAT'].' '.$docente['Docente']['APELLIDO_MAT'];  ?>
                                    </option>
                                <?php endforeach ?>
                            </select>
                        </div>
                        <div id="div-docente-titular" style="display:none;">
                            <input type="text" name="data[ProgramacionClase][DOCENTE]" id="input-nombre-docente" class="form-control" />
                            <input type="hidden" name="data[ProgramacionClase][COD_DOCENTE]" id="input-hidden-cod-docente" value="" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="modal-footer">
        <button class="btn btn-info presencial" id="btn-tope" type="button">TOPE HORARIO ALUMNOS</button>
        <button class="btn btn-info presencial" id="btn-tope_docentes" type="button">TOPE HORARIO DOCENTES</button>
            <button type="submit" class="btn btn-success">guardar</button>
            <button type="button" class="btn btn-default salir-modal-editar">salir</button>
        </div>
    </form>
<?php else: ?>
    <div class="modal-header">
        <h4 class="modal-title" style="border-bottom: 1px solid #0c253d; padding-bottom: 5px;">Adelantar Clase</h4>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="col-md-12">
                <center><h3><?php echo 'Esta clase ya se encuentra vencida en su programación por fecha: '.date('Y-m-d', strtotime($programacion_clase['ProgramacionClase']['FECHA_CLASE'])).'.'; ?></h3></center>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-success salir-modal-editar">salir</button>

            <div class="row" id="content-lista-alumnos">
                
            </div>
            <div class="row" id="content-lista-docentes">
                
            </div>

    </div>
<?php endif; ?>


<script type="text/javascript">

//Boton tope Horario Alumnos ========================================================================================
    $('#btn-tope').on('click',function(event){
        
            $('#content-lista-alumnos').empty();
            var elemento_click = $(this);
            elemento_click.html("<i class='fa fa-cog fa-spin'></i>");
            $('#content-lista-alumnos').load("<?php echo $this->Html->url(array('action'=>'listaAlumnosConTope',$programacion_clase['ProgramacionClase']['COD_PROGRAMACION'])); ?>",function(){
                elemento_click.html("TOPE HORARIO");
            });
        
    });



    var completarSalas = function () {
        fecha = $('#input-datetimepicker-fecha-clase').val();
        hora_inicio = $('#select-hora-inicio').val();
        hora_fin = $('#select-hora-fin').val();
        if (fecha != '') {
            if (hora_inicio != '') {
                $('label.cargando-hidden-salas span').html("<i class='fa fa-cog fa-spin'></i>").show();
                $.ajax({
                    url: '<?php echo $this->Html->url(array('action'=>'getSalasDisponiblesByHorario')); ?>',
                    type: 'POST',
                    dataType: 'json',
                    data:{fecha:fecha,hora_inicio:hora_inicio,hora_fin:hora_fin},
                }).fail(function() {
                    notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
                }).always(function(response) {
                    if(response.status=='success'){
                        $('#select-sala').empty().append("<option value=''></option>");
                        $.each(response.data,function(index, el) {
                            $('#select-sala').append("<option value='"+el.ID+"'>"+el.NOMBRE+"</option>").prop('disabled',false);
                            $('#select-sala').selectpicker('refresh');
                        });
                        $('label.cargando-hidden-salas span').hide();
                        $('label.indicador-salas').html('Se han encontrado '+response.data.length+' salas disponibles.').show();
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
    // ----------------------------------------------------------------------
    restaFechas = function(f1,f2) {
         var aFecha1 = f1.split('-'); 
         var aFecha2 = f2.split('-'); 
         var fFecha1 = Date.UTC(aFecha1[2],aFecha1[1]-1,aFecha1[0]); 
         var fFecha2 = Date.UTC(aFecha2[2],aFecha2[1]-1,aFecha2[0]); 
         var dif = fFecha2 - fFecha1;
         var dias = Math.floor(dif / (1000 * 60 * 60 * 24)); 
         return dias;
    }
    // ----------------------------------------------------------------------
    var completarHorarios = function () {
        fecha = $('#input-date-fecha-programada').val();
        if (fecha != '') {
            $('label.cargando-hidden span').html("<i class='fa fa-cog fa-spin'></i>").show();
            $.ajax({
                url: '<?php echo $this->Html->url(array('action'=>'getHorariosDisponiblesByFecha')); ?>',
                type: 'POST',
                dataType: 'json',
                data:{fecha:fecha},
            }).fail(function() {
                notifyUser('Ha ocurrido un error inesperado. Intente nuevamente.','danger');
            }).always(function(response) {
                if(response.status=='success'){
                    $('#select-hora-inicio, #select-hora-fin').empty().append("<option value=''></option>").prop('disabled',false);
                    $.each(response.data,function(index, el) {
                        $('#select-hora-inicio').append("<option value='"+el.hora_inicio+"'>"+el.hora_inicio+"</option>");
                        $('#select-hora-fin').append("<option value='"+el.hora_fin+"'>"+el.hora_fin+"</option>");
                        $('#select-hora-inicio, #select-hora-fin').selectpicker('refresh');
                    });
                    $('label.cargando-hidden span').hide();
                }else{
                    $('#select-hora-inicio, #select-hora-fin').empty().append("<option value=''></option>").prop('disabled',true);
                    notifyUser(response.message,response.status);
                }
            }); 
        }
    }
    // ----------------------------------------------------------------------
    function completarDataDocenteTitular() {
        console.log(data_docente);
        if (typeof data_docente === "object") {
            if($('#check-docente-titular').is(':checked')){
                $('#div-docente-titular').show();
                $('#div-docente-alternativo').hide();
                $('#input-hidden-cod-docente').val(data_docente.Docente.COD_DOCENTE);
                $('#input-nombre-docente').prop('disabled',true).val(data_docente.Docente.NOMBRE+' '+data_docente.Docente.APELLIDO_PAT+' '+data_docente.Docente.APELLIDO_MAT);
            }else{
                $('#input-hidden-cod-docente').val('');
                $('#input-nombre-docente').val('');
                $('#div-docente-titular').hide();
                $('#div-docente-alternativo').show();
            }
        }
    }
    // ----------------------------------------------------------------------
    $(function(){
        // ----------------------------------------------------------------------
        // Activar el selectpicker.
        $('#select-tipo-clase, #select-motivo-adelantar-clase, #select-nombre-docente').selectpicker();
        
        // ----------------------------------------------------------------------
        // Validar las horas a programar.
        $('#select-hora-inicio, #select-hora-fin').on('change',function(){
            var objId=$(this).attr('id');
            var h_ini = $.trim( $('#select-hora-inicio').val() );
            var h_fin = $.trim( $('#select-hora-fin').val() );
            if (h_ini.length>0 && h_fin) {
                h_ini=parseInt(h_ini.replace(":", ""));
                h_fin=parseInt(h_fin.replace(":", ""));
                if (h_ini<h_fin) {
                    completarSalas();
                }else{
                    $("#"+objId).val('');
                    notifyUser('La hora de inicio debe ser menor que la hora de fin.','info');
                    $(".alert-info").css("z-index", "2000");
                }
            } 
        });

        $('#select-hora-fin').on('change', function(event) {
        if ($('#select-hora-inicio').val() == '') {
            notifyUser('Debe seleccionar una hora de inicio','info');
            $(".alert-info").css("z-index", "2000");
            resetHoraFin();
            return false;
        }
        var minutos = calcularMinutos($('#select-hora-inicio').val(),$('#select-hora-fin').val());
        modulos = minutos / 45;
        if (modulos <=0) {
            notifyUser('Debe seleccionar un horario de término que almenos recupere 1 modulo','info');
            $(".alert-info").css("z-index", "2000");
            resetHoraFin();
            return false;
        }
        if (modulos > <?php echo (int)$programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>) {
            resetHoraFin();
            notifyUser('La cantidad de modulos no puede ser mayor a <?php echo (int)$programacion_clase['ProgramacionClase']['CANTIDAD_MODULOS']; ?>','info');
            $(".alert-info").css("z-index", "2000");
        }
    });
            function resetHoraFin() {
        $('#select-hora-fin').val('');
        $('#select-hora-fin').selectpicker('refresh');
    }
        function calcularMinutos(hora_inicio,hora_termino) {
        hora_termino=  '2016-12-21 '+ hora_termino + ":00";
        hora_inicio= '2016-12-21 '+ hora_inicio + ":00";
        var a = new Date(hora_termino);
        var b = new Date(hora_inicio);
        var c = ((a-b)/1000);
        return c / 60; 
    }

        // ----------------------------------------------------------------------
        // Validar fecha a programar.
        <?php
            $FI = date('d-m-Y');
            $date = new DateTime($periodoActual['Periodo']['FECHA_FIN']);
            $FF = $date->format('d-m-Y');
        ?>
        var periodo_ini = "<?php echo $FI ?>";
        var periodo_fin = "<?php echo $FF ?>"; 
        var dias=0;
        $("#input-date-fecha-programada").blur(function() {
            dias=parseInt( restaFechas( periodo_ini, $(this).val() ) );
            if(dias<0){
                $("#input-date-fecha-programada").val( periodo_ini );
                $("#msjFecha").html('Se permite fecha entre: '+periodo_ini+' y '+periodo_fin);
                notifyUser('Se permite fecha entre: '+periodo_ini+' y '+periodo_fin,'info');
                 $('#input-date-fecha-programada').val('');
                $(".alert-info").css("z-index", "2000");
                return false;
            }else{
                $("#msjFecha").html('&nbsp;');
            }
            dias=parseInt( restaFechas( periodo_fin, $(this).val() ) );
            if(dias>0){
                $("#input-date-fecha-programada").val( periodo_fin );
                $("#msjFecha").html('Se permite fecha entre: '+periodo_ini+' y '+periodo_fin);
                notifyUser('Se permite fecha entre: '+periodo_ini+' y '+periodo_fin,'info');
                 $('#input-date-fecha-programada').val('');
                $(".alert-info").css("z-index", "2000");
                return false;
            }else{
                $("#msjFecha").html('&nbsp;');
            }
        });

        // ----------------------------------------------------------------------
        $('#select-tipo-clase').on('change', function(event) {
            event.preventDefault();
            if (event.target.value == 'presencial') {
                $('.datos-presencial').show();
                $('.datos-virtual').hide();
            }else{
                $('.datos-presencial').hide();
                $('.datos-virtual').show();
            }
        });   
        // ----------------------------------------------------------------------
        $('#input-date-fecha-programada').datetimepicker({
            format:'DD-MM-YYYY',
            daysOfWeekDisabled: [0]
        });
        // ----------------------------------------------------------------------
        $('#input-date-fecha-programada').on('dp.change',function(event) {
            completarHorarios();
        });
        // ----------------------------------------------------------------------
        $('#check-docente-titular').on('change',function(){
            completarDataDocenteTitular();
        });
        // ----------------------------------------------------------------------
    });


    $(function(){
        $("#dataForm").submit(function( event ) {
            var error='';
            if ($("#select-motivo-adelantar-clase").val()=='') {
                error+='Debe seleccionar el motivo.<br>';
            }
            if ($.trim($('#textarea-observaciones-adelantar-clase').val()).length < 1) {
                error+='Debe adicionar una observación.<br>';
            }
            if ($("#select-tipo-clase").val()=='') {
                error+='Debe seleccionar el tipo de clase.<br>';
            }
            if ($("#input-date-fecha-programada").val()=='') {
                error+='Debe ingresar la fecha programada.<br>';
            }
            if ($("#select-hora-inicio").val()=='' || $("#select-hora-fin").val()=='') {
                error+='Debe ingresar la hora de inicio y la hora fin.<br>';
            }
            if( !$('#check-docente-titular').prop('checked') ) {
                if ($("#select-nombre-docente").val()=='') {
                    error+='Debe existir un docente programado.<br>';
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
