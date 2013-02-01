<?php
$this->breadcrumbs=array(
    'Documents'=>array('index'),
    $model->name,
);

$this->menu=array(
    array('label'=>'List Document','url'=>array('index')),
    array('label'=>'Create Document','url'=>array('create')),
    array('label'=>'Update Document','url'=>array('update','id'=>$model->id)),
    array('label'=>'Delete Document','url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Document','url'=>array('admin')),
);
?>

<?php echo CHtml::link('Список Документов', array('index'), array('class' => 'btn')); ?>

<?php echo CHtml::link('Изменить Документ', array('update', 'id' => $model->id), array('class' => 'btn')); ?>

<?php echo CHtml::link('Удалить Документ', '#', array(
    'submit' => array('delete', 'id' => $model->id),
    'confirm' => 'Вы уверены, что хотите удалить данный элемент?',
    'class' => 'btn btn-warning',
)); ?>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name' => 'content',
            'type' => 'raw',
        ),
        'doc_date',
        array(
            'name' => 'geography',
            'value' => Lookup::item('DocumentGeography', $model->geography),
        ),
        'registration_num',
        array(
            'name' => 'docauthor',
            'value' => empty($model->docauthor) ? '' : $model->docauthor->name,
        ),
        array(
            'name' => 'doctype',
            'value' => empty($model->doctype) ? '' : $model->doctype->name,
        ),
        'publication_date',
        array(
            'name' => 'is_active',
            'value' => $model->is_active ? 'Да' : 'Нет',
        ),
    ),
)); ?>
