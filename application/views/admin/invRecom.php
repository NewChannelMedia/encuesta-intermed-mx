<div class="invitacionDirecta">

  <?php
    echo '<script type="text/javascript">document.addEventListener("DOMContentLoaded", function(event) {
      cargar_invitacionRecomendada();
    });</script>';
  ?>
  <section class="llamadasSection container-fluid">
    <div class="panel panel-default">
      <div class="panel-heading">
        <div class="row">
          <div class="col-lg-10 col-md-10 col-sm-8 col-xs-8">
            <h3 class="panel-title s25">Recomendaciones enviadas</h3>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <table class="table table-condensed" id="EncuestasFisicas">
          <thead>
            <tr>
              <th class="text-center text-capitalize" style="width:25%">Nombre</th>
              <th class="text-center" style="width:25%">Correo electrónico</th>
              <th class="text-center" style="width:30%">Mensaje</th>
              <th class="text-center" style="width:20%">Fecha</th>
            </tr>
          </thead>
          <tbody id="InvDirecta">

          </tbody>
        </table>
      </div>
    </div>
  </section>
</div>
