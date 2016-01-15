function envioMasivos(){
  bootbox.dialog({
    onEscape: function(){bootbox.hideAll();},
    closeButton:true,
    message:
      '<section id="mails">'+
        '<div class="container-fluid">'+
          '<div class="row">'+
            '<div class="col-md-12">'+
              '<p>'+
                'Esta por enviar 500 correos a diferentes medicos'+
              '</p>'+
              '<span class="hidden" id="todoArray"></span>'+
            '</div>'+
          '</div>'+
          '<div class="row">'+
            '<div class="col-md-12 form-group">'+
              '<textarea rows="8" id="bodyMensaje" class="form-control"></textarea>'+
            '</div>'+
          '</div>'+
          '<div class="row">'+
            '<div class="col-md-4 col-md-offset-4">'+
                '<button class="btn btn-warning btn-block" onclick="bootbox.hideAll();">'+
                      '<span class="glyphicon glyphicon-remove-sign"></span>&nbsp;Cancelar'+
                '</button>'+
            '</div>'+
            '<div class="col-md-4">'+
                '<button class="btn btn-danger btn-block" id="sendToAll" onclick="sendMails(\'#todoArray\');">'+
                    '<span class="glyphicon glyphicon-screenshot"></span>&nbsp;Enviar a todos'+
                '</button>'+
            '</div>'+
          '</div>'+
        '</div>'+
      '</section>'
  });
}
