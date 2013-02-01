<?php
$this->breadcrumbs=array(
    'Documents'=>array('index'),
    'Create',
);

$this->menu=array(
    array('label'=>'List Document','url'=>array('index')),
    array('label'=>'Manage Document','url'=>array('admin')),
);
?>

<?php echo CHtml::link('Список Документов', array('index'), array('class' => 'btn')); ?>

<h1>Создать Документ</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
