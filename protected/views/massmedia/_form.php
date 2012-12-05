<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'massmedia-form',
    'enableAjaxValidation'=>true,
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

    <br />
    <?php $this->widget('ext.jqrelcopy.JQRelcopy', array(
       'id' => 'copylink',
       // 'removeText' => 'remove' //uncomment to add remove link
    )); ?>
    <a id="copylink" href="#" rel=".copy">Copy</a>


    <div class="well">
        <?php echo $form->labelEx($model,'links'); ?>
        <?php foreach ($model->links as $i => $l): ?>
            <?php echo $form->hiddenField($l,"[$i]id"); ?>
            <?php echo $form->textFieldRow($l,"[$i]name",array('class'=>'span5','maxlength'=>128)); ?>
        <?php endforeach; ?>

        <div class="copy">
            <?php echo $form->hiddenField(new Mmlink,"[]id"); ?>
            <?php echo $form->textFieldRow(new Mmlink,'[]name',array('class'=>'span5','maxlength'=>128)); ?>
        </div>
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
