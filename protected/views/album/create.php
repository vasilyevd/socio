<?php
$this->breadcrumbs=array(
    'Галерея' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Альбом</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
