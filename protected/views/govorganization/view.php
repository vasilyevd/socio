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
        'id',
        'name',
        'type_group',
        'type_id',
        'action_area',
        'city_id',
        'address_id',
        'foundation_year',
        'staff_size',
        'description',
        'goal',
        'website',
        'phone_num',
        'email',
        'logo',
        'logobg',
        'logobgset',
        'author_id',
        'create_time',
        'status',
        'verified',
    ),
)); ?>
