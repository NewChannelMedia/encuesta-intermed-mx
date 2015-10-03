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
$(function(){
  $('#medicoRadio').click(function() {
    if ($(this).prop("checked", true)){
      $("#medicoSolicitud").removeClass("hidden");
      $("#usuarioSolicitud").addClass("hidden");
    }
  });
  $('#usuarioRadio').click(function() {
    if ($(this).prop("checked", true)){
      $("#medicoSolicitud").addClass("hidden");
      $("#usuarioSolicitud").removeClass("hidden");
    }
  });
});
