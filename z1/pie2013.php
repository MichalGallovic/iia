<?php

include('ChartMaker.php');
use IIA\ChartMaker as ChartMaker;
ob_start();
$graph = new ChartMaker(600,500);
$graph->setTitle("Vysledky studentov: IIA (2012/2013)");
$graph->setLabelX("");
$graph->setLabelY("");
$graph->setColumnLabels(["A","B","C","D","E","FX","FN"]);
$graph->setData([20,11,13,7,5,0,1]);
$graph->plotPieChart();
// $graph->savePieChart("images/pie2013.png");
header ("Content-type: image/png");