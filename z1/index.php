<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>IIA - Zadanie 2</title>
	<link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
</head>
<body>
	<nav class="navbar navbar-default" role="navigation">
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">IIA Zadanie 1</a>
    </div>

    <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Michal Gallovič</a></li>
      </ul>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      
     
    </div><!-- /.navbar-collapse -->
  </div>
</nav>

<div class="container">
	<div class="well">
		<h1>PHP Generated charts</h1>
		<div class="row" style="margin-top: 40px">
			<div class="col-xs-6">
				<div>
					
					<a href="barcharts.php">
						<img src="thumbs.php?image=bar2013.png" alt="">
						BarCharts</a>
				</div>
			</div>
			<div class="col-xs-6">
				
				<div>
					
					<a href="piecharts.php">
						<img src="thumbs.php?image=pie2013.png" alt="">
						PieCharts</a>
				</div>
			</div>
		</div>
	</div>
	<div class="well">
		<h1>Google Chart</h1>
		<div class="row">
			<div class="col-xs-6">
				<div id="barchart2013"></div>
				<div id="barchart2014"></div>
			</div>
			<div class="col-xs-6">
				 <div id="piechart2013"></div>
				 <div id="piechart2014"></div>
			</div>
		</div>
	</div>
</div>
<!--Load the AJAX API-->
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">

      // Load the Visualization API and the piechart package.
      google.load('visualization', '1.0', {'packages':['corechart']});

      // Set a callback to run when the Google Visualization API is loaded.
      google.setOnLoadCallback(drawChart);

      // Callback that creates and populates a data table,
      // instantiates the pie chart, passes in the data and
      // draws it.
      function drawChart() {

        // Create the data table.
        var data1 = new google.visualization.DataTable();
        data1.addColumn('string', 'Marks');
        data1.addColumn('number', 'Count');
        data1.addRows([
          ['A', 20],
          ['B', 11],
          ['C', 13],
          ['D', 7],
          ['F', 5],
          ['FX',0],
          ['FN',1]
        ]);

        // Set chart options
        var options1 = {'title':'Výsledky študentov IIA: (2012/2013)',
                       'width':400,
                       'height':300};

        // Instantiate and draw our chart, passing in some options.
        var chart1 = new google.visualization.PieChart(document.getElementById('piechart2013'));
        chart1.draw(data1, options1);
        var chart2 = new google.visualization.PieChart(document.getElementById('piechart2014'));
         var data2 = new google.visualization.DataTable();
         var options2 = {'title':'Výsledky študentov IIA: (2013/2014)',
                       'width':400,
                       'height':300};
        data2.addColumn('string', 'Marks');
        data2.addColumn('number', 'Count');
        data2.addRows([
          ['A', 20],
          ['B', 19],
          ['C', 6],
          ['D', 3],
          ['F', 1],
          ['FX',0],
          ['FN',0]
        ]);
        chart2.draw(data2,options2);

        var barchart1 = new google.visualization.BarChart(document.getElementById('barchart2013'));
        barchart1.draw(data1,options1);
        var barchart2 = new google.visualization.BarChart(document.getElementById('barchart2014'));
        barchart2.draw(data2,options2);
      }
    </script>
</body>
</html>