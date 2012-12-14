<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Мы в СМИ' => array('massmedia/index', 'org' => $this->menu_org->id),
    $model->name,
);

$this->menu=array(
    array('label' => 'Управление Компаниями СМИ'),
    array('label' => 'Изменить Компанию СМИ', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Компанию СМИ', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1>View Mmcompany #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'name',
        'type',
        'description',
    ),
)); ?>
