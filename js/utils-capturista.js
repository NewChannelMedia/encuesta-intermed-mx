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
        alert("Favor de no dejar campos vacíos.");
      }
    }else{
      alert("Por favor llene primero la seccion de arriba");
    }
  });
});


function generarMuestraMedicos(){
  $('#muestraMed').html('');
  $.ajax( {
    url: '/encuesta-intermed/Capturista/generarMuestraMedicos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success){
        result.muestra.forEach(function(val){
          if (val.aut == 0){
            var nombre = val.medico.nombre + ' ' + val.medico.apellidop;
            if (val.medico.apellidom){
              nombre +=  ' ' + val.medico.apellidom;
            }
            var correo = '';
            if (val.medico.correo){
              correo = val.medico.correo;
            }
            var telefonos = '<table width="100%">';
            var checked = ' checked';
            val.telefonos.forEach(function(telefono){
              telefonos += '<tr id="'+ telefono.id +'" class="telefono"><td width="120" class="text-center">(' + telefono.claveRegion + ') ' + telefono.numero +'</td><td class="text-center"><input type="radio" name="telefono_'+ val.muestra_id +'" value="'+ telefono.id +'" '+checked+'></td></tr>';
              checked = '';
            });
            telefonos+='</table>'

            var guardar = '<button class="btn btn-success" onclick="guardarMuestra('+ val.muestra_id+')"><span class="glyphicon glyphicon-saved"></button>'

            var confirmCorreo = '<input type="text" value="" class="confirmCorreo">';
            var autorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="true" checked>';
            var noautorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="false">';
            $('#muestraMed').append('<tr class="muestra" id="'+ val.muestra_id+'"><td>'+nombre+'</td><td class="text-center">'+telefonos+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+confirmCorreo+'</td><td class="autorizo text-center">'+autorizo+'</td><td class="autorizo text-center">'+noautorizo+'</td><td class="text-center">'+guardar+'</td></tr>');
            $('#muestraMed').find('tr').first().addClass('active');
            $('#muestraMed .active').find(':input').filter(':visible:first').focus();
          }
        });
      }
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}

function guardarMuestra(id){
  var trmuestra = $('tr.muestra#'+id);
  var telefono_id = trmuestra.find('tr.telefono>td>input:checked').prop('value');
  var correo = trmuestra.find('input.confirmCorreo').prop('value');
  var correo2 =  trmuestra.find('td.email').html();
  var autorizo = trmuestra.find('td.autorizo>input:checked').prop('value');

  var guardar = true;

  if (correo != ""){
    guardar = validarEmail(correo);
  }

  if (guardar){
    $.ajax( {
      url: '/encuesta-intermed/Capturista/guardarMuestraMedico',
      type: "POST",
      dataType: 'JSON',
      data: {'id':id,'telefono_id':telefono_id,'correo':correo,'correo2':correo2,'aut':autorizo},
      async: true,
      success: function ( result ) {
        if ( result.success ) {
          trmuestra.fadeOut( 300, function () {
            $( this ).remove();
            $( '#muestraMed' ).find( 'tr' ).first().addClass( 'active' );
            $('#muestraMed .active').find(':input').filter(':visible:first').focus();

          } );

        }
      },

      error: function (err){
        console.log( "Error: AJax dead :" + JSON.stringify(err) );
      }
    });
  } else {
    bootbox.alert({
      message: "Formato incorrecto del correo: " + correo,
      title: "No se pueden guardar los cambios"
    });
  }
}

function validarEmail( email ) {
    expr = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if ( !expr.test(email) )
        return false;
    else return true;
}

/* funcion que habilita el boton de borrar de un input-group-btn */
$('.input-group-btn .btnChk').click(function(){
  $(this).parent().parent().find('.borrar').prop('disabled', true);
  $(this).parent().find('.borrar').prop('disabled', false);
  $(this).parent().parent().parent().find('#agregarDireccion').html('Guardar Cambios');
});

/* funcion que regresa el estado de los inputs en la seccion de agregar direcciones y telefonos */
function limpiaSection(section){
  console.log(section);
  $(section).find('input').not(':button, :submit, :reset, :hidden').val('');
  $(section).find('.btnChk').removeClass('active');
  $(section).find(':radio').prop('checked',false);
  $(section).find('.borrar').prop('disabled', true);
  $(section).find('#agregarDireccion').html('Añadir Dirección');
  $(section).find('input').first().focus();
}
