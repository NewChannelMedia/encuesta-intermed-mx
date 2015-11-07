<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<div class="container-fluid flama-light">
  <div class="row">
    <div class="col-lg-12 col-md-12">
      <h3>Bienvenido <?php echo $administrador; ?></h3>
      <h4 id="mensaje"></h4>
    </div>
  </div>
  <div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-primary">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-4">
              <span class="glyphicon glyphicon-ok-sign s60"></span>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge"><?php echo $totalContestadas; ?></div>
              <div>Encuestas contestadas</div>
            </div>
          </div>
        </div>
        <a href="<?=base_url()?>admin/resultados">
          <div class="panel-footer">
            <span class="pull-left">Ver Detalles</span>
            <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-green">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-4">
              <span class="glyphicon glyphicon-info-sign s60"></span>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge"><?php echo $totalPorValidar;?></div>
              <div>Solicitudes por aceptar</div>
            </div>
          </div>
        </div>
        <a href="<?=base_url()?>admin/solicitudes">
          <div class="panel-footer">
            <span class="pull-left">Ver Detalles</span>
            <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-yellow">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-4">
              <span class="glyphicon glyphicon-plus-sign s60"></span>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge"><?php echo $totalNewsletter;?></div>
              <div>Suscripciones nuevas</div>
            </div>
          </div>
        </div>
        <a href="<?=base_url()?>admin/suscritos">
          <div class="panel-footer">
            <span class="pull-left">Ver Detalles</span>
            <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-6">
      <div class="panel panel-red">
        <div class="panel-heading">
          <div class="row">
            <div class="col-xs-4">
              <span class="glyphicon glyphicon-question-sign s60"></span>
            </div>
            <div class="col-xs-8 text-right">
              <div class="huge"><?php echo $totalMensajes;?></div>
              <div>Mensajes nuevos</div>
            </div>
          </div>
        </div>
        <a href="<?=base_url()?>admin/mensajes">
          <div class="panel-footer">
            <span class="pull-left">Ver Detalles</span>
            <span class="pull-right"><span class="glyphicon glyphicon-chevron-right"></span></span>
            <div class="clearfix"></div>
          </div>
        </a>
      </div>
    </div>
  </div>
</div><!-- /.container -->
