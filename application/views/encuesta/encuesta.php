<div class="container">
<h2>Encuesta de medicos</h2>

<?php if (($status === 1 || $status === 2) && !$finalizar) {?>
  <form method="POST" action="/encuesta-intermed-mx/encuesta" onsubmit="comprobar()" id="formEnc">
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
  <input type="hidden" name="continuar" id="continuar">
  <input type="hidden" name="irEtapa" id="irEtapa">

  <div id="contenido">
    <?php echo $contenido; ?>
  </div>
  <input onclick="salir()" class="btn btn-md btn-danger" type="button" value="Salir" style="width:200px;margin-top:30px;">
  <input onclick="guardarysal()" id="guardarysalir" class="btn btn-md btn-default pull-right " disabled type="button" value="Guardar y salir" style="width:200px;margin-top:30px;">
  <input onclick="guardarycont()" id="guardarycontinuar" class="btn btn-md btn-default pull-right" disabled type="button" value="Guardar y continuar" style="width:200px;margin-top:30px;"><br/>
  <?php if ($etapa > 1){?>
  <a style="float: left" onclick="regresar()" type="submit" style="width:200px;margin-top:50px;height:40px;">&#60;&#60;Anterior</a>
  <?php } ?>
  <?php if ($etapa < 4){ ?>
  <a style="float: right" onclick="siguiente()" type="submit" style="width:200px;margin-top:50px;height:40px;">Siguiente&#62;&#62;</a>
  <?php } ?>
<?php } else {
  echo $contenido;
}?>
</form>
</div>

<script type="text/javascript">
  history.go(1);

  $(document).ready(function() {
    validarFormulario();
  });

  $(function() {
    $( "·sortable" ).sortable({
      placeholder: "ui-state-highlight"
    });
    $( ".sortable" ).disableSelection();
  });

  $( ".sortable" ).sortable({
    stop: function( event, ui ) {
      var count = 1;
      var opciones = $( ".sortable" ).find( "input[type=hidden]" ).each(function (index, element) {
          $(element).val(count++);
      });
    }
  });

  function guardarysal(){
    $('#continuar').val('0');
    $("#formEnc").submit();
  }

  function guardarycont(){
    $('#continuar').val('1');
    $( "#formEnc" ).submit();
  }

  function regresar(){
    $etapa = $('#etapaResp').val();
    $('#irEtapa').val(--$etapa);
    $('#contenido').html('');
    $( "#formEnc" ).submit();
  }

  function siguiente(){
    $etapa = $('#etapaResp').val();
    $('#irEtapa').val(++$etapa);
    $('#contenido').html('');
    $( "#formEnc" ).submit();
  }

  function comprobar(){
    var arrText= $('input').map(function(){
      if (!this.value){
        this.name = '';
      }
    }).get();
  }

  $('input').change(function(event) {
    validarFormulario();
  });

  function validarFormulario(){
      var continuar = true;
      var formulario = $('form#formEnc').serializeArray();
      $('input').each(function() {
        var field = $(this);
        if (field.prop('name').substring(0, 9) == "respuesta"){
          if (field.prop('type') == "radio"){
            //Buscar por lo menos uno
            var encontrado = false;
            formulario.forEach(function(form){
              if (form['name'] == field.prop('name')){
                encontrado = true;
              }
            });
            if (encontrado == false){
              continuar = false;
            }
          } else {
            if (field.prop('required') && field.prop('value') == ""){
              continuar = false;
            }
          }
        } else if (field.prop('name').substring(0, 11) == "complemento"){
          if (field.prop('required') && field.prop('value') == ""){
            continuar = false;
          }
        }
      });
      if (continuar){
        $('#guardarysalir').removeClass('btn-default');
        $('#guardarycontinuar').removeClass('btn-default');
        $('#guardarysalir').addClass('btn-warning');
        $('#guardarycontinuar').addClass('btn-success');
        $('#guardarysalir').attr("disabled", false);
        $('#guardarycontinuar').attr("disabled", false);
      } else {
        $('#guardarysalir').removeClass('btn-warning');
        $('#guardarycontinuar').removeClass('btn-success');
        $('#guardarysalir').addClass('btn-default');
        $('#guardarycontinuar').addClass('btn-default');
        $('#guardarysalir').attr("disabled", true);
        $('#guardarycontinuar').attr("disabled", true);
      }
  }

  function salir(){
    window.location.href = "/encuesta-intermed-mx";
  }

  function LimpiarComplementos(id, comp){
    $("input[name='complemento_" + id +"']").each(function() {
        $(this).val('');
        $(this).prop('required',false);
        $(this).prop('disabled',true);
    });
    if ($('#complemento_' + id + '_' + comp)){
      $('#complemento_'+ id +'_' + comp).prop('required',true);
      $('#complemento_'+ id +'_' + comp).prop('disabled',false);
      $('#complemento_' + id + '_' + comp).focus();
    }
  }

  function aceptarPromocion(){
    var value = $('#promo').prop('checked');
    if (value == true){
      var contenido = '<form method="POST" action="newsletter"><div class="form-group"><label for="nombre">Nombre:</label><input type="text" class="form-control" id="nombre" name="nombre" required></div><div class="form-group"><label for="email">Correo:</label><input type="email" name="email" class="form-control" id="email" required></div><input type="submit" value="Enviar"></form>';
      $('#contenido').html(contenido);
    }else {
      $('#contenido').html('<a href="/encuesta-intermed-mx">Ir a inicio</a>');
    }
  }
</script>
