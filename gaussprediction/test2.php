<!doctype html>
<html lang="en">
<head>
 <style>
 h3.qwe { background-color: white }
h3.qwe:hover { background-color: yellow };
 </style> 
  <link rel="stylesheet" href="//code.jquery.com/ui/1.10.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.9.1.js"></script>
  <script src="//code.jquery.com/ui/1.10.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="css/jmenu.css" type="text/css" />
  <script type="text/javascript" src="js/jMenu.jquery.js"></script>
  
  
  
  <script>
  $(document).ready(function() {
 
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
  var tt;
  var t2;
  function clii() {
      tt= document.getElementById("demos");
       t2 = document.getElementById("demo");
      t2.innerHTML=tt.innerHTML;
      location.reload();
}

  </script>
</head>

<body>
 <p id = "demo" ></p>

<?php

 

session_start();
$servername = "localhost";
$username = "root";
$password = "";

$dbname = "mediawiki";



echo "<div style=\"width:60%\" id='accordion'>";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SHOW TABLES FROM ".$dbname;
$result = $conn->query($sql);

//mysql_select_db($dbname);
$cnt = $result->num_rows;
$i =0;
while ($i < $cnt) {
  $row5=mysqli_fetch_row($result);
  $result2 = $conn->query("SHOW COLUMNS FROM ".$row5[0]);

    echo "<h3 onClick=\"fun('".$row5[0]."')\">".$row5[0]."</h3><div>";
    /*
  
   $cnt2 =  $result2->num_rows;
   $i2=0;
    while ( $i2< $cnt2 ) {
      $row2 = mysqli_fetch_assoc($result2);
      echo"<h3 class ='qwe' id ='demos' onclick = 'clii()'>".($row2["Field"]."<br/>")."</h3>";
      $i2++;
    }
  */
  
//------------------
echo "<select name = 'splittable' id ='splittable'>";
 $cnt2 =  $result2->num_rows;
 echo $cnt2;
$i11=0;
while ($i11 < $cnt2) {
    $row3=mysqli_fetch_row($result2);
    echo "<option value='".$row3[0]."'>".$row3[0]."</option>";
    $i11++;
}

echo "</select>";

  //---------------------------------------------------
  echo "</div>";
  $i++;
}

echo "</div>";
echo "<br/><br/>";



mysql_close($link);


?>
<br/>

</body>
</html>