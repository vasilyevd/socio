<?php
$this->breadcrumbs=array(
    'Доноры' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Донора</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
