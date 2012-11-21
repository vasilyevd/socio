<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Галерея' => array('index', 'org' => $this->menu_org->id),
    $model->name=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Альбом</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
