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

$var_accion = $_SESSION['action'];
if($var_accion==""){$var_accion=0;}

?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Indicadores</title>
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
              data:{accion:'eliminar_registro_identificadores_jq',id:id},
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
<form action="indicadores_view.php" method="post" name="form1">
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
          
            <td colspan="2">
             <div align="center">
                    <input class="btn btn-primary" type="submit" value="Buscar">
               </div>
            </td>
           
          </tr>
           <tr>
            <td colspan="2">
              <div align="center">
              <a title='Ingresar' href='indicadores_add.php' class='btn btn-default' ><i class='glyphicon glyphicon-circle-arrow-down'></i> Ingresar</a>
              </div>           
            
            </td>
          </tr>
        </table>

<div class="table-responsive">
<table class="table table-striped" border="0">
  <tr class="info">
    <th>Id</td>
    <th>Indicador</td>
    
    <th><div align="center">Modificar</div></td>
    <th><div align="center">Eliminar</div></td>
  </tr>
  <?php

    $sSql="select * from indicadores i where 1=1 ";

    if($var_id_categorias_indicadores<>"" && $var_id_categorias_indicadores<>"0"){
      $sSql.=" and i.clase = '$var_id_categorias_indicadores' ";
    }

    

    if($var_id_categorias_indicadores==0 ){
      $sSql.=" limit 100 ";
    }

    $rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
    while ($row_rs = $rs->fetch_assoc()){
      $var_id=$row_rs['id_indic'];
      $var_id_indic=$row_rs['id_indic'];
      $var_nombre_indicador = buscar_categoria($var_id_indic);
      $var_nombre_indic = $var_nombre_indicador['ES'];
      
  ?>
  <tr>
    <td><?php echo $var_id; ?></td>
    <td><?php echo $var_nombre_indic; ?></td>
    
    <td>
        
        <div align="center">
        <a title='Modificar' href='indicadores_mod.php?id=<?php echo $var_id; ?>' class='btn btn-default' ><i class='glyphicon glyphicon-pencil'></i></a>
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


