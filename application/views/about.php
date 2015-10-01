<div class="container">
<?php if ($status === 1 || $status === 2){ ?>
  <form role="form" method="POST" action="/encuesta-intermed-mx/encuesta">
        <input type="hidden" name="codigo" value="<?php echo $codigo ?>">
        <button type="submit" class="btn btn-default">
          <?php if ($status === 3) {?>
            Ver la encuesta
          <?php } else {?>
            Contestar la encuesta
          <?php }?>
        </button><br/>
  </form>
<?php } ?>
</div>
