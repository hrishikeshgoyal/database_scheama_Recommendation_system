<!DOCTYPE HTML>
<html>

<head></head>
<?php




echo'
<script type="text/javascript">
window.onload = function () {
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
				{ label: "banana", y: 18 },
				{ label: "orange", y: 29 },
				{ label: "apple",  y: 40 },                                    
				{ label: "mango",  y: 34 },
				{ label: "grape",  y: 24 }
			]
		}
		]
		});

	chart.render();
}

</script>
<script type="text/javascript" src="canvasjs.min.js"></script>';
?>

<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
</body>

</html>
