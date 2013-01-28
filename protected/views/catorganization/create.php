<?php
$this->breadcrumbs=array(
    'Catorganizations'=>array('index'),
    'Create',
);
?>

<h1>Создать Общественную Организацию</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
