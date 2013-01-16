<?php
$this->breadcrumbs=array(
    'Мы в СМИ',
);
?>

<?php $this->renderPartial('_search', array(
    'model' => $model,
)); ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'massmedia-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'title',
        'category',
        'direction',
    ),
)); ?>
