<!--<table class="table table-striped gestionClase">
<tr>
<th>ID</th>
<th>NOMBRE</th>
<th>Activo/Inactivo</th>
<th>crear</th>
<th>editar</th>
<th>Lectura</th>
<th>Rol</th>
</tr>

<?php foreach($permisos as $p){ ?>
<tr>
<td><?php echo $p['PermisoFuncionalidad']['FUNCIONALIDAD_ID']; ?></td>
<td><?php echo $p['Funcionalidad']['NOMBRE']; ?></td>
<td><?php echo $p['Funcionalidad']['ACTIVO']; ?></td>
<td><?php echo $p['PermisoFuncionalidad']['CREAR']; ?></td>
<td><?php echo $p['PermisoFuncionalidad']['EDITAR']; ?></td>
<td><?php echo $p['PermisoFuncionalidad']['LECTURA']; ?></td>
<td><?php echo $p['PermisoFuncionalidad']['ROL_ID']; ?></td>
</tr>	
<?php } ?>

</table>-->
<table class="table table-striped gestionClase">
<tr>
<th>ID</th>
<th>NOMBRES</th>
<th>RUT</th>
<th>COD_ASIGNATURA_HORARIO</th>
<th>CLASES_PRESENTE</th>
<th>CLASES_REGISTRADAS</th>
<th>RI</th>
<th>SIGLA_SECCION</th>
<th>OBSERVACIONES</th>
</tr>
<?php foreach($alumnos_im as $p){ ?>
<tr>
<td><?php echo $p['RI_IM']['ID']; ?></td>
<td><?php echo $p['RI_IM']['NOMBRES']; ?></td>
<td><?php echo $p['RI_IM']['RUT']; ?></td>
<td><?php echo $p['RI_IM']['COD_ASIGNATURA_HORARIO']; ?></td>
<td><?php echo $p['RI_IM']['CLASES_PRESENTE']; ?></td>
<td><?php echo $p['RI_IM']['CLASES_REGISTRADAS']; ?></td>
<td><?php echo $p['RI_IM']['RI']; ?></td>
<td><?php echo $p['RI_IM']['SIGLA_SECCION']; ?></td>
<td><?php echo $p['RI_IM']['OBSERVACIONES']; ?></td>
</tr> 
<?php } ?>
</table>

<button class="btn btn-primary" data-toggle="modal" data-target="#myModal2">
      Long modal
    </button>

<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModal2Label" aria-hidden="true" style="display: none;">
    <div class="modal-dialog">
      <div class="modal-content" style="overflow: hidden;">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title" id="myModal2Label">Modal title</h4>
        </div>
        <div class="modal-body" style="max-height: 386px; overflow-y: auto;">
        <?php echo $this->Form->create('Image', array('type' => 'file', 'class'=> 'dropzone')); ?>
              <fieldset>
                  <legend><?php echo __('Add Image'); ?></legend>
              <?php
                  echo $this->Form->input('Image.submittedfile', array(
                      'between' => '<br />',
                      'type' => 'file',
                      'label' => false
                  ));
                  // echo $this->Form->file('Image.submittedfile');
              ?>
             </fieldset>
          <?php echo $this->Form->end(__('Send My Image')); ?>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary">Save changes</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <script>

//$("div#myId").dropzone({ url: "/file/post" });


    	function setModalMaxHeight(element) {
  this.$element     = $(element);  
  this.$content     = this.$element.find('.modal-content');
  var borderWidth   = this.$content.outerHeight() - this.$content.innerHeight();
  var dialogMargin  = $(window).width() < 768 ? 20 : 60;
  var contentHeight = $(window).height() - (dialogMargin + borderWidth);
  var headerHeight  = this.$element.find('.modal-header').outerHeight() || 0;
  var footerHeight  = this.$element.find('.modal-footer').outerHeight() || 0;
  var maxHeight     = contentHeight - (headerHeight + footerHeight);

  this.$content.css({
      'overflow': 'hidden'
  });
  
  this.$element
    .find('.modal-body').css({
      'max-height': maxHeight,
      'overflow-y': 'auto'
  });
}

$('.modal').on('show.bs.modal', function() {
  $(this).show();
  setModalMaxHeight(this);
});

$(window).resize(function() {
  if ($('.modal.in').length != 0) {
    setModalMaxHeight($('.modal.in'));
  }
});
  </script>