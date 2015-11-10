function guardarMedico(){
  if( $("#medico_id").val() != "" ){
    var nombre = $('#nombre').val();
    var apellidoP = $('#apellidoP').val();
    var apellidoM = $('#apellidoM').val();
    var especialidad = $('#especialidad').val();
    var email = $('#email').prop('value');
    var medico_id = $("#medico_id").val();
    $.post('/encuesta-intermed/capturista/editDatos/',{
      nombre:nombre,
      apellidoP: apellidoP,
      apellidoM: apellidoM,
      especialidad: especialidad,
      email: email,
      medico_id: medico_id
    },function(datos){
        $('#nombre').attr('disabled',true);
        $('#apellidoP').attr('disabled',true);
        $('#especialidad').attr('disabled',true);
        $('#email').attr('disabled',true);
        $("#especialidad").attr('disabled',true);
        $("#editarDatos").attr('disabled',false);
        $("#apellidoM").attr('disabled',true);
        $("#agregarDatos").attr('disabled',true);
    }).fail(function(e){
      alert("Fallo en actualizar datos: "+JSON.stringify(e));
    });
  }else{
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
            $("#editarDatos").attr('disabled',false);
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
}

function guardarTelefono(){
  var id = $('#medico_id').val();
  var clave = $('#ladaTelefono').val();
  var numero = $('#numTelefono').val();
  var tipo = $('#tipoTelefono').val();
  var telefono_id = $('#fonOculto').val();
  var data = {
              'medico_id': id,
              'claveRegion': clave,
              'numero': numero,
              'tipo': tipo
            };
  if( $("#fonOculto").val() != "" ){
    $.post('/encuesta-intermed/capturista/actualizarFon/',{
      id: telefono_id,
      clave: clave,
      numero: numero,
      tipo: tipo
    },function(data){
      $('#ladaTelefono').val('');
      $('#numTelefono').val('');
      $('#tipoTelefono').val('');
      $('#fonOculto').val('');
    }).fail(function(e){
      alert("Error: "+JSON.stringify(e));
    });
  }else{
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
            //LI
            var html2 = "";
            $.post('/encuesta-intermed/capturista/anadirFon/',{
              id: $('#medico_id').val()
            },function(datas){
              var idBoton;
              $.each(JSON.parse(datas), function(i, item){
                idBoton = "fon"+item.id;
                html2 += '<li id="">';
                html2 += '<input type="button" id="'+idBoton+'" onclick="fondAdd(\''+idBoton+'\');" class="btn btn-sm editar" value="'+item.numero+'" />';
                html2 += '<span class="hidden" id="lada'+idBoton+'">'+item.claveRegion+'</span>';
                html2 += '<span class="hidden" id="num'+idBoton+'">'+item.numero+'</span>';
                html2 += '<span class="hidden" id="tipo'+idBoton+'">'+item.tipo+'</span>';
                html2 += '<span class="hidden" id="id'+idBoton+'">'+item.id+'</span>';
                html2 += '</li>';
              });
              $("#fonAgregado ul").append(html2);
            });
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
  var BotonId = "";
  var LiBoton = "";
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
    if( $("#superOculto").val() != "" ){
      var id = $("#superOculto").val();
      $.post('/encuesta-intermed/capturista/actualizaDireccion/',{
        id: id,
        consultorio:nombreConsultorio,
        calle: calle,
        cp: cp,
        estado: estado,
        municipio: municipio,
        ciudad: ciudad,
        localidad: localidad,
        numero: numero,
        id_medico: id_medico
      },function(){
        $.post('/encuesta-intermed/capturista/ponerNombre/',{id:id},function(datos){
          $.each(JSON.parse(datos), function(i, item){
            $("#editDinamico ul li button.borrar").html(item.nombre);
            $("#editDinamico ul li button.borrar").removeClass('borrar');
            $("#editDinamico ul li button.borrar").addClass('editar');
          });
        }).fail(function(e){
          alert("Error al cargar la actualizacion del nombre: Err->"+JSON.stringify(e));
        });
        $("#nombreDireccion").val('');
        $("#direccion").val('');
        $("#estado").val('');
        $("#municipio").val('');
        $("#ciudad").val('');
        $("#localidad").val('');
        $("#superOculto").val('');
        $("#numero").val('');
        $("#cp").val('');
      });
    }else{
      //checa si este campo esta lleno, en caso que lo este manda a actualizar los campos
      // caso contrario los inserta
      if( $("#superOculto").val() != "" ){
        $("/encuesta-intermed/capturista/actualizaDireccion/",{
          consultorio:nombreConsultorio,
          calle: calle,
          cp: cp,
          estado: estado,
          municipio: municipio,
          ciudad: ciudad,
          localidad: localidad,
          numero: numero,
          id_medico: id_medico
        },function(){});
      }else{
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
                $("#superOculto").text();
                $("#nombreDireccion").val('');
                $("#direccion").val('');
                $("#estado").val('');
                $("#municipio").val('');
                $("#ciudad").val('');
                $("#localidad").val('');
                $('#cp').val('');
                $('#numero').val('');
            }).done(function(){
              /**
              * en la siguiente funcion cuando se presione el boton se hara una consulta a la db
              * donde me retornara el nombre del consultorio, y al presionarlo se llenaran los input para poderlos editar
              *
              *
              */
              $.post('/encuesta-intermed/capturista/editarDirecciones',{
                medico_id: id_medico
              },function(d){
                var html="";
                $.each(JSON.parse(d), function(i, item){
                  LiBoton = "at"+item.id;
                  BotonId = "direccionGuardada"+item.id;
                  html += '<li id="'+LiBoton+'">';
                  html += '<button id="'+BotonId+'" onclick="traerID(\''+BotonId+'\');" class="btn btn-sm editar">'+item.nombre+'</button>';
                  html += '<span class="hidden" id="id'+BotonId+'">'+item.id+'</span>';
                  html += '<span class="hidden" id="nombre'+BotonId+'">'+item.nombre+'</span>';
                  html += '<span class="hidden" id="calle'+BotonId+'">'+item.calle+'</span>';
                  html += '<span class="hidden" id="numero'+BotonId+'">'+item.numero+'</span>';
                  html += '<span class="hidden" id="cp'+BotonId+'">'+item.cp+'</span>';
                  html += '<span class="hidden" id="estado'+BotonId+'">'+item.estado+'</span>';
                  html += '<span class="hidden" id="municipio'+BotonId+'">'+item.municipio+'</span>';
                  html += '<span class="hidden" id="ciudad'+BotonId+'">'+item.ciudad+'</span>';
                  html += '<span class="hidden" id="colonia'+BotonId+'">'+item.colonia+'</span>';
                  html += '<span class="hidden" id="localidad'+BotonId+'">'+item.localidad+'</span>';
                  html += '</li>';
                });
                $("#editDinamico ul").append(html);
              });
            }).fail(function(e){
              alert("Error al insertar: "+JSON.stringify(e));
            });
          }else{
            alert("Favor de no dejar campos vacíos :D");
          }
        }else{
          alert("Por favor llene primero la seccion de arriba");
        }
      }
    }
  });
  /**
  * El siguiente evento click es para el boton de editar donde el cual habilitara todos los
  * inputs de la seccion que esten deshabilitados para poderlos editar tambien
  * se habilitara el boton de guardar para guardar los cambios hechos
  *
  **/
  $("#editarDatos").click(function(){
    $("#nombre").attr('disabled',false);
    $("#apellidoP").attr('disabled',false);
    $("#apellidoM").attr('disabled',false);
    $("#email").attr('disabled',false);
    $("#especialidad").attr('disabled',false);
    $("#agregarDatos").attr('disabled',false);
    $( this ).attr('disabled',true);
  });
});
function traerID(dato){
  var nombre = $("#nombre"+dato).text();
  var calle = $("#calle"+dato).text();
  var numero = $("#numero"+dato).text();
  var cp = $("#cp"+dato).text();
  var estado = $("#estado"+dato).text();
  var municipio = $("#municipio"+dato).text();
  var ciudad = $("#ciudad"+dato).text();
  var colonia = $("#colonia"+dato).text();
  var localidad = $("#localidad"+dato).text();
  var id= $("#id"+dato).text();
  $("#superOculto").attr('value',id);
  $("#nombreDireccion").val(nombre);
  $("#direccion").val(calle);
  $("#numero").val(numero);
  $("#cp").val(cp);
  $("#estado").val(estado);
  $("#municipio").val(municipio);
  $("#ciudad").val(ciudad);
  $("#localidad").val(localidad);
  $("#"+dato).removeClass('editar');
  $("#"+dato).addClass('borrar');
}
function fondAdd(dato){
  var lada = $("#lada"+dato).text();
  var numero = $("#num"+dato).text();
  var tipo = $("#tipo"+dato).text();
  var id = $('#id'+dato).text();
  $("#ladaTelefono").val(lada);
  $("#fonOculto").val(id);
  $("#numTelefono").val(numero);
  $("#tipoTelefono").val(tipo);
}


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
