<div class="container-fluid flama">
    <div class="row" style="padding:30px;">
            <div class="row" style="padding:30px;">
              <h3 >Preguntas
              <button class="btn btn-success pull-right text-right" onclick="nuevaPregunta()">Agregar <span class="glyphicon glyphicon-plus"></span></button>
            </h3>
            </div>
            <div class="table-responsive">
              <table class="table table-striped table-condensed">
                <thead>
                  <tr>
                    <th style="width:40%">Pregunta</th>
                    <th style="width:15%" class="text-center">Categoria</th>
                    <th style="width:15%" class="text-center">Tipo</th>
                    <th style="width:20%" class="text-center">Opciones</th>
                    <th style="width:5%" class="text-center">Editar</th>
                    <th style="width:5%" class="text-center">Eliminar</th>
                  </tr>
                </thead>

                  <?php foreach ($preguntas as $pregunta){?>
                    <tr>
                      <td ><?php echo $pregunta['pregunta']; ?></th>
                      <td class="text-center"><?php echo $pregunta['categoria']; ?></td>
                      <td class="text-center"><?php echo $pregunta['tipo']; ?></td>
                      <td class="text-center"><?php
                        $opciones = explode('|', $pregunta['opciones']);
                        $opc = '';
                        foreach ($opciones as $opcion) {
                          if ($opc == ''){
                            $opc = $opcion;
                          } else {
                            $opc .= '<br/>'.$opcion;
                          }
                        }
                        echo $opc;
                      ?></td>
                      <td class="text-center">
                        <a onclick="cargarPregunta('<?php echo $pregunta['id'] ?>')"><span class="glyphicon glyphicon-pencil"></span></a>
                      </td>
                      <td class="text-center">
                        <a onclick="eliminarPregunta('<?php echo $pregunta['id'] ?>')" style="color: red;"><span class="glyphicon glyphicon-trash"></span></a>
                      </td>
                    </tr>
                  <?php } ?>
                <tbody>
                </tbody>
              </table>
            </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="adminPregunta" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="adminPreguntaTitle"></h4>
      </div>
      <div class="modal-body">
        <form  class="form-horizontal">
          <!--Categoria-->
          <div class="form-group">
            <div class="col-sm-12">
              <div class="col-sm-2">
              <label for="categoriaPreg">Categoria: </label>
              </div>
              <div class="col-sm-10">
                <select class="form-control" id="categoriaPreg">
                  <?php foreach ($categorias as $cat){?>
                    <option value="<?php echo $cat['id']; ?>"><?php echo $cat['categoria'] ?></option>
                  <?php } ?>
                </select>
              </div>
            </div>
          </div>
          <!--Pregunta-->
          <div class="form-group">
            <div class="col-sm-12">
              <div class="col-sm-2">
                <label for="preguntaPreg">Pregunta: </label>
              </div>
              <div class="col-sm-10">
                <textarea class="form-control" id="preguntaPreg"  rows="5" style="resize: none;" ></textarea>
              </div>
            </div>
          </div>
          <!--Tipo-->
          <div class="form-group">
            <div class="col-sm-12">
              <div class="col-sm-2">
                <label for="tipoPreg">Tipo: </label>
              </div>
              <div class="col-sm-10">
                <select class="form-control" id="tipoPreg">
                  <option value='text'>Abierta</option>
                  <option value='money'>Dinero</option>
                  <option value='text|enum'>Ordenar</option>
                  <option value='radio'>Selección unica</option>
                  <option value='checkbox'>Selección multiple</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12" id="opcComp">

            </div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function cargarPregunta(id){
    console.log('Cargar pregunta con id: ' + id);
    $('#adminPreguntaTitle').html('Modificar pregunta');
    //$('#opcComp').html('');
    $('#adminPregunta').modal('show');
  }

  function eliminarPregunta(id){
    console.log('Eliminar pregunta con id: ' + id);
  }

  function nuevaPregunta(){
    $('#adminPreguntaTitle').html('Agregar pregunta');
    $("#categoriaPreg").prop('selectedIndex', 0);
    $("#tipoPreg").prop('selectedIndex', 0);
    //$('#opcComp').html('');
    $('#adminPregunta').modal('show');
  }
  document.addEventListener("DOMContentLoaded", function(event) {
    $('#tipoPreg').change(function(){
      var complemento = false, opciones = false;
      var tipo = $(this).prop('value');
      if (tipo === "radio" || tipo === "checkbox"){
        opciones = true;
        complemento = true;
      } else if (tipo === "text|enum"){
        opciones = true;
      }

      if (opciones){
        $('#opcComp').html(frmOpciones);
        //$('#opcComp').html('complemento: '+ complemento +'<br/>Opciones: ' + opciones);
      } else {
        $('#opcComp').html('');
      }
    })
  });

  function agregarOpcion(){
    $('#opcionesAgregadas').append('<li><div class="label label-primary"><span class="glyphicon glyphicon-remove glyphicon-xs" onclick="$(this).parent().parent().remove()"></span>&nbsp;' +$('#opcionAgregar').prop('value')+'</div></li>');
    $('#opcionAgregar').prop('value','');
  }

  var frmOpciones = '<div class="col-sm-2"><label for="opcionAgregar">Opcion: </label></div><div class="col-sm-9"><input type="text" class="form-control" id="opcionAgregar"></div><div class="col-sm-1 form-inline"><button type="button" class="btn btn-success" style="margin-left:-22px" onclick="agregarOpcion()"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></div><div class="col-sm-12"><ul class="list-inline text-center" style="margin-top:20px; overflow-x: hidden;" id="opcionesAgregadas"></ul></div>';
</script>
