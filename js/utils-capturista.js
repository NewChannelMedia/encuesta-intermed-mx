function guardarMedico(){
  if( $("#medico_id").val() != "" ){
    var nombre = $('#nombre').val();
    var apellidoP = $('#apellidoP').val();
    var apellidoM = $('#apellidoM').val();
    var especialidad = $('#especialidad').val();
    var email = $('#email').prop('value');
    var medico_id = $("#medico_id").val();
    $.post('/capturista/editDatos/',{
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
    $.ajax( {
      url: '/Capturista/guardarMedico',
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
  }
}

function guardarTelefono(){
  var id = $('#medico_id').val();
  var clave = $('#ladaTelefono').val();
  var tipo = $('#tipoTelefono').val();
  var numero = '';
  switch(tipo) {
    case "casa":
        numero = $('#numTelefono').val();
        break;
    case "celular":
        numero = $('#numTelefono').val();
        break;
    case "oficina":
        numero = $('#numTelefono').val() + '-' + $('#extTelefono').val();
        break;
    case "localizador":
        numero = $('#numTelefono').val() + '-' + $('#locTelefono').val();
        break;
  }

  var telefono_id = $('#fonOculto').val();
  var data = {
              'medico_id': id,
              'claveRegion': clave,
              'numero': numero,
              'tipo': tipo
            };
  if( $("#fonOculto").val() != "" ){
    $.post('/capturista/actualizarFon/',{
      id: telefono_id,
      clave: clave,
      numero: numero,
      tipo: tipo
    },function(data){
      limpiaSection('#registroTelefonos');
      $.post('/capturista/traerFonsolo/',{id:telefono_id},function(numero){
        $.each(JSON.parse(numero), function( i, item){
          var btntxt = "btntxt" + telefono_id;
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
    if (id != ''){
      $.ajax( {
        url: '/Capturista/guardarTelefono',
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
            $.post('/capturista/anadirFon/',{
              id: $('#medico_id').val()
            },function(datas){
              var idBoton;
              $.each(JSON.parse(datas), function(i, item){
                idBoton = "fon"+item.id;
                html2 += '<div id="atel'+item.id+'" class="input-group-btn">';
                html2 += '<label id="'+idBoton+'" onclick="fonAdd(\''+idBoton+'\');" class="btn btn-sm editar btnChk">';
                html2 += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+item.id+'" class="itemName"> '+item.numero+'</span>';
                html2 += '</label>';
                html2 += '<button class="btn btn-sm borrar" disabled="disabled" onclick="eliminarTelefono(\''+item.id+'\');"><span class="glyphicon glyphicon-remove"></span></button>';
                html2 += '<span class="hidden" id="id'+idBoton+'">'+item.id+'</span>';
                html2 += '</div>';
              });
              $("#fonAgregado").append(html2);
              limpiaSection('#registroTelefonos');
            });
          }
        },
        error: function (err) {
          console.log( "Error: AJax dead :" + JSON.stringify(err) );
        }
      } );
    } else {
      bootbox.alert({
          message: "Es necesario registrar un médico antes de agregar algún teléfono.",
          title: "No se puede guardar el número de teléfono",
          callback: function() {setTimeout(function(){$('#nombre').focus();},300); }
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
    var otralocalidad = $('#otralocalidad').val();
    var id_medico = $("#medico_id").val();
    var cp = $("#cp").val();
    var numero = $("#numero").val();
    if( $("#superOculto").val() != "" ){
      var id = $("#superOculto").val();
      $.post('/capturista/actualizaDireccion/',{
        id: id,
        consultorio:nombreConsultorio,
        calle: calle,
        cp: cp,
        estado: estado,
        municipio: municipio,
        ciudad: ciudad,
        localidad: localidad,
        numero: numero,
        id_medico: id_medico,
        otralocalidad: otralocalidad
      },function(){
        $.post('/capturista/ponerNombre/',{id:id},function(datos){
          $.each(JSON.parse(datos), function(i, item){
            var btntxt = "btntxt" + id;
            var iddireccion = 'direccionGuardada' + id;
            $("#editDinamico #nombre" + iddireccion).html(item.nombre);
            $("#editDinamico #calle" + iddireccion).html(calle);
            $("#editDinamico #numero" + iddireccion).html(numero);
            $("#editDinamico #municipio" + iddireccion).html(municipio);
            $("#editDinamico #estado" + iddireccion).html(estado);
            $("#editDinamico #localidad" + iddireccion).html(localidad);
            $("#editDinamico #otralocalidad" + iddireccion).html(otralocalidad);
            $("#editDinamico #cp" + iddireccion).html(cp);

            $("#editDinamico .editar #"+btntxt).html(item.nombre);
            $('#editDinamico').find('.btnChk').removeClass('active');
            $('#editDinamico').find(':radio').prop('checked',false);
            $('#editDinamico').find('.borrar').prop('disabled', true);
          });
        }).fail(function(e){
          alert("Error al cargar la actualizacion del nombre: Err->"+JSON.stringify(e));
        });
        limpiaSection('#direccionDatos');
      });
    }else{
      if( id_medico != "" ){
          $.post('/capturista/insertDireccion/',{
            consultorio:nombreConsultorio,
            calle: calle,
            cp: cp,
            estado: estado,
            municipio: municipio,
            ciudad: ciudad,
            localidad: localidad,
            numero: numero,
            id_medico: id_medico,
            otralocalidad: otralocalidad
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
            $.post('/capturista/editarDirecciones',{
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
                var otralocalidad = '';
                if (item.otralocalidad) otralocalidad = item.otralocalidad;
                html += '<span class="hidden" id="otralocalidad'+BotonId+'">'+otralocalidad+'</span>';

                //html += '<input type="button" onclick="eliminarDireccion(\''+item.id+'\');" value="eliminar">';


              });
              $("#editDinamico").append(html);
              limpiaSection('#direccionDatos');
            });
          }).fail(function(e){
            alert("Error al insertar: "+JSON.stringify(e));
          });
      }else{
        bootbox.alert({
            message: "Es necesario registrar un médico antes de agregar alguna dirección.",
            title: "No se puede guardar la dirección",
            callback: function() {setTimeout(function(){$('#nombre').focus();},300); }
        });
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
  var otralocalidad= $("#otralocalidad"+dato).text();
  $("#estado").val('');
  $("#superOculto").attr('value',id);
  $("#nombreDireccion").val(nombre);
  $("#direccion").val(calle);
  $("#numero").val(numero);
  $("#cp").val(cp);
  $("#estado").val(estado);
  traerMunicipios();
  $("#municipio").val(municipio);
  traerLocalidades();
  $("#localidad").val(localidad);
  $("#otralocalidad").val(otralocalidad);
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
  $.post('/capturista/sincFon/',{
    id: idConsulta
  },function(datas){
    $.each(JSON.parse(datas),function(i, item){
      switch(item.tipo) {
        case "casa":
            console.log('casa');
            $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-12 col-sm-12"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/></div>');
            $("#numTelefono").val(item.numero);
            break;
        case "celular":
            console.log('celular');
            $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-12 col-sm-12"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/></div>');
            $("#numTelefono").val(item.numero);
            break;
        case "oficina":
            console.log('oficina');
            $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-8 col-sm-8"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/></div><div class="form-group col-md-4 col-sm-4"><input type="text" id="extTelefono" class="form-control solo-numero" placeholder="Ext:" maxlength="4" onpaste="soloNumeros()"/></div>');
            $("#numTelefono").val(item.numero.split("-")[0]);
            $("#extTelefono").val(item.numero.split("-")[1]);
            break;
        case "localizador":
            console.log('Localizador');
            $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-6 col-sm-6"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/></div><div class="form-group col-md-6 col-sm-6"><input type="text" id="locTelefono" class="form-control solo-numero" placeholder="Localizador:" maxlength="8" onpaste="soloNumeros()"/></div>');
            $("#numTelefono").val(item.numero.split("-")[0]);
            $("#locTelefono").val(item.numero.split("-")[1]);
            break;
      }
      $("#tipoTelefono").val(item.tipo);
    });
  });
}


function generarMuestraMedicos(){
  $('.loader-container').removeClass('hidden');
  $('#muestraMed').html('');
  $.ajax( {
    url: '/Capturista/generarMuestraMedicos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success && result.muestra && result.muestra.length>0){
        result.muestra.forEach(function(val){
          if (val.aut == 0 && (!val.posponer || val.posponer == "")){
            var nombre = val.medico.nombre + ' ' + val.medico.apellidop;
            if (val.medico.apellidom){
              nombre +=  ' ' + val.medico.apellidom;
          modificarMedico  }
            var correo = '';
            if (val.medico.correo){
              correo = val.medico.correo;
            }
            var telefonos = '<table width="100%">';
            var checked = ' checked';
            val.telefonos.forEach(function(telefono){
              var icon = '<span class="glyphicon glyphicon-earphone" style="font-size:80%"></span>'
              if (telefono.tipo == "celular"){
                icon = '<span class="glyphicon glyphicon-phone" style="font-size:80%"></span>';
              } else if (telefono.tipo == "casa"){
                icon = '<span class="glyphicon glyphicon-home" style="font-size:80%"></span>';
              } else if (telefono.tipo == "localizador"){
                icon = '<span class="glyphicon glyphicon-screenshot" style="font-size:80%"></span>';
              }
              telefonos += '<tr id="'+ telefono.id +'" class="telefono"><td width="120" class="text-center"><div class="media"><div class="media-left">' + icon +'</div><div class="media-body">' + telefono.numero +'</div><div class="media-right"><input type="radio" name="telefono_'+ val.muestra_id +'" value="'+ telefono.id +'" '+checked+'></div></div></td></tr>';
              checked = '';
            });
            telefonos+='</table>'

            var guardar = '<button class="btn btn-success" onclick="guardarMuestra('+ val.muestra_id+',this)"><span class="glyphicon glyphicon-saved"></button>'

            var posponer = '<div class="input-group" style="width: 200px;"><input type="text" class="form-control posponer"><span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="posponerMuestra('+ val.muestra_id+')"><span class="glyphicon glyphicon-folder-close"></span></button></span></div>';

            var confirmCorreo = '<input type="text" value="" class="confirmCorreo">';
            var autorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="true" checked>';
            var noautorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="false">';
            $('#muestraMed').append('<tr class="muestra" id="'+ val.muestra_id+'"><td>'+nombre+'</td><td class="text-center">'+telefonos+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+confirmCorreo+'</td><td class="autorizo text-center">'+autorizo+'</td><td class="autorizo text-center">'+noautorizo+'</td><td class="text-center">'+guardar+'</td><td>'+ posponer +'</td></tr>');
            $('#muestraMed').find('tr').first().addClass('active');
            $('#muestraMed .active').find(':input').filter(':visible:first').focus();
          }
        });
      }
      $('.loader-container').addClass('hidden');
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}

function guardarMuestra(id, element){
  //var trmuestra = $('tr.muestra#'+id);
  var trmuestra = $(element).parent().parent();
  var telefono_id = trmuestra.find('tr.telefono>td>input:checked').prop('value');
  var correo = trmuestra.find('input.confirmCorreo').prop('value');
  var correo2 =  trmuestra.find('td.email').html();
  var autorizo = trmuestra.find('td.autorizo>input:checked').prop('value');

  var guardar = true;

  if (correo != ""){
    console.log('Nuevo correo: ' + correo);
    guardar = validarEmail(correo);
  }

  if (guardar){
    $.ajax( {
      url: '/Capturista/guardarMuestraMedico',
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

function posponerMuestra(id){
  var trmuestra = $('tr.muestra#'+id);
  var posponer =  trmuestra.find('input.posponer').val();

  var guardar = true;

  $.ajax( {
    url: '/Capturista/PosponerMuestraMedico',
    type: "POST",
    dataType: 'JSON',
    data: {'id':id,'posponer':posponer},
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
              url: '/Capturista/eliminarDireccion',
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
              url: '/Capturista/eliminarTelefono',
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
  $(section).find('input').not(':button, :submit, :reset').val('');
  if (section == "#direccionDatos"){
    $('#estado')[0].selectedIndex = 0;
    traerMunicipios();
    traerLocalidades();
  } else if (section == "#registroTelefonos"){
    $('#tipoTelefono').prop('value','casa');
    $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-12 col-sm-12"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()"/></div>');
  }
  $('select')[0].selectedIndex = 0;
  $(section).find('.btnChk').removeClass('active');
  $(section).find(':radio').prop('checked',false);
  $(section).find('.borrar').prop('disabled', true);
  $(section).find('.btnAñade').html('Añadir');
  $(section).find('input:visible:first').focus();
  $(section).find('.btnClean').removeClass('active');
}

function obtenerSeleccionados(){
  $('.loader-container').removeClass('hidden');
  $('#seleccionadosList').html('');
  $.ajax( {
    url: '/Capturista/generarMuestraMedicos',
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
              var icon = '<span class="glyphicon glyphicon-earphone" style="font-size:90%"></span>'
              if (telefono.tipo == "celular"){
                icon = '<span class="glyphicon glyphicon-phone" style="font-size:90%"></span>'
              }
              telefonos += icon + ' ' + telefono.numero;
            });

            var especialidad ='';
            if (val.especialidad && val.especialidad.especialidad)
              especialidad = val.especialidad.especialidad;


            var direcciones = '';
            val.direcciones.forEach(function(direccion){
              var dir = '';
              if (direccion.calle != ""){
                dir = direccion.calle;
              }
              if (direccion.numero != ""){
                if (dir != "") dir += " ";
                dir += direccion.numero;
              }

              if (direcciones != "")
                direcciones+='<br/>';
              var localidad = '';
              if (direccion.localidad && direccion.localidad != ""){
                if (dir != "") localidad += ", ";
                localidad += direccion.localidad ;
              } else if (direccion.otralocalidad && direccion.otralocalidad != "") {
                if (dir != "") localidad += ", ";
                localidad += direccion.otralocalidad;
              }
              var municipio = '';
              if (direccion.municipio){
                municipio = direccion.municipio + ', ';
              }
              var estado = '';
              if (direccion.estado){
                estado = direccion.estado;
              }
              var cp = '';
              if (direccion.cp != ""){
                cp = direccion.cp + ', ';
              }
              direcciones += '<strong>' + direccion.nombre + '</strong><br/>'+ dir + localidad + '<br/>' + cp + municipio + estado +'<br/>';
            });

            var guardar = '<button class="btn btn-success" onclick="modificarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-search"></button>'

            $('#seleccionadosList').append('<tr class="muestra" id="'+ val.medico.id+'"><td>'+nombre+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+especialidad+'</td><td class="text-center">'+telefonos+'</td><td class="text-center">'+direcciones+'</td><td class="text-center">'+guardar+'</td></tr>');
          }
        });
      }
      $('.loader-container').addClass('hidden');
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}



function obtenerNoSeleccionados(){
  $('.loader-container').removeClass('hidden');
  $('#noSeleccionadosList').html('');
  var url = 'obtenerNoSeleccionados';
  if ($('#revisados').length > 0){
    url = 'obtenerNoSeleccionadosRevisados';
  }
  $.ajax( {
    url: '/Capturista/'+url,
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
              var icon = '<span class="glyphicon glyphicon-earphone" style="font-size:90%"></span>'
              if (telefono.tipo == "celular"){
                icon = '<span class="glyphicon glyphicon-phone" style="font-size:90%"></span>'
              }
              telefonos += icon + ' ' + telefono.numero;
            });

            var especialidad ='';
            if (val.especialidad && val.especialidad.especialidad)
              especialidad = val.especialidad.especialidad;

            var direcciones = '';
            val.direcciones.forEach(function(direccion){
              var dir = '';
              if (direccion.calle != ""){
                dir = direccion.calle;
              }
              if (direccion.numero != ""){
                if (dir != "") dir += " ";
                dir += direccion.numero;
              }

              if (direcciones != "")
                direcciones+='<br/>';
              var localidad = '';
              if (direccion.localidad && direccion.localidad != ""){
                if (dir != "") localidad += ", ";
                localidad += direccion.localidad ;
              } else if (direccion.otralocalidad && direccion.otralocalidad != "") {
                if (dir != "") localidad += ", ";
                localidad += direccion.otralocalidad;
              }
              var municipio = '';
              if (direccion.municipio){
                municipio = direccion.municipio + ', ';
              }
              var estado = '';
              if (direccion.estado){
                estado = direccion.estado;
              }
              var cp = '';
              if (direccion.cp != ""){
                cp = direccion.cp + ', ';
              }
              direcciones += '<strong>' + direccion.nombre + '</strong><br/>'+ dir + localidad + '<br/>' + cp + municipio + estado +'<br/>';
            });

            var revisado = '';
            if ($('th.revisado').length>0){
              revisado = '<td><input type="checkbox" onclick="MarcarRevisado('+val.medico.id+')"></td>';
            }

            var guardar = '<button class="btn btn-success" onclick="modificarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-search"></button>'

            var eliminar = '<button class="btn btn-danger" onclick="eliminarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-remove"></button>'

            $('#noSeleccionadosList').append('<tr class="muestra" id="'+ val.medico.id+'">'+revisado+'<td>'+nombre+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+especialidad+'</td><td class="text-center">'+telefonos+'</td><td class="text-center">'+direcciones+'</td><td class="text-center">'+guardar+'</td><td class="text-center">'+eliminar+'</td></tr>');
        });
      }
      $('.loader-container').addClass('hidden');
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}


function modificarMedico(id){
  $('#estado')[0].selectedIndex = 0;
  $('#tipoTelefono')[0].selectedIndex = 0;
  traerMunicipios();
  traerLocalidades();

  medicoSeleccionado_id = id;
  $('#ActualizarMedico').find('input').prop('value','');
  $('#ActualizarMedico').find('#registroMedico').find('input,button#agregarDatos').attr('disabled','disabled');
  $.ajax( {
    url: '/Capturista/obtenerDatosMedicoId',
    type: "POST",
    dataType: 'JSON',
    data: {'id':id},
    async: true,
    success: function (result) {
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
          html += '<span class="hidden" id="estado'+BotonId+'">'+direccion.estado_id+'</span>';
          html += '<span class="hidden" id="municipio'+BotonId+'">'+direccion.municipio_id+'</span>';
          html += '<span class="hidden" id="ciudad'+BotonId+'">'+direccion.ciudad+'</span>';
          html += '<span class="hidden" id="colonia'+BotonId+'">'+direccion.colonia+'</span>';
          html += '<span class="hidden" id="localidad'+BotonId+'">'+direccion.localidad_id+'</span>';
          html += '<span class="hidden" id="otralocalidad'+BotonId+'">'+direccion.otralocalidad+'</span>';
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
        html2 += '<input type="radio" name="editDirecciones" id="option1" autocomplete="off" class=""><span id="btntxt'+telefono.id+'" class="itemName">'+telefono.numero+'</span>';
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
                url: '/Capturista/eliminarDireccion',
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
                  url: '/Capturista/eliminarTelefono',
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
  $.ajax( {
    url: '/Capturista/terminarCaptura',
    type: "POST",
    dataType: 'JSON',
    data: {'id':$('#medico_id').val()},
    async: true,
    success: function (result) {
      if (result.success){
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

        $('#editDinamico').html('');
        $('#fonAgregado').html('');

        limpiaSection('#registroDireccion');
        limpiaSection('#editDinamico');
        limpiaSection('#fonAgregado');
        limpiaSection('#registroTelefonos');
        limpiaSection('#registroMedico');
      }
    },
    error : function (err){
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  });
}


function actualizarInformacionMedico(id){
    //console.log('medicoSeleccionado_id: ' +medicoSeleccionado_id);
    $.ajax( {
      url: '/Capturista/obtenerDatosMedicoId',
      type: "POST",
      dataType: 'JSON',
      data: {'id':id},
      async: true,
      success: function (val) {
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
          var icon = '<span class="glyphicon glyphicon-earphone" style="font-size:90%"></span>'
          if (telefono.tipo == "celular"){
            icon = '<span class="glyphicon glyphicon-phone" style="font-size:90%"></span>'
          }
          telefonos += icon + ' ' + telefono.numero;
        });
        var especialidad ='';
        if (val.especialidad && val.especialidad.especialidad)
          especialidad = val.especialidad.especialidad;

          var direcciones = '';
          val.direcciones.forEach(function(direccion){
            var dir = '';
            if (direccion.calle != ""){
              dir = direccion.calle;
            }
            if (direccion.numero != ""){
              if (dir != "") dir += " ";
              dir += direccion.numero;
            }

            if (direcciones != "")
              direcciones+='<br/>';
            var localidad = '';
            if (direccion.localidad && direccion.localidad != ""){
              if (dir != "") localidad += ", ";
              localidad += direccion.localidad ;
            } else if (direccion.otralocalidad && direccion.otralocalidad != "") {
              if (dir != "") localidad += ", ";
              localidad += direccion.otralocalidad;
            }
            var municipio = '';
            if (direccion.municipio){
              municipio = direccion.municipio + ', ';
            }
            var estado = '';
            if (direccion.estado){
              estado = direccion.estado;
            }
            var cp = '';
            if (direccion.cp != ""){
              cp = direccion.cp + ', ';
            }
            direcciones += '<strong>' + direccion.nombre + '</strong><br/>'+ dir + localidad + '<br/>' + cp + municipio + estado +'<br/>';
          });

        var guardar = '<button class="btn btn-success" onclick="modificarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-search"></button>'

        var eliminar = '';
        if ($('tr.muestra#'+medicoSeleccionado_id).parent().prop('id') == "noSeleccionadosList"){
          eliminar = '<button class="btn btn-danger" onclick="eliminarMedico('+ val.medico.id+')"><span class="glyphicon glyphicon-remove"></button>';
        }
        var revisado = '';
        if ($('th.revisado').length>0){
          revisado = '<td><input type="checkbox" onclick="MarcarRevisado('+val.medico.id+')"></td>';
        }
        $('tr.muestra#'+medicoSeleccionado_id).html(revisado+'<td>'+nombre+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+especialidad+'</td><td class="text-center">'+telefonos+'</td><td class="text-center">'+direcciones+'</td><td class="text-center">'+guardar+'</td><td class="text-center">'+eliminar+'</td>');
      },
      error: function (err){
        console.log('ERR: ' + JSON.stringify(err));
      }
    });
}

$('#estado').change(function () {
  traerMunicipios();
});

function traerMunicipios(){
  var estado_id = $('#estado').prop('value');
  $('#municipio').html('<option value="">Municipio/Ciudad</option>');
  $('#localidad').html('<option value="">Localidad/Colonia</option>');
  $.ajax( {
    url: '/Capturista/municipios',
    type: "POST",
    dataType: 'JSON',
    data: {'estado_id':estado_id},
    async: false,
    success: function (result) {
      var municipios = '<option value="">Municipio/Ciudad</option>';
      result.forEach(function(municipio){
        municipios += '<option value="'+municipio.id+'">'+municipio.municipio+'</option>';
      });
      $('#municipio').html(municipios);
    },
    error: function (err){
      console.log('ERR: ' + JSON.stringify(err));
    }
  });
}

$('#municipio').change(function () {
  traerLocalidades();
});

function traerLocalidades(){
  var estado_id = $('#estado').prop('value');
  var municipio_id = $('#municipio').prop('value');
  $('#localidad').html('<option value="">Localidad/Colonia</option>');
  $.ajax( {
    url: '/Capturista/localidades',
    type: "POST",
    dataType: 'JSON',
    data: {'estado_id':estado_id,'municipio_id':municipio_id},
    async: false,
    success: function (result) {
      var localidades = '<option value="">Localidad/Colonia</option>';
      result.forEach(function(localidad){
        localidades += '<option value="'+localidad.id+'">'+localidad.localidad+'</option>';
      });
      $('#localidad').html(localidades);
    },
    error: function (err){
      console.log('ERR: ' + JSON.stringify(err));
    }
  });
}

$('#localidad').change(function () {
  var localidad_id = this.value;
  $('#localidades').html('');
  $.ajax( {
    url: '/Capturista/localidad',
    type: "POST",
    dataType: 'JSON',
    data: {'localidad_id':localidad_id},
    async: true,
    success: function (result) {
      $('#cp').prop('value',result[0].CP);
    },
    error: function (err){
      console.log('ERR: ' + JSON.stringify(err));
    }
  });
});

/**
* El siguiente evento insertara el usuario y password, ademas de
* el nombre y apellido a sus correspondientes tablas
*
**/
$(document).ready(function(){
  $("#UserPass").click(function(){
    // ajax para el envio de los inputs a su registro de su respectiva tabla
    var usuario = $("#user").val();
    var password = $("#password").val();
    // se checa que no esten vacios estos campos para poderlos insertar
    if( user != "" && password != "" ){
      $.post('/capturista/usuarioPassword/',{
        usuario: usuario,
        password: password
      },function(data){
        if( data ){
          // si data es verdadero, se inserta en un div un span con un letrero de que su insercion fue hecha bien
          $("#usuarioGuardado").addClass('guardado');
          $.post('/capturista/getDatas/',{
            usuario:usuario,
            password:password
          },function(datas){
            $.each(JSON.parse(datas), function(i, item){
              $("#usuario_id").val(item.id);
              $("#user").val(item.user);
              $("#password").val(item.pass);
            });
          });
        }else{
          // en caso contrario se pondra en el span el error de que no se pudo insertar correctamente
          bootbox.alert({
                  message: "Se tiene que llenar todos los campos de usuario y password por favor.",
                  title: "Campos vacios",
                  callback: function() {setTimeout(function(){
                    if( $("#user").val() == "" && $("#password").val() != "" ){
                      $('#user').focus();
                    }else if ( $("#password").val() == "" && $("#user").val() != "" ) {
                      $('#password').focus();
                    }else if( $("#user").val() == "" && $("#password").val() == "" ){
                      $('#user').focus();
                    }
                  },300); }
              });
        }
      });
    }else{
      bootbox.alert({
              message: "Se tiene que llenar todos los campos de usuario y password por favor.",
              title: "Campos vacios",
              callback: function() {setTimeout(function(){
                if( $("#user").val() == "" && $("#password").val() != "" ){
                  $('#user').focus();
                }else if ( $("#password").val() == "" && $("#user").val() != "" ) {
                  $('#password').focus();
                }else if( $("#user").val() == "" && $("#password").val() == "" ){
                  $('#user').focus();
                }
              },300); }
          });
    }
  });
  $("#mandarNombre").click(function(){
    if( $("#usuario_id").val() != "" ){
      var nombre = $("#nombreCapturista").val();
      var apellido = $("#apellidoCapturista").val();
      var idUsuario = $("#usuario_id").val();
      var correo = $("#mailCapturista").val();
      if( nombre != "" && apellido != "" && correo != ""){
        $.post('/capturista/insertDatosCapturista/',{
          id:idUsuario,
          nombre:nombre,
          correo: correo,
          apellido: apellido
        }, function(datas){
          if(datas){
            $("#usuarioGuardado").addClass('guardado');
            $.post('/capturista/getDatosNombres/',{
              id: idUsuario
            },function(d){
              $.each(JSON.parse(d), function(i, item){
                $("#nombreCapturista").val(item.nombre);
                $("#apellidoCapturista").val(item.apellido);
                $("#mailCapturista").val(item.correo);
              });
            });
          }
        });
      }else{
        bootbox.alert({
                message: "Se tiene que llenar todos los campos de usuario y password primero por favor.",
                title: "Campos vacios",
                callback: function() {setTimeout(function(){
                  if( $("#nombreCapturista").val() == "" && $("#apellidoCapturista").val() != "" ){
                    $('#nombreCapturista').focus();
                  }else if ( $("#apellidoCapturista").val() == "" && $("#nombreCapturista").val() != "" ) {
                    $('#apellidoCapturista').focus();
                  }else if( $("#nombreCapturista").val() == "" && $("#apellidoCapturista").val() == "" ){
                    $('#nombreCapturista').focus();
                  }
                },300); }
            });
      }
    }else{
      bootbox.alert({
              message: "Se tiene que llenar todos los campos de usuario y password primero por favor.",
              title: "Campos vacios",
              callback: function() {setTimeout(function(){
                if( $("#user").val() == "" && $("#password").val() != "" ){
                  $('#user').focus();
                }else if ( $("#password").val() == "" && $("#user").val() != "" ) {
                  $('#password').focus();
                }else if( $("#user").val() == "" && $("#password").val() == "" ){
                  $('#user').focus();
                }
              },300); }
          });
    }
  });
});
/**
* Evento del click del boton para editar a los usuarios capturistas
*
*
**/
function getId(id, dinamico){
  $("#"+dinamico).removeClass('hidden');
}
function actualizarData(id,id_master, nombre, apellido,usuario,correo,password,spanNombre,spanApe,spanUser,spanMail,dinamico){
  if( $("#"+password).val() != "" ){
    //envio para que se actualice
    $.post('/capturista/actualizainfoCapturista/',{
      id: id,
      id_master: id_master,
      nombre: $("#"+nombre).val(),
      apellido: $("#"+apellido).val(),
      usuario: $("#"+usuario).val(),
      correo: $("#"+correo).val(),
      password: $("#"+password).val()
    },function(datas){
      $.each(JSON.parse(datas), function(i, item){
        $("#"+spanNombre).text(item.nombre);
        $('#'+spanApe).text(item.apellido);
        console.log(spanApe);
        $("#"+spanUser).text(item.usuario);
        $("#"+spanMail).text(item.correo);
        $("#"+dinamico).addClass('hidden');
        $("#"+password).val('');
      });
    });
  }else {
    bootbox.alert({
            message: "EL campo password no puede estar vacio favor de llenarlo.",
            title: "Campo vacio",
            callback: function() {setTimeout(function(){
              if( $("#user").val() == "" && $("#password").val() != "" ){
                $('#user').focus();
              }else if ( $("#password").val() == "" && $("#user").val() != "" ) {
                $('#password').focus();
              }else if( $("#user").val() == "" && $("#password").val() == "" ){
                $('#user').focus();
              }
            },300); }
        });
  }
}
//function para borrar
function deleteCapturista(id_capturista, id_master ){
  bootbox.confirm({
    message: "<span class='glyphicon glyphicon-question-sign'>Usted esta apunto de eliminar un capturista ¿ esta seguro ?</span>",
    title: "¿Eliminar capturista?",
    callback: function(result) {
      if (result){
        $.post('/capturista/deleteCapturista/',{
          idCapturista: id_capturista,
          idMaster: id_master
        },function(data){
          if(data){
            location.reload();
          }
        }).fail(function(e){
          bootbox.alert({
                  message: "EL campo password no puede estar vacio favor de llenarlo.",
                  title: "Campo vacio",
                  callback: function() {setTimeout(function(){JSON.stringify(e)},300); }
              });
        });
      }
    }
  });
}

$('#registroTelefonos #tipoTelefono').change(function(){
  var tipo =  $(this).prop('value');
  var numero = $('#numTelefono').val();
  switch(tipo) {
    case "casa":
        $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-12 col-sm-12"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()" value="'+numero+'"/></div>');
        break;
    case "celular":
        $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-12 col-sm-12"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()" value="'+numero+'"/></div>');
        break;
    case "oficina":
        $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-8 col-sm-8"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()" value="'+numero+'"/></div><div class="form-group col-md-4 col-sm-4"><input type="text" id="extTelefono" class="form-control solo-numero" placeholder="Ext:" maxlength="4" onpaste="soloNumeros()"/></div>');
        break;
    case "localizador":
        $('#registroTelefonos #contTelefono').html('<div class="form-group col-md-6 col-sm-6"><input type="text" id="numTelefono" class="form-control solo-numero" placeholder="Número:" maxlength="10" onpaste="soloNumeros()" value="'+numero+'"/></div><div class="form-group col-md-6 col-sm-6"><input type="text" id="locTelefono" class="form-control solo-numero" placeholder="Localizador:" maxlength="8" onpaste="soloNumeros()"/></div>');
        break;
  }
});

function eliminarMedico(medico_id){
  bootbox.confirm({
      message: "¿Estas seguro de querer borrar al médico?",
      title: "Mensaje de Intermed",
      callback: function(result) {
          if (result){
            $.ajax( {
              url: '/Capturista/eliminarMedico',
              type: "POST",
              dataType: 'JSON',
              data: {'medico_id':medico_id},
              async: true,
              success: function (result) {
                if (result.success){
                  $('tr.muestra#'+medico_id).remove();
                } else {
                  bootbox.alert({
                      message: "Ocurrio un error al momento de eliminar al médico.",
                      title: "No se elimino el médico"
                  });
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

function MarcarRevisado(medico_id){
    bootbox.confirm({
      message: "¿Marcar como revisado?",
      title: "Mensaje de Intermed",
      callback: function(result) {
          if (result){
            $.ajax( {
              url: '/Capturista/marcarRevisado',
              type: "POST",
              dataType: 'JSON',
              data: {'medico_id':medico_id},
              async: true,
              success: function (result) {
                if (result.success){
                  setTimeout(function(){
                    $('tr.muestra#'+medico_id).remove();
                  },500);
                } else {
                  bootbox.alert({
                      message: "Ocurrio un error al momento de marcar como revisado.",
                      title: "No se guardo el cambio"
                  });
                  $('tr.muestra#'+medico_id).find(':checkbox').prop('checked',false);
                }
              },
              error : function (err){
                console.log( "Error: AJax dead :" + JSON.stringify(err) );
              }
            });
          } else {
            $('tr.muestra#'+medico_id).find(':checkbox').prop('checked',false);
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



function generarMuestraMedicos_correo(){
  $('.loader-container').removeClass('hidden');
  $('#muestraMedCorreo').html('');
  $.ajax( {
    url: '/Capturista/generarMuestraMedicosCorreo',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success && result.muestra && result.muestra.length>0){
        result.muestra.forEach(function(val){
          if (val.aut == 0){
            var nombre = val.medico.nombre + ' ' + val.medico.apellidop;
            if (val.medico.apellidom){
              nombre +=  ' ' + val.medico.apellidom;
            }

            var dir = '';
            val.direcciones.forEach(function(direccion){
              var numInt = '';
              if (direccion.numero.split('-').length>1){
                numInt = ' ' + direccion.numero.split('-')[1];
              }
              var cp = '';
              if (direccion.cp && direccion.cp.length>0){
                cp = ', C.P. ' + direccion.cp;
              }
              var estado = '';
              if (direccion.municipio && direccion.municipio.length>0){
                estado = ', '+ direccion.municipio + ', ' + direccion.estado;
              }
              var localidad = '';
              if (direccion.localidad && direccion.localidad.length>0){
                localidad = direccion.tipolocalidad + ' ' + direccion.localidad;
              } else {
                localidad = direccion.otralocalidad;
              }
              dir = direccion.calle + ' #' + direccion.numero.split('-')[0] + numInt +' ' + localidad + estado+ cp ;
            });

            var codigo = val.codigo;


            $('#muestraMedCorreo').append('<tr class="muestra" id="'+ val.muestra_id+'"><td class="text-capitalize">'+nombre+'</td><td class="text-center">'+dir+'</td><td class="text-center">'+codigo+'</td></tr>');
            $('#muestraMedCorreo').find('tr').first().addClass('active');
            $('#muestraMedCorreo .active').find(':input').filter(':visible:first').focus();
          }
        });
      }
      $('.loader-container').addClass('hidden');
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}

function ExportarAExcell(tablaId){
  $("#"+tablaId).table2excel({
    filename: "NewChannel_ListaMedicos"
  });
}

function generarMuestraMedicosPospuestos(){
  $('.loader-container').removeClass('hidden');
  $('#muestraMedPos').html('');
  $.ajax( {
    url: '/Capturista/generarMuestraMedicos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success && result.muestra && result.muestra.length>0){
        result.muestra.forEach(function(val){
          if (val.aut == 0 && val.posponer && val.posponer != ""){
            var nombre = val.medico.nombre + ' ' + val.medico.apellidop;
            if (val.medico.apellidom){
              nombre +=  ' ' + val.medico.apellidom;
          modificarMedico  }
            var correo = '';
            if (val.medico.correo){
              correo = val.medico.correo;
            }
            var telefonos = '<table width="100%">';
            var checked = ' checked';
            val.telefonos.forEach(function(telefono){
              var icon = '<span class="glyphicon glyphicon-earphone" style="font-size:80%"></span>'
              if (telefono.tipo == "celular"){
                icon = '<span class="glyphicon glyphicon-phone" style="font-size:80%"></span>';
              } else if (telefono.tipo == "casa"){
                icon = '<span class="glyphicon glyphicon-home" style="font-size:80%"></span>';
              } else if (telefono.tipo == "localizador"){
                icon = '<span class="glyphicon glyphicon-screenshot" style="font-size:80%"></span>';
              }
              telefonos += '<tr id="'+ telefono.id +'" class="telefono"><td width="120" class="text-center"><div class="media"><div class="media-left">'+ icon +'</div><div class="media-body">' + telefono.numero +'</div><div class="media-right"><input type="radio" name="telefono_'+ val.muestra_id +'" value="'+ telefono.id +'" '+checked+'></div></div></td></tr>';
              checked = '';
            });
            telefonos+='</table>'

            var guardar = '<button class="btn btn-success" onclick="guardarMuestra('+ val.muestra_id+',this)"><span class="glyphicon glyphicon-saved"></button>'

            var posponer = '<div class="input-group" style="width: 200px;"><input type="text" class="form-control posponer"><span class="input-group-btn"><button class="btn btn-danger" type="button" onclick="posponerMuestra('+ val.muestra_id+')"><span class="glyphicon glyphicon-folder-close" ></span></button></span></div>';

            var confirmCorreo = '<input type="text" value="" class="confirmCorreo">';
            var autorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="true" checked>';
            var noautorizo = '<input type="radio" name="autorizo_'+val.muestra_id+'" value="false">';
            $('#muestraMedPos').append('<tr class="muestra" id="'+ val.muestra_id+'"><td>'+val.posponer+'</td><td>'+nombre+'</td><td class="text-center">'+telefonos+'</td><td class="text-center email">'+correo+'</td><td class="text-center">'+confirmCorreo+'</td><td class="autorizo text-center">'+autorizo+'</td><td class="autorizo text-center">'+noautorizo+'</td><td class="text-center">'+guardar+'</td><td>'+ posponer +'</td></tr>');
            $('#muestraMedPos').find('tr').first().addClass('active');
            $('#muestraMedPos .active').find(':input').filter(':visible:first').focus();
          }
        });
      }
      $('.loader-container').addClass('hidden');
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}

function actualizarStatus(){

  $.ajax( {
    url: '/Capturista/statusLlamadas',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.seleccionados>500){
        result.seleccionados = 500;
      }
      result.restantes = result.seleccionados - result.autorizados;
      $('#status .seleccionados').text(result.seleccionados);
      $('#status .autorizados').text(result.autorizados);
      $('#status .rechazados').text(result.rechazados);
      $('#status .restantes').text(result.restantes);
    },
    error: function (err){
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  });
}

function cargar_invitacionDirecta(){
  $.ajax( {
    url: '/Admin/enviadosCanalDirectos',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      var inv = '';
      result.forEach(function(res){
        inv += '<tr><td class="text-center" >'+res.nombre+'</td><td class="text-center" >'+res.correo+'</td><td class="text-center" >'+res.fecha+'</td></tr>';
      });
      $('#InvDirecta').html(inv);
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}

function enviarInvitacionDirecta(){
  var nombre = $('#nombreInvitacion').val();
  var email = $('#correoInvitacion').val();
  $.ajax( {
    url: '/Admin/enviarEncuestaDirecta',
    type: "POST",
    data: {nombre: nombre, correo: email},
    dataType: 'JSON',
    async: true,
    success: function (result) {
      if (result.success){
        $('#InvDirecta').append('<tr><td class="text-center" >'+result.result.nombre+'</td><td class="text-center" >'+result.result.correo+'</td><td class="text-center" >'+result.result.fecha+'</td></tr>');
        $('#enviarForm')[0].reset();
        //Bootbox encuesta enviada, borrar formulario y agregar a lista result.result
      } else {
        //Bootbox error
        bootbox.alert({
            message: "No se pudo enviar el mensaje.",
            title: "Mensaje de Intermed",
          });
      }
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
  return false;
}

function cargar_invitacionRecomendada(){
  $.ajax( {
    url: '/Admin/enviadosCanalRecomendados',
    type: "POST",
    dataType: 'JSON',
    async: true,
    success: function (result) {
      var inv = '';
      result.forEach(function(res){
        inv += '<tr><td class="text-center" >'+res.nombre+'</td><td class="text-center" >'+res.correo+'</td><td class="text-center" >'+res.justificacion+'</td><td class="text-center" >'+res.fecha+'</td></tr>';
      });
      $('#InvDirecta').html(inv);
    },
    error: function (err) {
      console.log( "Error: AJax dead :" + JSON.stringify(err) );
    }
  } );
}
