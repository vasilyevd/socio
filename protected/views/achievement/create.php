<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);

$this->breadcrumbs=array(
    'Достижения' => array('index', 'org' => $this->menu_org->id),
    'Создать',
);
?>

<h1>Создать Достижение</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
