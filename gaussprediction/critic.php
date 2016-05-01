<html>
<head>



<?php


//echo 'rating value   '._POST['ratings'];



session_start();
 
echo $_SESSION['simple_sum'].'<br />';


$servername = "localhost";
$username = "root";
$password = "";

$dbname = "weights";

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



echo 'feedback value  '.$_POST['ratings'];

$feedback= $_POST['ratings'];
$learn_a =  (1+(10-$feedback)/10);

$simple_act= $learn_a*  ($_SESSION['simple_sum']);
$complex_act= $learn_a* ($_SESSION['complex_sum']);



/*echo "hrishikesh\r\n";
echo $result->num_rows;
echo "hrishikesh\r\n";

*/

//function learn ($simple_act,$complex_act, $conn) 
{
	
    $i=0;
    $a=0.001;
    
    $_SESSION['x0']=1;
    $_SESSION['cx0']=1;

    echo 'session simple sum '.$_SESSION['simple_sum'].'<br />';
    echo 'difference is '.($_SESSION['simple_sum'] - $simple_act).'<br />';

    $update_prev= "UPDATE simple SET previous_value= value";
    $result2 = $conn->query($update_prev);
    $update_prev= "UPDATE complex SET previous_value=value";
    $result2 = $conn->query($update_prev);
    foreach (range(0, 4) as $i) 
    {   
        echo $i.'<br />';
        $str='x'.$i;

        echo 'weight is= '.$_SESSION['weights'][$i].'   factor is ='.$_SESSION[$str].'<br />';
        $_SESSION['weights'][$i]=  abs($_SESSION['weights'][$i]  - $a  * ( $_SESSION['simple_sum'] - $simple_act) * $_SESSION[$str] );
        echo '       '.$_SESSION['weights'][$i].' <br />'.' <br />'.' <br />';

        
        
        $update="UPDATE simple SET value = ".$_SESSION['weights'][$i]. " WHERE serial = ".$i;
        $result = $conn->query($update);
        

    }


    echo 'learning complex<br />';
    echo 'complex sum is = '.$_SESSION['complex_sum'].'<br />';
    echo 'difference is ='. ($_SESSION['complex_sum']-$complex_act).'<br />';
    foreach (range(0, 9) as $i) 
    {   
        echo $i.'<br />';
        $str='cx'.$i;
        echo $str.'   its value=  '.$_SESSION[$str].'<br />';
        echo 'weight is= '.$_SESSION['weights2'][$i].'   factor is ='.$_SESSION[$str].'<br />';
        $_SESSION['weights2'][$i]=  abs( $_SESSION['weights2'][$i]  - $a  * ( $_SESSION['complex_sum'] - $complex_act) * $_SESSION[$str] );


        echo '       '.$_SESSION['weights2'][$i].' <br />'.' <br />'.' <br />';

        

        $update="UPDATE complex SET value = ".$_SESSION['weights2'][$i]. " WHERE serial = ".$i;
        $result = $conn->query($update);
        

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


//learn($actual_simple_sum,$actual_complex_sum,$conn);

//echo $_SESSION["x1"];
$conn->close();

?> 
</head>
<body>
<h1>Thank you for your feedback</h1>
</body>
</html>
