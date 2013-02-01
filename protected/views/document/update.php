<?php
$this->breadcrumbs=array(
    'Documents'=>array('index'),
    $model->name=>array('view','id'=>$model->id),
    'Update',
);

$this->menu=array(
    array('label'=>'List Document','url'=>array('index')),
    array('label'=>'Create Document','url'=>array('create')),
    array('label'=>'View Document','url'=>array('view','id'=>$model->id)),
    array('label'=>'Manage Document','url'=>array('admin')),
);
?>

<?php echo CHtml::link('Список Документов', array('index'), array('class' => 'btn')); ?>

<?php echo CHtml::link('Профиль Документа', array('view', 'id' => $model->id), array('class' => 'btn')); ?>

<h1>Изменить Документ</h1>

<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
