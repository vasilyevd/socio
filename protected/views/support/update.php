<?php
$this->breadcrumbs=array(
    'Поддержка' => array('index', 'org' => $this->menu_org->id),
    $model->link=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Поддержку</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
