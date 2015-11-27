<?php

include ("db.php"); 
$conn = phpmkr_db_connect(HOST, USER, PASS, DB, PORT);

$file = fopen("ENTIDAD.txt", "r") or exit("Unable to open file!");

$con=0;

$sSql="delete from entidad";
phpmkr_query($sSql,$conn);

while(!feof($file)){
	$linea = fgets($file). "\n";

	$valores[]=explode(";", $linea);
	$value1 = trim(str_replace('"', "", $valores[$con][0]));
	$value2 = trim(str_replace('"', "", $valores[$con][1]));
	$value3 = trim(str_replace('"', "", $valores[$con][2]));
	$value4 = trim(str_replace('"', "", $valores[$con][3]));
	$value5 = trim(str_replace('"', "", $valores[$con][4]));
	
	$sSql="insert into entidad values('$value1','$value2','$value3',$value4,'$value5')";
	phpmkr_query($sSql,$conn);
	errores($con);
	$con=$con+1;

	
}

echo "Listo!";

fclose($file);





// $file = fopen("INDICADORES.txt", "r") or exit("Unable to open file!");

// $con=0;

// $sSql="delete from indicadores";
// phpmkr_query($sSql,$conn);

// while(!feof($file)){
// 	$linea = fgets($file). "\n";

// 	$valores[]=explode(";", $linea);
// 	$id = trim(str_replace('"', "", $valores[$con][0]));
// 	$grupo =  trim(str_replace('"', "", $valores[$con][1]));
// 	$descripcion_indicador = trim(str_replace('"', "", $valores[$con][2]));
// 	$tipo = trim(str_replace('"', "", $valores[$con][3]));
// 	$unidades = trim(str_replace('"', "", $valores[$con][4]));
// 	$definicion = trim(str_replace('"', "", $valores[$con][5]));
// 	$notas = trim(str_replace('"', "", $valores[$con][6]));
// 	$tipo_agregacion = trim(str_replace('"', "", $valores[$con][7]));
// 	$clase = trim(str_replace('"', "", $valores[$con][8]));
// 	$regional = trim(str_replace('"', "", $valores[$con][9]));
	
// 	$sSql="insert into indicadores values($id,'$grupo','$descripcion_indicador','$tipo','$unidades','$notas',
// 	'$tipo_agregacion','$clase','$regional')";
// 	phpmkr_query($sSql,$conn);

// 	$con=$con+1;

	
// }

// echo "Listo!";

// fclose($file);


// $file2 = fopen("INDICADORES_TRADUCCION.txt", "r") or exit("Unable to open file!");

// $con=0;

// $sSql="delete from indicadores_traduccion";
// phpmkr_query($sSql,$conn);

// while(!feof($file2)){
// 	$linea = fgets($file2). "\n";

// 	$valores[]=explode(";", $linea);
// 	$id = trim(str_replace('"', "", $valores[$con][0]));
// 	$grupo =  trim(str_replace('"', "", $valores[$con][1]));
// 	$descripcion_indicador = trim(str_replace('"', "", $valores[$con][2]));
// 	$tipo = trim(str_replace('"', "", $valores[$con][3]));
// 	$unidades = trim(str_replace('"', "", $valores[$con][4]));
// 	$id_indic = trim(str_replace('"', "", $valores[$con][5]));
	
// 	$sSql="insert into indicadores_traduccion values($id,'$grupo','$descripcion_indicador','$tipo','$unidades',$id_indic)";
// 	phpmkr_query($sSql,$conn);

// 	$con=$con+1;

	
// }

// echo "Listo!";

// fclose($file2);


// $file2 = fopen("VALORES.csv", "r") or exit("Unable to open file!");

// $con=0;

// $sSql="delete from valores";
// phpmkr_query($sSql,$conn);

// while(!feof($file2)){
// 	$linea = fgets($file2). "\n";

// 	$valores[]=explode(";", $linea);

// 	$id = trim(str_replace('"', "", $valores[$con][0]));
// 	$grupo =  trim(str_replace('"', "", $valores[$con][1]));
// 	$descripcion_indicador = trim(str_replace('"', "", $valores[$con][2]));
// 	if($descripcion_indicador==""){$descripcion_indicador="-";}
//  	$tipo = trim(str_replace('"', "", $valores[$con][3]));
//  	if($tipo==""){$tipo=0;}
//  	$unidades = trim(str_replace('"', "", $valores[$con][4]));
//  	$definicion = trim(str_replace('"', "", $valores[$con][5]));
//  	if($definicion==""){$definicion=0;}
//  	$notas = trim(str_replace('"', "", $valores[$con][6]));
//  	$tipo_agregacion = trim(str_replace('"', "", $valores[$con][7]));
//  	$clase = trim(str_replace('"', "", $valores[$con][8]));
//  	$regional = trim(str_replace('"', "", $valores[$con][9]));
// 	if($regional ==""){$regional="-";}
// 	//$regional2 = trim(str_replace('"', "", $valores[$con][10]));

// 	if($id<>""){
	
// 		$sSql="insert into valores values($id,$grupo,'$descripcion_indicador',$tipo,'$unidades',$definicion,'$notas','$tipo_agregacion','$clase','$regional')";
// 	 	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
//  	}	

// 	$con=$con+1;

// 	errores($con);
	
// }

// echo "Listo!";

// fclose($file2);


// $file2 = fopen("CATEGORIAS_INDICADORES.txt", "r") or exit("Unable to open file!");

// $con=0;

// $sSql="delete from valores";
// phpmkr_query($sSql,$conn);

// while(!feof($file2)){
// 	$linea = fgets($file2). "\n";

// 	$valores[]=explode(";", $linea);

// 	$id = trim(str_replace('"', "", $valores[$con][0]));
// 	$grupo =  trim(str_replace('"', "", $valores[$con][1]));
// 	$descripcion_indicador = trim(str_replace('"', "", $valores[$con][2]));
//  	$tipo = trim(str_replace('"', "", $valores[$con][3]));


// 	if($id<>""){
// 		$sSql="insert into categorias_indicadores values($id,'$grupo','$descripcion_indicador','$tipo')";
// 	 	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
//  	}	

// 	$con=$con+1;

	
// }

// echo "Listo!";

//fclose($file2);


// $file2 = fopen("PAISES.txt", "r") or exit("Unable to open file!");

// $con=0;

// $sSql="delete from paises";
// phpmkr_query($sSql,$conn);

// while(!feof($file2)){
// 	$linea = fgets($file2). "\n";

// 	$valores[]=explode(";", $linea);

// 	$id = trim(str_replace('"', "", $valores[$con][0]));
// 	$grupo =  trim(str_replace('"', "", $valores[$con][1]));
// 	$descripcion_indicador = trim(str_replace('"', "", $valores[$con][2]));
//  	$tipo = trim(str_replace('"', "", $valores[$con][3]));
//  	$tipo2 = trim(str_replace('"', "", $valores[$con][4]));


// 	if($id<>""){
// 		$sSql="insert into paises values('$id','$grupo','$descripcion_indicador','$tipo','$tipo2')";
// 	 	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
//  	}	

// 	$con=$con+1;

	
// }

// echo "Listo!";

// fclose($file2);

//print "<pre>".print_r($valores,true)."</pre>";


?>