<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);

$this->breadcrumbs=array(
    'Партнерство' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Партнерство</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
