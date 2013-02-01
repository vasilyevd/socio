<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'donorship-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->radioButtonListRow($model, 'source', Lookup::items('DonorshipSource')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('DonorshipType'),
        // 'asDropDownList' => false, // Tag mode.
        // 'multiple' => true, // Multiple mode without 'asDropDownList'.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            // 'multiple' => true, // Multiple mode with 'asDropDownList'.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->labelEx($model, 'donor'); ?>
    <?php $model->donor = is_object($model->donor) ? $model->donor->name : $model->donor; ?>
    <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'donor',
        'source' => $this->createUrl('donorAutoComplete'),
        'options' => array(
            'delay' => 300,
            'minLength' => 2,
            'showAnim' => 'fold',
        ),
        'htmlOptions' => array(
            'class' => 'span5',
        ),
    )); ?>
    <?php echo $form->error($model, 'donor'); ?>

    <?php echo $form->select2Row($model, 'funds', array(
        'data' => Lookup::items('SupportFunds'),
        // 'asDropDownList' => false, // Tag mode.
        // 'multiple' => true, // Multiple mode without 'asDropDownList'.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            // 'multiple' => true, // Multiple mode with 'asDropDownList'.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:function(e) {
                if (e.val == "' . Support::FUNDS_OTHER . '") {
                    $(".funds-specific-toggle").show();
                } else {
                    $(".funds-specific-toggle").hide();
                }
                return false;
            }',
        ),
    )); ?>

    <div class="funds-specific-toggle"<?php echo empty($model->funds_specific) ? ' style="display:none"' : ''; ?>>
        <?php echo $form->textFieldRow($model,'funds_specific',array('class'=>'span5','maxlength'=>128)); ?>
    </div>

    <?php echo $form->select2Row($model, 'delivery_year', array(
        'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
        // 'asDropDownList' => false, // Tag mode.
        // 'multiple' => true, // Multiple mode without 'asDropDownList'.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            // 'multiple' => true, // Multiple mode with 'asDropDownList'.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
