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
                  <!-- Nav tabs -->
                  <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#hoy<?php echo $capts; ?>" aria-controls="hoy<?php echo $capts; ?>" role="tab" data-toggle="tab">Hoy</a></li>
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
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0) {echo round(intval($dat['RegistrosHoy']['total'])/(intval($dat['RegistrosHoy']['minutos'])/60),1); } else echo "0"; ?></td>
                          </tr>
                          <tr>
                            <td>Tiempo promedio por registro</td>
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0) { echo round(intval($dat['RegistrosHoy']['minutos'])/intval($dat['RegistrosHoy']['total']),1); } else echo "0"; ?> min</td>
                          </tr>
                          <tr>
                            <td>Efectividad</td>
                            <td class="text-center"><?php if ($dat['RegistrosHoy']['total'] > 0 && $dat['Registros']['total'] > 0) { echo round(((intval($dat['Registros']['minutos'])/intval($dat['Registros']['total']))/(intval($dat['RegistrosHoy']['minutos'])/intval($dat['RegistrosHoy']['total'])))*100,2); } else echo "0"; ?> %</td>
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
                            <td class="text-center"><?php if ($dat['Registros']['total'] > 0) { echo round(intval($dat['Registros']['total'])/(intval($dat['Registros']['minutos'])/60),1); } else echo "0";?></td>
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
