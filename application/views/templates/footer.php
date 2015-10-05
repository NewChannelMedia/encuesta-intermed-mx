    <footer class="footer">
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
    <script src="<?= base_url() ?>js/jquery.js"></script>
    <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
    <script src="<?= base_url() ?>js/bootstrap.min.js"></script>
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
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
        console.log('Validando formulario');
        validarFormulario();
      });

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
  </body>
</html>
