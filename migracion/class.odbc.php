<?php

/*
 *Class Connect to MsAccess Database By Odbc on The Fly
 *@Author Osama Salama.
 *@Version 0.1
 *@CopyRight 2010,2011
 *@Email osama_eg@live.com
*/


class odbc {

//@var 
public $User;

//@var	 
public $Pass;

//@var 
public $Db;

public $db_link;

private $Dns="DRIVER=Microsoft Access Driver (*.mdb,*.accdb);
DBQ={Path_DB};
UserCommitSync=Yes;
Threads=3;
SafeTransactions=0;
PageTimeout=5;
MaxScanRows=8;
MaxBufferSize=2048;
DriverId=281;
";
 


public function __construct($User,$Pass,$Db){
$this->User=$User;
$this->Pass=$Pass;
$this->Db=$Db;

$path_DB=realpath($this->Db);

$Dns=str_replace('{Path_DB}',$path_DB,$this->Dns);

$this->db_link=odbc_connect($Dns,$this->User,$this->Pass) or die('Error Conect Db....'); 

return $this->db_link;


}



public function Query($sql){
$rs = odbc_exec($this->db_link,$sql);
while($row=odbc_fetch_array($rs)){
$rows[]=$row;
}
return $rows;
}





















}










?>