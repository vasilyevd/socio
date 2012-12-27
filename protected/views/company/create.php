<?php
$this->breadcrumbs=array(
    'Мы в СМИ' => array('massmedia/index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Компанию СМИ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
