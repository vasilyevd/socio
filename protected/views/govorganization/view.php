<?php echo CHtml::link('Список Организаций', array('index'), array('class' => 'btn')); ?>

<?php echo CHtml::link('Изменить Организацию', array('update', 'id' => $model->id), array('class' => 'btn')); ?>

<?php echo CHtml::link('Удалить Организацию', '#', array(
    'submit' => array('delete', 'id' => $model->id),
    'confirm' => 'Вы уверены, что хотите удалить данный элемент?',
    'class' => 'btn btn-warning',
)); ?>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name' => 'type_group',
            'value' => $model->TypeGroup->text,
        ),
        array(
            'name' => 'type',
            'value' => empty($model->type) ? '' : $model->type->name,
        ),
        array(
            'name' => 'action_area',
            'value' => $model->ActionArea->text,
        ),
        'city_id',
        'address_id',
        'foundation_year',
        'staff_size',
        array(
            'name' => 'description',
            'type' => 'raw',
        ),
        array(
            'name' => 'goal',
            'type' => 'raw',
        ),
        'website',
        'phone_num',
        'email',
        'logo',
        'logobg',
        'logobgset',
        'author_id',
        'create_time',
        array(
            'name' => 'status',
            'value' => $model->Status->text,
        ),
        array(
            'name' => 'verified',
            'value' => $model->verified ? 'Да' : 'Нет',
        ),
        array(
            'name' => 'parent',
            'type' => 'raw',
            'value' => empty($model->parent) ? '' : CHtml::link(CHtml::encode($model->parent->name), array('govorganization/view', 'id' => $model->parent->id), array('target' => '_blank')),
        ),
    ),
)); ?>
