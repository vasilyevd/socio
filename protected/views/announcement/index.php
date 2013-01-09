<?php
$this->breadcrumbs=array(
    'Лента',
);
?>

<?php echo $this->renderPartial('_calendar', array('model' => $model, 'attribute' => 'publication_time')); ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'announcement-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'title',
        'publication_time',
        'category',
    ),
)); ?>
