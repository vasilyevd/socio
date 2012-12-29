<?php
$this->breadcrumbs=array(
    'Мероприятия' => array('index', 'org' => $this->menu_org->id),
    $model->name=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Мероприятие</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
