<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Сотрудничество' => array('index', 'org' => $this->menu_org->id),
    $model->link,
);

$this->menu=array(
    array('label' => 'Управление Сотрудничеством'),
    array('label' => 'Изменить Сотрудничество', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Сотрудничество', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->link; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'link',
        'description',
        'create_time',
        'organization_id',
    ),
)); ?>
