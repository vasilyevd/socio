<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'achievement-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->labelEx($model,'content'); ?>
    <?php $this->widget('bootstrap.widgets.TbRedactorJs', array(
        'model' => $model,
        'attribute' => 'content',
        'lang' => 'ru',
        'editorOptions' => array(
            // Add image upload.
            // 'imageUpload' => null,
            // Add image gallery.
            'imageGetJson' => Yii::app()->createAbsoluteUrl(
                'site/dynamicImageGetJson',
                array('org' => $model->isNewRecord ? $_GET['org'] : $model->organization_id)
            ),
            // Add file upload.
            // 'fileUpload' => null,
        ),
    )); ?>
    <?php echo $form->error($model,'content'); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
