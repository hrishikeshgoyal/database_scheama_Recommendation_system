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
  <script type="text/javascript" src="canvasjs.min.js"></script>
  







<?php

$expire=time()+60*60*60;
setcookie("uname", $_POST["uname"], $expire);
setcookie("pword", $_POST["pword"], $expire);
setcookie("db", $_POST["db"], $expire);

session_start();

$_SESSION['uname']=$_POST['uname'];
$_SESSION['pword']=$_POST['pword'];


$_SESSION['nod']=$_POST['nod'];
$_SESSION['nextnod']=$_POST['nextnod'];
$_SESSION['db']= $_POST["db"];
 

//echo $_SESSION['db'];






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
    top: 80px;'> </h1> ";
echo "<form class = 'relative' method='POST' action='data3.php'>
<table style = 'position: absolute;
    left: 150px;
    top: 150px;' class = 'tabble'>
<tr>
 <td> Name of  Table to be added  </td> <td> <input type='text' name='name1'></td>
 </tr>
 <tr>
   <td> Name of the Attribute </td> 
   <td> <input type='text' id='attname'></td> 
   <td> <select name='atttype' id ='atttype'>
      <option value='Varchar'>Varchar</option>
      <option value='INteger'>Interger</option>
      <option value='Float'>float</option>
      <option value='Double'>Double</option>
      <option value='String'>String</option>

 </select>
  </td>
  <td> <select name='atttrefype' id ='atttrefype'>
      <option value='Normal'>Normal</option>
      <option value='Primary'>Primary</option>
       


      </select>
  </td>
  <td>
      <button type='button' onclick = 'attributeAdd()'>Add Attribute </button> 
  </td>
 </tr> </table>";
 


/* 
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
*/
"</table>
</form>";



echo "<br/><br/>";




$allatts=array();

mysql_select_db("mediawiki");
$sql = "SHOW TABLES FROM mediawiki";//".$_SESSION["db"];
$result = mysql_query($sql);

//echo mysql_num_rows($result);
while ($row = mysql_fetch_row($result)) {
  
  $result2 = mysql_query("SHOW COLUMNS FROM ".$row[0]);    
    
  
  if (mysql_num_rows($result2) > 0) {
    while ($row2 = mysql_fetch_assoc($result2)) {
        array_push($allatts, $row2['Field']);
    }
  }
  
  
  
}


//echo implode(',', $allatts);













?>











  
  <script>

 var n_att=0;
  var new_att= new Array();

var all_att = new Array ("<?php echo implode('","', $allatts); ?>" );
  function attributeAdd(){
  
      n_att++;
      var temp = document.getElementById("attname").value;


      new_att.push (temp );

      var e1 = document.getElementById("atttype");
      var strUser1 = e1.options[e1.selectedIndex].value;

      /*document.writeln(strUser1);*/

      var e2 = document.getElementById("atttrefype");
      var strUser2 = e2.options[e2.selectedIndex].value;
      /*document.writeln(strUser2);*/


  }

  //var imp1=<?php  echo $sch; ?>,imp2=<?php  echo $redu; ?>,imp3=<?php  echo $loi; ?>,imp4=<?php  echo $fwd; ?>,imp5=<?php  echo $bwd; ?>;
  var imp1,imp2,imp3,imp4,imp5,imp6,rudy=0;


//var all_att;

function myFunction() {
    //var fruits = ["Banana", "Orange", "Apple", "Mango"];
    //new_att= new Array (<?php echo implode(',', $allatts); ?> );
    
    var new_allatt= new Array (all_att);
    new_allatt.toString();
    document.getElementById("demo").innerHTML =  rudy;//all_att.length + " " + newlen ;
}
   


 function show_graph() {

     imp1 = n_att * 10;
      

      

      var i,j;

      var alllen=all_att.length;
      var newlen= new_att.length;

      for (j=0 ; j<newlen ; j++){

        for ( i=0; i< alllen; i++) {

        

       if (new_att[j] === all_att[i]) {

              rudy++;
          
            }


      }
}
      imp2 = rudy/n_att * 100;











      imp3 = 10;
      imp4 = 90;
      imp5 = 10;
             

            var chart = new CanvasJS.Chart("chartContainer",
            {   



              animationEnabled: true,
              title:{
                text: "Chart with Labels on X Axis"
              },
              data: [
              {
                type: "column", //change type to bar, line, area, pie, etc
                dataPoints: [
                  { label: "schema volume change", y: imp1 },
                  { label: "redundancy",  y: imp2 },                                    
                  { label: "loss of information",  y: imp3 },
                  { label: "forward compatibility",  y: imp4 },
                  { label: "backward compatibility",  y: imp5 }
                ]
              }
              ]
              });

            chart.render();
}


  
</script>
</head>

<body>

<button type='button' onclick = 'show_graph()'>show impacts </button> 



<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>


  <input type='button' value='Next' onclick="document.location.href='show_del.php'"/>
   <!-- <input type='button' value='Next2' onclick="myFunction()"/>   -->
   
 
<p id="demo"></p>


</body>
 
</html>