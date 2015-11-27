<?php
require_once 'class.odbc.php';


$Db=new odbc('','','database.accdb'); //create object

$result=$Db->Query('select * from `tr` '); //select from db

if(is_array($result)){  //fetch data
foreach($result as $row){
print "<li>$row[name]</li>";
}
}






?>