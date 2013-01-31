<?php
Yii::app()->clientScript->registerScript('organizationAutoComplete', "
(function () {
    var previous;

    $('#" . CHtml::activeId($model, 'link') . "').focus(function () {
        previous = this.value;
    }).change(function() {
        if (previous != this.value) {
            $('#" . CHtml::activeId($model, 'linkOrganization') . "').val('');
            $('.cooperation-form-toggle').show();
        }
    });
})();
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'support-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->radioButtonListRow($model, 'source', Lookup::items('SupportSource')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('SupportType'),
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

    <?php echo $form->labelEx($model, 'link'); ?>
    <?php $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'link',
        'source' => $this->createUrl('organization/organizationAutoComplete'),
        'options' => array(
            'delay' => 300,
            'minLength' => 2,
            'showAnim' => 'fold',
            'select' => "js:function(event, ui) {
                $('#" . CHtml::activeId($model, 'linkOrganization') . "').val(ui.item.id);
                $('.cooperation-form-toggle').hide();
            }",
        ),
        'htmlOptions' => array(
            'class' => 'span5',
        ),
    )); ?>
    <?php $model->linkOrganization = is_object($model->linkOrganization) ? $model->linkOrganization->id : $model->linkOrganization; ?>
    <?php echo $form->hiddenField($model, 'linkOrganization'); ?>
    <?php echo $form->error($model, 'link'); ?>

    <div class="cooperation-form-toggle"<?php echo !empty($model->linkOrganization) ? ' style="display:none"' : ''; ?>>
        <?php echo $form->fileFieldRow($model,'logo'); ?>
    </div>

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
