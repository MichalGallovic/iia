<?php

include('ChartMaker.php');
use IIA\ChartMaker as ChartMaker;

$graph = new ChartMaker(600,400);
$graph->setBackgroundColor(200,200,200);
$graph->setLabelX("Znamky");
$graph->setLabelY("Pocet znamok");
$graph->setColumnLabels(["A","B","C","D","E","FX","FN"]);
$graph->setLabelColor(0,0,230);
$graph->setData([20,11,13,7,5,0,1]);
$graph->setColumnColor(255,44,0);
$graph->setTitle("Vysledky studentov: IIA (2012/2013)");
$graph->setColumnPadding(10);
$graph->plotBarChart();
// $graph->saveBarChart("images/bar2013.png");
header ("Content-type: image/png");
?>