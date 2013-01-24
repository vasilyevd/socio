<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'catorganization-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->datepickerRow($model, 'registration_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>'));
    ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'region_id',array('class'=>'span5')); ?>

    <?php echo $form->select2Row($model, 'action_area', array(
        'data' => Lookup::items('OrganizationActionArea'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'directions', array(
        'data' => CHtml::listData(Direction::model()->findAll(), 'id', 'name'),
        'multiple' => true,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'directions_more',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'chief_fio',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'registration_num',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->select2Row($model, 'organization', array(
        'data' => CHtml::listData(Organization::model()->findAll(), 'id', 'name'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->radioButtonListInlineRow($model, 'is_legal', array('' => 'Не известно', true => 'Да', false => 'Нет')); ?>

    <?php echo $form->textFieldRow($model,'logo',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'is_branch',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'branch_master',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'is_verified',array('class'=>'span5')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
