<?php
$this->breadcrumbs=array(
    'Мероприятия',
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/dynamicListviewUpdate.js'
);
?>

<div class="row">
    <div class="span6">
        <?php $this->renderPartial('_searchMainFilter',array(
            'model'=>$model,
        )); ?>

        <?php $this->widget('bootstrap.widgets.TbListView',array(
            'id' => 'announcement-listview',
            'dataProvider' => $model->search(),
            'itemView' => '_view',
            // 'viewData' => array('albumId' => $model->id),
            // 'template' => '{items}{pager}', // Hide summary header.
            // 'itemsCssClass' => 'row', // Change items container class. Default: items.
            'sortableAttributes' => array(
                'name',
                'start_time',
                'end_time',
                'category',
            ),
        )); ?>
    </div>

    <div class="span3">
        <?php $this->renderPartial('_searchSubFilter',array(
            'model'=>$model,
        )); ?>
    </div>
</div>
