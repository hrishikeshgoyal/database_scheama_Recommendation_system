
<html>
<head>
<style>

div.absolute {
    position: absolute;
    left: 300px;
    top : 400px;
    padding : 20px ;
    border: 3px solid #73AD21;
}


</style>
  </head>

<body>
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



learn(100,$conn);

/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/

function learn ($feedback, $conn) {
  
    $i=0;
    $a=0.2;
    

    

    echo 'learning complex';
     
        
        
        $update="SHOW TABLES FROM mediawiki";
        $result = $conn->query($update);
        $cnt = $result->num_rows;
echo $cnt;
        echo "<div class ='absolute'><h3> Select Tables tto be deleted       <h3>";
        echo "<select name = 'splittable' id ='splittable'>";

$i=0;
while ($i < $cnt) {
    $row5=mysqli_fetch_row($result);
    echo "<option value='".$row5[0]."'>".$row5[0]."</option>";
    $i++;
}

echo "</select>";
    echo "</div>";

    
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
<input type="button" value="Next" class="homebutton" id="btnHome" 
onClick="document.location.href='test2.php'" />
</body>
</html>