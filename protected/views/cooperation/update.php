<?php
$this->breadcrumbs=array(
    'Сотрудничество' => array('index', 'org' => $this->menu_org->id),
    $model->link=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Сотрудничество</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
