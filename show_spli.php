
<html>
<head>
<style>

div.absolute {
    position: absolute;
    left: 500px;
    top : 250px;
    padding : 20px ;
    border: 3px solid #73AD21;
}
.absolute1 {
    position: absolute;
    left: 950px;
    top : 330px;
    padding : 5px ;
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
 
        echo "<div class ='absolute'><h3> Select Tables to be splitted  <h3>";
        echo "<select name = 'delatt' id ='delatt'>";

        $i=0;
        while ($i < $cnt) {
            $row5=mysqli_fetch_row($result);
            echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
            $i++;
        }

        echo "</select>";
        echo "</div>";

   echo '<input type = "submit"  value ="Next" class="absolute1" />';


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


</head>

<body>

<!-- <input type="button" value="Next" class="homebutton" id="btnHome" 
onClick="document.location.href='test2.php'" /> -->
</body>
</html>