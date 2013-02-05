<?php echo CHtml::link('Добавить Организацию', array('create'), array('class' => 'btn')); ?>

<h1>Государственные Организации</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'govorganization-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        'create_time',
        array(
            'name' => 'action_area',
            'value' => '$data->ActionArea->text',
            'filter' => $model->ActionArea->list,
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
