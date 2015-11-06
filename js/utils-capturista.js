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
          $('#registroMedico').addClass('guardado');
          $('#buttonGuardarMedico').remove();
          $('#formGuardarMedico').removeClass('col-md-8');
          $('#formGuardarMedico').addClass('col-md-12');
        }
      },
      error: function (err) {
        console.log( "Error: AJax dead :" + JSON.stringify(err) );
      }
    } );
  } else {
    bootbox.alert({
        message: "El nombre y apellido paterno del médico son obligatorios",
        title: "No se puede guardar el médico"
    });
  }
};
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
