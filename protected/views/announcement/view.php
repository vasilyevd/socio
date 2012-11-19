<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Уведомления'=>array('index'),
    $model->title,
);

$this->menu=array(
    array('label' => 'Управление Новостями'),
    array('label' => 'Изменить Новость', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Новость', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->title; ?></h1>
<h3><?php echo $model->publication_time; ?></h3>

<div class='row'>
    <div class='span9'>
        <?php echo $model->content; ?>
    </div>
</div>

<div class='row'>
    <div class='span9'>
        <hr>
        <b>Прикрепленные файлы:</b>
        <?php foreach ($model->files as $f): ?>
            <?php echo CHtml::link(CHtml::encode($f), $model->getUploadUrl('files', $f)); ?>
        <?php endforeach; ?>
    </div>
</div>
