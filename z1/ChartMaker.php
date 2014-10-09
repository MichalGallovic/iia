<?php namespace IIA;
/*
* Copyright (c) 2014 All Rights Reserved
* author: Michal Gallovic
*/
require('BarChart.php');
require('PieChart.php');

class ChartMaker {

	// gd looks like state machine, so after changing any property
	// it needs to be recreated

	protected $properties = [
		"width"				=>	200,
		"height"			=>	200,
		"labelColor"		=>	["r"=>0,"g"=>0,"b"=>0], //default black
		"labelXText"		=>	"axis x",
		"labelYText"		=>	"axis y",
		"titleText"			=>	"Graph",
		"titleColor"		=>	["r"=>0,"g"=>0,"b"=>0],
		"backgroundColor"	=>	["r"=>100,"g"=>100,"b"=>100], //default gray,
		"columnPadding"		=>	5,
		"marginLeft"		=>	50,
		"marginBottom"		=>	60,
		"marginTop"			=>	70,
		"marginRight"		=>	50,
		"columnColor"		=>	["r"=>0,"g"=>255,"b"=>0],
		"columnLabelColor"	=>	["r"=>0,"g"=>0,"b"=>0],
		"legendWidth"		=>	150,
		"legendColor"		=>	["r"=>0,"g"=>0,"b"=>0]
	];

	//image
	// protected $canvas;
	protected $data;
	protected $columnLabels;

	public function __construct($width, $height,$data = null,$columnLabel = null) {
		if ($width >= 200) {
			$this->properties["width"] = $width;
		}
		if($height >= 200) {
			$this->properties["height"] = $height;
		}
		
		$this->data = $data;
		$this->columnLabels = $columnLabel;
	}

	public function setData($data) {
		if (!is_array($data)) {
			throw new Exception('Graph data must be in array format.');
		}

		$this->data = $data;
		
	}
	public function setWidth($width) {
		if (!is_numeric($width)) {
			throw new Exception('Width must be numeric');
		}
		$this->properties["width"] = $width;
	}
	public function setHeight($height) {
		if (!is_numeric($width)) {
			throw new Exception('Height must be numeric');
		}
		$this->properties["height"] = $height;
	}
	public function setLabelX($label) {
		if (is_array($label)) {
			throw new Exception('Label cannot be array');
		}
		$this->properties["labelXText"] = $label;
	}

	public function setLabelY($label) {
		if (is_array($label)) {
			throw new Exception('Label cannot be array');
		}
		$this->properties["labelYText"] = $label;
	}
	public function setTitle($title) {
		if (is_array($title)) {
			throw new Exception('Title cannot be array');
		}
		$this->properties["titleText"] = $title;
	}

	public function setColumnLabels($columnLabels) {
		if (!is_array($columnLabels)) {
			throw new Exception('Column labels must be in array format.');
		}
		$this->columnLabels = $columnLabels;
	}

	public function setColumnLabelColor($red,$green,$blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["columnLabelColor"]["r"] = $red;
			$this->properties["columnLabelColor"]["g"] = $green;
			$this->properties["columnLabelColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
		
	}

	public function setLabelColor($red,$green,$blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["labelColor"]["r"] = $red;
			$this->properties["labelColor"]["g"] = $green;
			$this->properties["labelColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
	}

	public function setLegendColor($red,$green,$blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["legendColor"]["r"] = $red;
			$this->properties["legendColor"]["g"] = $green;
			$this->properties["legendColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
	}

	public function setTitleColor($red,$green,$blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["titleColor"]["r"] = $red;
			$this->properties["titleColor"]["g"] = $green;
			$this->properties["titleColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
	}

	public function setColumnPadding($padding) {
		if (is_numeric($padding)) {
			$this->properties["columnPadding"] = $padding;
		}
	}

	public function setMarginLeft($marginLeft) {
		if (is_numeric($marginLeft)) {
			$this->properties["marginLeft"] = $marginLeft;
		}
	}

	public function setMarginRight($marginRight) {
		if (is_numeric($marginRight)) {
			$this->properties["marginRight"] = $marginRight;
		}
	}

	public function setMarginTop($marginTop) {
		if (is_numeric($marginTop)) {
			$this->properties["marginTop"] = $marginTop;
		}
	}

	public function setMarginBottom($marginBottom) {
		if (is_numeric($marginBottom)) {
			$this->properties["marginBottom"] = $marginBottom;
		}
	}

	public function setColumnColor($red,$green,$blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["columnColor"]["r"] = $red;
			$this->properties["columnColor"]["g"] = $green;
			$this->properties["columnColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
		
	}

	public function setBackgroundColor($red, $green, $blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["backgroundColor"]["r"] = $red;
			$this->properties["backgroundColor"]["g"] = $green;
			$this->properties["backgroundColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
	}

	public function setLegendWidth($width) {
		if (is_numeric($width)) {
			$this->properties["legendWidth"] = $width;
		} else {
			throw new Exception("Legend width must be in numeric format");
		}
	}

	public function plotBarChart(){
		$chart = new BarChart($this->properties, $this->data, $this->columnLabels);

		$chart->plot();
	}

	public function saveBarChart($path) {
		$chart = new BarChart($this->data, $this->columnLabels, $this->properties);
		$chart->save($path);
	}

	public function plotPieChart(){
		$chart = new PieChart($this->data, $this->columnLabels, $this->properties);
		$chart->plot();
	}
	public function savePieChart($path){
		$chart = new PieChart($this->data, $this->columnLabels, $this->properties);
		$chart->save($path);
	}

}
