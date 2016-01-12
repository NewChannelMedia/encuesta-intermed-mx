<div class="container flama-normal">
<div class="encuesta-logo"><img src="<?=base_url()?>img/logos/intermed.png" class="img-responsive center-block"></div>

<div class="encuesta-body">

<?php if (($encuesta_id != "" || $encuesta_id == null) && !$finalizar) {?>
  <div class="encuesta-title s20">
    Por favor conteste las siguientes preguntas seleccionando las opciones que correspondan.<br/>
    <span class="">(La encuesta es de carácter anónimo)</span>
  </div>

  <form method="POST" action="<?= base_url() ?>encuesta" onsubmit="comprobar()" id="formEnc"  class="form-inline">
  <input type="hidden" name="codigo" value="<?php echo $codigo; ?>">
  <input type="hidden" name="continuar" id="continuar">
  <input type="hidden" name="irEtapa" id="irEtapa">

  <div id="contenido" class="block-container">
    <div class="block-container-progress">
      <div id="progress-title">
      AVANCE.
      </div>
      <div class="progress" id="progress-bar" >
        <div class="progress-bar" id="progress-bar-current" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: <?php echo $terminado*(100/$cantEtapas) ?>%;" title=""  data-toggle="popover" data-content="<?php echo number_format((float)$terminado*(100/$cantEtapas), 0, '.', ''); ?>%" data-placement="top" >
        </div>
      </div>
    </div>
    <div class="preguntas-container<?php echo $contestada; ?>">
      <?php echo $contenido; ?>
    </div>
  </div>
  <div class="row" id="btn-encuesta">
    <?php if ($etapa > 1 && $etapa < $cantEtapas){?>
      <!--
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
        <a class="nav-enc pull-left" onclick="regresar()" type="submit"><span class="glyphicon glyphicon-chevron-left"></span>Anterior</a>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6" >
        <a class="nav-enc pull-right" onclick="siguiente()" type="submit">Siguiente<span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>-->
    <?php } elseif ($etapa > 1){ ?>
      <!--
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <a class="nav-enc pull-left" onclick="regresar()" type="submit"><span class="glyphicon glyphicon-chevron-left"></span>Anterior</a>
      </div>-->
    <?php } elseif ($etapa < $cantEtapas){ ?>
      <!--
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" >
        <a class="nav-enc pull-right" onclick="siguiente()" type="submit">Siguiente<span class="glyphicon glyphicon-chevron-right"></span></a>
      </div>
      -->
    <?php } ?>
    <?php if (!($tipoCodigo == 2 && $status == 3)){ ?>
    <div class="col-lg-6 col-md-6 col-sm-7 col-xs-7 pull-right">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-xs-8 pull-right">
          <input onclick="guardarycont()" id="btnguardarycontinuar"  class="btn notEnabled" type="button" value="Guardar y continuar >">
        </div>
        <div class="col-lg-4 col-md-4 col-xs-8 pull-right">
          <input onclick="guardarysal()" id="btnguardarysalir"  class="btn notEnabled" type="button" value="Guardar y salir"><br/>
        </div>
        <div class="col-lg-4 col-md-4 col-xs-12 text-right">
          <span class="text-right">Retoma la encuesta volviendo a ingresar con tu código</span>
        </div>
      </div>
    </div>
    <?php } ?>
    <div class="col-lg-6 col-md-6 col-sm-5 col-xs-5 pull-left">
      <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-10 col-xs-12">
          <input onclick="salir()" id="btnsalir" class="btn col-lg-12" type="button" value="Salir" >
        </div>
      </div>
    </div>
  </div>
  <div class="row" style="margin-top:10px">
    <div class="col-lg-4 col-md-4 col-sm-6 col-xs12 pull-right" id="encError">
    </div>
  </div>
</div>
<?php } else {
  echo $contenido;
}?>
</form>
</div>

<script type="text/javascript">
history.pushState(null, null, location.href);
window.onpopstate = function(event) {
    history.go(1);
};</script>
