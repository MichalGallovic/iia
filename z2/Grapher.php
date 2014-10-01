<?php

class Grapher {

	// gd looks like state machine, so after changing any property
	// it needs to be recreated

	private $properties = [
		"width"				=>	200,
		"height"			=>	200,
		"labelColor"		=>	["r"=>0,"g"=>0,"b"=>0], //default black
		"labelXText"		=>	"axis x",
		"labelYText"		=>	"axis y",
		"titleText"				=>	"Graph",
		"titleColor"		=>	["r"=>0,"g"=>0,"b"=>0],
		"backgroundColor"	=>	["r"=>100,"g"=>100,"b"=>100], //default gray,
		"columnPadding"		=>	5,
		"marginLeft"		=>	50,
		"marginBottom"		=>	60,
		"marginTop"			=>	70,
		"marginRight"		=>	50,
		"columnColor"		=>	["r"=>0,"g"=>255,"b"=>0],
		"columnLabelColor"	=>	["r"=>0,"g"=>0,"b"=>0]
	];

	//image
	private $canvas;
	private $data;
	private $columnLabels;

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
	public function setLabelX($label) {
		$this->properties["labelXText"] = $label;
	}

	public function setLabelY($label) {
		$this->properties["labelYText"] = $label;
	}
	public function setTitle($title) {
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
		$this->properties["labelColor"]["r"] = $red;
		$this->properties["labelColor"]["g"] = $green;
		$this->properties["labelColor"]["b"] = $blue;
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

	public function setBackgroundColorRGB($red, $green, $blue) {
		if (is_numeric($red) && is_numeric($green) && is_numeric($blue)) {
			$this->properties["backgroundColor"]["r"] = $red;
			$this->properties["backgroundColor"]["g"] = $green;
			$this->properties["backgroundColor"]["b"] = $blue;
		} else {
			throw new Exception('Colors must be in numeric format');
		}
	}



	private function refreshPlot(){
		//recreate image canvas
		$this->canvas = imagecreate($this->properties["width"], $this->properties["height"]);
		$this->drawBackground();
		$this->drawLabels();
		$this->drawTitle();
	}

	private function drawBackground(){
		//draw background
		$backgroundColor = imagecolorallocate($this->canvas, $this->properties["backgroundColor"]["r"],
		$this->properties["backgroundColor"]["g"], $this->properties["backgroundColor"]["b"]);
		imagefilledrectangle($this->canvas, 0, 0, $this->properties["width"], $this->properties["height"], $backgroundColor);
	}

	private function drawLabels() {
		//draw Label X and Y
		$length = strlen($this->properties["labelXText"]);
		$color = imagecolorallocate($this->canvas, $this->properties["labelColor"]["r"],
		$this->properties["labelColor"]["g"], $this->properties["labelColor"]["b"]);
		imagestring($this->canvas, 5, (($this->properties["width"]/2)-($length*5)), $this->properties["height"]-30, $this->properties["labelXText"], $color);
		imagestringup($this->canvas, 5, 10, (($this->properties["height"]/2)+($length*5)), $this->properties["labelYText"], $color);
	}

	private function drawTitle(){
		$length = strlen($this->properties["titleText"]);
		$color = imagecolorallocate($this->canvas, $this->properties["titleColor"]["r"],
		$this->properties["titleColor"]["g"], $this->properties["titleColor"]["b"]);
		imagestring($this->canvas, 5, (($this->properties["width"]/2)-($length*5)),
		 20, $this->properties["titleText"], $color);
	}


	public function plotBarChart(){
		$this->refreshPlot();
		if (isset($this->data)) {
			$this->drawBarChart();
		}
		imagepng($this->canvas);
	}

	private function drawBarChart(){
		
		$max_value = max($this->data);
		$marginLeft = $this->properties["marginLeft"];
		$marginBottom = $this->properties["marginBottom"];
		$marginTop = $this->properties["marginTop"];
		$marginRight = $this->properties["marginRight"];
		$padding = $this->properties["columnPadding"];
		$width = $this->properties["width"];
		$height = $this->properties["height"];

		$columns = count($this->data);
		$column_width = ($width-$marginLeft-$marginRight)/$columns;

		$columnColor = imagecolorallocate($this->canvas, $this->properties["columnColor"]["r"],
			$this->properties["columnColor"]["g"],$this->properties["columnColor"]["b"]);
		$columnLabelColor = imagecolorallocate($this->canvas, $this->properties["columnLabelColor"]["r"],
			$this->properties["columnLabelColor"]["g"],$this->properties["columnLabelColor"]["b"]);

		for ($i=0; $i < $columns; $i++) { 

			$column_height = ($height - $marginBottom - $marginTop) * ($this->data[$i]/$max_value);
			

			$x1 = $i*$column_width + $marginLeft;
			$y1 = $height - $marginBottom;
			$x2 = ($i+1)*$column_width + $marginLeft - $padding;
			$y2 = $height - $marginBottom - $column_height;

			$columnCenterX = $x2 - ($x2-$x1)/2;
			$columnCenterYBottom = $y1 +10;
			$columnCenterYTop = $y2 - 20;
			imagefilledrectangle($this->canvas, $x1, $y1, $x2, $y2, $columnColor);

			$columnLabel = "";
			if (isset($this->columnLabels[$i])) {
				$columnLabel = $this->columnLabels[$i];
			}
			imagestring($this->canvas, 3, $columnCenterX, $columnCenterYBottom, $columnLabel, $columnLabelColor);
			$length = strlen($this->data[$i]);
			imagestring($this->canvas, 3, $columnCenterX-($length*3), $columnCenterYTop, $this->data[$i], $columnLabelColor);

		}

	}



}