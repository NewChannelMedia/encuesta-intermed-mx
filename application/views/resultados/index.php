<h2>Resultado de las encuestas</h2>

<?php foreach ($resultado as $categoria){ ?>
  <?php foreach ($categoria as $preguntas){ ?>
    <?php if (!is_array($preguntas)){ ?>
        <h2><?php echo $preguntas ?></h2>
    <?php } else {?>
      <?php foreach ($preguntas as $pregunta){ ?>

        <pre><?php echo $pregunta['pregunta'] ?><br/>

          <?php foreach ($pregunta['respuestas'] as $respuesta){ ?>
            <?php
              if (is_array($respuesta['respuesta'])){
                echo '<pre>'. print_r($respuesta['respuesta'],1) . '</pre>';
              } else {
                echo '<li>['. $respuesta['total'] .'] - ' . $respuesta['respuesta'];
                if (array_key_exists('complemento', $respuesta)){
                    echo ' (Complemento: ' . $respuesta['complemento'] . ')';
                }
                echo '</li>';
              }?>
          <?php } ?>

        </pre>
      <?php } ?>
    <?php } ?>
  <?php } ?>
<?php } ?>
