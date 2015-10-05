    <footer class=" footer">
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <img class="footer-logo center-block" src="<?= base_url()?>img/logos/intermedSimple.png">
            <p class="footer-legal flamaBook-normal s15 text-center">
              Todos los Derechos Reservados &copy; 2015 <span class="Flama-normal s20 ls-1">intermed<sup>&reg;</sup></span><br>
              New Channel Media. Guadalajara, Jalisco. Mex.
            </p>
          </div>
        </div>
      </div>
    </footer>
    <!-- Aqui termina el body de la pagina -->
    <!-- jQuery -->
    <script src="<?= base_url() ?>js/jquery.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
    <!--<script src="<?= base_url() ?>js/classie.js"></script>-->
    <!--<script src="<?= base_url() ?>js/cbpAnimatedHeader.js"></script>-->
    <!-- Contact Form JavaScript -->
    <!--<script src="<?= base_url() ?>js/jqBootstrapValidation.js"></script>-->
    <!--<script src="<?= base_url() ?>js/contact_me.js"></script>-->
    <!-- Custom Theme JavaScript -->
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="<?= base_url() ?>js/utils.js"></script>

    <script type="text/javascript">
      history.go(1);

      $(document).ready(function() {
        validarFormulario();
      });

      $(function() {
        $( "·sortable" ).sortable({
          placeholder: "ui-state-highlight"
        });
        $( ".sortable" ).disableSelection();
      });

      $( ".sortable" ).sortable({
        stop: function( event, ui ) {
          var count = 1;
          var opciones = $( ".sortable" ).find( "input[type=hidden]" ).each(function (index, element) {
              $(element).val(count++);
          });
        }
      });

      function guardarysal(){
        $('#continuar').val('0');
        $("#formEnc").submit();
      }

      function guardarycont(){
        $('#continuar').val('1');
        $( "#formEnc" ).submit();
      }

      function regresar(){
        $etapa = $('#etapaResp').val();
        $('#irEtapa').val(--$etapa);
        $('#contenido').html('');
        $( "#formEnc" ).submit();
      }

      function siguiente(){
        $etapa = $('#etapaResp').val();
        $('#irEtapa').val(++$etapa);
        $('#contenido').html('');
        $( "#formEnc" ).submit();
      }

      function comprobar(){
        var arrText= $('input').map(function(){
          if (!this.value){
            this.name = '';
          }
        }).get();
      }

      $('input').change(function(event) {
        validarFormulario();
      });

      function validarFormulario(){
          var continuar = true;
          var formulario = $('form#formEnc').serializeArray();
          $('input').each(function() {
            var field = $(this);
            if (field.prop('name').substring(0, 9) == "respuesta"){
              if (field.prop('type') == "radio"){
                //Buscar por lo menos uno
                var encontrado = false;
                formulario.forEach(function(form){
                  if (form['name'] == field.prop('name')){
                    encontrado = true;
                  }
                });
                if (encontrado == false){
                  continuar = false;
                }
              } else {
                if (field.prop('required') && field.prop('value') == ""){
                  continuar = false;
                }
              }
            } else if (field.prop('name').substring(0, 11) == "complemento"){
              if (field.prop('required') && field.prop('value') == ""){
                continuar = false;
              }
            }
          });
          if (continuar){
            $('#guardarysalir').removeClass('btn-default');
            $('#guardarycontinuar').removeClass('btn-default');
            $('#guardarysalir').addClass('btn-warning');
            $('#guardarycontinuar').addClass('btn-success');
            $('#guardarysalir').attr("disabled", false);
            $('#guardarycontinuar').attr("disabled", false);
          } else {
            $('#guardarysalir').removeClass('btn-warning');
            $('#guardarycontinuar').removeClass('btn-success');
            $('#guardarysalir').addClass('btn-default');
            $('#guardarycontinuar').addClass('btn-default');
            $('#guardarysalir').attr("disabled", true);
            $('#guardarycontinuar').attr("disabled", true);
          }
      }

      function salir(){
        window.location.href = "/encuesta-intermed-mx";
      }

      function LimpiarComplementos(id, comp){
        $("input[name='complemento_" + id +"']").each(function() {
            $(this).val('');
            $(this).prop('required',false);
            $(this).prop('disabled',true);
        });
        if ($('#complemento_' + id + '_' + comp)){
          $('#complemento_'+ id +'_' + comp).prop('required',true);
          $('#complemento_'+ id +'_' + comp).prop('disabled',false);
          $('#complemento_' + id + '_' + comp).focus();
        }
      }

      function aceptarPromocion(){
        var value = $('#promo').prop('checked');
        if (value == true){
          var contenido = '<form method="POST" action="newsletter"><div class="form-group"><label for="nombre">Nombre:</label><input type="text" class="form-control" id="nombre" name="nombre" required></div><div class="form-group"><label for="email">Correo:</label><input type="email" name="email" class="form-control" id="email" required></div><input type="submit" value="Enviar"></form>';
          $('#contenido').html(contenido);
        }else {
          $('#contenido').html('<a href="/encuesta-intermed-mx">Ir a inicio</a>');
        }
      }
    </script>


    <script>

      //MODALES
      function enviarSucces(mail){
          $("#codigoCorreo").html(mail);
      }

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
                      $('#datosPa #tr'+i+'').append('<td><button malto = "'+item.correo+'" onclick="enviarSucces(\''+item.correo+'\')" type = "button" id = "enviarSucces" class = "btn btn-primary" data-toggle="modal" data-target="#aceptarModal">Aceptar</button></td>');
                      $('#datosPa #tr'+i+'').append('<td><button noMalTo = "'+item.correo+'" type = "button" id = "enviarNoSucces" class = "btn btn-danger" data-toggle="modal" data-target="#NoaceptarModal">Rechazar</button></td>');
                  }else{
                      $("#datosPa").append('<tr  id = "t'+i+'"></tr>');
                      $('#datosPa #t'+i+'').append('<td >'+item.id+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.nombre+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.correo+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.cedula+'</td>');
                      $('#datosPa #t'+i+'').append('<td >'+item.justificacion+'</td>');
                      $('#datosPa #t'+i+'').append('<td ><button malto = "'+item.correo+'" onclick="enviarSucces(\''+item.correo+'\')"  type = "button" id = "enviarSucces'+i+'" class = "btn btn-primary"data-toggle="modal" data-target="#aceptarModal">Aceptar</button></td>');
                      $('#datosPa #t'+i+'').append('<td ><button noMalTo = "'+item.correo+'" type = "button" id = "enviarNoSucces" class = "btn btn-danger" data-toggle="modal" data-target="#NoaceptarModal">Rechazar</button></td>');
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
        //genera el codigo y lo mete en el input
        $("#generaCodigo").click(function(){
          //carga ajax para generar el codigo
          $.ajax({
            url: "/encuesta-intermed-mx/codigo/makeCode",
            type: "POST",
            dataType:"JSON",
            success: function(data){
              console.log("dato: "+data);
              $("#aleatorioDato").attr('value',data);
            },
            error: function(e){
              console.log("Aleatorio fallo: "+e);
            }
          });
        });
        //envia el codigo genera a la tabla correspondiente y lo envia por correo
        $("#enviaCodigoGenerado").click(function(){
          if($("#aleatorioDato").val() != ""){
              $.ajax({
                url: '/encuesta-intermed-mx/admin/insertaCodigo/'+$("#aleatorioDato").val(),
                type: "POST",
                dataType: "JSON",
                success:function(data){
                    console.log(data);
                },
                error:function(e){
                  console.log("erorr al insertar el codigo"+e );
                }
              });
              // se envia el correo con los datos correspondientes
              $.ajax({
                url: 'encuesta-intermed-mx/codigo/sendMail/'+$("#codigoCorreo").text()+"/Cedula valida/"+"prueba.php",
                type: "POST",
                success:function(p){
                  alert("correo enviado");
                },
                error: function(e){
                  alert("correo no enviado: "+e);
                }
              });
          }else{
            alert("Debe de generar un codigo primero");
          }
        });
        $("#enviarNoSucces").click(function(){
          $("#NoaceptarModal").modal('show');
        });
      });
    </script>
  </body>
</html>
