<!doctype html>
<html lang="en">
<head>
  <style>
.relative {
    text-align: center;
    font-weight: bold
}
.tabble ,th,td {

  border: 1px solid black;
    border-collapse: collapse;
}
</style>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/jmenu.css" type="text/css" />
  <script type="text/javascript" src="js/jMenu.jquery.js"></script>
  
  
  
  <script>
  $(document).ready(function() {
  $("#jMenu").jMenu({
                    openClick : false,
                    ulWidth :'auto',
                     TimeBeforeOpening : 100,
                    TimeBeforeClosing : 11,
                    animatedText : true,
                    paddingLeft: 1,
                    effects : {
                        effectSpeedOpen : 150,
                        effectSpeedClose : 150,
                        effectTypeOpen : 'slide',
                        effectTypeClose : 'slide',
                        effectOpen : 'swing',
                        effectClose : 'swing'
                    }

     });
  $( "#tabs" ).tabs({
      beforeLoad: function( event, ui ) {
        ui.jqXHR.error(function() {
          ui.panel.html(
            "Couldn't load this tab. We'll try to fix this as soon as possible. " +
            "If this wouldn't be a demo." );
        });
      }
    });
    $( "#accordion" ).accordion({
    heightStyle: "content",
    collapsible: true
    });
  
  
  });
 
  function fun(x){
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
      document.getElementById("tabs-1").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","data.php?table="+x,true);
  xmlhttp.send();
  fun2(x);
  //document.getElementById("tabs-1").innerHTML=x;
  }
  
  function fun2(x){
  var xmlhttp=new XMLHttpRequest();
  xmlhttp.onreadystatechange=function(){
    if (xmlhttp.readyState==4 && xmlhttp.status==200){
      document.getElementById("tabs-2").innerHTML=xmlhttp.responseText;
    }
  }
  xmlhttp.open("GET","data2.php?table="+x,true);
  xmlhttp.send();
  
  }
  
  </script>
</head>

<body>


 <ul id="jMenu">
           <li>
                <a>Menu</a>
                <ul>
                    <li>
                        <a href="show3.php">P(int) chart</a>
                     </li>   
                    <li>
                        <a href="show4.php">P(tb) chart</a>
                     </li>
            <li>
                        <a href="show5.php">Prediction chart</a>
                     </li>
           <li>
                        <a href="cyto/sample.php">Table relationship graph</a>
                     </li>
                </ul>
            </li>
  </ul>

<?php

$expire=time()+60*60*60;
setcookie("uname", $_POST["uname"], $expire);
setcookie("pword", $_POST["pword"], $expire);
setcookie("db", $_POST["db"], $expire);

session_start();
$_SESSION['nod']=$_POST['nod'];
$_SESSION['nextnod']=$_POST['nextnod'];
$_SESSION['db']= $_POST["db"];
 



/*
echo "<div style=\"width:60%\" id='accordion'>";

$link = mysql_connect('localhost', $_POST["uname"], $_POST["pword"]);

$sql = "SHOW TABLES FROM ".$_SESSION["db"];
$result = mysql_query($sql);

mysql_select_db($_POST["db"]);
while ($row = mysql_fetch_row($result)) {
  
  $result2 = mysql_query("SHOW COLUMNS FROM ".$row[0]);

    echo "<h3 onClick=\"fun('".$row[0]."')\">".$row[0]."</h3><div>";
    
  
  if (mysql_num_rows($result2) > 0) {
    while ($row2 = mysql_fetch_assoc($result2)) {
      echo($row2["Field"]."<br/>");
    }
  }
  
  
  echo "</div>";
}

echo "</div>";
*/
$link = mysql_connect('localhost', $_POST["uname"], $_POST["pword"]);
echo "<h1 style = 'position: absolute;
    left: 200px;
    top: 80px;'>Database Operations by Users </h1> ";
echo "<form class = 'relative' method='POST' action='data3.php'>
<table style = 'position: absolute;
    left: 150px;
    top: 150px;' class = 'tabble'>
<tr>
 <td> No of Tables to add </td> <td> <input type='text' name='name1'></td>
 </tr>
 <tr>
<td> No of Tables to delete </td> <td><input type='text' name='name2'></td></tr>
 <tr>
 <td>No of Tables whose keys are modified </td><td> <input type='text' name='name3'></td></tr>
  <tr>
  <td>Split selected table </td> ";
$sql1 = "SHOW TABLES FROM ".$_POST["db"];
$result9 = mysql_query($sql1);
echo " <td> <select name = 'splittable' id ='splittable'>";
$cnt = mysql_num_rows($result9);
$i=0;
while ($i < $cnt) {
    $row5=mysql_fetch_row($result9);
    echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
    $i++;
}

echo "</select> </td>";


 echo " <td> Split percentage  <input type='text' name='name5'> </td> </tr>";
  
echo "  <tr> <td> Split attribute of the table  </td> ";
$sql2 = "SHOW TABLES FROM ".$_POST["db"];
$resul9 = mysql_query($sql2);
echo "<td><select name = 'splitatr' id ='splitatr'>";
$cnt1 = mysql_num_rows($resul9);
$i1=0;
while ($i1 < $cnt1) {
    $row5=mysql_fetch_row($resul9);
    echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
    $i1++;
}

echo "</select></td>";
echo "<td> Split percentage  <input type='text' name='name6'><br> </td>";
echo  "
</tr>
 <tr>
 <td>Join selected table </td> " ;

$sql1 = "SHOW TABLES FROM ".$_POST["db"];
$result9 = mysql_query($sql1);
echo "<td><select name = 'jointable1' id ='jointable1'>";
$cnt = mysql_num_rows($result9);
$i=0;
while ($i < $cnt) {
    $row5=mysql_fetch_row($result9);
    echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
    $i++;
}

echo "</select> </td>";


$sql1 = "SHOW TABLES FROM ".$_POST["db"];
$result9 = mysql_query($sql1);
echo "<td> <select name = 'jointable2' id ='jointable2'>";
$cnt = mysql_num_rows($result9);
$i=0;
while ($i < $cnt) {
    $row5=mysql_fetch_row($result9);
    echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
    $i++;
}

echo "</select> </td>";


 echo " </tr>
  <tr>
  <td>No of tables to renamed table </td> <td> <input type='text' name='name8'> </td> </tr>
 <tr> <td> No of attributes to be retyped </td> <td> <input type='text' name='name9'> </td> </tr>
 <tr> <td> No of attributes whose default valuse is changed </td> <td> <input type='text' name='name10'> </td> </tr>
<tr> <td> <input type='submit' style =' float : centre'  value='Submit'> </td> </tr>
</table>
</form>";



echo "<br/><br/>";
/*
echo "<div id='tabs'>".
  "<ul>".
    "<li><a href='#tabs-1'>Table Properties</a></li>".
    "<li><a href='#tabs-2'>Probabilities</a></li>".
  "</ul>".
  "<div id='tabs-1'>".
    "<p></p>".
  "</div>".
  "<div id='tabs-2'>".
    "<p></p>".
  "</div>".
   "<div id='tabs-3'>".
    "<p></p>".
  "</div>".
"</div>";
    */
mysql_close($link);


?>
<br/>

</body>
 
</html>