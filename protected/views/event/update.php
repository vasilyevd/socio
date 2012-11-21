<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Мероприятия'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Мероприятие</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
