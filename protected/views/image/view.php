<?php
$this->menu_org = Organization::model()->findByPk($model->organization_id);

$this->breadcrumbs=array(
    'Images'=>array('index'),
    $model->id,
);
?>

<h1>View Image #<?php echo $model->id; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'file',
        'create_time',
        'organization_id',
    ),
)); ?>

<?php if(!empty($albumId) && $model->getAlbumComment($albumId)): ?>
    <h1>Описание</h1>

    <?php echo CHtml::encode($model->getAlbumComment($albumId)); ?>
<?php endif; ?>
