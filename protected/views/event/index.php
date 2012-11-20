<?php
$this->menu_org = $model;
$this->layout = '//layouts/feed';

$this->breadcrumbs=array(
    'Events',
);
?>

<?php if(!empty($model->events)): ?>
    <?php $this->widget('bootstrap.widgets.TbListView',array(
        'dataProvider' => new CArrayDataProvider($model->events, array('pagination'=>array('pageSize'=>9))),
        'itemView' => '_view',
        'template' => '{items}{pager}', // Hide summary header.
        'itemsCssClass' => 'row', // Change items container class. Default: items.
    )); ?>
<?php endif; ?>
