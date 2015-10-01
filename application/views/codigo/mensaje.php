<h1>Revisando tu cedula</h1>
<p>Hola Dr/a. <strong><?php echo $nombre ?></strong><br />
  <?php
    if($cedula != "" )
      echo "Estamos revisando tu cedula( ".$cedula.")";
  ?>, cuando este listo te avisaremos al siguiente
  correo:<br /><strong><?php echo $correo; ?></strong></p>
