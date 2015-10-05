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
