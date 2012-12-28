<?php
$this->breadcrumbs=array(
    'Поддержка' => array('index', 'org' => $this->menu_org->id),
    $model->link,
);

$this->menu=array(
    array('label' => 'Управление Поддержкой'),
    array('label' => 'Изменить Поддержку', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Поддержку', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->link; ?></h1>

<div class="row">
    <div class="span3">
        <div class="thumbnail">
            <?php echo CHtml::image(
                empty($model->linkOrganization) ? $model->getUploadUrl('logo') : $model->linkOrganization->getUploadUrl('logo'),
                'Лого организации'
            ); ?>
        </div>
    </div>

    <?php if (!empty($model->linkOrganization->description)): ?>
        <div class="span6">
            <?php echo $model->linkOrganization->description; ?>
        </div>
    <?php endif; ?>
</div>
<br />

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name' => 'source',
            'value' => CHtml::encode(Lookup::item('CooperationSource',$model->source)),
        ),
        array(
            'name' => 'type',
            'value' => CHtml::encode(Lookup::item('CooperationSource',$model->type)),
        ),
        'delivery_year',
        array(
            'name' => 'funds',
            'value' => CHtml::encode(Lookup::item('SupportFunds',$model->funds)),
        ),
        'funds_specific',
    ),
)); ?>

<?php echo CHtml::encode($model->description); ?>
