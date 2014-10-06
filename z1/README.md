ChartMaker
---

Little php utility made for easy **chart making**.
Currently supports:
  - bar charts

###How to use it

```php
$chart = new CharMaker(300,400); // initialize chart canvas
$chart->setData([12,5,23,60]); // set chart data
$chart->plotBarChart(); // plot chart
```

###Currently you can set
  - width - *setWidth($numeric)*
  - height - *setHeight($numeric)*
  - labelColor - *setLabelColor($red,$green,$blue)* - int or string
  - labelXText - *setLabelX($string)*
  - labelYText - *setLabelY($string)*
  - titleColor - *setTitleColor($red,$green,$blue)*
  - backgroundColor - *setBackgroundColor($red,$green,$blue)*
  - columnPadding - *setColumnPadding($numberic)*
  - marginLeft - *setMarginLeft($numberic)*
  - marginRight - *setMarginRight($numberic)*
  - marginBottom - *setMarginBottom($numberic)*
  - marginTop - *setMarginTop($numberic)*
  - columnColor - *setColumnColor($red,$green,$blue)*
  - columnLabelColor - *setColumnLabelColor($red,$green,$blue)*
  - data - *setData($array)*
  - columnLabels - *setColumnLabels($array)*

###Contribution

If you find any issues, please report them - I would be really thankful.
