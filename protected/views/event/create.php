<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);

$this->breadcrumbs=array(
    'Events'=>array('index'),
    'Create',
);
?>

<h1>Создать Мероприятие</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
