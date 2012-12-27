<?php
$this->breadcrumbs=array(
    'Новости' => array('index', 'org' => $this->menu_org->id),
    $model->title=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Новость</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
