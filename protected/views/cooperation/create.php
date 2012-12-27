<?php
$this->breadcrumbs=array(
    'Сотрудничество' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Сотрудничество</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
