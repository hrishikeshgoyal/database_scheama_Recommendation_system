<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title id='Description'>Charts showing Probability of changes in the different tables</title> 
	<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<script type="text/javascript" src="jqxcore.js"></script>
	<script type="text/javascript" src="jqxchart.js"></script>	
	<script type="text/javascript" src="jqxdata.js"></script>	
	<script type="text/javascript">
		$(document).ready(function () {
            // prepare chart data as an array
            var sampleData = [
<?php
$link = mysql_connect('localhost', $_COOKIE["uname"], $_COOKIE["pword"]);
$file = fopen("test.txt","wb");
$file2 = fopen("test2.txt","wb");



$sql = "SHOW TABLES FROM ".$_COOKIE["db"];
$result = mysql_query($sql);
$j=mysql_num_rows($result);
$i=1;

$change=0;
$nochange=0;

while ($row = mysql_fetch_row($result)) {
	
	//$result2 = mysql_query("SHOW COLUMNS FROM ".$row[0]);

    //echo "<h3 onClick=\"fun('".$row[0]."')\">".$row[0]."</h3><div>";
    
    fwrite($file,$row[0]);
	fwrite($file,"\n");
	mysql_select_db($_COOKIE["db"]);

	$result1 = mysql_query("SHOW COLUMNS FROM ".$row[0]);
	$rows=mysql_num_rows($result1);
	//$res=(1-exp(-$rows))/2;
	//echo "P(int) : ".$res."<br/>";

	
	mysql_select_db("information_schema");
	$result3 = mysql_query("select REFERENCED_TABLE_NAME,COLUMN_NAME from KEY_COLUMN_USAGE where TABLE_NAME='".$row[0]
                       ."' and REFERENCED_TABLE_NAME IS NOT NULL and CONSTRAINT_SCHEMA='".$_COOKIE["db"]."'");
					

	
	$tabname;
	if(mysql_num_rows($result3)<=0) {
		//echo "P(tb) : ".$res;
		$int=(1-exp(-0.4*$rows-0.5*1))/2;
	}
	else {
		//echo "P(tb) : ";
		mysql_select_db($_COOKIE["db"]);
		$count=0;
		while ($arr2=mysql_fetch_assoc($result3)){
			$result4 = mysql_query("SHOW COLUMNS FROM ".$arr2["REFERENCED_TABLE_NAME"]);
			fwrite($file2,$row[0]."\n".$arr2["REFERENCED_TABLE_NAME"]."\n");
			$r=mysql_num_rows($result4);
			
			$count++;
			$tabname=$arr2["REFERENCED_TABLE_NAME"];
			$pb+= $_SESSION['i'.$tabname]/($rows*$r);
		}
		//echo $res+$pb;
		//$pb=$pb+$res;
		
		
		$int=1-exp(-0.4*$rows-0.5*($count+1));
		$int+=$pb;
		if($int>1)$int=1;
	$his=0;
	if(isset($_SESSION[$_GET['table']])&& $_SESSION['nod'] > 0)	
	$his = ($_SESSION[$_GET['table']]/$_SESSION['nod'])*$_SESSION['nextnod']."<br>";
		
	}
	if($int>0.498) $change++;
	else $nochange++;	
	echo "{ Day: '".$i."', Goal: ".($int+$his)/2 ."}";
	if($i<$j) echo ",";
	$i++;
	
	
	
	
	
}
	
	$_SESSION["change"]= $change;
	$_SESSION["nochange"]= $nochange;
	
	
	
	//echo "</div>";







 
					/*echo "{ Day: 'Monday', Goal: 0.4 },".
                    "{ Day: 'Tuesday', Goal: 0.5 },".
                    "{ Day: 'Wednesday', Goal: 0.6 },".
                    "{ Day: 'Thursday', Goal: 0.4 },".
                    "{ Day: 'Friday', Goal: 0.5 },".
                    "{ Day: 'Saturday', Goal: 0.6 },".
                    "{ Day: 'Sunday', Goal: 0.9 }";*/
					
					
fclose($file);	
fclose($file2);				
mysql_close($link);					
?>					
                ];
            // prepare jqxChart settings
            var settings = {
                title: "P(tb)",
                description: "Total Probability",
                enableAnimations: false,
                showLegend: true,
                padding: { left: 10, top: 5, right: 10, bottom: 5 },
                titlePadding: { left: 90, top: 0, right: 0, bottom: 10 },
                source: sampleData,
                categoryAxis:
                    {
                        text: 'Category Axis',
                        textRotationAngle: 0,
                        dataField: 'Day',
                        showTickMarks: true,
                        valuesOnTicks: false,
                        tickMarksInterval: 1,
                        tickMarksColor: '#888888',
                        unitInterval: 1,
                        gridLinesInterval: 1,
                        gridLinesColor: '#888888',
                        axisSize: 'auto'
                    },
                colorScheme: 'scheme05',
                seriesGroups:
                    [
                        {
                            type: 'line',
                            showLabels: true,
                            symbolType: 'circle',
                            valueAxis:
                            {
                                unitInterval: 0.1,
                                minValue: 0,
                                maxValue: 1,
                                description: 'Probability',
                                axisSize: 'auto',
                                tickMarksColor: '#888888'
                            },
                            series: [
                                    { dataField: 'Goal', displayText: 'Probability'}
                                ]
                        }
                    ]
            };
            // setup the chart
            $('#jqxChart').jqxChart(settings);
        });
	
    </script>
</head>
<body class='default'>
    <div id='jqxChart' style="width:1080px; height:400px">
    </div>
</body>
</html>