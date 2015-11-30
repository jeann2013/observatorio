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

$id = $_GET['id'];

$sSql="select * from valores where id = $id";
$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
while ($row_rs = $rs->fetch_assoc()){
  $id_indic = $row_rs['id_indic'];
  $id_pais = $row_rs['id_pais'];
  $ano = $row_rs['ano'];
  $id_ent = $row_rs['id_ent'];
  $valor = $row_rs['valor'];
  $id_comentario = $row_rs['id_comentario'];
  $info_sistematica = $row_rs['info_sistematica'];
  $detalle_localizacion = $row_rs['detalle_localizacion'];
}

$comentario = buscar_comentario($id_comentario,$id_indic);
$id_categoria_general = buscar_categoria($id_indic);
$id_categoria = $id_categoria_general['clase']

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Valores</title>
</head>
<body>
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
<form action="valores.php" method="post" name="form1">
<table class="table" border="0">
  <tr class="active">
    <td colspan="2">
    <a title="Regresar" href="valores_view.php" class="btn btn-primary" role="button"><?php echo "Regresar"; ?></a>
    </td>
  </tr>
   
</table>

<div class="table-responsive">
<table class="table table-striped" border="0">
  <tr class="">
    <td colspan="2">
    <div align="center">MODIFICAR VALORES</div>
    </td>
  </tr>
  <tr class="">
    <td>Categoria:</td>
    <td><?php echo select13("id", "ES", "$id_categoria", "select id,ES from categorias_indicadores order by id", "categorias_indicadores", 1,3,0,$conn,"buscar_indicadores(this.value)"); ?></td>
  </tr>
  <tr class="">
    <td>Indicador:</td>
    <td>
    <?php echo select13("id_indic", "ES", "$id_indic", "select t.id_indic,t.ES FROM observatorio.indicadores i,observatorio.indicadores_traduccion t where i.clase = '$id_categoria' and i.descripcion_indicador = t.codificacion", "id_indic", 1,3,0,$conn,""); ?>
   <!--  <select name="id_indic" id="id_indic">
       
     </select> -->
    </td>
  </tr>
  <tr>
    <td>Pais:</td>
    <td><?php  echo select13("id", "nombre", "$id_pais", "select id,nombre from paises_mesoamericanos order by id", "id_pais", 1,1,0,$conn,"buscar_entidad(this.value)"); ?></td>
  </tr>
  <tr>
    <td>Año:</td>
    <td><input type="text" id="ano" name="ano" class="form-control" placeholder="Año" value="<?php echo $ano; ?>" required></td>
  </tr>
    <td>Entidad:</td>
     <td>
     <?php  
     echo select13("id_ent", "nombre", "$id_ent", "select id_ent,entidad as nombre from entidad where id_pais = '$id_pais' order by id_ent", "id_ent", 1,1,0,$conn,"",""); 
     ?>
     <!-- <select name="id_ent" id="id_ent">
       
     </select> -->
     </td>
  </tr>
  <!-- <tr>
    <td>Fuente:</td>
    <td><input type="text" id="fuenta" readonly="true" class="form-control" placeholder="Fuente" required></td>
  </tr> -->
  <tr>
    <td>Valor</td>
    <td><input type="text" name="valor" id="valor" class="form-control" placeholder="Valor" value="<?php echo $valor; ?>" required></td>
  </tr>
  
  <tr>
    <td>Comentarios:</td>
    <td>
    <textarea class="form-control" rows="3" id="comentario_es" placeholder="Comentario ES"   name="comentario_es"><?php echo $comentario['ES']; ?></textarea>
    <textarea class="form-control" rows="3" id="comentario_en" placeholder="Comentario EN"   name="comentario_en"><?php echo $comentario['EN']; ?></textarea>
    <textarea class="form-control" rows="3" id="comentario_pt" placeholder="Comentario PT"   name="comentario_pt"><?php echo $comentario['PT']; ?></textarea>
    </td>
  </tr>
  <tr>
    <td>Info. Sistematica:</td>
    <td>
      <select name="info_sistematica" id="info_sistematica">
        <option <?php if($info_sistematica=="SI") echo " selected "; ?> value="SI">SI</option>
        <option <?php if($info_sistematica=="NO") echo " selected "; ?> value="NO">NO</option>
      </select>
    </td>
  </tr>
  <tr>
    <td>Detalle Localización</td>
    <td><textarea class="form-control" rows="3" id="detalle" placeholder="Detalle" required name="detalle"><?php echo $detalle_localizacion; ?></textarea></td>
  </tr>
  <tr>
    <td colspan="2">
    <div align="center">
      <input title='Guardar' class="btn btn-primary" type="submit" value="Guardar">
      <input type="hidden" value="2" name="accion" id="accion" >
      <input type="hidden" value="<?php echo $id_comentario; ?>" name="id_comentario_actual" id="id_comentario_actual" >
      <input type="hidden" value="<?php echo $id; ?>" name="id" id="id" >

       
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


