<!DOCTYPE HTML>




<html>

<head> 

<?php 

echo 'hello';
?>  
<script type="text/javascript">
window.onload = function () {
	var chart1 = new CanvasJS.Chart("chartContainer2",
	{
		title:{
			text: "Desktop Search Engine Market Share, Dec-2012"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 20,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
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
				{  y: <?php echo 83.24; ?>, legendText:"Google", label: "Google" },
				{  y: 8.16, legendText:"Yahoo!", label: "Yahoo!" },
				{  y: 4.67, legendText:"Bing", label: "Bing" },
				{  y: 1.67, legendText:"Baidu" , label: "Baidu"},       
				{  y: 0.98, legendText:"Others" , label: "Others"}
			]
		}
		]
	});
	chart1.render();






	var chart2 = new CanvasJS.Chart("chartContainer3",
	{
		title:{
			text: "Desktop Search Engine Market Share, Dec-2012"
		},
                animationEnabled: true,
		legend:{
			verticalAlign: "center",
			horizontalAlign: "left",
			fontSize: 20,
			fontFamily: "Helvetica"        
		},
		theme: "theme2",
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
				{  y: 83.24, legendText:"Google", label: "Google" },
				{  y: 8.16, legendText:"Yahoo!", label: "Yahoo!" },
				{  y: 4.67, legendText:"Bing", label: "Bing" },
				{  y: 1.67, legendText:"Baidu" , label: "Baidu"},       
				{  y: 0.98, legendText:"Others" , label: "Others"}
			]
		}
		]
	});
	chart2.render();
}
</script>
<script type="text/javascript" src="canvasjs.min.js"></script> 
</head>
<body>
<div id="chartContainer2" style="height: 300px; width: 100%;"></div>
<div id="chartContainer3" style="height: 300px; width: 100%;"></div>
</body>


</html>
