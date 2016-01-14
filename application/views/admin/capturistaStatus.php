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

                <ul class="nav nav-tabs" role="tablist" style="margin-left:-15px;margin-right: -15px;">
                  <li role="presentation" class="active"><a href="#captura<?php echo $contador; ?>" aria-controls="captura<?php echo $contador; ?>" role="tab" data-toggle="tab">Capturas</a></li>
                  <li role="presentation"><a href="#llamadas<?php echo $contador; ?>" aria-controls="llamadas<?php echo $contador; ?>" role="tab" data-toggle="tab">Llamadas</a></li>
                </ul>
                <div class="tab-content">
                  <div role="tabpanel" class="tab-pane active" id="captura<?php echo $contador; ?>">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" style="margin-left:-15px;margin-right: -15px;margin-top:5px">
                      <li role="presentation" class="active"><a href="#hoy<?php echo $contador; ?>" aria-controls="hoy<?php echo $contador; ?>" role="tab" data-toggle="tab">Hoy</a></li>
                      <li role="presentation"><a href="#ayer<?php echo $contador; ?>" aria-controls="ayer<?php echo $contador; ?>" role="tab" data-toggle="tab">Ayer</a></li>
                      <li role="presentation"><a href="#total<?php echo $contador; ?>" aria-controls="total<?php echo $contador; ?>" role="tab" data-toggle="tab">Totales</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="hoy<?php echo $contador; ?>">
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
                      <div role="tabpanel" class="tab-pane" id="ayer<?php echo $contador; ?>">
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
                              if ((intval($dat['RegistrosAyer']['total'])) > 0){
                                $prom = (intval($dat['RegistrosAyer']['minutos'])/intval($dat['RegistrosAyer']['total']));
                              } else {
                                $prom = intval($dat['RegistrosAyer']['minutos']);
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
                      <div role="tabpanel" class="tab-pane" id="total<?php echo $contador; ?>">
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
                  <div role="tabpanel" class="tab-pane" id="llamadas<?php echo $contador; ?>">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist" style="margin-left:-15px;margin-right: -15px;margin-top:5px">
                      <li role="presentation" class="active"><a href="#hoyllamadas<?php echo $contador; ?>" aria-controls="hoyllamadas<?php echo $contador; ?>" role="tab" data-toggle="tab">Hoy</a></li>
                      <li role="presentation"><a href="#ayerllamadas<?php echo $contador; ?>" aria-controls="ayerllamadas<?php echo $contador; ?>" role="tab" data-toggle="tab">Ultimos 5 días</a></li>
                      <li role="presentation"><a href="#totalllamadas<?php echo $contador; ?>" aria-controls="totalllamadas<?php echo $contador; ?>" role="tab" data-toggle="tab">Totales</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                      <div role="tabpanel" class="tab-pane active" id="hoyllamadas<?php echo $contador; ?>">
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
                                <td>Total de llamadas</td>
                                <td class="text-center"><?php echo ($dat['RegistrosHoyLlamadasAut']['total']+$dat['RegistrosHoyLlamadasNoAut']['total']); ?></td>
                              </tr>
                              <tr>
                                <td>Autorizadas</td>
                                <td class="text-center"><?php echo $dat['RegistrosHoyLlamadasAut']['total']; ?></td>
                              </tr>
                              <tr>
                                <td>No autorizadas</td>
                                <td class="text-center"><?php echo $dat['RegistrosHoyLlamadasNoAut']['total']; ?></td>
                              </tr>
                              <tr>
                                <td>Tiempo promedio por llamada</td>
                                <td class="text-center"><?php echo $minutos = round((($dat['RegistrosHoyLlamadasAut']['minutos']-$dat['RegistrosHoyLlamadasNoAut']['minutos'])/($dat['RegistrosHoyLlamadasAut']['total']+$dat['RegistrosHoyLlamadasNoAut']['total'])),2) ?> min</td>
                              </tr>
                              <tr>
                                <td>Promedio de llamadas por hora (según tiempo promedio por llamada)</td>
                                <td class="text-center"><?php if ($minutos < 60 && $minutos > 0){ echo round((60/$minutos),2); }else echo "1";?></td>
                              </tr>
                            <tr>
                              <td>Efectividad</td>
                              <td class="text-center"><?php echo round((($dat['RegistrosHoyLlamadasNoAut']['total']+$dat['RegistrosHoyLlamadasAut']['total'])/(($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total'])/$dat['totalFechasLlamadas']))*100,2) ?> %</td>

                            </tr>
                          </tbody>
                        </table>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                          TOTALES<br/><span style="font-size:500%">
                          <?php echo $dat['RegistrosHoyLlamadasAut']['total']; ?>
                        </span>
                        </div>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="ayerllamadas<?php echo $contador; ?>">

                        <?php foreach ($dat['RegistrosLlamadasAnteriores'] as $registroDiaAnterior){ ?>
                          <br/>
                          <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2">
                            <h3><?php echo $registroDiaAnterior['dia']; ?></h3>
                          </div>
                          <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10">
                            <table class="table">
                            <thead>
                              <tr>
                                <th style="width:80%">Cualidad</th>
                                <th class="text-center">Resultado</th>
                              </tr>
                            </thead>
                            <tbody>
                                <tr>
                                  <td>Total de llamadas</td>
                                  <td class="text-center"><?php echo ($registroDiaAnterior['aut']['total']+$registroDiaAnterior['noaut']['total']); ?></td>
                                </tr>
                                <tr>
                                  <td>Autorizadas</td>
                                  <td class="text-center"><?php echo $registroDiaAnterior['aut']['total']; ?></td>
                                </tr>
                                <tr>
                                  <td>No autorizadas</td>
                                  <td class="text-center"><?php echo $registroDiaAnterior['noaut']['total']; ?></td>
                                </tr>
                                <tr>
                                  <td>Promedio de llamadas por hora (según tiempo promedio por llamada)</td>
                                  <td class="text-center"><?php if ($minutos < 60 && $minutos > 0){ echo round((60/$minutos),2); }else echo "¿?";?></td>
                                </tr>
                              <tr>
                                <td>Efectividad</td>
                                <td class="text-center"><?php echo round((($registroDiaAnterior['aut']['total']+$registroDiaAnterior['noaut']['total'])/(($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total'])/$dat['totalFechasLlamadas']))*100,2) ?> %</td>
                              </tr>
                            </tbody>
                          </table>
                          </div>

                        <?php } ?>
                      </div>
                      <div role="tabpanel" class="tab-pane" id="totalllamadas<?php echo $contador; ?>">
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
                              <td>Total de llamadas</td>
                              <td class="text-center"><?php echo ($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total']); ?></td>
                            </tr>
                            <tr>
                              <td>Autorizadas</td>
                              <td class="text-center"><?php echo $dat['RegistrosLlamadasAut']['total']; ?></td>
                            </tr>
                            <tr>
                              <td>No autorizadas</td>
                              <td class="text-center"><?php echo $dat['RegistrosLlamadasNoAut']['total']; ?></td>
                            </tr>
                            <tr>
                              <td>Tiempo promedio por llamada</td>
                              <td class="text-center"><?php if (($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total']) > 0) { echo round(intval(($dat['RegistrosLlamadasAut']['minutos']+$dat['RegistrosLlamadasNoAut']['minutos']))/intval(($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total'])),1); } else echo "0";?> min</td>
                            </tr>
                          </tbody>
                        </table>
                        </div>
                        <div class="col-lg-4 col-md-4 col-sm-4 col-xs-4 text-center">
                          TOTALES<br/><span style="font-size:500%">
                          <?php echo ($dat['RegistrosLlamadasAut']['total']+$dat['RegistrosLlamadasNoAut']['total']); ?>
                          </span>
                        </div>
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
