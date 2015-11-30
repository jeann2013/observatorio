<?php

include ("db.php");
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);
header('Access-Control-Allow-Origin: *');

$var_accion = $_POST['accion'];

if($var_accion == 'eliminar_registro_identificadores_jq'){
	$id = $_POST['id'];
	$var_resultado = eliminar_traduccion($id);
	print json_encode($var_resultado);
}

if($var_accion == 'eliminar_registro_valores_jq'){
	$id = $_POST['id'];
	$var_resultado = eliminar_valores($id);
	print json_encode($var_resultado);
}

if($var_accion == 'buscar_indicadores_jq'){
	$id_categoria = $_POST['id_cate'];
	$var_resultado = buscar_indicadores($id_categoria);
	print json_encode($var_resultado);
}

if($var_accion == 'buscar_entidades_jq'){
	$id_pais = $_POST['id_pais'];
	$var_resultado = buscar_entidades($id_pais);
	print json_encode($var_resultado);
}

?>