    <!-- Aqui termina el body de la pagina -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <script src="<?= base_url() ?>js/classie.js"></script>
    <script src="<?= base_url() ?>js/cbpAnimatedHeader.js"></script>
    <!-- Contact Form JavaScript -->
    <!--<script src="<?= base_url() ?>js/jqBootstrapValidation.js"></script>-->
    <!--<script src="<?= base_url() ?>js/contact_me.js"></script>-->
    <!-- Custom Theme JavaScript -->
    <script src="<?= base_url() ?>js/utils.js"></script>
    <script>
      $(document).ready(function(){
        $("#pAceptar").click(function(){
          $("#porAceptar").removeClass('hidden');
          $("#noAceptadas").addClass('hidden');
          $("#aceptados").addClass('hidden');
          //se carga el ajax para la carga de las tablas
          $.ajax({
            url:'/encuesta-intermed-mx/admin/porAceptar',
            type:'POST',
            dataType:'JSON',
            success: function(data){
              //cara de los datos
              $("#datosPa").html('');
              $.each(data, function(i, item){
                if( item.status == "0"){
                  if( item.medico != "1"){
                      $("#datosPa").append('<tr class = "danger" id="tr'+i+'"></tr>');
                      $('#datosPa #tr'+i+'').append('<td >'+item.id+'</td>');
                      $('#datosPa #tr'+i+'').append('<td>'+item.nombre+'</td>');
                      $('#datosPa #tr'+i+'').append('<td>'+item.correo+'</td>');
                      $('#datosPa #tr'+i+'').append('<td>'+item.cedula+'</td>');
                      $('#datosPa #tr'+i+'').append('<td>'+item.justificacion+'</td>');
                      $('#datosPa #tr'+i+'').append('<td><button type = "button" id = "enviarSucces" class = "btn btn-primary">Aceptar</button></td>');
                      $('#datosPa #tr'+i+'').append('<td><button type = "button" id = "enviarNoSucces" class = "btn btn-danger">Rechazar</button></td>');
                  }else{
                      $("#datosPa").append('<tr  id = "t'+i+'"></tr>');
                      $('#datosPa #t'+i+'').append('<td >'+item.id+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.nombre+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.correo+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.cedula+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.justificacion+'</td>');
                      $('#datosPa #t'+i+'').append('<td ><button type = "button" id = "enviarSucces" class = "btn btn-primary">Aceptar</button></td>');
                      $('#datosPa #t'+i+'').append('<td ><button type = "button" id = "enviarNoSucces" class = "btn btn-danger">Rechazar</button></td>');
                  }
                }
              });
            },
            error: function(e){
              console.log("Error a cargar la tabla por aceptar: Error 1023: "+e);
            }
          });
        });
        $("#nAceptar").click(function(){
            $("#noAceptadas").removeClass('hidden');
            $("#aceptados").addClass('hidden');
            $("#porAceptar").addClass('hidden');
            $.ajax({
              url:'/encuesta-intermed-mx/admin/porAceptar',
              type:'POST',
              dataType:'JSON',
              success: function(data){
                $("#nAceptados").html('');
                $.each(data, function(i, item){
                  if( item.status == "2"){
                    $("#nAceptados").append('<tr  id = "pt'+i+'"></tr>');
                    $('#nAceptados #pt'+i+'').append('<td >'+item.id+'</td>');
                    $('#nAceptados #pt'+i+'').append('<td>'+item.nombre+'</td>');
                    $('#nAceptados #pt'+i+'').append('<td>'+item.correo+'</td>');
                    $('#nAceptados #pt'+i+'').append('<td>'+item.cedula+'</td>');
                    $('#nAceptados #pt'+i+'').append('<td>'+item.justificacion+'</td>');
                  }
                });
              },
              error: function(e){
                console.log("Error: no se pudo load la tabla: "+e);
              }
            });
        });
        $("#paceptados").click(function(){
          $("#aceptados").removeClass('hidden');
          $("#porAceptar").addClass('hidden');
          $("#noAceptadas").addClass('hidden');
          $.ajax({
            url:'/encuesta-intermed-mx/admin/porAceptar',
            type:'POST',
            dataType:'JSON',
            success: function(data){
              $("#idAceptados").html('');
              $.each(data, function(i, item){
                if(item.status == "1"){
                  $("#idAceptados").append('<tr  id = "te'+i+'"></tr>');
                  $('#idAceptados #te'+i+'').append('<td >'+item.id+'</td>');
                  $('#idAceptados #te'+i+'').append('<td >'+item.nombre+'</td>');
                  $('#idAceptados #te'+i+'').append('<td >'+item.correo+'</td>');
                  $('#idAceptados #te'+i+'').append('<td >'+item.cedula+'</td>');
                  $('#idAceptados #te'+i+'').append('<td >'+item.justificacion+'</td>');
                }
              });
            },
            error:function(e){
              console.log("Error al cargar los aceptados: "+e);
            }
          });
        });
      });
    </script>
  </body>
</html>
