<div class="invitacionExtra">
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <h3 class="panel-title s25">Generar nuevos códigos</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <form role="form" onsubmit="return enviarInvitacionExtra();">
          <div class="col-md-1 col-md-offset-2 text-right">
            <label for="cantidadCodigos">Cantidad: </label>
          </div>
          <div class="col-md-4">
            <input type="number" min="0" max="500" class="form-control" id="cantidadCodigos" placeholder="Cántidad de códigos" required="true">
          </div>
          <div class="col-md-3">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <section class="llamadasSection container-fluid">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table table-condensed" id="EncuestasFisicas">
            <thead>
              <tr>
                <th class="text-center text-capitalize" style="width:20px">#</th>
                <th class="text-center text-capitalize" >Código generado</th>
              </tr>
            </thead>
            <tbody id="invExtra">

            </tbody>
          </table>
        </div>
      </div>
    </div>
  </section>
</div>
