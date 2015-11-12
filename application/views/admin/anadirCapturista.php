<section>
  <div id="usuario" class="container-fluid" >
    <div class="panel">
      <div class="panel-heading">
        <h3 class="panel-title">Datos del capturista</h3>
      </div>
      <div id="usuarioGuardado" class="panel-body">
	      <input type="hidden" id="usuario_id" value="">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <fieldset>
                <legend>Usuario y password</legend>
                <div class="form-group col-md-4 col-sm-4">
                  <input type="text" class="form-control" id="user" placeholder="Usuario:">
                </div>
                <div class="form-group col-md-4 col-sm-4">
                  <input type="password" class="form-control" id="password" placeholder="Password">
                </div>
              </fieldset>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <button type="button" id="UserPass" class="form-control btn btn-warning" >Guardar usuario</button>
            </div>
          </div>
        </div>
      </div>
      <div class="panel-body">
        <div class="row">
          <div class="col-md-8 col-sm-8">
            <div class="row">
              <fieldset>
                <legend>Nombre y Apellido</legend>
                <div class="form-group col-md-4 col-sm-4">
                  <input type="text" class="form-control" id="nombreCapturista" placeholder="Nombre(s):">
                </div>
                <div class="form-group col-md-4 col-sm-4">
                  <input type="text" class="form-control" id="apellidoCapturista" placeholder="Apellido(s):">
                </div>
                <div class="form-group col-md-4 col-sm-4">
                  <input type="mail" class="form-control" id="mailCapturista" placeholder="Correo:">
                </div>
              </fieldset>
            </div>
          </div>
          <div class="col-md-4 col-sm-4">
            <div class="form-group">
              <button type="button" id="mandarNombre" class="form-control btn btn-warning">Guardar informacion</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
