<?php

require('ChartMaker.php');
// $graph = new Grapher(600,400);
// $graph->setBackgroundColorRGB(200,200,200);
// $graph->setLabelX("Znamky");
// $graph->setLabelY("Pocet znamok");
// $graph->setColumnLabels(["A","B","C","D","E","FX","FN"]);
// $graph->setLabelColor(0,0,230);
// $graph->setData([20,11,13,7,5,0,1]);
// $graph->setColumnColor(255,44,0);
// $graph->setTitle("Vysledky studentov: IIA (2012/2013)");
// $graph->plotBarChart();

$graph2 = new Grapher(300,200,[10,20,30,40,50]);
$graph2->setLabelColor(100,200,200);
$graph2->plotBarChart();

header ("Content-type: image/png");
