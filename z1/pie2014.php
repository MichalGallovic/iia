<?php

include('ChartMaker.php');
use IIA\ChartMaker as ChartMaker;
ob_start();
$graph = new ChartMaker(600,500);
$graph->setTitle("Vysledky studentov: IIA (2013/2014)");
$graph->setLabelX("");
$graph->setLabelY("");
$graph->setColumnLabels(["A","B","C","D","E","FX","FN"]);
$graph->setData([20,19,6,3,1,0,0]);
$graph->plotPieChart();
// $graph->savePieChart("images/pie2014.png");
header ("Content-type: image/png");