<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'album-image-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'album_id',CHtml::listData($organization->albums, 'id', 'name'),array('prompt'=>'')); ?>

    <?php echo $form->dropDownListRow($model,'image_id',CHtml::listData($organization->images, 'id', 'file'),array('prompt'=>'')); ?>

    <?php echo $form->textAreaRow($model,'comment',array('rows'=>4, 'cols'=>50, 'class'=>'span4')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Скопировать' : 'Перенести',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
