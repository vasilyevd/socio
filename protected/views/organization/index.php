<?php
$this->sectionMain = 'org';
$this->sectionMainSub='org';
$this->contentClass = 'pading';
$this->breadcrumbs=array(
    'Организации',
);

$this->layout='//layouts/column1';

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/dynamicListviewUpdate.js'
);
?>

<div class="row">
    <div class="span9">
        <?php $this->renderPartial('_searchMainFilter',array(
            'model'=>$model,
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbListView',array(
            'id' => 'organization-listview',
            'dataProvider' => $model->search(),
            'itemView' => '_view',
            // 'viewData' => array('albumId' => $model->id),
            // 'template' => '{items}{pager}', // Hide summary header.
            'itemsCssClass' => 'org-search-list', // Items container class. Default: items.
            'sortableAttributes' => array(
                'name',
                'type',
                'action_area',
            ),
        )); ?>
    </div>

    <div class="span3">
        <?php $this->renderPartial('_searchSubFilter',array(
            'model'=>$model,
        )); ?>
    </div>
</div>
