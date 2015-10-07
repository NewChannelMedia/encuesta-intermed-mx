<h2>Resultado de las encuestas</h2>
<!--
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Donut Chart Example
        </div>
          <div class="panel-body"><div id="myfirstchart" style="height: 250px;"></div>
        </div>
    </div>
</div>-->
<?php  $totalChar = 0; ?>
<?php foreach ($resultado as $categoria){?>
  <?php foreach ($categoria as $preguntas){ ?>
    <?php if (!is_array($preguntas)){ ?>
        <h2><?php echo $preguntas ?></h2>
    <?php } else {?>
      <?php foreach ($preguntas as $pregunta){ ?>

          <pre><?php echo $pregunta['pregunta'] ?><br/>

          <?php $data = array(); ?>

          <?php foreach ($pregunta['respuestas'] as $respuesta){
              if (is_array($respuesta['respuesta'])){
                foreach ($respuesta['respuesta'] as $resp => $total) {
                    if (!is_array($total)){
                      if (!empty($resp)){
                        $data[] = array('label' => $resp, 'value' => $total);
                        echo '<li>['. $total .'] - ' . $resp. '</li>';
                      }
                    } else {
                      if (!empty($resp)){
                        $data[] = array('label' => $resp, 'value' => $total['total']);
                        echo '<li>['. $total['total'] .'] - ' . $resp. '</li>';
                        echo '<pre><b>Complemento</b><br/>';
                        foreach ($total['comp'] as $comp => $compt) {
                          echo '[' . $compt. '] ' . $comp . '<br/>';
                        }
                        echo '</pre>';
                      }
                  }
                }
              } else {
                if (!empty($respuesta['respuesta'])){
                  $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total']);
                  echo '<li>['. $respuesta['total'] .'] - ' . $respuesta['respuesta'] . '</li>';
                  if (array_key_exists('complemento', $respuesta)){
                      echo ' (Complemento: ' . $respuesta['complemento'] . ')';
                  }
                }
              }
            }

            $divId = 'pregunta_' . $totalChar++;

            $tipo = rand(1,5);
            echo 'TIPO: ' . $tipo . '<br/>';

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
                    $tipo = "Doughnut";
                    break;
                case 5:
                    $tipo = "Line";
                    break;
            }

            $enviar = array('element' => $divId, 'data' => $data);
            echo '<div class="panel-body row">';
              echo '<div class="col-md-2">';
                $checked = ($tipo == "Bar")? 'checked':'';
                echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartBar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Barras</label>';
                $checked = ($tipo == "Radar")? 'checked':'';
                echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartRadar('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Radio</label>';
                $checked = ($tipo == "Pie")? 'checked':'';
                echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartPie('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Circular</label>';
                $checked = ($tipo == "Doughnut")? 'checked':'';
                echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartDoughnut('.htmlspecialchars(print_r(json_encode($enviar),1)).')"> Dona</label>';
                $checked = ($tipo == "Line")? 'checked':'';
                echo '<label class="col-md-12"><input type="radio" name="radio'. $divId .'" ' . $checked . ' onclick="ChartLine('.htmlspecialchars(print_r(json_encode($enviar),1)).')" > Linea</label>';
              echo '</div>';
              echo '<div class="col-md-9" id="'. $divId .'">';
              echo '</div>';
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { Chart'. $tipo .'('.json_encode($enviar).') })</script>';
        ?>
        </pre>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php } ?>
