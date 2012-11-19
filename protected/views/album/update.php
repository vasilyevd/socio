<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Albums'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);
?>

<h1>Изменить Альбом</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
