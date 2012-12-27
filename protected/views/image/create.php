<?php
$this->breadcrumbs=array(
    'Галерея' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Изображение</h1>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'albums' => $this->menu_org->albums,
)); ?>
