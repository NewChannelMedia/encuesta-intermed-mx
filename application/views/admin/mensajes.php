<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<div id="suscripciones" class="container-fluid flama">
<div class="row">
<ul class="nav nav-tabs">
  <li class="active"><a data-toggle="tab" href="#home">Sin contestar</a></li>
  <li><a data-toggle="tab" href="#menu1">Contestados</a></li>
</ul>
</div>
<div class="tab-content">
<div id="home" class="tab-pane fade in active" >
      <h3>Mensajes por contestar</h3>
      <div class="table-responsive">
        <table id="pa" class="table table-striped table-condensed">
          <thead>
            <tr>
              <th style="width:15%">Fecha</th>
              <th style="width:20%">Nombre</th>
              <th style="width:25%">Correo</th>
              <th style="width:35%">Mensaje</th>
              <th style="width:5%">Responder</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach( $mensajes as $row ){
              if (empty($row['respuesta'])){
            ?>
            <tr <?php if ($row['leido'] == 0) echo 'class="info"'; ?> id="tr_porcontestar_<?php echo $row['id']?>">
              <td>
                <?= $row['fecha']; ?>
              </td>
              <td>
                <?= $row['nombre']; ?>
              </td>
              <td>
                <?= $row['correo']; ?>
              </td>
              <td>
                <?= $row['mensaje']; ?>
              </td>
              <td class="text-center">
                <a onclick="responderMensaje(<?php echo htmlentities(print_r(json_encode($row),1)); ?>)" data-toggle="modal" data-target="#modal_contestar"><span class="glyphicon glyphicon-pencil"></span></a>
              </td>
            </tr>
            <?php
            }} ?>
          </tbody>
        </table>
      </div>
    </div>
    <div id="menu1" class="tab-pane fade in">
        <h3>Mensajes contestados</h3>
        <div class="table-responsive">
          <table id="pa" class="table table-striped table-condensed">
            <thead>
              <tr>
                <th style="width:10%">Fecha</th>
                <th style="width:15%">Nombre</th>
                <th style="width:15%">Correo</th>
                <th style="width:30%">Mensaje</th>
                <th style="width:30%">Respuesta</th>
              </tr>
            </thead>
            <tbody id="table_contestados">
              <?php
              foreach( $mensajes as $row ){
                if (!empty($row['respuesta'])){
              ?>
              <tr <?php if ($row['leido'] == 0) echo 'class="info"'; ?> id="tr_contestados_<?php echo $row['id']?>">
                <td>
                  <?= $row['fecha']; ?>
                </td>
                <td>
                  <?= $row['nombre']; ?>
                </td>
                <td>
                  <?= $row['correo']; ?>
                </td>
                <td>
                  <?= $row['mensaje']; ?>
                </td>
                <td>
                  <?= $row['respuesta']; ?>
                </td>
              </tr>
              <?php
              } }?>
            </tbody>
          </table>
        </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modal_contestar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Responder mensaje</h4>
      </div>
      <div class="modal-body">
        <div class="row">
          <form id="frm_responder" method="POST">
            <input type="hidden" value="INFORMACIÓN INTERMED" name="asunto">
            <input type="hidden" value="" name="id" id="responder_id">
            <div class="form-group col-md-12">
              <input class="form-control input-lg" type="email" name="email" id="responder_email" required readonly>
            </div>
            <div class="form-group col-md-12">
              <textarea class="form-control input-lg" rows="5" id="responder_mensaje" name="mensaje" placeholder="Mensaje" required></textarea>
            </div>
            <div class="form-group col-md-12">
              <button type="submit" class="btn btn-primary" id="responder_boton">Responder</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
