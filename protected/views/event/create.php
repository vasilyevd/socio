<?php
$this->breadcrumbs=array(
    'Мероприятия' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Мероприятие</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
