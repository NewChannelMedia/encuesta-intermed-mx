<?php if ($status === 1 || $status === 2){ ?>
  <form role="form" method="POST" action="/encuesta-intermed-mx/encuesta">
        <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
        <button type="submit" class="btn btn-default">Contestar la encuesta</button><br/>
  </form>
<?php } ?>
