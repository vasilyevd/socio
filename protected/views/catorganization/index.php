<?php
$this->breadcrumbs=array(
    'Catorganizations',
);
?>

<h1>Общественные Организации</h1>

<?php echo CHtml::link('Добавить Организацию', array('create'), array('class' => 'btn btn-success')); ?>

<p>CGridView?<p>
<p>CGridView?<p>
<p>CGridView?<p>

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
