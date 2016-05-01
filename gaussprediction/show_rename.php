
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


echo "hello".'<br />';
//echo $_SESSION['weights'][0];




/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/

  

    echo '<form action="show_spliatt.php" method ="post">
  
        <br /> <br />
        <br /> <br />';
        
        $update="SHOW TABLES FROM mediawiki";
        $result = $conn->query($update);
        $cnt = $result->num_rows;
        echo $cnt;
        echo "<div class ='absolute'><h3> Select Tables to be Renamed   <h3>";
        echo "<select name = 'delatt' id ='delatt'>";

        $i=0;
        while ($i < $cnt) {
            $row5=mysqli_fetch_row($result);
            echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
            $i++;
        }

        echo "</select>";

             



        echo "</div>";



         




    echo '<input type = "submit" class="myButton" />';


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
    var imp1=<?php  echo 20; ?>,imp2=22,imp3=34,imp4=45,imp5=67,imp6=89;

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
                  { label: "Normalization", y: imp2 },
                  { label: "redundancy",  y: imp3 },                                    
                  { label: "loss of information",  y: imp4 },
                  { label: "forward compatibility",  y: imp5 },
                  { label: "backward compatibility",  y: imp6 }
                ]
              }
              ]
              });

            chart.render();
    }


    </script>
</head>

<body>

<input type="button" value="Next" class="homebutton" id="btnHome" 
onClick="document.location.href='test2.php'" />


<button type='button' onclick = 'show_graph()'>showImpacts </button> 
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>