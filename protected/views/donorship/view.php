<?php
$this->breadcrumbs=array(
    'Доноры' => array('index', 'org' => $this->menu_org->id),
    CHtml::encode($model->donor->name),
);

$this->menu=array(
    array('label' => 'Управление Донорами'),
    array('label' => 'Изменить Донора', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Донора', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo CHtml::encode($model->donor->name); ?> (<?php echo CHtml::encode($model->donor->country); ?>)</h1>

<div class="row">
    <div class="span3">
        <div class="thumbnail">
            <?php echo CHtml::image(
                $model->donor->getUploadUrl('logo'),
                'Лого организации'
            ); ?>
        </div>
    </div>

    <div class="span6">
        <p><?php echo CHtml::encode($model->donor->description); ?></p>
        <p><?php echo CHtml::link(CHtml::encode($model->donor->website), $model->donor->website, array('target' => '_blank')); ?></p>
        <p><?php echo CHtml::link(CHtml::encode($model->donor->email), 'mailto:' . $model->donor->email); ?></p>
    </div>
</div>
<br />

<?php $this->widget('bootstrap.widgets.TbDetailView',array(
    'data'=>$model,
    'attributes'=>array(
        array(
            'name' => 'source',
            'value' => CHtml::encode(Lookup::item('DonorshipSource',$model->source)),
        ),
        array(
            'name' => 'type',
            'value' => CHtml::encode(Lookup::item('DonorshipType',$model->type)),
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
