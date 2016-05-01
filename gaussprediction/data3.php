 <!DOCTYPE HTML>
 <html>

 <head>
 <title>Database Scheama Recommendation</title>
  <style>
    .Legend div{
    margin-left:15px;
    width:16px;
    border:1px solid #808080;
    display:inline-block;
    background-color:   black;
}
.ie7 .Legend div{
    display:inline;
    zoom:1;
}
.Red {background-color:red;}
.Green {background-color:green;}
.Blue {background-color:blue;}
.Orange {background-color:orange;}

.dropdown {
    position: absolute;
    left: 500px;
     top : 1500px;
    background-color: green;
   width: 400px;
   padding: 5px;
   font-size: 16px;
   line-height: 1;
 border:4px solid #18ab29;
   border-radius: 0;
   height: 250px;
   -webkit-appearance: none;
}
.myButton {
  position: absolute;
  left: 120px;
  background-color:blue;
  -moz-border-radius:28px;
  -webkit-border-radius:28px;
  border-radius:28px;
  border:1px solid #18ab29;
  display:inline-block;
  cursor:pointer;
  color:#ffffff;
  font-family:Arial;
  font-size:17px;
  padding:16px 31px;
  text-decoration:none;
  text-shadow:0px 1px 0px #2f6627;
}
.myButton:hover {
  background-color:#5cbf2a;
}
.styled-select select {
    position: absolute;
    top: 500;
   background-color: white;
   width: 268px;
   padding: 5px;
   font-size: 16px;
   line-height: 1;
   border: 2 solid #18ab29;
   border-radius: 0;
   height: 34px;
   -webkit-appearance: none;
   }

  .header {
    position: absolute;
    left: 400px;
  }

   .header2 {
    position: absolute;
    left: 100px;
  }
  
</style>
  





 <?php
 
 
$dbname='weights';
$conn = new mysqli('localhost','root', '', $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}



session_start();



$link = mysql_connect('localhost', $_COOKIE["uname"], $_COOKIE["pword"]);
mysql_select_db($_COOKIE["db"]);


/* LOOP FOR ACCESSING  DATABASE */ 
$sql = "SHOW TABLES FROM ".$_COOKIE["db"];
$result = mysql_query($sql);
 

mysql_select_db($_COOKIE["db"]);
$tablecount = mysql_num_rows($result);
 
 
$attributeCount = 0 ;
$PKcount = 0 ;
while ($row = mysql_fetch_row($result)) {

    $result2 = mysql_query("SHOW COLUMNS FROM ".$row[0]);
    $attributeCount +=mysql_num_rows($result2);
     

    /*while ($row2 = mysql_fetch_assoc($result2)) {
      echo($row2["Field"]."<br/>");
    }*/
//PRIMARY KEY
    
$result5 = mysql_query( "SHOW KEYS FROM " .$row[0]." WHERE Key_name = 'PRIMARY' ");
       
       
      $PKcount += mysql_num_rows($result5);
//PRIMARY KEY
 
}
 

 
$result2 = mysql_query("SHOW COLUMNS FROM ".$_POST["splittable"]);
$splittableattrcount = mysql_num_rows($result2) ;
$splittableattrpercentage = $_POST["name5"];
 
 


$result2 = mysql_query("SHOW COLUMNS FROM ".$_POST["splitatr"]);
$splitattrcount = mysql_num_rows($result2) ;
$splitattrpercentage = $_POST["name6"];
 

$result2 = mysql_query("SHOW COLUMNS FROM ".$_POST["jointable1"]);
$jointabcount1 = mysql_num_rows($result2) ;
 
 

$result2 = mysql_query("SHOW COLUMNS FROM ".$_POST["jointable2"]);
$jointabcount2 = mysql_num_rows($result2) ;
 
 
$tablesrenamed=$_POST["name8"];
$attributesretyped=$_POST["name9"];
/*LOOP ENDS HERE */


//------------------VARIABLE CALCULATIONS DONE --------------------------------

//1) WEIGHT METRICS 
//1.1) SIMPLE CHANGES
#$RefinementWt = 1000/$tablecount;
#$RemovalWt= 1000/$tablecount;
#$ReinpWt =2 * ($attributeCount/($PKcount + 0.05)) + 0.15*$PKcount;
// TODO:Multiplying two factors of reinp for scaling 



//------------------------MACHINE LEARNING SIMPLE CHANGES WEIGHTS FEATURES ------------------------------

$x1 = $_POST["name1"]/ $tablecount *10;
// add in cookie
$_SESSION["x1"] = $x1;
//echo "x1=".$_SESSION["x1"].'<br />';

$x2 = $_POST["name2"]/ $tablecount * 10;
$_SESSION["x2"] = $x2;


$x3 = $attributeCount * $_POST["name3"] /$PKcount /100;
$_SESSION["x3"] = $x3;

$x4 = $PKcount * $_POST["name3"]/ 100;
$_SESSION["x4"] = $x4;

// fetching weights from database ----------------------------
$query= "SELECT value FROM simple";
$result =$conn->query ($query);
$weight_array = array();
$i=0;
while ($row =$result->fetch_assoc()){
	$weight_array[]=$row["value"];
	//echo $weight_array[$i++];
}

$_SESSION['weights']=$weight_array;

//cho $weight_array[0];
$i=0;
$simple_sum=  $weight_array[0] + $x1*$weight_array[1] + $x2*$weight_array[2] +  $x3*$weight_array[3] +  $x4*$weight_array[4];

$_SESSION["simple_sum"] = $simple_sum;
//echo 'simple sum in session '.$_SESSION['simple_sum'].'<br />  ';
//echo $simple_sum;




//--------------------------------------DONE-----------------------------------------------------------------------
//1.2  COMPLEX CHANGES $splitattrcount 

$cx1 = $tablecount/10;
$cx2 = $splittableattrcount/10;
$cx3 = $splittableattrpercentage/100;
$cx4 = $splitattrpercentage*$attributeCount/$tablecount/1000;
$cx5 = $splitattrpercentage*$splitattrcount/1000 ; 



$cx6 = $jointabcount1/$tablecount;
$cx7 = $jointabcount2/$tablecount;

$cx8 = $_POST["name8"] / $tablecount ;
$cx9 = $_POST["name9"]/  ($tablecount*$attributeCount);


$_SESSION["cx1"] = $cx1;
$_SESSION["cx2"] = $cx2;
$_SESSION["cx3"] = $cx3;
$_SESSION["cx4"] = $cx4;
$_SESSION["cx5"] = $cx5;
$_SESSION["cx6"] = $cx6;
$_SESSION["cx7"] = $cx7;
$_SESSION["cx8"] = $cx8;
$_SESSION["cx9"] = $cx9;
 


///-------------------- acquiring weights and calculaing conmplex sum--------------



$query= "SELECT value FROM complex";
$result2 =$conn->query ($query);
$weight_array2 = array();
$i2=0;

while ($row =$result2->fetch_assoc()){
  $weight_array2[]=$row["value"];
  //echo 'complex weights ';
  //echo $weight_array2[$i2++];
}

$_SESSION['weights2']=$weight_array2;

//cho $weight_array[0];
$i2=0;
$complex_sum=  $weight_array2[0] + $cx1*$weight_array2[1] + $cx2*$weight_array2[2] + $cx3*$weight_array2[3] 
+ $cx4*$weight_array2[4] + $cx5*$weight_array2[5] + $cx6*$weight_array2[6] + $cx7*$weight_array2[7] + $cx8*$weight_array2[8] 
+ $cx9*$weight_array2[9] ;

$_SESSION["complex_sum"] = $complex_sum;




//--------------------calcualtion of complex sum done - --------------
//-----------------------------------------------------------------

//ealier work
/* 
$splitTableWt = (1500/$tablecount + 5 * $splittableattrcount)/1.75;
$splitAttrWt =  (2.5 * $splitattrcount) + 2*$attributeCount/$tablecount;
$JoinTable = 400/$tablecount +0.67*($jointabcount1 + $jointabcount2) ;
     
$RenameTabWt = 300/$tablecount ;
$RenameAttWt = 15000/($tablecount*$attributeCount);
*/

// ----------------------CALCULATING OF WEIGHTS IS DONE ---------------------------------
$Refinement = $x1*$weight_array[1];
//echo "dgds";
//echo $Refinement;
//echo "refinment over";
$Removal =  $x2*$weight_array[2];
//echo $Removal;
$Reinp = $x3*$weight_array[3] +  $x4*$weight_array[4];
$SimpleSum =$simple_sum;
$ComplexSum=$complex_sum;


$Split=  $cx1*$weight_array2[1] + $cx2*$weight_array2[2] + $cx3*$weight_array2[3] + $cx4*$weight_array2[4] + $cx5*$weight_array2[5];
$JoinTable = $cx6*$weight_array2[6] + $cx7*$weight_array2[7];
$Rename  =  $cx8*$weight_array2[8] + $cx9*$weight_array2[9] ;



/*
$Split = $splitTableWt*0.67 +  0.2*($splittableattrpercentage)+$splitAttrWt*(1+$splitattrpercentage*0.01);
$JoinTable = 400/$tablecount +0.67*($jointabcount1 + $jointabcount2) ;
$Rename = $RenameTabWt*$_POST["name8"] + $RenameAttWt*$_POST["name9"];
$ComplexSum = $Split +$JoinTable+$Rename;
*/
//echo 'testtttttttttttt';
//echo 'simple sum= '. $SimpleSum;
//echo '     complex sum= '.$complex_sum.'done2'.$Split;
$ratio = $SimpleSum/($SimpleSum+$ComplexSum)*100;
$ratio2= 100- $ratio;

$sratio1 = ($Refinement/$SimpleSum)*100 ;
$sratio2 = ($Removal/$SimpleSum) * 100 ;
$sratio3 = ($Reinp/$SimpleSum) *100 ; 



$cratio1= ($Split/$ComplexSum)*100;
$cratio2= ($JoinTable/$ComplexSum)*100;
$cratio3= ($Rename/$ComplexSum)*100;

//echo 'cratios  ----- '.$complexSum.'  done';

//echo 'testttttttttt35435ttt';

?>

<script type="text/javascript">
window.onload = function () {

  var chart1 = new CanvasJS.Chart("chartContainer",
  {
    title:{
      text: "Simple changes and complex changes",
    },
                animationEnabled: true,
    legend:{
      verticalAlign: "center",
      horizontalAlign: "left",
      fontSize: 20,
      fontFamily: "Helvetica" ,
       


    },
    theme: "theme3",
    data: [
    {        
      type: "pie",       
      indexLabelFontFamily: "Garamond",       
      indexLabelFontSize: 20,
      indexLabel: "{label} {y}%",
      startAngle:-20,

      showInLegend: true,
      toolTipContent:"{legendText} {y}%",
      dataPoints: [
        {  y: <?php echo $ratio; ?>, legendText:"Simple", label: "Simple" },
        {  y: <?php echo $ratio2; ?>, legendText:"Complex", label: "Complex" },
        
      ]
    }
    ]
  });
  chart1.render();


  var chart2 = new CanvasJS.Chart("chartContainer2",
  {
    title:{
      text: "Simple changes"
    },
                animationEnabled: true,
    legend:{
      verticalAlign: "center",
      horizontalAlign: "left",
      fontSize: 20,
      fontFamily: "Helvetica"        
    },
    theme: "theme3",
    data: [
    {        
      type: "pie",       
      indexLabelFontFamily: "Garamond",       
      indexLabelFontSize: 20,
      indexLabel: "{label} {y}%",
      startAngle:-20,      
      showInLegend: true,
      toolTipContent:"{legendText} {y}%",
      dataPoints: [
        {  y: <?php echo $sratio1; ?>, legendText:"Refinement", label: "Refinement" },
        {  y: <?php echo $sratio2; ?>, legendText:"Removal", label: "Removal" },
        {  y: <?php echo $sratio3; ?>, legendText:"Reinterpretation", label: "Reinterpretation" },
        
      ]
    }
    ]
  });
  chart2.render();


  var chart3 = new CanvasJS.Chart("chartContainer3",
  {
    title:{
      text: "Complex changes"
    },
                animationEnabled: true,
    legend:{
      verticalAlign: "center",
      horizontalAlign: "left",
      fontSize: 20,
      fontFamily: "Helvetica"        
    },
    theme: "theme3",
    data: [
    {        
      type: "pie",       
      indexLabelFontFamily: "Garamond",       
      indexLabelFontSize: 20,
      indexLabel: "{label} {y}%",
      startAngle:-20,      
      showInLegend: true,
      toolTipContent:"{legendText} {y}%",
      dataPoints: [
        {  y: <?php echo $cratio1; ?>, legendText:"Split", label: "Split" },
        {  y: <?php echo $cratio2; ?>, legendText:"Join", label: "Join" },
        {  y: <?php echo $cratio3; ?>, legendText:"Rename", label: "Rename" },
        
      ]
    }
    ]
  });
  chart3.render();



}
</script>
<script type="text/javascript" src="canvasjs.min.js"></script>






 
<!--
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Changes in Database', 'No. of tables'],
          ['Simple', <?php echo $ratio;?>], ['Complex', <?php  echo $ratio2 ;?>] 
        ]);

        var options = {
          title: 'Database Schema Evolution',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  1: {offset: 0},
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
 </script> 
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Simple Changes', 'No. of tables'],
          ['Refinement', <?php echo $sratio1;?>], ['Removal', <?php  echo $sratio2;?>] ,['Reinp', <?php  echo $sratio3;?>]
        ]);

        var options = {
          title: 'Simple Changes',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  1: {offset: 0}, 2: {offset: 0}
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart1'));
        chart.draw(data, options);
      }
 </script>


 <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.load("visualization", "1", {packages:["corechart"]});
      google.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Complex Changes', 'No. of tables'],
          ['Split', <?php echo $cratio1;?>], ['Join', <?php  echo $cratio2;?>] ,['Rename', <?php  echo $cratio3;?>]
        ]);

        var options = {
          title: 'Complex Changes',
          legend: 'none',
          pieSliceText: 'label',
          slices: {  1: {offset: 0}, 2: {offset: 0}
          },
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart2'));
        chart.draw(data, options);
      }
 </script>
 -->




</head>


<body bgcolor="#F0FFF0">






<!-- <div id="piechart" style="width: 900px; height: 500px;"></div> 
<div class="Legend">
  <div class="Blue">&nbsp;</div>
    Simple
  <div class="Red">&nbsp;</div>
    Complex
</div>
 <div id="piechart1" style="width: 900px; height: 500px;"></div> 
<div class="Legend">
  <div class="Blue">&nbsp;</div>
    Refinement
  <div class="Red">&nbsp;</div>
    Removal
    <div class="Orange">&nbsp;</div>
   Reinterpretation
</div>
 <div id="piechart2" style="width: 900px; height: 500px;"></div>  
<div class="Legend">
  <div class="Red">&nbsp;</div>
    Element Composition (Join)
  <div class="Blue">&nbsp;</div>
    Element Decomposition (Split)
    <div class="Orange">&nbsp;</div>
   Rename
</div>
-->
<div id= "chartContainer" style="height: 300px; width: 100%; " ></div>
<br /><br /><br /><br /> <br /><br /><br /><br />
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
<br /><br /><br /><br /> <br /><br /><br /><br />
<div id="chartContainer3" style="height: 300px; width: 100%;"></div>
<br /><br /><br /><br /> <br /><br /><br /><br />

<h1 class="header"> Help Us To Improve the system!</h1>
<form action="database.php" method ='post' class = "dropdown">
  <h2 class="header2">Enter your feedback</h2>
   <br /> <br />
   <br /> <br />
 <h2 class = "styled-select">Ratings
   
<select  name ="ratings" id = "ratings">
  <option value="1">1</option>
  <option value="2">2</option>
  <option value="3">3</option>
  <option value="4">4</option>
  <option value="5">5</option>
  <option value="6">6</option>
  <option value="7">7</option>
  <option value="8">8</option>
  <option value="9">9</option>
  <option value="10">10</option>
</select>
 
</h2>

<input type = 'submit' class="myButton" />
 



</body>
</html>
