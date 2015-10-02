/*!
 * Start Bootstrap - Agency Bootstrap Theme (http://startbootstrap.com)
 * Code licensed under the Apache License v2.0.
 * For details, see http://www.apache.org/licenses/LICENSE-2.0.
 */

// jQuery for page scrolling feature - requires jQuery Easing plugin
$( function () {
  $( 'a.page-scroll' ).bind( 'click', function ( event ) {
    var $anchor = $( this );
    $( 'html, body' ).stop().animate( {
      scrollTop: $( $anchor.attr( 'href' ) ).offset().top
    }, 1500, 'easeInOutExpo' );
    event.preventDefault();
  } );
} );

// Highlight the top nav as scrolling occurs
$( 'body' ).scrollspy( {
  target: '.navbar-fixed-top'
} )

// Closes the Responsive Menu on Menu Item Click
$( '.navbar-collapse ul li a' ).click( function () {
  $( '.navbar-toggle:visible' ).click();
} );

$( function () {
  $( "#envioEmail" ).click( function () {
    $( this ).val()
    $.ajax( {
      url: '/encuesta-intermed-mx/codigo/dataPostCorreo',
      type: "POST",
      dataType: 'JSON',
      async: true,
      success: function () {
        $( "#doctor" ).load( '/encuesta-intermed-mx/porValidar/index' )
      },
      error: function () {
        console.log( "Error: AJax dead :(" );
      }
    } );
  } );
} );


/*Funciones encuesta*/

  $('#progress-bar').popover({animation:false});
  $('#progress-bar').popover('show');
  $('.popover.top.in').each(function (index, element){
    $(element).css('left',parseInt($(element).css('left'))-25);
  });

  $( window ).resize(function() {
    $('#progress-bar').popover('show');
    $('.popover.top.in').each(function (index, element){
      $(element).css('left',parseInt($(element).css('left'))-25);
    });
  });

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
        $('#btnguardarysalir').removeClass('btn-default');
        $('#btnguardarycontinuar').removeClass('btn-default');
        $('#btnguardarysalir').addClass('btn-warning');
        $('#btnguardarycontinuar').addClass('btn-success');
        $('#btnguardarysalir').attr("disabled", false);
        $('#btnguardarycontinuar').attr("disabled", false);
      } else {
        $('#btnguardarysalir').removeClass('btn-warning');
        $('#btnguardarycontinuar').removeClass('btn-success');
        $('#btnguardarysalir').addClass('btn-default');
        $('#btnguardarycontinuar').addClass('btn-default');
        $('#btnguardarysalir').attr("disabled", true);
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

/*Fin funciones encuesta*/
