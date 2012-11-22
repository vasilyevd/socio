<?php
class StatChartWidget extends CWidget
{
	public $items=array();
	public $htmlOptions=array();
	public $options=array();
	public $datastring = '';
	
	public function init()
	{
		$this->htmlOptions['id']='chart_div_'.$this->htmlOptions['id'];
		
	}
	
	
	
	public function run()
	{
		
		$this->datastring = $this->constructData($this->items);
		$this->renderContent($this->datastring);
	}	

	protected function renderContent($datastring)
	{
		
		Yii::app()->clientScript->registerScriptFile('https://www.google.com/jsapi');
		Yii::app()->clientScript->registerScript('chart_'.$this->htmlOptions['id'], "
google.load('visualization', '1', {packages:['corechart']});
google.setOnLoadCallback(drawChart_".$this->getId().");

      function drawChart_".$this->getId()."() {
				
        var data = google.visualization.arrayToDataTable(".$datastring.");

        var options = {
          title: '".$this->options['title']."',
          legend: {position: 'out', width:'100'},
					chartArea:{left: '50',top: 'auto',width:'300',height:'80px'},
					series: [{color: 'green', visibleInLegend: true},{color: '#F9E253', visibleInLegend: true}, {color: 'red', visibleInLegend: true}, {color: 'grey', visibleInLegend: false}],
					tooltip: {showColorCode: true},
					bar: {groupWidth: '100%'},
					
					hAxis:{
						textStyle: {fontSize: 10},
						gridlines: {count: 5},
						minValue: 0
					}
        };

        // var chart = new google.visualization.ColumnChart(document.getElementById('".$this->htmlOptions['id']."'));
				var chart = new google.visualization.BarChart(document.getElementById('".$this->htmlOptions['id']."'));
				
        chart.draw(data, options);
      }
			
			function update_chart(id, data) {
				var id='#".$this->htmlOptions['id']."';
				var b = JSON.parse(data);
				var arr = google.visualization.arrayToDataTable(b);
				
        var options = {
          title: '".$this->options['title']."',
          legend: {position: 'out', width:'100'},
					chartArea:{left: '50',top: 'auto',width:'300',height:'80px'},
					series: [{color: 'green', visibleInLegend: true},{color: '#F9E253', visibleInLegend: true}, {color: 'red', visibleInLegend: true}, {color: 'grey', visibleInLegend: false}],
					tooltip: {showColorCode: true},
					bar: {groupWidth: '100%'},
					hAxis:{
						textStyle: {fontSize: 10},
						gridlines: {count: 5},
						minValue: 0
					}
        };
				
				var chart = new google.visualization.BarChart(document.getElementById('".$this->htmlOptions['id']."'));
				chart.draw(arr, options);
			}
			
					
", CClientScript::POS_HEAD);

	echo CHtml::openTag('div',$this->htmlOptions);
			// echo '" style="width: 350px; height: 100px; float:left;"></div>';
echo CHtml::closeTag('div');

	}
	
	protected function constructData($items)
	{
		$text = array("'Доступно'", "'Частично'", "'Не доступно'", "'Не известно'");
		// print_r($text);
			if ($this->options['notshow3']) {
				unset($items[3]);
				unset($text[3]);
			}
		if ($this->options['notshowzero']) {
			foreach($items as $k => $v){
				// echo $k."-".$v."<br>";
				if ((int)$v==0) {
					// echo "unset<br>";
					unset($items[$k]);
					unset($text[$k]);
				}
			}
			$items = array_diff($items, array(0, ''));
		} 
		// print_r($text);
		// print_r($items);
		return "[['Всего', ".implode(", ", $text)."], ['', ".implode(", ", $items)." ]]";
	}
	

	
	
}
?>