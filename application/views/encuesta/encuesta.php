<h2>Encuesta de medicos</h2>

<?php if ($status === 1 || $status === 2) {?>
<form method="POST" action="/encuesta-intermed-mx/encuesta" onsubmit="comprobar()">
<input type="hidden" name="continuar" id="continuar">
<?php echo $contenido; ?>
<input onclick="guardarysalir()" type="submit" value="Guardar y salir" style="width:200px;margin-top:50px;height:40px;">
<input onclick="guardarycontinuar()" type="submit" value="Guardar y continuar" style="width:200px;margin-top:50px;height:40px;"><br/>
<input type="button" value="<<Anterior" style="width:200px;margin-top:50px;height:40px;">
<input type="button" value="Siguiente>>" style="width:200px;margin-top:50px;height:40px;">
<?php } else {
  echo $contenido;
}?>
</form>

<script type="text/javascript">
  function guardarysalir(){
    $('#continuar').val('0');
  }

  function guardarycontinuar(){
    $('#continuar').val('1');
  }

  function comprobar(){
    var arrText= $('input').map(function(){
      if (!this.value){
        this.name = '';
      }
    }).get();
  }

  function LimpiarComplementos(id, comp){
    $("input[name='complemento_" + id +"']").each(function() {
        $(this).val('');
        $(this).prop('required',false);
    });
    if ($('#complemento_' + id + '_' + comp)){
      $('#complemento_'+ id +'_' + comp).prop('required',true);
      $('#complemento_' + id + '_' + comp).focus();
    }
  }

  function aceptarPromocion(){
    var value = $('#promo').prop('checked');
    if (value == true){
      var contenido = '<form method="POST" action="newsletter"><div class="form-group"><label for="nombre">Nombre:</label><input type="text" class="form-control" id="nombre" name="nombre" required></div><div class="form-group"><label for="email">Correo:</label><input type="email" name="email" class="form-control" id="email" required></div><input type="submit" value="Enviar"></form>';
      $('#contenido').html(contenido);
    }else {
      $('#contenido').html('');
    }
  }
</script>
