<?php
$this->breadcrumbs=array(
    'Доноры' => array('index', 'org' => $this->menu_org->id),
    'Донор'=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Донора</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
