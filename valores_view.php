<?php

include ("db.php");
include ('cabecera.php');
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

$var_accion = $_SESSION['action'];

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Valores</title>
</head>
<body onload="validar_acciones(<?php echo $var_accion; ?>)">
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css" >
<script>
  function eliminar_registro(id){

    var x=window.confirm('DESEA ELIMINAR ESTE REGISTRO?'); 
    if(x)
    {
         $.ajax({
              url:'funciones_jq.php',
              type:'POST',
              global:false,
              data:{accion:'eliminar_registro_valores_jq',id:id},
              dataType:'json',
              error:function(jqXHR,text_status,strError){
              alert('No hay Coneccion');
              return false;
              console.log(jqXHR.status, strError);},
              timeout:60000,
              success:function(data){
                    if(data['0']==1){
                      alert('REGISTRO FUE ELIMINADO!');
                      document.forms["form1"].submit();
                      return false;
                    }else{return false;}
              }
            });
    }

  }
</script>
<form action="valores_view.php" method="post" name="form1">
        <table class="table" border="0">
          <tr class="active">
            <td colspan="2">
            <a title="Regresar" href="index.php" class="btn btn-primary" role="button"><?php echo "Regresar"; ?></a>
            
            </td>
          </tr>
         
          <tr>
          <td colspan="2">
          <div align="center">Categorias: <?php
              echo select13("id", "ES", $var_id_categorias_indicadores, "select id,ES from categorias_indicadores order by id", "categorias_indicadores", 3,3,0,$conn,"","");
            ?>
            </div>
            
          </td>
          </tr>
        
          <tr>
          <td >
           <div align="center">
            A&ntilde;o: <?php
              echo select13("ano", "ano", $var_ano, "select distinct(ano) as ano from valores where id_pais in (select id from paises_mesoamericanos) order by ano", "ano", 3,1,0,$conn,"","");
            ?>
            </div>
          </td>
          
          </tr>
          <tr>
          <td >
           <div align="center">
            Pais:<?php
              echo select13("id", "nombre", $var_id_pais, "select id,nombre from paises_mesoamericanos order by id", "id_pais", 3,1,0,$conn,"","");
            ?>
            </div>
          </td>
          
          </tr>
          <tr>
          
            <td colspan="2">
             <div align="center">
                    <input class="btn btn-primary" type="submit" value="Buscar">
               </div>
            </td>
           
          </tr>
           <tr>
            <td colspan="2">
              <div align="center">
              <a title='Ingresar' href='valores_add.php' class='btn btn-default' ><i class='glyphicon glyphicon-circle-arrow-down'></i> Ingresar</a>
              </div>           
            
            </td>
          </tr>
        </table>

<div class="table-responsive">
<table class="table table-striped" border="0">
  <tr class="info">
    <th>Id</td>
    <th>Id Indicador</td>
    <th>id Pais</td>
    <th>Año</td>
    <th>Id Entidad</td>
    <th>Valor</td>
    <th>Fuente</td>
    <th>Comentario</td>
    <th>Info Sistematica</td>
    <th>Detalle Localización</td>
    <th>Modificar</td>
    <th>Eliminar</td>
  </tr>
  <?php

    $sSql="select * from valores v where v.id_pais in (select id from paises_mesoamericanos) ";

    if($var_id_categorias_indicadores<>"" && $var_id_categorias_indicadores<>"0"){
      $sSql.=" and v.id_indic in ( select id_indic from indicadores where clase = '$var_id_categorias_indicadores') ";
    }

    if($var_ano<>"" && $var_ano<>"0"){
      $sSql.=" and v.ano = $var_ano ";
    }

    if($var_id_pais<>"" && $var_id_pais<>"0"){
      $sSql.=" and v.id_pais = '$var_id_pais' ";
    }

    if($var_id_categorias_indicadores==0 && $var_ano==0 && $var_id_pais==0){
      $sSql.=" limit 100 ";
    }

    $rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
    while ($row_rs = $rs->fetch_assoc()){
      $var_id=$row_rs['id'];
      $var_id_indic=$row_rs['id_indic'];
      $var_id_pais=$row_rs['id_pais'];
      $var_id_pais = nombre_pais($var_id_pais);
      $var_ano=$row_rs['ano'];
      $var_id_ent=$row_rs['id_ent'];
      $var_valor=$row_rs['valor'];
      $var_fuente=utf8_encode($row_rs['fuente']);
      $var_comentario = buscar_comentario($row_rs['id_comentario'],$row_rs['id_indic']);
      $var_info_sistematica = $row_rs['info_sistematica'];
      $var_detalle_localizacion=$row_rs['detalle_localizacion'];
  ?>
  <tr>
    <td><?php echo $var_id; ?></td>
    <td><?php echo $var_id_indic; ?></td>
    <td><?php echo $var_id_pais; ?></td>
    <td><?php echo $var_ano; ?></td>
    <td><?php echo $var_id_ent; ?></td>
    <td><?php echo $var_valor; ?></td>
    <td><?php echo $var_fuente; ?></td>
    <td><?php echo $var_comentario['ES']; ?></td>
    <td><?php echo $var_info_sistematica; ?></td>
    <td><?php echo $var_detalle_localizacion; ?></td>
    <td>
        
        <div align="center">
        <a title='Modificar' href='valores_mod.php?id=<?php echo $var_id; ?>' class='btn btn-default' ><i class='glyphicon glyphicon-pencil'></i></a>
        </div>

    </td>
    <td>

        <div align="center">
        <a title='Eliminar' onclick='return eliminar_registro(<?php echo $var_id; ?>);' class='btn btn-default' ><i class='glyphicon glyphicon-remove'></i></a>
        </div>      
      
    </td>
  </tr>
  <?php 
    }
    $_SESSION['action']=0;
  ?>
</table>    
</div>
</form>
</body>
</body>
</html>
<?php validar_acciones(); ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js" ></script>


