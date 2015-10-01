<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title><?php echo $title ?> </title>

    <link href="<?= public_url('css/bootstrap.min.css')?>">
    <link href="<?= public_url('css/fonts.css')?>">
    <link href="<?= public_url('css/encuesta.css')?>">
    <script src="http://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script>
        $(document).ready(function(){
            $("#envioEmail").click(function(){
              $(this).val()
              $.ajax({
                url:'/encuesta-intermed-mx/codigo/dataPostCorreo',
                type:"POST",
                dataType: 'JSON',
                async:true,
                success: function(){
                  $("#doctor").load('/encuesta-intermed-mx/porValidar/index')
                },
                error: function(){
                  console.log("Error: AJax dead :(");
                }
              });
            });
        });
    </script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">
  <!-- Aqui empieza el body de la pagina -->
