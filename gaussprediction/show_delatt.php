
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
    left: 640px;
    top : 520px;
    padding : 0px ;
    border: 1px solid #73AD21;
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

$dbname = "mediawiki";
//$dbname = $_SESSION['db'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

 
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
 
 
  
include 'trainingdata.php';
include 'gaussprediction.php';

        
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
$sql = "SHOW TABLES FROM mediawiki";//.//$_SESSION["db"];
$result=10;
$result = $conn->query($sql);

$n_tables= $result->num_rows;

while ($row = mysqli_fetch_row($result)) {
  
  $result2 = $conn->query("SHOW COLUMNS FROM ".$row[0]);    
    
  
  if ($result2->num_rows > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        array_push($allatts, $row2['Field']);
    }
  }
  
  
  
}







//echo $_SESSION["x1"];
$conn->close();
?> 
 

    <script>


    var n_att=0;
  //var new_att= new Array();

  var all_att = new Array ("<?php echo implode('","', $allatts); ?>" );
  var all_mean = new Array (6);
 var all_variance = new Array(6);
 all_mean[0] = new Array  (9);
 all_mean[1] = new Array ("<?php echo implode('","', $mean[1]); ?>");
 all_mean[2] = new Array ("<?php echo implode('","', $mean[2]); ?>");
 all_mean[3] = new Array ("<?php echo implode('","', $mean[3]); ?>");
 all_mean[4] = new Array ("<?php echo implode('","', $mean[4]); ?>");
 all_mean[5] = new Array ("<?php echo implode('","', $mean[5]); ?>");
 all_variance [0] = new Array (9);
 all_variance [1] = new Array ("<?php echo implode('","', $variance[1]); ?>");
 all_variance [2] = new Array ("<?php echo implode('","', $variance[2]); ?>");
 all_variance [3] = new Array ("<?php echo implode('","', $variance[3]); ?>");
 all_variance [4] = new Array ("<?php echo implode('","', $variance[4]); ?>");
 all_variance [5] = new Array ("<?php echo implode('","', $variance[5]); ?>");


 var prod = new Array (6);

var all_param = new Array(9);

all_param[1]= <?php echo $n_tables;?> ;


var pro_x_given_c = new Array (6);

for (var i = 1; i < 6; i++) {
    pro_x_given_c[i]= new Array(9);
}

var pro_c_given_x = new Array (6);
for (var i = 1; i < 6; i++) {
    pro_c_given_x[i]= 0;
}
all_param[2] =0;
  all_param[3]= 1;
  all_param[4]=   0;
  all_param[5]=  (0);
  all_param[6]= (0);
  all_param[7]= 0;
  all_param[8]= (0);

  var temp1;
function myFunction() {
    //var fruits = ["Banana", "Orange", "Apple", "Mango"];
    //new_att= new Array (<?php echo implode(',', $allatts); ?> );
    
    
    //pro_x_given_c.toString();
    //all_mean.toString();
    //all_variance.toString();
    //all_param.toString(); 
    //pro_x_given_c.toString();
    pro_c_given_x.toString();  
   // prod.toString(); 
    document.getElementById("demo").innerHTML = pro_c_given_x; //all_param //pro_c_given_x; //all_variance; // all_mean; //pro_c_given_x.toString();
}

function cal_gauss ( i, j) {
    var temp3 =  2.0 * all_variance[j][i] * all_variance[j][i];
    temp1= Math.pow(all_param[i]- all_mean[j][i],2.0)/ temp3;
    var temp = Math.pow (Math.E, -1.0*temp1);
    var res = temp / Math.sqrt (2.0* Math.PI* Math.pow ((all_variance[j][i]),2.0) );
    
    return res;
    //return 1;
}

 function show_graph() {



  var i,j;

      var alllen=all_att.length;
      

      

      

      for (var j=1; j<=5;j++) {

          for (var i=1;i<=8;i++) {

                 pro_x_given_c [j][i] = cal_gauss (i,j);
                
          }
          

      }



       for (var i=0;i<6;i++) {

          prod [i]= 1.0;
      }

      for (var j=1;j<=5;j++) {
          for (var i =1;i<=8;i++) {

              prod[j] = prod[j] * pro_x_given_c[j][i];

          }
      }

      var evidence =0;
      for (var i=1;i<=5;i++) {
          evidence += prod[i];

      }
      
      evidence *= 0.2;


       for (var i=1;i<=5;i++) {

          pro_c_given_x[i]= 0.2 * prod[i] / evidence ;

       }

      

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
                  { label: "schema volume change", y: pro_c_given_x[1] },
                  { label: "redundancy",  y: pro_c_given_x[2] },                                    
                  { label: "loss of information",  y: pro_c_given_x[3] },
                  { label: "No forward compatibility",  y: pro_c_given_x[4] },
                  { label: "No backward compatibility",  y: pro_c_given_x[5] }
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
 <input type='button' value='Next2' onclick="myFunction()"/>  
 <p id="demo"></p> 
</body>
</html>