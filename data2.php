<html>
<body>
<?php

session_start();

$link = mysql_connect('localhost', $_COOKIE["uname"], $_COOKIE["pword"]);
mysql_select_db($_COOKIE["db"]);


$result1 = mysql_query("SHOW COLUMNS FROM ".$_GET["table"]);
$rows=mysql_num_rows($result1);
//$res=(1-exp(-$rows))/2;
//echo "P(int) : ".$res."<br/>";


//mysql_select_db("information_schema");
$result3 = mysql_query("select REFERENCED_TABLE_NAME,COLUMN_NAME from KEY_COLUMN_USAGE where TABLE_NAME='".$_GET["table"]
                        ."' and REFERENCED_TABLE_NAME IS NOT NULL and CONSTRAINT_SCHEMA='".$_COOKIE["db"]."'");
	
echo "GETTTTTTT";					
echo $rows;
$changes=0;
$nochanges=0;
if(mysql_num_rows($result3)<=0) {
	$int=(1-exp(-0.4*$rows-0.5*1));
	echo "bountiiii" ;
	//echo "P(tb) : ".$res;
}
else {
	
	mysql_select_db($_COOKIE["db"]);
	$count=0;
	$arr=array();
	echo "countiiii" ; echo count($arr) ;
	array_push($arr,$_GET['table']);
	while(count($arr)>0){
	$popres=array_pop($arr);
	while ($arr2=mysql_fetch_assoc($result3)){
		$result4 = mysql_query("SHOW COLUMNS FROM ".$arr2["REFERENCED_TABLE_NAME"]);
		$r=mysql_num_rows($result4);
		$tabname=$arr2["REFERENCED_TABLE_NAME"];
		$pb+= $_SESSION['i'.$tabname]/($rows*$r);
		$count++;
	}
	}
	
	//echo $res;//+$pb;
}

    
	$int=1-exp(-0.4*$rows-0.5*($count+1));
	echo "P(int) : ".$int;
	echo "<br/>";
	$int+=$pb;
	if($int>1)$int=1;
	$his=0;
if(isset($_SESSION[$_GET['table']])&& $_SESSION['nod'] > 0)	
  $his = ($_SESSION[$_GET['table']]/$_SESSION['nod'])*$_SESSION['nextnod']."<br>";
	

echo "P(tb) : ";
echo ($int+$his)/2;

//echo $_GET['table'].$_SESSION[$_GET['table']]."<br>";
echo "<br/>Changes <form action='record.php' method='POST'><input type='text' name='uvalue'><input type='submit' value='submit'><input type='hidden' name='table' value='".$_GET['table']."'></form></pre>";

if($int>=0.5)
	$change++;
else
	$nochange++;
	
mysql_close($link);


?>
</body>
</html>