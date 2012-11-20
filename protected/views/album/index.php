<?php
$this->menu_org = $model;

$this->breadcrumbs=array(
    'Организации'=>array('index'),
    CHtml::encode($model->name)=>array('view','id'=>$model->id),
    'Галерея',
);

$this->menu=array(
    array('label' => 'Управление Галереей'),
    array('label' => 'Добавить Изображение', 'icon' => 'cog', 'url' => array('image/create', 'org' => $model->id)),
    array('label' => 'Добавить Альбом', 'icon' => 'cog', 'url' => array('album/create', 'org' => $model->id)),
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/lightbox.js'
);
Yii::app()->clientScript->registerCssFile(
    Yii::app()->baseUrl.'/css/lightbox.css'
);
?>

<?php foreach ($model->albums as $a):  ?>
    <h3><?php echo CHtml::link(CHtml::encode($a->name),array('view', 'id' => $a->id)); ?></h3>
    <?php if(!empty($a->images)): ?>
        <?php $this->widget('bootstrap.widgets.TbThumbnails',array(
            'dataProvider' => new CArrayDataProvider($a->images, array('pagination'=>array('pageSize'=>3))),
            'itemView' => '_imagePreview',
            'viewData' => array('albumId' => $a->id),
            'template' => '{items}{pager}', // Hide summary header.
            // 'itemsCssClass' => 'row', // Change items container class. Default: items.
        )); ?>
    <?php endif; ?>
<?php endforeach; ?>

<h3>Все Изображения</h3>

<?php if(!empty($model->images)): ?>
    <?php $this->widget('bootstrap.widgets.TbThumbnails',array(
        'dataProvider' => new CArrayDataProvider($model->images, array('pagination'=>array('pageSize'=>3))),
        'itemView' => '_imagePreview',
        // 'viewData' => array('albumId' => $model->id),
        'template' => '{items}{pager}', // Hide summary header.
        // 'itemsCssClass' => 'row', // Items container class. Default: items.
    )); ?>
<?php endif; ?>
