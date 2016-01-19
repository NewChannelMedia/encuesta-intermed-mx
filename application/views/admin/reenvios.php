<div class="llamadasWrapper">
  <!--
  REENVIOS:
  <pre><?php echo print_r($reenvios,1); ?></pre>
  -->
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8 text-center">
            <h3 class="panel-title s25">Encuestas disponibles para reenviar</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="col-lg-9 col-md-9 col-sm-9 col-xs-9" style="margin-top:30px">
          <table class="table table-condensed table-hover">
            <thead>
              <tr>
                <th class="text-center" style="width:5%">id</th>
                <th class="text-center" style="width:40%">Nombre</th>
                <th class="text-center" style="width:30%">Correo</th>
                <th class="text-center" style="width:15%">Código</th>
                <th class="text-center" style="width:10%">Tipo canal</th>
              </tr>
            </thead>
            <tbody id="ReenvioMuestras">
              <?php
                foreach ($reenvios as $muestra) {?>
                  <tr class="muestraReenviar">
                    <td class="text-center id"><?php echo $muestra['id']; ?></td>
                    <td class="text-center nombre"><?php echo $muestra['nombre']; ?></td>
                    <td class="text-center correo"><?php echo $muestra['correo']; ?></td>
                    <td class="text-center codigo"><?php echo $muestra['codigo']; ?></td>
                    <td class="text-center tipoCodigo"><?php echo $muestra['tipoCodigo']; ?></td>
                  </tr>
                <?php }?>
            </tbody>
          </table>
        </div>
        <div class="col-lg-3 col-md-3 col-sm-3 col-xs-3" style="margin-top:30px">
          <input type="button" class="btn btn-warning btn-block" value="Reenviar" onclick="reenviarMuestra()">
        </div>
      </div>
    </div>
  </section>
</div>
