<?php $model = empty($model) ? new Govprofile : $model; ?>

<?php echo $form->hiddenField($model, 'id'); ?>

<?php echo $form->select2Row($model, 'parent', array(
    'data' => CHtml::listData(Govorganization::model()->findAll(), 'id', 'name'),
    'prompt' => '',
    'options' => array(
        'placeholder' => 'Выбрать...',
        'allowClear' => true,
        'width' => '300px',
    ),
)); ?>
