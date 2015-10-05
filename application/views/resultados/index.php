<h2>Resultado de las encuestas</h2>

<?php

$para      = 'nobody@example.com';
$titulo    = 'El título';
$mensaje   = 'Hola';
$cabeceras = 'From: webmaster@example.com' . "\r\n" .
    'Reply-To: webmaster@example.com' . "\r\n" .
    'X-Mailer: PHP/' . phpversion();

echo 'Resultado: ' . mail('bmdz.acos@gmail.com',$titulo,$mensaje,$cabeceras)? 'true':'false';

?>
<div class="col-lg-12">
    <div class="panel panel-default">
        <div class="panel-heading">
            Donut Chart Example
        </div>
        <!-- /.panel-heading -->
          <div class="panel-body"><div id="myfirstchart" style="height: 250px;"></div>
        </div>
        <!-- /.panel-body -->
    </div>
    <!-- /.panel -->
</div>
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
                      $data[] = array('label' => $resp, 'value' => $total);
                      echo '<li>['. $total .'] - ' . $resp. '</li>';
                    } else {
                      $data[] = array('label' => $resp, 'value' => $total['total']);
                      echo '<li>['. $total['total'] .'] - ' . $resp. '</li>';
                      echo '<pre><b>Complemento</b><br/>';
                      foreach ($total['comp'] as $comp => $compt) {
                        echo '[' . $compt. '] ' . $comp . '<br/>';
                      }
                      echo '</pre>';
                  }
                }
              } else {
                $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total']);
                echo '<li>['. $respuesta['total'] .'] - ' . $respuesta['respuesta'];
                if (array_key_exists('complemento', $respuesta)){
                    echo ' (Complemento: ' . $respuesta['complemento'] . ')';
                }
                echo '</li>';
              }
            }

            $divId = 'pregunta_' . $totalChar++;
            echo '<div class="panel-body"><div id="'. $divId .'" style="height: 250px;"></div>';
            echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) { MorrisDonut("' . $divId . '",'.json_encode($data).');});</script>';
        ?>
        </pre>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php } ?>
