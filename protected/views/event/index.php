<?php
$this->breadcrumbs=array(
    'Мероприятия',
);
?>

<?php echo $this->renderPartial('//announcement/_calendar', array('model' => $model, 'attribute' => 'start_time')); ?>

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
