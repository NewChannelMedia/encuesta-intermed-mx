<?php
//Si no tiene permisos de rol admin, redirect a pagina principal
if (!(isset($_SESSION['rol']) && $_SESSION['rol'] == "admin")){
  redirect(base_url().'admin');
}
?>
<div class="container-fluid resultados-container flama-normal">
<div class="row">
<div class="col-lg-2 col-md-6">
<div class="column" id="columna_preguntas">
<!--IMPRIMIR EL TAB NAV-->
<?php  $totalChar = 0; $primero = true;$clase="active";?>
<?php
foreach ($resultado as $categoria){
  foreach ($categoria as $preguntas){
    if (!is_array($preguntas)){
      } else {
        $int = 0;
        foreach ($preguntas as $pregunta){
          if (stripos($pregunta['pregunta'],'ordene') === false ){
            $data = array(); $complemento=false;

            $divId = 'pregunta_' . $pregunta['id'];
            echo '<div class="portlet panel panel-default" id="' . $divId .'_div"><div class="portlet-header panel-heading">';
            echo '<b >' .$pregunta['pregunta'] . '</b>';
            echo '</div><div class="portlet-content panel-body">';
            echo '<ul style="list-style:none;">';

            foreach ($pregunta['respuestas'] as $respuesta){
                $existeComplemento = false;
                if (is_array($respuesta['respuesta'])){
                  foreach ($respuesta['respuesta'] as $resp => $total) {
                      if (!is_array($total)){
                        if (!empty($resp)){
                          $data[] = array('label' => $resp, 'value' => $total);
                        }
                      } else {
                        if (!empty($resp)){
                          if (array_key_exists('comp',$total) &&  count($total['comp'])>0){
                            $existeComplemento = true;
                            $complemento = [];
                            foreach ($total['comp'] as $comp => $compt) {
                              array_push($complemento, array('total' => $compt, 'comp' => $comp));
                            }
                            $data[] = array('label' => $resp, 'value' => $total['total'], 'complemento' => $complemento);
                            $complemento = true;
                          } else {
                            if (!array_key_exists('total',$total)){
                              $total['total'] =0;
                            }
                            $data[] = array('label' => $resp, 'value' => $total['total']);
                          }
                        }
                    }
                  }
                } else {
                  if (!empty($respuesta['respuesta'])){
                    if (array_key_exists('complemento', $respuesta)){
                      $existeComplemento = true;
                      $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total'], 'complemento' => $respuesta['complemento']);
                    } else {
                        $data[] = array('label' => $respuesta['respuesta'], 'value' => $respuesta['total']);
                    }
                  }
                }
              }

              foreach ($data as $key => $value){
                $compl = array();
                $compl['pregunta'] = $pregunta['pregunta'];
                $compl['pregunta_id'] = $divId;
                $compl['id'] = $divId.'_'. $key;
                $compl['opcion'] = $key;
                $compl['respuesta'] = $value['label'];
                if (array_key_exists('complemento',$value)){
                  $compl['complemento'] = $value['complemento'];
                }
                echo '<li><label style="font-weight:normal;margin-top:5px;"><input type="checkbox" class="'.$divId.'" name="'.$divId.'" id="'.$divId.'_'. $key .'" value="' . $value['label'] . '" onchange="modificarConsulta('. htmlspecialchars(print_r(json_encode($compl),1)) .')" label = "'. $pregunta['pregunta'] .'"> ' . $value['label'] . '</label></li>';
              }
              echo '</ul>';
              echo '</div>';
              echo '</div>';
            } else {
              ++$totalChar;
            }
          }
        }
      }
    }
?>
</div>
</div>

<div class="col-lg-3 col-md-6">
  <div class="column" id="columna_preguntas_filtradas">

  </div>
</div>

<div class="col-lg-7 col-md-12">
<div class="panel panel-default">
<div class="panel-heading">
  Resultado
  <!-- Single button -->
  <div class="btn-group pull-right">
    <button type="button" class="btn btn-default dropdown-toggle btn-xs" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <span class="caret"></span>
    </button>
    <ul class="dropdown-menu">
      <input type="hidden" value="" id="tipoGrafica">
      <li><label class="col-md-12"><input type="radio" name="radio" checked onclick="modificarConsulta('','Bar')"> Barras</label></li>
      <li><label class="col-md-12"><input type="radio" name="radio" onclick="modificarConsulta('','Radar')"> Radio</label></li>
      <li><label class="col-md-12"><input type="radio" name="radio" onclick="modificarConsulta('','Polar')"> Polar</label></li>
      <li><label class="col-md-12"><input type="radio" name="radio" onclick="modificarConsulta('','Line')" > Linea</label></li>
    </ul>
  </div>
</div>
<div class="panel-body" id="crossreference">
</div>

</div>

</div>
