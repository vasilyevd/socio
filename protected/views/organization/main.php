<?php
$this->layout='//layouts/main';

$this->breadcrumbs=array(
    'Организации',
);
?>
<div class="row-fluid">
		<div class="page-header">
			<div class="header-menu">
				<?php echo CHtml::link('Создать организацию', array('organization/create'), array('class'=>'btn btn-colored')); ?>
			</div>
			<h4>Организации</h4>
		</div>
		<div class="sub-header">
			Список организаций, партий, движений, центров, гражданских акций и инициатив.
			<div class="info">
				Всего зарегистрировано <em>1478</em> организаций
			</div>
		</div>
</div>

<!-- GLOBAL ROW -->
<div class="row">

    <!-- C1 -->
    <div class="span8">

        <!-- C1 R1 -->
	    <div class="row-fluid show-grid">
		    <!-- R1.1 -->
		    <div class="columns">
			    <div class="column2">
			    <p>Является статистическим информационным путеводителем по объектам государственной, общественной и транспортной инфраструктуры городов и сел Украины, с указанием их архитектурной доступности и приспособленности для свободного доступа людей с инвалидностью.</p>
			    </div>
			    <div class="column">
			    <p>На карте вы найдете безбарьерные объекты и маршруты, а также спортивные учреждения для людей с инвалидностью.</p><p>Каждый может принять участие в составлении картыдоступности!</p>
			    </div>
			    <div class="column4">
			    <p>Наша карта доступности поможет Вам найти безбарьерные объекты в любом городе Украины </p>
			    </div>
		    </div>
	    </div>

    <!-- C1 R2 -->
    <div class="row">
        <!-- R2.1 -->
        <div class="span5">
                <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
                    'title' => 'Категории',
                    'headerIcon' => 'icon-th-list',
                    // 'htmlOptions' => array('class'=>'bootstrap-widget-table') // Remove padding.
                ));?>
                    <?php $this->widget('bootstrap.widgets.TbListView',array(
                        'dataProvider' => new CArrayDataProvider(
                            Direction::model()->findAll(),
                            array('pagination'=>false)
                        ),
                        'itemView' => 'main/direction',
                        'template' => '{items}{pager}', // Hide summary header.
                        'itemsCssClass' => 'items org-main-direction-items', // Items container class. Default: items.
                        'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
                    )); ?>
                <?php $this->endWidget();?>
        </div>
        <!-- R2.2 -->
        <div class="span3">
                <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
                    'title' => 'Типы',
                    'headerIcon' => 'icon-th-list',
                    //'htmlOptions' => array('class'=>'bootstrap-widget-table')
                ));?>
                    <?php $this->widget('bootstrap.widgets.TbListView',array(
                        'dataProvider' => new CArrayDataProvider(
                            Orgtype::model()->findAll(),
                            array('pagination'=>false)
                        ),
                        'itemView' => 'main/type',
                        'viewData' => array('groupMarker' => 0),
                        'template' => '{items}{pager}', // Hide summary header.
                        'itemsCssClass' => 'org-main-type-items', // Items container class. Default: items.
                        'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
                    )); ?>
                <?php $this->endWidget();?>
        </div>

    </div>

    <!-- C1 R3 -->
    <div class="row">
    <div class="span8">
    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Проблематики',
        'headerIcon' => 'icon-th-list',
        //'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
        <?php $this->widget('bootstrap.widgets.TbListView',array(
            'dataProvider' => new CArrayDataProvider(
                Problem::model()->findAll(),
                array('pagination'=>false)
            ),
            'itemView' => 'main/problem',
            'viewData' => array('groupMarker' => 0),
            'template' => '{items}{pager}', // Hide summary header.
            'itemsCssClass' => 'org-main-problem-items', // Items container class. Default: items.
            'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
        )); ?>
    <?php $this->endWidget();?>
    </div>
    </div>

</div>

<!-- C2 -->
<div class="span4">
    <div class="well well-small">
        <?php echo CHtml::link('Поиск организаций', array('organization/search'), array('class'=>'btn btn-success btn-block')); ?>
        <?php echo CHtml::link('Управление организациями', array('organization/admin'), array('class'=>'btn btn-success btn-block')); ?>
    </div>

    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Последние события',
        'headerIcon' => 'icon-th-list',
        //'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <?php $this->endWidget();?>

    <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
        'title' => 'Новые организации',
        'headerIcon' => 'icon-th-list',
        //'htmlOptions' => array('class'=>'bootstrap-widget-table')
    ));?>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <p>sdfgsdfgsdgfsdf ssdfsdf </p>
    <?php $this->endWidget();?>
</div>

</div>
