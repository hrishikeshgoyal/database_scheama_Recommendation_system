<html>
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
   
  <script type="text/javascript" src="canvasjs.min.js"></script>
  
<?php


session_start();
$servername = "localhost";
$username ="root";// $_SESSION['uname'];

$password = "";//$_SESSION['pword'];

$dbname = "mediawiki";//$_SESSION['db'];

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


include 'trainingdata.php';
include 'gaussprediction.php';







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
 



"</table>
</form>";



echo "<br/><br/>";


$allatts = array();

$sql="SHOW TABLES FROM ".$dbname;
$result = $conn->query($sql);
$cnt = $result->num_rows;
//echo $cnt;
$n_tables=$cnt;


while ($row = mysqli_fetch_row($result)) {
  
  $result2 = $conn->query("SHOW COLUMNS FROM ".$row[0]);    
  //echo $result2->num_rows;
  
  if (($result2->num_rows) > 0) {
    while ($row2 = mysqli_fetch_assoc($result2)) {
        array_push($allatts, $row2['Field']);
    }
  }
  
  
  
}

//echo count ($allatts);

/*foreach ($allatts as $value) {
    echo $value;
} */







?>

<script>

   
 var n_att=0;
  var new_att= new Array();

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
  all_param[2] =(n_att);
  all_param[3]=(0);
  var imp1,imp2,imp3,imp4,imp5,imp6,rudy=0;

  var temp1;
function myFunction() {
    //var fruits = ["Banana", "Orange", "Apple", "Mango"];
    //new_att= new Array (<?php echo implode(',', $allatts); ?> );
    
    
    //pro_x_given_c.toString();
    //all_mean.toString();
    //all_variance.toString();
    //all_param.toString(); 
   // pro_x_given_c.toString();
    pro_c_given_x.toString();  
   // prod.toString(); 
    document.getElementById("demo").innerHTML = pro_c_given_x; //all_variance; // all_mean; //pro_c_given_x.toString();
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
      all_param[4]= (rudy);
      all_param[5]=  (0);
      all_param[6]= (0);
      var x7=0;
     for ( i=0; i< alllen; i++) {

          for ( j=i+1; j< alllen; j++) { 
              if (all_att[j] === all_att[i]) {

                x7++;   
              
              }
          }

      }

      all_param[7]= (x7);
      all_param[8]= (0);


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

      

    var  imp2 = 12;
     var imp1  = 55;



     var imp3 = 10;
    var  imp4 = 90;
      var imp5 = 10;
             

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

<button type='button' onclick = 'show_graph()'>show impacts </button> 



<br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>


  <input type='button' value='Next' onclick="document.location.href='show_del.php'"/>
   <input type='button' value='Showing Values' onclick="myFunction()"/>  
   
 
<p id="demo"></p>


</body>
 
</html>