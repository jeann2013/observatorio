<?php

$query = 'select * FROM VALORES';
$mdb_file = 'database.accdb';
$uname = explode(" ",php_uname());

//print_r($uname);

$os = $uname[0];
switch ($os){
  case 'Windows':
    $driver = '{Microsoft Access Driver (*.mdb)}';
    break;
  case 'Linux':
    $driver = 'MDBTools';
    break;
  default:
    exit("Don't know about this OS");
}
$dataSourceName = "odbc:Driver=$driver;DBQ=$mdb_file;";
$connection = new \PDO($dataSourceName);
$result = $connection->query($query)->fetchAll(\PDO::FETCH_ASSOC);
print_r($result);




?>