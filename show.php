<html>
<body>
<?php
echo $_POST["uname"];
echo $_POST["pword"];
$link = mysql_connect('localhost', $_POST["uname"], $_POST["pword"]);
if (!$link) {
    die('Could not connect: ' . mysql_error());
}
echo 'Connected successfully';
echo "<br/>";
echo "<br/>";
echo "<div style = 'position: absolute;
    left: 300px;
    top: 250px; border-style: solid;
    border-width: 1px; padding : 10px ; padding-left: 10cm; padding-right: 10cm; '>";
echo '<h2>Select a Datbase </h2>';

$db_list = mysql_list_dbs($link);
echo "<form method='POST' action='show222.php'>";
echo "<select name='db'>";
$i = 0;
$cnt = mysql_num_rows($db_list);
while ($i < $cnt) {
    echo "<option value='".mysql_db_name($db_list, $i)."'>".mysql_db_name($db_list, $i)."</option>";
    $i++;
}
echo "</select>";
echo "<input type='hidden' name='uname' value='".$_POST["uname"]."'>";
echo "<input type='hidden' name='pword' value='".$_POST["pword"]."'>";
echo "<br> <input type='hidden' name='nod'><br>";
echo " <input type='hidden' name='nextnod'><br>";
echo "<input type='submit' value='Submit'>";
echo "</form>";

echo "</div>";

mysql_close($link);
?>
</body>
</html>