<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);
$this->layout = '//layouts/presentation';

$this->breadcrumbs=array(
    'Достижения',
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'events-listview',
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    // 'sortableAttributes' => array(
    //     'title',
    //     'publication_time',
    //     'category',
    // ),
)); ?>
