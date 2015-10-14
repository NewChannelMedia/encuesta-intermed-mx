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
  if (!($( '#btnguardarysalir' ).hasClass( 'notEnabled' ))){
    $( '#continuar' ).val( '0' );
    $( "#formEnc" ).submit();
  } else {
    $('#encError').html('<div class="alert alert-danger" role="alert" id="danger-alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Por favor contesta las preguntas faltantes.</div>');
    marcarFaltantes();
    $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#danger-alert").alert('close');
        $('#encError').html('');
    });
  }
}

function guardarycont() {
  if (!($( '#btnguardarycontinuar' ).hasClass( 'notEnabled' ))){
    $( '#continuar' ).val( '1' );
    $( "#formEnc" ).submit();
  } else {
    $('#encError').html('<div class="alert alert-danger" role="alert" id="danger-alert"><span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span><span class="sr-only">Error:</span> Por favor contesta las preguntas faltantes.</div>');
    marcarFaltantes();
    $("#danger-alert").fadeTo(2000, 500).slideUp(500, function(){
        $("#danger-alert").alert('close');
        $('#encError').html('');
    });
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

function marcarFaltantes(){
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
          field.parent().parent().addClass("has-error");
          field.parent().parent().focusin(function(){
              $( this ).removeClass("has-error");
              $( this ).find('label').removeClass("has-error");
          });
        }
      }
      else {
        if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
          field.parent().parent().addClass("has-error");
          field.parent().parent().focusin(function(){
              $( this ).removeClass("has-error");
              $( this ).find('label').removeClass("has-error");
          });
        }
      }
    }
    else if ( field.prop( 'name' ).substring( 0, 11 ) == "complemento" ) {
      if ( field.prop( 'required' ) && field.prop( 'value' ) == "" ) {
        field.parent().addClass("has-error");
        field.parent().focusin(function(){
            $( this ).removeClass("has-error");
            $( this ).find('label').removeClass("has-error");
        });
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
  if($('#respuesta_' + id + '_' + comp).is(':checked')){
    $( '#complemento_' + id + '_' + comp ).prop( 'required', true );
    $( '#complemento_' + id + '_' + comp ).prop( 'disabled', false );
  } else {
    $( '#complemento_' + id + '_' + comp ).val('');
    $( '#complemento_' + id + '_' + comp ).prop( 'required', false );
    $( '#complemento_' + id + '_' + comp ).prop( 'disabled', true );
  }
}

function aceptarPromocion() {
  var value = $( '#promo' ).prop( 'checked' );
  if ( value == true ) {
    var contenido = '<form method="POST" action="newsletter">' +
      '<div class="form-group">' +
      '<label for="nombre">Nombre:</label>' +
      '<input type="text" class="form-control validada" id="nombre" name="nombre" required>' +
      '</div>' +
      '<div class="form-group">' +
      '<label for="email">Correo:</label>' +
      '<input type="email" name="email" class="form-control validada" id="email" required>' +
      '</div>' +
      '<input type="submit" value="Enviar" class="btn btn-success btn-lg btn-block"></form>';
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
function enviarSucces( mail, id ) {
  $( "#codigoCorreo" ).html( mail );
  $("#codigoUser").html( id );
}
function enviarNoSuccesL( mail, id ){
  $("#rechazos").html( mail );
  $("#rechazosID").html( id );
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
            $( '#datosPa #t' + i + '' ).append( '<td ><button noMalTo="' + item.correo + '" type="button" onclick="enviarNoSuccesL(\'' + item.correo + '\',\'' + item.id + '\')" id="enviarNoSucces" class="btn btn-danger btn-block" data-toggle="modal" data-target="#NoaceptarModal"><span class="glyphicon glyphicon-remove"></span></button></td>' );
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
          if( item.mensaje == null || item.mensaje == null){
            $( '#datosNa #pt' + i + '').append('<td >' + "Sin mensaje" + '</td>' );
          }else{
            $( '#datosNa #pt' + i + '').append('<td >' + item.mensaje + '</td>' );
          }
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
          if( item.mensaje == "" || item.mensaje == null ){
            $( '#datosSa #te' + i + '').append('<td >' + "Sin mensaje" + '</td>' );
          }else{
            $( '#datosSa #te' + i + '').append('<td >' + item.mensaje + '</td>' );
          }
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
  $("#enviarTodo").click(function(){
    var codigo = $( "#aleatorioDato" ).val();
    var correo = $( "#codigoCorreo" ).text();
    var titulo = 'Cedula valida';
    var idMensaje = $("#codigoUser").text();
    var valor = parseInt($("#codigoUser").text())-1;
    var mensaje = $("#mensajeAceptado").val();
    var ids = '#tr'+valor;
    var id = '#t'+valor;
    var estado = 1;
    var spanId = $("#codigoUser").text();
    if( $("#aleatorioDato").val() != "" ){
      $.post('/encuesta-intermed/admin/insertaCodigo/'+ $( "#aleatorioDato" ).val(),function(data){
        $.post('/encuesta-intermed/codigo/sendMail/',{
          codigo:codigo,
          correo:correo,
          titulo:titulo,
          mensaje:mensaje,
          estado:estado
        },function(datas){
          $.post('/encuesta-intermed/codigo/insertMensaje',{mensaje:mensaje, id:idMensaje},function(dataM){
            $.post('/encuesta-intermed/codigo/actualizaStatus/',{correo:correo, ids:spanId},function(datasA){
            }).done(function(){
              alert("Campo actualizado y se envio el correo");
              $(ids).hide('slow');
              $(id).hide('slow');
              $('.modal').modal('hide');
              $("#aleatorioDato").attr('value','');
              $("#mensajeAceptado").val('');
            });
          });
        });
      });
    }else{
      alert("Se debe de generar un código primero");
    }
  });
  // envia el correo de rechazo y actualiza el status a 2 para que aparesca en no aceptados
  // envia el correo de rechazo y actualiza el status a 2 para que aparesca en no aceptados
  $("#envioRechazado").click(function(){
    var mail = $("#rechazos").text();
    var titulo = 'Por el momento no joven';
    var mensaje = $("#areaRechazado").val();
    var valor = parseInt($("#rechazosID").text())-1;
    var idMensaje = $("#rechazosID").text();
    var ids = '#tr'+valor;
    var id = '#t'+valor;
    var spanId = $("#rechazosID").text();
    $.post('/encuesta-intermed/codigo/sendMail/',{correo:mail,titulo:titulo,mensaje:mensaje},function(data){
      $.post('/encuesta-intermed/codigo/negado',{correo:mail, ids:spanId},function(negado){
        $.post('/encuesta-intermed/codigo/insertMensaje',{mensaje:mensaje, id:idMensaje},function(dataM){});
      }).done(function(){
        alert("Usuario rechazado, correo enviado....");
        $("#areaRechazado").val('') ;
        $('.modal').modal('hide');
        $(ids).hide('slow');
        $(id).hide('slow');
      });
    });
  });
  //cerrar session
  $("#salir").click(function(){
    $.post('/encuesta-intermed/admin/cerrar/',function(data){
    }).done(function(){
      window.location = '/encuesta-intermed/admin/index';
    }).fail(function(){console.log("ERROR AL CERRAR SESSION");});
  });
  $( "#enviarNoSucces" ).click( function () {
    $( "#NoaceptarModal" ).modal( 'show' );
  } );
});

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

/*Resultados*/

function MorrisDonut(element, data){
  if(document.getElementById(element) !== null){
    new Morris.Donut({
      // ID of the element in which to draw the chart.
      element: element,
      // Chart data records -- each entry in this array corresponds to a point on
      // the chart.
      data: data,
      // The name of the data record attribute that contains x-values.
      hideHover: 'auto',
      resize: true
    });
  }
}

function MorrisBar(element, data, ykeys){
  if(document.getElementById(element) !== null){
    new Morris.Bar({
    // ID of the element in which to draw the chart.
    element: element,
      data: [{
          label: '2006',
          value: 100
      }, {
          label: '2007',
          value: 75
      }, {
          label: '2008',
          value: 50
      }, {
          label: '2009',
          value: 75
      }, {
          label: '2010',
          value: 50
      }, {
          label: '2011',
          value: 75
      }, {
          label: '2012',
          value: 100
      }],
      xkey: 'label',
      ykeys: ['value'],
      hideHover: 'auto',
      resize: true
  });
  }
}


function ChartBar(data){
  var element = data.element;
  var labels = [];
  var values = [];
  var height = 100;
  var largo = 0;
  var count = 0;
  var long = 0;
  data.data.forEach(function (result){
    if (result.label.length > 15) largo++;
    if (result.value > 20) long = 100;
    labels.push(result.label);
    values.push(result.value);
    count++;
  });

  height = (150+(30*largo) +50 + long);

  var r = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  var b = (Math.floor(Math.random() * 256));

  var barChartData = {
    labels : labels,
    datasets : [
      {
        fillColor : "rgba("+r+","+g+","+b+",0.5)",
        strokeColor : "rgba("+r+","+g+","+b+",0.8)",
        highlightFill : "rgba("+r+","+g+","+b+",0.75)",
        highlightStroke : "rgba("+r+","+g+","+b+",1)",
        data : values
      }
    ]
  }
  $('#'+element).html('<canvas id="canvas_'+element+'"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart = new Chart(ctx).Bar(barChartData, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getBarsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              console.log('COMPLEMENTO: ' + JSON.stringify(result.complemento));
              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
                labelscomp.push(complemento.comp);
                valuescomp.push(complemento.total);
              });
              var r = (Math.floor(Math.random() * 256));
              var g = (Math.floor(Math.random() * 256));
              var b = (Math.floor(Math.random() * 256));
              var barChartData = {
                labels : labelscomp,
                datasets : [
                  {
                    fillColor : "rgba("+r+","+g+","+b+",0.5)",
                    strokeColor : "rgba("+r+","+g+","+b+",0.8)",
                    highlightFill : "rgba("+r+","+g+","+b+",0.75)",
                    highlightStroke : "rgba("+r+","+g+","+b+",1)",
                    data : valuescomp
                  }
                ]
              }
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).Bar(barChartData, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

function ChartRadar(data){
  var element = data['element'];
  var labels = [];
  var values = [];
  data.data.forEach(function (result){
    labels.push(result.label);
    values.push(result.value);
  });

  var r = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  var b = (Math.floor(Math.random() * 256));

  var barChartData = {
    labels : labels,
    datasets : [
      {
        fillColor : "rgba("+r+","+g+","+b+",0.5)",
        strokeColor : "rgba("+r+","+g+","+b+",0.8)",
        highlightFill : "rgba("+r+","+g+","+b+",0.75)",
        highlightStroke : "rgba("+r+","+g+","+b+",1)",
        data : values
      }
    ]
  }

  $('#'+element).html('<canvas id="canvas_'+element+'"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart = new Chart(ctx).Radar(barChartData, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getPointsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              console.log('COMPLEMENTO: ' + JSON.stringify(result.complemento));
              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
                labelscomp.push(complemento.comp);
                valuescomp.push(complemento.total);
              });
              var r = (Math.floor(Math.random() * 256));
              var g = (Math.floor(Math.random() * 256));
              var b = (Math.floor(Math.random() * 256));
              var barChartData = {
                labels : labelscomp,
                datasets : [
                  {
                    fillColor : "rgba("+r+","+g+","+b+",0.5)",
                    strokeColor : "rgba("+r+","+g+","+b+",0.8)",
                    highlightFill : "rgba("+r+","+g+","+b+",0.75)",
                    highlightStroke : "rgba("+r+","+g+","+b+",1)",
                    data : valuescomp
                  }
                ]
              }
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).Radar(barChartData, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

function ChartPie(data){
  var element = data['element'];
  var values = [];

  var b = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  data.data.forEach(function (result){
    var r = (Math.floor(Math.random() * 256));
    values.push({
      value: result.value,
      color: "rgba("+r+","+g+","+b+",0.7)",
      highlight: "rgba("+r+","+g+","+b+",0.5)",
      label: result.label
    });
  });

  $('#'+element).html('<canvas id="canvas_'+element+'"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart =  new Chart(ctx).Pie(values, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getSegmentsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                var r = (Math.floor(Math.random() * 256));
                valuescomp.push({
                  value: complemento.total,
                  color: "rgba("+r+","+g+","+b+",0.7)",
                  highlight: "rgba("+r+","+g+","+b+",0.5)",
                  label: complemento.comp
                });
              });
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).Pie(valuescomp, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

function ChartDoughnut(data){
  var element = data['element'];
  var values = [];

  var b = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  data.data.forEach(function (result){
    var r = (Math.floor(Math.random() * 256));
    values.push({
      value: result.value,
      color: "rgba("+r+","+g+","+b+",0.7)",
      highlight: "rgba("+r+","+g+","+b+",0.5)",
      label: result.label
    });
  });

  $('#'+element).html('<canvas id="canvas_'+element+'"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart = new Chart(ctx).Doughnut(values, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getSegmentsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                var r = (Math.floor(Math.random() * 256));
                valuescomp.push({
                  value: complemento.total,
                  color: "rgba("+r+","+g+","+b+",0.7)",
                  highlight: "rgba("+r+","+g+","+b+",0.5)",
                  label: complemento.comp
                });
              });
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).Doughnut(valuescomp, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

function ChartPolar(data){
  var element = data['element'];
  var values = [];

  var b = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  data.data.forEach(function (result){
    var r = (Math.floor(Math.random() * 256));
    values.push({
      value: result.value,
      color: "rgba("+r+","+g+","+b+",0.7)",
      highlight: "rgba("+r+","+g+","+b+",0.5)",
      label: result.label
    });
  });
  $('#'+element).html('<canvas id="canvas_'+element+'"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart = new Chart(ctx).PolarArea(values, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getSegmentsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                var r = (Math.floor(Math.random() * 256));
                valuescomp.push({
                  value: complemento.total,
                  color: "rgba("+r+","+g+","+b+",0.7)",
                  highlight: "rgba("+r+","+g+","+b+",0.5)",
                  label: complemento.comp
                });
              });
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).PolarArea(valuescomp, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

function ChartLine(data){
  var element = data['element'];
  var labels = [];
  var values = [];
  var height = 100;
  var largo = false;
  var count = 0;
  data.data.forEach(function (result){
    if (result.label.length > 10) largo = true;
    labels.push(result.label);
    values.push(result.value);
    count++;
  });

  if (count>3 && largo){
    height = 50*count;
  }

  var r = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  var b = (Math.floor(Math.random() * 256));
  var data2 = {
    labels: labels,
    datasets: [
        {
            fillColor : "rgba("+r+","+g+","+b+",0.5)",
            strokeColor : "rgba("+r+","+g+","+b+",0.8)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: values
        }
    ]
  };

  $('#'+element).html('<canvas id="canvas_'+element+'" ></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart =  new Chart(ctx).Line(data2, {
    responsive : true,
    tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getPointsAtEvent(evt);
      var closePopovers = true;
      data.data.forEach(function (result){
        if (activePoints[0]){
          if (result.label == activePoints[0]['label']){
            if (result.complemento){
              closePopovers = false;

              console.log('COMPLEMENTO: ' + JSON.stringify(result.complemento));
              var valuescomp = [];
              var labelscomp = [];
              result.complemento.forEach(function (complemento){
                //$('#'+element+'_complemento').attr('data-content',$('#'+element+'_complemento').attr('data-content')+'<li> [' + complemento.total + '] '+complemento.comp + '</li>');
                labelscomp.push(complemento.comp);
                valuescomp.push(complemento.total);
              });
              var r = (Math.floor(Math.random() * 256));
              var g = (Math.floor(Math.random() * 256));
              var b = (Math.floor(Math.random() * 256));
              var barChartData = {
                labels : labelscomp,
                datasets : [
                  {
                    fillColor : "rgba("+r+","+g+","+b+",0.5)",
                    strokeColor : "rgba("+r+","+g+","+b+",0.8)",
                    pointColor: "rgba(151,187,205,1)",
                    pointStrokeColor: "#fff",
                    pointHighlightFill: "#fff",
                    pointHighlightStroke: "rgba(151,187,205,1)",
                    data : valuescomp
                  }
                ]
              }
              $('#'+element+'_complemento').attr('data-original-title',result.label + '<button type="button" class="close" aria-label="Close" onclick="cerrarPopovers()"><span aria-hidden="true">&times;</span></button>');
              $('#'+element+'_complemento').attr('data-content','<canvas id="canvas_complemento_'+element+'" class="col-lg-12 col-md-12" style="width:380px;margin-bottom:30px;"></canvas>');
              //var testPopover = $('#canvas_'+element).parent();

              $('[data-toggle="popover"]').not($('#'+element+'_complemento')).popover('hide');
              $('#'+element+'_complemento').popover('show');

              var canvas2 = document.getElementById('canvas_complemento_'+element);
              var ctx2 = canvas2.getContext("2d");
              var MyChart = new Chart(ctx2).Line(barChartData, {
                responsive : true,
                tooltipTemplate: "<%if (label){%><%=label%> [ <%}%><%= value %> ]"
              });
            }
          }
        }
      });
      if (closePopovers){
        $('[data-toggle="popover"]').popover('hide');
      }
  };
}

$(document).ready(function(){
    $('[data-toggle="popover"]').popover();
});

$('#resultTabs a').click(function (e) {
  e.preventDefault()
  $(this).tab('show')
})

function cerrarPopovers(){
  $('[data-toggle="popover"]').popover('hide');
}
//validacion de los formularios
$(function(){
    $('input.validada').focusout(function(){
      if( $(this).val() == "" ){
        $(".error-message").html('');
        $("input:submit").attr('disabled','disabled');
        $( this ).parent().addClass('has-error');
        $( this ).after('<span class="error-message">Recuerda que debe de estar lleno este campo el boton se deshabilito</span>');
      }else{
        $("input:submit").removeAttr('disabled');
        $( this ).next('span').remove();
        $( this ).parent().removeClass('has-error');
        $( 'form input.validada' ).each(function(index, data){
          if( $( this ).val() == "" ){
            $("input:submit").attr('disabled','disabled');
          }else{
            $("input:submit").removeAttr('disabled');
          }
        });
      }
    });//fin input
    $('textarea.validada').focusout(function(){
      if( $( "textarea" ).val() == "" ){
        $(".error-justificacion").html('');
        $("input:submit").attr('disabled','disabled');
        $( this ).parent().addClass('has-error');
        $( this ).after('<span class = "error-justificacion">Danos tu justificación por favor el boton se deshabilito</span>');
      }else{
        $("input:submit").removeAttr('disabled');
        $( this ).next('span').remove();
        $( this ).parent().removeClass('has-error');
        $( 'form textarea.validada' ).each(function(index, data){
          if( $( this ).val() == "" ){
            $("input:submit").attr('disabled','disabled');
          }else{
            $("input:submit").removeAttr('disabled');
          }
        });
      }
    });
    //checa que los inputs text no esten vacios
});
/*Fin funciones resultados*/
