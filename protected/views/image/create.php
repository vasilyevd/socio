<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);

$this->breadcrumbs=array(
    'Images'=>array('index'),
    'Create',
);
?>

<h1>Создать Изображение</h1>

<?php echo $this->renderPartial('_form', array(
    'model' => $model,
    'albums' => $this->menu_org->albums,
)); ?>
