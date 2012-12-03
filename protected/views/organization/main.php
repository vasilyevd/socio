<?php
$this->layout='//layouts/main';

$this->breadcrumbs=array(
    'Организации',
);
?>
<!-- GLOBAL ROW -->
<div class="row">

    <!-- C1 -->
    <div class="span8">

        <!-- C1 R1 -->
        <div class="row show-grid">
            <!-- R1.1 -->
            <div class="span2">
                <img src="<?php echo $this->createUrl('images/other/orgmain.jpg'); ?>" class="img-polaroid">
            </div>
            <!-- R1.2 -->
            <div class="span6">
                <p>Описание раздела</p>
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
        <?php echo CHtml::link('Создать организацию', array('organization/create'), array('class'=>'btn btn-success btn-block')); ?>
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
