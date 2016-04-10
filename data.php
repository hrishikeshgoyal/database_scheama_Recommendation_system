<html>
<body>
<?php

$link = mysql_connect('localhost', $_COOKIE["uname"], $_COOKIE["pword"]);
mysql_select_db($_COOKIE["db"]);

$result1 = mysql_query("SHOW COLUMNS FROM ".$_GET["table"]);
echo "No. of attributes : ".mysql_num_rows($result1)."<br/>";

$result2 = mysql_query("show index from ".$_GET["table"]);

if(mysql_num_rows($result2)>0) echo "Primary keys : ";
while ($arr2=mysql_fetch_assoc($result2)) {
	echo $arr2["Column_name"]." | ";
}
echo "<br/>";

mysql_select_db("information_schema");
$result3 = mysql_query("select REFERENCED_TABLE_NAME,COLUMN_NAME from KEY_COLUMN_USAGE where TABLE_NAME='".$_GET["table"]
                        ."' and REFERENCED_TABLE_NAME IS NOT NULL and CONSTRAINT_SCHEMA='".$_COOKIE["db"]."'");

if(mysql_num_rows($result3)>0) echo "Foreign keys : ";
while ($arr2=mysql_fetch_assoc($result3)) {
	echo $arr2["COLUMN_NAME"]." => ".$arr2["REFERENCED_TABLE_NAME"]."| ";
}
echo "<br/>";


mysql_close($link);


?>
</body>
</html>