<div class="invitacionDirecta">

  <?php
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
      cargar_invitacionDirecta();
    });</script>';
  ?>
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <h3 class="panel-title s25">Enviar nueva invitación a encuesta</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <form role="form" onsubmit="return enviarInvitacionDirecta();" id="enviarForm">
          <div class="col-md-5">
            <input type="text" class="form-control" id="nombreInvitacion" placeholder="Nombre" required="true">
          </div>
          <div class="col-md-5">
            <input type="email" class="form-control" id="correoInvitacion" placeholder="Correo electrónico" required="true">
          </div>
          <div class="col-md-2">
            <button type="submit" class="btn btn-primary btn-block">Enviar</button>
          </div>
        </form>
      </div>
    </div>
  </section>
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <h3 class="panel-title s25">Invitaciones enviadas</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-condensed" id="EncuestasFisicas">
          <thead>
            <tr>
              <th class="text-center text-capitalize" style="width:30%">Nombre</th>
              <th class="text-center" style="width:40%">Correo electrónico</th>
              <th class="text-center" style="width:30%">Fecha</th>
            </tr>
          </thead>
          <tbody id="InvDirecta">

          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
