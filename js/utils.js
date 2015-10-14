$( function () {
  $( "#envioEmail" ).click( function () {
    $( this ).val()
    $.ajax( {
      url: '/encuesta-intermed/codigo/dataPostCorreo',
      type: "POST",
      dataType: 'JSON',
      async: true,
      success: function () {
        $( "#doctor" ).load( '/encuesta-intermed/porValidar/index' )
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
$( window ).resize( function () {
  $( '#progress-bar-current' ).popover( 'show' );
  $( '.popover.top.in' ).each( function ( index, element ) {
    $( element ).css( 'left', ( parseInt( $( element ).css( 'left' ) ) - 25 + parseInt( $( '#progress-bar-current' ).css( 'width' ) ) / 2 ) );
  } );
} );

$( document ).ready( function () {
  validarFormulario();
  //Popover de progreso
  $( '#progress-bar-current' ).popover( {
    animation: false
  } );
  $( '#progress-bar-current' ).popover( 'show' );
  $( '.popover.top.in' ).each( function ( index, element ) {
    $( element ).css( 'left', ( parseInt( $( element ).css( 'left' ) ) - 25 + parseInt( $( '#progress-bar-current' ).css( 'width' ) ) / 2 ) );
  } );
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
  if ( !( $( '#btnguardarysalir' ).hasClass( 'notEnabled' ) ) ) {
    $( '#continuar' ).val( '0' );
    $( "#formEnc" ).submit();
  }
  else {
    $( '#encError' ).html( '<div class="alert alert-danger" role="alert" id="danger-alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Por favor contesta las preguntas faltantes.</div>' );
    marcarFaltantes();
    $( "#danger-alert" ).fadeTo( 2000, 500 ).slideUp( 500, function () {
      $( "#danger-alert" ).alert( 'close' );
      $( '#encError' ).html( '' );
    } );
  }
}

function guardarycont() {
  if ( !( $( '#btnguardarycontinuar' ).hasClass( 'notEnabled' ) ) ) {
    $( '#continuar' ).val( '1' );
    $( "#formEnc" ).submit();
  }
  else {
    $( '#encError' ).html( '<div class="alert alert-danger" role="alert" id="danger-alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Por favor contesta las preguntas faltantes.</div>' );
    marcarFaltantes();
    $( "#danger-alert" ).fadeTo( 2000, 500 ).slideUp( 500, function () {
      $( "#danger-alert" ).alert( 'close' );
      $( '#encError' ).html( '' );
    } );
  }
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

function marcarFaltantes() {
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
          field.parent().parent().addClass( "has-error" );
          field.parent().parent().focusin( function () {
            $( this ).removeClass( "has-error" );
            $( this ).find( 'label' ).removeClass( "has-error" );
          } );
        }
      }
      else {
        if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
          field.parent().parent().addClass( "has-error" );
          field.parent().parent().focusin( function () {
            $( this ).removeClass( "has-error" );
            $( this ).find( 'label' ).removeClass( "has-error" );
          } );
        }
      }
    }
    else if ( field.prop( 'name' ).substring( 0, 11 ) == "complemento" ) {
      if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
        field.parent().addClass( "has-error" );
        field.parent().focusin( function () {
          $( this ).removeClass( "has-error" );
          $( this ).find( 'label' ).removeClass( "has-error" );
        } );
      }
    }
  } );
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
    $( '#btnguardarycontinuar' ).removeClass( 'notEnabled' );
    $( '#btnguardarysalir' ).removeClass( 'btn-default' );
    $( '#btnguardarycontinuar' ).removeClass( 'btn-default' );
    $( '#btnguardarysalir' ).addClass( 'btn-warning' );
    $( '#btnguardarycontinuar' ).addClass( 'btn-success' );
    //$( '#btnguardarysalir' ).attr( "disabled", false );
    //$( '#btnguardarycontinuar' ).attr( "disabled", false );
  }
  else {
    $( '#btnguardarysalir' ).removeClass( 'btn-warning' );
    $( '#btnguardarycontinuar' ).removeClass( 'btn-success' );
    $( '#btnguardarysalir' ).addClass( 'btn-default' );
    $( '#btnguardarycontinuar' ).addClass( 'btn-default' );
    $( '#btnguardarycontinuar' ).addClass( 'notEnabled' );
    //$( '#btnguardarysalir' ).attr( "disabled", true );
    //$( '#btnguardarycontinuar' ).attr( "disabled", true );
  }
}

function salir() {
  window.location.href = "/encuesta-intermed";
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

function HabilitarComplementos( id, comp ) {
  if ( $( '#respuesta_' + id + '_' + comp ).is( ':checked' ) ) {
    $( '#complemento_' + id + '_' + comp ).prop( 'required', true );
    $( '#complemento_' + id + '_' + comp ).prop( 'disabled', false );
  }
  else {
    $( '#complemento_' + id + '_' + comp ).val( '' );
    $( '#complemento_' + id + '_' + comp ).prop( 'required', false );
    $( '#complemento_' + id + '_' + comp ).prop( 'disabled', true );
  }
}

function aceptarNewsletter() {
  var pruebasCheck = $( '#pruebasCheck' ).prop( 'checked' );
  var newsCheck = $( '#newsCheck' ).prop( 'checked' );
  if ( pruebasCheck == true ) {
    $('#pruebas').val(1);
  } else{
    $('#pruebas').val(0);
  }
  if ( newsCheck == true ) {
    $('#newsletter').val(1);
  } else{
    $('#newsletter').val(0);
  }
  if ( pruebasCheck == true || newsCheck == true ) {
    $( '#contenido' ).removeClass('hidden invisible');
  }
  else {
    $( '#contenido' ).addClass('hidden invisible');
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
function enviarSucces( mail, id ) {
  $( "#codigoCorreo" ).html( mail );
  $( "#codigoUser" ).html( id );
}

function enviarNoSuccesL( mail, id ) {
  $( "#rechazos" ).html( mail );
  $( "#rechazosID" ).html( id );
}

function cargaPorAceptar() {
  $.ajax( {
    url: '/encuesta-intermed/admin/porAceptar',
    type: 'POST',
    dataType: 'JSON',
    success: function ( data ) {
      //cara de los datos
      $( "#datosPa" ).html( '' );
      $.each( data, function ( i, item ) {
        if ( item.status == "0" ) {
          if ( item.medico != "1" ) {
            $( "#datosPa" ).append( '<tr class="bg-medico" id="tr' + i + '"></tr>' );
            $( '#datosPa #tr' + i + '' ).append( '<td >' + item.id + '</td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td>' + item.nombre + '</td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td>' + item.correo + '</td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td>' + item.cedula + '</td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td>' + item.justificacion + '</td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td><button malto="' + item.correo + '" onclick="enviarSucces(\'' + item.correo + '\',\'' + item.id + '\')" type="button" id="enviarSucces" class="btn btn-success btn-block" data-toggle="modal" data-target="#aceptarModal"><span class="glyphicon glyphicon-ok"></span></button></td>' );
            $( '#datosPa #tr' + i + '' ).append( '<td><button noMalTo="' + item.correo + '" type="button" onclick="enviarNoSuccesL(\'' + item.correo + '\',\'' + item.id + '\')" id="enviarNoSucces" class="btn btn-danger btn-block" data-toggle="modal" data-target="#NoaceptarModal"><span class="glyphicon glyphicon-remove"></span></button></td>' );
          }
          else {
            $( "#datosPa" ).append( '<tr class="bg-otro" id="t' + i + '"></tr>' );
            $( '#datosPa #t' + i + '' ).append( '<td >' + item.id + '</td>' );
            $( '#datosPa #t' + i + '' ).append( '<td >' + item.nombre + '</td>' );
            $( '#datosPa #t' + i + '' ).append( '<td >' + item.correo + '</td>' );
            $( '#datosPa #t' + i + '' ).append( '<td >' + item.cedula + '</td>' );
            $( '#datosPa #t' + i + '' ).append( '<td >' + item.justificacion + '</td>' );
            $( '#datosPa #t' + i + '' ).append( '<td ><button malto="' + item.correo + '" onclick="enviarSucces(\'' + item.correo + '\',\'' + item.id + '\')"  type="button" id="enviarSucces' + i + '" class="btn btn-success btn-block"data-toggle="modal" data-target="#aceptarModal"><span class="glyphicon glyphicon-ok"></span></button></td>' );
            $( '#datosPa #t' + i + '' ).append( '<td ><button noMalTo="' + item.correo + '" onclick="enviarNoSuccesL(\'' + item.correo + '\',\'' + item.id + '\')" type="button" id="enviarNoSucces" class="btn btn-danger btn-block" data-toggle="modal" data-target="#NoaceptarModal"><span class="glyphicon glyphicon-remove"></span></button></td>' );
          }
        }
      } );
    },
    error: function ( e ) {
      console.log( "Error a cargar la tabla por aceptar: Error 1023: " + e );
    }
  } );
}

function cargaNoAceptados() {
  $.ajax( {
    url: '/encuesta-intermed/admin/porAceptar',
    type: 'POST',
    dataType: 'JSON',
    success: function ( data ) {
      $( "#datosNa" ).html( '' );
      $.each( data, function ( i, item ) {
        if ( item.status == "2" ) {
          $( "#datosNa" ).append( '<tr  id="pt' + i + '"></tr>' );
          $( '#datosNa #pt' + i + '' ).append( '<td >' + item.id + '</td>' );
          $( '#datosNa #pt' + i + '' ).append( '<td>' + item.nombre + '</td>' );
          $( '#datosNa #pt' + i + '' ).append( '<td>' + item.correo + '</td>' );
          $( '#datosNa #pt' + i + '' ).append( '<td>' + item.cedula + '</td>' );
          $( '#datosNa #pt' + i + '' ).append( '<td>' + item.justificacion + '</td>' );
        }
      } );
    },
    error: function ( e ) {
      console.log( "Error: no se pudo load la tabla: " + e );
    }
  } );
}

function cargaAceptados() {
  $.ajax( {
    url: '/encuesta-intermed/admin/porAceptar',
    type: 'POST',
    dataType: 'JSON',
    success: function ( data ) {
      $( "#datosSa" ).html( '' );
      $.each( data, function ( i, item ) {
        if ( item.status == "1" ) {
          $( "#datosSa" ).append( '<tr  id="te' + i + '"></tr>' );
          $( '#datosSa #te' + i + '' ).append( '<td >' + item.id + '</td>' );
          $( '#datosSa #te' + i + '' ).append( '<td >' + item.nombre + '</td>' );
          $( '#datosSa #te' + i + '' ).append( '<td >' + item.correo + '</td>' );
          $( '#datosSa #te' + i + '' ).append( '<td >' + item.cedula + '</td>' );
          $( '#datosSa #te' + i + '' ).append( '<td >' + item.justificacion + '</td>' );
        }
      } );
    },
    error: function ( e ) {
      console.log( "Error al cargar los aceptados: " + e );
    }
  } );
}

$( document ).ready( function () {
  cargaPorAceptar();
} );

$( document ).ready( function () {
  $( "#pAceptar" ).click( function () {
    $( "#pAceptar" ).parent().addClass( 'active' );
    $( "#nAceptar" ).parent().removeClass( 'active' );
    $( "#paceptados" ).parent().removeClass( 'active' );

    $( "#porAceptar" ).removeClass( 'hidden' );
    $( "#noAceptadas" ).addClass( 'hidden' );
    $( "#aceptados" ).addClass( 'hidden' );

    //se carga el ajax para la carga de las tablas
    cargaPorAceptar();
  } );

  $( "#nAceptar" ).click( function () {
    $( "#pAceptar" ).parent().removeClass( 'active' );
    $( "#nAceptar" ).parent().addClass( 'active' );
    $( "#paceptados" ).parent().removeClass( 'active' );

    $( "#noAceptadas" ).removeClass( 'hidden' );
    $( "#aceptados" ).addClass( 'hidden' );
    $( "#porAceptar" ).addClass( 'hidden' );
    cargaNoAceptados();
  } );

  $( "#paceptados" ).click( function () {
    $( "#pAceptar" ).parent().removeClass( 'active' );
    $( "#nAceptar" ).parent().removeClass( 'active' );
    $( "#paceptados" ).parent().addClass( 'active' );

    $( "#aceptados" ).removeClass( 'hidden' );
    $( "#porAceptar" ).addClass( 'hidden' );
    $( "#noAceptadas" ).addClass( 'hidden' );
    cargaAceptados();
  } );

  $( "#generaCodigo" ).click( function () {
    //carga ajax para generar el codigo
    $.ajax( {
      url: "/encuesta-intermed/codigo/makeCode",
      type: "POST",
      dataType: "JSON",
      success: function ( data ) {
        $( "#aleatorioDato" ).attr( 'value', data );
      },
      error: function ( e ) {
        console.log( "Aleatorio fallo: " + e );
      }
    } );
  } );
  $( "#enviarTodo" ).click( function () {
    var codigo = $( "#aleatorioDato" ).val();
    var correo = $( "#codigoCorreo" ).text();
    var titulo = 'Cedula valida';
    var valor = parseInt( $( "#codigoUser" ).text() ) - 1;
    var mensaje = $( "#mensajeAceptado" ).val();
    var ids = '#tr' + valor;
    var id = '#t' + valor;
    var estado = 1;
    var spanId = $( "#codigoUser" ).text();
    if ( $( "#aleatorioDato" ).val() != "" ) {
      $.post( '/encuesta-intermed/admin/insertaCodigo/' + $( "#aleatorioDato" ).val(), function ( data ) {
        $.post( '/encuesta-intermed/codigo/sendMail/', {
          codigo: codigo,
          correo: correo,
          titulo: titulo,
          mensaje: mensaje,
          estado: estado
        }, function ( datas ) {
          $.post( '/encuesta-intermed/codigo/actualizaStatus/', {
            correo: correo,
            ids: spanId
          }, function ( datase ) {} ).done( function () {
            alert( "Campo actualizado y se envio el correo" );
            $( ids ).hide( 'slow' );
            $( id ).hide( 'slow' );
            $( '.modal' ).modal( 'hide' );
            $( "#aleatorioDato" ).attr( 'value', '' );
            $( "#mensajeAceptado" ).val( '' );
          } );
        } );
      } );
    }
    else {
      alert( "Se debe de generar un código primero" );
    }
  } );
  // envia el correo de rechazo y actualiza el status a 2 para que aparesca en no aceptados
  $( "#envioRechazado" ).click( function () {
    var mail = $( "#rechazos" ).text();
    var titulo = 'Por el momento no joven';
    var mensaje = $( "#areaRechazado" ).val();
    var valor = parseInt( $( "#rechazosID" ).text() ) - 1;
    var ids = '#tr' + valor;
    var id = '#t' + valor;
    var spanId = $( "#rechazosID" ).text();
    $.post( '/encuesta-intermed/codigo/sendMail/', {
      correo: mail,
      titulo: titulo,
      mensaje: mensaje
    }, function ( data ) {
      $.post( '/encuesta-intermed/codigo/negado', {
        correo: mail,
        ids: spanId
      }, function ( negado ) {} ).done( function () {
        alert( "Usuario rechazado, correo enviado...." );
        $( "#areaRechazado" ).val( '' );
        $( '.modal' ).modal( 'hide' );
        $( ids ).hide( 'slow' );
        $( id ).hide( 'slow' );
      } );
    } );
  } );
  //cerrar session
  $( "#salir" ).click( function () {
    $.post( '/encuesta-intermed/admin/cerrar/', function ( data ) {} ).done( function () {
      window.location = '/encuesta-intermed/admin/index';
    } ).fail( function () {
      console.log( "ERROR AL CERRAR SESSION" );
    } );
  } );
  $( "#enviarNoSucces" ).click( function () {
    $( "#NoaceptarModal" ).modal( 'show' );
  } );
} );

/* ---------- */
/* admin menu */
$( "#menu-toggle" ).click( function ( e ) {
  e.preventDefault();
  $( "#wrapper" ).toggleClass( "toggled" );
} );
$( ".navbar-brand" ).click( function ( e ) {
  e.preventDefault();
  $( "#wrapper" ).toggleClass( "toggled-2" );
  $( '#menu ul' ).hide();
} );
$( "#menu-toggle-2" ).click( function ( e ) {
  e.preventDefault();
  $( "#wrapper" ).toggleClass( "toggled-2" );
  $( '#menu ul' ).hide();
} );

function initMenu() {
  $( '#menu ul' ).hide();
  $( '#menu ul' ).children( '.current' ).parent().show();
  //$('#menu ul:first').show();
  $( '#menu li a' ).hover(
    function () {
      var checkElement = $( this ).next();
      if ( ( checkElement.is( 'ul' ) ) && ( checkElement.is( ':visible' ) ) ) {
        return false;
      }
      if ( ( checkElement.is( 'ul' ) ) && ( !checkElement.is( ':visible' ) ) ) {
        $( '#menu ul:visible' ).slideUp( 'normal' );
        checkElement.slideDown( 'normal' );
        return false;
      }
    }
  );
  $( '#page-content-wrapper' ).hover(
    function () {
      var checkElement = $( '#menu' ).find( 'ul' );
      if ( checkElement.is( ':visible' ) ) {
        checkElement.slideUp( 'normal' );
        return false;
      }
    }
  );
}
$( document ).ready( function () {
  initMenu();
} );


function modificarConsulta( comp, tipo ) {
  if ( !tipo ) {
    tipo = $( '#tipoGrafica' ).val();
    if ( !tipo ) {
      tipo = 'Bar';
    }
  }
  $( '#tipoGrafica' ).val( tipo );



  /*Eliminar complementos que sean pasados a 'columna_preguntas'*/
  $( '#columna_preguntas .portlet' ).each( function ( index, element ) {
    if ( $( element ).attr( 'id' ).indexOf( '_comp' ) === true || $( element ).attr( 'id' ).indexOf( '_comp' ) > 0 ) {
      $( '#' + $( element ).attr( 'id' ).substring( 0, $( element ).attr( 'id' ).length - 5 ) ).prop( 'checked', false );
      $( element ).remove();
    }
  } );

  if ( comp && comp.complemento && comp.complemento.length > 0 ) {
    if ( $( '#' + comp.id ).prop( 'checked' ) ) {
      var nuevoPanel = '<div class=\'portlet panel panel-info\' id=\'' + comp.id + '_comp\'><div class=\'portlet-header panel-heading\'>';
      nuevoPanel += '***' + comp.pregunta + ' <strong>[' + comp.respuesta + ']</strong>';
      nuevoPanel += '</div><div class=\'portlet-content panel-body\'>';
      nuevoPanel += '<ul style=\'list-style:none;\'>';
      var int = 0;
      comp.complemento.forEach( function ( result ) {
        nuevoPanel += "<li><label style='font-weight:normal;margin-top:5px;'><input type='checkbox' name='" + comp.pregunta_id + "' id='" + result.comp + "_" + 1 + "' class='" + comp.pregunta_id + "_comp_" + comp.opcion + "' value='" + result.comp + "' onchange='modificarConsulta()' label= '" + comp.respuesta + "'> " + result.comp + "</label></li>";
      } );
      nuevoPanel += '</ul></div></div>';
      $( '#' + comp.pregunta_id + '_div' ).after( nuevoPanel );
    }
    else {
      if ( $( '#' + comp.id + '_comp' ) ) {
        $( '#' + comp.id + '_comp' ).remove();
      }
    }
  }

  var clase = '';
  var label = '';
  var query = '';
  var temp = '';
  var finalQuery = [];
  var lastlabel = '';
  $( "#columna_preguntas_filtradas input[type=checkbox]" ).each( function ( index, element ) {
    var continuar = false;
    if ( clase === '' ) {
      clase = $( element ).attr( 'class' );
      label = $( element ).attr( 'name' );
      lastlabel = $( element ).attr( 'label' );
      //console.log('CLASE: ' + clase);
    }
    var cambiar = false;
    if ( !$( element ).attr( 'id' ).substring( 0, clase.length ) == clase ) {
      cambiar = true;
    }
    if ( !( clase === $( element ).attr( 'class' ) ) || cambiar ) {
      if ( temp != '' ) {
        if ( query != '' ) {
          query += ' AND ';
        }
        query += '( ' + temp + ')';
        finalQuery.push( {
          'query': query,
          'pregunta': clase,
          'label': lastlabel
        } );
        temp = '';
      }
      clase = $( element ).attr( 'class' );
      label = $( element ).attr( 'name' );
      lastlabel = $( element ).attr( 'label' );
      //console.log('CLASE: ' + clase);
    }
    if ( $( "input:checked." + clase ).length > 0 ) {
      if ( $( element ).prop( 'checked' ) ) {
        if ( temp != '' ) {
          temp += ' OR ';
        }
        temp += label + ' LIKE "%' + $( element ).val() + '%"';
      }
    }
  } );
  if ( temp != '' ) {
    if ( query != '' ) {
      query += ' AND ';
    }
    query += '( ' + temp + ')';
    finalQuery.push( {
      'query': query,
      'pregunta': clase,
      'label': lastlabel
    } );
    temp = '';
  }
  ejecutarConsulta( finalQuery, tipo );
}

function ejecutarConsulta( finalQuery, tipo ) {
  if ( finalQuery.length > 0 ) {
    int = 0;
    finalQuery.forEach( function ( result ) {
      finalQuery[ int ].query = 'SELECT COUNT(*) AS \'total\' FROM  respuestasM, encuestasM where ' + result[ 'query' ] + ' AND respuestasM.encuestaM_id = encuestasM.id AND encuestasM.etapa_1 = 1 AND encuestasM.etapa_1 = 1 AND encuestasM.etapa_1 = 1 AND encuestasM.etapa_1 = 1;';
      finalQuery[ int ].pregunta = result[ 'pregunta' ];
      int++;
    } );
    $.ajax( {
      url: '/encuesta-intermed/admin/consultacrossreference',
      type: "POST",
      dataType: 'JSON',
      data: {
        'consultas': finalQuery
      },
      success: function ( data ) {
        var enviar = [];
        enviar[ 'element' ] = 'crossreference';
        enviar[ 'data' ] = [];
        var universo = data.universo;
        for ( var k in data.preguntas ) {
          enviar[ 'data' ].push( {
            'label': k,
            'value': data.preguntas[ k ]
          } )
        }
        switch ( tipo ) {
          case 'Bar':
            ChartBarCross( enviar, universo );
            break;
          case 'Radar':
            ChartRadarCross( enviar, universo );
            break;
          case 'Line':
            ChartLineCross( enviar, universo );
            break;
          case 'Polar':
            ChartPolarCross( enviar, universo );
            break;
        }
      },
      error: function ( e ) {
        console.log( "Error: " + JSON.stringify( e ) );
      }
    } );
  }
  else {
    $( '#crossreference' ).html( '' );
  }
}

function ChartBar( data ) {
  var element = data.element;
  var labels = [];
  var values = [];
  var height = 100;
  var largo = 0;
  var count = 0;
  var long = 0;
  data.data.forEach( function ( result ) {
    if ( result.label.length > 15 ) largo++;
    if ( result.value > 20 ) long = 100;
    labels.push( result.label );
    values.push( result.value );
    count++;
  } );

  height = ( 150 + ( 30 * largo ) + 50 + long );

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );

  var barChartData = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
        highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
        data: values
      }
    ]
  }

  $( '#' + element + '_tipo' ).val( 'Bar' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '" style="z-index:3000">' );
  $( '#' + element ).append( '</canvas>' );

  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Bar( barChartData, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getBarsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            console.log( 'COMPLEMENTO: ' + JSON.stringify( result.complemento ) );
            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
              labelscomp.push( complemento.comp );
              valuescomp.push( complemento.total );
            } );
            var r = ( Math.floor( Math.random() * 256 ) );
            var g = ( Math.floor( Math.random() * 256 ) );
            var b = ( Math.floor( Math.random() * 256 ) );
            var barChartData = {
              labels: labelscomp,
              datasets: [
                {
                  fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
                  strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
                  highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
                  highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
                  data: valuescomp
                  }
                ]
            }
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).Bar( barChartData, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

function ChartRadar( data ) {
  var element = data[ 'element' ];
  var labels = [];
  var values = [];
  data.data.forEach( function ( result ) {
    labels.push( result.label );
    values.push( result.value );
  } );

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );

  var barChartData = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
        highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
        data: values
      }
    ]
  }

  $( '#' + element + '_tipo' ).val( 'Radar' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Radar( barChartData, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getPointsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            console.log( 'COMPLEMENTO: ' + JSON.stringify( result.complemento ) );
            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
              labelscomp.push( complemento.comp );
              valuescomp.push( complemento.total );
            } );
            var r = ( Math.floor( Math.random() * 256 ) );
            var g = ( Math.floor( Math.random() * 256 ) );
            var b = ( Math.floor( Math.random() * 256 ) );
            var barChartData = {
              labels: labelscomp,
              datasets: [
                {
                  fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
                  strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
                  highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
                  highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
                  data: valuescomp
                  }
                ]
            }
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).Radar( barChartData, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

function ChartPie( data ) {
  var element = data[ 'element' ];
  var values = [];

  var b = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  data.data.forEach( function ( result ) {
    var r = ( Math.floor( Math.random() * 256 ) );
    values.push( {
      value: result.value,
      color: "rgba(" + r + "," + g + "," + b + ",0.7)",
      highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
      label: result.label
    } );
  } );

  $( '#' + element + '_tipo' ).val( 'Pie' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );

  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Pie( values, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getSegmentsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              var r = ( Math.floor( Math.random() * 256 ) );
              valuescomp.push( {
                value: complemento.total,
                color: "rgba(" + r + "," + g + "," + b + ",0.7)",
                highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
                label: complemento.comp
              } );
            } );
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).Pie( valuescomp, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

function ChartDoughnut( data ) {
  var element = data[ 'element' ];
  var values = [];

  var b = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  data.data.forEach( function ( result ) {
    var r = ( Math.floor( Math.random() * 256 ) );
    values.push( {
      value: result.value,
      color: "rgba(" + r + "," + g + "," + b + ",0.7)",
      highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
      label: result.label
    } );
  } );

  $( '#' + element + '_tipo' ).val( 'Doughnut' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Doughnut( values, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getSegmentsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              var r = ( Math.floor( Math.random() * 256 ) );
              valuescomp.push( {
                value: complemento.total,
                color: "rgba(" + r + "," + g + "," + b + ",0.7)",
                highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
                label: complemento.comp
              } );
            } );
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).Doughnut( valuescomp, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

function ChartPolar( data ) {
  var element = data[ 'element' ];
  var values = [];

  var b = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  data.data.forEach( function ( result ) {
    var r = ( Math.floor( Math.random() * 256 ) );
    values.push( {
      value: result.value,
      color: "rgba(" + r + "," + g + "," + b + ",0.7)",
      highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
      label: result.label
    } );
  } );

  $( '#' + element + '_tipo' ).val( 'Polar' );
  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).PolarArea( values, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getSegmentsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              var r = ( Math.floor( Math.random() * 256 ) );
              valuescomp.push( {
                value: complemento.total,
                color: "rgba(" + r + "," + g + "," + b + ",0.7)",
                highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
                label: complemento.comp
              } );
            } );
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).PolarArea( valuescomp, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

function ChartLine( data ) {
  var element = data[ 'element' ];
  var labels = [];
  var values = [];
  var height = 100;
  var largo = false;
  var count = 0;
  data.data.forEach( function ( result ) {
    if ( result.label.length > 10 ) largo = true;
    labels.push( result.label );
    values.push( result.value );
    count++;
  } );

  if ( count > 3 && largo ) {
    height = 50 * count;
  }

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );
  var data2 = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: values
        }
    ]
  };
  $( '#' + element + '_tipo' ).val( 'Line' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '" ></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Line( data2, {
    responsive: true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

  canvas.onclick = function ( evt ) {
    var activePoints = MyChart.getPointsAtEvent( evt );
    var closePopovers = true;
    data.data.forEach( function ( result ) {
      if ( activePoints[ 0 ] ) {
        if ( result.label == activePoints[ 0 ][ 'label' ] ) {
          if ( result.complemento ) {
            closePopovers = false;

            console.log( 'COMPLEMENTO: ' + JSON.stringify( result.complemento ) );
            var valuescomp = [];
            var labelscomp = [];
            result.complemento.forEach( function ( complemento ) {
              //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
              labelscomp.push( complemento.comp );
              valuescomp.push( complemento.total );
            } );
            var r = ( Math.floor( Math.random() * 256 ) );
            var g = ( Math.floor( Math.random() * 256 ) );
            var b = ( Math.floor( Math.random() * 256 ) );
            var barChartData = {
              labels: labelscomp,
              datasets: [
                {
                  fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
                  strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
                  pointColor: "rgba(151,187,205,1)",
                  pointStrokeColor: "#fff",
                  pointHighlightFill: "#fff",
                  pointHighlightStroke: "rgba(151,187,205,1)",
                  data: valuescomp
                  }
                ]
            }
            $( '#' + element + '_complemento' ).attr( 'data-original-title', result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>' );
            $( '#' + element + '_complemento' ).attr( 'data-content', '<canvas id="canvas_complemento_' + element + '" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>' );
            //var testPopover = $('#canvas_'+element).parent();

            $( '[data-toggle="popover"]' ).not( $( '#' + element + '_complemento' ) ).popover( 'hide' );
            $( '#' + element + '_complemento' ).popover( 'show' );

            var canvas2 = document.getElementById( 'canvas_complemento_' + element );
            var ctx2 = canvas2.getContext( "2d" );
            var MyChart = new Chart( ctx2 ).Line( barChartData, {
              responsive: true,
              tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
            } );
          }
        }
      }
    } );
    if ( closePopovers ) {
      $( '[data-toggle="popover"]' ).popover( 'hide' );
    }
  };
}

$( document ).ready( function () {
  $( '[data-toggle="popover"]' ).popover();
} );

$( '#resultTabs a' ).click( function ( e ) {
  e.preventDefault()
  $( this ).tab( 'show' )
} )

function cerrarPopovers() {
  $( '[data-toggle="popover"]' ).popover( 'hide' );
}

function ampliarGrafica( pregunta, enviar ) {
  var tipo = $( '#' + enviar.element + '_tipo' ).val();
  enviar.element = 'graficaAmpliadaBody';
  $( '#graficaAmpliadaLabel' ).html( pregunta );
  $( '#graficaAmpliada' ).modal( 'show' );
  switch ( tipo ) {
    case "Bar":
      ChartBar( enviar );
      break;
    case "Radar":
      ChartRadar( enviar );
      break;
    case "Pie":
      ChartPie( enviar );
      break;
    case "Polar":
      ChartPolar( enviar );
      break;
    case "Doughnut":
      ChartDoughnut( enviar );
      break;
    case "Line":
      ChartLine( enviar );
      break;
  }
}


$( function () {
  $( ".column" ).sortable( {
    connectWith: ".column",
    handle: ".portlet-header",
    cancel: ".portlet-toggle",
    placeholder: "portlet-placeholder ui-corner-all",
    stop: function ( event, ui ) {
      modificarConsulta();
    }
  } );

  $( ".portlet" )
    .addClass( "ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" )
    .find( ".portlet-header" )
    .addClass( "ui-widget-header ui-corner-all" )
    .prepend( "<span class='ui-icon ui-icon-minusthick portlet-toggle'></span>" );

  $( ".portlet-toggle" ).click( function () {
    var icon = $( this );
    icon.toggleClass( "ui-icon-minusthick ui-icon-plusthick" );
    icon.closest( ".portlet" ).find( ".portlet-content" ).toggle();
  } );
} );


function ChartBarCross( data, universo ) {
  var element = data.element;
  var labels = [];
  var values = [];
  var height = 100;
  var largo = 0;
  var count = 0;
  var long = 0;
  data.data.forEach( function ( result ) {
    if ( result.label.length > 15 ) largo++;
    if ( result.value > 20 ) long = 100;
    labels.push( result.label );
    values.push( result.value );
    count++;
  } );

  height = ( 150 + ( 30 * largo ) + 50 + long );

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );

  var barChartData = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
        highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
        data: values
      }
    ]
  }

  $( '#' + element + '_tipo' ).val( 'Bar' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '" style="z-index:3000">' );
  $( '#' + element ).append( '</canvas>' );
  var num = 1;
  if ( universo > 20 ) {
    num = ( universo / 20 ) >> 0;
  }
  universo = universo / num;

  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Bar( barChartData, {
    responsive: true,
    scaleStartValue: 0,
    scaleOverride: true,
    scaleSteps: universo,
    scaleStepWidth: num,
    overridelabel: false,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );
}

function ChartRadarCross( data, universo ) {
  var element = data[ 'element' ];
  var labels = [];
  var values = [];
  data.data.forEach( function ( result ) {
    labels.push( result.label );
    values.push( result.value );
  } );

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );

  var barChartData = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        highlightFill: "rgba(" + r + "," + g + "," + b + ",0.75)",
        highlightStroke: "rgba(" + r + "," + g + "," + b + ",1)",
        data: values
      }
    ]
  }

  $( '#' + element + '_tipo' ).val( 'Radar' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );

  var num = 1;
  if ( universo > 20 ) {
    num = ( universo / 20 ) >> 0;
  }
  universo = universo / num;
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Radar( barChartData, {
    responsive: true,
    scaleStartValue: 0,
    scaleOverride: true,
    scaleSteps: universo,
    scaleStepWidth: num,
    overridelabel: false,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );

}


function ChartLineCross( data, universo ) {
  var element = data[ 'element' ];
  var labels = [];
  var values = [];
  var height = 100;
  var largo = false;
  var count = 0;
  data.data.forEach( function ( result ) {
    if ( result.label.length > 10 ) largo = true;
    labels.push( result.label );
    values.push( result.value );
    count++;
  } );

  if ( count > 3 && largo ) {
    height = 50 * count;
  }

  var r = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  var b = ( Math.floor( Math.random() * 256 ) );
  var data2 = {
    labels: labels,
    datasets: [
      {
        fillColor: "rgba(" + r + "," + g + "," + b + ",0.5)",
        strokeColor: "rgba(" + r + "," + g + "," + b + ",0.8)",
        pointColor: "rgba(151,187,205,1)",
        pointStrokeColor: "#fff",
        pointHighlightFill: "#fff",
        pointHighlightStroke: "rgba(151,187,205,1)",
        data: values
        }
    ]
  };
  $( '#' + element + '_tipo' ).val( 'Line' );

  $( '#' + element ).html( '<canvas id="canvas_' + element + '" ></canvas>' );

  var num = 1;
  if ( universo > 20 ) {
    num = ( universo / 20 ) >> 0;
  }
  universo = universo / num;
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).Line( data2, {
    responsive: true,
    scaleStartValue: 0,
    scaleOverride: true,
    scaleSteps: universo,
    scaleStepWidth: num,
    overridelabel: false,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );
}


function ChartPolarCross( data, universo ) {
  var element = data[ 'element' ];
  var values = [];

  var b = ( Math.floor( Math.random() * 256 ) );
  var g = ( Math.floor( Math.random() * 256 ) );
  data.data.forEach( function ( result ) {
    var r = ( Math.floor( Math.random() * 256 ) );
    values.push( {
      value: result.value,
      color: "rgba(" + r + "," + g + "," + b + ",0.7)",
      highlight: "rgba(" + r + "," + g + "," + b + ",0.5)",
      label: result.label
    } );
  } );

  var num = 1;
  if ( universo > 10 ) {
    num = ( universo / 10 ) >> 0;
  }
  universo = universo / num;
  $( '#' + element + '_tipo' ).val( 'Polar' );
  $( '#' + element ).html( '<canvas id="canvas_' + element + '"></canvas>' );
  var canvas = document.getElementById( 'canvas_' + element );
  var ctx = canvas.getContext( "2d" );
  var MyChart = new Chart( ctx ).PolarArea( values, {
    responsive: true,
    scaleStartValue: 0,
    scaleOverride: true,
    scaleSteps: universo,
    scaleStepWidth: num,
    overridelabel: false,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  } );
}

//validacion de los formularios
$( function () {
  $( 'input.validada' ).focusout( function () {
    if ( $( this ).val() == "" ) {
      $( this ).parent().addClass( 'has-error' );
      $( this ).after( '<span>Recuerda que debe de estar lleno este campo</span>' );
    }
    else {
      $( this ).next( 'span' ).remove();
      $( this ).parent().removeClass( 'has-error' );
    }
  } );
  $( 'textarea.validada' ).focusout( function () {
    if ( $( "textarea" ).val() == "" ) {
      $( this ).parent().addClass( 'has-error' );
      $( this ).after( '<span>Danos tu justificación por favor</span>' );
    }
    else {
      $( this ).next( 'span' ).remove();
      $( this ).parent().removeClass( 'has-error' );
    }
  } );
} );
/*Fin funciones resultados*/
