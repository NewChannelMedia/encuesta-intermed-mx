<div class="seleccionador">
  <label>Elige una opción ¿ Es usted ?</label>
  Medico<input type = "radio" id = "medicoRadio" name = "check" /><br />
  Usuario<input type = "radio" id = "usuarioRadio" name = "check" /><br />
</div>
<hr />
<script>
  $(document).ready(function(){
    $("#celudas").hide();
    $("#user_n").hide();
    $("#medicoRadio").click(function(){
      $("#celudas").show();
      $("#user_n").hide();
    });
    $("#usuarioRadio").click(function(){
      $("#user_n").show();
      $("#celudas").hide();
    });
  });
</script>
<div class = "medico">
  <form id = "celudas" action = "<?php echo base_url(); ?>porValidar/insertNC" method = "POST">
      Nombre: <input type = "text" id = "nombre" name = "nombre" maxlength="80" placeholder="Nombre:"/><br />
      Cedula: <input type = "text" id = "cedula" name = "cedula" maxlength="20" placeholder="Cedula"/> <br />
      <input type = "hidden" name = "correoOculto" value = "<?php echo $correito; ?>" /><br />
      <input type = "submit" value = "Enviar" id = "envioCN"/>
  </form>
</div>
<hr />
<div class = "usuario">
  <form id ="user_n" action = "<?=  base_url()  ?>porValidar/usuario" method = "POST">
    Nombre:<input type = "text" id = "usuario_nombre" name = "usuario_nombre" placeholder="Nombre:"/><br />
    <label>¿ Cual es la razón para entrar a esta encuesta ?</label>
    <input type = "textarea" id = "justificacion" name = "justificacion" placeholder="Justificacion"/><br />
    <input type = "hidden" name = "usuarioOculto" value = "<?php echo $correito; ?>" /><br />
    <input type = "submit" value = "Enviar" />
  </form>
</div>
