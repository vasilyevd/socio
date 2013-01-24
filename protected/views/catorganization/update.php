<?php
$this->breadcrumbs=array(
    'Catorganizations'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);
?>

<h1>Изменить Общественную Организацию</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
