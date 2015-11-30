<?php
if (!isset($_SESSION)){
  session_start();
}
include ("db.php");
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);

$var_accion = $_POST['accion'];

if($var_accion==1){

	$var_nombre_es = $_POST['nombre_es'];
	$var_nombre_en = $_POST['nombre_en'];
	$var_nombre_pt = $_POST['nombre_pt'];

	$var_grupo_es = $_POST['grupo_es'];
	$var_grupo_en = $_POST['grupo_en'];
	$var_grupo_pt = $_POST['grupo_pt'];
	
	$var_tipo_es = $_POST['tipo_es'];
	$var_tipo_en = $_POST['tipo_en'];
	$var_tipo_pt = $_POST['tipo_pt'];

	$var_unidades_es = $_POST['unidades_es'];
	$var_unidades_en = $_POST['unidades_en'];
	$var_unidades_pt = $_POST['unidades_es'];

	$var_notas_es = $_POST['notas_es'];
	$var_notas_en = $_POST['notas_en'];
	$var_notas_pt = $_POST['notas_pt'];

	$var_tipo_agregacion = $_POST['tipo_agregacion'];
	$categorias_indicadores = $_POST['categorias_indicadores'];
	$var_regional = $_POST['regional'];
	$var_decimales= $_POST['decimales'];
	
	$var_id_indic = buscar_id_indicador();

	$var_id_indic_traduccion = generar_id_indicador($var_id_indic,$var_nombre_es,$var_nombre_en,$var_nombre_pt);
	$var_id_nota_traduccion = generar_id_notas($var_id_indic,$var_notas_es,$var_notas_en,$var_notas_pt);
	$var_id_unidades_traduccion = generar_id_unidades($var_id_indic,$var_unidades_es,$var_unidades_en,$var_unidades_pt);
	$var_id_tipo_traduccion = generar_id_tipo($var_id_indic,$var_tipo_es,$var_tipo_en,$var_tipo_pt);
	$var_id_grupo_traduccion = generar_id_grupo($var_id_indic,$var_grupo_es,$var_grupo_en,$var_grupo_pt);

	

	$sSql="insert into indicadores (id_indic,grupo,descripcion_indicador,tipo,unidades,notas,tipo_agregacion,clase,regional,decimales) 
	values($var_id_indic,'$var_id_grupo_traduccion','$var_id_indic_traduccion','$var_id_tipo_traduccion','$var_id_unidades_traduccion','$var_id_nota_traduccion',
	'$var_tipo_agregacion','$categorias_indicadores','$var_regional',$var_decimales)";

	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$_SESSION['action']=1;
	header("Location: indicadores_view.php");

}

if($var_accion==2){

	$var_nombre_es = $_POST['nombre_es'];
	$var_nombre_en = $_POST['nombre_en'];
	$var_nombre_pt = $_POST['nombre_pt'];

	$var_grupo_es = $_POST['grupo_es'];
	$var_grupo_en = $_POST['grupo_en'];
	$var_grupo_pt = $_POST['grupo_pt'];
	
	$var_tipo_es = $_POST['tipo_es'];
	$var_tipo_en = $_POST['tipo_en'];
	$var_tipo_pt = $_POST['tipo_pt'];

	$var_unidades_es = $_POST['unidades_es'];
	$var_unidades_en = $_POST['unidades_en'];
	$var_unidades_pt = $_POST['unidades_es'];

	$var_notas_es = $_POST['notas_es'];
	$var_notas_en = $_POST['notas_en'];
	$var_notas_pt = $_POST['notas_pt'];

	$var_tipo_agregacion = $_POST['tipo_agregacion'];
	$categorias_indicadores = $_POST['categorias_indicadores'];
	$var_regional = $_POST['regional'];
	$var_decimales= $_POST['decimales'];
	
	$var_id_indic = $_POST['codigo'];

	$codificacion = buscar_codificacion_indicador($var_id_indic);

	modificar_traduccion($codificacion['descripcion_indicador'],$var_id_indic,$var_nombre_es,$var_nombre_en,$var_nombre_pt);
	modificar_traduccion($codificacion['notas'],$var_id_indic,$var_notas_es,$var_notas_en,$var_notas_pt);
	modificar_traduccion($codificacion['unidades'],$var_id_indic,$var_unidades_es,$var_unidades_en,$var_unidades_pt);
	modificar_traduccion($codificacion['tipo'],$var_id_indic,$var_tipo_es,$var_tipo_en,$var_tipo_pt);
	modificar_traduccion($codificacion['grupo'],$var_id_indic,$var_grupo_es,$var_grupo_en,$var_grupo_pt);

	$sSql="update indicadores set tipo_agregacion=$var_tipo_agregacion,clase=$categorias_indicadores,
	regional=$var_regional,decimales = $var_decimales where id_indic = '$var_id_indic'";

	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$_SESSION['action']=2;
	header("Location: indicadores_view.php");

}

?>