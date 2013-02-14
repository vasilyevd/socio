<?php
Yii::app()->clientScript->registerScript('typeChanged', "
$('#Event_type_id').change(function(){
    if ($(this).val() == " . Event::TYPE_OTHER_ORGANIZATIONAL . " ||
        $(this).val() == " . Event::TYPE_OTHER_INTERNAL . " ||
        $(this).val() == " . Event::TYPE_OTHER_PUBLIC . "
    ) {
        $('.type-toggle').show();
    } else {
        $('.type-toggle').hide();
    }
    return false;
});
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'event-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->select2Row($model, 'type_id', array(
        'data' => CHtml::listData(
            Lookup::itemsListReplace(
                'EvtypeCategory',
                Evtype::model()->findAll(array('order' => 'position')),
                'category'
            ),
            'id',
            'name',
            'category'
        ),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <div class="type-toggle"<?php echo !empty($model->type_other) ? '' : ' style="display:none"'; ?>>
        <?php echo $form->textFieldRow($model,'type_other',array('class'=>'span5','maxlength'=>128)); ?>
    </div>

    <?php echo $form->select2Row($model, 'status', array(
        'data' => Lookup::items('EventStatus'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

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
                array('org' => $model->isNewRecord ? $_GET['org'] : $model->organization_id)
            ),
            // Add file upload.
            // 'fileUpload' => null,
        ),
    )); ?>
    <?php echo $form->error($model,'description'); ?>

    <?php echo $form->labelEx($model,'start_time'); ?>
    <div class="input-append">
        <?php $this->widget('ext.EJuiDateTimePicker.EJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'start_time',
                'language'=>'ru',//default Yii::app()->language
                'mode'=>'datetime',//'datetime' or 'time' ('datetime' default)
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'timeFormat'=>'hh:mm:ss',
                    'showSecond'=>true,
                ), // jquery plugin options
        )); ?>
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>
    <?php echo $form->error($model,'start_time'); ?>

    <?php echo $form->labelEx($model,'end_time'); ?>
    <div class="input-append">
        <?php $this->widget('ext.EJuiDateTimePicker.EJuiDateTimePicker',array(
                'model'=>$model,
                'attribute'=>'end_time',
                'language'=>'ru',//default Yii::app()->language
                'mode'=>'datetime',//'datetime' or 'time' ('datetime' default)
                'options'=>array(
                    'dateFormat'=>'yy-mm-dd',
                    'timeFormat'=>'hh:mm:ss',
                    'showSecond'=>true,
                ), // jquery plugin options
        )); ?>
        <span class="add-on"><i class="icon-calendar"></i></span>
    </div>
    <?php echo $form->error($model,'end_time'); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_other',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'address_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
