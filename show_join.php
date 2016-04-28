
<html>
<head>
<script type="text/javascript" src="canvasjs.min.js"></script>
<style>

div.absolute {
    position: absolute;
    left: 450px;
    top : 400px;
    padding : 60px ;
    border: 3px solid #73AD21;
}

.absolute1 {
    position: absolute;
    left: 600px;
    top : 570px;
    padding : 4px ;
    border: 1px solid #73AD21;
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


//echo "hello".'<br />';
//echo $_SESSION['weights'][0];




/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/

  

    echo '<form action="show_spliatt.php" method ="post">
  
        <br /> <br />
        <br /> <br />';
        
        $update="SHOW TABLES FROM  ".$dbname ;
        $result = $conn->query($update);
        $cnt = $result->num_rows;
        //echo $cnt;
        echo "<div class ='absolute'><h3> Select Tables to be joined                             <h3>";
        echo "<select name = 'delatt' id ='delatt'>";

        $i=0;
        while ($i < $cnt) {
            $row5=mysqli_fetch_row($result);
            echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
            $i++;
        }

        echo "</select>";

            $update="SHOW TABLES FROM  ".$dbname ;
        $result = $conn->query($update);
        $cnt = $result->num_rows;
        echo "<select name = 'delatt1' id ='delatt1'>";

        $i=0;
        while ($i < $cnt) {
            $row5=mysqli_fetch_row($result);
            echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
            $i++;
        }

        echo "</select>";



        echo "</div>";



         




    // echo '<input type = "submit" class="myButton" />';


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
    
   var imp1=5;
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

<!-- <input type="button" value="Next" class="homebutton" id="btnHome" 
onClick="document.location.href='show_rename.php'" /> -->


<button class ='absolute1' type='button' onclick = 'show_graph()'>showImpacts </button> 
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>
</html>