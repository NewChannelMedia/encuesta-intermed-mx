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

$('#registroTelefonos').click(function(){
  $(this).parent().parent().parent().find('input:visible:first').focus();
});

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
      $.post('/encuesta-intermed/capturista/traerFonsolo/',{id:telefono_id},function(numero){
        $.each(JSON.parse(numero), function( i, item){
          var btntxt = "btntxt" + id;
          //$("#fonAgregado ul.list-inline li input.editar").html(item.numero);
          $("#fonAgregado .editar #"+btntxt).html(item.numero);
          $('#fonAgregado').find('.btnChk').removeClass('active');
          $('#fonAgregado').find(':radio').prop('checked',false);
          $('#fonAgregado').find('.borrar').prop('disabled', true);
        });
      });
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
            var html2 = "";
            $.post('/encuesta-intermed/capturista/anadirFon/',{
              id: $('#medico_id').val()
            },function(datas){
              var idBoton;
              $.each(JSON.parse(datas), function(i, item){
                idBoton = "fon"+item.id;
                html2 += '<div id="atel'+item.id+'" class="input-group-btn">';
                html2 += '<label id="'+idBoton+'" onclick="fonAdd(\''+idBoton+'\');" class="btn btn-sm editar btnChk">';
                html2 += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+item.id+'" class="itemName">('+item.claveRegion+') '+item.numero+'</span>';
                html2 += '</label>';
                html2 += '<button class="btn btn-sm borrar" disabled="disabled" onclick="eliminarTelefono(\''+item.id+'\');"><span class="glyphicon glyphicon-remove"></span></button>';
                html2 += '<span class="hidden" id="id'+idBoton+'">'+item.id+'</span>';
                html2 += '</div>';
              });
              $("#fonAgregado").append(html2);
              limpiaSection('#telefonos');
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
    //$(this).parent().parent().find('.btnClean').removeClass('hidden');
    $(this).parent().parent().parent().find('input:visible:first').focus();
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
            var btntxt = "btntxt" + id;
            $("#editDinamico .editar #"+btntxt).html(item.nombre);
            $('#editDinamico').find('.btnChk').removeClass('active');
            $('#editDinamico').find(':radio').prop('checked',false);
            $('#editDinamico').find('.borrar').prop('disabled', true);
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
                  html += '<div id="'+LiBoton+'" class="input-group-btn">';
                  html += '<label id="'+BotonId+'" onclick="traerID(\''+BotonId+'\');" class="btn btn-sm editar btnChk">';
                  html += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+item.id+'" class="itemName">'+item.nombre+'</span>';
                  html += '</label>';
                  html += '<button class="btn btn-sm borrar" disabled="disabled" onclick="eliminarDireccion(\''+item.id+'\');"><span class="glyphicon glyphicon-remove"></span></button>';
                  html += '</div>';

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

                  //html += '<input type="button" onclick="eliminarDireccion(\''+item.id+'\');" value="eliminar">';


                });
                $("#editDinamico").append(html);
                limpiaSection('#direccionDatos');
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
  /*$("#"+dato).removeClass('editar');
  $("#"+dato).addClass('borrar');*/
  $('#'+dato).parent().parent().find('.borrar').prop('disabled', true);
  $('#'+dato).parent().find('.borrar').prop('disabled', false);
  $('#'+dato).parent().parent().parent().find('.btnAñade').html('Guardar');
  $('#'+dato).parent().parent().parent().parent().find('input:visible:first').focus();
}

function fonAdd(dato){
  var lada = $("#lada"+dato).text();
  var numero = $("#num"+dato).text();
  var tipo = $("#tipo"+dato).text();
  var id = $('#id'+dato).text();
  $("#fonOculto").val(id);
  var idConsulta = $("#fonOculto").val();
  var medico_id = $("#medico_id").val();
  $('#'+dato).parent().parent().find('.borrar').prop('disabled', true);
  $('#'+dato).parent().find('.borrar').prop('disabled', false);
  $('#'+dato).parent().parent().parent().find('.btnAñade').html('Guardar');
  $('#'+dato).parent().parent().parent().parent().find('input:visible:first').focus();
  $.post('/encuesta-intermed/capturista/sincFon/',{
    id: idConsulta
  },function(datas){
    $.each(JSON.parse(datas),function(i, item){
      $("#ladaTelefono").val(item.claveRegion);
      $("#numTelefono").val(item.numero);
      $("#tipoTelefono").val(item.tipo);
    });
  });
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

function eliminarDireccion(id){
  bootbox.confirm({
      message: "¿Estas seguro de querer borrar la dirección?",
      title: "Mensaje de Intermed",
      callback: function(result) {
          if (result){
            $.ajax( {
              url: '/encuesta-intermed/Capturista/eliminarDireccion',
              type: "POST",
              dataType: 'JSON',
              data: {'id':id},
              async: true,
              success: function (result) {
                if (result.success){
                  $('#at'+id).remove();
                  limpiaSection('#registroDireccion');
                }
              },
              error : function (err){
                console.log( "Error: AJax dead :" + JSON.stringify(err) );
              }
            });
          }
        },
      buttons: {
        cancel: {
          label: "No"
        },
        confirm: {
          label: "Si"
        }
      }
    });
}

function eliminarTelefono(id){
  bootbox.confirm({
      message: "¿Estas seguro de querer borrar el teléfono?",
      title: "Mensaje de Intermed",
      callback: function(result) {
          if (result){
            $.ajax( {
              url: '/encuesta-intermed/Capturista/eliminarTelefono',
              type: "POST",
              dataType: 'JSON',
              data: {'id':id},
              async: true,
              success: function (result) {
                if (result.success){
                  $('#atel'+id).remove();
                  limpiaSection('#registroTelefonos');
                }
              },
              error : function (err){
                console.log( "Error: AJax dead :" + JSON.stringify(err) );
              }
            });
          }
        },
      buttons: {
        cancel: {
          label: "No"
        },
        confirm: {
          label: "Si"
        }
      }
    });
}

/* funcion que habilita el boton de borrar de un input-group-btn */
$('.input-group-btn .btnChk').click(function(){
  $(this).parent().parent().find('.borrar').prop('disabled', true);
  $(this).parent().find('.borrar').prop('disabled', false);
  $(this).parent().parent().parent().find('.btnAñade').html('Guardar');
});

/* funcion que regresa el estado de los inputs en la seccion de agregar direcciones y telefonos */
function limpiaSection(section){
  console.log(section);
  $(section).find('input').not(':button, :submit, :reset').val('');
  $(section).find('.btnChk').removeClass('active');
  $(section).find(':radio').prop('checked',false);
  $(section).find('.borrar').prop('disabled', true);
  $(section).find('.btnAñade').html('Añadir');
  $(section).find('input:visible:first').focus();
  $(section).find('.btnClean').removeClass('active');
}

function obtenerSeleccionados(){
  $('#seleccionadosList').html('');
  $.ajax( {
    url: '/encuesta-intermed/Capturista/generarMuestraMedicos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success && result.muestra){
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
            var telefonos = '';
            val.telefonos.forEach(function(telefono){
              if (telefonos != "")
                telefonos+='<br/>';
              telefonos += '(' + telefono.claveRegion + ') ' + telefono.numero;
            });

            var especialidad ='';
            if (val.especialidad && val.especialidad.especialidad)
              especialidad = val.especialidad.especialidad;

            var direcciones = '';
            val.direcciones.forEach(function(direccion){
              if (direcciones != "")
                direcciones+='<br/>';
              direcciones += '<strong>' + direccion.nombre + '</strong><br/>' + direccion.calle + ' ' + direccion.numero + ', '+ direccion.localidad + '<br/>' + direccion.cp + ', '+ direccion.municipio+ ', '+ direccion.estado +'<br/>';
            });

            var guardar = '<button class="btn btn-success" onclick="modificarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-search"></button>'

            $('#seleccionadosList').append('<tr class="muestra" id="'+ val.medico.id+'"><td>'+nombre+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+especialidad+'</td><td class="text-center">'+telefonos+'</td><td class="text-center">'+direcciones+'</td><td class="text-center">'+guardar+'</td></tr>');
          }
        });
      }
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}



function obtenerNoSeleccionados(){
  $('#noSeleccionadosList').html('');
  $.ajax( {
    url: '/encuesta-intermed/Capturista/obtenerNoSeleccionados',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success){
        result.muestra.forEach(function(val){
            var nombre = val.medico.nombre + ' ' + val.medico.apellidop;
            if (val.medico.apellidom){
              nombre +=  ' ' + val.medico.apellidom;
            }
            var correo = '';
            if (val.medico.correo){
              correo = val.medico.correo;
            }
            var telefonos = '';
            val.telefonos.forEach(function(telefono){
              if (telefonos != "")
                telefonos+='<br/>';
              telefonos += '(' + telefono.claveRegion + ') ' + telefono.numero;
            });

            var especialidad ='';
            if (val.especialidad && val.especialidad.especialidad)
              especialidad = val.especialidad.especialidad;

            var direcciones = '';
            val.direcciones.forEach(function(direccion){
              if (direcciones != "")
                direcciones+='<br/>';
              direcciones += '<strong>' + direccion.nombre + '</strong><br/>' + direccion.calle + ' ' + direccion.numero + ', '+ direccion.localidad + '<br/>' + direccion.cp + ', '+ direccion.municipio+ ', '+ direccion.estado +'<br/>';
            });

            var guardar = '<button class="btn btn-success" onclick="modificarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-search"></button>'

            $('#noSeleccionadosList').append('<tr class="muestra" id="'+ val.medico.id+'"><td>'+nombre+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+especialidad+'</td><td class="text-center">'+telefonos+'</td><td class="text-center">'+direcciones+'</td><td class="text-center">'+guardar+'</td></tr>');
        });
      }
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}


function modificarMedico(id){
  $('#ActualizarMedico').find('input').prop('value','');
  $('#ActualizarMedico').find('#registroMedico').find('input,button#agregarDatos').attr('disabled','disabled');
  console.log('Modificar medico_id: ' + id);
  $.ajax( {
    url: '/encuesta-intermed/Capturista/obtenerDatosMedicoId',
    type: "POST",
    dataType: 'JSON',
    data: {'id':id},
    async: true,
    success: function (result) {
      console.log('RESULT: ' + JSON.stringify(result));
      //nombre
      $('#ActualizarMedico').find('#medico_id').prop('value',result.medico.id);
      $('#ActualizarMedico').find('#nombre').prop('value',result.medico.nombre);
      //apellidoP
      $('#ActualizarMedico').find('#apellidoP').prop('value',result.medico.apellidop);
      //apellidoM
      $('#ActualizarMedico').find('#apellidoM').prop('value',result.medico.apellidom);
      //email
      $('#ActualizarMedico').find('#email').prop('value',result.medico.correo);
      //especialidad
      if ( result.especialidad )$('#ActualizarMedico').find('#especialidad').prop('value',result.especialidad.especialidad);

      var direccionesGuardadas = '';
      var html = '';
      result.direcciones.forEach(function(direccion){
          LiBoton = "at"+direccion.id;
          BotonId = "direccionGuardada"+direccion.id;
          html += '<div id="'+LiBoton+'" class="input-group-btn">';
          html += '<label id="'+BotonId+'" onclick="traerID(\''+BotonId+'\');" class="btn btn-sm editar btnChk">';
          html += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+direccion.id+'" class="itemName">'+direccion.nombre+'</span>';
          html += '</label>';
          html += '<button class="btn btn-sm borrar" disabled="disabled" onclick="eliminarDireccion(\''+direccion.id+'\');"><span class="glyphicon glyphicon-remove"></span></button>';
          html += '</div>';

          html += '<span class="hidden" id="id'+BotonId+'">'+direccion.id+'</span>';
          html += '<span class="hidden" id="nombre'+BotonId+'">'+direccion.nombre+'</span>';
          html += '<span class="hidden" id="calle'+BotonId+'">'+direccion.calle+'</span>';
          html += '<span class="hidden" id="numero'+BotonId+'">'+direccion.numero+'</span>';
          html += '<span class="hidden" id="cp'+BotonId+'">'+direccion.cp+'</span>';
          html += '<span class="hidden" id="estado'+BotonId+'">'+direccion.estado+'</span>';
          html += '<span class="hidden" id="municipio'+BotonId+'">'+direccion.municipio+'</span>';
          html += '<span class="hidden" id="ciudad'+BotonId+'">'+direccion.ciudad+'</span>';
          html += '<span class="hidden" id="colonia'+BotonId+'">'+direccion.colonia+'</span>';
          html += '<span class="hidden" id="localidad'+BotonId+'">'+direccion.localidad+'</span>';
      });
      $("#editDinamico").html(html);

      $('#direccionesGuardadas').find('input').click(function(){
        traerBorrarDireccion(this);
      });

      var html2 = '';
      result.telefonos.forEach(function(telefono){
        idBoton = "fon"+telefono.id;
        html2 += '<div id="atel'+telefono.id+'" class="input-group-btn">';
        html2 += '<label id="'+idBoton+'" onclick="fonAdd(\''+idBoton+'\');" class="btn btn-sm editar btnChk">';
        html2 += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+telefono.id+'" class="itemName">('+telefono.claveRegion+') '+telefono.numero+'</span>';
        html2 += '</label>';
        html2 += '<button class="btn btn-sm borrar" disabled="disabled" onclick="eliminarTelefono(\''+telefono.id+'\');"><span class="glyphicon glyphicon-remove"></span></button>';
        html2 += '<span class="hidden" id="id'+idBoton+'">'+telefono.id+'</span>';
        html2 += '</div>';
      });
      $("#fonAgregado").html(html2);

      $('#telefonosGuardados').find('input').click(function(){
        traerBorrarTelefono(this);
      });

      $('#ActualizarMedico').modal('show');
    },
    error: function(err){
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  });
}

function traerBorrarDireccion(element){
  if ($(element).hasClass('editar')){
    $('#direccionesGuardadas input').removeClass('borrar');
    $('#direccionesGuardadas input').addClass('editar');
    $(element).removeClass('editar');
    $(element).addClass('borrar');
    console.log('Traer direccion: ' + $(element).prop('id'));
  } else {
    console.log('Borrar direccion: ' + $(element).prop('id'));
    bootbox.confirm({
        message: "¿Estas seguro de querer borrar la dirección?",
        title: "Mensaje de Intermed",
        callback: function(result) {
            if (result){
              $.ajax( {
                url: '/encuesta-intermed/Capturista/eliminarDireccion',
                type: "POST",
                dataType: 'JSON',
                data: {'id':$(element).prop('id')},
                async: true,
                success: function (result) {
                  if (result.success){
                    $(element).parent().remove();
                  }
                },
                error : function (err){
                  console.log( "Error: AJax dead :" + JSON.stringify(err) );
                }
              });
            }
          },
        buttons: {
          cancel: {
            label: "No"
          },
          confirm: {
            label: "Si"
          }
        }
      });
  }
}

function traerBorrarTelefono(element){
  if ($(element).hasClass('editar')){
    $('#telefonosGuardados input').removeClass('borrar');
    $('#telefonosGuardados input').addClass('editar');
    $(element).removeClass('editar');
    $(element).addClass('borrar');
    console.log('Traer telefono: ' + $(element).prop('id'));
  } else {
    console.log('Borrar telefono: ' + $(element).prop('id'));
    bootbox.confirm({
        message: "¿Estas seguro de querer borrar el teléfono?",
        title: "Mensaje de Intermed",
        callback: function(result) {
            if (result){
              if (result){
                $.ajax( {
                  url: '/encuesta-intermed/Capturista/eliminarTelefono',
                  type: "POST",
                  dataType: 'JSON',
                  data: {'id':$(element).prop('id')},
                  async: true,
                  success: function (result) {
                    if (result.success){
                      $(element).parent().remove();
                    }
                  },
                  error : function (err){
                    console.log( "Error: AJax dead :" + JSON.stringify(err) );
                  }
                });
              }
            }
          },
        buttons: {
          cancel: {
            label: "No"
          },
          confirm: {
            label: "Si"
          }
        }
      });
  }
}

function LimpiarFormularios(){
  limpiaSection('#registroMedico');
  $('#nombre').attr('disabled',false);
  $('#apellidoP').attr('disabled',false);
  $('#especialidad').attr('disabled',false);
  $('#email').attr('disabled',false);
  $("#especialidad").attr('disabled',false);
  $("#editarDatos").attr('disabled',false);
  $("#apellidoM").attr('disabled',false);
  $("#agregarDatos").attr('disabled',false);
  $('#registroMedico').removeClass('guardado');
  $('#registroMedico').removeClass('panel-success');

  limpiaSection('#registroDireccion');
  limpiaSection('#registroTelefonos');
  limpiaSection('#registroMedico');
}
