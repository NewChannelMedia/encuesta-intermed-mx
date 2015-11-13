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
                      <span class="s20 text-uppercase"><?php echo $dat['nombre']; ?>&nbsp;<small><?php echo $dat['apellido'];?></small></span>
                    </br>
                      <span class="s15 text-muted"><?php echo $dat['usuario'];?></span>
                    </br>
                      <span class="s15 text-muted"><?php echo $dat['correo']; ?></span>
                    </p>
                  </div>
                  <div class="media-right">
                    <button onclick="getId('<?php echo "edit-".$dat['id'];?>','<?php echo "dinamico-".$dat['id']; ?>');"id="edit-<?php echo $dat['id']; ?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil s10 text-muted"></span></button>
                  </div>
                </div>
              </div>
              <!-- NOO -->
              <div class="col-lg-6 col-md-6 col-sm-8 col-xs-12">
                <div class="media hidden" id="<?php echo "dinamico-".$dat['id']; ?>">
                  <div class="media-body">
                      <?php
                        $nombreCam = "nombre-".$dat['id'];
                        $apellidoCam = "apellido-".$dat['id'];
                        $usuarioCam = "usuario-".$dat['id'];
                        $correoCam = "correo-".$dat['id'];
                        $passwordCam = "pass-".$dat['id'];
                      ?>
                      <div class="form-group col-md-6">
                        <label for="<?php echo $nombreCam; ?>">Nombre(s):</label>
                        <input type="text" class="form-control" id="<?php echo $nombreCam; ?>" placeholder="Nombre(s):" value ="<?php echo $dat['nombre']; ?>"/>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="<?php echo $apellidoCam; ?>">Apellido(s):</label>
                        <input type="text" class="form-control" id="<?php echo $apellidoCam; ?>" placeholder="Apellido(s):" value="<?php echo $dat['apellido'];?>" />
                      </div>
                    </br>
                      <div class="form-group col-md-6">
                        <label for="<?php echo $usuarioCam; ?>">Usuario:</label>
                        <input type="text" class="form-control" id="<?php echo $usuarioCam; ?>" placeholder="Usuario:" value="<?php echo $dat['usuario']; ?>"/>
                      </div>
                    </br>
                      <div class="form-group col-md-6">
                        <label for="<?php echo $correoCam; ?>">Correo:</label>
                        <input type="email" class="form-control" id="<?php echo $correoCam; ?>" placeholder="E-mail:" value="<?php echo $dat['correo']; ?>" />
                      </div>
                      <div class="form-group col-md-6">
                        <label for="<?php echo $passwordCam; ?>">Password:</label>
                        <input type="password" class="form-control" id="<?php echo $passwordCam;?>" placeholder="Password:"/>
                      </div>
                  </div>
                  <div class="media-right">
                    <button onclick="actualizarData('<?php echo $dat["id"]; ?>','<?php echo $nombreCam; ?>','<?php echo $apellidoCam; ?>','<?php echo $usuarioCam; ?>','<?php echo $correoCam; ?>','<?php echo $passwordCam; ?>');"class="btn btn-sm btn-success"><span class="glyphicon glyphicon-eye-open s10"></span></button>
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
