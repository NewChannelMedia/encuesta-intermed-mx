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
                <tbody id="listapreguntas">

                  <?php foreach ($preguntas as $pregunta){?>
                    <tr id="<?php echo $pregunta['id']; ?>">
                      <td class="pregunta" ><?php echo $pregunta['pregunta']; ?></td>
                      <td class="text-center categoria"><input type="hidden" value="<?php echo $pregunta['categoria_id']; ?>"><div clas="value"><?php echo $pregunta['categoria']; ?></div></td>
                      <td class="text-center tipo"><input type="hidden" value="<?php echo $pregunta['tipo']; ?>">
                        <div clas="value">
                        <?php
                          switch ($pregunta['tipo']) {
                            case "text":
                                echo "Abierta";
                                break;
                            case "money":
                                echo "Dinero";
                                break;
                            case "text|enum":
                                echo "Ordenar";
                                break;
                            case "checkbox":
                                echo "Selección multiple";
                                break;
                            case "radio":
                                echo "Selección única";
                                break;
                          }
                        ?>
                      </div>
                      </td>
                      <td class="text-center opciones"><?php
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
        <form  class="form-horizontal" autocomplete="off" />
          <input type="hidden" id="pregunta_id">
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
                  <option value='radio'>Selección única</option>
                  <option value='checkbox'>Selección multiple</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-12" id="opcComp"></div>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
        <button type="button" class="btn btn-primary" onclick="guardarPregunta();return false;">Guardar</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  function cargarPregunta(id){
    $('#opcComp').html('');
    $('#pregunta_id').prop('value',id);
    $('#adminPreguntaTitle').html('Modificar pregunta');
    //$('#opcComp').html('');
    var pregunta = $('tr#'+id).find('td.pregunta').html();
    var categoria =  $('tr#'+id).find('td.categoria').find('input').prop('value');
    var tipo =  $('tr#'+id).find('td.tipo').find('input').prop('value');
    var opcionesExistentes =  $('tr#'+id).find('td.opciones').html().split("<br>");

    $("#preguntaPreg").prop('value', pregunta);
    $("#categoriaPreg").prop('value', categoria);
    $("#tipoPreg").prop('value', tipo);

    //Cargar resto de formulario
    var complemento = false, opciones = false;
    if (tipo === "radio" || tipo === "checkbox"){
      opciones = true;
      complemento = true;
    } else if (tipo === "text|enum"){
      opciones = true;
    }

    if (opciones){
      if (tipo === "text|enum"){
        $('#opcComp').html(frmOpciones);
      } else {
        if ($('#opcComp').html() == '' || !$('#opcComp').find('#comp')[0]){
          $('#opcComp').html(frmOpcionesComp);
        }
      }
      $( "#opcionesAgregadas" ).sortable();
    } else {
      $('#opcComp').html('');
    }

    opcionesExistentes.forEach(function(opcion){
        var clase = "label-default";
        var comp = '';
        if (opcion.substring(opcion.length -1) == ':'){
          clase = "label-warning";
          comp = 'comp';
        }
        while (opcion.substring(opcion.length -1) == ':' || opcion.substring(opcion.length -1) == ' '){
          opcion = opcion.substring(0, opcion.length -1);
        }
      $('#opcionesAgregadas').append('<li><div class="label '+ clase +'"><span class="glyphicon glyphicon-remove glyphicon-xs" onclick="$(this).parent().parent().remove()"></span>&nbsp;' +opcion+'<input type="hidden" value="'+opcion+'" class="opciones '+ comp+'"></div></li>');
    });

    //End cargar
    $('#adminPregunta').modal('show');
  }

  function eliminarPregunta(id){
    bootbox.confirm({
        size: 'small',
        message: "Pregunta: " + $('tr#'+id).find('td.pregunta').html(),
        title: "¿Estas seguro de querer eliminar la pregunta?",
        callback: function(result){
          if (result){
            $.ajax( {
              url: '/encuesta-intermed/Admin/eliminarPregunta',
              type: "POST",
              dataType: 'JSON',
              data: {'id':id},
              async: true,
              success: function (data) {
                if (data.success){
                  $('tr#'+id).remove();
                }
              },
              error: function (err) {
                console.log( "Error: AJax dead :" + JSON.stringify(err));
              }
            } );
          }
        },
        buttons: {
          cancel: {
            label: "No"
          },
          confirm: {
            label: "Si",
            className: "btn-danger"
          }
        }
    });

  }

  function nuevaPregunta(){
    $('#opcComp').html('');
    $('#adminPreguntaTitle').html('Agregar pregunta');
    $("#categoriaPreg").prop('selectedIndex', 0);
    $("#tipoPreg").prop('selectedIndex', 0);
    $("#preguntaPreg").prop('value', '');
    //$('#opcComp').html('');
    $('#pregunta_id').prop('value','');
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
        if (tipo === "text|enum"){
          $('#opcComp').html(frmOpciones);
        } else {
          if ($('#opcComp').html() == '' || !$('#opcComp').find('#comp')[0]){
            $('#opcComp').html(frmOpcionesComp);
          }
        }
        $( "#opcionesAgregadas" ).sortable();
      } else {
        $('#opcComp').html('');
      }

      if (complemento){

      }
    })
  });


  function agregarOpcion(){
    if ($('#opcionAgregar').prop('value').replace(' ','').replace(':','') != ''){
      var clase = "label-default";
      var comp = '';
      if ($('#comp').prop( "checked")){
        clase = "label-warning";
        comp = 'comp';
      }
      var opcion = $('#opcionAgregar').prop('value');
      while (opcion.substring(opcion.length -1) == ':' || opcion.substring(opcion.length -1) == ' '){
        opcion = opcion.substring(0, opcion.length -1);
      }
      $('#opcionesAgregadas').append('<li><div class="label '+ clase +'"><span class="glyphicon glyphicon-remove glyphicon-xs" onclick="$(this).parent().parent().remove()"></span>&nbsp;' +opcion+'<input type="hidden" value="'+opcion+'" class="opciones '+ comp+'"></div></li>');
      $('#opcionAgregar').prop('value','');
      $('#comp').prop( "checked", false );
    }
  }

  function guardarPregunta(){
    var id = $('#pregunta_id').prop('value');
    categoria = $('#categoriaPreg').prop('value');
    pregunta = $('#preguntaPreg').prop('value');
    tipo = $('#tipoPreg').prop('value');
    while (pregunta.substring(pregunta.length -1) == ':' || pregunta.substring(pregunta.length -1) == ' '){
      pregunta = pregunta.substring(0, pregunta.length -1);
    }
    var respuestas = '';
    $('input.opciones').each(function(){
      var opcion = $(this).prop('value');
      var comp = false;
      if ($(this).hasClass('comp')){
        comp = true;
      }
      while (opcion.substring(opcion.length -1) == ':' || opcion.substring(opcion.length -1) == ' '){
        opcion = opcion.substring(0, opcion.length -1);
      }
      if (comp){
        opcion += ':';
      }
      if (respuestas == ''){
        respuestas = opcion;
      } else {
        respuestas += '|'+opcion
      }
    });

    if (tipo == "radio" || tipo == "checkbox" || tipo == "text|enum" ){
      if (respuestas == ""){
        guardar = false;
      } else {
        guardar = true;
      }
    } else {
      guardar = true;
    }

    if (guardar){

      var data2 = {
        pregunta_id: id,
        categoria_id: categoria,
        pregunta: pregunta,
        tipo: tipo,
        opciones: respuestas
      }

      $.ajax( {
        url: '/encuesta-intermed/Admin/guardarPregunta',
        type: "POST",
        dataType: 'JSON',
        data: data2,
        async: true,
        success: function (data) {
          if (data.success){
            id = data2.pregunta_id;
            if (id != '' && parseInt(id) >= 0){
              $('tr#'+id).find('td.pregunta').html(pregunta);
              $('tr#'+id).find('td.categoria').find('input').prop('value',categoria);
              $('tr#'+id).find('td.categoria').find('div').html($('#categoriaPreg option:selected').text());
              $('tr#'+id).find('td.tipo').find('input').prop('value',tipo);
              $('tr#'+id).find('td.tipo').find('div').html($('#tipoPreg option:selected').text());
              $('tr#'+id).find('td.opciones').html('');
              respuestas = respuestas.split("|");
              respuestas.forEach(function(resp){
                if ($('tr#'+id).find('td.opciones').html() == ''){
                  $('tr#'+id).find('td.opciones').append(resp);
                } else {
                  $('tr#'+id).find('td.opciones').append('<br>' + resp);
                }
              });
            } else {
              id = data.pregunta_id;
              //Insertar nuevo
              $('#listapreguntas').append('<tr id="'+ id +'"></tr>');
              $('tr#'+id).append('<td class="pregunta">'+ data2.pregunta +'</td>');
              $('tr#'+id).append('<td class="text-center categoria"><input type="hidden" value="'+ data2.categoria_id +'">'+ $('#categoriaPreg option:selected').text() +'</td>');
              $('tr#'+id).append('<td class="text-center tipo">'+ data2.tipo +'</td>');
              var opciones = '';
              data2.opciones.split("|").forEach(function(opc){
                if (opciones == ''){
                  opciones += opc;
                } else {
                  opciones += '<br>' + opc;
                }
              });
              $('tr#'+id).append('<td class="text-center opciones">'+opciones + '</td>');
              $('tr#'+id).append('<td class="text-center"><a onclick="cargarPregunta('+ id +')"><span class="glyphicon glyphicon-pencil"></span></a></td>');
              $('tr#'+id).append('<td class="text-center"><a onclick="eliminarPregunta('+ id +')" style="color: red;"><span class="glyphicon glyphicon-trash"></span></a></td>');
            }
            $('#adminPregunta').modal('hide');

          }
        },
        error: function (err) {
          console.log( "Error: AJax dead :" + JSON.stringify(err));
        }
      } );
    } else {
      bootbox.alert({
          size: 'small',
          message: 'No puedes guardar una pregunta de tipo "ordenar" o "seleccion" sin opciones.',
          title: "No se pueden guardar los cambios"
        });
    }
  }

  var frmOpciones = '<div class="col-sm-2"><label for="opcionAgregar">Opcion: </label></div><div class="col-sm-10"><div class="input-group" style="width: 100%"><input type="text" class="form-control" id="opcionAgregar"/><span class="input-group-btn"><button class="btn btn-success" onclick="agregarOpcion(); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></span></div></div><div class="col-sm-12"><ul class="list-inline text-center" style="margin-top:20px; overflow-x: hidden;" id="opcionesAgregadas"></ul></div>';
  var frmOpcionesComp = '<div class="col-sm-2"><label for="opcionAgregar">Opcion: </label></div><div class="col-sm-10"><div class="input-group" style="width: 100%"><input type="text" class="form-control" id="opcionAgregar"/><span class="input-group-addon"><input type="checkbox" id="comp"> Comp</span><span class="input-group-btn"><button class="btn btn-success" onclick="agregarOpcion(); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></span></div></div><div class="col-sm-12"><ul class="list-inline text-center" style="margin-top:20px; overflow-x: hidden;" id="opcionesAgregadas"></ul></div>';
</script>
