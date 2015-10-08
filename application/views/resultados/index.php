<div class="container">
<div class="row">
<h2>Resultado de las encuestas</h2>
</div>
<?php  $totalChar = 0; $primero = true;?>
<?php foreach ($resultado as $categoria){?>
  <?php foreach ($categoria as $preguntas){ ?>
    <?php if (!is_array($preguntas)){ ?>
      <?php if (array_search($categoria, $resultado)>0) echo '</div>';?>
        <div class="row">
        <h2><?php echo $preguntas ?></h2>
    <?php } else {?>
      <?php foreach ($preguntas as $pregunta){ ?>
          <?php $data = array(); $complemento=false;?>

          <?php foreach ($pregunta['respuestas'] as $respuesta){
              if (is_array($respuesta['respuesta'])){
                foreach ($respuesta['respuesta'] as $resp => $total) {
                    if (!is_array($total)){
                      if (!empty($resp)){
                        $data[] = array('label' => $resp, 'value' => $total);
                      }
                    } else {
                      if (!empty($resp)){
                        if (count($total['comp'])>0){
                          $complemento = [];
                          foreach ($total['comp'] as $comp => $compt) {
                            array_push($complemento, array('total' => $compt, 'comp' => $comp));
                          }
                          $data[] = array('label' => $resp, 'value' => $total['total'], 'complemento' => $complemento);
                          //echo '<pre>'. print_r(array('label' => $resp, 'value' => $total['total'], 'complemento' => $complemento),1) .'</pre>';
                          $complemento = true;
                        } else {
                          $data[] = array('label' => $resp, 'value' => $total['total']);
                        }
                      }
                  }
                }
              } else {
                if (!empty($respuesta['respuesta'])){
                  if (array_key_exists('complemento', $respuesta)){
                    $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total'], 'complemento' => $respuesta['complemento']);
                  } else {
                      $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total']);
                  }
                }
              }
            }

            $divId = 'pregunta_' . $totalChar++;

            $tipo = rand(1,6);

            switch ($tipo) {
                case 1:
                    $tipo = "Bar";
                    break;
                case 2:
                    $tipo = "Radar";
                    break;
                case 3:
                    $tipo = "Pie";
                    break;
                case 4:
                    $tipo = "Polar";
                    break;
                case 5:
                    $tipo = "Doughnut";
                    break;
                case 6:
                    $tipo = "Line";
                    break;
            }
            ?>

            <div class="col-lg-4 col-md-6">
            <div class="panel panel-default">
            <div class="panel-heading">
            <?php echo $pregunta['pregunta'] ?>
            <div class="btn-group pull-right">
                <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                </button>
                <ul class="dropdown-menu list-inline" role="menu">
                  <?php
                      if ($complemento) echo '<span style="color:white">***</span>';
                      $enviar = array('element' => $divId, 'data' => $data);
                      $checked = ($tipo == "Bar")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartBar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Barras</label>';
                      $checked = ($tipo == "Radar")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartRadar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Radio</label>';
                      $checked = ($tipo == "Pie")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartPie('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Circular</label>';
                      $checked = ($tipo == "Doughnut")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartDoughnut('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Dona</label>';
                      $checked = ($tipo == "Polar")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartPolar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Polar</label>';
                      $checked = ($tipo == "Line")? 'checked':'';
                      echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartLine('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Linea</label>';
                  ?>
                </ul>
            </div>
            </div>
            <div class="panel-body">

            <?php


              echo '<div class="col-md-12" id="'. $divId .'">';
              echo '</div>';
              echo '<div class="col-md-1" ></div>';
              echo '<div class="col-md-2 complemento" id="'. $divId .'_complemento"></div>';
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { Chart'. $tipo .'('.json_encode($enviar).') })</script>';
        ?>
        </div>
        </div>
        </div>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php } ?>
</div>
