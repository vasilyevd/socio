<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);
$this->layout = '//layouts/presentation';

$this->breadcrumbs=array(
    'Мы в СМИ',
);
?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
