<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<!-- Formulario para agregar contactos al directorio -->
<section class="capturistaSection container-fluid">
  <ul class="nav nav-tabs" id="rolCapturistas" role="tablist">
    <?php
      $capts = "";
      $nombreCompleto = "";
      $contando = 0;
      foreach( $capturistas as $row ){
        $capts = "capt-".$row['id'];
        $nombreCompleto = $row['nombre']." ".$row['apellido'];
    ?>
      <li role="presentation" class="<?php if($contando == 0 ) echo "active";?>"><a href="#<?php echo $capts; ?>" aria-controls="<?php echo $capts; ?>" role="tab" data-toggle="tab"><span><?php echo $nombreCompleto; ?></span></a></li>
    <?php $contando++;}//fin del foreach?>
  </ul>
  <div class="tab-content" id="contenido">
    <?php
      $pays = "";
      $contador = 0;
      foreach( $capturistas as $dat ){
        $pays = "capt-".$dat['id'];
    ?>
      <div class="tab-pane fade <?php if($contador ==  0) echo "in active";?>" id="<?php echo $pays; ?>">
        <div class="panel">
          <div class="panel-body">
            <div class="row">
              <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="media">
                  <div class="media-left" id="fotito">
                    <div class="img-thumbnail statusProfileIcon">
                      <span class="glyphicon glyphicon-headphones icon text-muted"></span>
                    </div>
                  </div>
                  <div class="media-body" id="cuerpoConNombre">
                    <p>
                      <span class="s20 text-uppercase"><?php echo $dat['nombre']; ?><small><?php $dat['apellido'];?></small></span>
                    </br>
                      <span class="s15 text-muted"><?php echo $dat['usuario'];?></span>
                    </br>
                      <span class="s15 text-muted"><?php echo $dat['correo']; ?></span>
                    </p>
                  </div>
                  <div class="media-right">
                    <button class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil s10 text-muted"></span></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default">
                  <div class="panel-heading">
                    <h3 class="panel-title">status</h3>
                  </div>
                  <div class="panel-body">
                    <div class="media">
                      <div class="media-body">
                        <div class="row">
                          <div class="col-md-6">
                            <p>

                            </p>
                          </div>
                          <div class="col-md-6">
                            <p>
                              Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                            </p>
                          </div>
                        </div>
                      </div>
                      <div class="media-right text-center">
                        <h1>100%</h1>
                        <small class="s15">efectividad</small>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php $contador++;}?>
  </div>
</section>
<!-- FIN TERCER SECCION -->
