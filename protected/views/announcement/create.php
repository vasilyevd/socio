<?php
$this->breadcrumbs=array(
    'Новости' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Новость</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
