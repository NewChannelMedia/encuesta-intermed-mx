<input type="hidden" id="totalEtapas" value="<?php echo $etapas; ?>">
<div class="container-fluid flama">
    <div class="row" style="padding:30px;">
            <div class="row" style="padding:30px;">
            <h3>Etapas y Categorías
              <button class="btn btn-success pull-right text-right" onclick="nuevaEtapa()">Agregar etapa <span class="glyphicon glyphicon-plus"></span></button>
            </h3>
            </div>
            <div>
              <?php
              echo '<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">';
              echo '<div class="panel panel-danger" style="min-height: 30px!important;" >';
              echo '<div class="panel-heading text-center" style="font-size:130%">Sin clasificar<button class="btn btn-danger btn-xs pull-right text-right" onclick="nuevaCategoria()"><span class="glyphicon glyphicon-plus"></span></button></div>';
              echo '<div id="etapa_0" class="panel-body"><ul id="sortable_0" class="list-inline connectedSortable">';
              foreach ($categorias as $categoria) {
                if ($categoria['etapa'] == 0 && $categoria['id'] != "0"){
                  echo '<li class="ui-state-default"><input type="hidden" value="'. $categoria['id'] .'"><span class="value">'.$categoria['categoria'] .'</span><span class="glyphicon glyphicon-remove glyphicon-xs" onclick="eliminarCategoria($(this).parent())"></span></li>';
                }
              }
              echo '</ul></div></div></div>';
              $width = 12/$etapas;

              for ($i=1; $i <= $etapas ; $i++) {
                echo '<div class="col-lg-'.$width.' col-md-'.($width*2).' col-sm-'.($width*2).' col-xs-'.($width*4).'" id="col_'.$i.'">';
                echo '<div class="panel panel-success" style="min-height: 600px!important;" >';
                echo '<div class="panel-heading text-center" style="font-size:130%">Etapa '. $i .'<span class="glyphicon glyphicon-remove glyphicon-xs" onclick="eliminarEtapa('.$i.')" style="float:right;font-size:70%"></span></div>';
                echo '<div id="etapa_'.$i.'" class="panel-body"><ul id="sortable_'.$i.'" class="connectedSortable">';

                foreach ($categorias as $categoria) {
                  if ($categoria['etapa'] == $i){
                    echo '<li class="ui-state-default"><input type="hidden" value="'. $categoria['id'] .'"><span class="value">'.$categoria['categoria'] .'</span><span class="glyphicon glyphicon-remove glyphicon-xs" onclick="eliminarCategoria($(this).parent())"></span></li>';
                  }
                }

                echo '</ul></div></div></div>';
              }
              ?>
              <button class="btn btn-block btn-lg btn-success" onclick="guardarCambiosEnCategorias()">Guardar clasificacion de categorías</button>
            </div>
    </div>
</div>

<script type="text/javascript">

  function eliminarCategoria(liElement){
      bootbox.confirm({
          size: 'medium',
          message: 'Categoria: ' +liElement.find('span.value').html() ,
          title: "¿Estas seguro de querer eliminar la categoria?",
          callback: function(result){
            if (result){
              var categoria_id = liElement.find('input').prop('value');
             $.ajax( {
               url: '/encuesta-intermed/Admin/eliminarCategoria',
               type: "POST",
               dataType: 'JSON',
               data: {'categoria_id':categoria_id},
               async: true,
               success: function (data) {
                 if (data.success){
                   liElement.remove();
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

  function nuevaCategoria(){
    bootbox.prompt("Nombre de la categoría: ", function(result) {
      if (!(result === null) && result != "") {
          $.ajax( {
            url: '/encuesta-intermed/Admin/nuevaCategoria',
            type: "POST",
            dataType: 'JSON',
            data: {'categoria':result},
            async: true,
            success: function (data) {
              if (data.success){
                location.reload();
              }
            },
            error: function (err) {
              console.log( "Error: AJax dead :" + JSON.stringify(err));
            }
          } );
      }
    });
  }

  function eliminarEtapa(i){
    var sortable = $('#sortable_'+i).clone();
    sortable.find('span.glyphicon').remove();
    bootbox.confirm({
          size: 'medium',
          message: 'Categorias: <ul>'+ sortable.html()+'</ul>',
          title: "¿Estas seguro de querer eliminar la etapa "+ i +"?",
          callback: function(result){
            if (result){
              $.ajax( {
                url: '/encuesta-intermed/Admin/eliminarEtapa',
                type: "POST",
                dataType: 'JSON',
                data: {'etapa':i},
                async: true,
                success: function (data) {
                  if (data.success){
                    location.reload();
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

  function nuevaEtapa(){
    $.ajax( {
      url: '/encuesta-intermed/Admin/nuevaEtapa',
      type: "POST",
      dataType: 'JSON',
      async: true,
      success: function (data) {
        if (data.success){
          location.reload();
        }
      },
      error: function (err) {
        console.log( "Error: AJax dead :" + JSON.stringify(err));
      }
    } );
  }

  document.addEventListener("DOMContentLoaded", function(event) {
    var totalEtapas = $('#totalEtapas').prop('value');
    var sortable = '';
    for (var i = 0; i <= parseInt(totalEtapas); i++){
      if (sortable == ''){
        sortable += '#sortable_'+i;
      } else{
        sortable += ',#sortable_'+i;
      }
    }
    $(sortable).sortable({
      connectWith: ".connectedSortable"
    }).disableSelection();
  });

  function guardarCambiosEnCategorias(){
    var ordenGuardar = new Array();
    $('ul.connectedSortable').each(function(){
      var categorias = new Array();
      $(this).find('li').each(function(){
        var li = {
          'id':$(this).find('input').prop('value'),
          'nombre':$(this).find('.value').html()
        };
        categorias.push(li);
      });
      ul = {
        'etapa': $(this).prop('id').split("_")[1],
        'categorias': categorias
      };
      ordenGuardar.push(ul);
    });

    $.ajax( {
      url: '/encuesta-intermed/Admin/guardarCambioscategorias',
      type: "POST",
      dataType: 'JSON',
      data: {'data':ordenGuardar},
      async: true,
      success: function (data) {
        if (data.success){
          location.reload();
        }
      },
      error: function (err) {
        console.log( "Error: AJax dead :" + JSON.stringify(err));
      }
    } );
  }

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
        size: 'medium',
        message: "Pregunta: " + $('tr#'+id).find('td.pregunta').html(),
        title: "¿Estas seguro de querer eliminar la pregunta?",
        callback: function(result){
          if (result){
            $.ajax( {
              url: '/encuesta-intermed/Encuesta/eliminarPregunta',
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

    var data2 = {
      pregunta_id: id,
      categoria_id: categoria,
      pregunta: pregunta,
      tipo: tipo,
      opciones: respuestas
    }

    $.ajax( {
      url: '/encuesta-intermed/Encuesta/guardarPregunta',
      type: "POST",
      dataType: 'JSON',
      data: data2,
      async: true,
      success: function (data) {
        if (data.success){
          id = data2.pregunta_id;
          if (id != '' && parseInt(id) >= 0){
            console.log('Modificar');
            $('tr#'+id).find('td.pregunta').html(pregunta);
            $('tr#'+id).find('td.categoria').find('input').prop('value',categoria);
            $('tr#'+id).find('td.categoria').find('.value').html($('#categoriaPreg option:selected').text());
            $('tr#'+id).find('td.tipo').find('input').prop('value',tipo);
            $('tr#'+id).find('td.tipo').find('.value').html($('#tipoPreg option:selected').text());
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
            console.log('Agregar');
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
  }

  var frmOpciones = '<div class="col-sm-2"><label for="opcionAgregar">Opcion: </label></div><div class="col-sm-10"><div class="input-group" style="width: 100%"><input type="text" class="form-control" id="opcionAgregar"/><span class="input-group-btn"><button class="btn btn-success" onclick="agregarOpcion(); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></span></div></div><div class="col-sm-12"><ul class="list-inline text-center" style="margin-top:20px; overflow-x: hidden;" id="opcionesAgregadas"></ul></div>';
  var frmOpcionesComp = '<div class="col-sm-2"><label for="opcionAgregar">Opcion: </label></div><div class="col-sm-10"><div class="input-group" style="width: 100%"><input type="text" class="form-control" id="opcionAgregar"/><span class="input-group-addon"><input type="checkbox" id="comp"> Comp</span><span class="input-group-btn"><button class="btn btn-success" onclick="agregarOpcion(); return false;"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span></button></span></div></div><div class="col-sm-12"><ul class="list-inline text-center" style="margin-top:20px; overflow-x: hidden;" id="opcionesAgregadas"></ul></div>';
</script>
