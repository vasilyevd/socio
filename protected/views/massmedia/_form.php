<?php
// Handle element copy.
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.relcopy.js');
Yii::app()->getClientScript()->registerScript('relCopy', "
jQuery('.copylink').relCopy();
$('.removelink').click(function(){
    if ($('.' + $(this).parent().attr('class')).length > 1){
        $(this).parent().slideUp(function(){ $(this).remove() });
    };
    return false;
});
");
?>


<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'massmedia-form',
    'enableAjaxValidation'=>true,

    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'title',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->radioButtonListRow($model, 'category', Lookup::items('MassmediaCategory')); ?>

    <?php echo $form->toggleButtonRow($model, 'direction', array(
        'options' => array(
            'enabledLabel' => 'Мы в СМИ',
            'disabledLabel' => 'СМИ о нас',
            'width' => 200,
        ),
    )); ?>

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
    <br />

    <div class="well">
        <?php echo $form->labelEx($model,'files'); ?>
        <?php $lastIndex = count($model->files) - 1; ?>
        <?php foreach ($model->files as $i => $m): ?>
            <div class="copy-files-row" rel="copy<?php echo $i; ?>">
                <?php echo $form->hiddenField($m,"[$i]id"); ?>

                <?php echo $form->labelEx($m,"[$i]name"); ?>

                <?php if (!empty($m->name)): ?>
                    <div class="exclude"><?php echo CHtml::link(CHtml::encode($m->name), $m->getUploadUrl('name'), array('target' => '_blank')); ?></div>
                <?php endif; ?>
                <?php echo $form->fileField($m,"[$i]name"); ?>
                <?php echo $form->dropDownList($m,"[$i]category",Lookup::items('MmfileCategory'),array('prompt'=>'')); ?>

                <?php echo CHtml::link('Убрать', '#', array('class' => 'removelink')); ?>

                <?php echo $form->error($m,"[$i]name"); ?>
                <?php echo $form->error($m,"[$i]category"); ?>
            </div>
        <?php endforeach; ?>
        <?php echo CHtml::link('Добавить', '#', array('class' => 'copylink btn btn-info btn-small', 'rel' => '.copy-files-row')); ?>
        <?php echo $form->error($model,'files'); ?>
    </div>

    <div class="well">
        <?php echo $form->labelEx($model,'links'); ?>
        <?php $lastIndex = count($model->links) - 1; ?>
        <?php foreach ($model->links as $i => $m): ?>
            <div class="copy-links-row" rel="copy<?php echo $i; ?>">
                <?php echo $form->hiddenField($m,"[$i]id"); ?>

                <?php echo $form->labelEx($m,"[$i]name"); ?>

                <?php echo $form->textField($m,"[$i]name",array('class'=>'span5','maxlength'=>128)); ?>
                <?php echo CHtml::link('Убрать', '#', array('class' => 'removelink')); ?>

                <?php echo $form->error($m,"[$i]name"); ?>
            </div>
        <?php endforeach; ?>
        <?php echo CHtml::link('Добавить', '#', array('class' => 'copylink btn btn-info btn-small', 'rel' => '.copy-links-row')); ?>
        <?php echo $form->error($model,'links'); ?>
    </div>

    <?php echo $form->select2Row($model, 'tags', array(
        'asDropDownList' => false, // Tag mode.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'tags' => array_values(CHtml::listData(Mmtag::model()->findAll(), 'id', 'name')), // Tag mode.
            'tokenSeparators' => array(',', ' '), // Tag mode.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
