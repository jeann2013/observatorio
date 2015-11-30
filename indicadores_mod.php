<?php

if (!isset($_SESSION)){
  session_start();
}

include ("db.php");
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);

if(isset($_POST)) {
  $var_id_categorias_indicadores = $_POST['categorias_indicadores']; 
 
}else{

  $var_id_categorias_indicadores = 0; 
  
}

$var_id_indic = $_GET['id'];

$sSql="select * from indicadores i where id_indic =  $var_id_indic ";
$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
while ($row_rs = $rs->fetch_assoc()){
      
      $var_grupo=$row_rs['grupo'];
      $var_traduccion_grupo = buscar_traduccion($var_grupo,$var_id_indic);

      $var_descripcion_indicador=$row_rs['descripcion_indicador'];
      $var_traduccion_indic = buscar_traduccion($var_descripcion_indicador,$var_id_indic);
      
      $var_tipo=$row_rs['tipo'];
      $var_traduccion_tipo = buscar_traduccion($var_tipo,$var_id_indic);

      $var_unidades=$row_rs['unidades'];
      $var_traduccion_unidades = buscar_traduccion($var_unidades,$var_id_indic);

      $var_notas=$row_rs['notas'];
      $var_traduccion_notas = buscar_traduccion($var_notas,$var_id_indic);

      $tipo_agregacion = $row_rs['tipo_agregacion'];
      $clase = $row_rs['clase'];
      $regional = $row_rs['regional'];
      $decimales = $row_rs['decimales'];
}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Indicadores</title>
</head>
<body>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
<form action="indicadores.php" method="post" name="form1">
<table class="table" border="0">
  <tr class="active">
    <td colspan="2">
    <a title="Regresar" href="indicadores_view.php" class="btn btn-primary" role="button"><?php echo "Regresar"; ?></a>
    </td>
  </tr>
   
</table>

<div class="table-responsive">
<table class="table table-striped" border="0">
  <tr class="">
    <td colspan="2">
    <div align="center">INGRESAR INDICADOR</div>
    </td>
  </tr>
  <tr class="">
    <td>Categoria:</td>
    <td><?php echo select13("id", "ES", $clase, "select id,ES from categorias_indicadores order by id", "categorias_indicadores", 1,3,0,$conn,""); ?></td>
  </tr>
  <tr class="">
    <td>Indicador:</td>
    <td>
    <input type="text" name="nombre_es" id="nombre_es" class="form-control" value="<?php echo $var_traduccion_indic['ES']; ?>" placeholder="ES" required>
    <input type="text" name="nombre_en" id="nombre_en" class="form-control" value="<?php echo $var_traduccion_indic['EN']; ?>" placeholder="EN" required>
    <input type="text" name="nombre_pt" id="nombre_pt" class="form-control" value="<?php echo $var_traduccion_indic['PT']; ?>" placeholder="PT" required>
    </td>
  </tr>
  
  <tr>
    <td>Grupo:</td>
   <td>
    <input type="text" name="grupo_es" id="grupo_es" class="form-control" value="<?php echo $var_traduccion_grupo['ES']; ?>" placeholder="ES" >
    <input type="text" name="grupo_en" id="grupo_en" class="form-control" value="<?php echo $var_traduccion_grupo['EN']; ?>" placeholder="EN" >
    <input type="text" name="grupo_pt" id="grupo_pt" class="form-control" value="<?php echo $var_traduccion_grupo['PT']; ?>" placeholder="PT" >
    </td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td>
    <input type="text" name="tipo_es" id="tipo_es" class="form-control" value="<?php echo $var_traduccion_tipo['ES']; ?>" placeholder="ES" >
    <input type="text" name="tipo_en" id="tipo_en" class="form-control" value="<?php echo $var_traduccion_tipo['EN']; ?>" placeholder="EN" >
    <input type="text" name="tipo_pt" id="tipo_pt" class="form-control"  value="<?php echo $var_traduccion_tipo['PT']; ?>" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Unidades:</td>
    <td>
    <input type="text" name="unidades_es" id="unidades_es" class="form-control" value="<?php echo $var_traduccion_unidades['ES']; ?>" placeholder="ES" >
    <input type="text" name="unidades_en" id="unidades_en" class="form-control" value="<?php echo $var_traduccion_unidades['EN']; ?>" placeholder="EN" >
    <input type="text" name="unidades_pt" id="unidades_pt" class="form-control" value="<?php echo $var_traduccion_unidades['PT']; ?>" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Notas:</td>
    <td>
    <input type="text" name="notas_es" id="notas_es" class="form-control" value="<?php echo $var_traduccion_notas['ES']; ?>" placeholder="ES" >
    <input type="text" name="notas_en" id="notas_en" class="form-control" value="<?php echo $var_traduccion_notas['EN']; ?>" placeholder="EN" >
    <input type="text" name="notas_pt" id="notas_pt" class="form-control" value="<?php echo $var_traduccion_notas['PT']; ?>" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Tipo de Agregacion</td>
    <td><input type="text" name="tipo_agregacion" id="tipo_agregacion" class="form-control" value="<?php echo $tipo_agregacion; ?>" placeholder="Tipo de Agregacion" ></td>
  </tr>
  <tr>
  <td>Regional</td>
  <td>
    <select name="regional" id="regional">
      <option <?php if($regional==1){ echo " selected "; } ?> value="1">Si</option>
      <option <?php if($regional==0){ echo " selected "; } ?> value="0">No</option>
    </select>
  </td>
  </tr>
   <tr>
  <td>Decimales</td>
  <td>
    <select name="decimales" id="decimales">
      <option <?php if($decimales==1){ echo " selected "; } ?> value="1">Si</option>
      <option <?php if($decimales==0){ echo " selected "; } ?> value="0">No</option>
    </select>
  </td>
  </tr>
  
  
  <tr>
    <td colspan="2">
    <div align="center">
      <input title='Guardar' class="btn btn-primary" type="submit" value="Guardar">
      <input type="hidden" value="2" name="accion" id="accion" >
      <input type="hidden" value="<?php echo $var_id_indic; ?>" name="codigo" id="codigo" >
    </div>
    </td>
  </tr>
  
</table>    
</div>
</form>
</body>
</body>
</html>
<script>

function buscar_indicadores(id_cate){

      if(id_cate!="" && id_cate!=undefined){

      $.ajax({
              url:'funciones_jq.php',
              type:'POST',
              global:false,
              data:{accion:'buscar_indicadores_jq',id_cate:id_cate},
              dataType:'json',
              error:function(jqXHR,text_status,strError){
              alert('No hay Coneccion');
              return false;
              console.log(jqXHR.status, strError);},
              timeout:60000,
              success:function(data){
                    if(data['0']>0){
                      conta=1;
                      $('#id_indic').empty();

                      for(var i in data){
                      valor_id = data['id_indic'+conta];
                      valor_indi = data['ES'+conta];

                      if(valor_id!=undefined){
                      $('#id_indic').append('<option  value='+valor_id+'>'+valor_indi+'</option>');
                      }
                      conta=conta+1;
                      }
                    }
              }
            });
        } 
  }


  function buscar_entidad(id_pais){


      $.ajax({
              url:'funciones_jq.php',
              type:'POST',
              global:false,
              data:{accion:'buscar_entidades_jq',id_pais:id_pais},
              dataType:'json',
              error:function(jqXHR,text_status,strError){
              alert('No hay Coneccion');
              return false;
              console.log(jqXHR.status, strError);},
              timeout:60000,
              success:function(data){
                if(data['0']>0){
          
        
                conta=1;

               $('#id_ent').empty();

                 for(var i in data){
                      valor_id = data['id'+conta];
                      valor_entidad = data['entidad'+conta];

                      if(valor_id!=undefined){
                        $('#id_ent').append('<option  value='+valor_id+'>'+valor_entidad+'</option>');
                      }

                      conta=conta+1;

                  }

    }
  }
   });
  }
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" ></script>


