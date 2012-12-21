<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);
$this->layout = '//layouts/potential';

$this->breadcrumbs=array(
    'Сотрудничество',
);
?>

<h1>Сотрудничество</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'massmedia-listview',
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    // 'sortableAttributes' => array(
    //     'title',
    // ),
)); ?>
