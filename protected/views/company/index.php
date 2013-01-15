<?php
$this->breadcrumbs=array(
    'Companies',
);
?>

<h1>Пиар Компании</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'massmedia-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'name',
        'type',
    ),
)); ?>
