<div class="llamadasWrapper">
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
        <div class="col-lg-10 col-md-10 col-sm-10 col-xs-10" style="margin-top:30px">
          <table class="table table-condensed table-hover" id="ReenviosTabla">
            <thead>
              <tr>
                <th class="text-center" style="width:10%">Fecha</th>
                <th class="text-center hidden" style="width:5%">id</th>
                <th class="text-center" style="width:25%">Nombre</th>
                <th class="text-center" style="width:20%">Correo</th>
                <th class="text-center" style="width:15%">Código</th>
                <th class="text-center" style="width:10%">Tipo canal</th>
                <th class="text-center" style="width:10%">Canal usado</th>
                <th class="text-center" style="width:15%">Código usado</th>
              </tr>
            </thead>
            <tbody id="ReenvioMuestras">
              <?php
                foreach ($reenvios as $muestra) {?>
                  <tr class="muestraReenviar">
                    <td class="text-center fecha"><?php echo $muestra['fechaEnviado']; ?></td>
                    <td class="text-center hidden id"><?php echo $muestra['id']; ?></td>
                    <td class="text-center nombre"><?php echo $muestra['nombre']; ?></td>
                    <td class="text-center correo"><?php echo $muestra['correo']; ?></td>
                    <td class="text-center codigo"><?php echo $muestra['codigo']; ?></td>
                    <td class="text-center tipoCodigo"><?php echo $muestra['tipoCodigo']; ?></td>
                    <td class="text-center "><?php echo $muestra['canalUsado']; ?></td>
                    <td class="text-center "><?php echo $muestra['codigoUsado']; ?></td>
                  </tr>
                <?php }?>
            </tbody>
          </table>
        </div>
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-2" style="margin-top:30px">
          <input type="button" class="btn btn-warning btn-block" value="Reenviar" onclick="reenviarMuestra()">
        </div>
      </div>
    </div>
  </section>
</div>
