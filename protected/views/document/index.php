<?php
$this->breadcrumbs=array(
    'Documents',
);

$this->menu=array(
    array('label'=>'Create Document','url'=>array('create')),
    array('label'=>'Manage Document','url'=>array('admin')),
);
?>

<?php echo CHtml::link('Добавить Документ', array('create'), array('class' => 'btn')); ?>

<h1>Гос. Документы</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'document-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        array(
            'name' => 'doc_date',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'date',
                'url' => $this->createUrl('editableUpdate'),
                'format' => 'yyyy-mm-dd',
                'viewformat'  => 'yyyy-mm-dd',
                'placement' => 'top',
                'enabled' => true,
            ),
        ),
        array(
            'name' => 'geography',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('editableUpdate'),
                'source' => Lookup::items('DocumentGeography'),
                'placement' => 'top',
                'enabled' => true,
            ),
            'filter' => Lookup::items('DocumentGeography'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
