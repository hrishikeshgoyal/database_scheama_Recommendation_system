
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

$dbname = "mediawiki";//$_SESSION['db'];

 
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


    echo '<form action="show_delatt.php" method ="post">
  
        <br /> <br />
        <br /> <br />';
        
        $update="SHOW TABLES FROM ".$dbname;
        $result = $conn->query($update);
        $cnt = $result->num_rows;
        //echo $cnt;
        echo "<div class ='absolute'><h3> Select Table whose attribute has to be deleted   <h3>";
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


$conn->close();
?> 


</head>

<body>

<!-- <input type="button" value="Next" class="homebutton" id="btnHome"  
onClick="document.location.href='test2.php'" />-->
</body>
</html>