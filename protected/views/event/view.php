<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Events'=>array('index'),
    $model->name,
);

$this->menu=array(
    array('label' => 'Управление Мероприятиями'),
    array('label' => 'Изменить Мероприятие', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Мероприятие', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1>View Event #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'organization_id',
        'author_id',
        'name',
        'category',
        'type_id',
        'type_other',
        'create_time',
        'start_time',
        'end_time',
        'city_id',
        'address_id',
        'address_other',
        'address_description',
        'description',
        'status',
        'invite_closed',
    ),
)); ?>
