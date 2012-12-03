<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Мы в СМИ' => array('index', 'org' => $this->menu_org->id),
    $model->title=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Элемент СМИ</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
