<!DOCTYPE html>

<?php
$file = fopen("galFiltered.json","w");

fwrite($file,"{");
fwrite($file,"\"elements\":{");

fwrite($file,"\"nodes\":[");
$file2=fopen("../test.txt","r");

$i=0;
while(($txt=fgets($file2))!=false){
if($i!=0)fwrite($file,",");
fwrite($file,"{\"data\":{\"id\":\"".trim($txt)."\"}}");
$i=1;
}
fclose($file2);

fwrite($file,"],");

fwrite($file,"\"edges\":[");
$file3=fopen("../test2.txt","r");

$i=0;
while(($txt=fgets($file3))!=false){
$txt2=fgets($file3);
if($i!=0)fwrite($file,",");
fwrite($file,"{\"data\":{\"id\":\"".trim($txt2).trim($txt)."\",\"source\":\"".trim($txt2)."\",\"target\":\"".trim($txt)."\"}}");
$i=1;
}

fclose($file3);
fwrite($file,"]");

fwrite($file,"}");
fwrite($file,"}");

fclose($file);
?>

<html>

<head>
    <title>Graph showing tables and relationships</title>

    <link href="css/reset.css" rel="stylesheet"/>
    <link href="css/font-awesome.css" rel="stylesheet"/>
    <link href="css/style.css" rel="stylesheet"/>

    <!-- Libraries -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/arbor.js"></script>
    <script src="js/cytoscape.min.js"></script>

    <!-- Sample Script -->
    <script src="js/draw_graph.js"></script>

</head>

<body>
<h2>Graph showing tables and relationships</h2>

<div id="network-view"></div>
</body>
</html>