<?php if( isset($_SESSION['status']) && $_SESSION['status'] == 1 ){?>
  <div id="suscripciones" class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h3>Suscripciones a newsletter</h3>
        <div class="table-responsive">
          <table id="pa" class="table table-striped table-condensed">
            <thead>
              <tr>
                <th>#</th>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Newsletter</th>
                <th>Pruebas</th>
              </tr>
            </thead>
            <tbody id="suscritos">
              <?php $i = 0;
              foreach( $newsletter as $row ){
              ?>
              <tr>
                <td>
                  <?= $newsletter[$i]['id']; ?>
                </td>
                <td>
                  <?= $newsletter[$i]['nombre']; ?>
                </td>
                <td>
                  <?= $newsletter[$i]['correo']; ?>
                </td>
                <td>
                  <?= $newsletter[$i]['newsletter']; ?>
                </td>
                <td>
                  <?= $newsletter[$i]['pruebas']; ?>
                </td>
              </tr>
              <?php  $i++;
              } ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
<?php } ?>
