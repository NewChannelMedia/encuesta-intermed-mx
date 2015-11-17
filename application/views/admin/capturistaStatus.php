<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<!-- Formulario para agregar contactos al directorio -->
<section class="capturistaSection container-fluid" id="prueba">
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
                  <div class="media-body">
                    <p>
                      <span class="s20 text-uppercase">
                        <span id="<?php echo "spanNomre-".$dat['id']; ?>" >
                          <?php echo $dat['nombre']; ?>&nbsp;
                        </span>
                        <small>
                          <span id="<?php echo "spanApe-".$dat['id']; ?>" >
                            <?php echo $dat['apellido'];?>
                          </span>
                        </small>
                      </span>
                    </br>
                      <span id="<?php echo "spanUser-".$dat['id']; ?>" class="s15 text-muted"><?php echo $dat['usuario'];?></span>
                    </br>
                      <span id="<?php echo "spanMail-".$dat['id']; ?>" class="s15 text-muted"><?php echo $dat['correo']; ?></span>
                    </p>
                  </div>
                  <div class="media-right">
                    <button onclick="getId('<?php echo "edit-".$dat['id'];?>','<?php echo "dinamico-".$dat['id']; ?>');"id="edit-<?php echo $dat['id']; ?>" class="btn btn-sm btn-default"><span class="glyphicon glyphicon-pencil s10 text-muted"></span></button>
                    <button onclick="deleteCapturista('<?php echo $dat["id"]; ?>','<?php echo $dat["id_maestro"]; ?>');" class="btn btn-sm btn-danger"><span class="glyphicon glyphicon-remove-sign s10"></span></button>
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
                    <?php
                      $spanNomre = "spanNomre-".$dat['id'];
                      $spanUser = "spanUser-".$dat["id"];
                      $spanMail = "spanMail-".$dat["id"];
                      $dinamico2 = "dinamico-".$dat['id'];
                      $spanApe = "spanApe-".$dat['id'];
                    ?>
                    <button onclick="actualizarData('<?php echo $dat["id"]; ?>','<?php echo $dat["id_maestro"]; ?>','<?php echo $nombreCam; ?>','<?php echo $apellidoCam; ?>','<?php echo $usuarioCam; ?>','<?php echo $correoCam; ?>','<?php echo $passwordCam; ?>','<?php echo $spanNomre; ?>','<?php echo $spanApe; ?>','<?php echo $spanUser; ?>','<?php echo $spanMail; ?>','<?php echo $dinamico2; ?>');"class="btn btn-sm btn-success"><span class="glyphicon glyphicon-eye-open s10"></span></button>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#hoy<?php echo $capts; ?>" aria-controls="hoy<?php echo $capts; ?>" role="tab" data-toggle="tab">Hoy</a></li>
                    <li role="presentation"><a href="#ayer<?php echo $capts; ?>" aria-controls="ayer<?php echo $capts; ?>" role="tab" data-toggle="tab">Ayer</a></li>
                    <li role="presentation"><a href="#total<?php echo $capts; ?>" aria-controls="total<?php echo $capts; ?>" role="tab" data-toggle="tab">Totales</a></li>
                  </ul>

                  <!-- Tab panes -->
                  <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="hoy<?php echo $capts; ?>">
                      <br/>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <table class="table">
                        <thead>
                          <tr>
                            <th style="width:80%">Cualidad</th>
                            <th class="text-center">Resultado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Total de registros</td>
                            <td class="text-center"><?php echo $dat['RegistrosHoy']['total']; ?></td>
                          </tr>
                          <tr>
                            <td>Registros por hora</td>
                            <?php
                            if ((intval($dat['RegistrosHoy']['minutos'])/60) > 0){
                              $prom = (intval($dat['RegistrosHoy']['minutos'])/60);
                            } else {
                              $prom = 1;
                            } ?>
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0) {echo round(intval($dat['RegistrosHoy']['total'])/$prom,1); } else echo "0"; ?></td>
                          </tr>
                          <tr>
                            <td>Tiempo promedio por registro</td>
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0) { echo round(intval($dat['RegistrosHoy']['minutos'])/intval($dat['RegistrosHoy']['total']),1); } else echo "0"; ?> min</td>
                          </tr>
                          <tr>
                            <td>Efectividad</td>
                            <?php
                            if (intval($dat['RegistrosHoy']['total']) > 0){
                              $prom = intval($dat['RegistrosHoy']['total']);
                            } else {
                              $prom = 1;
                            }
                            if (intval($dat['Registros']['total'])>0){
                              $prom2 = intval($dat['Registros']['total']);
                            } else {
                              $prom2 = 1;
                            }
                            if (intval($dat['RegistrosHoy']['minutos'])>0){
                              $prom3 = intval($dat['RegistrosHoy']['minutos']);
                            } else {
                              $prom3 = 1;
                            }
                            ?>
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0 && $dat['Registros']['total'] > 0) { echo round(((intval($dat['Registros']['minutos'])/$prom2)/($prom3/$prom))*100,2); } else echo "0"; ?> %</td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                        TOTALES<br/><span style="font-size:500%">
                        <?php echo $dat['RegistrosHoy']['total']; ?>
                      </span>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="ayer<?php echo $capts; ?>">
                      <br/>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <table class="table">
                        <thead>
                          <tr>
                            <th style="width:80%">Cualidad</th>
                            <th class="text-center">Resultado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Total de registros</td>
                            <td class="text-center"><?php echo $dat['RegistrosAyer']['total']; ?></td>
                          </tr>
                          <tr>
                            <td>Registros por hora</td>
                            <?php
                              if ((intval($dat['RegistrosAyer']['minutos'])/60)>0){
                                $prom = (intval($dat['RegistrosAyer']['minutos'])/60);
                              } else {
                                $prom = 1;
                              }
                             ?>
                            <td class="text-center"><?php if ($dat['RegistrosAyer']['total'] > 0) {echo round(intval($dat['RegistrosAyer']['total'])/$prom,1); } else echo "0"; ?></td>
                          </tr>
                          <tr>
                            <td>Tiempo promedio por registro</td>
                            <td class="text-center"><?php if ($dat['RegistrosAyer']['total'] > 0) { echo round(intval($dat['RegistrosAyer']['minutos'])/intval($dat['RegistrosAyer']['total']),1); } else echo "0"; ?> min</td>
                          </tr>
                          <tr>
                            <td>Efectividad</td>
                            <?php
                            if ((intval($dat['RegistrosAyer']['minutos'])/intval($dat['RegistrosAyer']['total'])) > 0){
                              $prom = (intval($dat['RegistrosAyer']['minutos'])/intval($dat['RegistrosAyer']['total']));
                            } else {
                              $prom = 1;
                            }
                            if (intval($dat['Registros']['total'])>0){
                              $prom2 = intval($dat['Registros']['total']);
                            } else {
                              $prom2 = 1;
                            }
                            ?>
                            <td class="text-center"><?php if ($dat['RegistrosAyer']['total'] > 0 && $dat['Registros']['total'] > 0) { echo round(((intval($dat['Registros']['minutos'])/$prom2)/$prom)*100,2); } else echo "0"; ?> %</td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                        TOTALES<br/><span style="font-size:500%">
                        <?php echo $dat['RegistrosAyer']['total']; ?>
                      </span>
                      </div>
                    </div>
                    <div role="tabpanel" class="tab-pane" id="total<?php echo $capts; ?>">
                      <br/>
                      <div class="col-lg-8 col-md-8 col-sm-8 col-xs-8">
                        <table class="table">
                        <thead>
                          <tr>
                            <th style="width:80%">Cualidad</th>
                            <th class="text-center">Resultado</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td>Total de registros</td>
                            <td class="text-center"><?php echo $dat['Registros']['total']; ?></td>
                          </tr>
                          <tr>
                            <td>Registros por hora</td>
                            <?php
                            if ((intval($dat['Registros']['minutos'])/60) > 0){
                              $prom = (intval($dat['Registros']['minutos'])/60);
                            } else {
                              $prom = 1;
                            } ?>
                            <td class="text-center"><?php if ($dat['Registros']['total'] > 0) { echo round(intval($dat['Registros']['total'])/$prom,1); } else echo "0";?></td>
                          </tr>
                          <tr>
                            <td>Tiempo promedio por registro</td>
                            <td class="text-center"><?php if ($dat['Registros']['total'] > 0) { echo round(intval($dat['Registros']['minutos'])/intval($dat['Registros']['total']),1); } else echo "0";?> min</td>
                          </tr>
                        </tbody>
                      </table>
                      </div>
                      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                        TOTALES<br/><span style="font-size:500%">
                        <?php echo $dat['Registros']['total']; ?>
                        </span>
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
