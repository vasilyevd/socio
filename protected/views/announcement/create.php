<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);

$this->breadcrumbs=array(
    'Новости'=>array('index'),
    'Создать',
);
?>

<h1>Создать Новость</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
