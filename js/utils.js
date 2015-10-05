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

//radio on change hide div
$( function () {
  $( '#medicoRadio' ).click( function () {
    if ( $( this ).prop( "checked", true ) ) {
      $( "#medicoSolicitud" ).removeClass( "hidden" );
      $( "#usuarioSolicitud" ).addClass( "hidden" );
    }
  } );
  $( '#usuarioRadio' ).click( function () {
    if ( $( this ).prop( "checked", true ) ) {
      $( "#medicoSolicitud" ).addClass( "hidden" );
      $( "#usuarioSolicitud" ).removeClass( "hidden" );
    }
  } );
} );


/*Funciones encuesta*/

$( '#progress-bar-current' ).popover( {
  animation: false
} );
$( '#progress-bar-current' ).popover( 'show' );
$( '.popover.top.in' ).each( function ( index, element ) {
  $( element ).css( 'left', ( parseInt( $( element ).css( 'left' ) ) - 25 + parseInt( $( '#progress-bar-current' ).css( 'width' ) ) / 2 ) );
} );

$( window ).resize( function () {
  $( '#progress-bar-current' ).popover( 'show' );
  $( '.popover.top.in' ).each( function ( index, element ) {
    $( element ).css( 'left', ( parseInt( $( element ).css( 'left' ) ) - 25 + parseInt( $( '#progress-bar-current' ).css( 'width' ) ) / 2 ) );
  } );
} );

history.go( 1 );

$( document ).ready( function () {
  validarFormulario();
} );

$( function () {
  $( "·sortable" ).sortable( {
    placeholder: "ui-state-highlight"
  } );
  $( ".sortable" ).disableSelection();
} );

$( ".sortable" ).sortable( {
  stop: function ( event, ui ) {
    var count = 1;
    var opciones = $( ".sortable" ).find( "input[type=hidden]" ).each( function ( index, element ) {
      $( element ).val( count++ );
    } );
  }
} );

function guardarysal() {
  $( '#continuar' ).val( '0' );
  $( "#formEnc" ).submit();
}

function guardarycont() {
  $( '#continuar' ).val( '1' );
  $( "#formEnc" ).submit();
}

function regresar() {
  $etapa = $( '#etapaResp' ).val();
  $( '#irEtapa' ).val( --$etapa );
  $( '#contenido' ).html( '' );
  $( "#formEnc" ).submit();
}

function siguiente() {
  $etapa = $( '#etapaResp' ).val();
  $( '#irEtapa' ).val( ++$etapa );
  $( '#contenido' ).html( '' );
  $( "#formEnc" ).submit();
}

function comprobar() {
  var arrText = $( 'input' ).map( function () {
    if ( !this.value ) {
      this.name = '';
    }
  } ).get();
}

$( 'input' ).change( function ( event ) {
  validarFormulario();
} );

function validarFormulario() {
  var continuar = true;
  var formulario = $( 'form#formEnc' ).serializeArray();
  $( 'input' ).each( function () {
    var field = $( this );
    if ( field.prop( 'name' ).substring( 0, 9 ) == "respuesta" ) {
      if ( field.prop( 'type' ) == "radio" ) {
        //Buscar por lo menos uno
        var encontrado = false;
        formulario.forEach( function ( form ) {
          if ( form[ 'name' ] == field.prop( 'name' ) ) {
            encontrado = true;
          }
        } );
        if ( encontrado == false ) {
          continuar = false;
        }
      }
      else {
        if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
          continuar = false;
        }
      }
    }
    else if ( field.prop( 'name' ).substring( 0, 11 ) == "complemento" ) {
      if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
        continuar = false;
      }
    }
  } );
  if ( continuar ) {
    $( '#btnguardarysalir' ).removeClass( 'btn-default' );
    $( '#btnguardarycontinuar' ).removeClass( 'btn-default' );
    $( '#btnguardarysalir' ).addClass( 'btn-warning' );
    $( '#btnguardarycontinuar' ).addClass( 'btn-success' );
    $( '#btnguardarysalir' ).attr( "disabled", false );
    $( '#btnguardarycontinuar' ).attr( "disabled", false );
  }
  else {
    $( '#btnguardarysalir' ).removeClass( 'btn-warning' );
    $( '#btnguardarycontinuar' ).removeClass( 'btn-success' );
    $( '#btnguardarysalir' ).addClass( 'btn-default' );
    $( '#btnguardarycontinuar' ).addClass( 'btn-default' );
    $( '#btnguardarysalir' ).attr( "disabled", true );
    $( '#guardarycontinuar' ).attr( "disabled", true );
  }
}

function salir() {
  window.location.href = "/encuesta-intermed-mx";
}

function LimpiarComplementos( id, comp ) {
  $( "input[name='complemento_" + id + "']" ).each( function () {
    $( this ).val( '' );
    $( this ).prop( 'required', false );
    $( this ).prop( 'disabled', true );
  } );
  if ( $( '#complemento_' + id + '_' + comp ) ) {
    $( '#complemento_' + id + '_' + comp ).prop( 'required', true );
    $( '#complemento_' + id + '_' + comp ).prop( 'disabled', false );
    $( '#complemento_' + id + '_' + comp ).focus();
  }
}

function aceptarPromocion() {
  var value = $( '#promo' ).prop( 'checked' );
  if ( value == true ) {
    var contenido = '<form method="POST" action="newsletter">' +
      '<div class="form-group">' +
      '<label for="nombre">Nombre:</label>' +
      '<input type="text" class="form-control" id="nombre" name="nombre" required>' +
      '</div>' +
      '<div class="form-group">' +
      '<label for="email">Correo:</label>' +
      '<input type="email" name="email" class="form-control" id="email" required>' +
      '</div>' +
      '<input type="submit" value="Enviar" class="btn btn-success btn-lg btn-block"></form>' +
      '</div>';
    $( '#contenido' ).html( contenido );
  }
  else {
    $( '#contenido' ).html( '' );
  }
}

function validarMoneda( e, item ) {
  var aceptarPunto = false;
  if ( parseInt( $( item ).val().indexOf( "." ) ) == -1 && $( item ).val().length > 0 ) aceptarPunto = true;
  var key = window.Event ? e.which : e.keyCode;
  return ( ( key >= 48 && key <= 57 ) || ( key == 8 ) || ( key == 46 && aceptarPunto ) )
}

function formatoMoneda( item ) {
  if ( $( item ).val().length > 0 )
    $( item ).val( parseFloat( $( item ).val(), 10 ).toFixed( 2 ) );
}

/*Fin funciones encuesta*/


/*funciones del admin etc */
//MODALES
function enviarSucces( mail ) {
  $( "#codigoCorreo" ).html( mail );
}

$( document ).ready( function () {
  $( "#pAceptar" ).click( function () {
    $( "#porAceptar" ).removeClass( 'hidden' );
    $( "#noAceptadas" ).addClass( 'hidden' );
    $( "#aceptados" ).addClass( 'hidden' );

    //se carga el ajax para la carga de las tablas
    $.ajax( {
      url: '/encuesta-intermed-mx/admin/porAceptar',
      type: 'POST',
      dataType: 'JSON',
      success: function ( data ) {
        //cara de los datos
        $( "#datosPa" ).html( '' );
        $.each( data, function ( i, item ) {
          if ( item.status == "0" ) {
            if ( item.medico != "1" ) {
              $( "#datosPa" ).append( '<tr class = "danger" id="tr' + i + '"></tr>' );
              $( '#datosPa #tr' + i + '' ).append( '<td >' + item.id + '</td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td>' + item.nombre + '</td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td>' + item.correo + '</td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td>' + item.cedula + '</td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td>' + item.justificacion + '</td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td><button malto = "' + item.correo + '" onclick="enviarSucces(\'' + item.correo + '\')" type = "button" id = "enviarSucces" class = "btn btn-primary" data-toggle="modal" data-target="#aceptarModal">Aceptar</button></td>' );
              $( '#datosPa #tr' + i + '' ).append( '<td><button noMalTo = "' + item.correo + '" type = "button" id = "enviarNoSucces" class = "btn btn-danger" data-toggle="modal" data-target="#NoaceptarModal">Rechazar</button></td>' );
            }
            else {
              $( "#datosPa" ).append( '<tr  id = "t' + i + '"></tr>' );
              $( '#datosPa #t' + i + '' ).append( '<td >' + item.id + '</td>' );
              $( '#datosPa #t' + i + '' ).append( '<td >' + item.nombre + '</td>' );
              $( '#datosPa #t' + i + '' ).append( '<td >' + item.correo + '</td>' );
              $( '#datosPa #t' + i + '' ).append( '<td >' + item.cedula + '</td>' );
              $( '#datosPa #t' + i + '' ).append( '<td >' + item.justificacion + '</td>' );
              $( '#datosPa #t' + i + '' ).append( '<td ><button malto = "' + item.correo + '" onclick="enviarSucces(\'' + item.correo + '\')"  type = "button" id = "enviarSucces' + i + '" class = "btn btn-primary"data-toggle="modal" data-target="#aceptarModal">Aceptar</button></td>' );
              $( '#datosPa #t' + i + '' ).append( '<td ><button noMalTo = "' + item.correo + '" type = "button" id = "enviarNoSucces" class = "btn btn-danger" data-toggle="modal" data-target="#NoaceptarModal">Rechazar</button></td>' );
            }
          }
        } );
      },
      error: function ( e ) {
        console.log( "Error a cargar la tabla por aceptar: Error 1023: " + e );
      }
    } );
  } );
  $( "#nAceptar" ).click( function () {
    $( "#noAceptadas" ).removeClass( 'hidden' );
    $( "#aceptados" ).addClass( 'hidden' );
    $( "#porAceptar" ).addClass( 'hidden' );
    $.ajax( {
      url: '/encuesta-intermed-mx/admin/porAceptar',
      type: 'POST',
      dataType: 'JSON',
      success: function ( data ) {
        $( "#nAceptados" ).html( '' );
        $.each( data, function ( i, item ) {
          if ( item.status == "2" ) {
            $( "#nAceptados" ).append( '<tr  id = "pt' + i + '"></tr>' );
            $( '#nAceptados #pt' + i + '' ).append( '<td >' + item.id + '</td>' );
            $( '#nAceptados #pt' + i + '' ).append( '<td>' + item.nombre + '</td>' );
            $( '#nAceptados #pt' + i + '' ).append( '<td>' + item.correo + '</td>' );
            $( '#nAceptados #pt' + i + '' ).append( '<td>' + item.cedula + '</td>' );
            $( '#nAceptados #pt' + i + '' ).append( '<td>' + item.justificacion + '</td>' );
          }
        } );
      },
      error: function ( e ) {
        console.log( "Error: no se pudo load la tabla: " + e );
      }
    } );
  } );
  $( "#paceptados" ).click( function () {
    $( "#aceptados" ).removeClass( 'hidden' );
    $( "#porAceptar" ).addClass( 'hidden' );
    $( "#noAceptadas" ).addClass( 'hidden' );
    $.ajax( {
      url: '/encuesta-intermed-mx/admin/porAceptar',
      type: 'POST',
      dataType: 'JSON',
      success: function ( data ) {
        $( "#idAceptados" ).html( '' );
        $.each( data, function ( i, item ) {
          if ( item.status == "1" ) {
            $( "#idAceptados" ).append( '<tr  id = "te' + i + '"></tr>' );
            $( '#idAceptados #te' + i + '' ).append( '<td >' + item.id + '</td>' );
            $( '#idAceptados #te' + i + '' ).append( '<td >' + item.nombre + '</td>' );
            $( '#idAceptados #te' + i + '' ).append( '<td >' + item.correo + '</td>' );
            $( '#idAceptados #te' + i + '' ).append( '<td >' + item.cedula + '</td>' );
            $( '#idAceptados #te' + i + '' ).append( '<td >' + item.justificacion + '</td>' );
          }
        } );
      },
      error: function ( e ) {
        console.log( "Error al cargar los aceptados: " + e );
      }
    } );
  } );
  //genera el codigo y lo mete en el input
  $( "#generaCodigo" ).click( function () {
    //carga ajax para generar el codigo
    $.ajax( {
      url: "/encuesta-intermed-mx/codigo/makeCode",
      type: "POST",
      dataType: "JSON",
      success: function ( data ) {
        console.log( "dato: " + data );
        $( "#aleatorioDato" ).attr( 'value', data );
      },
      error: function ( e ) {
        console.log( "Aleatorio fallo: " + e );
      }
    } );
  } );
  //envia el codigo genera a la tabla correspondiente y lo envia por correo
  $( "#enviaCodigoGenerado" ).click( function () {
    if ( $( "#aleatorioDato" ).val() != "" ) {
      $.ajax( {
        url: '/encuesta-intermed-mx/admin/insertaCodigo/' + $( "#aleatorioDato" ).val(),
        type: "POST",
        dataType: "JSON",
        success: function ( data ) {
          console.log( data );
        },
        error: function ( e ) {
          console.log( "erorr al insertar el codigo" + e );
        }
      } );
      // se envia el correo con los datos correspondientes
      $.ajax( {
        url: 'encuesta-intermed-mx/codigo/sendMail/' + $( "#codigoCorreo" ).text() + "/Cedula valida/" + "prueba.php",
        type: "POST",
        success: function ( p ) {
          alert( "correo enviado" );
        },
        error: function ( e ) {
          alert( "correo no enviado: " + e );
        }
      } );
    }
    else {
      alert( "Debe de generar un codigo primero" );
    }
  } );
  $( "#enviarNoSucces" ).click( function () {
    $( "#NoaceptarModal" ).modal( 'show' );
  } );
} );
