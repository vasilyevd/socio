<?php echo $form->labelEx($model,'description'); ?>
<?php $this->widget('bootstrap.widgets.TbRedactorJs', array(
    'model' => $model,
    'attribute' => 'description',
    'lang' => 'ru',
    'editorOptions' => array(
        // Add image upload.
        // 'imageUpload' => null,
        // Add image gallery.
        'imageGetJson' => Yii::app()->createAbsoluteUrl(
            'select/dynamicImageGetJson',
            array('org' => $model->id)
        ),
        // Add file upload.
        // 'fileUpload' => null,
    ),
)); ?>
<?php echo $form->error($model,'description'); ?>

<?php echo $form->labelEx($model,'goal'); ?>
<?php $this->widget('bootstrap.widgets.TbRedactorJs', array(
    'model' => $model,
    'attribute' => 'goal',
    'lang' => 'ru',
    'editorOptions' => array(
        // Add image upload.
        // 'imageUpload' => null,
        // Add image gallery.
        'imageGetJson' => Yii::app()->createAbsoluteUrl(
            'select/dynamicImageGetJson',
            array('org' => $model->id)
        ),
        // Add file upload.
        // 'fileUpload' => null,
    ),
)); ?>
<?php echo $form->error($model,'goal'); ?>

<?php echo $form->select2Row($model, 'foundation_year', array(
    'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
    // 'multiple' => true,
    'prompt' => '', // Blank for all drop.
    'options' => array(
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>

<?php echo $form->textFieldRow($model,'staff_size',array('class'=>'span5')); ?>

<?php echo $form->textAreaRow($model,'phone_num',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
