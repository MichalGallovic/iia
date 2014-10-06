<?php namespace IIA;

class BarChart {
	private $data;
	private $columnLabels;
	private $properties;
	private $canvas;

	public function __construct($data, $columnLabels, $properties) {
		$this->data = $data;
		$this->columnLabels = $columnLabels;
		$this->properties = $properties;
	}

	public function plot() {
		$this->refreshPlot();
		if (isset($this->data)) {
			$this->drawChart();
		}
		imagepng($this->canvas);
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

	private function drawChart(){
		
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