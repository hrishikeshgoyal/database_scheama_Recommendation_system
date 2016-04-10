 <html>

 <head>
  <style>
    .Legend div{
    margin-left:15px;
    width:16px;
    border:1px solid #808080;
    display:inline-block;
}
.ie7 .Legend div{
    display:inline;
    zoom:1;
}
.Red {background-color:red;}
.Green {background-color:green;}
.Blue {background-color:blue;}
.Orange {background-color:orange;}
</style>
  </head>


<body>

 <?php


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
$RefinementWt = 1000/$tablecount;
$RemovalWt= 1000/$tablecount;
$ReinpWt =2 * ($attributeCount/($PKcount + 0.05)) + 0.15*$PKcount;
// TODO:Multiplying two factors of reinp for scaling 

//1.2  COMPLEX CHANGES $splitattrcount 
$splitTableWt = (1500/$tablecount + 5 * $splittableattrcount)/1.75;
$splitAttrWt =  (2.5 * $splitattrcount) + 2*$attributeCount/$tablecount;
$JoinTable = 400/$tablecount +0.67*($jointabcount1 + $jointabcount2) ;
 
$RenameTabWt = 300/$tablecount ;
$RenameAttWt = 15000/($tablecount*$attributeCount);
// ----------------------CALCULATING OF WEIGHTS IS DONE ---------------------------------
$Refinement = $RefinementWt*$_POST["name1"];
$Removal = $RemovalWt*$_POST["name2"];
$Reinp = $RefinementWt*$_POST["name3"];
 $SimpleSum =$Refinement+$Removal+$Reinp;

$Split = $splitTableWt*0.67 +  0.2*($splittableattrpercentage)+$splitAttrWt*(1+$splitattrpercentage*0.01);
$JoinTable = 400/$tablecount +0.67*($jointabcount1 + $jointabcount2) ;
$Rename = $RenameTabWt*$_POST["name8"] + $RenameAttWt*$_POST["name9"];
$ComplexSum = $Split +$JoinTable+$Rename;


$ratio = $SimpleSum/($SimpleSum+$ComplexSum)*100;
$ratio2=100- $ratio;

$sratio1 = ($Refinement/$SimpleSum)*100 ;
$sratio2 = ($Removal/$SimpleSum) * 100 ;
$sratio3 = ($Reinp/$SimpleSum) *100 ; 

$cratio1= ($Split/$ComplexSum)*100;
$cratio2= ($JoinTable/$ComplexSum)*100;
$cratio3= ($Rename/$ComplexSum)*100;
 






 ?>

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

<div id="piechart" style="width: 900px; height: 500px;"></div>
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

 

</body>
</html>
