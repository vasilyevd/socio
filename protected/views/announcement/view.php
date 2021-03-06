<?php
$this->layout = '//layouts/announcement';
$this->breadcrumbs=array(
    'Новости' => array('index', 'org' => $this->menu_org->id),
    $model->title,
);

$this->menu=array(
    array('label' => 'Управление Новостями'),
    array('label' => 'Изменить Новость', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Новость', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1>
    <?php echo $model->title; ?>
    <?php if (!empty($model->category)): ?>
        (<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $model->category)); ?>)
    <?php endif; ?>
</h1>

<h3><?php echo $model->publication_time; ?></h3>

<div class='row'>
    <div class='span9'>
        <?php echo $model->content; ?>
    </div>
</div>

<?php if (!empty($model->files)): ?>
    <div class='row'>
        <div class='span9'>
            <hr>
            <strong>Прикрепленные файлы:</strong>
            <?php foreach ($model->files as $m): ?>
                <?php echo CHtml::link(CHtml::encode($m->name), $m->getUploadUrl('name')); ?>
            <?php endforeach; ?>
        </div>
    </div>
<?php endif; ?>
