<?php
if (!isset($_SESSION)){
  session_start();
}

include ("db.php");
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);

if(isset($_POST)) {
  $var_id_categorias_indicadores = $_POST['categorias_indicadores']; 
  $var_ano = $_POST['ano'];
  $var_id_pais = $_POST['id_pais'];
}else{

  $var_id_categorias_indicadores = 0; 
  $var_ano = 0;
  $var_id_pais = 0;
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
    <td><?php echo select13("id", "ES", $var_id_categorias_indicadores, "select id,ES from categorias_indicadores order by id", "categorias_indicadores", 1,3,0,$conn,""); ?></td>
  </tr>
  <tr class="">
    <td>Indicador:</td>
    <td>
    <input type="text" name="nombre_es" id="nombre_es" class="form-control" placeholder="ES" required>
    <input type="text" name="nombre_en" id="nombre_en" class="form-control" placeholder="EN" required>
    <input type="text" name="nombre_pt" id="nombre_pt" class="form-control" placeholder="PT" required>
    </td>
  </tr>
  
  <tr>
    <td>Grupo:</td>
    <td>
    <input type="text" name="grupo_es" id="grupo_es" class="form-control" placeholder="ES" >
    <input type="text" name="grupo_en" id="grupo_en" class="form-control" placeholder="EN" >
    <input type="text" name="grupo_pt" id="grupo_pt" class="form-control" placeholder="PT" >
    </td>
  </tr>
  <tr>
    <td>Tipo:</td>
    <td>
    <input type="text" name="tipo_es" id="tipo_es" class="form-control" placeholder="ES" >
    <input type="text" name="tipo_en" id="tipo_en" class="form-control" placeholder="EN" >
    <input type="text" name="tipo_pt" id="tipo_pt" class="form-control" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Unidades:</td>
    <td>
    <input type="text" name="unidades_es" id="unidades_es" class="form-control" placeholder="ES" >
    <input type="text" name="unidades_en" id="unidades_en" class="form-control" placeholder="EN" >
    <input type="text" name="unidades_pt" id="unidades_pt" class="form-control" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Notas:</td>
    <td>
    <input type="text" name="notas_es" id="notas_es" class="form-control" placeholder="ES" >
    <input type="text" name="notas_en" id="notas_en" class="form-control" placeholder="EN" >
    <input type="text" name="notas_pt" id="notas_pt" class="form-control" placeholder="PT" >
    </td>
  </tr>
   <tr>
    <td>Tipo de Agregacion</td>
    <td><input type="text" name="tipo_agregacion" id="tipo_agregacion" class="form-control" placeholder="Tipo de Agregacion" ></td>
  </tr>
  <tr>
  <td>Regional</td>
  <td>
    <select name="regional" id="regional">
      <option value="1">Si</option>
      <option value="0">No</option>
    </select>
  </td>
  </tr>
   <tr>
  <td>Decimales</td>
  <td>
    <select name="decimales" id="decimales">
      <option value="1">Si</option>
      <option value="0">No</option>
    </select>
  </td>
  </tr>
  
  
  <tr>
    <td colspan="2">
    <div align="center">
      <input title='Guardar' class="btn btn-primary" type="submit" value="Guardar">
      <input type="hidden" value="1" name="accion" id="accion" >
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


