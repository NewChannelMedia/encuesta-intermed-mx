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
          $('#tipoTelefono').focus();
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

$(function(){
 $( "#especialidad" ).autocomplete({
   source: autocompleteEspecialidades
 });
});
