<?php
$this->breadcrumbs=array('Доступность',);
$this->sectionMain = 'obj';
$this->sectionMainSub='main';
$this->pageTitle='Доступность - SocInfo';
?>

<div class="row-fluid">
	<div class="page-header">
		<h4>Карта доступности Украины</h4>
	</div>
</div>

<div class="row-fluid">
		<?php $this->widget('ext.widgets.Rhinoslider.RhinoSlider', array(
			'contentView'=>'obj_main_slider', // on ALL get renderPartial
			'contentSeparator'=>false, // if is set - separate to many items
			'theme'=>'socio',
			'htmlOptions'=>array(
				'id'=>'slider',
				'style'=>'height: 150px; margin: 0 auto; width: 100%; padding: 0 26px;',
				'class'=>'bootstrap-widget',
			),
			'options'=>array(
				'fluid'=>true,
				'autoPlay'=>true,
				'showTime'=>15000,
				'effect'=>'fade',
				'effectTime'=>100,
				'controlsPlayPause'=>false,
				'controlsMousewheel'=>false,
				'prevText'=>'<',
				'nextText'=>'>',
				'prevStyle'=>'',
				'nextStyle'=>'',
				'controlFadeTime'=>300,
				'showBullets'=>'hover',
				'showControls'=>'hover',
				'changeBullets'=>'before',
				'controlsPrevNextIn'=>false,
				'theme'=>'socio',
				'styles'=>'position,top,right,bottom,left,margin-top,margin-right,margin-bottom,margin-left,width,height,padding-left, padding-right'
			),
			'items'=>array(),
			'merge'=>false, // merge content from view and from items array
		)) ?>
	<!-- R1.1 -->
	<?
	$this->widget('ext.widgets.STbTabs', array(
			'type'=>'tabs-plain', // 'tabs' or 'pills'
			'header'=>"На карте можно определить доступность инфраструктуры:",
			'tabsContainerClass'=>'bba-map',
			'htmlOptions'=>array('class'=>'no-last', 'style'=>'background-color: rgba(255, 255, 255, 0.53);'),
			'tabs'=>array(
				array( 'label'=>'Города', 'active'=>true, 'linkOptions'=>array('style'=>'background-color: #FCB600;'),
					'content'=>$this->renderPartial('main_tab_city', '', true),
				),
				array('label'=>'Территории', 'linkOptions'=>array('style'=>'background-color: #B2DF3E;'),
					'content'=>$this->renderPartial('main_tab_area', '', true),
				),
				array('label'=>'Транспорта', 'linkOptions'=>array('style'=>'background-color: #FEEB12;'),
					'content'=>$this->renderPartial('main_tab_transport', '', true),
				),
				array('label'=>'Госсектора', 'linkOptions'=>array('style'=>'background-color: #3C82C8;'),
					'content'=>$this->renderPartial('main_tab_gos', '', true),
				),
			),
		));
	?>

	<div class="text-block">
	<div style="min-height: 200px;" class="columns">
		<div class="column3">
			<img src="/images/other/obj_main_1.jpg" class="thumbnail" style="margin:0 auto 10px auto; width: 100%; max-width: 273px;">
			<p>Украина считается одним из слабо развитых государств в сфере создания доступной архитектурной среды для людей с ограниченными возможностями. Здесь пока очень медленно продвигаются процессы, связанные с тем, чтобы инвалиды могли беспрепятственно перемещаться по городу и путешествовать. Поэтому барьеров для человека в инвалидной коляске по-прежнему много, особенно в населенных пунктах со старым жилым фондом. Наша карта поможет нам найти безбаръерные объекты в любом городе страны.</p>
			<p>
				Представьте себе, что Вы решили отправиться на инвалидной коляске в центр Киева. Вы задаете в поисковой строке слово "Киев" (или конкретный адресс) и программа генерирует карту на которой помечены различные объекты - музеи, кафе, вокзалы, общественные туалеты.
			</p>
		</div>
		<div class="column3">
			<p class="topic">ОБОЗНАЧЕНИЯ</p>
			<p>
				Для просмотра информации о доступности найдите интересующую Вас организацию на карте или выберите ее в каталоге. В левой части экрана откроется информация о доступности путей от остановок, входа в здание и внутреннего помещения (критерии оценки). Каждая иконка окрашена в один из трех цветов - зеленый, желтый красный. Цвет иконки указывает на оценку доступности:
			</p>
			<p>
				Зеленым цветом помечены полностью безбарьерные объекты. Это означает, что войти в здание можно безпрепятственно. Кроме того, объект может быть оборудован туалетом для инвалидов.
			</p>
			<p>
				Желтая иконка - частично безбарьерный объект. На входе в здание допускается одна ступенька высотой не более 7 сантиметров. На входе во все помещения, например кинозал в кинотеатре, ступеньки не допускаются.
			</p>
			<p>
				Красный цвет сигнализирует, что здание или вокзал не приспособлен для инвалидов.
			</p>
		</div>
		<div class="column3">
			<p>
				Карта доступности - электронная интерактивная карта Украины, на которой отмечены объекты социальной инфраструктуры с детальной информацией о доступности их для маломобильных групп населения, к которым можно отнести не только инвалидов, но и людей с временным нарушение здоровья, родителей с колясками, пожилых людей и некоторые другие категории населения.
			</p>
			<p class="topic">Возможности</p>
			<p>
				Инструментаррий карты постоянно расширяется, и в дальнейшем появятся новые функции, но уже сейчас можно:
				<ul>
					<li>найти интересующий объект по адрессу, названию или на самой карте</li>
					<li>посмотреть подробную информацию о доступности входа в здание, прилегающей территории и стоянки</li>
					<li>выбрать на карте только интересующие объекты (доступные, частично или полностью недоступные)</li>
					<li>добавить информацию о любом объекте самостоятельно</li>
				</ul>
			</p>
		</div>


	</div>
	</div>


</div>

<div></div>



