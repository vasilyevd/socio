<?php
$this->breadcrumbs=array(
    'Мы в СМИ' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Элемент СМИ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
