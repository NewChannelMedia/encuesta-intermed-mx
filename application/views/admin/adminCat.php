<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<input type="hidden" id="totalEtapas" value="<?php echo $etapas; ?>">
<div class="container-fluid flama">
    <div class="row" style="padding:30px;">
            <div class="row" style="padding:30px;">
            <h3>Hojas y Categorías
              <button class="btn btn-success pull-right text-right" onclick="nuevaEtapa()">Agregar hoja <span class="glyphicon glyphicon-plus"></span></button>
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
              /*
              if ($etapas > 0){
                if ($etapas <=4)
                  $width = 12/$etapas;
                else $width = 4;
              }*/

              for ($i=1; $i <= $etapas ; $i++) {
                echo '<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12 id="col_'.$i.'">';
                echo '<div class="panel panel-success" style="min-height: 600px!important;" >';
                echo '<div class="panel-heading text-center" style="font-size:130%">Hoja '. $i .'<span class="glyphicon glyphicon-remove glyphicon-xs" onclick="eliminarEtapa('.$i.')" style="float:right;font-size:70%"></span></div>';
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
          size: 'small',
          message: 'Categoria: ' +liElement.find('span.value').html() +'<br/><br/>Al borrar esta categoría, las preguntas dentro de ella serán enviadas a la categoría "ninguna". <br/><br/>¿Estás de acuerdo?',
          title: "Eliminar categoría",
          callback: function(result){
            if (result){
              var categoria_id = liElement.find('input').prop('value');
             $.ajax( {
               url: '/Admin/eliminarCategoria',
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
            url: '/Admin/nuevaCategoria',
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
          size: 'small',
          message: 'Categorias: <ul>'+ sortable.html()+'</ul>',
          title: "¿Estas seguro de querer eliminar la etapa "+ i +"?",
          callback: function(result){
            if (result){
              $.ajax( {
                url: '/Admin/eliminarEtapa',
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
      url: '/Admin/nuevaEtapa',
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
    var guardar = true;
    $('ul.connectedSortable').each(function(){
      var categorias = new Array();
      $(this).find('li').each(function(){
        var li = {
          'id':$(this).find('input').prop('value'),
          'nombre':$(this).find('.value').html()
        };
        categorias.push(li);
      });
      if (categorias.length == 0 && $(this).prop('id').split("_")[1] != 0){
        guardar = false;
      }
      ul = {
        'etapa': $(this).prop('id').split("_")[1],
        'categorias': categorias
      };
      ordenGuardar.push(ul);
    });

    if (guardar){

    $.ajax( {
      url: '/Admin/guardarCambioscategorias',
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
  } else {
    bootbox.alert({
      size: 'small',
      message: 'No puedes guardar una hoja vacía.',
      title: "No se pueden guardar los cambios"});
  }
  }
</script>
