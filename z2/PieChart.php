<?php namespace IIA;

require('colorhelpers.php');

class PieChart {
	private $data;
	private $columnLabels;
	private $properties;
	private $canvas;
	private $pieColors;


	public function __construct($data, $columnLabels, $properties) {
		$this->data = $data;
		$this->columnLabels = $columnLabels;
		$this->properties = $properties;
		$this->pieColors = [];
		$this->setColors();
	}

	private function setColors() {
		if (isset($this->data)) {
			$num_labels = count($this->data);

			for($i = 0; $i < 360; $i += 360 / $num_labels) {
				$hue = $i;
				$saturation = 90;
				$lightness = 50;
				$rgb = ColorHSLtoRGB($hue/360, $saturation/100, $lightness/100);

				array_push($this->pieColors, $rgb);
			}
		}
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
		$this->drawLegend();
		$this->drawTitle();
	}

	private function drawBackground(){
		//draw background
		$backgroundColor = imagecolorallocate($this->canvas, $this->properties["backgroundColor"]["r"],
		$this->properties["backgroundColor"]["g"], $this->properties["backgroundColor"]["b"]);
		imagefilledrectangle($this->canvas, 0, 0, $this->properties["width"], $this->properties["height"], $backgroundColor);
	}

	private function drawTitle(){
		$length = strlen($this->properties["titleText"]);
		$color = imagecolorallocate($this->canvas, $this->properties["titleColor"]["r"],
		$this->properties["titleColor"]["g"], $this->properties["titleColor"]["b"]);
		imagestring($this->canvas, 5, (($this->properties["width"]/2)-($length*5)),
		 20, $this->properties["titleText"], $color);
	}

	private function drawLabels() {
		//draw Label X and Y
		$length = strlen($this->properties["labelXText"]);
		$color = imagecolorallocate($this->canvas, $this->properties["labelColor"]["r"],
		$this->properties["labelColor"]["g"], $this->properties["labelColor"]["b"]);
		imagestring($this->canvas, 5, (($this->properties["width"]/2)-($length*5)), $this->properties["height"]-30, $this->properties["labelXText"], $color);
		imagestringup($this->canvas, 5, 10, (($this->properties["height"]/2)+($length*5)), $this->properties["labelYText"], $color);
	}

	private function drawLegend() {
		$legend = $this->data;
		$legendWidth = $this->properties["legendWidth"];
		$marginTop = $this->properties["marginTop"];
		$marginBottom = $this->properties["marginBottom"];
		$legendMarginLeft = 20;
		$legendPadding = 10;
		$height = $this->properties["height"];
		$legendItemHeight  = ($height - $marginTop - $marginBottom)/count($legend);
		$textMargin = 10;

		$fontSize = 3;
		$legendTextColor = imagecolorallocate($this->canvas, $this->properties["legendColor"]["r"],
			$this->properties["legendColor"]["g"],$this->properties["legendColor"]["b"]);

		for ($i = 0; $i < count($legend); $i++) {
			$x1 = $this->properties["width"] - $legendWidth + $legendMarginLeft;
			$y1 = (($i+1) * $legendItemHeight + $marginTop - $legendPadding);
			$x2 = $this->properties["width"] - $legendWidth +  $legendMarginLeft + $legendItemHeight - $legendPadding;
			$y2 = ($i * $legendItemHeight) + $marginTop;

			$color = imagecolorallocate($this->canvas, $this->pieColors[$i]["r"],$this->pieColors[$i]["g"],
				$this->pieColors[$i]["b"]);
			imagefilledrectangle($this->canvas, $x1, $y1, $x2, $y2, $color);

			$legendLabel = "";
			if (isset($this->columnLabels[$i])) {
				$legendLabel = $this->columnLabels[$i];
			}
			imagestring($this->canvas, $fontSize, $x2+$textMargin, ($y2+$legendItemHeight/3)-($fontSize*2), $legendLabel, $legendTextColor);

		}
	}

	private function drawChart(){
		
		
		$num_items = count($this->data);
		$sum_items = array_sum($this->data);

		$marginTop = $this->properties["marginTop"];
		$marginBottom = $this->properties["marginBottom"];
		$marginLeft = $this->properties["marginLeft"];
		$marginRight = $this->properties["marginRight"];
		$width = $this->properties["width"];
		$legendWidth = $this->properties["legendWidth"];
		$height = $this->properties["height"];

		$cx = ($width - $legendWidth)/2;
		$cy = $height/2;
		$piePadding = 20;
		$pieHeight = $height - $marginBottom - $marginTop - $piePadding*2;
		$pieWidth = $width - $marginLeft - $marginRight - $piePadding*2 - $legendWidth;

		$startAngle = 0;
		$endAngle = 0;
		for($i = 0; $i< $num_items; $i++) {
			$endAngle = 360*($this->data[$i]/$sum_items) + $startAngle;
			$color = imagecolorallocate($this->canvas, $this->pieColors[$i]["r"],$this->pieColors[$i]["g"],
				$this->pieColors[$i]["b"]);
			imagefilledarc($this->canvas, $cx, $cy, $pieWidth, $pieHeight,
			 $startAngle, $endAngle, $color, IMG_ARC_PIE);

			$startAngle += $endAngle;
		}



	}

}