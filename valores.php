<?php
include ("db.php");
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);

$var_accion = $_POST['accion'];

if($var_accion==1){

	$var_id_indic = $_POST['id_indic'];
	$var_id_pais = $_POST['id_pais'];
	$var_ano = $_POST['ano'];
	$var_id_ent = $_POST['id_ent'];
	$var_valor = $_POST['valor'];
	$var_comentario_es = $_POST['comentario_es'];
	$var_comentario_en = $_POST['comentario_en'];
	$var_comentario_pt = $_POST['comentario_pt'];
	$var_info_sistematica = $_POST['info_sistematica'];
	$var_detalle = $_POST['detalle'];

	$var_id_comentario = generar_id_comentario($var_id_indic,$var_id_pais,$var_ano,$var_comentario_es,$var_comentario_en,$var_comentario_pt);
	$var_fuente = buscar_fuente($var_id_ent,$var_id_pais);

	$sSql="insert into valores (id_indic,id_pais,ano,id_ent,valor,fuente,id_comentario,info_sistematica,
	detalle_localizacion) values($var_id_indic,'$var_id_pais',$var_ano,'$var_id_ent',$var_valor,'$var_fuente',
	'$var_id_comentario','$var_info_sistematica','$var_detalle')";

	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$_SESSION['action']=1;
	header("Location: valores_view.php");

}

if($var_accion==2){

	$var_id = $_POST['id'];
	$var_id_indic = $_POST['id_indic'];
	$var_id_pais = $_POST['id_pais'];
	$var_ano = $_POST['ano'];
	$var_id_ent = $_POST['id_ent'];
	$var_valor = $_POST['valor'];
	$var_comentario_es = $_POST['comentario_es'];
	$var_comentario_en = $_POST['comentario_en'];
	$var_comentario_pt = $_POST['comentario_pt'];
	$var_info_sistematica = $_POST['info_sistematica'];
	$var_detalle = $_POST['detalle'];
	$id_comentario_actual = $_POST['id_comentario_actual'];

	$var_id_comentario = modificar_id_comentario($var_id_indic,$var_id_pais,$var_ano,$var_comentario_es,$var_comentario_en,$var_comentario_pt,$id_comentario_actual);
	$var_fuente = buscar_fuente($var_id_ent,$var_id_pais);

	$sSql="update valores set id_indic=$var_id_indic,
	id_pais='$var_id_pais',
	ano=$var_ano,
	id_ent='$var_id_ent',
	valor=$var_valor,
	fuente='$var_fuente',
	id_comentario='$id_comentario_actual',
	info_sistematica='$var_info_sistematica',
	detalle_localizacion='$var_detalle' 
	where id = $var_id";

	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$_SESSION['action']=2;
	header("Location: valores_view.php");

}

?>