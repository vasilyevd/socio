<?php
/** @var $this Controller  */
$this->layout='//layouts/main';

$this->sectionMain = "org";
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
                Всего зарегистрировано <em>1337</em> организаций
            </div>
        </div>
</div>

    <!-- RhinoROW -->
    <div class="row">
        <div class="span8">
            <?php $this->widget('ext.widgets.Rhinoslider.RhinoSlider', array(
                'contentView'=>'org_main_slider', // on ALL get renderPartial
                'contentSeparator'=>false, // if is set - separate to many items
                'theme'=>'socio',
                'htmlOptions'=>array(
                    'id'=>'slider',
                    'style'=>'height: 200px; margin: 0;',
                    'class'=>'bootstrap-widget',
                ),
                'options'=>array(
                    'autoPlay'=>true,
                    'showTime'=>10000,
                    'effect'=>'fade',
                    'effectTime'=>100,
                    'controlsPlayPause'=>false,
                    'controlsMousewheel'=>false,
                    'prevText'=>'<',
                    'nextText'=>'>',
                    'controlFadeTime'=>0,
                    'showBullets'=>'hover',
                    'showControls'=>'never',
                    'changeBullets'=>'before',
                    'controlsPrevNextIn'=>true,
                ),
                'items'=>array(),
                'merge'=>false, // merge content from view and from items array
            )) ?>
        </div>
        <div class="span4">
            <?php $this->widget('ext.widgets.Rhinoslider.RhinoSlider', array(
                'contentView'=>'org_main_types', // on ALL get renderPartial
                'contentSeparator'=>false, // if is set - separate to many items
                'theme'=>'socio-boxn',
                'htmlOptions'=>array(
                    'id'=>'slider2',
                    'style'=>'height: 200px; margin: 0;'),
                'options'=>array(
                    'autoPlay'=>true,
                    'showTime'=>8000,
                    'effect'=>'fade',
                    'effectTime'=>100,
                    'controlsPlayPause'=>false,
                    'showControls'=>'hover',
                    'controlFadeTime'=>0,
                    'showBullets'=>'always',
                    'changeBullets'=>'before',
                ),
                'items'=>array(),
                'merge'=>false, // merge content from view and from items array
            )) ?>
        </div>
    </div>
    <!-- END RhonoROW -->

    <!-- Global ROW -->
    <div class="row">
    <div class="span6">  <!-- C1 -->

        <!-- NEWS -->
         <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Последние события',
            'headerIcon' => 'icon-th-list',
            //'htmlOptions' => array('class'=>'bootstrap-widget-table')
        ));?>
            <?php $this->widget('bootstrap.widgets.TbListView',array(
                'dataProvider' => new CArrayDataProvider(
                    Announcement::getLatestNews(10),
                    array('pagination'=>false)
                ),
                'itemView' => 'main/news',
                'template' => '{items}{pager}', // Hide summary header.
                // 'itemsCssClass' => 'items org-main-direction-items', // Items container class. Default: items.
                'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
            )); ?>
        <?php $this->endWidget();?>

        <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
            'title' => 'Новые организации',
            'headerIcon' => 'icon-th-list',
            //'htmlOptions' => array('class'=>'bootstrap-widget-table')
        ));?>
            <?php $this->widget('bootstrap.widgets.TbListView',array(
                'dataProvider' => new CArrayDataProvider(
                    Organization::getLatestOrganizations(5),
                    array('pagination'=>false)
                ),
                'itemView' => 'main/organization',
                'template' => '{items}{pager}', // Hide summary header.
                // 'itemsCssClass' => 'items org-main-direction-items', // Items container class. Default: items.
                'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
            )); ?>
        <?php $this->endWidget();?>
        <!-- NEWS end-->

        <!-- buttons -->
        <div class="well well-small">
          <?php echo CHtml::link('Поиск организаций', array('organization/search'), array('class'=>'btn btn-success btn-block')); ?>
          <?php echo CHtml::link('Управление организациями', array('organization/admin'), array('class'=>'btn btn-success btn-block')); ?>
           </div>
          <!-- buttons end -->
    </div>

        <!-- C2 -->
        <div class="span6">
            <!-- CATEGORYES -->
            <?php $box = $this->beginWidget('bootstrap.widgets.TbBox', array(
                'title' => 'Направления деятельности',
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
            <!-- CATEGORYES end -->


            <!-- PROBLEMS end -->
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
            <!-- PROBLEMS end -->

        </div>
    </div>

</div>
