<?php
Yii::app()->clientScript->registerScript('cooperationLinkAutocomplete', "
$('#" . CHtml::activeId($model, 'link') . "').change(function() {
    var idField = $('#" . CHtml::activeId($model, 'linkOrganization') . "');
    if (idField.data('text') != this.value) {
        idField.val('');
        $('.cooperation-form-toggle').show();
    }
});
");
?>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'cooperation-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->radioButtonListRow($model, 'source', Lookup::items('CooperationSource')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('CooperationType'),
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
    <?php  $this->widget('zii.widgets.jui.CJuiAutoComplete', array(
        'model' => $model,
        'attribute' => 'link',
        'source' => $this->createUrl('select/organizationAutoComplete'),
        'options' => array(
            'delay' => 300,
            'minLength' => 2,
            'showAnim' => 'fold',
            'select' => "js:function(event, ui) {
                var idField = $('#" . CHtml::activeId($model, 'linkOrganization') . "');
                idField.data('text', ui.item.value);
                idField.val(ui.item.id);
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



    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'contact_name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>


<?php $this->endWidget(); ?>
