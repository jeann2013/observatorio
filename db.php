<?php

/**
 * 
 * @todo Funcion que elimina la descripcion del traduccion para cada uno de los codificaciones
 * @author Jean Carlos Nuñez
 * @param  varchar $codificacion
 * @param  int $id_indic
 * @return string
 *  
 */ 

function eliminar_traduccion($id_indic)
{
	global $conn;
	
	$sSql="select i.grupo,i.descripcion_indicador,i.tipo,i.unidades,i.notas from indicadores i	
	where i.id_indic = $id_indic ";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno['grupo'] = $row_rs['grupo'];
		$retorno['descripcion_indicador'] = $row_rs['descripcion_indicador'];
		$retorno['tipo'] = $row_rs['tipo'];
		$retorno['unidades'] = $row_rs['unidades'];
		$retorno['notas'] = $row_rs['notas'];
	}

	$codificacion = $retorno['grupo'];
	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$codificacion = $retorno['descripcion_indicador'];
	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$codificacion = $retorno['tipo'];
	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$codificacion = $retorno['unidades'];
	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$codificacion = $retorno['notas'];
	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);


	$sSql="delete from  indicadores where id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$retorno['0']=1;
	return $retorno;
}


/**
 * 
 * @todo Funcion que busca la codificacion del indicador
 * @author Jean Carlos Nuñez
 * @param  int $id
 * @return string
 *  
 */ 

function buscar_codificacion_indicador($id_indic)
{
	global $conn;

	$sSql="select i.grupo,i.descripcion_indicador,i.tipo,i.unidades,i.notas from indicadores i	
	where i.id_indic = $id_indic ";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno['grupo'] = $row_rs['grupo'];
		$retorno['descripcion_indicador'] = $row_rs['descripcion_indicador'];
		$retorno['tipo'] = $row_rs['tipo'];
		$retorno['unidades'] = $row_rs['unidades'];
		$retorno['notas'] = $row_rs['notas'];
	}

	return $retorno;
}


/**
 * 
 * @todo Funcion que modifica la descripcion del traduccion para cada uno de los codificaciones
 * @author Jean Carlos Nuñez
 * @param  varchar $codificacion
 * @param  int $id_indic
 * @return string
 *  
 */ 

function modificar_traduccion($codificacion,$id_indic,$ES,$EN,$PT)
{
	global $conn;

	$sSql="update indicadores_traduccion set ES='$ES',EN='$EN',PT='$PT' where codificacion = '$codificacion' and id_indic = $id_indic";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	return 1;
}

/**
 * 
 * @todo Funcion que busca la descripcion del traduccion para cada uno de los codificaciones
 * @author Jean Carlos Nuñez
 * @param  varchar $codificacion
 * @param  int $id_indic
 * @return string
 *  
 */ 

function buscar_traduccion($codificacion,$id_indic)
{
	global $conn;

	$sSql="select ES,EN,PT from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno['ES'] = utf8_encode($row_rs['ES']);
		$retorno['EN'] = utf8_encode($row_rs['EN']);
		$retorno['PT'] = utf8_encode($row_rs['PT']);
	}

	return $retorno;
}


/**
 * 
 * @todo Funcion que busca el id de indicador
 * @author Jean Carlos Nuñez
 * @return int
 *  
 */ 

function buscar_id_indicador()
{
	global $conn;

	$sSql="select max(id_indic) as id_indic from indicadores ";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno = $row_rs['id_indic']+1;
	}
	return $retorno;
}


/**
 * 
 * @todo Funcion retorna id de notas
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_notas($id_indic,$es,$en,$pt)
{
	global $conn;

	$id_codificacion = "INDIC_".$id_indic."_NOTA_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_codificacion;

}

/**
 * 
 * @todo Funcion retorna id de unidades
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_unidades($id_indic,$es,$en,$pt)
{
	global $conn;

	$id_codificacion = "INDIC_".$id_indic."_UNID_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_codificacion;

}

/**
 * 
 * @todo Funcion retorna id de tipo
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_tipo($id_indic,$es,$en,$pt)
{
	global $conn;

	$id_codificacion = "INDIC_".$id_indic."_TIPO_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_codificacion;

}


/**
 * 
 * @todo Funcion retorna id de grupo
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_grupo($id_indic,$es,$en,$pt)
{
	global $conn;

	$id_codificacion = "INDIC_".$id_indic."_GRUPO_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_codificacion;

}

/**
 * 
 * @todo Funcion retorna id de indicador
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_indicador($id_indic,$es,$en,$pt)
{
	global $conn;

	$id_codificacion = "INDIC_".$id_indic."_DESC_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_codificacion;

}


/**
 * 
 * @todo Funcion que modifica comentario y lo guarda
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  char $id_pais
 * @param  int $ano
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @param  string $id_comentario
 * @return string
 *  
 */ 

function modificar_id_comentario($id_indic,$id_pais,$ano,$es,$en,$pt,$id_comentario)
{
	global $conn;

	//$id_comentario_codificacion = "INDIC_".$id_indic."_".$id_pais."_".$ano."_COMENTARIO_ID";

	$sSql="update indicadores_traduccion set ES='$es',EN='$en',PT='$pt',id_indic=$id_indic where codificacion = '$id_comentario'";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_comentario;

}


/**
 * 
 * @todo Funcion que busca la categoria de indiciadores
 * @author Jean Carlos Nuñez
 * @param  int $id
 * @return string
 *  
 */ 

function buscar_categoria($id_indic)
{
	global $conn;

	$sSql="select i.clase,it.ES,it.EN,it.PT from indicadores i,indicadores_traduccion it 
	where i.id_indic = $id_indic and it.codificacion = i.descripcion_indicador";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno['clase'] = $row_rs['clase'];
		$retorno['ES'] = utf8_encode($row_rs['ES']);
		$retorno['EN'] = $row_rs['EN'];
		$retorno['PT'] = $row_rs['PT'];
	}

	return $retorno;
}

/**
 * 
 * @todo Funcion que busca la descripcion del comentario
 * @author Jean Carlos Nuñez
 * @param  int $id
 * @return string
 *  
 */ 

function buscar_comentario($codificacion,$id_indic)
{
	global $conn;

	$sSql="select ES,EN,PT from indicadores_traduccion where codificacion = '$codificacion' and id_indic = $id_indic";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$retorno['ES'] = utf8_encode($row_rs['ES']);
		$retorno['EN'] = utf8_encode($row_rs['EN']);
		$retorno['PT'] = utf8_encode($row_rs['PT']);
	}

	return $retorno;
}

/**
 * 
 * @todo Funcion que busca la descripcion de la fuente
 * @author Jean Carlos Nuñez
 * @param  int $id
 * @param  varchar $id_pais
 * @return string
 *  
 */ 

function buscar_fuente($id,$id_pais)
{
	global $conn;

	$sSql="select entidad from entidad where id_ent = '$id' and id_pais = '$id_pais'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$entidad = $row_rs['entidad'];
	}

	return $entidad;
}

/**
 * 
 * @todo Funcion que elimina registro de la tabla valores y indicadores traduccion
 * @author Jean Carlos Nuñez
 * @param  int $id
 * @return int
 *  
 */ 

function eliminar_valores($id)
{
	global $conn;

	$sSql="select id_comentario from valores where id = '$id'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$codificacion = $row_rs['id_comentario'];
	}

	$sSql="delete from valores where id = $id";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$sSql="delete from indicadores_traduccion where codificacion = '$codificacion'";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$retorno['0']=1;
	return $retorno;
}


/**
 * 
 * @todo Funcion retorna id de comentario y lo guarda
 * @author Jean Carlos Nuñez
 * @param  char $id_indic
 * @param  char $id_pais
 * @param  int $ano
 * @param  string $es
 * @param  string $en
 * @param  string $pt
 * @return string
 *  
 */ 

function generar_id_comentario($id_indic,$id_pais,$ano,$es,$en,$pt)
{
	global $conn;

	$id_comentario_codificacion = "INDIC_".$id_indic."_".$id_pais."_".$ano."_COMENTARIO_ID";

	$sSql="insert into indicadores_traduccion (codificacion,ES,EN,PT,id_indic) values('$id_comentario_codificacion','$es','$en','$pt',$id_indic)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	return $id_comentario_codificacion;

}


/**
 * 
 * @todo Funcion retorna lista de indicadores
 * @author Jean Carlos Nuñez
 * @param  char $id_pais
 * @return string
 *  
 */ 

function buscar_indicadores($id_cate)
{
	global $conn;
	
	$sSql="select t.* FROM observatorio.indicadores i,observatorio.indicadores_traduccion t 
		   where 
		   i.clase = '$id_cate' and
		   i.descripcion_indicador = t.codificacion";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	$cont=1;
	
	$retorno['0']=$con;

	while ($row_rs = $rs->fetch_assoc()){
		
		$retorno['id_indic'.$cont]=$row_rs['id_indic'];
		$var_nombre=utf8_encode($row_rs['ES']);
		$retorno['ES'.$cont]=$var_nombre;
		$var_nombre=utf8_encode($row_rs['EN']);
		$retorno['EN'.$cont]=$var_nombre;
		$var_nombre=utf8_encode($row_rs['PT']);
		$retorno['PT'.$cont]=$var_nombre;

		$cont=$cont+1;
	}

	return $retorno;
}

/**
 * 
 * @todo Funcion retorna lista de entidades
 * @author Jean Carlos Nuñez
 * @param  char $id_pais
 * @return string
 *  
 */ 

function buscar_entidades($id_pais)
{
	global $conn;
	
	$sSql="select * from entidad where id_pais = '$id_pais'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	$cont=1;
	
	$retorno['0']=$con;

	while ($row_rs = $rs->fetch_assoc()){
		$var_nombre=utf8_encode($row_rs['entidad']);
		$retorno['id'.$cont]=$row_rs['id_ent'];
		$retorno['entidad'.$cont]=$var_nombre;
		$cont=$cont+1;
	}

	return $retorno;
}

/**
 * 
 * @todo Funcion retorna el nombre de un pais
 * @author Jean Carlos Nuñez
 * @param  char $id_pais
 * @return string
 *  
 */ 

function nombre_pais($id_pais)
{
	global $conn;
	
	$sSql="select * from paises where id = '$id_pais'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()){
		$var_nombre=utf8_encode($row_rs['nombre']);
	}

	return $var_nombre;
}


/**
 * 
 * @todo Funcion calcular cuotas de repuestos
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @return string
 *  
 */ 

function calculo_cuota_repuestos($num_ope)
{
		global $conn;

		$sSql="select diarios from operaciones_generales ";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		while ($row_rs = $rs->fetch_assoc()){
			$var_monto_diario=$row_rs['diarios'];
		}


		$sSql="select * from operadores_cuotas_siniestro_respuesto where num_ope = $num_ope ";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$con = phpmkr_num_rows($rs);
		if ($con>0){
			while ($row_rs = $rs->fetch_assoc()){			
				$var_cuota = $row_rs['cuota'];
				$var_monto = $row_rs['monto'];
				$var_cuota_monto = ceil($var_monto/$var_monto_diario);
				$var_cuota_final = $var_cuota_monto+$var_cuota;

			}
		}

		return "Cuota:".$var_cuota."/".$var_cuota_final;
}


/**
 * 
 * @todo Funcion eliminar diarios de un operador
 * @author Jean Carlos Nuñez
 * @param int $fecha
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @param decimal $monto
 * @return array
 *  
 */ 

function eliminar_diario_r_jq($fecha,$cod_usu,$num_ope,$accion,$monto,$tipo,$detalle)
{
	global $conn;
	$fecha = fecha_sql($fecha);

	if($tipo==0){
		$con=0;
		$sSql="select * from diarios_eliminar where num_ope = $num_ope and cod_usu = $cod_usu";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$con = phpmkr_num_rows($rs);
		
		if ($con>0){
			
			$sSql="delete from diarios_eliminar where fecha = '$fecha' and num_ope = $num_ope and cod_usu = $cod_usu";
			$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
		}
		
		if($accion==1){
		$sSql="insert into diarios_eliminar values($num_ope,'$fecha',$cod_usu,$monto)";$row_rs=array('0'=>1);}
		
		if($accion==0){
			
		$sSql="delete from diarios_eliminar where fecha = '$fecha' and num_ope = $num_ope and cod_usu = $cod_usu";$row_rs=array('0'=>2);	}
		
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
		return $row_rs;
	}

	if($tipo==1){
		$con=0;
		
		$sSql="select * from diarios_eliminar where num_ope = $num_ope and cod_usu = $cod_usu";
		$rs_eli=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$con = phpmkr_num_rows($rs_eli);
		if ($con>0){
			while ($row_rs_delete = $rs_eli->fetch_assoc()){			
				$var_fecha = $row_rs_delete['fecha'];
				//$sSql="delete from cuentasxcobrar where fecha = '$var_fecha' and num_ope = $num_ope";
				//$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				
				/**/
				$rs=phpmkr_query("select sum(monto) as monto from cuentasxcobrar_respuestos where num_ope = $num_ope and fecha = '".$var_fecha."'",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				while ($row_rs = $rs->fetch_assoc())
				{$var_monto_total_renta=$row_rs['monto'];}

				$rs=phpmkr_query("select num_und from autos where num_ope = $num_ope",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				while ($row_rs = $rs->fetch_assoc())
				{$var_num_und=$row_rs['num_und'];}	

				phpmkr_query("delete from cuentasxcobrar_respuestos where num_ope = $num_ope and fecha = '$var_fecha'",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				
				$sSql="update cuentasxcobrar_respuestos_hist set detalle='Eliminado,Detalle:$detalle',cod_usu=$cod_usu where num_ope = $num_ope 
				and fecha = '$var_fecha'";
				phpmkr_query($sSql,$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				
				/**/
				$rs=phpmkr_query("select num_und,financiado,nota_delta from autos where num_ope = $num_ope",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				while ($row_rs = $rs->fetch_assoc())
				{$var_num_und=$row_rs['num_und'];$var_financiado=$row_rs['financiado'];$var_hasta=$row_rs['nota_delta'];}

				if($var_financiado==3)
				{
					$rs=phpmkr_query("select cuota from operadores_cuotas_siniestro_respuesto where num_ope = $num_ope",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rs = $rs->fetch_assoc())
					{
						$var_cuota=$row_rs['cuota']-1;
						phpmkr_query("update operadores_cuotas_siniestro_respuesto set cuota = $var_cuota where num_ope = $num_ope",$conn) 
						or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					}						
				}
				/**/



				auditoria($cod_usu,"ELIMINO REPUESTO POR CUOTAS AL OPERADOR: ".$num_ope." con monto: ".$var_monto_total_renta." Unidad: ".$var_num_und." Detalle: ".$detalle,$conn);
				acciones_operador($num_ope,$cod_usu,"ELIMINO DIARIO DE FECHA: ".$var_fecha." con monto: ".$var_monto_total_renta." Unidad: ".$var_num_und." Detalle: ".$detalle,$conn);						
				
				/**/	
			}

			/**/
			$rs=phpmkr_query("select fecha from cuentasxcobrar_respuestos where num_ope = $num_ope order by fecha desc",$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			while ($row_rs = $rs->fetch_assoc()){
				$var_fecha_actual_rep=$row_rs['fecha'];

				$sSql="update cuentasxcobrar_respuestos set cuota = $var_cuota where num_ope = $num_ope and fecha = '$var_fecha_actual_rep'";
				phpmkr_query($sSql,$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

				$var_cuota=$var_cuota-1;

			}
			/**/





					

			$row_rs=array('0'=>1);
		}
		if ($con==0){
			$row_rs=array('0'=>0);
		}
		
		return $row_rs;
	}
	
	
	
};


/**
 * 
 * @todo Funcion que genera la cxc de deuda de repuestos de los operadores que culminaron
 * @author Jean Carlos Nuñez
 * @param  int $num_oper
 * @param  date $var_fecha_actual
 * @param  int $var_cod_usu
 * @param  decimal $var_monto_diario
 * @return boolean
 *  
 */ 

function diarios_repuestos($num_oper,$var_fecha_actual,$var_cod_usu,$var_monto_diario)
{
	global $conn;
	
	$var_monto_deuda_repuesto=0;
	$proceso=false;
	$con=0;

	$sSql="select monto,cuota from operadores_cuotas_siniestro_respuesto where num_ope =  $num_oper ";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	
	//errores('paso1');
	
	if($con>0){
			
			//errores('paso2');

			while ($row_rs = $rs->fetch_assoc()){
				$var_monto_deuda_repuesto = $row_rs['monto'];
				$cuota = $row_rs['cuota']+1;
			}	

			if($var_monto_deuda_repuesto>0){

				if($var_monto_diario<=$var_monto_deuda_repuesto){

					$monto_diario = $var_monto_diario;
					$var_monto_deuda_repuesto = $var_monto_deuda_repuesto - $var_monto_diario;

					$sSql="insert into cuentasxcobrar_respuestos values($num_oper,'$var_fecha_actual',$monto_diario,$cuota);";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);		

					$sSql="insert into cuentasxcobrar_respuestos_hist values($num_oper,'$var_fecha_actual',$monto_diario,'CREACION DE DIARIOS POR DEUDA DE REPUESTOS EN EL CIERRE',$var_cod_usu);";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

					$sSql="update operadores_cuotas_siniestro_respuesto set cuota = $cuota,monto=$var_monto_deuda_repuesto  where num_ope =  $num_oper ";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					$proceso=true;
				}
				else{

					$monto_diario = $var_monto_deuda_repuesto;
					$var_monto_deuda_repuesto = 0;

					$sSql="insert into cuentasxcobrar_respuestos values($num_oper,'$var_fecha_actual',$monto_diario,$cuota);";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);		

					$sSql="insert into cuentasxcobrar_respuestos_hist values($num_oper,'$var_fecha_actual',$monto_diario,'CREACION DE DIARIOS POR DEUDA DE REPUESTOS EN EL CIERRE',$var_cod_usu);";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

					$sSql="update operadores_cuotas_siniestro_respuesto set cuota = $cuota,monto=$var_monto_deuda_repuesto  where num_ope =  $num_oper ";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					$proceso=true;
				}
		}
	}

	return $proceso;
}


/**
 * 
 * @todo Funcion eliminar diarios de un operador
 * @author Jean Carlos Nuñez
 * @param int $fecha
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @param decimal $monto
 * @return array
 *  
 */ 
function eliminar_diario_jq($fecha,$cod_usu,$num_ope,$accion,$monto,$tipo,$detalle)
{
	global $conn;
	$fecha = fecha_sql($fecha);

	if($tipo==0){
		$con=0;
		$sSql="select * from diarios_eliminar where num_ope = $num_ope and cod_usu = $cod_usu";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$con = phpmkr_num_rows($rs);
		
		if ($con>0){
			
			$sSql="delete from diarios_eliminar where fecha = '$fecha' and num_ope = $num_ope and cod_usu = $cod_usu";
			$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
		}
		
		if($accion==1){
		$sSql="insert into diarios_eliminar values($num_ope,'$fecha',$cod_usu,$monto)";$row_rs=array('0'=>1);}
		
		if($accion==0){
		$sSql="delete from diarios_eliminar where fecha = '$fecha' and num_ope = $num_ope and cod_usu = $cod_usu";$row_rs=array('0'=>2);	}
		
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
		return $row_rs;
	}

	if($tipo==1){
		$con=0;
		
		$sSql="select * from diarios_eliminar where num_ope = $num_ope and cod_usu = $cod_usu";
		$rs_eli=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$con = phpmkr_num_rows($rs_eli);
		if ($con>0){
			while ($row_rs_delete = $rs_eli->fetch_assoc()){			
				$var_fecha = $row_rs_delete['fecha'];
				//$sSql="delete from cuentasxcobrar where fecha = '$var_fecha' and num_ope = $num_ope";
				//$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				
				/**/
				$rs=phpmkr_query("select sum(monto) as monto from cuentasxcobrar where num_ope = $num_ope and fecha = '".$var_fecha."'",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				while ($row_rs = $rs->fetch_assoc())
				{$var_monto_total_renta=$row_rs['monto'];}

				$rs=phpmkr_query("select num_und from autos where num_ope = $num_ope",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				while ($row_rs = $rs->fetch_assoc())
				{$var_num_und=$row_rs['num_und'];}	

				phpmkr_query("delete from cuentasxcobrar where num_ope = $num_ope and fecha = '$var_fecha'",$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				
				$sSql="update cuentasxcobrar_hist set detalle='Eliminado,Detalle:$detalle',cod_usu=$cod_usu where num_ope = $num_ope 
				and fecha = '$var_fecha'";
				phpmkr_query($sSql,$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
				



				auditoria($cod_usu,"ELIMINO DIARIO AL OPERADOR: ".$num_ope." con monto: ".$var_monto_total_renta." Unidad: ".$var_num_und." Detalle: ".$detalle,$conn);
				acciones_operador($num_ope,$cod_usu,"ELIMINO DIARIO DE FECHA: ".$var_fecha." con monto: ".$var_monto_total_renta." Unidad: ".$var_num_und." Detalle: ".$detalle,$conn);						
				
				/**/	
			}


					$rs=phpmkr_query("select num_und,financiado,nota_delta from autos where num_ope = $num_ope",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rs = $rs->fetch_assoc())
					{$var_num_und=$row_rs['num_und'];$var_financiado=$row_rs['financiado'];$var_hasta=$row_rs['nota_delta'];}
					
					if($var_financiado==1)
					{
						$rs=phpmkr_query("select max(cuota) as cuota from cuentasxcobrar where num_ope = $num_ope",$conn) 
						or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
						while ($row_rs = $rs->fetch_assoc())
						{
							$var_cuota=$row_rs['cuota'];
							phpmkr_query("update operadores set desde = $var_cuota,hasta=$var_hasta where num_oper = $num_ope",$conn) 
							or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
						}						
					}

			$row_rs=array('0'=>1);
		}
		if ($con==0){
			$row_rs=array('0'=>0);
		}
		
		return $row_rs;
	}
	
	
	
};


/**
 * 
 * @todo Funcion que calcula monto faltante a pagar por unidad segun cuota generada
 * @author Jean Carlos Nuñez
 * @param  int $cuota_generada
 * @param  int $cuota_hasta
 * @return decimal
 *  
 */ 

function calculo_monto_faltante($cuota_generada,$cuota_hasta,$var_cod_frag)
{
	global $conn;
	
	//$sSql="select * from cuentasxcobrar_hist ";
	//$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	//$con = phpmkr_num_rows($rs);
	for($i=0;$cuota_generada<=$cuota_hasta;$cuota_generada++){
		$monto = buscar_monto_fragmentado($cuota_generada,$var_cod_frag);
		$monto_total = $monto_total + $monto;
		
	}

	return $monto_total;
}

/**
 * 
 * @todo Funcion que restan dos fechas
 * @author Jean Carlos Nuñez
 * @param  date $date_1
 * @param  date $date_2
 * @param  string $differenceFormat
 * @return int
 *  
 */ 

function restar_fechas($date_1 , $date_2 , $differenceFormat = '%a' )
{
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
   
    $interval = date_diff($datetime1, $datetime2);
   
    return $interval->format($differenceFormat);
   
}


/**
 * 
 * @todo Funcion que seis dias para atras para saber los dias facturas y aplicar diario del domingo
 * @author Jean Carlos Nuñez
 * @param  int $num_ope
 * @return boolean
 *  
 */ 

function calcular_cobro_domingo($num_ope)
{
	global $conn;
	$con=0;
	$fecha_hasta = fecha_aplicacion($conn);
	$fecha_desde = strtotime ( '-6 day' , strtotime ( $fecha_hasta ) ) ;
	$fecha_desde = date ( 'Y-m-d' , $fecha_desde );
	$sSql="select * from cuentasxcobrar_hist where num_ope = $num_ope and fecha between '$fecha_desde' and '$fecha_hasta'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);

	if($con<6){$retorno = 0;}elseif($con>=6){$retorno = 1;}

	return $retorno;
}


/**
 * 
 * @todo Funcion que escribe contratos en filesystem
 * @author Jean Carlos Nuñez
 * @param  int $var_num_ope
 * @return string
 *  
 */ 

function escribir_contratos($num_ope,$var_codigo_contrato)
{
	global $conn;
	

	$sSql="select contrato from contratos where num_ope = $num_ope and codigo = $var_codigo_contrato";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{
		$contrato_binario=$row_rs['contrato'];
		$bytes = $row_rs['contrato'];
		$var_name_file = md5(uniqid()).".doc";
		$fp = fopen('contratos/'.$var_name_file, 'w');
		fwrite($fp, $bytes);
		fclose($fp);
		return $var_name_file;		
	}
	
}

/**
 * 
 * @todo Funcion que busca el que le corresponde para el diario del operador
 * @author Jean Carlos Nuñez
 * @param  int $var_cuota
 * @param  int $var_cod_gru_dia
 * @return decimal
 *  
 */ 

function buscar_monto_fragmentado($var_cuota,$var_cod_frag)
{
	global $conn;
	$monto_diario=0;

	$sSql="select fd.cuota,fd.monto,f.codigo from fragmentacion f , fragmentacion_detalle fd
	where f.codigo = fd.cod_frag and f.codigo = $var_cod_frag order by fd.cuota desc";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{
		$var_cuota_frag=$row_rs['cuota'];
		$var_monto=$row_rs['monto'];
		if($var_cuota<=$var_cuota_frag){
			$monto_diario = $var_monto;
		}
	}
	return $monto_diario;

}



/**
 * 
 * @todo Funcion que genera el xls de operadores para enviarlo por mail
 * @author Jean Carlos Nuñez
 * @param  int $var_cod_salida
 * @param  int $var_tipo
 * @param  string $var_num_und
 * @param  int $var_odt
 * @return json
 *  
 */ 

function generar_xls_operadores($var_montado=1)
{
	global $conn;	
	
	if($var_montado==1){
	$sSql="select concat(o.nombre,' ',o.apellido) as nombre,o.cedula from operadores o where o.nombre <> '0'";
	}
	if($var_montado==2){
	$sSql="select concat(o.nombre,' ',o.apellido) as nombre,o.cedula from operadores o where o.num_und_asig = '0'  ";
	}

	
	$sSql.=" order by o.nombre ";
	
	
	
	
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once 'lib/PHPExcel/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();
$sharedStyle1 = new PHPExcel_Style();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Jean Carlos Nuñez")
							 ->setLastModifiedBy("Jean Carlos Nuñez")
							 ->setTitle("Office 2007 XLSX Test Document")
							 ->setSubject("Office 2007 XLSX Test Document")
							 ->setDescription("Archivo para Empresa de Seguro")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("Archivo para Empresa de Seguro");



$sharedStyle1->applyFromArray(
	array('fill' 	=> array(
								'type'		=> PHPExcel_Style_Fill::FILL_SOLID,
								'color'		=> array('argb' => 'FFFFFF')
							),
		  'borders' => array(
								'bottom'	=> array('style' => PHPExcel_Style_Border::BORDER_THIN ),
								'right'		=> array('style' => PHPExcel_Style_Border::BORDER_THIN )
							)
		 ));
		 
		 
// Add some data
$objDrawing = new PHPExcel_Worksheet_Drawing();
//$objDrawing->setPath('yellow_excel.png');
//$objDrawing->setHeight(70);
//$objDrawing->setCoordinates('A1');
//$objDrawing->setWorksheet($objPHPExcel->getActiveSheet(0));

if($var_montado=="1"){$var_montado_descripcion="MONTADOS";}else{$var_montado_descripcion="NO MONTADOS";}

/*$objPHPExcel->setActiveSheetIndex(0)
			->setCellValue('A5', 'Yellow Car, S.A')
            ->setCellValue('A6', 'Reporte Operadores')
            ->setCellValue('A7',$var_montado_descripcion);*/

//$objPHPExcel->getActiveSheet()->setSharedStyle($sharedStyle1, "A9:B9");

// Miscellaneous glyphs, UTF-8
/*$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A9', 'Nombre')
			->setCellValue('B9', 'Cedula');*/
$con=1;		
$var_monto=0;
$rs_e=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
while ($row_rs_e = $rs_e->fetch_assoc())
{
	
	
	$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A'.$con, $row_rs_e['nombre'])
			->setCellValue('B'.$con, trim($row_rs_e['cedula']));
	$con=$con+1;
	
}

$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(40);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(12);




// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Redirect output to a client’s web browser (Excel5)
//header('Content-Type: application/vnd.ms-excel');
//header('Content-Disposition: attachment;filename="operadores.xls"');
//header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
//header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save("mail/operadores.xls");
//exit;



}

/**
 * 
 * @todo Funcion que busca el mantenimiento para convertirlo en un json
 * @author Jean Carlos Nuñez
 * @param  int $var_cod_salida
 * @param  int $var_tipo
 * @param  string $var_num_und
 * @param  int $var_odt
 * @return json
 *  
 */ 

function mantenimiento_json($var_cod_salida,$var_tipo,$var_num_und,$var_odt)
{
	global $conn;	
	
	
	$sSql="select s.codigo, s.fecha, s.hora, s.cod_pro, s.cantidad, s.monto, s.monto_total, s.total_general, s.cod_usu, s.empresa, s.num_und, 
	s.cedula_responsable, s.cod_dep, s.nombre_responsable, s.cod_provee, s.kilometraje, s.factura, s.cobrar, s.general, s.detalle,
	p.descripcion,p.codigo_secundario from salidas_temp s,productos p where s.codigo = $var_cod_salida and s.cod_pro = p.codigo";	

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$valores_1 = phpmkr_fetch_array($rs2);
	
	
	while ($row_rs = $rs->fetch_assoc())
	{
		$var_fecha=fecha($row_rs['fecha']);
		$var_hora=$row_rs['hora'];
		$var_cantidad=$row_rs['cantidad'];		
		$var_empresa=$row_rs['empresa'];
		$var_num_und=$row_rs['num_und'];
		$var_kilometraje=$row_rs['kilometraje'];
		$var_monto=number_format($row_rs['monto'],2);
		$var_descripcion_pro=$row_rs['descripcion'];
		$var_codigo_secundario=$row_rs['codigo_secundario'];
	}
	



	$sSql="select descripcion from empresas where codigo =".$var_empresa;
	$rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$valores_2 = phpmkr_fetch_array($rs2);

	while ($row_rs2 = $rs2->fetch_assoc())
	{$var_descripcion=$row_rs2['descripcion'];}		
	if($var_descripcion==""){$var_descripcion="-";}
	
	$var_nombre="";
	$var_num_ope_temp="";
	
	$sSql="select * from operadores_odm where odm = $var_odt";
	$rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
	$con = phpmkr_num_rows($rs2);
	$valores_3 = phpmkr_fetch_array($rs2);


	if($con>0)
	{
		while ($row_rs2 = $rs2->fetch_assoc())
		{$var_num_ope_temp=$row_rs2['num_ope'];}	
	}
	
	
	if($var_num_ope_temp=="" || $var_num_ope_temp=="0")
	{
		$sSql="select concat(num_oper,'-',nombre,' ',apellido) as nombre,financiado from autos a,operadores o 
		where a.num_und = '$var_num_und' and a.num_und = o.num_und_asig";

		$rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$valores_4 = phpmkr_fetch_array($rs2);
		while ($row_rs2 = $rs2->fetch_assoc())
		{$var_nombre=$row_rs2['nombre'];$var_financiado=$row_rs2['financiado'];}		
		if($var_nombre==""){$var_nombre="Sin Operador";}

	}
	
	if($var_num_ope_temp > 0)
	{
		$sSql="select concat(o.num_oper,'-',o.nombre,' ',o.apellido) as nombre from operadores o where o.num_oper = $var_num_ope_temp";
		$rs2=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$valores_5 = phpmkr_fetch_array($rs2);
		while ($row_rs2 = $rs2->fetch_assoc())
		{$var_nombre=$row_rs2['nombre'];}		
		if($var_nombre==""){$var_nombre="Sin Operador";}
	}

	$var_monto_total=0;
  
  	$sSql="select s.codigo, s.fecha, s.hora, s.cod_pro, s.cantidad, s.monto, s.monto_total, s.total_general, s.cod_usu, s.empresa, s.num_und, 
	s.cedula_responsable, s.cod_dep, s.nombre_responsable, s.cod_provee, s.kilometraje, s.factura, s.cobrar, s.general, s.detalle,
	p.descripcion,p.codigo_secundario from salidas_temp s,productos p where s.codigo = $var_cod_salida and s.cod_pro = p.codigo";	
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$valores_6 = phpmkr_fetch_array($rs);
	while ($row_rs = $rs->fetch_assoc())
	{

		$var_fecha=fecha($row_rs['fecha']);
		$var_hora=$row_rs['hora'];
		$var_cantidad=$row_rs['cantidad'];		
		$var_empresa=$row_rs['empresa'];
		$var_num_und=$row_rs['num_und'];
		$var_kilometraje=$row_rs['kilometraje'];
		$var_monto=number_format($row_rs['monto'],2);
		$var_monto_sumar=$row_rs['monto'];
		$var_descripcion_pro=$row_rs['descripcion'];
		$var_codigo_secundario=$row_rs['codigo_secundario'];
		
		$var_monto_total=$var_monto_sumar+$var_monto_total;

		$sSql="select descripcion from empresas  where codigo = $var_empresa";
		$rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
		$valores_7 = phpmkr_fetch_array($rs2);
		
		while ($row_rs2 = $rs2->fetch_assoc())
		{$var_descripcion=$row_rs2['descripcion'];}		
		if($var_descripcion==""){$var_descripcion="-";}	

	}

	$resultado = array_merge($valores_1, $valores_2, $valores_3, $valores_4, $valores_5, $valores_6);
	
	print json_encode($resultado);

};



/**
 * 
 * @todo Funcion que guarda inventario por promedio en tabla central
 * @author Jean Carlos Nuñez
 * @param  int $var_cod_pro
 * @param  int $var_cantidad
 * @param  decimal $var_monto
 * @param  int $var_cod_dep
 * @param  string $factura
 * @param  decimal $var_monto2
 * @return int
 *  
 */ 

function central_productos($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$factura,$var_monto2)
{
	global $conn;	
	$con=0;

	$sSql="select * from central where cod_pro = $var_cod_pro and cod_dep = $var_cod_dep";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);


	if($con>0){
		while ($row_rs = $rs->fetch_assoc())
		{$var_cantidad_central=$row_rs['cantidad'];}

		$var_cantidad_total=$var_cantidad_central+$var_cantidad;

		$sSql="update central set monto_venta = $var_monto2,factura='$factura',cantidad=$var_cantidad_total,monto=$var_monto 
		where cod_pro = $var_cod_pro and cod_dep = $var_cod_dep";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);					
	
	}
	elseif($con==0){
		$sSql="insert into central values($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,'$factura',$var_monto2)";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);					
	
	}

	
	return 1;	
};


/**
 * 
 * @todo Funcion que guarda inventario por factura
 * @author Jean Carlos Nuñez
 * @param  int $var_cod_pro
 * @param  int $var_cantidad
 * @param  decimal $var_monto
 * @param  int $var_cod_dep
 * @param  decimal $var_monto2
 * @param  string $var_factura
 * @return int
 *  
 */ 

function inventario_factura($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$var_monto2,$var_factura)
{
	global $conn;	
	
	$sSql="insert into central values($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,'$var_factura',$var_monto2)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);					
	
	return 1;	
};

/**
 * 
 * @todo Funcion que guarda inventario por promedio
 * @author Jean Carlos Nuñez
 * @param  int $var_cod_pro
 * @param  int $var_cantidad
 * @param  decimal $var_monto
 * @param  int $var_cod_dep
 * @param  decimal $var_monto2
 * @param  int $var_cod_usu
 * @param  string $factura
 * @return int
 *  
 */ 

function inventario_promedio($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$var_monto2,$var_cod_usu,$factura)
{
	global $conn;	
	$con=0;

	$sSql="select monto from montos_promedios_productos where cod_pro = $var_cod_pro";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con==0){
		$fecha_creacion =fecha_aplicacion($conn)." ".hora_aplicacion($conn);

		$sSql="insert into montos_promedios_productos values($var_cod_pro,$var_monto2,
		'$fecha_creacion','$fecha_creacion','$factura',$var_cod_usu)";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

		$valor = central_productos($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$factura,$var_monto2);

		auditoria($var_cod_usu,"SE AGREGO PRODUCTO NUEVO A LOS PROMEDIOS, PRODUCTO: ".$var_cod_pro,$conn);		
	}
	elseif($con>0){
		while ($row_rs = $rs->fetch_assoc())
		{$var_monto_promedio_producto=$row_rs['monto'];}

		if($var_monto_promedio_producto<$var_monto2){
			$fecha_modificacion =fecha_aplicacion($conn)." ".hora_aplicacion($conn);
			$sSql="update montos_promedios_productos set monto = $var_monto2,fecha_modificacion='$fecha_modificacion',
			ultima_factura='$factura',cod_usu = $var_cod_usu where cod_pro = $var_cod_pro";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
			$valor = central_productos($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$factura,$var_monto2);

			auditoria($var_cod_usu,"SE MODIFICO PRODCTO EN LOS PROMEDIOS, AL PRODUCTO: ".$var_cod_pro,$conn);		
		}
		elseif($var_monto_promedio_producto>=$var_monto2){

			$valor = central_productos($var_cod_pro,$var_cantidad,$var_monto,$var_cod_dep,$factura,$var_monto_promedio_producto);
		}
	}
	

	return 1;	
};

/**
 * 
 * @todo Funcion que buscar deuda de repuestos por operador
 * @author Jean Carlos Nuñez
 * @param int $var_num_oper
 * @return decimal
 *  
 */ 

function deuda_repuestos($var_num_oper)
{
	global $conn;	
	
	$rs=phpmkr_query("select sum(monto) as monto from siniestros where num_ope = $var_num_oper and tipo = 0 ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_siniestros_deuda=$row_rs['monto'];}

	$rs=phpmkr_query("select monto  from ahorros_repuesto where num_ope = $var_num_oper ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_repuestos_ahorrados=$row_rs['monto'];}	

	$var_monto_total = $var_monto_siniestros_deuda - $var_monto_repuestos_ahorrados;

	return $var_monto_total;	
};


/**
 * 
 * @todo Funcion que buscar autos para generar deuda de cupos
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_num_ope
 * @param int $var_cod_usu
 * @return int
 *  
 */ 

function buscar_autos_crear_deuda_cupo($var_num_und,$var_num_ope,$var_cod_usu)
{
	global $conn;		
	
	$deuda_repuesto = deuda_repuestos($var_num_ope);
	$deuda_sini = deuda_siniestros($var_num_ope);

	if($deuda_sini==0 && $deuda_repuesto==0)
	{	
			$con=0;
			$rs3=phpmkr_query("select * from cupos where num_ope = $var_num_ope",$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			$con = phpmkr_num_rows($rs3);

			$con_hist=0;
			$rs3=phpmkr_query("select * from cupos_hist where num_ope = $var_num_ope",$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			$con_hist = phpmkr_num_rows($rs3);

			if($con==0 && $con_hist==0)
			{
				$cupos = cupos_jq($var_num_ope,$var_cod_usu,2300);
				$var_fecha_actual = fecha_aplicacion($conn);
				$sSql="insert into pago_cupo_autos_operador values($var_num_ope,'$var_num_und','$var_fecha_actual',$var_cod_usu);";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);			
			}	
			

			$sSql="update autos set estado=16 where num_und = '$var_num_und'";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	}
	return 0;	
};

/**
 * 
 * @todo Funcion que buscar deuda de siniestro
 * @author Jean Carlos Nuñez
 * @param int $var_num_oper
 * @param int $var_cod_usu
 * @return null
 *  
 */ 

function tickets_ver($var_num_oper,$var_cod_usu)
{
	global $conn;		
	phpmkr_query("delete from tickets_ver where cod_usu = $var_cod_usu",$conn) 
    or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	phpmkr_query("insert into tickets_ver (num_auto,cuota,cod_usu,fecha,num_ope)
	select num_auto,cuota,$var_cod_usu as cod_usu,fecha,num_ope from tickets where num_ope = $var_num_oper",$conn) 
    or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
};

/**
 * 
 * @todo Funcion que crea modales
 * @author Jean Carlos Nuñez
 * @param int $var_top
 * @param int $var_left
 * @param int $var_left_ini
 * @param int $var_cant_modal
 * @return string
 *  
 */ 

function crear_modal($var_top,$var_left,$var_left_ini,$var_cant_modal,$con_ini)
{

	for($con=$con_ini;$con<=$var_cant_modal;$con++)
	{
		if($con==1 || $con==6 || $con==11 || $con==16){$var_left_final=$var_left_ini;}else{$var_left_final=$var_left_final+$var_left;}
		echo "
			<div class='modal' style='position: fixed; top: $var_top; left: $var_left_final; right: auto; margin: 0 auto 20px; z-index: 1; max-width: 18%;'>
			<div id='myModal$con' class='' tabindex='-1' width='50%'' role='dialog' aria-labelledby='myModalLabel' aria-hidden=''>
			<div class='modal-header'>

			<h4 id='myModalLabel$con'>Mecanico:</h4>
			<h4 id='myModalLabel_a$con'>Auto:</h4>
			</div>
			<div class='modal-body'>
			<p id='venta$con'>Venta:</p>
			</div>
			<div class='modal-footer'>
			<p id='hora$con'>Hora:</p>
			</div>
			</div>
			</div>
		";

	}


}

/**
 * 
 * @todo Funcion que buscar deuda de siniestro
 * @author Jean Carlos Nuñez
 * @param int $var_num_oper
 * @return decimal
 *  
 */ 

function deuda_siniestros($var_num_oper)
{
	global $conn;	
	
	$rs=phpmkr_query("select sum(monto) as monto from siniestros where num_ope = $var_num_oper and 
	tipo = 1 and estado_siniestro = 'Culpable'",$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_siniestros=$row_rs['monto'];}	

	$sSql="select sum(monto) as monto from siniestros_hist 
	where num_ope = $var_num_oper and tipo = 1 and estado = 1";
    $rs2=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
    while ($row_rs2 = $rs2->fetch_assoc())
	{$var_monto_siniestros_facturados=$row_rs2['monto'];} 
	if($var_monto_siniestros_facturados==""){$var_monto_siniestros_facturados=0.00;}
	
	if($var_monto_siniestros==""){$var_monto_siniestros=0.00;} 
	$var_monto_siniestros = ($var_monto_siniestros)-($var_monto_siniestros_facturados);
	if($var_monto_siniestros<0){$var_monto_siniestros=0;}

	return $var_monto_siniestros;	
};


/**
 * 
 * @todo Funcion guarda condicion por operador
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @param int $cod_usu
 * @param string $detalles
 * @param int $cod_con
 * @param string $num_und
 * @return array
 *  
 */
function condiciones_operador_jq($num_ope,$cod_usu,$detalles,$responsable,$cod_con,$num_und)
{
	global $conn; 
	
	$var_fecha_actual = fecha_aplicacion($conn);
	$var_hora_actual = hora_aplicacion($conn);

	$con = 0;
	$rs=phpmkr_query("select * from condiciones_autos_operador where num_ope = $num_ope and cod_con = $cod_con 
	and num_und = '$num_und'",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);

	

	$sSql="select * from usuarios where codigo = $cod_usu ";
	$rs3=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs3 = $rs3->fetch_assoc())
	{$var_nombre=utf8_encode($row_rs3['nombre']);}

	
	if($con>0)
	{
		$sSql = "update condiciones_autos_operador set detalles='$detalles',fecha='$var_fecha_actual',hora='$var_hora_actual',
		cod_usu=$cod_usu where num_ope = $num_ope and cod_con = $cod_con and num_und='$num_und'";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
		
		$sSql="select (select count(*) FROM condiciones_autos) as cantidad_con,	
		(select count(*) FROM condiciones_autos_operador where num_ope = $num_ope) as cantidad_con_ope";
		$rs=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_cantidad_con=$row_rs['cantidad_con'];
			$var_cantidad_con_ope=$row_rs['cantidad_con_ope'];
			if($var_cantidad_con==$var_cantidad_con_ope){$var_entregado=1;}else{$var_entregado=0;}

		}

		$retorno=array('0'=>1,'fecha'=>fecha($var_fecha_actual),'hora'=>conversion_hora($var_hora_actual),'nombre_usuario'=>$var_nombre,'entregado'=>$var_entregado);

	}
	
	if($con==0)
	{
		$sSql = "insert into condiciones_autos_operador values($cod_con,'$num_und',$num_ope,'$detalles','$var_fecha_actual',
		'$var_hora_actual',$cod_usu,'$detalles')";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

		$sSql="select (select count(*) FROM condiciones_autos) as cantidad_con,	
		(select count(*) FROM condiciones_autos_operador where num_ope = $num_ope) as cantidad_con_ope";
		$rs=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_cantidad_con=$row_rs['cantidad_con'];
			$var_cantidad_con_ope=$row_rs['cantidad_con_ope'];
			if($var_cantidad_con==$var_cantidad_con_ope){$var_entregado=1;}else{$var_entregado=0;}

		}

	
		$retorno=array('0'=>1,'fecha'=>fecha($var_fecha_actual),'hora'=>conversion_hora($var_hora_actual),'nombre_usuario'=>$var_nombre,'entregado'=>$var_entregado);
	}

	return $retorno;

};
/**
 * 
 * @todo Funcion que busca autos para visor 3d
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @param int $cod_usu
 * @param decimal $monto
 * @return array
 *  
 */
function cupos_jq($num_ope,$cod_usu,$monto)
{
	global $conn; 
	

	$rs=phpmkr_query("select cupos as codigo from codigos",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_codigo=$row_rs['codigo']+1;}
	$rs->close();
	if ($var_codigo==0){$var_codigo=1;}
	
	phpmkr_query("update codigos set cupos = $var_codigo",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	$var_fecha = fecha_aplicacion($conn);
	$var_hora = hora_aplicacion($conn);

	$sSql="insert into cupos values($var_codigo,$num_ope,'$var_fecha','$var_hora',$monto,$cod_usu)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$retorno=array('0'=>1);
	return $retorno;

};


/**
 * 
 * @todo Funcion mover repuestos de un operador a otro
 * @author Jean Carlos Nuñez
 * @param int $sini
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @param int $num_ope_dest
 * @return array
 *  
 */ 
function mover_siniestro_respuesto_grupo_jq($var_cod_usu,$var_num_ope,$var_detalle,$var_num_ope_des)
{
	global $conn;
	
	$var_fecha_actual = fecha_aplicacion($conn);

	$sSql="select * from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
	
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_cod_sini=$row_rs['cod_sini'];

			
			$sSql="update siniestros set num_ope = $var_num_ope_des where codigo = $var_cod_sini and num_ope = $var_num_ope";
			phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
		
			auditoria($var_cod_usu,"SE MOVIO SINIESTRO: ".$var_cod_sini." DEL OPERADOR: ".$var_num_ope." A OPERADOR: ".$var_num_ope_dest,$conn);
		}	

		$sSql="delete from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

		$retorno=array('0'=>1);
	}
	if($con==0)
	{
		$retorno=array('0'=>0);	
	}

	return $retorno;
};

/**
 * 
 * @todo Funcion que busca autos para visor 3d
 * @author Jean Carlos Nuñez
 * @return empty
 *  
 */
function crear_tabla()
{
	global $conn; 
	$rs = mysqli_query($conn,"select a.num_und,concat(o.nombre,' ', o.apellido) as nombre,a.placa from autos a,operadores o 
	where a.num_und = o.num_und_asig and o.num_und_asig not in('',0)  order by a.num_und limit 250");

	echo "var table = [";
	while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_und=$row_rs['num_und']; $var_nombre=$row_rs['nombre']; $var_placa=$row_rs['placa']; 
		echo "'".$var_num_und."','".$var_nombre."','".$var_placa."',1,1,\n";	
	}
	
	echo"];\n";
	
};

/**
 * 
 * @todo Funcion que buscar color
 * @author Jean Carlos Nuñez
 * @param int $codigo_bus
 * @return array
 *  
 */ 

function buscar_color_jq($codigo_bus)
{
	global $conn;	
	
	$sSql="select descripcion from color where codigo_busqueda = $codigo_bus";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_descripcion = $row_rs['descripcion'];}
	if($var_descripcion<>""){
	$retorno=array('0'=>$var_descripcion);}else{$retorno=array('0'=>'0');}
	return $retorno;	
};


/**
 * 
 * @todo Funcion que buscar zona
 * @author Jean Carlos Nuñez
 * @param int $codigo_bus
 * @return array
 *  
 */ 

function buscar_desde_jq($codigo_bus)
{
	global $conn;	
	
	$sSql="select descripcion from zonas where codigo_busqueda = $codigo_bus";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_descripcion = $row_rs['descripcion'];}
	if($var_descripcion<>""){
	$retorno=array('0'=>$var_descripcion);}else{$retorno=array('0'=>'0');}
	return $retorno;	
};

/**
 * 
 * @todo Funcion para buscar deudas por operador y verlos en cobros
 * @author Jean Carlos Nuñez
 * @param string $num_auto
 * @param int $num_ope
 * @param int $encendido_apagado
 * @param db $conn
 * @param string $color
 * @param int $var_cod_usu
 * @param string $var_afi
 * @param int $tipo_bus
 * @return Null
 *  
 */
function todos($num_auto,$num_ope,$encendido_apagado,$conn,$color,$var_cod_usu,$var_afi,$var_fecha_hasta,$tipo_bus)
{
	
	$_where_color = "";
	$_where = "";

	
	
	//echo date('H:i:s');
	phpmkr_query("delete from cobros where cod_usu = $var_cod_usu",$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	if($num_auto<>"")
	{
		$_where  .= " and a.num_und ='".$num_auto."' ";
	}
	if($num_ope<>"")
	{
		$_where .= " and a.num_ope =".$num_ope." ";
	}
	if($encendido_apagado<>"")
	{
		$_where .= "  and a.encendido_apagado = '".$encendido_apagado."' ";
	}

	if($tipo_bus=="2"){
		$_where .= " and a.estado in (10,13,16) ";
	}else{
		//$_where .= " and a.financiado in (0,1,2) ";
		$_where .= " and a.num_und in (select num_und FROM autos_contrato_terminado_financiado)";
	}
	

	

	$sSql="select SQL_CACHE a.num_ope,a.num_und,concat(o.nombre,' ',o.apellido) as nombre_operador,o.celular1,
	a.encendido_apagado,a.monto_diario,o.fecha_ingreso,a.cod_emp, if(i.monto is null,0,i.monto) as monto_inscripcion,
	if(count(t.numero_ticket)>0,1,0) as pago
	from autos a
	left join operadores o on o.num_oper = a.num_ope 
	left join inscripciones i on i.num_ope = o.num_oper
	left join tickets t on t.num_ope = o.num_oper and t.fecha_impresion='".$var_fecha_hasta."'
	where o.num_und_asig not in('','0') ".$_where." ";

	

	
	if($var_afi==1){
	$sSql.=" and a.cod_emp = 3 ";}else{ $sSql.=" and a.cod_emp <> 3 ";}
	
	
	$sSql.=" Group by a.num_ope ";


	//echo $sSql;

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{

		$var_num_ope=$row_rs['num_ope'];
		$var_num_und=$row_rs['num_und'];
		
		

		$var_cod_emp_autos =$row_rs['cod_emp'];
		$var_nombre_completo = $row_rs['nombre_operador'];
		$var_celular1=$row_rs['celular1'];
		$var_encendido_apagado = $row_rs['encendido_apagado'];
		$var_monto_diario = $row_rs['monto_diario'];
		$var_fecha_ingreso = $row_rs['fecha_ingreso'];
		$var_contador_pago= $row_rs['pago'];
		$var_monto_ins=$row_rs['monto_inscripcion'];
		
		if($var_contador_pago>0){$pago=1;}else{$pago=0;}
		
		if($var_monto_ins==""){$var_monto_ins=0;}


		$sSql="select sum(monto) as monto from cuentasxcobrar where num_ope = ".$var_num_ope." and fecha <='".$var_fecha_hasta."'";
		$rs_diario_data=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
		while ($row_diario_data = $rs_diario_data->fetch_assoc())
		{$var_monto_diaros_cxc=$row_diario_data['monto'];}
		
		
		if($tipo_bus=="2"){

			$sSql="select facturados_contrato_terminado(".$var_num_ope.") as monto";
			$rs_diario_data=phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
			while ($row_diario_data = $rs_diario_data->fetch_assoc())
			{$var_monto_diaros_cxc=$row_diario_data['monto'];}
		}

		if($var_monto_diaros_cxc=="" || $var_monto_diaros_cxc < 0){$var_monto_diaros_cxc=0;}

		if($color=="4")
		{
			$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}	
			

			if($var_monto_diaros_cxc>=9 && $var_cod_emp_autos==3)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];	
				}
				
				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	

			}
			
			if($var_monto_diaros_cxc>=$var_monto_ins && $var_cod_emp_autos<>3)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) 
				or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];						
				}

				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
			}			
		}
		
		if($color=="3")
		{
			$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}

			if($var_cantidad_diarios_deuda>=1 && $var_cantidad_diarios_deuda<2 && $var_monto_diaros_cxc<$var_monto_ins)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];	
				}

				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
			}				
		}

		if($color=="7")
		{
			$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}
			if($var_monto_diaros_cxc==0)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];
				}
				
				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);		
			}				
		}

		if($color=="2")
		{
			$var_cantidad_diarios_deuda =(float)  $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}			

			if($var_cantidad_diarios_deuda>1 && $var_cantidad_diarios_deuda<=2 && $var_monto_diaros_cxc<$var_monto_ins)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];
												
				}
				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
			}				
		}

		if($color=="8")
		{
			$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}	

			if($var_cantidad_diarios_deuda>2  && $var_monto_diaros_cxc<$var_monto_ins)
			{
				$sSql="select codigo,color from formulas_cobros where codigo = '".$color."'";
				$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];		
						
				}
				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
			}				
		}

		if($color=="")
		{
			
			$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
			if($tipo_bus=="2"){
					$rsf=phpmkr_query("select cantidad_sin_pagar_ct($var_num_ope) as  cantidad_dias",$conn) 
					or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
					while ($row_rsf = $rsf->fetch_assoc())
					{
						$var_cantidad_dias = $row_rsf['cantidad_dias'];
						$var_pagos_epago = 1;
					}
					if($var_cantidad_dias==""){$var_cantidad_dias=0;}
			}else{
			$var_cantidad_dias_array = explode(',',cantidad_dias_operador($var_num_ope));	
			$var_cantidad_dias = $var_cantidad_dias_array[0];
			$var_pagos_epago = 1;
			}


			if($var_monto_diaros_cxc>=$var_monto_ins && $var_monto_diaros_cxc>0)
			{
				
				if($color<>''){
					$_where_color = " and codigo = ".$color." ";
				}

				

				$sSql="select codigo,color from formulas_cobros where por_encima_fondo > 0 and tipo_validacion = 1".$_where_color;
				
				$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
				while ($row_rs_f = $rs_f->fetch_assoc())
				{
					$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
					if($var_monto_diferencia==""){$var_monto_diferencia=0;}
					$var_codigo=$row_rs_f['codigo'];					
					$var_color=$row_rs_f['color'];	
				}

				$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
				$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
				$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	

			}
			else
			{
				$var_cantidad_diarios_deuda = (float) $var_monto_diaros_cxc/$var_monto_diario;
		
				if($var_cantidad_diarios_deuda>1 && $var_cantidad_diarios_deuda<=2 && $var_monto_diaros_cxc<$var_monto_ins)
				{
					
					$sSql="select codigo,color from formulas_cobros where tipo_validacion = 2 and codigo = 2 ".$_where_color;
					
					$rs_d=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
					while ($row_rs_d = $rs_d->fetch_assoc())
					{
						$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
						if($var_monto_diferencia==""){$var_monto_diferencia=0;}
						$var_codigo=$row_rs_d['codigo'];					
						$var_color=$row_rs_d['color'];	
						
					}

					$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
					$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
					$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
				
				}
				
				if($var_cantidad_diarios_deuda<=1 && $var_cantidad_diarios_deuda>0 && $var_monto_diaros_cxc<$var_monto_ins)
				{
					
					$sSql="select codigo,color from formulas_cobros where tipo_validacion = 2 and codigo = 3 ".$_where_color;
					
					$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
					while ($row_rs_f = $rs_f->fetch_assoc())
					{
						$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
						if($var_monto_diferencia==""){$var_monto_diferencia=0;}
						$var_codigo=$row_rs_f['codigo'];					
						$var_color=$row_rs_f['color'];
					}
					$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
					$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color',
					'$var_fecha_ingreso',$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
				
				}
				if($var_cantidad_diarios_deuda>2  && $var_monto_diaros_cxc<$var_monto_ins)
				{
					
					$sSql="select codigo,color from formulas_cobros where tipo_validacion = 2 and codigo = 8 ".$_where_color;
					
					$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
					while ($row_rs_f = $rs_f->fetch_assoc())
					{
						$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
						if($var_monto_diferencia==""){$var_monto_diferencia=0;}
						$var_codigo=$row_rs_f['codigo'];					
						$var_color=$row_rs_f['color'];
					}
					$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
					$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color','$var_fecha_ingreso',
					$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
				
				}

				if($var_cantidad_diarios_deuda==0)
				{
					
					$sSql="select codigo,color from formulas_cobros where tipo_validacion = 3 and codigo = 7 ".$_where_color;
					
					$rs_f=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);				
					while ($row_rs_f = $rs_f->fetch_assoc())
					{
						$var_monto_diferencia = (float) $var_monto_diaros_cxc-$var_monto_ins;
						if($var_monto_diferencia==""){$var_monto_diferencia=0;}
						$var_codigo=$row_rs_f['codigo'];					
						$var_color=$row_rs_f['color'];

					}
					$sSql="insert into cobros values($var_num_ope,'$var_num_und','$var_celular1',$var_monto_diaros_cxc,
					$var_monto_ins,$var_monto_diferencia,'$var_encendido_apagado','$var_color',
					'$var_fecha_ingreso',$pago,$var_cod_usu,$var_cantidad_dias,$var_pagos_epago,'$var_nombre_completo')";
					phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	

				}
			}		
		}

		

	}
	
}


/**
 * 
 * @todo Funcion eliminar respuesto o siniestro de un operador final
 * @author Jean Carlos Nuñez
 * @param int $sini
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @return array
 *  
 */ 
function eliminar_siniestro_respuesto_grupo_jq($var_cod_usu,$var_num_ope,$var_detalle)
{
	global $conn;
	
	$var_fecha_actual = fecha_aplicacion($conn);

	$sSql="select * from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		//$sSql="delete from siniestros where cod_sini in (select cod_sini from repuestos_operador where cod_usu = $cod_usu and num_ope = $num_ope )";
		
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_cod_sini=$row_rs['cod_sini'];

			
			$sSql="insert into siniestros_eliminados (codigo, num_ope, fecha, monto_restante, monto, monto_global, estado_pendientes, 
			cedula, cod_usu, num_und, cod_ase, resolucion, anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, 
			estado_siniestro, cheque_efectivo, monto_pago_aseguradora, tipo,fecha_eliminacion,cod_usu_eli,detalle)
		   	select codigo, num_ope, fecha , monto_restante, monto, monto_global, estado_pendientes, cedula, cod_usu, num_und, cod_ase, 
		   	resolucion,anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, estado_siniestro, cheque_efectivo, 
		   	monto_pago_aseguradora, tipo,'$var_fecha_actual',$var_cod_usu,'$var_detalle'
		    from siniestros where codigo = $var_cod_sini and num_ope = $var_num_ope";
			errores($sSql);
			phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
			$sSql="delete from siniestros where codigo = $var_cod_sini and num_ope = $var_num_ope";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
		
			auditoria($var_cod_usu,"ELIMINO SINIESTRO: ".$var_cod_sini." DEL OPERADOR: ".$var_num_ope,$conn);
		}	

		$sSql="delete from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

		$retorno=array('0'=>1);
	}
	if($con==0)
	{
		$retorno=array('0'=>0);	
	}

	return $retorno;
};

/**
 * 
 * @todo Funcion eliminar respuesto o siniestro dfe un operador
 * @author Jean Carlos Nuñez
 * @param int $sini
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @return array
 *  
 */ 
function eliminar_repuesto_siniestro_jq($sini,$cod_usu,$num_ope,$accion)
{
	global $conn;
	
	$con=0;
	$sSql="select * from repuestos_operador where num_ope = $num_ope and cod_usu = $cod_usu";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	
	if ($con>0){
		
		$sSql="delete from repuestos_operador where cod_sini = $sini and num_ope = $num_ope and cod_usu = $cod_usu";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
	}
	
	if($accion==1){
	$sSql="insert into repuestos_operador values($sini,$num_ope,$cod_usu)";$row_rs=array('0'=>1);}
	
	if($accion==0){
	$sSql="delete from repuestos_operador where cod_sini = $sini and num_ope = $num_ope and cod_usu = $cod_usu";$row_rs=array('0'=>2);	}
	
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	return $row_rs;
};


/**
 * 
 * @todo Funcion que las compras por codigo de producto
 * @author Jean Carlos Nuñez
 * @param string $var_cod_pro
 * @return arrays
 *  
 */ 

function convertir_deuda_diarios_jq($var_num_ope,$var_cod_usu,$detalle,$var_monto_deuda)
{
	global $conn;	

		$var_fecha_actual=fecha_aplicacion($conn);
	
		$sSql="insert into repuestos_operador (cod_sini,num_ope,cod_usu) 
		SELECT codigo, num_ope, $var_cod_usu FROM siniestros where num_ope = $var_num_ope and tipo = 0";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	
		$sSql="select * from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";
		$rs=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_cod_sini=$row_rs['cod_sini'];
		
			$sSql="insert into siniestros_eliminados (codigo, num_ope, fecha, monto_restante, monto, monto_global, estado_pendientes, cedula, cod_usu, 
			num_und, cod_ase, resolucion, anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, estado_siniestro, cheque_efectivo, 
			monto_pago_aseguradora, tipo,fecha_eliminacion,cod_usu_eli,detalle,cxc)
		   	SELECT codigo, num_ope, fecha , monto_restante, monto, monto_global, estado_pendientes, cedula, cod_usu, num_und, cod_ase, 
		   	resolucion,anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, estado_siniestro, cheque_efectivo, monto_pago_aseguradora, 
		   	tipo,'$var_fecha_actual',$var_cod_usu,'SE ELIMINO SINIESTRO PARA CREACION DE DIARIOS, Detalle: $detalle',1 as cxc
		    FROM siniestros where codigo = $var_cod_sini and num_ope = $var_num_ope";
			
			//echo $sSql;
			
			phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
			

			auditoria($var_cod_usu,"ELIMINO SINIESTRO: ".$var_cod_sini." DEL OPERADOR: ".$var_num_ope.", SE ELIMINO SINIESTRO PARA CREACION DE DIARIOS",$conn);		
		}

			
			//Creacion de diarios

			$sSql="select max(fecha) as fecha from cuentasxcobrar_hist where num_ope = $var_num_ope ";
			$rs=phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			while ($row_rs = $rs->fetch_assoc()){
				
				$var_fecha_diario=$row_rs['fecha'];
			
			}

			$sSql="select diarios from operaciones_generales ";
			$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			while ($row_rs = $rs->fetch_assoc()){
				$var_monto_diario=$row_rs['diarios'];
			}

			
			// $sSql="select sum(monto_restante) as monto from siniestros where num_ope = $var_num_ope and 
			// codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
			// $rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			// while ($row_rs = $rs->fetch_assoc()){
			// 	$var_monto_deuda=$row_rs['monto'];
			// }



			

			if($var_fecha_diario<=$var_fecha_actual){$var_fecha_diario=$var_fecha_actual;}


			$sSql="select cuota from operadores_cuotas_siniestro_respuesto where num_ope = $var_num_ope";
			$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			while ($row_rs = $rs->fetch_assoc()){
				$var_cuota=$row_rs['cuota'];
			}

			if($var_cuota==""){$var_cuota=1;}

			
			// for($con=0;$var_monto_deuda>0;$con++)
			// {
			// 	if($var_monto_deuda>0)
			// 	{

			// 		if($var_monto_deuda>=$var_monto_diario)
			// 		{$var_monto_deuda=$var_monto_deuda-$var_monto_diario;}
			// 		elseif($var_monto_deuda<$var_monto_diario)
			// 		{$var_monto_diario=$var_monto_deuda;$var_monto_deuda=0;}

					
					
			// 		// $sSql="select DATE_ADD('$var_fecha_diario',interval 1 day) as fecha ";
			// 		// $rs=phpmkr_query($sSql,$conn) 
			// 		// or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			// 		// while ($row_rs = $rs->fetch_assoc())
			// 		// {$var_fecha_diario=$row_rs['fecha'];}
					

			// 		// $sSql="insert into cuentasxcobrar_respuestos values($var_num_ope,'$var_fecha_diario',$var_monto_diario,$var_cuota);";
			// 		// phpmkr_query($sSql,$conn) 
			// 		// or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);		

			// 		// $sSql="insert into cuentasxcobrar_respuestos_hist values($var_num_ope,'$var_fecha_diario',$var_monto_diario,'CREACION DE DIARIOS POR DEUDA DE REPUESTOS',$var_cod_usu);";
			// 		// phpmkr_query($sSql,$conn) 
			// 		// or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

			// 		// $var_cuota=$var_cuota+1;
					
					
			// 	}
			// }

			
			$var_monto_deuda_repuesto=0;

			$sSql="select * from operadores_cuotas_siniestro_respuesto where num_ope = $var_num_ope";
			$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			$rows_cuotas = phpmkr_num_rows($rs);
			while ($row_rs = $rs->fetch_assoc()){
				$var_monto_deuda_repuesto=$row_rs['monto'];
			}
			
			$var_monto_deuda = $var_monto_deuda + $var_monto_deuda_repuesto;

			if($rows_cuotas>0){
			$sSql="update operadores_cuotas_siniestro_respuesto set monto=$var_monto_deuda where num_ope = $var_num_ope";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			}else{
				$sSql="insert into  operadores_cuotas_siniestro_respuesto values($var_num_ope,0,$var_monto_deuda);";
				phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			}

			$sSql="delete from siniestros where codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu) ";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

			$sSql="delete from ahorros_repuesto where num_ope = $var_num_ope ";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			
			//Creacion de diarios
		

		

	$retorno=array('0'=>1);
	return $retorno;
};



/**
 * 
 * @todo Funcion que guarda las direccion de clientes y actualiza sus datos
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_codigo
 * @return int 
 *  
 */ 

function guardar_clientes_rt_jq($var_telefono_actual,$var_telefono,$var_nombre_cliente,$var_codigo_cliente,$var_cod_zona)
{
	global $conn;	
	if($var_codigo_cliente <>"")
	{
	  $sSql="update clientes set nombre = '$var_nombre_cliente',telefono='$var_telefono' where codigo = $var_codigo_cliente";
	  phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	  if($var_cod_zona<>"0")
	  {
	  	$sSql="insert into cliente_direccion values($var_codigo_cliente,$var_cod_zona)";
	  	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	  }
	}

	elseif($var_codigo_cliente =="")
	{
	  
	  $rs=phpmkr_query("select rt_clientes as codigo from codigos",$conn) 
	  or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	  while ($row_rs = $rs->fetch_assoc())
	  {$var_codigo_rt_clientes=$row_rs['codigo']+1;}
	  $rs->close();
	  if ($var_codigo_rt_clientes==0){$var_codigo_rt_clientes=1;}
	  phpmkr_query("update codigos set rt_clientes = $var_codigo_rt_clientes",$conn) 
	  or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);  

	  $sSql="insert into clientes values($var_codigo_rt_clientes,'$var_nombre_cliente','$var_telefono')";
	  phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	  if($var_cod_zona<>"0"){
	  $sSql="insert into cliente_direccion values($var_codigo_rt_clientes,$var_cod_zona)";
	  phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	  }
	}

	$row_rs=array('0'=>1);	
	return $row_rs;	
};




/**
 * 
 * @todo Funcion que realiza la inscripciones de los operadores
 * @author Jean Carlos Nuñez
 * @param int $var_tipo_pago
 * @param string $var_detalle
 * @param decimal $var_monto
 * @param decimal $var_diario
 * @param string $var_num_und
 * @param int $var_num_ope
 * @return int
 *  
 */ 

function insrcipciones($var_tipo_pago,$var_detalle,$var_monto,$var_diario,$var_num_und,$var_num_ope)
{
	global $conn;	

	

	$var_contador=0;
	
	$rs=phpmkr_query("select count(*) as contador from inscripciones where num_ope = $var_num_ope",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_contador=$row_rs['contador'];}
	
	$rs=phpmkr_query("select monto from inscripciones where num_ope = $var_num_ope",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_actual=$row_rs['monto'];}
	
	$rs=phpmkr_query("select inscripciones from codigos ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_inscripciones=$row_rs['inscripciones']+1;}
	
	if($var_contador==0)
	{
		
		phpmkr_query("delete from  inscripciones where num_ope = $var_num_ope",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
		
		$rs=phpmkr_query("insert into inscripciones values($var_num_ope,$var_monto,'$var_fecha_actual')",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

		$sSql="insert into inscripciones_hist values($var_inscripciones,$var_num_ope,'$var_fecha_actual',
		$var_monto,$var_cod_usu,$var_tipo_pago)";

		$rs=phpmkr_query($sSql,$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);			
	}
	else
	{	

		$var_monto_insertar=$var_monto_actual+$var_monto;
		if ($var_monto_insertar>0){
		phpmkr_query("update inscripciones set monto = $var_monto_insertar  where num_ope = $var_num_ope",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);}
		elseif($var_monto_insertar==0)
		{
		//phpmkr_query("delete from inscripciones where num_ope = $var_num_ope",$conn) 
		//or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		}
		
		phpmkr_query("insert into inscripciones_hist values($var_inscripciones,$var_num_ope,'$var_fecha_actual',$var_monto,
		$var_cod_usu,$var_tipo_pago)",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);			
	}
	phpmkr_query("update codigos set inscripciones = $var_inscripciones",$conn);
	
	if($var_diario>0)
	{
		$rs=phpmkr_query("select count(*) as contador_cxc from cuentasxcobrar where num_ope = $var_num_ope and fecha = '$var_fecha_actual'",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		while ($row_rs = $rs->fetch_assoc())
		{$var_contador_cxc=$row_rs['contador_cxc'];}
		
		if($var_contador_cxc==0)
		{
			$sSql="insert into cuentasxcobrar values($var_num_ope,'$var_fecha_actual',$var_diario,0);";
			phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
			$sSql="insert into cuentasxcobrar_hist values($var_num_ope,'$var_fecha_actual',$var_diario,'S/D',0);";
			phpmkr_query($sSql,$conn) 
			or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		}
	}
	
	$var_estado_und=0;
	
	$rs4=phpmkr_query("select estado from autos where num_und = '$var_num_und'",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs4 = $rs4->fetch_assoc())
	{$var_estado_und=$row_rs4['estado'];}
	if($var_estado_und==10){$var_estado_und=10;}else{$var_estado_und=1;}
	
	phpmkr_query("update autos set num_ope = $var_num_ope,estado = $var_estado_und where num_und = '$var_num_und'",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
	phpmkr_query("update operadores set num_und_asig = '$var_num_und',num_und_refe = '$var_num_und',cod_usu = $var_cod_usu where num_oper = $var_num_ope",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	

	auditoria($var_cod_usu,"HIZO UNA NUEVA INSCRIPCION DE OPERADOR: ".$var_num_ope,$conn);	
	
	
	//Modulo de Historial de Unidades de Operadores
	$rs=phpmkr_query("select * from historial_unidades where num_ope = $var_num_ope and fecha_hasta = '0000-00-00' ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_hasta=$row_rs['fecha_hasta'];}
	if($var_fecha_hasta=="")
	{
		phpmkr_query("insert into historial_unidades values($var_num_ope,'$var_num_und','$var_fecha_actual','0000-00-00')",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	}	
	if($var_fecha_hasta=="0000-00-00")
	{
		phpmkr_query("update historial_unidades set fecha_hasta = '$var_fecha_actual' where num_ope = $var_num_ope and fecha_hasta = '0000-00-00'",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
		phpmkr_query("insert into historial_unidades values($var_num_ope,'$var_num_und','$var_fecha_actual','0000-00-00')",$conn) 
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	}
	//Modulo de Historial de Unidades de Operadores
	
	phpmkr_query("insert into autos_entregados values('$var_num_und',$var_num_ope,'$var_fecha_actual','$hora',$var_monto)",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
	
	
	$sSql="select financiado from autos where num_und = '$var_num_und'";
	$rs_cuo=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs_cuo = $rs_cuo->fetch_assoc())
	{$var_financiado=$row_rs_cuo['financiado'];}
	
	if($var_financiado==1)
	{
		$sSql="select * from operadores_auto_financiados where num_und = '$var_num_und' and num_ope = $var_num_ope";
		$rs_cuo=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		$contador = phpmkr_num_rows($rs_cuo);
		if($contador==0){
			
			$sSql="delete from operadores_auto_financiados where num_ope = $var_num_ope";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
			$sSql="update operadores set desde=0,hasta=364 where num_oper = $var_num_ope";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
			$sSql="insert into operadores_auto_financiados values('$var_num_und',$var_num_ope)";
			phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
			
		}	
	}
							
	return $var_inscripciones;

}

/**
 * 
 * @todo Funcion que las compras por codigo de producto
 * @author Jean Carlos Nuñez
 * @param string $var_cod_pro
 * @return arrays
 *  
 */ 

function buscar_productos_comprados_jq($var_cod_pro)
{
	global $conn;	
	
	$sSql="select p.descripcion,e.monto_uni,e.cantidad,pr.nombre,
	DATE_FORMAT(e.fecha, '%d/%m/%Y')as fecha,e.factura
	from entradas e,productos p,proveedores pr
	where e.cod_pro = $var_cod_pro and p.codigo = e.cod_pro and 
	e.cod_proveedor = pr.codigo order by e.fecha desc limit 50";
	
	//errores($sSql);

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	$i=0;
	if($con>0)
	{	
		while ($row_rs = $rs->fetch_assoc())
		{

			$retorno[$i] = $row_rs;
			$i=$i+1;
		}
	}
	else{
		$retorno=array('0'=>0);
	}	
	return $retorno;
};

/**
 * 
 * @todo Funcion que buscar unidad y operador y asignarla a la unidad para los servicios de taxi
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_codigo
 * @return int
 *  
 */ 

function asignar_unidad_servicion_taxi_jq($var_num_und,$var_codigo)
{
	global $conn;	
	
	$sSql="select num_ope from autos where num_und = '$var_num_und'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_num_ope = $row_rs['num_ope'];}

	$sSql="update rt_servicios set num_und='$var_num_und',num_ope=$var_num_ope,orden=0 where codigo = $var_codigo";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	$row_rs=array('0'=>1);	
	
	$row_rs=array('0'=>1);	
	return $row_rs;	
};

/**
 * 
 * @todo Funcion que buscar monto de caja menuda por empresa
 * @author Jean Carlos Nuñez
 * @param int $var_empresa
 * @return numeric(12,2)
 *  
 */ 

function modificar_monto_jq($var_empresa,$var_monto)
{
	global $conn;	
	$sSql="update caja_menuda set monto_actual=$var_monto where empresa = $var_empresa";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	$row_rs=array('0'=>1);	
	$row_rs=array('0'=>1);	
	return $row_rs;	
};
/**
 * 
 * @todo Funcion que buscar monto de caja menuda por empresa
 * @author Jean Carlos Nuñez
 * @param int $var_empresa
 * @return numeric(12,2)
 *  
 */ 

function buscar_monto_empresa_jq($var_empresa)
{
	global $conn;	
	$sSql="select monto_actual from caja_menuda where empresa = $var_empresa";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$var_contador = phpmkr_num_rows($rs);
	if($var_contador>0)
	{
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_monto_actual=array('0'=>$row_rs['monto_actual']);
			//$var_monto_actual=$row_rs['monto_actual'];
		}
	
	}
	else
	{
		$var_monto_actual=array('0'=>0);
	}

	return $var_monto_actual; 	
};


/**
 * 
 * @todo Funcion que guardan el pago de epago por operador para mostralo en cobros
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @param int $monto
 * @return array
 *  
 */ 
function guardar_epago_operador_jq($num_ope,$monto)
{
	global $conn;
	$con=0;	
	$sSql="delete from pagos_epago_operadores where num_ope = $num_ope ";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	if($monto>0)
	{	
		$sSql="insert into pagos_epago_operadores values($num_ope,$monto)";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	}
	
	$row_rs=array('0'=>1);	
	return $row_rs;
};

/**
 * 
 * @todo Funcion que busca los epago dentro de 7 dias por operador
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @return numeric
 *  
 */ 
function buscar_pagos_epago($num_ope)
{
	global $conn;	
	//$sSql="select * from tickets where num_ope = $num_ope and date_sub(curdate(),interval 7 day) <=fecha_impresion and tipo_pago = 3 group by numero_ticket ";
	$sSql="select buscar_pagos_epago($num_ope) as filas";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{
		$con=$row_rs['filas'];
	}
	
	return $con;
};

/**
 * 
 * @todo Funcion que hacer cierre de caja menuda
 * @author Jean Carlos Nuñez
 * @return array
 *  
 */ 
function cierre_jq()
{
	global $conn;	
	$sSql="update caja_menuda_hist set cierre = 0 where cierre=1 and tipo_movimiento <> 'INGRESO DE DINERO EN CAJA MENUDA'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};

/**
 * 
 * @todo Funcion que buscar numero de operador para facturar ipago
 * @author Jean Carlos Nuñez
 * @param int $cedula
 * @return array
 *  
 */ 
function buscar_operador_numero_jq($num_ope)
{
	global $conn;
	
	
	$sSql="select a.num_und from autos a,operadores o where o.num_oper = $num_ope 
	and a.num_und = o.num_und_asig";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}	
	return $row_rs;
};


/**
 * 
 * @todo Funcion que ingreso de usuario y fecha de consolidacion de bolsa de dinero en banco
 * @author Jean Carlos Nuñez
 * @param int $codigo_temp
 * @param date $fecha
 * @return array
 *  
 */
  
function consolidado_jq($codigo_temp,$fecha,$detalle,$var_cod_usu)
{
	global $conn;
	$fecha = fecha_sql($fecha);
	$sSql="update bolsa_dinero 
		set 
		fecha_consolidado = '$fecha',
		detalle_consolidado='$detalle',
		cod_usu_con=$var_cod_usu 
		where 
		numero_comprobante = '$codigo_temp'";
	errores($sSql);
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$row_rs=array('0'=>1);
	return $row_rs;
}
/**
 * 
 * @todo Funcion que cambio de fecha de entrega consignatario
 * @author Jean Carlos Nuñez
 * @param int $codigo_temp
 * @param date $fecha
 * @return array
 *  
 */
  
function entrega_jq($codigo_temp,$fecha,$detalle)
{
	global $conn;
	$fecha = fecha_sql($fecha);
	$sSql="update bolsa_dinero set entrega_consignatario = '$fecha',detalle='$detalle' where numero_comprobante = '$codigo_temp'";
	errores($sSql);
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$row_rs=array('0'=>1);
	return $row_rs;
}

/**
 * 
 * @todo Funcion que eliminar sello de tabla de bolsa de dinero
 * @author Jean Carlos Nuñez
 * @param string $numero_comprobante
 * @param string $numero_sello
 * @return array
 *  
 */
  
function eliminar_numero_sello_n_jq($codigo_temp,$numero_sello)
{
	global $conn;
	$sSql="delete from bolsa_dinero  where codigo = $codigo_temp and numero_sello = '$numero_sello'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$row_rs=array('0'=>1);
	return $row_rs;
}


/**
 * 
 * @todo Funcion que eliminar sello e tabla de bolsa de dinero temporal
 * @author Jean Carlos Nuñez
 * @param string $numero_comprobante
 * @param string $numero_sello
 * @return array
 *  
 */
  
function eliminar_numero_sello_jq($codigo_temp,$numero_sello)
{
	global $conn;
	$sSql="delete from bolsa_dinero_temp  where codigo = $codigo_temp and numero_sello = '$numero_sello'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$row_rs=array('0'=>1);
	return $row_rs;
}


/**
 * 
 * @todo Funcion que busca numero de sello por comprobante
 * @author Jean Carlos Nuñez
 * @param string $numero_comprobante
 * @param string $numero_sello
 * @return array
 *  
 */
  
function buscar_numero_sello_jq($numero_comprobante,$numero_sello)
{
	global $conn;
	$sSql="select * from bolsa_dinero_temp  where numero_comprobante = '$numero_comprobante' and numero_sello = '$numero_sello'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs=array('0'=>1);
	}
	else
	{
		$row_rs=array('0'=>0);
	}
	return $row_rs;
}

/**
 * 
 * @todo Funcion que buscar numero de unidad para facturar ipago
 * @author Jean Carlos Nuñez
 * @param int $var_cod_sini_des
 * @param int $var_cod_usu
 * @param int $var_num_ope
 * @return array
 *  
 */ 
function unir_siniestros_jq($var_cod_sini_des,$var_cod_usu,$var_num_ope,$tipo)
{
	global $conn;
	
	$sSql="select sum(monto) as monto from siniestros where codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_sini = $row_rs['monto'];}
	
	$sSql="select sum(monto) as monto from siniestros where codigo = $var_cod_sini_des";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_sini_des = $row_rs['monto'];}
	
	if($tipo==1){
	$var_monto_sini_des=0;}
	
	
	$var_monto = $var_monto_sini_des+$var_monto_sini;
	
	$sSql="select anotaciones from siniestros where codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_anotaciones .= $row_rs['anotaciones']."  ";}
	
	$sSql="select anotaciones from siniestros where codigo = $var_cod_sini_des";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_anotaciones .= $row_rs['anotaciones']."  ";}
	
	
	$sSql="update siniestros set monto = $var_monto,monto_restante=$var_monto,anotaciones='$var_anotaciones' where codigo = $var_cod_sini_des";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	
	
	$sSql="insert into siniestros_rep (codigo, num_ope, fecha, monto_restante, monto, monto_global, estado_pendientes, cedula, cod_usu, num_und, 
	cod_ase, resolucion, anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, estado_siniestro, cheque_efectivo, monto_pago_aseguradora, 
	tipo,cod_sini) select codigo, num_ope, fecha, monto_restante, monto, monto_global, estado_pendientes, cedula, cod_usu, num_und, cod_ase, resolucion, 
	anotaciones, nro_resolucion, fecha_resolucion, nro_reclamo, estado_siniestro, cheque_efectivo, monto_pago_aseguradora,tipo,$var_cod_sini_des
	FROM siniestros where codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$sSql="update siniestros_hist set cod_sini = $var_cod_sini_des where cod_sini in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	
	
	$sSql="delete from siniestros where codigo in (select cod_sini from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu)";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$sSql="delete from repuestos_operador where num_ope = $var_num_ope and cod_usu = $var_cod_usu";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	auditoria($var_cod_usu,"SE PASO REPUESTO PARA SINIESTROS:".$var_cod_sini_des,$conn);
	
	$row_rs=array('0'=>1);	
	return $row_rs;
};


/**
 * 
 * @todo Funcion agrega repuesto temporal a siniestro por usuario
 * @author Jean Carlos Nuñez
 * @param int $sini
 * @param int $cod_usu
 * @param int $num_ope
 * @param int $accion
 * @return array
 *  
 */ 
function agregar_repuestos_jq($sini,$cod_usu,$num_ope,$accion)
{
	global $conn;
	
	$con=0;
	$sSql="select * from repuestos_operador where num_ope = $num_ope and cod_usu = $cod_usu";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	
	if ($con>0){
		
		$sSql="delete from repuestos_operador where cod_sini = $sini and num_ope = $num_ope and cod_usu = $cod_usu";
		$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		
	}
	
	if($accion==1){
	$sSql="insert into repuestos_operador values($sini,$num_ope,$cod_usu)";$row_rs=array('0'=>1);}
	
	if($accion==0){
	$sSql="delete from repuestos_operador where cod_sini = $sini and num_ope = $num_ope and cod_usu = $cod_usu";$row_rs=array('0'=>2);	}
	
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	return $row_rs;
};


/**
 * 
 * @todo Funcion que escribe foto para ser mostrara
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @return string
 *  
 */ 
function escribir_foto($num_ope,$conn)
{

	$path="foto/";
	$fileExtension=array("image/jpeg"=>".jpg");
	
	$sSql="select foto from operadores_fotos where num_ope = $num_ope";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc()) 
	{  			
		$var_logo=$row_rs['foto'];			
	}	
			
	$var_nombre_foto = make_seed();	
	file_put_contents($path.$var_nombre_foto.$fileExtension['image/jpeg'],$var_logo, FILE_APPEND);

	
	return $var_nombre_foto;
}



/**
 * 
 * @todo Funcion que buscar numero de unidad para facturar ipago
 * @author Jean Carlos Nuñez
 * @param int $cedula
 * @return array
 *  
 */ 
function buscar_operador_cedula_jq($cedula)
{
	global $conn;
	
	
	$sSql="select a.num_und from autos a,operadores o where o.cedula = '$cedula' and a.num_und = o.num_und_asig";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}	
	return $row_rs;
};

/**
 * 
 * @todo Funcion que busca el monto de diario para calcular su descuento de ipago
 * @author Jean Carlos Nuñez
 * @param decimal $monto
 * @param int $num_ope
 * @param int $numero_ticket
 * @param string $var_num_und
 * @param int $var_cod_usu
 * @param decimal $var_monto_ipago
 * @param int $empresa
 * @return decimal
 *  
 */
 
function monto_ipago($monto,$num_ope,$numero_ticket,$num_und,$var_cod_usu,$var_monto_ipago,$empresa)
{
  	global $conn;
	$var_hora=hora_aplicacion($conn);
	$var_fecha=fecha_aplicacion($conn);
	
	$rs=phpmkr_query("select ipago from codigos ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_ipago=$row_rs['ipago']+1;}
	
	$rs=phpmkr_query("update codigos set ipago = $var_ipago ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$sSql="insert into ipago values($var_ipago,$num_ope,'$num_und','$var_fecha','$var_hora',$var_cod_usu,$numero_ticket,$var_monto_ipago,$empresa)";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	auditoria($var_cod_usu,"CREO TICKET DE IPAGO CON NUMERO: ".$numero_ticket." DEL OPERADOR: ".$num_ope." CON MONTO: ".$var_monto_ipago,$conn);		
	$monto=$monto-$var_monto_ipago;
	
	return $monto;
	
}
/**
 * 
 * @todo Funcion que ingresa los operadores por odm temporalmente.
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @param int $odm
 * @param string $num_und
 * @return array
 *  
 */ 
function operador_orden_mantenimiento_jq($num_ope,$odm,$num_und)
{
	global $conn;
	
	$sSql="delete from operadores_odm where odm = $odm";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	$sSql="insert into operadores_odm values($num_ope,$odm,$num_und,0)";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};

/**
 * 
 * @todo Funcion que aprueba el operador de la orden de mantenimiento
 * @author Jean Carlos Nuñez
 * @param int $num_ope
 * @param int $odm
 * @param string $num_und
 * @return array
 *  
 */ 
function aprobar_operador_orden_mantenimiento_jq($num_ope,$odm,$num_und)
{
	global $conn;
	
	$sSql="update operadores_odm set aprobar = 1 where odm = $odm";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};


function filesize_format($bytes, $format = '', $force = ''){
	$bytes=(float)$bytes;
	if ($bytes <1024){
		$numero=number_format($bytes, 0, '.', ',');
		return array($numero,"B");
	}
	if ($bytes <1048576){
		$numero=number_format($bytes/1024, 2, '.', ',');
		return array($numero,"KBs");
	}
	if ($bytes>= 1048576){
		$numero=number_format($bytes/1048576, 2, '.', ',');
		return array($numero,"MB");
	}
}
/**
 * 
 * @todo Funcion que elimina los productos de las odc temporales
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @return array
 *  
 */ 
function eliminar_pro_odc_jq($var_cod_pro,$var_cod_ent)
{
	global $conn;
	
	$sSql="delete from odc_temp  where codigo = $var_cod_ent and cod_pro = $var_cod_pro";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};

/**
 * 
 * @todo Funcion convierte la hora de 12 a 24 horas
 * @author Jean Carlos Nuñez
 * @param string $var_hora
 * @return string
 *  
 */
 
function conversion_1224_mysql($var_hora)
{
  	global $conn;

	$rs=phpmkr_query("select * from operaciones_generales ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_hora_termino_dia=$row_rs['hora_termino_dia'];}

	
	return $var_monto_diario;
	
				

				
}




/**
 * 
 * @todo Funcion que busca el monto de diario para calcular su descuento
 * @author Jean Carlos Nuñez
 * @param int $var_num_ope
 * @param string $var_num_und
 * @return decimal
 *  
 */
 
function calculo_diario($var_num_ope,$var_num_und)
{
  	global $conn;

	$rs=phpmkr_query("select * from operaciones_generales ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_hora_termino_dia=$row_rs['hora_termino_dia'];}

	$var_monto_diario_hora=0;
	$rs=phpmkr_query("select monto_diario from autos where num_und = '$var_num_und' and financiado = 0 ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_monto_diario_hora=number_format($row_rs['monto_diario']/24,2);}	
	
	$var_hora=hora_aplicacion($conn);
	//echo $var_hora;
	$var_fecha_actual = fecha_aplicacion($conn);
	
	$var_cantidad_horas=RestarHoras($var_hora,$var_hora_termino_dia);
	//echo $var_cantidad_horas;
	$var_monto_diario = $var_monto_diario_hora * $var_cantidad_horas;
	
	return $var_monto_diario;
	
				

				
}

/**
 * 
 * @todo Funcion que busca nombre de usuario
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param db $conn
 * @return array
 *  
 */
function nombre_usuario($var_cod_usua)
{
  global $conn;
  
  $sSql="select nombre from usuarios  where codigo = $var_cod_usua";
  $rs2=phpmkr_query($sSql,$conn) 
  or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
  while ($row_rs2 = $rs2->fetch_assoc())
  {
    return $row_rs2['nombre'];
  }
}


/**
 * 
 * @todo Funcion que busca operadores en la base de datos de yellowcar
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param db $conn
 * @return array
 *  
 */
  
function buscar_unidad_operador_jq($var_num_und)
{
	global $conn;
	
	/*$sSql="select o.num_oper,o.num_und_asig,o.cedula,o.celular1,concat(o.nombre,' ',o.apellido) as nombre from operadores o,autos a 
	where o.num_und_asig = a.num_und and a.num_und = '$var_num_und' limit 1";*/
	
	$sSql="select o.num_oper,a.num_und,o.cedula,o.celular1,concat(o.nombre,' ',o.apellido) as nombre from autos a
	left JOIN operadores o ON o.num_und_asig=a.num_und where a.num_und = '$var_num_und' limit 1";
		
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>999999);}
	return $row_rs;
}

/**
 * 
 * @todo Funcion que determina si puede pagar o no por epago
 * @author Jean Carlos Nuñez
 * @param int $var_num_ope
 * @return int
 *  
 */
function calculo_epagos_operador($var_num_ope)
{
	global $conn;
	$con=1;
	$sSql="select calcular_pagos_epagos($var_num_ope) as filas";
	$rs_c=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	while ($row_rs_c = $rs_c->fetch_assoc())
	{
		$con = $row_rs_c['filas'];
	}
	
	return $con;
};


/**
 * 
 * @todo Funcion que regresa los dias pagados por operador
 * @author Jean Carlos Nuñez
 * @param int $var_num_ope
 * @return int
 *  
 */
function cantidad_dias_operador($var_num_ope)
{
	global $conn;
	$con=0;
	$sSql="select cantidad_dias_operador($var_num_ope) as filas";
	$rs_c=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	
	while ($row_rs_c = $rs_c->fetch_assoc())
	{
		$con = $row_rs_c['filas'];
	}
	
	return $con;
};


/**
 * 
 * @todo Funcion que los cargos de los pasajeros
 * @author Jean Carlos Nuñez
 * @return array
 *  
 */
function cargos_pasajeros_jq()
{
	global $conn;
	
	$sSql="select codigo,descripcion from cargos where estado=1 Order by codigo";	
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		while ($row_rs = $rs->fetch_assoc())
		{
			$var_resultado[] = $row_rs;
		}
		
	}
	else{$var_resultado[]=array('codigo'=>0);}	
	return $var_resultado;
};

/**
 * 
 * @todo Funcion que valida la ip autorizada
 * @author Jean Carlos Nuñez
 * @param string $ip
 * @return int
 *  
 */
function validar_ip_autorizada($ip)
{
	global $conn;
	
	$contador=0;
	$rs=phpmkr_query("select count(*) as contador from ip_autorizadas where ip = '".$ip."'",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$contador=$row_rs['contador'];}
	return $contador;

}

/**
 * 
 * @todo Funcion que elimina los productos de las entradas temporales
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @return array
 *  
 */ 
function eliminar_pro_ent_jq($var_cod_pro,$var_cod_ent)
{
	global $conn;
	
	$sSql="delete from entradas_temp  where codigo = $var_cod_ent and cod_pro = $var_cod_pro";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};



/**
 * 
 * @todo Funcion aprueba servicos de copa por unidad
 * @author Jean Carlos Nuñez
 * @param string $id_pas
 * @return array
 *  
 */
 
function aprobar_jq($codigo,$control_aleatorio,$monto)
{
	global $conn; 
	$sSql="update copa set estado = 2,monto=$monto where codigo = $codigo and control_aleatorio = '$control_aleatorio'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	$row_rs=array('0'=>1);	
	return $row_rs;
}


/**
 * 
 * @todo Funcion aprueba servicos de copa por unidad
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_num_ope
 * @return array
 *  
 */
 
function buscar_copa_detalle($var_num_und,$var_num_ope)
{
	global $conn;
	$con=0; 
	$sSql="select control_aleatorio,monto from copa where unidad = '$var_num_und' and num_ope = $var_num_ope and estado = 2";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$detalle[]= "Codigo: ".$row_rs['control_aleatorio']." Monto : ".$row_rs['monto'];
		}
	}
	else
	{
		$detalle[]="";
	}
	
	return $detalle;
}



/**
 * 
 * @todo Funcion que cambia el estado de un servico de copa a pagado
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_num_ope
 * @param int $var_numero_tic
 * @return null
 *  
 */
 
function copa_pagado($var_num_und,$var_num_ope,$var_numero_tic)
{
	global $conn; 
	$sSql="select control_aleatorio from copa where unidad = '$var_num_und' and num_ope = $var_num_ope and estado = 2";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_control_aleatorio = $row_rs['control_aleatorio'];

		$sSql="insert into copa_opeador_ticket values('$var_control_aleatorio',$var_numero_tic,$var_num_ope,$var_num_und)";
		phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	}


	$sSql="update copa set estado = 3 where unidad = '$var_num_und' and num_ope = $var_num_ope and estado = 2";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

}

/**
 * 
 * @todo Funcion aprueba servicos de copa por unidad
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_num_ope
 * @return int
 *  
 */
 
function buscar_copa($var_num_und,$var_num_ope)
{
	global $conn;
	$con=0; 
	$sSql="select sum(monto) as monto from copa where unidad = '$var_num_und' and num_ope = $var_num_ope and estado = 2";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_monto = $row_rs['monto'];
		}
	}
	else
	{
		$var_monto = 0;
	}
	
	return $var_monto;
}


/**
 * 
 * @todo Funcion que busca numero aleatorio apartir de una semilla
 * @author Jean Carlos Nuñez
 * @return int
 *  
 */

function make_seed()
{
  list($usec, $sec) = explode(' ', microtime());
  srand((float) $sec + ((float) $usec * 10));
  $randval = rand();
  return $randval; 
}




/**
 * 
 * @todo Funcion que busca los datos de los pasajeros para servicio de copa
 * @author Jean Carlos Nuñez
 * @param string $id_pas
 * @return array
 *  
 */
 
function buscar_pasajeros_jq($id_pas)
{
	global $conn; 
	$conn->set_charset("utf8");
	$sSql="select nombre,cargo,cedula,telefono from pasajeros where id = '$id_pas'";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		
	}else{$row_rs=array('0'=>0);}
	
	return $row_rs;
}




/**
 * 
 * @todo Funcion que modifica la unidad y el kilometraje en la salida
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @return array
 *  
 */ 
function modificar_unidad_salida($var_num_und,$var_kilometraje,$var_salida)
{
	global $conn;
	
	$sSql="update salidas set kilometraje = $var_kilometraje,num_und = $var_num_und  where codigo = $var_salida";
	phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$row_rs=array('0'=>1);	
	return $row_rs;
};


/**
 * 
 * @todo Funcion buscar por numero de unidad el kilometraje de las unidades
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @return array
 *  
 */ 
function buscar_auto_salidas_jq($var_num_und)
{
	global $conn;
	
	$sSql="select kilometraje,cobrar from autos where num_und = '$var_num_und'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}	
	return $row_rs;
};

/**
 * 
 * @todo Funcion buscar por numero de unidad el kilometraje de las unidades
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @return array
 *  
 */ 
function errores($str)
{
	error_log($str, 0);
}


/**
 * 
 * @todo Funcion calcular cuanta memoria se usa por cada scritp invocadop
 * @author Jean Carlos Nuñez
 * @param string $archivo
 * @param string $memoria
 * @param dn $conne
 * @return Null
 *  
 */ 
function memoria($archivo,$memoria,$conne)
{
	$hora = date("H:i:s");
	$fecha = date("Y-m-d");
	$memoria=($memoria/1024)/1024;
	$sSql="insert into uso_memoria values('$archivo',$memoria,'$fecha','$hora');";
	phpmkr_query($sSql,$conne);
}
/**
 * 
 * @todo Funcion para calculo de lo facturado por los usuarios del sistema
 * @author Jean Carlos Nuñez
 * @param int $var_cod_usu
 * @param date $var_fecha
 * @return decimal
 *  
 */ 
function facturacion_usuario_monto_actual_todo($var_cod_usu_cajero,$var_fecha)
{

	global $conn; 	
	
	$sSql="select codigo from usuarios where estado = 1 and codigo = ".$var_cod_usu_cajero."";
	$rs_usu = mysqli_query($conn,$sSql);
	while ($row_rs_usu = mysqli_fetch_array($rs_usu))
	{		
		$var_cod_usu = $row_rs_usu['codigo'];
		$sSql="select sum(monto_dia) as monto_pagado
		from tickets where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets=$rs_tickets_data['monto_pagado'];}
		if($tickets==""){$tickets=0;}

		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu."";
		//echo $sSql;
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		if($siniestro==0){$siniestro=0;}
		
		$siniestro_dev=0;
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo = 3 and tipo_pago <> 3";
		$rs_siniestros_dev = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data_dev = mysqli_fetch_array($rs_siniestros_dev))
		{$siniestro_dev=$rs_siniestros_data_dev['monto_pagado'];}
		if($siniestro_dev==0){$siniestro_dev=0;}else{$siniestro_dev=$siniestro_dev*(-1);}
		
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo <> 3 and tipo_pago <> 3";
		//echo $sSql;
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		if($siniestro==0){$siniestro=0;}
		
		

		$sSql="select sum(monto) as monto_pagado
		from multas_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_multas = mysqli_query($conn,$sSql);
		while ($rs_multas_data = mysqli_fetch_array($rs_multas))
		{$multas = $rs_multas_data['monto_pagado'];}
		if($multas==""){$multas=0;}

		$sSql="select sum(monto) as monto_pagado
		from inscripciones_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_inscripciones = mysqli_query($conn,$sSql);
		while ($rs_inscripciones_data = mysqli_fetch_array($rs_inscripciones))
		{$inscripciones = $rs_inscripciones_data['monto_pagado'];}
		if($inscripciones==""){$inscripciones=0;}

		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro = $rs_ahorro_data['monto_pagado'];}
		if($ahorro==""){$ahorro=0;}
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorro_dias_feriados_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_ahorro_feriados = mysqli_query($conn,$sSql);
		while ($rs_ahorro_feriados_data = mysqli_fetch_array($rs_ahorro_feriados))
		{$ahorro_feri = $rs_ahorro_feriados_data['monto_pagado'];}
		if($ahorro_feri==""){$ahorro_feri=0;}

		$sSql="select sum(monto_facturado) as monto_pagado
	    from cuadre_caja where cod_usu_cajero = $var_cod_usu and fecha = '".$var_fecha."' and '$var_fecha'";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia = $rs_cuadre_caja_data['monto_pagado'];}   
		if($diferencia==""){$diferencia=0;}

		$sSql="select sum(monto_calculado) as monto_pagado
	    from cuadre_caja where cod_usu_cajero = $var_cod_usu and fecha = '".$var_fecha."' and '$var_fecha'";
	    //echo $sSql;
	    $rs_monto_calculado = mysqli_query($conn,$sSql);
	    while ($rs_monto_calculado_data = mysqli_fetch_array($rs_monto_calculado))
	    {$monto_calculado = $rs_monto_calculado_data['monto_pagado'];}
		    
		if($monto_calculado==""){$monto_calculado=0;}
	    
	    $sSql="select sum(diferencia) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia_real = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia_real==""){$diferencia_real=0;}
	        
	    $diferencia = $diferencia_real + $diferencia + $monto_calculado ;
	    //echo " -".$diferencia."- ";
	    
	    $total_facturado = (($tickets+$siniestro+$multas+$inscripciones+$ahorro+$ahorro_feri+$ahorro_rep+$siniestro_dev)-($diferencia));
	    if($total_facturado<=0){$total_facturado=0.00;}
	}
	return $total_facturado;
};

/**
 * 
 * @todo Funcion para creacion de modal
 * @author Jean Carlos Nuñez
 * @param string $var_num_und
 * @param int $var_num_ope
 * @param int $var_empresa
 * @param date $var_fecha_desde
 * @param date $var_fecha_hasta
 * @return html
 *  
 */ 
function creacion_modal($var_num_und,$var_num_ope,$var_empresa,$var_fecha_desde,$var_fecha_hasta)
{
	$sSql="select fecha_impresion,monto_dia,kilometros from compuzul_nucleo_1.tickets 
	where num_auto ='".$var_num_und."' and 
	fecha_impresion between '".$var_fecha_desde."' and '".$var_fecha_hasta."' and num_ope = ".$var_num_ope."";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	

		echo "
			<div id='renta<?php echo $var_num_und; ?>' class='modal hide fade' tabindex='' width='' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
			  <div class='modal-header'>
			  <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
			  <h3 id='myModalLabel'>Detalle de Renta Diaria</h3>
			  </div>
			  <div class='modal-body'>
			  <table class='table table-hover' border='1'>
			    <tr>
			      <td>
			        Auto
			      </td>
			      <td title='Fecha de Impresion de Ticket'>
			        Fecha de Imp.
			      </td>
			      <td title='Fecha de Pago de Diario'>
			        Fecha Dia.
			      </td>
			      <td>
			        Monto Pagado
			      </td>
			      <td>
			        Kilometraje
			      </td>
			    </tr>";
			     
					while ($row_rs = $rs->fetch_assoc())
					{
						$var_fecha_impresion=$row_rs['fecha_impresion'];
						$var_monto_dia=$row_rs['monto_dia'];
						$var_kilometros=$row_rs['kilometros'];
			    
			    
			    echo "
			    <tr>
			      <td>
			      	$var_fecha_impresion;
			      </td>
			      <td>

			      </td>
			      <td>

			      </td>
			      <td>

			      </td>
			      <td>
			        
			      </td>
			    </tr>
			    ";
			}
			   echo "
			  </table>
			  </div>
			  <div class='modal-footer'>
			  <button class='btn' data-dismiss='modal'>Cerrar</button>
			  
			  </div>
			</div>
		";	
}

/**
 * 
 * @todo Funcion que registra en el secret los operadores
 * @author Jean Carlos Nuñez
 * @param db $conn
 * @param string $descripcion
 * @param string $cedula
 * @param string $nombre_operador
 * @param int $cod_empresa_sc
 * @return Null
 *  
 */ 
function operadores_secret($conn,$descripcion,$cedula,$nombre_operador,$cod_empresa_sc)
{
	$rs=phpmkr_query("select secret from codigos ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_secret=$row_rs['secret']+1;}

	$rs=phpmkr_query("select codigo from item_secret where descripcion='".$descripcion."'",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_codigo_item=$row_rs['codigo'];}
	$hora=date("H:i:s");
	$fecha_actual=fecha_aplicacion($conn);
	$sSql="insert into secret_general values($var_secret,'$fecha_actual','$hora',
	$var_codigo_item,'$cedula',3,'$descripcion','$nombre_operador',$cod_empresa_sc)";
	phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);

	phpmkr_query("update codigos set secret = ".$var_secret."",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
}
/**
 * 
 * @todo Funcion regresa horas restadas
 * @author Jean Carlos Nuñez
 * @param time $inicio
 * @param time $fin
 * @return time
 *  
 */ 
function restar_horas($inicio, $fin)
{
	$dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
	return $dif;
}
/**
 * 
 * @todo Funcion busca las unidades agendadas para mantenimiento por hora,fecha
 * @author Jean Carlos Nuñez
 * @param time $var_hora
 * @param date $var_fecha
 * @param db $conn
 * @param int $var_tipo
 * @return string
 *  
 */ 
function buscar_hora_und($var_hora,$var_fecha,$conn,$var_tipo) 
{
	$var_hora=conversion_hora24($var_hora);
	$var_fecha=$var_fecha;
	$var_unidades[]="";
	$unidades="";
	
	$sSql="select num_und from agenda_mantenimientos where hora ='".$var_hora."' and fecha = '".$var_fecha."' and tipo=$var_tipo";
	
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
	$con = phpmkr_num_rows($rs);
	while ($row_rs = $rs->fetch_assoc())
	{
		
		$unidades .= $row_rs['num_und']." y ";;
		
		
	}
	
	if($con==0){$unidades = "Ninguna";} 
	
	if($unidades<>"Ninguna"){
	$var_len = strlen($unidades);
	
	return substr($unidades,0,$var_len-2) ;}
	
	return $unidades;
}

/**
 * 
 * @todo Funcion busca el color por mantenimiento asignado a la unidad
 * @author Jean Carlos Nuñez
 * @param time $var_hora
 * @param date $var_fecha
 * @param db $conn
 * @param int $var_tipo
 * @return string
 *  
 */ 
function buscar_color_hora($var_hora,$var_fecha,$conn,$var_tipo) 
{
	$var_hora=conversion_hora24($var_hora);
	$var_fecha=$var_fecha;

	$sSql="select count(*) as contador from agenda_mantenimientos where hora ='".$var_hora."' and fecha = '".$var_fecha."' and tipo = $var_tipo";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);	
	while ($row_rs = $rs->fetch_assoc())
	{$var_contador = $row_rs['contador'];}

	if($var_contador==1){return "chartreuse";}
	if($var_contador>=2){return "red";}
	if($var_contador==0){return "black";}
}
/**
 * 
 * @todo Funcion que determina si un ticket de siniestros esta duplicado en el sistema y no deja factora
 * @author Jean Carlos Nuñez
 * @param int $var_numero_ticket
 * @param int $var_num_ope
 * @param db $conn
 * @return boolean
 *  
 */ 
function tickets_duplicados_sini($var_numero_ticket,$var_num_ope,$conn) 
{
	$var_contador=0;
	
	$today=fecha_aplicacion($conn);
	$hora = date('H:i:s');

	$sSql="select count(*) as contador from siniestros_hist where codigo = ".$var_numero_ticket." 
	and num_ope =".$var_num_ope."";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);	

	while ($row_rs = $rs->fetch_assoc())
	{
		$var_contador = $row_rs['contador'];
	}

	if($var_contador>0)
	{
		return true;
	}
	else
	{
		return false;
	}	
}
/**
 * 
 * @todo Funcion determinado si un ticket de renta diara esta duplicado
 * @author Jean Carlos Nuñez
 * @param int $var_numero_ticket
 * @param int $var_num_ope
 * @param string $var_num_und
 * @param int kilometraje
 * @param int $var_empresa
 * @param db conn
 * @return boolean
 *  
 */ 
function tickets_duplicados($var_numero_ticket,$var_num_ope,$var_num_und,$var_kilometraje,$var_empresa,$conn) 
{
	$var_contador=0;
	
	$today=fecha_aplicacion($conn);
	$hora = date('H:i:s');

	$sSql="select count(*) as contador from tickets where numero_ticket = ".$var_numero_ticket." 
	and num_ope =".$var_num_ope." and kilometros = ".$var_kilometraje." and empresa =".$var_empresa."";
	$rs=phpmkr_query($sSql,$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);

	

	while ($row_rs = $rs->fetch_assoc())
	{
		$var_contador = $row_rs['contador'];
	}

	if($var_contador>0)
	{
		phpmkr_query("insert into tickets_duplicados values('$var_num_und',$var_num_ope,$var_empresa,
		$var_numero_ticket,$var_kilometraje,'$today','$hora')",$conn)
		or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
		return true;
	}
	else{return false;}	
}
/**
 * 
 * @todo Funcion regresa la fecha del motor de base de datos
 * @author Jean Carlos Nuñez
 * @param db $conne
 * @return date
 *  
 */ 
function fecha_aplicacion_mysql($conne) 
{
	$rs=phpmkr_query("select curdate() as fecha",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{return $row_rs['fecha'];}		

}
/**
 * 
 * @todo Funcion regresa la fecha del sistema
 * @author Jean Carlos Nuñez
 * @param db $conne
 * @return date
 *  
 */  
function fecha_aplicacion($conne) 
{
	$rs=phpmkr_query("select fecha from fecha_aplicacion",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{return $row_rs['fecha'];}		

}
/**
 * 
 * @todo Funcion regresa la hora del motor de base de datos
 * @author Jean Carlos Nuñez
 * @param db $conne
 * @return time
 *  
 */ 
function hora_aplicacion($conne) 
{
	$rs=phpmkr_query("select curtime() as hora",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{return $row_rs['hora'];}	
}
/**
 * 
 * @todo Funcion que regresa un mensaje en javascript
 * @author Jean Carlos Nuñez 
 * @return string
 *  
 */  
function validar_acciones_operadores()
{
	echo "<script>\n";
	echo "function validar_acciones_operador(valor,num_ope)\n";
	echo "{\n";
	echo "if(valor=='1'){alert('EL REGISTRO FUE INSERTADO CON EXITO!,CON ESTE NUMERO DE OPERADOR: '+num_ope);} \n"; 	
	echo "if(valor=='2'){alert('EL REGISTRO FUE MODIFICADO CON EXITO!');} \n"; 
	echo "if(valor=='3'){alert('EL REGISTRO FUE ELIMINADO CON EXITO!');} \n"; 		
	echo "	}\n";
	echo "</script>\n";
	
};

/**
 * 
 * @todo Funcion que regresa el nombre de la aplicacion para servicios de taxi
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */ 
 
function nombre_aplicacion_copa(){
	return "Servicios de Taxi";
}
/**
 * 
 * @todo Funcion que regresa el nombre de la aplicacion con su version
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */ 
 
function nombre_aplicacion(){
	return "Taxi Control On Line, v3.5 - (YellowCar)";
}

/**
 * 
 * @todo Funcion quita caracteres extranos de una cadena
 * @author Jean Carlos Nuñez
 * @param string $cadena
 * @return string
 *  
 */ 
function quitar_caracteres_raros($cadena){
   $caracteres = "-";
   $caracteres = explode(' ',$caracteres);
   $nchar      = count($caracteres);
   $base       = 0;
   while($base<$nchar){
      $cadena = str_replace($caracteres[$base],'',$cadena);
      $base++;
   }
   return $cadena;
}
/**
 * 
 * @todo Funcion quita caracteres extranos de una cadena
 * @author Jean Carlos Nuñez
 * @param string $cadena
 * @return string
 *  
 */
function quitar_caracteres_raros2($cadena){
   $caracteres = "'";
   $caracteres = explode(' ',$caracteres);
   $nchar      = count($caracteres);
   $base       = 0;
   while($base<$nchar){
      $cadena = str_replace($caracteres[$base],'',$cadena);
      $base++;
   }
   return $cadena;
}
/**
 * 
 * @todo Funcion quita caracteres extranos de una cadena
 * @author Jean Carlos Nuñez
 * @param string $var_ip
 * @param time $var_hora
 * @param date $var_fecha
 * @return mail
 *  
 */
function envio_coreo($var_ip,$var_hora,$var_fecha)
{
	$to      = 'jeancarlosn@hotmail.com';
	$subject = 'IP QUE ESTA VIENDO LA PAGINA TAXICONTROL';
	$message = 'Direccion Ip '.$var_ip."\r\n"."Fecha: ".fecha($var_fecha)."\r\n"."Hora: ".conversion_hora($var_hora)."\r\n";
	$headers = 'From: administrador@compuzulia.net' . "\r\n".
	    'Reply-To: administrador@compuzulia.net' . "\r\n" .
	    'X-Mailer: PHP/' . phpversion();		
	mail($to, $subject, $message, $headers);
}

/**
 * 
 * @todo Funcion deprecada de estilo de la aplicacion
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function estilo()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from operaciones_generales ");
	while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_icono=$row_rs['icono'];$var_hoja_estilo=$row_rs['hoja_estilo'];
	}

echo $var_icono."\n";
echo $var_hoja_estilo."\n";
}

/**
 * 
 * @todo Funcion resta horas
 * @author Jean Carlos Nuñez
 * @param time $horaini
 * @param time $horafin
 * @return string
 *  
 */
function RestarHoras($horaini,$horafin)
{
	$horai=substr($horaini,0,2);
	$horaf=substr($horafin,0,2);
	$hora_total = $horaf - $horai;
	return $hora_total;
}
/**
 * 
 * @todo Funcion pasa datos a un frame
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function pasar_al_iframe()
{
	echo " <script type='text/javascript'>\n";
	echo "function pasar_al_iframe(url){\n";	
    echo " $('#myFrame').attr('src', 'url');\n";
    
	echo " }\n";
	echo "</script>\n";
		
}
/**
 * 
 * @todo Funcion convierte un numero al nombre del mes del ano
 * @author Jean Carlos Nuñez
 * @param int $mes
 * @return string
 *  
 */
function convertir_mes($mes)
{
	if($mes==1){return "Enero";}
	if($mes==2){return "Febrero";}
	if($mes==3){return "Marzo";}
	if($mes==4){return "Abril";}
	if($mes==5){return "Mayo";}
	if($mes==6){return "Junio";}
	if($mes==7){return "Julio";}
	if($mes==8){return "Agosto";}
	if($mes==9){return "Septiembre";}
	if($mes==10){return "Octubre";}
	if($mes==11){return "Noviembre";}
	if($mes==12){return "Diciembre";}
}
/**
 * 
 * @todo Funcion cabecera de una funcion de javascript
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_1()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
}
/**
 * 
 * @todo Funcion de acciones con el teclado atraves de javascript
 * @author Jean Carlos Nuñez
 * @param int $tecla
 * @param string $archivo
 * @return string
 *  
 */
function teclas_2($tecla,$archivo)
{

	echo "kb.add(['".$tecla."'], function()\n";
	echo "{\n";
	echo "window.location = '".$archivo."'\n";;
	echo "});\n";
}
/**
 * 
 * @todo Funcion fin de la funcion de javascript
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_3()
{

	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida en javascript para mostrar ventanas de los productos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_buscar_productos()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['Ctrl','X'], function()\n";
	echo "{\n";
	echo "openproductos();";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida en javascript para mostrar ventanas pagos varios
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_pago_manual()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F10'], function()\n";
	echo "{\n";
	echo "openwindow();";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para venta de inscripciones y otros
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_nuevas()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F7'], function()\n";
	echo "{\n";
	echo "openwindow_ins_asi();";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para salir a la ventana principal de la aplicacion
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_salir()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F8'], function()\n";
	echo "{\n";
	echo "window.location = 'principal.php'\n";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para abrir modulo de operadores
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function operador_pagos()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F4'], function()\n";
	echo "{\n";
	echo "window.location = 'javascript: openwindow_ope();'\n";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para el agendamiento de mantenimiento
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function agendar()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F9'], function()\n";
	echo "{\n";
	echo "window.location = 'javascript: openwindow_man();'\n";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para salir de las ventanas emergentes de toda la aplicacion
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function teclas_cerrar()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F8'], function()\n";
	echo "{\n";
	echo "window.close()\n";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion tecla rapida para refrescar la taquilla
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function recargar()
{
	echo "<script type='text/javascript'>\n";
	echo "var kb = new kb_shortcut();\n";
	echo "kb.add(['F5'], function()\n";
	echo "{\n";
	echo "window.location = 'taquilla.php'\n";;
	echo "});\n";
	echo "</script>\n";
}
/**
 * 
 * @todo Funcion que regresa el codigo de empresa por usuarios
 * @author Jean Carlos Nuñez
 * @param int $var_cod_usu
 * @return int
 *  
 */
function empresa($var_cod_usu)
{
	global $conn; 
	$rs=phpmkr_query("select cod_empresa from usuarios where  codigo = $var_cod_usu ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{return $row_rs['cod_empresa'];}
}

/**
 * 
 * @todo Funcion que busca los datos de los autos por numero de unidad
 * @author Jean Carlos Nuñez
 * @param string $num_und
 * @return array
 *  
 */
 
function buscar_autos_jq($num_und)
{
	global $conn; 
	$sSql="select placa,'Amarillo' as color,numero_cupo,concat(marca,' ',modelo) as auto from autos where num_und = '$num_und'";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}
	
	return $row_rs;
}


/**
 * 
 * @todo Funcion que busca los datos de los autos y nombre de operador por numero de unidad
 * @author Jean Carlos Nuñez
 * @param string $num_und
 * @return array
 *  
 */
 
function buscar_autos_operador_jq($num_und)
{
	global $conn; 
	$conn->set_charset("utf8");
	$sSql="select a.num_ope,concat(o.nombre,' ',o.apellido) as nombre from autos a,operadores o 
	where a.num_und = '$num_und' and a.num_und = o.num_und_asig";

	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}
	
	return $row_rs;
}


/**
 * 
 * @todo Funcion que busca productos por codigo secundario para las salidas
 * @author Jean Carlos Nuñez
 * @param string $var_cod_sec
 * @return array
 *  
 */
 
function buscar_productos_codigo_sec_pro_jq($var_cod_sec,$var_cod_usu)
{
	global $conn; 
	$sSql="select p.referencia,p.descripcion,p.unidad,p.codigo_secundario,p.codigo,c.cantidad,c.monto_venta as monto,c.cod_pro,c.cod_dep from productos p,central c 
	where c.cod_pro = p.codigo and p.codigo_secundario = '$var_cod_sec' 
	and c.cod_dep in (select cod_dep from usuarios_depositos where cod_usu = ".$var_cod_usu.") order by c.cantidad limit 1";
	$rs=phpmkr_query($sSql,$conn) or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	$con = phpmkr_num_rows($rs);
	if($con>0)
	{
		$row_rs = phpmkr_fetch_row($rs);
		$var_resultado[]=$row_rs;
	}else{$row_rs=array('0'=>0);}
	
	return $row_rs;
}


/**
 * 
 * @todo Funcion que genera una funcion javascript para la busqueda de los productos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_productos_codigo_sec_pro()
{
	global $conn; 
	$rs = mysqli_query($conn,"select p.referencia,p.descripcion,p.unidad,p.codigo_secundario,p.codigo from productos p Order by p.codigo");

	echo "<script>\n";
	echo "function buscar_productos_codigo_sec_pro()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera=0;\n"; 
	echo "var var_codigo_sec = doc.codigo_sec.value; \n";
	echo "var_codigo_sec=var_codigo_sec.toUpperCase(); \n"; 
	while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_referencia=quitar_caracteres_raros2($row_rs['referencia']);
		$var_descripcion=$row_rs['descripcion'];
		$var_unidad=$row_rs['unidad']; 
		$var_cod_pro=$row_rs['codigo'];		
		$var_codigo_secundario=strtoupper($row_rs['codigo_secundario']);
	echo "	if(var_codigo_sec=='".$var_codigo_secundario."')\n";
	echo "	{ \n";
	echo "		doc.codigo_sec.value='".$var_codigo_secundario."'; \n";
	echo "		doc.unidad.value='".$var_unidad."'; \n";
	echo "		doc.descripcion_pro.value='".$var_descripcion."'; \n";
	echo "		doc.codigo.value='".$var_cod_pro."'; \n";
	echo " 		bandera=1;\n";
	echo "		doc.cantidad.focus(); \n";
	echo "	}\n"; }
	echo "	if(bandera=='0'){\n";
	echo "  alert('NO EXISTE PRODUCTO'); doc.codigo_sec.focus();\n";
	echo "	}\n"; 
	echo"
	}
	</script>	
	\n";		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar productos por codigo secundario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_productos_codigo_sec()
{ 
	global $conn; 
	$rs = mysqli_query($conn,"select c.cod_pro,p.referencia,p.descripcion,p.unidad,c.cantidad,c.monto,c.cod_dep,p.codigo_secundario,c.factura from productos p,central c where p.codigo = c.cod_pro and c.cod_dep=1 and p.codigo_secundario <> '-' order by c.cod_pro,c.cantidad");

	echo "<script>\n";
	echo "function buscar_productos_codigo_sec()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera=0;\n"; 
	echo "var var_codigo_sec = doc.codigo_sec.value; \n";
	echo "var_codigo_sec=var_codigo_sec.toUpperCase(); \n"; while ($row_rs = mysqli_fetch_array($rs)){$var_referencia=quitar_caracteres_raros2($row_rs['referencia']);$var_descripcion=$row_rs['descripcion'];$var_factura=$row_rs['factura'];
	$var_unidad=$row_rs['unidad']; $var_cantidad=$row_rs['cantidad']; $var_monto=$row_rs['monto']; $var_cod_pro=$row_rs['cod_pro'];$var_cod_dep=$row_rs['cod_dep'];$var_codigo_secundario=strtoupper($row_rs['codigo_secundario']);
	echo "	if(var_codigo_sec=='".$var_codigo_secundario."')\n";
	echo "	{ \n";
	echo "		doc.cod_pro.value='".$var_cod_pro."'; \n";
	echo "		doc.unidad.value='".$var_unidad."'; \n";
	echo "		doc.descripcion_pro.value='".$var_descripcion."'; \n";
	echo "		doc.cantidad_act.value='".$var_cantidad."'; \n";
	echo "		doc.monto_act.value='".$var_monto."'; \n";
	echo "		doc.cod_dep_pro.value='".$var_cod_dep."'; \n";
	echo "		doc.codigo.value='".$var_referencia."'; \n";
	echo "		doc.factura.value='".$var_factura."'; \n";	
	echo " 		bandera=1;\n";
	echo "		doc.cantidad.focus(); \n";
	echo "	}\n"; }
	echo "	if(bandera=='0'){\n";
	echo "  alert('NO EXISTE PRODUCTO'); doc.codigo_sec.focus();\n";
	echo "	}\n"; 
	echo"
	}
	</script>	
	\n";		
};
/**
 * 
 * @todo Funcion que genera un datalist de los productos para que interactue con el usuario
 * @author Jean Carlos Nuñez
 * @param int $var_tipo
 * @return string
 *  
 */
function crear_datalist($var_tipo)
{
	global $conn;	
	
	if($var_tipo==1)
	{
		echo "<datalist id='pro1' name='pro1'>\n";
		$rs = mysqli_query($conn,"select * from productos order by descripcion");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['codigo_secundario'],0,100))." - ".utf8_encode(substr($row_rs['descripcion'],0,100));	
			echo "<option value='".$row_rs['descripcion']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}
	if($var_tipo==2)
	{
		echo "<datalist id='pro2' name='pro2'>\n";
		$rs = mysqli_query($conn,"select * from productos order by descripcion");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['codigo_secundario'],0,100))." - ".utf8_encode(substr($row_rs['descripcion'],0,100));	
			echo "<option value='".$row_rs['codigo_secundario']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}
	if($var_tipo==3)
	{
		echo "<datalist id='pro3' name='pro3'>\n";
		$rs = mysqli_query($conn,"select * from productos order by descripcion");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['referencia'],0,100));	
			echo "<option value='".$row_rs['referencia']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}


	if($var_tipo==4)
	{
		echo "<datalist id='lugar_desde_list' name='lugar_desde_list'>\n";
		$rs = mysqli_query($conn,"select distinct(lugar_desde) from rt_servicios order by lugar_desde");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['lugar_desde'],0,100));	
			echo "<option value='".$row_rs['lugar_desde']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}

	if($var_tipo==5)
	{
		echo "<datalist id='lugar_hasta_list' name='lugar_hasta_list'>\n";
		$rs = mysqli_query($conn,"select distinct(lugar_hasta) from rt_servicios order by lugar_hasta");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['lugar_hasta'],0,100));	
			echo "<option value='".$row_rs['lugar_hasta']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}
	
	if($var_tipo==6)
	{
		echo "<datalist id='camisa_list' name='camisa_list'>\n";
		$rs = mysqli_query($conn,"select distinct(color_camisa) from rt_servicios order by color_camisa");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['color_camisa'],0,100));	
			echo "<option value='".$row_rs['color_camisa']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}

	if($var_tipo==7)
	{
		echo "<datalist id='pantalon_list' name='pantalon_list'>\n";
		$rs = mysqli_query($conn,"select distinct(color_pantalon) from rt_servicios order by color_pantalon");	
		while ($row_rs = mysqli_fetch_array($rs))
		{
			$var_descripcion=utf8_encode(substr($row_rs['color_pantalon'],0,100));	
			echo "<option value='".$row_rs['color_pantalon']."'>".$var_descripcion."</option>\n";		
		}
		echo "</datalist>\n";
	}
	
}

/**
 * 
 * @todo Funcion que genera un datalist de los depositos
 * @author Jean Carlos Nuñez
 * @param int $var_tipo
 * @return string
 *  
 */
function crear_datalist_depositos()
{
	global $conn;	
	echo "<script>\n";
	echo "function crear_datalist_depositos(valor,desc)\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "if(valor==6)\n";	
	echo "{\n";
	
	echo "var deleteFile = document.getElementById('buscar');\n";
	echo "var contenedor = document.getElementById('contenedor')\n";
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('input');\n";	
	echo "data = document.createElement('datalist');\n";
	echo "opt = document.createElement('option');\n";
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('list','pro1');\n";
	echo "caja.setAttribute('id','buscar');\n";
	echo "caja.setAttribute('class','input-block-level');\n";
	echo "caja.setAttribute('value','');\n";
	
	echo "document.getElementById('contenedor').appendChild(caja);\n";	
	echo "doc.buscar.focus(); \n";
	echo "doc.condicion.value=0; \n";
	echo"}\n";
	

	
	echo "if(valor==7)\n";	
	echo "{\n";
	
	echo "var deleteFile = document.getElementById('buscar');\n";
	echo "var contenedor = document.getElementById('contenedor')\n";
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('input');\n";	
	echo "data = document.createElement('datalist');\n";
	echo "opt = document.createElement('option');\n";
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('list','pro2');\n";
	echo "caja.setAttribute('id','buscar');\n";
	echo "caja.setAttribute('class','input-block-level');\n";
	echo "caja.setAttribute('value','');\n";
	
	echo "document.getElementById('contenedor').appendChild(caja);\n";	
	echo "doc.buscar.focus(); \n";
	echo "doc.condicion.value=0; \n";
	echo"}\n";
	
	echo "if(valor==8)\n";	
	echo "{\n";
	
	echo "var deleteFile = document.getElementById('buscar');\n";
	echo "var contenedor = document.getElementById('contenedor')\n";
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('input');\n";	
	echo "data = document.createElement('datalist');\n";
	echo "opt = document.createElement('option');\n";
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('list','pro3');\n";
	echo "caja.setAttribute('id','buscar');\n";
	echo "caja.setAttribute('class','input-block-level');\n";
	echo "caja.setAttribute('value','');\n";
	
	echo "document.getElementById('contenedor').appendChild(caja);\n";	
	echo "doc.buscar.focus(); \n";
	echo "doc.condicion.value=0; \n";
	echo"}\n";
	
	echo "if(valor==5)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from depositos where estado=1 order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('select');\n";	
	echo "var objSelect = caja;\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";while ($row_rs = mysqli_fetch_array($rs)){$var_descripcion=$row_rs['descripcion'];
	echo "var Item = new Option('".$var_descripcion."','".$var_descripcion."');\n";	
	echo "objSelect.options[objSelect.length] = Item;\n";}	
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.condicion.value=5; \n";
	
	echo"
	}\n";
		
	echo "\n
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript de los productos existente en el inventario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_productos_referencia()
{
	global $conn; 
	$rs = mysqli_query($conn,"select c.cod_pro,p.referencia,p.descripcion,p.unidad,c.cantidad,c.monto,c.cod_dep,p.codigo_secundario,c.factura from productos p,central c where p.codigo = c.cod_pro and c.cod_dep=1 and p.referencia <> '-'");

	echo "<script>\n";
	echo "function buscar_productos_referencia()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var bandera=0;\n"; 
	echo "var var_codigo = doc.codigo.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_referencia=quitar_caracteres_raros2($row_rs['referencia']);$var_descripcion=$row_rs['descripcion'];$var_factura=$row_rs['factura'];
	$var_unidad=$row_rs['unidad']; $var_cantidad=$row_rs['cantidad']; $var_monto=$row_rs['monto']; $var_cod_pro=$row_rs['cod_pro'];$var_cod_dep=$row_rs['cod_dep'];$var_codigo_secundario=$row_rs['codigo_secundario'];
	echo "	if(var_codigo=='".$var_referencia."')\n";
	echo "	{ \n";
	echo "		doc.cod_pro.value='".$var_cod_pro."'; \n";
	echo "		doc.unidad.value='".$var_unidad."'; \n";
	echo "		doc.descripcion_pro.value='".$var_descripcion."'; \n";
	echo "		doc.cantidad_act.value='".$var_cantidad."'; \n";
	echo "		doc.monto_act.value='".$var_monto."'; \n";
	echo "		doc.cod_dep_pro.value='".$var_cod_dep."'; \n";
	echo "		doc.codigo_sec.value='".$var_codigo_secundario."'; \n";	
	echo "		doc.factura.value='".$var_factura."'; \n";
	echo " 		bandera=1;\n";
	echo "		doc.cantidad.focus(); \n";
	echo "	}\n"; }
	echo "	if(bandera=='0'){\n";
	echo "  alert('NO EXISTE PRODUCTO'); doc.codigo.focus();\n";
	echo "	}\n";
	echo"
	}
	</script>	
	\n";		
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para destruir objetos en la pagina
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
 
function crear_destruir_marca_departemento_clase()
{
	global $conn;	
	echo "<script>\n";
	echo "function crear_destruir_marca_departemento_clase(valor,desc)\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "if(valor==4)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from departamentos order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('input');\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";		
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.buscar.focus(); \n";
	echo "doc.condicion.value=0; \n";
	echo"}\n";
	
	echo "if(valor==1)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from departamentos order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('select');\n";	
	echo "var objSelect = caja;\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";while ($row_rs = mysqli_fetch_array($rs)){$var_descripcion=$row_rs['descripcion'];
	echo "var Item = new Option('".$var_descripcion."','".$var_descripcion."');\n";	
	echo "objSelect.options[objSelect.length] = Item;\n";	
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.condicion.value=1; \n";
	}
	echo"
	}";
	
	echo "if(valor==2)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from marcas order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('select');\n";	
	echo "var objSelect = caja;\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";while ($row_rs = mysqli_fetch_array($rs)){$var_descripcion=$row_rs['descripcion'];
	echo "var Item = new Option('".$var_descripcion."','".$var_descripcion."');\n";	
	echo "objSelect.options[objSelect.length] = Item;\n";	
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.condicion.value=2; \n";
	}
	echo"
	}\n";
	
	echo "if(valor==3)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from clases order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('select');\n";	
	echo "var objSelect = caja;\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";while ($row_rs = mysqli_fetch_array($rs)){$var_descripcion=$row_rs['descripcion'];
	echo "var Item = new Option('".$var_descripcion."','".$var_descripcion."');\n";	
	echo "objSelect.options[objSelect.length] = Item;\n";	
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.condicion.value=3; \n";
	}
	echo"
	}\n";
	
	echo "if(valor==5)\n";	
	echo "{\n";
	$rs = mysqli_query($conn,"select * from depositos where estado=1 order by descripcion ");
	echo "var deleteFile = document.getElementById('buscar');\n";;
	echo "var contenedor = document.getElementById('contenedor')\n";;
	echo "contenedor.removeChild(deleteFile);\n";		
	echo "caja = document.createElement('select');\n";	
	echo "var objSelect = caja;\n";	
	echo "caja.setAttribute('name','buscar');\n";
	echo "caja.setAttribute('id','buscar');\n";while ($row_rs = mysqli_fetch_array($rs)){$var_descripcion=$row_rs['descripcion'];
	echo "var Item = new Option('".$var_descripcion."','".$var_descripcion."');\n";	
	echo "objSelect.options[objSelect.length] = Item;\n";	
	echo "document.getElementById('contenedor').appendChild(caja);\n";
	echo "doc.condicion.value=5; \n";
	}
	echo"
	}\n";
		
	echo "\n
	}
	</script>	
	\n";
		
};

/**
 * 
 * @todo Funcion busca los grupos de diarios en la base de datos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
 
function buscar_diario()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from grupos_diarios ");

	echo "<script>\n";
	echo "function buscar_diario()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_gru_dia = doc.gru_dia.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo'];$var_lunes=$row_rs['lunes'];
	echo "	if(var_gru_dia=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.monto_diario.value='".$var_lunes."'; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar productos en el inventario atraves del codigo secundario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_codigo_productos_secundario_traslado()
{
	global $conn; 
	$rs = mysqli_query($conn,"select p.codigo,p.descripcion,p.codigo_secundario,c.cantidad,
		d.descripcion as nombre_dep,c.cod_dep,c.monto,c.factura 
			from productos p,central c,depositos d 
	where c.cod_pro = p.codigo and d.codigo = c.cod_dep and p.estado = 1");
	echo "<script>\n";
	echo "function buscar_codigo_productos_secundario_traslado()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n"; 	
	echo "var var_codigo_sec = doc.codigo_sec.value; \n";	
	echo "if(var_codigo_sec!=''){";while ($row_rs = mysqli_fetch_array($rs)){$var_monto=$row_rs['monto'];$var_codigo_secundario=$row_rs['codigo_secundario'];$var_nombre_dep=$row_rs['nombre_dep'];$var_cod_dep=$row_rs['cod_dep'];$var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['descripcion']; $var_cantidad=$row_rs['cantidad'];$var_factura=$row_rs['factura'];
	echo "	if(var_codigo_sec=='".$var_codigo_secundario."')\n";
	echo "	{ \n";
	echo "		doc.codigo.value='".$var_codigo."'; \n";
	echo "		doc.descripcion.value='".$var_descripcion."'; \n";
	echo "		doc.codigo.value='".$var_codigo."'; \n";
	echo "		doc.cantidad_act.value='".$var_cantidad."'; \n";
	echo "		doc.cod_dep2.value='".$var_cod_dep."'; \n";
	echo "		doc.nom_dep2.value='".$var_nombre_dep."'; \n";
	echo "		doc.monto.value='".$var_monto."'; \n";
	echo "		doc.factura.value='".$var_factura."'; \n";
	echo "		doc.cod_dep.focus(); \n";
	echo "		bandera=1; \n";				
	echo "	}\n"; }	
	echo "	if(bandera==0)\n";
	echo "	{ \n";	
	echo " 		alert('ESTE CODIGO NO EXISTE');doc.codigo_sec.value=''; doc.codigo_sec.focus();\n";
	echo "	}}\n";
	echo"
	}
	</script>	
	\n";		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los pruductos por codigo secundario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_codigo_productos_secundario()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from productos where estado = 1");
	echo "<script>\n";
	echo "function buscar_codigo_productos_secundario()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n"; 	
	echo "var var_codigo_sec = doc.codigo_sec.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo_secundario=$row_rs['codigo_secundario']; $var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['descripcion']; $var_referencia=quitar_caracteres_raros2($row_rs['referencia']);	
	echo "if(var_codigo_sec!=''){";
	echo "	if(var_codigo_sec=='".$var_codigo_secundario."')\n";
	echo "	{ \n";
	echo "		doc.codigo.value='".$var_codigo."'; \n";
	echo "		doc.descripcion.value='".$var_descripcion."'; \n";
	echo "		bandera=1; \n";		
	echo "	}}\n"; }
	echo "if(var_codigo_sec!=''){";
	echo "	if(bandera==0)\n";
	echo "	{ \n";	
	echo " 		alert('ESTE CODIGO NO EXISTE');doc.codigo_sec.value=''; doc.codigo_sec.focus();\n";
	echo "	}}\n";
	echo"
	}
	</script>	
	\n";		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los pruductos por codigo secundario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_codigo_productos_secuendario()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from productos where estado = 1");
	echo "<script>\n";
	echo "function buscar_codigo_productos_secuendario()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var var_codigo_sec2 = doc.codigo_sec2.value; \n";
	echo "var var_codigo_sec = doc.codigo_sec.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo_secundario=$row_rs['codigo_secundario'];
	echo "if(var_codigo_sec2!=var_codigo_sec){";
	echo "	if(var_codigo_sec=='".$var_codigo_secundario."')\n";
	echo "	{ \n";
	echo "		alert('NO PUEDE REPETIR EL CODIGO DEL PRODUCTO'); doc.codigo_sec.value=''; doc.codigo_sec.focus();";	
	echo "	}}\n"; }	
	echo"
	}
	</script>	
	\n";		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript plas clases
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_clases()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from clases ");

	echo "<script>\n";
	echo "function buscar_clases()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n"; 
	echo "var var_cod_cla = doc.cod_cla.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['descripcion'];
	echo "	if(var_cod_cla==''){bandera=1;}\n";	
	echo "	if(var_cod_cla=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.clase.value='".$var_descripcion."'; \n";
	echo "		bandera=1; \n";
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.cod_cla.value=''; doc.cod_cla.focus(); doc.clase.value='';\n";
	echo " 		alert('ESTE CODIGO NO EXISTE')";
	echo "	}\n";
	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar las marcas
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_marca()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from marcas ");

	echo "<script>\n";
	echo "function buscar_marca()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n"; 
	echo "var var_cod_mar = doc.cod_mar.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['descripcion'];
	echo "	if(var_cod_mar==''){bandera=1;}\n";
	echo "	if(var_cod_mar=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.marca.value='".$var_descripcion."'; \n";
	echo "		bandera=1; \n";
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.cod_mar.value=''; doc.cod_mar.focus(); doc.marca.value='';\n";
	echo " 		alert('ESTE CODIGO NO EXISTE')";
	echo "	}\n";
	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los departamento
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_departamentos()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from departamentos ");

	echo "<script>\n";
	echo "function buscar_departamentos()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n"; 
	echo "var var_cod_dep = doc.cod_dep.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['descripcion'];
	echo "	if(var_cod_dep==''){bandera=1;}\n";	
	echo "	if(var_cod_dep=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.departamento.value='".$var_descripcion."'; \n";
	echo "		bandera=1; \n";
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.cod_dep.value=''; doc.cod_dep.focus(); doc.departamento.value='';\n";
	echo " 		alert('ESTE CODIGO NO EXISTE')";
	echo "	}\n";
	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los depositos en el modulo de ajuste de inventario
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_deposito_carga_descarga()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from depositos where estado = 1");

	echo "<script>\n";
	echo "function buscar_deposito()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var bandera = 0; \n";
	echo "var var_cod_dep = doc.cod_dep.value; \n";
	echo "	if(var_cod_dep!=''){\n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo'];	$var_descripcion=$row_rs['descripcion'];
	echo "	if(var_cod_dep=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.nom_dep.value='".$var_descripcion."'; \n";	
	echo "		bandera=1; \n";	
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.cod_dep.value=''; doc.cod_dep.focus(); doc.nom_dep.value='';\n";	
	echo " 		alert('ESTE CODIGO NO EXISTE')";
	echo "	}}\n";
	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los depositos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_deposito()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from depositos where estado = 1");

	echo "<script>\n";
	echo "function buscar_deposito()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_cod_dep = doc.cod_dep.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo']; 
	$var_descripcion=$row_rs['descripcion'];
	echo "	if(var_cod_dep=='".$var_codigo."')\n";
	echo "	{ \n";
	echo "		doc.nom_dep.value='".$var_descripcion."'; \n";		
	echo "		bandera=1; \n";
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.cod_dep.value=''; doc.cod_dep.focus(); doc.nom_dep.value='';\n";	
	echo " 		alert('ESTE CODIGO NO EXISTE')";
	echo "	}\n";
	
	echo"
	}
	</script>	
	\n";
		
};


/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los proveedores
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
 
function buscar_proveedor()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from proveedores where estado = 1");
	echo "<script>\n";
	echo "function buscar_proveedor()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";		
	echo "var bandera = 0; \n"; 
	echo "var var_cod_provee = doc.cod_provee.value; \n";
	echo "	if(var_cod_provee!='')\n";
	echo "	{ \n";while ($row_rs = mysqli_fetch_array($rs)){$var_codigo=$row_rs['codigo']; $var_descripcion=$row_rs['nombre'];
	echo "		if(var_cod_provee=='".$var_codigo."')\n";
	echo "		{ \n";
	echo "			doc.nom_provee.value='".$var_descripcion."'; \n";
	echo "			doc.cod_provee.value='".$var_codigo."'; \n";	
	echo "			bandera=1; \n";
	echo "		}\n"; }
	echo "		if(bandera==0)\n";
	echo "		{ \n";
	echo " 			doc.cod_provee.value=''; doc.cod_provee.focus(); doc.nom_provee.value='';\n";		
	echo " 			alert('ESTE CODIGO NO EXISTE')";
	echo "		}\n";
	echo "	}\n";
	echo"
	}	
	</script>	
	\n";
		
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para listar los autos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_numero_ope()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from autos order by num_und");

	echo "<script>\n";
	echo "function buscar_ope()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_num_und = doc.num_und.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_num_und=$row_rs['num_und'];$var_num_ope=$row_rs['num_ope'];
	echo "	if(var_num_und=='".$var_num_und."')\n";
	echo "	{ \n";
	echo "		doc.num_ope.value=".$var_num_ope."; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};

/**
 * 
 * @todo Funcion que busca todo los facturado por usuario
 * @author Jean Carlos Nuñez
 * @param int $var_cod_usu
 * @param date $var_fecha
 * @return decimal
 *  
 */
function facturacion_usuario_monto_actual($var_cod_usu_cajero,$var_fecha)
{

global $conn; 
	
	
	$sSql="select codigo from usuarios where estado = 1 and codigo = ".$var_cod_usu_cajero."";
	$rs_usu = mysqli_query($conn,$sSql);
	while ($row_rs_usu = mysqli_fetch_array($rs_usu))
	{		
		$var_cod_usu = $row_rs_usu['codigo'];
		$sSql="select sum(monto_dia) as monto_pagado
		from tickets_repuestos where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets_repuestos=$rs_tickets_data['monto_pagado'];}
		if($tickets_repuestos==""){$tickets_repuestos=0;}

		$sSql="select sum(monto_dia) as monto_pagado
		from tickets where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets=$rs_tickets_data['monto_pagado'];}
		if($tickets==""){$tickets=0;}

		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo <> 3 and tipo_pago <> 3";
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		if($siniestro==0){$siniestro=0;}
		
		$siniestro_dev=0;
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo = 3 and tipo_pago <> 3";
		$rs_siniestros_dev = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data_dev = mysqli_fetch_array($rs_siniestros_dev))
		{$siniestro_dev=$rs_siniestros_data_dev['monto_pagado'];}
		
		if($siniestro_dev==0){$siniestro_dev=0;}else{$siniestro_dev=$siniestro_dev*(-1);}
		
		
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}

		$sSql="select sum(monto) as monto_pagado
		from multas_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_multas = mysqli_query($conn,$sSql);
		while ($rs_multas_data = mysqli_fetch_array($rs_multas))
		{$multas = $rs_multas_data['monto_pagado'];}
		if($multas==""){$multas=0;}

		$sSql="select sum(monto) as monto_pagado
		from inscripciones_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_inscripciones = mysqli_query($conn,$sSql);
		while ($rs_inscripciones_data = mysqli_fetch_array($rs_inscripciones))
		{$inscripciones = $rs_inscripciones_data['monto_pagado'];}
		if($inscripciones==""){$inscripciones=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro = $rs_ahorro_data['monto_pagado'];}
		if($ahorro==""){$ahorro=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorro_dias_feriados_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro_feriados = mysqli_query($conn,$sSql);
		while ($rs_ahorro_feriados_data = mysqli_fetch_array($rs_ahorro_feriados))
		{$ahorro_feri = $rs_ahorro_feriados_data['monto_pagado'];}
		if($ahorro_feri==""){$ahorro_feri=0;}

		$sSql="select sum(monto) as monto_pagado
		from cupos_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_cupo = mysqli_query($conn,$sSql);
		while ($rs_cupo_data = mysqli_fetch_array($rs_cupo))
		{$cupo = $rs_cupo_data['monto_pagado'];}
		if($cupo==""){$cupo=0;}


		$sSql="select sum(monto_facturado) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia==""){$diferencia=0;}
	    
	    $sSql="select sum(diferencia) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia_real = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia_real==""){$diferencia_real=0;}
	    $diferencia = $diferencia_real + $diferencia;
		
	    $total_facturado = (($tickets+$siniestro+$cupo+$multas+$inscripciones+$ahorro+$ahorro_feri+$ahorro_rep+$siniestro_dev+$tickets_repuestos)-($diferencia));
	}
	return $total_facturado;
};

/**
 * 
 * @todo Funcion la factiracion actual del usuario
 * @author Jean Carlos Nuñez
 * @param date $var_fecha
 * @return decimal
 *  
 */
function facturacion_usuario_actual($var_fecha)
{

global $conn; 
	
	
	echo "<script>\n";
	echo "function facturacion_usuario_actual(cod_usu)\n";
	echo "{\n";
	echo "var doc = document.form1; \n";

	$sSql="select codigo from usuarios where estado = 1";
	$rs_usu = mysqli_query($conn,$sSql);
	while ($row_rs_usu = mysqli_fetch_array($rs_usu))
	{		
		
		$var_cod_usu = $row_rs_usu['codigo'];

		$sSql="select sum(monto_dia) as monto_pagado
		from tickets_repuestos where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets_repuestos=$rs_tickets_data['monto_pagado'];}
		if($tickets_repuestos==""){$tickets_repuestos=0;}

		$sSql="select sum(monto_dia) as monto_pagado
		from tickets where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets=$rs_tickets_data['monto_pagado'];}
		if($tickets==""){$tickets=0;}
		
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo <> 3 and tipo_pago <> 3";
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		if($siniestro==""){$siniestro=0;}

		
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo =3 and tipo_pago <> 3";
		$rs_siniestros_dev = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data_dev = mysqli_fetch_array($rs_siniestros_dev))
		{$siniestro_dev=$rs_siniestros_data_dev['monto_pagado'];}
		if($siniestro_dev==0){$siniestro_dev=0;}else{$siniestro_dev=$siniestro_dev*(-1);}
		
		
		$sSql="select sum(monto) as monto_pagado
		from multas_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu."";
		$rs_multas = mysqli_query($conn,$sSql);
		while ($rs_multas_data = mysqli_fetch_array($rs_multas))
		{$multas = $rs_multas_data['monto_pagado'];}
		if($multas==""){$multas=0;}
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}

		$sSql="select sum(monto) as monto_pagado
		from inscripciones_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_inscripciones = mysqli_query($conn,$sSql);
		while ($rs_inscripciones_data = mysqli_fetch_array($rs_inscripciones))
		{$inscripciones = $rs_inscripciones_data['monto_pagado'];}
		if($inscripciones==""){$inscripciones=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro = $rs_ahorro_data['monto_pagado'];}
		if($ahorro==""){$ahorro=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorro_dias_feriados_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro_feriados = mysqli_query($conn,$sSql);
		while ($rs_ahorro_feriados_data = mysqli_fetch_array($rs_ahorro_feriados))
		{$ahorro_feri = $rs_ahorro_feriados_data['monto_pagado'];}
		if($ahorro_feri==""){$ahorro_feri=0;}

		$sSql="select sum(monto_facturado) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia==""){$diferencia=0;}
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu."";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}

		$sSql="select sum(diferencia) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia_real = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia_real==""){$diferencia_real=0;}

		$sSql="select sum(monto) as monto_pagado
		from cupos_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_cupo = mysqli_query($conn,$sSql);
		while ($rs_cupo_data = mysqli_fetch_array($rs_cupo))
		{$cupo = $rs_cupo_data['monto_pagado'];}
		if($cupo==""){$cupo=0;}


	        
	    $diferencia = $diferencia_real + $diferencia;
	    $total_facturado = ((($tickets)+($siniestro)+($multas)+($cupo)+($inscripciones)+($ahorro)+($ahorro_feri)+($ahorro_rep)+($siniestro_dev)+($tickets_repuestos))-($diferencia));	    

	    

	    if($row_rs_usu['codigo']<>'')
	    {
			echo "	if(cod_usu=='".$row_rs_usu['codigo']."')\n";
			echo "	{ \n";
			echo " 		doc.monto_facturado.value=".$total_facturado.";\n";
			echo "      siguiente(".$total_facturado.");\n";
			echo "	}\n"; 
			
		}
		
	}
	echo" 
	}
	</script>	
	\n";
		
};

/***
 * 
 * @todo Funcion facturaacion por usuario por fecha
 * @author Jean Carlos Nuñez
 * @param date $var_fecha
 * @return decimal
 *  
 */
function facturacion_usuario_fecha($var_fecha)
{

global $conn; 
	
	
	echo "<script>\n";
	echo "function facturacion_usuario_actual(cod_usu)\n";
	echo "{\n";
	echo "var doc = document.form1; \n";

	$sSql="select codigo from usuarios where estado = 1";
	$rs_usu = mysqli_query($conn,$sSql);
	while ($row_rs_usu = mysqli_fetch_array($rs_usu))
	{		
		
		$var_cod_usu = $row_rs_usu['codigo'];

		$sSql="select sum(monto_dia) as monto_pagado
		from tickets_repuestos where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets_repuestos=$rs_tickets_data['monto_pagado'];}
		if($tickets_repuestos==""){$tickets_repuestos=0;}

		$sSql="select sum(monto_dia) as monto_pagado
		from tickets where fecha_impresion = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		//echo $sSql;
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets=$rs_tickets_data['monto_pagado'];}
		if($tickets==""){$tickets=0;}
		//echo $tickets;
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo <>3 and tipo_pago <> 3";
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		if($siniestro==""){$siniestro=0;}
		
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo =3 and tipo_pago <> 3";
		$rs_siniestros_dev = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data_dev = mysqli_fetch_array($rs_siniestros_dev))
		{$siniestro_dev=$rs_siniestros_data_dev['monto_pagado'];}
		if($siniestro_dev==0){$siniestro_dev=0;}else{$siniestro_dev=$siniestro_dev*(-1);}
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1 ";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}

		$sSql="select sum(monto) as monto_pagado
		from multas_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." ";
		$rs_multas = mysqli_query($conn,$sSql);
		while ($rs_multas_data = mysqli_fetch_array($rs_multas))
		{$multas = $rs_multas_data['monto_pagado'];}
		if($multas==""){$multas=0;}

		$sSql="select sum(monto) as monto_pagado
		from inscripciones_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_inscripciones = mysqli_query($conn,$sSql);
		while ($rs_inscripciones_data = mysqli_fetch_array($rs_inscripciones))
		{$inscripciones = $rs_inscripciones_data['monto_pagado'];}
		if($inscripciones==""){$inscripciones=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorros_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." ";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro = $rs_ahorro_data['monto_pagado'];}
		if($ahorro==""){$ahorro=0;}

		$sSql="select sum(monto) as monto_pagado
		from ahorro_dias_feriados_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro_feriados = mysqli_query($conn,$sSql);
		while ($rs_ahorro_feriados_data = mysqli_fetch_array($rs_ahorro_feriados))
		{$ahorro_feri = $rs_ahorro_feriados_data['monto_pagado'];}
		if($ahorro_feri==""){$ahorro_feri=0;}

		$sSql="select sum(monto_facturado) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu." and tipo_pago = 1";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia==""){$diferencia=0;}
	    $total_facturado=0;    

	    $sSql="select sum(diferencia) as monto_pagado
	    from cuadre_caja where fecha = '".$var_fecha."' and cod_usu_cajero = ".$var_cod_usu."";
	    $rs_cuadre_caja = mysqli_query($conn,$sSql);
	    while ($rs_cuadre_caja_data = mysqli_fetch_array($rs_cuadre_caja))
	    {$diferencia_real = $rs_cuadre_caja_data['monto_pagado'];}    
		if($diferencia_real==""){$diferencia_real=0;}

		$sSql="select sum(monto) as monto_pagado
		from cupos_hist where fecha = '".$var_fecha."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_cupo = mysqli_query($conn,$sSql);
		while ($rs_cupo_data = mysqli_fetch_array($rs_cupo))
		{$cupo = $rs_cupo_data['monto_pagado'];}
		if($cupo==""){$cupo=0;}



	    $diferencia = $diferencia_real + $diferencia;
		//errores(($tickets)+($siniestro)+($multas)+($inscripciones)+($ahorro)+($ahorro_feri)+($ahorro_rep));
	    $total_facturado = ((($tickets)+($siniestro)+($multas)+($cupo)+($inscripciones)+($ahorro)+($ahorro_feri)+($ahorro_rep)+($siniestro_dev)+($tickets_repuestos))-($diferencia));	    

	    

	    if($row_rs_usu['codigo']<>'')
	    {
			echo "	if(cod_usu=='".$row_rs_usu['codigo']."')\n";
			echo "	{ \n";
			echo " 		doc.monto_facturado.value=".$total_facturado.";\n";
			echo "      siguiente(".$total_facturado.");\n";
			echo "	}\n"; 
			
		}
		
	}
	echo" 
	}
	</script>	
	\n";
		
};


/**
 * 
 * @todo Funcion que da el monto facturado por usuario
 * @author Jean Carlos Nuñez
 * @return decimal
 *  
 */
function facturacion_usuario()
{

global $conn; 
	
	
	echo "<script>\n";
	echo "function facturacion_usuario(cod_usu)\n";
	echo "{\n";
	echo "var doc = document.form1; \n";

	$sSql="select codigo from usuarios where estado = 1";
	$rs_usu = mysqli_query($conn,$sSql);
	while ($row_rs_usu = mysqli_fetch_array($rs_usu))
	{		
		$var_cod_usu = $row_rs_usu['codigo'];
		$sSql="select sum(monto_dia) as monto_pagado
		from tickets where fecha_impresion = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets=$rs_tickets_data['monto_pagado'];}

		$var_cod_usu = $row_rs_usu['codigo'];
		$sSql="select sum(monto_dia) as monto_pagado
		from tickets_repuestos where fecha_impresion = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_tickets = mysqli_query($conn,$sSql);
		while ($rs_tickets_data = mysqli_fetch_array($rs_tickets))
		{$tickets_repuestos=$rs_tickets_data['monto_pagado'];}

	
		
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo <> 3 and tipo_pago <> 3";
		$rs_siniestros = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data = mysqli_fetch_array($rs_siniestros))
		{$siniestro=$rs_siniestros_data['monto_pagado'];}
		
		$siniestro_dev=0;
		$sSql="select sum(monto) as monto_pagado
		from siniestros_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo =3 and tipo_pago <> 3";
		$rs_siniestros_dev = mysqli_query($conn,$sSql);
		while ($rs_siniestros_data_dev = mysqli_fetch_array($rs_siniestros_dev))
		{$siniestro_dev=$rs_siniestros_data_dev['monto_pagado'];}
		if($siniestro_dev==0){$siniestro_dev=0;}else{$siniestro_dev=$siniestro_dev*(-1);}
		
		$sSql="select sum(monto) as monto_pagado
		from multas_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_multas = mysqli_query($conn,$sSql);
		while ($rs_multas_data = mysqli_fetch_array($rs_multas))
		{$multas = $rs_multas_data['monto_pagado'];}

		$sSql="select sum(monto) as monto_pagado
		from inscripciones_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_inscripciones = mysqli_query($conn,$sSql);
		while ($rs_inscripciones_data = mysqli_fetch_array($rs_inscripciones))
		{$inscripciones = $rs_inscripciones_data['monto_pagado'];}

		$sSql="select sum(monto) as monto_pagado
		from ahorros_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro = $rs_ahorro_data['monto_pagado'];}
		
		$sSql="select sum(monto) as monto_pagado
		from ahorros_repuesto_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro = mysqli_query($conn,$sSql);
		while ($rs_ahorro_data = mysqli_fetch_array($rs_ahorro))
		{$ahorro_rep = $rs_ahorro_data['monto_pagado'];}
		if($ahorro_rep==""){$ahorro_rep=0;}
		

		$sSql="select sum(monto) as monto_pagado
		from ahorro_dias_feriados_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_ahorro_feriados = mysqli_query($conn,$sSql);
		while ($rs_ahorro_feriados_data = mysqli_fetch_array($rs_ahorro_feriados))
		{$ahorro_feri = $rs_ahorro_feriados_data['monto_pagado'];}

		$sSql="select sum(monto) as monto_pagado
		from cupos_hist where fecha = '".fecha_aplicacion($conn)."' and cod_usu = ".$var_cod_usu." and tipo_pago = 1";
		$rs_cupo = mysqli_query($conn,$sSql);
		while ($rs_cupo_data = mysqli_fetch_array($rs_cupo))
		{$cupo = $rs_cupo_data['monto_pagado'];}
		if($cupo==""){$cupo=0;}


		
		$total_facturado=0;		
		$total_facturado = ($tickets+$siniestro+$multas+$cupo+$inscripciones+$ahorro+$ahorro_feri+$ahorro_rep+$siniestro_dev+$tickets_repuestos);

		

		if($total_facturado>0)
		{
	
			echo "	if(cod_usu=='".$row_rs_usu['codigo']."')\n";
			echo "	{ \n";
			echo " 		doc.monto_facturado.value=".$total_facturado."";		
			echo "	}\n"; 

			echo "	if(cod_usu=='')\n";
			echo "	{ \n";
			echo " 		doc.monto_facturado.value=''";		
			echo "	}\n"; 
		}
	}
	echo" 
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript por operador por cedula
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_operador_cedula_rt()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from rt_operadores order by num_oper");

	echo "<script>\n";
	echo "function buscar_operador_cedula_rt()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_cedula = doc.cedula.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_oper=trim($row_rs['num_oper']);$var_cedula=trim($row_rs['cedula']);		
	echo "	if(var_cedula=='".$var_cedula."')\n";
	echo "	{ \n";
	echo " 		alert('ESTE NUMERO DE CEDULA YA EXISTE');doc.cedula.value='';doc.cedula.focus();return false;";		
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript por operador por cedula
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_operador_cedula()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from operadores order by num_oper");

	echo "<script>\n";
	echo "function buscar_operador_cedula()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_cedula = doc.cedula.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_oper=trim($row_rs['num_oper']);$var_cedula=trim($row_rs['cedula']);
		$var_nombre=trim($row_rs['nombre']." ".$row_rs['apellido']);
	echo "	if(var_cedula=='".$var_cedula."')\n";
	echo "	{ \n";
	echo "		doc.num_ope.value='".$var_num_oper."'; \n";
	echo "		doc.nombre_ope.value='".$var_nombre."'; \n";
	echo "		doc.cedula.focus(); \n";
	echo "		bandera=1; \n";		
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		doc.num_ope.value=''; doc.cedula.focus(); doc.nombre_ope.value=''; \n";
	echo " 		alert('ESTE NUMERO DE CEDULA NO EXISTE')";
	echo "	}\n";	
	echo"
	}
	</script>	
	\n";
		
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar autos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_auto_salidas()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from autos order by num_und");

	echo "<script>\n";
	echo "function buscar_auto_salidas()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_num_und = doc.num_und.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_und=trim($row_rs['num_und']);$var_kilometraje=trim($row_rs['kilometraje']);			
	echo "	if(var_num_und=='".$var_num_und."')\n";
	echo "	{ \n";
	echo "		doc.kilometraje.value='".$var_kilometraje."'; \n";	
	echo "		doc.codigo_sec.focus(); \n";
	echo "		bandera=1; return false;   \n";		
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		 //doc.kilometraje.focus(); \n";
	echo " 		 doc.kilometraje.value=''; \n";				
	echo " 		alert('ESTE NUMERO DE UNIDAD NO EXISTE'); return false;";
	echo "	}\n";	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar autos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_auto()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from autos order by num_und");

	echo "<script>\n";
	echo "function buscar_auto()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_num_und = doc.num_und.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_placa=trim($row_rs['placa']);$var_num_und=trim($row_rs['num_und']);		
	echo "	if(var_num_und=='".$var_num_und."')\n";
	echo "	{ \n";
	echo "		doc.placa.value='".$var_placa."'; \n";	
	echo "		doc.num_und.focus(); \n";
	echo "		bandera=1; \n";		
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		 doc.num_und.focus(); doc.placa.value=''; \n";
	echo " 		alert('ESTE NUMERO DE UNIDAD NO EXISTE')";
	echo "	}\n";	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar operadores
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_operador()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from operadores order by num_oper");

	echo "<script>\n";
	echo "function buscar_operador()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";	
	echo "var bandera = 0; \n"; 
	echo "var var_num_ope = doc.num_ope.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_oper=trim($row_rs['num_oper']);$var_cedula=trim($row_rs['cedula']);
		$var_nombre=trim($row_rs['nombre']." ".$row_rs['apellido']);
	echo "	if(var_num_ope=='".$var_num_oper."')\n";
	echo "	{ \n";
	echo "		doc.cedula.value='".$var_cedula."'; \n";
	echo "		doc.nombre_ope.value='".$var_nombre."'; \n";
	echo "		doc.num_ope.focus(); \n";
	echo "		bandera=1; \n";		
	echo "	}\n"; }
	echo "	if(bandera==0)\n";
	echo "	{ \n";
	echo " 		 doc.num_ope.focus(); doc.nombre_ope.value=''; doc.cedula.value='';\n";
	echo " 		alert('ESTE NUMERO DE OPERADOR NO EXISTE')";
	echo "	}\n";	
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar autos
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_numero_auto()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from autos order by num_und");

	echo "<script>\n";
	echo "function buscar_auto()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_num_auto = doc.num_auto.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_num_und=$row_rs['num_und'];
	echo "	if(var_num_auto=='".trim($var_num_und)."')\n";
	echo "	{ \n";
	echo "		alert('ESTE NUMERO DE UNIDAD YA EXISTE EN LA BASE DE DATOS:$var_num_und');doc.num_auto.focus(); doc.num_auto.value=''; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar autos con sus diarios
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_auto_diarios()
{
	global $conn; 
	$var_hora = date("H:i:s");
	
	$rs=phpmkr_query("select * from operaciones_generales ",$conn) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conn) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{
		$var_hora_termino_dia=$row_rs['hora_termino_dia'];				
	}
	
	$var_cantidad_horas=RestarHoras($var_hora,$var_hora_termino_dia);

	$rs = mysqli_query($conn,"select a.monto_diario,a.num_und from autos a where a.num_ope = 0");
	echo "<script>\n";
	echo "function buscar_auto_diarios()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var horas_calcular =".$var_cantidad_horas.";\n";
	echo "var var_num_auto = doc.num_und.value; \n";while ($row_rs = mysqli_fetch_array($rs))
	{
		$var_num_und=$row_rs['num_und']; $var_monto_diario_por_hora=number_format($row_rs['monto_diario']/24,2);
	echo "	if(var_num_auto=='".$var_num_und."')\n";	
	echo "	{ \n";
	echo "      var var_monto_cobrar = parseInt(horas_calcular) * parseFloat(".$var_monto_diario_por_hora.")\n";
	echo "		doc.diario.value=var_monto_cobrar;";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";		
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar las fecha de las facturacion para el cierre del sistema
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_fecha_diarios()
{
	global $conn; 
	$rs = mysqli_query($conn,"select distinct(fecha_impresion) as fecha from tickets order by fecha_impresion desc limit 30");

	echo "<script>\n";
	echo "function buscar_fecha_diarios()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; while ($row_rs = mysqli_fetch_array($rs)){$var_fecha=$row_rs['fecha'];
	echo "var var_fecha_actual = doc.fecha_actual.value; \n";
	echo "	if(var_fecha_actual=='".$var_fecha."')\n";
	echo "	{ \n";
	echo "		alert('NO SE PUEDE HACER LA REVERSION CON ESTA FECHA: ".$var_fecha."');doc.revertir.value=0; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar fecha de cuentas por cobrar por usuario
 * @author Jean Carlos Nuñez
 * @param int $var_num_ope
 * @return string
 *  
 */
function buscar_fecha($var_num_ope)
{
	global $conn; 
	$rs = mysqli_query($conn,"select distinct(fecha) as fecha from cuentasxcobrar_hist where num_ope = $var_num_ope");
	echo "<script>\n";
	echo "function buscar_fecha()\n";
	echo "{\n";
	echo "var doc = document.form1; \n";
	echo "var var_monto_ins = doc.monto_ins.value; \n";
	echo "var valor = validar_insertar();  \n";	
	echo "  var var_fecha_ins = doc.fecha_ins.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_fecha_actual=fecha($row_rs['fecha']);
	echo "	if(var_fecha_ins=='".$var_fecha_actual."')\n";
	echo "	{ \n";
	echo "		alert('YA EXISTE ESTA FECHA, NO PUEDE CREAR OTRO CON LA MISMA: ".$var_fecha_actual."'); doc.insertar.disabled=false;  return false;  \n";
	echo "	}\n"; }
	echo "	if(valor==false){return false;}\n";
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar facturas
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_factura()
{
	global $conn; 
	$rs = mysqli_query($conn,"select distinct(factura) from entradas order by factura");
	echo "<script>\n";
	echo "function buscar_factura()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_factura = doc.factura.value.toUpperCase();; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_factura=$row_rs['factura'];
	echo "	if(var_factura=='".$var_factura."')\n";
	echo "	{ \n";
	echo "		alert('ESTA FACTURA YA EXISTE EN LA BASE DE DATOS:$var_factura');doc.factura.focus(); doc.factura.value=''; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar factura en ordenes de compra
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_factura_odc()
{
	global $conn; 
	$rs = mysqli_query($conn,"select distinct(factura) from entradas order by factura");
	echo "<script>\n";
	echo "function buscar_factura_odc()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_factura = doc.factura.value.toUpperCase();; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_factura=$row_rs['factura'];
	echo "	if(var_factura=='".$var_factura."')\n";
	echo "	{ \n";
	echo "		alert('ESTA FACTURA YA EXISTE EN LA BASE DE DATOS:$var_factura');doc.factura.focus(); doc.factura.value=''; \n";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar responsable por cedula
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_cedula_responsables()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from responsables_salidas order by cedula");
	echo "<script>\n";
	echo "function buscar_cedula_responsables()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_cedula = doc.cedula.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_cedula=$row_rs['cedula'];$var_nombre=$row_rs['nombre'];
	echo "	if(var_cedula=='".$var_cedula."')\n";
	echo "	{ \n";
	echo "		doc.nombre.value ='".$var_nombre."'";
	echo "	}\n"; }
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar reponsable por cedula
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function buscar_cedula()
{
	global $conn; 
	$rs = mysqli_query($conn,"select * from responsables_salidas order by cedula");
	echo "<script>\n";
	echo "function buscar_cedula()\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 
	echo "var var_cedula = doc.cedula.value; \n";while ($row_rs = mysqli_fetch_array($rs)){$var_cedula=$row_rs['cedula']; if($var_cedula<>""){
	echo "	if(var_cedula=='".trim($var_cedula)."')\n";
	echo "	{ \n";
	echo "		alert('ESTA CEDULA YA EXISTE EN LA BASE DE DATOS:$var_cedula');doc.cedula.focus(); doc.cedula.value=''; \n";
	echo "	}\n"; }}
	echo"
	}
	</script>	
	\n";
		
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para buscar validar las acciones en los modulos de la aplicacion
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */

function validar_acciones()
{
	echo "<script>\n";
	echo "function validar_acciones(valor)\n";
	echo "{\n";
	echo "if(valor=='1'){alert('EL REGISTRO FUE INSERTADO CON EXITO!');} \n"; 	
	echo "if(valor=='2'){alert('EL REGISTRO FUE MODIFICADO CON EXITO!');} \n"; 
	echo "if(valor=='3'){alert('EL REGISTRO FUE ELIMINADO CON EXITO!');} \n"; 		
	echo "	}\n";
	echo "</script>\n";
	
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para alidar las acciones en los modulos en la taquilla
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function validar_acciones_taquilla()
{
	echo "<script>\n";
	echo "function validar_acciones_taquilla(valor)\n";
	echo "{\n";
	echo "var doc = document.form1; \n"; 	
	echo "if(valor==99) {alert('ESTA UNIDAD NO EXISTE'); doc.num_und.focus();} \n"; 	
	echo "if(valor==100){alert('NO PUEDE DEJAR CAMPOS EN BLANCO'); doc.num_und.focus();} \n"; 		
	echo "if(valor==101){alert('ESTA UNIDAD NO TIENE OPERADOR ASIGNADO'); doc.num_und.focus();} \n"; 		
	echo "if(valor==1)  {doc.kilometraje.focus();} \n"; 		
	echo "if(valor=='') {doc.num_und.focus();} \n"; 		
	echo "	}\n";
	echo "</script>\n";
	
};

/**
 * 
 * @todo Funcion que genera una funcion en javascript para alidar las acciones en el modulo del cierre
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function validar_acciones_cierre()
{
	echo "<script>\n";
	echo "function validar_acciones_cierre(valor)\n";
	echo "{\n";
	echo "if(valor=='1'){alert('EL CIERRE SE REALIZO SATISFACTORIAMENTE');} \n"; 	
	echo "if(valor=='2'){alert('EL CIERRE SE REVIRTIO SATISFACTORIAMENTE');} \n"; 		
	echo "	}\n";
	echo "</script>\n";
	
};
/**
 * 
 * @todo Funcion que genera una funcion en javascript para alidar las acciones en el login de la aplicacion
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
function validar_acciones_login()
{
	echo "<script>\n";
	echo "function validar_acciones_login(valor)\n";
	echo "{var doc = document.form1;\n";
	echo "if(valor==0){alert('Este Usuario no Existe en la Base de Datos o esta Desactivado');doc.usuario.focus();}else{doc.usuario.focus();} \n"; 	
	echo "	}\n";
	echo "</script>\n";
	
};
/**
 * 
 * @todo Funcion para concatenar string
 * @author Jean Carlos Nuñez
 * @param string $cadena
 * @param int $longitud_max
 * @return string
 *  
 */
function concatenacion($cadena,$longitud_max) 
{
	if(strlen($cadena) < $longitud_max) 

	{	

		$vowels = array(" ");

		$cadena= str_replace($vowels, "0",$cadena);

		$var_cantidad=strlen($cadena);

		$var_cantidad=$longitud_max-$var_cantidad;

		$cadena=str_repeat("0",$var_cantidad)."".$cadena;

		return $cadena;

	}

	else{return $cadena;} 

}
/**
 * 
 * @todo Funcion que registra todas las acciones en la atraves de la aplicacion OpenPhoneTaxi
 * @author Jean Carlos Nuñez
 * @param int $var_cod_usu
 * @param string $var_accion
 * @param db $conne
 * @return Null
 *  
 */
function auditoria_openphonetaxi($var_cod_usu,$var_accion,$conne) 
{
	$rs=phpmkr_query("select fecha from fecha_aplicacion ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_actual=$row_rs['fecha'];}

	$rs=phpmkr_query("select auditoria from operaciones_generales ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_auditoria=$row_rs['auditoria'];}

	$rs=phpmkr_query("select curtime() as hora_actual ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$hora=$row_rs['hora_actual'];}

	

	$rs=phpmkr_query("select fecha_hasta from operaciones_generales ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_hasta=$row_rs['fecha_hasta'];}

	if($var_fecha_actual>$var_fecha_hasta)
	{		
		header("Location: index.php");exit();	
	}

	if($var_auditoria==1)
	{
		$var_ip = $_SERVER['REMOTE_ADDR'];	
		$contador=validar_ip_autorizada($var_ip);
		$today = date("Y-m-d");
		
		
		if($contador>0)
		{
			phpmkr_query("insert into auditoria values($var_cod_usu,'$today','$hora','$var_accion','$var_ip') ",$conne);
		}
		else
		{
			$var_accion = "IP NO ENCONTRADA, ".$var_accion;
			
			$sSql="insert into auditoria values($var_cod_usu,'$today','$hora','$var_accion','$var_ip') ";
			errores($sSql);	
			phpmkr_query($sSql,$conne);
					
		}
	}
}
/**
 * 
 * @todo Funcion que registra todas las acciones en la aplicacion
 * @author Jean Carlos Nuñez
 * @param int $var_cod_usu
 * @param string $var_accion
 * @param db $conne
 * @return Null
 *  
 */
function auditoria($var_cod_usu,$var_accion,$conne) 
{
	$rs=phpmkr_query("select fecha from fecha_aplicacion ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_actual=$row_rs['fecha'];}

	$rs=phpmkr_query("select auditoria from operaciones_generales ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_auditoria=$row_rs['auditoria'];}

	$rs=phpmkr_query("select curtime() as hora_actual ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$hora=$row_rs['hora_actual'];}

	

	$rs=phpmkr_query("select fecha_hasta from operaciones_generales ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_hasta=$row_rs['fecha_hasta'];}

	if($var_fecha_actual>$var_fecha_hasta)
	{		
		header("Location: index.php");exit();	
	}

	if($var_auditoria==1)
	{
		$var_ip = $_SERVER['REMOTE_ADDR'];	

		$contador=validar_ip_autorizada($var_ip);
		//$contador=1;
		//$hora = date('H:i:s');
		$today = date("Y-m-d");
		if($contador>0)
		{
			phpmkr_query("insert into auditoria values($var_cod_usu,'$today','$hora','$var_accion','$var_ip') ",$conne);
		}
		else
		{
			phpmkr_query("insert into auditoria values($var_cod_usu,'$today','$hora','IP NO ENCONTRADA','$var_ip') ",$conne);
			$_SESSION['accion']='3';
			header("Location: index.php");exit();		
		}
	}
}

/**
 * 
 * @todo Funcion que registra las acciones de los operadores
 * @author Jean Carlos Nuñez
 * @param int $var_num_ope
 * @param int $var_cod_usu
 * @param string $accion
 * @param db $conne
 * @return Null
 *  
 */


function acciones_operador($var_num_ope,$var_cod_usu,$var_accion,$conne) 
{
	$rs=phpmkr_query("select fecha from fecha_aplicacion ",$conne) 
	or die("Fallo al ejecutar la consulta en la linea" . __LINE__ . ": " . phpmkr_error($conne) . '<br>SQL: ' . $sSql);
	while ($row_rs = $rs->fetch_assoc())
	{$var_fecha_actual=$row_rs['fecha'];}	
	$hora = date("H:i:s");	
	phpmkr_query("insert into acciones_operador values($var_num_ope,'$var_accion','$var_fecha_actual','$hora',$var_cod_usu) ",$conne);

}
/**
 * 
 * @todo Funcion guarda las ip que acceden en la aplicacion
 * @author Jean Carlos Nuñez
 * @param date $today
 * @param time $hora
 * @param db $conne
 * @return mail
 *  
 */
function auditoria_ip($today,$hora,$var_ip,$conne) 
{
	phpmkr_query("insert into auditoria_ip values('$today','$hora','$var_ip') ",$conne);
	envio_coreo($var_ip,$hora,$today);
}
/**
 * 
 * @todo Funcion cambia el formato de la fecha de formato ingles a formato latino
 * @author Jean Carlos Nuñez
 * @param $value
 * @return date
 *  
 */
function fecha($value) { // fecha de YYYY/MM/DD a DD/MM/YYYY

 if ( ! empty($value) ) return substr($value,8,2) ."/". substr($value,5,2) ."/". substr($value,0,4);

}
/**
 * 
 * @todo Funcion que determina si es par o no un numero
 * @author Jean Carlos Nuñez
 * @param int $numero
 * @return boolean
 *  
 */
function esPar($numero)
{ 
   $resto = $numero%2; 
   if (($resto==0) && ($numero!=0)) 
   { 
        return true; 
   }
   else
   { 
        return false;  
   } 
}
/**
 * 
 * @todo Funcion regresa a la pagina index.php de la aplicacion
 * @author Jean Carlos Nuñez
 * @return redirect
 *  
 */
function devolver() 
{
	session_destroy();
	header("Location: index.php");
}
/**
 * 
 * @todo Funcion que convierte numero a mes
 * @author Jean Carlos Nuñez
 * @param int $mes
 * @return string
 *  
 */
function covertir_numero_mes($mes) 
{ 
	if($mes==1){echo "ENERO";}
	if($mes==2){echo "FEBRERO";}
	if($mes==3){echo "MARZO";}
	if($mes==4){echo "ABRIL";}
	if($mes==5){echo "MAYO";}
	if($mes==6){echo "JUNIO";}
	if($mes==7){echo "JULIO";}
	if($mes==8){echo "AGOSTO";}
	if($mes==9){echo "SEPTIEMBRE";}
	if($mes==10){echo "OCTUBRE";}
	if($mes==11){echo "NOVIEMBRE";}
	if($mes==12){echo "DICIEMBRE";}
}
/**
 * 
 * @todo Funcion que convierte de 12 horas a 24 horas
 * @author Jean Carlos Nuñez
 * @param time $hora
 * @return string
 *  
 */
function conversion_hora24($hora) { // Hora de 12 horas a 24 horas

	$cadena = strtotime($hora);
	$hora_a_24 = date("H:i:s", $cadena);	
	return $hora_a_24;
}
/**
 * 
 * @todo Funcion que convierte de 24 horas a 12 horas
 * @author Jean Carlos Nuñez
 * @param time $hora
 * @return string
 *  
 */
function conversion_hora($hora) 

{ // Hora de 24 horas a 12 horas

$var_hora = substr($hora,0,2);
$var_minutos = substr($hora,3,2);
$var_segundos = substr($hora,6,2);


if($var_hora=='00'){if($var_hora =='00'){return "12:".$var_minutos.":".$var_segundos." AM";} exit(); }
if($var_hora <  12){return $hora." AM";}
if($var_hora =='12'){return $hora." PM";}
if($var_hora =='13'){return "01:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='14'){return "02:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='15'){return "03:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='16'){return "04:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='17'){return "05:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='18'){return "06:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='19'){return "07:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='20'){return "08:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='21'){return "09:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='22'){return "10:".$var_minutos.":".$var_segundos." PM";}
if($var_hora =='23'){return "11:".$var_minutos.":".$var_segundos." PM";}	

}
/**
 * 
 * @todo Funcion que convierte de formato en ingles a latino
 * @author Jean Carlos Nuñez
 * @param date $value
 * @return string
 *  
 */
function fecha_en($value) { // fecha de YYYY/MM/DD a DD/MM/YYYY

 if ( ! empty($value) ) return substr($value,5,2) ."/". substr($value,8,2) ."/". substr($value,0,4);

}

/**
 * 
 * @todo Funcion que convierte de fecha de 'YYYY-MM-DD HH:MM:SS' a 'DD-MM-YYYY HH:MM:SS'
 * @author Jean Carlos Nuñez
 * @param date $value
 * @return string
 *  
 */

function fechahora($value) { // fecha de 'YYYY-MM-DD HH:MM:SS' a 'DD-MM-YYYY HH:MM:SS'

 if ( ! empty($value) ) return substr($value,8,2) ."/". substr($value,5,2) ."/". substr($value,0,4)." ".substr($value,11,8);

}
/**
 * 
 * @todo Funcion que transforma la imagenes a binario para ser guardadas en la base de datos 
 * @author Jean Carlos Nuñez
 * @param string $name
 * @param string $type
 * @param string $tmp_name
 * @param int $size
 * @return binary
 *  
 */
function foto($name,$type,$tmp_name,$size)
{
		$ancho= "480"; 
		$mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");	
		if(!in_array($type, $mimetypes))
		die("El archivo que subiste no es una imagen valida");		
		$size=getimagesize($tmp_name); 
		$width=$size[0];						
		$height=$size[1]; 
		//echo $height;
		$newwidth = $ancho;
		$newheight=intval($height*$newwidth/$width); 			
		//echo "---";
		//echo $newheight;
		//exit();
		switch($type) 
		{
			case $mimetypes[0]:
			case $mimetypes[1]:
			$oldimage=imagecreatefromjpeg($tmp_name);		
			break;
			case $mimetypes[2]:
			$oldimage=imagecreatefromgif($tmp_name);		
			break;
			case $mimetypes[3]:
			$oldimage=imagecreatefrompng($tmp_name);		
			break;
		}	
		
		
		$newimage=imagecreatetruecolor($newwidth,$newheight);		
		imagecopyresampled($newimage,$oldimage,0,0,0,0,$newwidth,$newheight,$width,$height);		

		$copia="C:\$name";						
		imagejpeg($newimage,$copia);						
		//$fp = fopen($tmp_name, "rb");
		$fp = fopen($copia, "rb");
		$tfoto = fread($fp, filesize($copia));
		$tfoto = addslashes($tfoto);
		fclose($fp);
		@unlink($tmp_name);
		return $tfoto;
}

/**
 * 
 * @todo Funcion que convierte de formato en latino a inlges
 * @author Jean Carlos Nuñez
 * @param date $value
 * @return string
 *  
 */
function fecha_sql($value) { // fecha de DD/MM/YYYY a YYYYY/MM/DD

 return substr($value,6,4) ."-". substr($value,3,2) ."-". substr($value,0,2);

}
/**
 * 
 * @todo Funcion para conectarse a la base de datos
 * @author Jean Carlos Nuñez
 * @param string $HOST
 * @param string $USER
 * @param string $PASS
 * @param string $DB
 * @param string $PORT
 * @return db
 *  
 */
function phpmkr_db_connect($HOST, $USER, $PASS, $DB, $PORT)
{
	error_log("SISTEMA ACTIVO", 0);
	$conn = mysqli_connect($HOST, $USER, $PASS, $DB, $PORT)	or die("No se puede conectar a la Base de Datos");
	return $conn;
}
/**
 * 
 * @todo Funcion para desconectar la base de datos
 * @author Jean Carlos Nuñez
 * @param db $conn
 * @return NUll
 *  
 */
function phpmkr_db_close($conn)
{
	mysqli_close($conn);
}
/**
 * 
 * @todo Funcion para hacer consultas en la aplicacion
 * @author Jean Carlos Nuñez
 * @param string $strsql
 * @param string $conn
 * @return recordset
 *  
 */
function phpmkr_query($strsql, $conn)
{
	$rs = mysqli_query($conn, $strsql);
	return $rs;
}

/**
 * 
 * @todo Funcion para contar los registros que regresa la consulta
 * @author Jean Carlos Nuñez
 * @param recordset $rs
 * @return int
 *  
 */
 
function phpmkr_num_rows($rs)
{
	return @mysqli_num_rows($rs);
}

/**
 * 
 * @todo Funcion que regresa un arreglo apartir de un recordset
 * @author Jean Carlos Nuñez
 * @param recordset $rs
 * @return array
 *  
 */
 
function phpmkr_fetch_array($rs)
{
	return mysqli_fetch_array($rs);
}
/**
 * 
 * @todo Funcion que regresa un arreglo por filas
 * @author Jean Carlos Nuñez
 * @param recordset $rs
 * @return array
 *  
 */
function phpmkr_fetch_row($rs)
{
	return mysqli_fetch_row($rs);
}
/**
 * 
 * @todo Funcion regresa un error de la base datos
 * @author Jean Carlos Nuñez
 * @param db $conn
 * @return string
 *  
 */
function phpmkr_error($conn)
{
	return mysqli_error($conn);
}


define("HOST", "localhost");
define("PORT", 3306);
define("USER", "root");
define("PASS", "142857142857");
define("DB", "observatorio");

define("HOST2", "localhost");
define("PORT2", 3306);
define("USER2", "root");
define("PASS2", "142857142857");
define("DB2", "test");



/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */

function select($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' name=".$control_name.">";
	  if ($selecione == 1) {$ret.="<option  value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
      if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" >'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};

/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select2($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' name=".$control_name." id=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select3($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' name=".$control_name." onchange='cambiar_valor(".cod_gru.");' >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  //if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select4($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Unidad Sugerida</option>";};
	  if ($selecione == 2) {$ret.="<option value='9000'>Unidad Sugerida</option>";};
 	  //if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select5($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' onClick='buscar_diario();' name=".$control_name.">";
	  if ($selecione == 1) {$ret.="<option  value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
      if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" >'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select6($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' onClick='buscar_diario();' id=".$control_name." name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  //if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select7($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' name=".$control_name." onclick='buscar_auto_diarios();'>";
	  if ($selecione == 1) {$ret.="<option  value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
      if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" >'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select8($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$conn) 
{
      $rs = $conn->query($sql);
	  $ret="<select class=''  name=".$control_name." onclick='buscar_ope();'>";
	  if ($selecione == 1) {$ret.="<option  value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
      if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" >'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select10($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true'  onchange='".$onchange."' name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select9($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' onchange='".$onchange."' name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select11($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' readonly='true' onchange='".$onchange."' name=".$control_name." >";	  
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select12($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn) 
{ 
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( "'".$row_rs[$field_value]."'" == "'".$field_selected."'" ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };      
      };
     $rs->close(); 
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select13($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select title='' class='' required='true' onchange='".$onchange."' id=".$control_name." name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected >'.utf8_encode($row_rs[$field_label]).'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.utf8_encode($row_rs[$field_label]).'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};

/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */

function select14($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' onchange='$onchange' name=".$control_name.">";
	  if ($selecione == 1) {$ret.="<option  value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
      if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};

/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select15($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
       $rs = $conn->query($sql);
	  $ret="<select class='' required='true'  onchange='".$onchange."' name=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value='0'  >Sin Chofer</option>";};
	  if ($selecione == 2) {$ret.="<option value=''>Seleccione</option>";};
	  if($field_selected==0){
 	  if ($selecione == 3) {$ret.="<option value=''>Seleccione</option><option value='0' selected>Sin Chofer</option>";};}
 	  else{
 	  	if ($selecione == 3) {$ret.="<option value=''>Seleccione</option><option value='0' >Sin Chofer</option>";};}
 	  
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected  && $row_rs[$field_value] <>"") {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } elseif($row_rs[$field_value] <>"") {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        }
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};
/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select16($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$onchange) 
{
      $rs = $conn->query($sql);
	  $ret="<select class=''   onchange='".$onchange."' name=".$control_name." id=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Seleccione</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};

/**
 * 
 * @todo Funcion construye un select a partir de una consulta
 * @author Jean Carlos Nuñez
 * @param string $field_value
 * @param string $field_label
 * @param string $sql
 * @param string $control_name
 * @param string $seleccione
 * @param db $conn
 * @return string
 *  
 */
function select17($field_value, $field_label, $field_selected, $sql, $control_name, $selecione=0,$selecione2,$selecione3,$conn,$funcion) 
{
      $rs = $conn->query($sql);
	  $ret="<select class='' required='true' onchange=".$funcion." name=".$control_name." id=".$control_name." >";
	  if ($selecione == 1) {$ret.="<option value=''>Seleccione</option>";};
	  if ($selecione == 2) {$ret.="<option value='0'>Ninguno</option>";};
 	  if ($selecione == 3) {$ret.="<option value='0'>TODOS</option>";};
      while ($row_rs = $rs->fetch_assoc()) {;
        if ( $row_rs[$field_value] == $field_selected ) {;
         $ret.='<option value="'.$row_rs[$field_value].'" selected>'.$row_rs[$field_label].'</option>';
        } else {;
          $ret.='<option value="'.$row_rs[$field_value].'">'.$row_rs[$field_label].'</option>';
        };
      };
     $rs->close();
     $ret.="</select>";
	 print $ret;
};


/**
 * 
 * @todo Clase que convierte de numero a letras
 * @author Jean Carlos Nuñez
 * @return string
 *  
 */
class EnLetras
{
  var $Void = "";
  var $SP = " ";
  var $Dot = ".";
  var $Zero = "0";
  var $Neg = "Menos";
  
function ValorEnLetras($x, $Moneda ) 
{
    $s="";
    $Ent="";
    $Frc="";
    $Signo="";
        
    if(floatVal($x) < 0)
     $Signo = $this->Neg . " ";
    else
     $Signo = "";
    
    if(intval(number_format($x,2,'.','') )!=$x) //<- averiguar si tiene decimales
      $s = number_format($x,2,'.','');
    else
      $s = number_format($x,0,'.','');
       
    $Pto = strpos($s, $this->Dot);
        
    if ($Pto === false)
    {
      $Ent = $s;
      $Frc = $this->Void;
    }
    else
    {
      $Ent = substr($s, 0, $Pto );
      $Frc =  substr($s, $Pto+1);
    }

    if($Ent == $this->Zero || $Ent == $this->Void)
       $s = "Cero ";
    elseif( strlen($Ent) > 7)
    {
       $s = $this->SubValLetra(intval( substr($Ent, 0,  strlen($Ent) - 6))) . 
             "Millones " . $this->SubValLetra(intval(substr($Ent,-6, 6)));
    }
    else
    {
      $s = $this->SubValLetra(intval($Ent));
    }

    if (substr($s,-9, 9) == "Millones " || substr($s,-7, 7) == "Mill贸n ")
       $s = $s . "de ";

    $s = $s . $Moneda;

    if($Frc != $this->Void)
    {
       $s = $s . " Con " . $this->SubValLetra(intval($Frc)) . "Centavos";
       //$s = $s . " " . $Frc . "/100";
    }
    return ($Signo . $s . " ");
   
}


function SubValLetra($numero) 
{
    $Ptr="";
    $n=0;
    $i=0;
    $x ="";
    $Rtn ="";
    $Tem ="";

    $x = trim("$numero");
    $n = strlen($x);

    $Tem = $this->Void;
    $i = $n;
    
    while( $i > 0)
    {
       $Tem = $this->Parte(intval(substr($x, $n - $i, 1). 
                           str_repeat($this->Zero, $i - 1 )));
       If( $Tem != "Cero" )
          $Rtn .= $Tem . $this->SP;
       $i = $i - 1;
    }

    
    //--------------------- GoSub FiltroMil ------------------------------
    $Rtn=str_replace(" Mil Mil", " Un Mil", $Rtn );
    while(1)
    {
       $Ptr = strpos($Rtn, "Mil ");       
       If(!($Ptr===false))
       {
          If(! (strpos($Rtn, "Mil ",$Ptr + 1) === false ))
            $this->ReplaceStringFrom($Rtn, "Mil ", "", $Ptr);
          Else
           break;
       }
       else break;
    }

    //--------------------- GoSub FiltroCiento ------------------------------
    $Ptr = -1;
    do{
       $Ptr = strpos($Rtn, "Cien ", $Ptr+1);
       if(!($Ptr===false))
       {
          $Tem = substr($Rtn, $Ptr + 5 ,1);
          if( $Tem == "M" || $Tem == $this->Void)
             ;
          else          
             $this->ReplaceStringFrom($Rtn, "Cien", "Ciento", $Ptr);
       }
    }while(!($Ptr === false));

    //--------------------- FiltroEspeciales ------------------------------
    $Rtn=str_replace("Diez Un", "Once", $Rtn );
    $Rtn=str_replace("Diez Dos", "Doce", $Rtn );
    $Rtn=str_replace("Diez Tres", "Trece", $Rtn );
    $Rtn=str_replace("Diez Cuatro", "Catorce", $Rtn );
    $Rtn=str_replace("Diez Cinco", "Quince", $Rtn );
    $Rtn=str_replace("Diez Seis", "Dieciseis", $Rtn );
    $Rtn=str_replace("Diez Siete", "Diecisiete", $Rtn );
    $Rtn=str_replace("Diez Ocho", "Dieciocho", $Rtn );
    $Rtn=str_replace("Diez Nueve", "Diecinueve", $Rtn );
    $Rtn=str_replace("Veinte Un", "Veintiun", $Rtn );
    $Rtn=str_replace("Veinte Dos", "Veintidos", $Rtn );
    $Rtn=str_replace("Veinte Tres", "Veintitres", $Rtn );
    $Rtn=str_replace("Veinte Cuatro", "Veinticuatro", $Rtn );
    $Rtn=str_replace("Veinte Cinco", "Veinticinco", $Rtn );
    $Rtn=str_replace("Veinte Seis", "Veintise铆s", $Rtn );
    $Rtn=str_replace("Veinte Siete", "Veintisiete", $Rtn );
    $Rtn=str_replace("Veinte Ocho", "Veintiocho", $Rtn );
    $Rtn=str_replace("Veinte Nueve", "Veintinueve", $Rtn );

    //--------------------- FiltroUn ------------------------------
    If(substr($Rtn,0,1) == "M") $Rtn = "Un " . $Rtn;
    //--------------------- Adicionar Y ------------------------------
    for($i=65; $i<=88; $i++)
    {
      If($i != 77)
         $Rtn=str_replace("a " . Chr($i), "* y " . Chr($i), $Rtn);
    }
    $Rtn=str_replace("*", "a" , $Rtn);
    return($Rtn);
}


function ReplaceStringFrom(&$x, $OldWrd, $NewWrd, $Ptr)
{
  $x = substr($x, 0, $Ptr)  . $NewWrd . substr($x, strlen($OldWrd) + $Ptr);
}


function Parte($x)
{
    $Rtn='';
    $t='';
    $i='';
    Do
    {
      switch($x)
      {
         Case 0:  $t = "Cero";break;
         Case 1:  $t = "Un";break;
         Case 2:  $t = "Dos";break;
         Case 3:  $t = "Tres";break;
         Case 4:  $t = "Cuatro";break;
         Case 5:  $t = "Cinco";break;
         Case 6:  $t = "Seis";break;
         Case 7:  $t = "Siete";break;
         Case 8:  $t = "Ocho";break;
         Case 9:  $t = "Nueve";break;
         Case 10: $t = "Diez";break;
         Case 20: $t = "Veinte";break;
         Case 30: $t = "Treinta";break;
         Case 40: $t = "Cuarenta";break;
         Case 50: $t = "Cincuenta";break;
         Case 60: $t = "Sesenta";break;
         Case 70: $t = "Setenta";break;
         Case 80: $t = "Ochenta";break;
         Case 90: $t = "Noventa";break;
         Case 100: $t = "Cien";break;
         Case 200: $t = "Doscientos";break;
         Case 300: $t = "Trescientos";break;
         Case 400: $t = "Cuatrocientos";break;
         Case 500: $t = "Quinientos";break;
         Case 600: $t = "Seiscientos";break;
         Case 700: $t = "Setecientos";break;
         Case 800: $t = "Ochocientos";break;
         Case 900: $t = "Novecientos";break;
         Case 1000: $t = "Mil";break;
         Case 1000000: $t = "Mill贸n";break;
      }

      If($t == $this->Void)
      {
        $i = $i + 1;
        $x = $x / 1000;
        If($x== 0) $i = 0;
      }
      else
         break;
           
    }while($i != 0);
   
    $Rtn = $t;
    Switch($i)
    {
       Case 0: $t = $this->Void;break;
       Case 1: $t = " Mil";break;
       Case 2: $t = " Millones";break;
       Case 3: $t = " Billones";break;
    }
    return($Rtn . $t);
}

}
?>
