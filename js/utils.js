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
    $( '#btnguardarycontinuar' ).attr( "disabled", true );
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
  var height = 20;
  data.data.forEach(function (result){
    labels.push(result.label);
    values.push(result.value);
    height = height +20;
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
  $('#'+element).html('<canvas id="canvas_'+element+'" height="' + height +'" width="500"></canvas>');
  var canvas = document.getElementById('canvas_'+element);
  var ctx = canvas.getContext("2d");
  var MyChart = new Chart(ctx).Bar(barChartData, {
    responsive : true
  });

  canvas.onclick = function(evt){
      var activePoints = MyChart.getBarsAtEvent(evt);
      data.data.forEach(function (result){
        if (result.label == activePoints[0]['label']){
          if (result.complemento){
            $('#'+element+'_complemento').html('Tiene complemento');
          } else {
            $('#'+element+'_complemento').html('');
          }
        }
      });
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

  $('#'+element).html('<canvas id="canvas_'+element+'" height="100" width="500"></canvas>');

  var ctx = document.getElementById('canvas_'+element).getContext("2d");
  window.myBar = new Chart(ctx).Radar(barChartData, {
    responsive : true
  });
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

  $('#'+element).html('<canvas id="canvas_'+element+'" height="100" width="500"></canvas>');

  var ctx = document.getElementById('canvas_'+element).getContext("2d");
  window.myBar = new Chart(ctx).Pie(values, {
    responsive : true
  });
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

  $('#'+element).html('<canvas id="canvas_'+element+'" height="100" width="500"></canvas>');

  var ctx = document.getElementById('canvas_'+element).getContext("2d");
  window.myBar = new Chart(ctx).Doughnut(values, {
    responsive : true
  });
}

function ChartLine(data){
  var element = data['element'];
  var labels = [];
  var values = [];
  var height = 20;
  data.data.forEach(function (result){
    labels.push(result.label);
    values.push(result.value);
    height = height + 20;
  });

  var r = (Math.floor(Math.random() * 256));
  var g = (Math.floor(Math.random() * 256));
  var b = (Math.floor(Math.random() * 256));
  var data = {
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

  $('#'+element).html('<canvas id="canvas_'+element+'" height="' + height +'" width="500"></canvas>');

  var ctx = document.getElementById('canvas_'+element).getContext("2d");
  window.myBar = new Chart(ctx).Line(data, {
    responsive : true
  });
}
/*Fin funciones resultados*/
