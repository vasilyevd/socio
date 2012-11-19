<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'image-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->dropDownListRow($model,'defaultAlbum',CHtml::listData($albums, 'id', 'name')); ?>

    <?php echo $form->fileFieldRow($model,'file'); ?>

    <?php echo $form->textAreaRow($model,'defaultComment',array('rows'=>4, 'cols'=>50, 'class'=>'span6')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
