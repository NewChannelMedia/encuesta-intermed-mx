( function ( $ ) {
  $.fn.fontface = function ( options ) {
    var stacks = {
        serif: ", Times New Roman , serif",
        sansserif: ", Helvetica, Arial, sans-serif"
      },
      defaults = {
        filePath: "/fonts/All/", //change this to your font directory location
        fontFamily: "sans-serif",
        fontStack: false,
        fontStretch: "normal",
        fontStyle: "normal",
        fontVariant: "normal",
        fontWeight: "normal"
      },
      options = $.extend( defaults, options );

    options.fontFile = options.filePath + options.fileName;

    if ( options.fontStack || options.fontFamily === "sans-serif" ) {
      if ( options.fontStack && options.fontStack.indexOf( ", " ) === -1 ) {
        options.fontFamily = options.fontName + stacks[ options.fontStack ];
      }
      else if ( options.fontStack && options.fontStack.indexOf( ", " ) !== -1 ) {
        var concat = ( options.fontStack.substring( 0, 2 ) !== ", " ) ? "" : ", ";
        options.fontFamily = options.fontName + concat + options.fontStack;
      }
      else {
        options.fontFamily = options.fontName + stacks.sansserif
      }
    }

    if ( typeof options.fontFamily === "object" ) {
      options.fontFamily = options.fontFamily.join( ", " );
    }

    if ( $( "#jQueryFontFace" ).length === 0 ) { //haven't already made one
      $( "head" ).prepend( $( "<style type=\"text/css\" id=\"jQueryFontFace\"/>" ) );
    }

    var FF = {
      selector: function ( obj ) {
        var tag = obj.tagName,
          className = ( obj.className ) ? "." + obj.className.split( " " ).join( "." ) : "",
          id = ( $( obj ).attr( "id" ) ) ? "#" + $( obj ).attr( "id" ) : "";

        return tag + id + className;
      },
      create: function ( obj ) {
        var fontFace = "",
          rule = "",
          fontfamily = options.fontFamily.replace( /\s/g, "" ).replace( /,/g, "" ),
          fontfamilyStyleWeight = fontfamily + options.fontStyle + options.fontWeight,
          selector = FF.selector( obj );

        if ( !$( "#jQueryFontFace" ).data( fontfamilyStyleWeight ) ) {
          fontFace = [
						"@font-face {",
							"\tfont-family: \"" + options.fontName + "\";",
							"\tsrc: url('" + options.fontFile + ".eot');",
							"\tsrc: local('â˜º'), url('" + options.fontFile + ".woff') format('woff'), url('" + options.fontFile + ".ttf') format('truetype'), url('" + options.fontFile + ".svg#" + fontfamily + "') format('svg');",
							"\tfont-stretch: " + options.fontStretch + ";",
							"\tfont-style: " + options.fontStyle + ";",
							"\tfont-variant: " + options.fontVariant + ";",
							"\tfont-weight: " + options.fontWeight + ";",
						"}"
					].join( "\n" );
          $( "#jQueryFontFace" ).data( fontfamilyStyleWeight, true );
        }

        if ( !$( "#jQueryFontFace" ).data( selector ) ) {
          rule = [
						selector + " {",
							"\tfont-family: " + FF.quote( options.fontFamily ) + " !important;",
						"}"
					].join( "\n" );
          $( "#jQueryFontFace" ).data( selector, selector );
        }

        return ( fontFace.length || rule.length ) ? fontFace + "\n" + rule + "\n" : "";
      },
      quote: function ( string ) {
        var split = string.split( ", " ),
          length = split.length;
        for ( var i = 0; i < length; i += 1 ) {
          if ( split[ i ].indexOf( " " ) !== -1 ) {
            split[ i ] = '"' + split[ i ] + '"';
          }
        }
        return split.join( ", " );
      }
    };

    return this.each( function () {
      $( "#jQueryFontFace" ).text( $( "#jQueryFontFace" ).text() + FF.create( this ) );
    } );
  };
} )( jQuery );


/* ----------------------- */
/* ----------------------- */

/* Flama */

$( document ).ready( function () {
  $( ".flama-bold-italic" ).fontface( {
    fontName: "Flama-BoldItalic",
    fileName: "hinted-Flama-BoldItalic",
    fontWeight: "bold",
    fontStyle: "normal"
  } );

  $( ".flama" ).fontface( {
    fontName: "Flama",
    fileName: "hinted-Flama",
    fontWeight: "bold",
    fontStyle: "normal"
  } );

  $( ".flama-book-italic" ).fontface( {
    fontName: "FlamaBook",
    fileName: "hinted-Flama-Book-Italic",
    fontWeight: "normal",
    fontStyle: "italic"
  } );

  $( ".flama-medium" ).fontface( {
    fontName: "FlamaMedium",
    fileName: "hinted-Flama-Medium",
    fontWeight: "500",
    fontStyle: "normal"
  } );

  $( ".flama-medium-italic" ).fontface( {
    fontName: "FlamaMedium",
    fileName: "hinted-Flama-Medium-Italic",
    fontWeight: "500",
    fontStyle: "italic"
  } );

  $( ".flama-light" ).fontface( {
    fontName: "FlamaLight",
    fileName: "hinted-Flama-Light",
    fontWeight: "300",
    fontStyle: "normal"
  } );

  $( ".flama-black-italic" ).fontface( {
    fontName: "FlamaBlack",
    fileName: "hinted-Flama-Black",
    fontWeight: "900",
    fontStyle: "italic"
  } );

  $( ".flama-black" ).fontface( {
    fontName: "FlamaBlack",
    fileName: "hinted-Flama-Black",
    fontWeight: "900",
    fontStyle: "normal"
  } );

  $( ".flama-book" ).fontface( {
    fontName: "FlamaBook",
    fileName: "hinted-Flama-Book",
    fontWeight: "normal",
    fontStyle: "normal"
  } );

  $( ".flama-italic" ).fontface( {
    fontName: "Flama",
    fileName: "hinted-Flama-Italic",
    fontWeight: "normal",
    fontStyle: "italic"
  } );

  $( ".flama-bold" ).fontface( {
    fontName: "Flama",
    fileName: "hinted-Flama-Bold",
    fontWeight: "bold",
    fontStyle: "normal"
  } );

  $( ".flama-light-italic" ).fontface( {
    fontName: "FlamaLight",
    fileName: "hinted-Flama-Light-Italic",
    fontWeight: "300",
    fontStyle: "italic"
  } );


  /* Akzidenz */

  $( ".ag-extra-bold-cond-it" ).fontface( {
    fontName: "Akzidenz Grotesk BE XBdCn",
    fileName: "hinted-AkzidenzGroteskBE-XBdCnIT",
    fontWeight: "900",
    font - style: "italic"
  } );

  $( ".ag-bold" ).fontface( {
    fontName: "Akzidenz Grotesk BE",
    fileName: "hinted-AkzidenzGroteskBE-Bold",
    fontWeight: "bold",
    font - style: "normal"
  } );

  $( ".ag-extra-bold-cond" ).fontface( {
    fontName: "Akzidenz Grotesk BE XBdCn",
    fileName: "hinted-AkzidenzGroteskBE-XBdCn",
    fontWeight: "900",
    font - style: "normal"
  } );

  $( ".ag-italic" ).fontface( {
    fontName: "Akzidenz Grotesk BE",
    fileName: "hinted-AkzidenzGroteskBE-It",
    fontWeight: "normal",
    font - style: "italic"
  } );

  $( ".ag-bold-ext-it" ).fontface( {
    fontName: "Akzidenz Grotesk BE BoldEx",
    fileName: "hinted-AkzidenzGroteskBE-BoldExIt",
    fontWeight: "900",
    font - style: "normal"
  } );




  $( ".ag-medium" ).fontface( {
    fontName: "Akzidenz Grotesk BE",
    fileName: "hinted-AkzidenzGroteskBE-Md",
    fontWeight: "500"
  } );
  $( ".ag-regular" ).fontface( {
    fontName: "Akzidenz Grotesk BE",
    fileName: "hinted-AkzidenzGroteskBE-Regular",
    fontWeight: "normal"
  } );
} );
