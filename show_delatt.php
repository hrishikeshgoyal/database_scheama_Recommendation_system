
<html>
<head>
<script type="text/javascript" src="canvasjs.min.js"></script>
<style>

div.absolute {
    position: absolute;
    left: 500px;
    top : 400px;
    padding : 20px ;
    border: 3px solid #73AD21;
}
div.chartimp {
    position: absolute;
    left: 0px;
    top : 750px;
    padding : 20px ;
    border: 3px solid #73AD21;
}
.absolute1 {
    position: absolute;
    left: 650px;
    top : 480px;
    padding : 5px ;
    border: 3px solid #73AD21;
}
.next {

       position: absolute;
    left: 950px;
    top : 500px;
    padding : 5px ;
    border: 3px solid #73AD21;


}


</style>


<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

//$dbname = "mediawiki";
$dbname = $_SESSION['db'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

/*$conn2 = new mysqli($servername, $username, $password, 'mediawiki');
if ($conn2->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
*/
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


 
//echo $_SESSION['weights'][0];




/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/
 
  


        
$update=" SHOW COLUMNS FROM ".$_POST['delatt'];
$result = $conn->query($update);
$cnt = $result->num_rows;
 
echo "<div class ='absolute'><h3> Select Tables to be deleted   <h3>";
echo "<select name = 'delatt2' id ='delatt2'>";

$i=0;
while ($i < $cnt) {
    $row5=mysqli_fetch_assoc($result);
    echo "<option value='".$row5['Field']."'>".$row5['Field']."</option>";
    $i++;
}

echo "</select>";
echo "</div>";
//echo '<button type = "submit" class="myButton" />';

$allatts=array();

//mysql_select_db("mediawiki");
$sql = "SHOW TABLES FROM ".$_SESSION["db"];
$result=10;
$result = $conn->query($sql);

 
while ($row = mysqli_fetch_row($result)) {
  
  $result2 = $conn->query("SHOW COLUMNS FROM ".$row[0]);    
    
  
  if ($result2->num_rows > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        array_push($allatts, $row2['Field']);
    }
  }
  
  
  
}



/*

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    
        learn($row[value]);
        $temp= $row[value];
        
        $update= "UPDATE simple SET value=".$temp." WHERE serial =".$index++;
        echo $update;
        $conn->query($update);
       
        echo $row[value];
    }
} else {
    echo "0 results";
}



*/




//echo $_SESSION["x1"];
$conn->close();
?> 


    <script>


    var all_att = new Array ("<?php echo implode('","', $allatts); ?>" );

    var e = document.getElementById("delatt2");
    var selectedopt = e.options[e.selectedIndex].value;
    var count=0;
    for (var i=0;i<all_att.length;i++) {

        if (selectedopt==all_att[i])
          count++;

    }




    var imp1=10;
    var imp2= 10 ; 
     var imp3 = Math.floor(100/count);
     var imp4=90;
     var imp5=10;
    

    


    /*function myFunction() {
    //var fruits = ["Banana", "Orange", "Apple", "Mango"];
    //new_att= new Array (<?php echo implode(',', $allatts); ?> );
    
    //var new_allatt= new Array (all_att);
    all_att.toString();
    document.getElementById("demo").innerHTML =  all_att;
    }*/


    function show_graph() {

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
<button type='button' class="absolute1" onclick = 'show_graph()'>showImpacts </button> 
<div  id="chartContainer" style="height: 300px; width: 100%;"></div>

<input class = "next" type="button" value="Next" class="homebutton" id="btnHome" onClick="document.location.href='show_spli.php'" />
<!-- <input type='button' value='Next2' onclick="myFunction()"/> 
<p id="demo"></p>-->
</body>
</html>