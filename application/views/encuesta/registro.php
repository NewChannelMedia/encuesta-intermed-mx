<form role="form" method="POST" action="/encuesta-intermed-mx/encuesta">
      <div style="color:red"><?php if (isset($mensaje)) echo $mensaje ?></div>
      <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
      Nombre: <input type="text" name="nombre" <?php if (isset($nombre)){ echo 'value="' . $nombre . '"';} ?>><br/>
      Correo: <input type="text" name="email" <?php if (isset($email)){ echo 'value="' . $email . '"'; } ?>><br/>
      <button type="submit" class="btn btn-default">Guardar mis datos</button><br/>
</form>
