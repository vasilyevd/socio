<?php
$this->breadcrumbs=array(
    'Достижения' => array('index', 'org' => $this->menu_org->id),
    $model->title,
);

$this->menu=array(
    array('label' => 'Управление Достижениями'),
    array('label' => 'Изменить Достижение', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Достижение', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->title; ?></h1>

<div class='row'>
    <div class='span9'>
        <?php echo $model->content; ?>
    </div>
</div>
