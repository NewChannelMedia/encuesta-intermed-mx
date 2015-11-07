function guardarMedico(){
  var nombre = $('#nombre').val();
  var apellidoP = $('#apellidoP').val();
  var apellidoM = $('#apellidoM').val();
  var especialidad = $('#especialidad').val();
  var email = $('#email').prop('value');
  var data = {
              'nombre': nombre,
              'apellidoP': apellidoP,
              'apellidoM': apellidoM,
              'email': email,
              'especialidad': especialidad
            };

  if (nombre != '' && apellidoP != ''){
    $.ajax( {
      url: '/encuesta-intermed/Capturista/guardarMedico',
      type: "POST",
      data: data,
      dataType: 'JSON',
      async: true,
      success: function (result) {
        if (result.success){
          $('#medico_id').val(result.medico_id);
          $('#registroMedico').find('input,select,button').attr("disabled","disabled");
          $('#registroMedico').addClass('panel-success guardado');
          $('#nombreDireccion').focus();
        }
      },
      error: function (err) {
        console.log( "Error: AJax dead :" + JSON.stringify(err) );
      }
    } );
  } else {
    bootbox.alert({
        message: "El nombre y apellido paterno del médico son obligatorios.",
        title: "No se puede guardar el médico"
    });
  }
}

function guardarTelefono(){
  var id = $('#medico_id').val();
  var clave = $('#ladaTelefono').val();
  var numero = $('#numTelefono').val();
  var tipo = $('#tipoTelefono').val();
  var data = {
              'medico_id': id,
              'claveRegion': clave,
              'numero': numero,
              'tipo': tipo
            };

  if (id != '' && numero != '' && clave != '' && tipo != ''){
    $.ajax( {
      url: '/encuesta-intermed/Capturista/guardarTelefono',
      type: "POST",
      data: data,
      dataType: 'JSON',
      async: true,
      success: function (result) {
        if (result.success){
          $('#registroTelefonos').find('input').prop('value','');
          document.getElementById("tipoTelefono").selectedIndex = "0";
          $('#ladaTelefono').focus();
        }
      },
      error: function (err) {
        console.log( "Error: AJax dead :" + JSON.stringify(err) );
      }
    } );
  } else {
    bootbox.alert({
        message: "Falta llenar algún campo para el registro.",
        title: "No se puede guardar el número de teléfono"
    });
  }
}

var accentMap = {
     "´": "",
     "á": "a",
     "é": "e",
     "í": "i",
     "ó": "o",
     "ú": "u",
     "ü": "u"
   };

var normalize = function( term ) {
 var ret = "";
 for ( var i = 0; i < term.length; i++ ) {
   ret += accentMap[ term.charAt(i) ] || term.charAt(i);
 }
 return ret;
};

$(function(){
 $( "#especialidad" ).autocomplete({
  minLength: 0,
   source: function( request, response ) {
      var matcher = new RegExp( $.ui.autocomplete.escapeRegex( request.term ), "i" );
      response( $.grep( autocompleteEspecialidades, function( value ) {
        value = value.label || value.value || value;
        return matcher.test( value ) || matcher.test( normalize( value ) );
      }) );
    }
});
});

$(document).ready(function (){
   $('.solo-numero').bind("paste", function(e){
    // access the clipboard using the api
    var pastedData = e.originalEvent.clipboardData.getData('text');
    if (!parseInt(pastedData)){
      if (e.preventDefault) {
          e.preventDefault();
      } else {
          e.returnValue = false;
      }
    }
  } );

   $('.solo-numero').keypress(function(evt) {
    var charCode = evt.keyCode || evt.which;
    if ((charCode < 45 || charCode > 57) &&  charCode != 13) {
        if (evt.preventDefault) {
            evt.preventDefault();
        } else {
            evt.returnValue = false;
        }
    }
  });
});

/**
* En la siguiente funcion cuando le den click al boton
* se enviaran los datos por post con ajax para que se inserten
*
*
**/
$(document).ready(function(){
  $("#agregarDireccion").click(function(){
    //variables
    var nombreConsultorio = $("#nombreDireccion").val();
    var calle = $("#direccion").val();
    var estado = $("#estado").val();
    var municipio = $("#municipio").val();
    var ciudad = $("#ciudad").val();
    var localidad = $("#localidad").val();
    var id_medico = $("#medico_id").val();
    var cp = $("#cp").val();
    var numero = $("#numero").val();
    // post
    if( id_medico != "" ){
      if( nombreConsultorio != "" && numero != "" && calle != "" && cp != "" && estado != "" && municipio != "" && ciudad != "" && localidad != "" ){
        $.post('/encuesta-intermed/capturista/insertDireccion/',{
          consultorio:nombreConsultorio,
          calle: calle,
          cp: cp,
          estado: estado,
          municipio: municipio,
          ciudad: ciudad,
          localidad: localidad,
          numero: numero,
          id_medico: id_medico
        },function(datas){
            $("#nombreDireccion").val('');
            $("#direccion").val('');
            $("#estado").val('');
            $("#municipio").val('');
            $("#ciudad").val('');
            $("#localidad").val('');
            $('#cp').val('');
            $('#numero').val('');
        }).fail(function(e){
          alert("Error al insertar: "+JSON.stringify(e));
        });
      }else{
        alert("Favor de no dejar campos vacíos :D");
      }
    }else{
      alert("Por favor llene primero la seccion de arriba");
    }
  });
});

function generarMuestraMedicos(){
  $.ajax( {
    url: '/encuesta-intermed/Capturista/generarMuestraMedicos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success){
        console.log('DATA: ' + JSON.stringify(result));
      }
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}
