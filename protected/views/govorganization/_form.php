<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'govorganization-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
    'type' => 'horizontal',
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'action_area', array(
        'data' => $model->ActionArea->list,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->redactorRow($model, 'description', array('class'=>'span4', 'rows'=>5)); ?>

    <?php echo $form->redactorRow($model, 'goal', array('class'=>'span4', 'rows'=>5)); ?>

    <?php echo $form->select2Row($model, 'foundation_year', array(
        'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'staff_size',array('class'=>'span5')); ?>

    <?php echo $form->textAreaRow($model,'phone_num',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-globe"></i>')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-envelope"></i>')); ?>

    <div class="well">
        <?php echo $form->labelEx($model, 'profile'); ?>
            <?php echo $this->renderPartial('_form/profile', array('form' => $form, 'model' => $model->profile)); ?>
        <?php echo $form->error($model, 'profile'); ?>
    </div>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
