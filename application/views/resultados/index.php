<div class="container flama">
<div class="row text-center" style="padding: 50px;">
<h2>Resultado de las encuestas</h2>
</div>

<!--IMPRIMIR EL TAB NAV-->
<?php
$first = true;
echo '<ul class="nav nav-tabs" role="tablist" id="resultTabs">';
foreach ($resultado as $categoria){
  foreach ($categoria as $preguntas){
    if (!is_array($preguntas)){
      $class = '';
      if ($first){
        $class = 'class = "active"';
        $first = false;
      }
      echo '<li ' . $class . 'role="presentation"><a href="#'.str_replace(' ','',$preguntas).'" aria-controls="'.str_replace(' ','',$preguntas).'" role="tab" data-toggle="tab">'. $preguntas .'</a></li>';
    }
  }
}
echo '</ul>';
?>
<!--IMPRIMIR LOS DIV DE LOS TAB NAV-->

<?php  $totalChar = 0; $primero = true;$clase="active";?>
<div class="tab-content">
<?php foreach ($resultado as $categoria){?>
  <?php foreach ($categoria as $preguntas){ ?>
    <?php if (!is_array($preguntas)){ ?>
      <?php if (array_search($categoria, $resultado)>0){ echo '</div></div>'; $funciones = '';}?>
        <?php
          if ($primero){
            $primero = false;
          } else {
            $clase = '';
          }
        ?>
        <div role="tabpanel" class="tab-pane <?php echo $clase ?>" id="<?php echo str_replace(' ','',$preguntas); ?>" style="padding:20px;padding-bottom:0px;margin-bottom:20px;background-color:white;border:1px solid #ddd">
        <div class="row">
    <?php } else {?>
      <?php foreach ($preguntas as $pregunta){ ?>
          <?php $data = array(); $complemento=false;?>

          <?php foreach ($pregunta['respuestas'] as $respuesta){
              $existeComplemento = false;
              if (is_array($respuesta['respuesta'])){
                foreach ($respuesta['respuesta'] as $resp => $total) {
                    if (!is_array($total)){
                      if (!empty($resp)){
                        $data[] = array('label' => $resp, 'value' => $total);
                      }
                    } else {
                      if (!empty($resp)){
                        if (array_key_exists('comp',$total) &&  count($total['comp'])>0){
                          $existeComplemento = true;
                          $complemento = [];
                          foreach ($total['comp'] as $comp => $compt) {
                            array_push($complemento, array('total' => $compt, 'comp' => $comp));
                          }
                          $data[] = array('label' => $resp, 'value' => $total['total'], 'complemento' => $complemento);
                          //echo '<pre>'. print_r(array('label' => $resp, 'value' => $total['total'], 'complemento' => $complemento),1) .'</pre>';
                          $complemento = true;
                        } else {
                          if (!array_key_exists('total',$total)){
                            $total['total'] =0;
                          }
                          $data[] = array('label' => $resp, 'value' => $total['total']);
                        }
                      }
                  }
                }
              } else {
                if (!empty($respuesta['respuesta'])){
                  if (array_key_exists('complemento', $respuesta)){
                    $existeComplemento = true;
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
            <div class="panel-heading" style="height:60px;<?php if ($complemento) echo 'background-color:#DBA901' ?>">
              <div class="row" style="height:50px;">
                <div class="col-lg-10 col-md-11" style="font-size:80%;height:50px;overflow:hidden;">
                  <?php echo $pregunta['pregunta'] ?>
                </div>
                <div class="col-lg-1 col-md-1 pull-right">
                  <div class="btn-group pull-right">
                      <button type="button" class="btn btn-default btn-xs dropdown-toggle" data-toggle="dropdown" style="height:40px;">
                          <span class="caret"></span>
                      </button>
                      <ul class="dropdown-menu list-inline" role="menu">
                        <?php
                            echo '<input type="hidden" id="'. $divId .'_tipo" value="'. $divId .'>">';
                            $enviar = array('element' => $divId, 'data' => $data,'pregunta'=>$pregunta['pregunta']);
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
              </div>
            </div>
            <div class="panel-body ContenedorGrafica">

            <?php
              echo '<div class="col-md-12" id="'. $divId .'">';
              echo '</div>';
              echo '<div class="col-md-12 complemento" id="'. $divId .'_complemento" data-toggle="popover" title="" data-content="" data-html="true" data-placement="bottom"></div>';
              echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { Chart'. $tipo .'('.json_encode($enviar).') })</script>';
              echo '<script type="text/javascript">document.getElementById("resultTabs").addEventListener("click", function(event) { Chart'. $tipo .'('.json_encode($enviar).') })</script>';
            ?>
        </div>
        </div>
        </div>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php } ?>
</div>
</div>
</div>
</div>
