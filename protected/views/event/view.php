<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Мероприятия' => array('index', 'org' => $this->menu_org->id),
    $model->name,
);

$this->menu=array(
    array('label' => 'Управление Мероприятиями'),
    array('label' => 'Изменить Мероприятие', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Мероприятие', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->name; ?></h1>
<h3><?php echo $model->start_time; ?></h3>

<div class='row'>
    <div class='span9'>
        <?php echo $model->description; ?>
    </div>
</div>
