<?php
$this->breadcrumbs=array(
    'Поддержка' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Поддержку</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
