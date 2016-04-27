
<html>
<head>
<script type="text/javascript" src="canvasjs.min.js"></script>
<style>

div.absolute {
    position: absolute;
    left: 300px;
    top : 400px;
    padding : 20px ;
    border: 3px solid #73AD21;
}
.headeri{
  position: absolute;
    left: 400x;
    top : 100px;
    padding : 20px ;
    border: 3px solid #73AD21;


}


</style>


<?php

session_start();

$servername = "localhost";
$username = "root";
$password = "";

$dbname = "mediawiki";

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


echo "<h3 >Check the attributes of the same table </h3> <br />";
//echo $_SESSION['weights'][0];




/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/
echo $_POST['delatt'];
  


        
        $update=" SHOW COLUMNS FROM ".$_POST['delatt'];
        $result = $conn->query($update);
        $cnt = $result->num_rows;
        echo "<br/>";
       // echo "<div class ='absolute'><h3> Select Tables tto be deleted   <h3>";
         

        $i=0;
        while ($i < $cnt) {
            $row5=mysqli_fetch_assoc($result);
            echo "<input   type='checkbox' name='".$row5['Field']."' value  ='".$row5['Field']."' >".$row5['Field']."<br/> ";
            $i++;
        }

 
        echo "</div>";

    


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
     var imp1=10;


   var imp2=20 ;
    var imp3=2;
   var  imp4=30;
   var imp5=30;

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

<button type='button' onclick = 'show_graph()'>showImpacts </button> 
<div id="chartContainer" style="height: 300px; width: 100%;"></div>

<input type="button" value="Next" class="homebutton" id="btnHome" 
onClick="document.location.href='show_join.php'" />
</body>
</html>