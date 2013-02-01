<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id' => 'document-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->redactorRow($model, 'content', array('class'=>'span4', 'rows'=>5)); ?>

    <?php echo $form->datepickerRow($model, 'doc_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <?php echo $form->select2Row($model, 'geography', array(
        'data' => Lookup::items('DocumentGeography'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'registration_num',array('class'=>'span5','maxlength'=>128)); ?>

    <div class="control-group">
        <?php echo $form->labelEx($model, 'docauthor', array('class' => 'control-label')); ?>
        <div class="controls">
            <?php $model->docauthor = is_object($model->docauthor) ? $model->docauthor->name : $model->docauthor; ?>
            <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
                'model' => $model,
                'attribute' => 'docauthor',
                'source' => $this->createUrl('docauthorAutoComplete'),
                'options' => array(
                    'delay' => 300,
                    'minLength' => 2,
                    'showAnim' => 'fold',
                ),
                'htmlOptions' => array(
                    'class' => 'span5',
                ),
            )); ?>
            <?php echo $form->error($model, 'docauthor'); ?>
        </div>
    </div>

    <?php echo $form->select2Row($model, 'doctype', array(
        'data' => CHtml::listData(Doctype::model()->findAll(), 'id', 'name'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->datepickerRow($model, 'publication_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <?php echo $form->checkBoxRow($model, 'is_active'); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
