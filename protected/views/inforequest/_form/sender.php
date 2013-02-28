<?php
Yii::app()->clientScript->registerScript('inforequestSenderTypeChange', "
function inforequestSenderTypeChange(value) {
    switch (value) {
        case '" . $model->SenderType->find('USER') . "':
            $('#inforequest-sender_type-toggle').show();
            $('#inforequest-sender_type-toggle2').hide();
            $('#inforequest-sender_type-toggle3').hide();
            break;
        case '" . $model->SenderType->find('ORGANIZATION') . "':
            $('#inforequest-sender_type-toggle').hide();
            $('#inforequest-sender_type-toggle2').show();
            $('#inforequest-sender_type-toggle3').hide();
            break;
        case '" . $model->SenderType->find('BIZORGANIZATION') . "':
            $('#inforequest-sender_type-toggle').hide();
            $('#inforequest-sender_type-toggle2').hide();
            $('#inforequest-sender_type-toggle3').show();
            break;
    }
}
", CClientScript::POS_END);
?>

<div class="well">
    <?php echo $form->radioButtonListRow(
        $model,
        'sender_type',
        $model->SenderType->list,
        array('onchange' => 'inforequestSenderTypeChange(this.value)')
    ); ?>

    <div id="inforequest-sender_type-toggle"<?php echo $model->sender_type == $model->SenderType->find('USER') ? '' : ' style="display:none"'; ?>>
        <?php echo $form->textFieldRow($model, 'sender_text', array('class' => 'span5', 'maxlength' => 128)); ?>

        <?php echo $form->checkBoxRow($model, 'isSenderUserSelf'); ?>
    </div>

    <div id="inforequest-sender_type-toggle2"<?php echo $model->sender_type == $model->SenderType->find('ORGANIZATION') ? '' : ' style="display:none"'; ?>>
        <?php $this->widget('ext.widgets.RelationAjaxSelect2Row.RelationAjaxSelect2Row', array(
            'model' => $model,
            'attribute' => 'senderOrganization',
            'relationAttributeText' => 'name',
            'form' => $form,
            'url' => $this->createUrl('select/organizationSelectSearch'),
        )); ?>
    </div>

    <div id="inforequest-sender_type-toggle3"<?php echo $model->sender_type == $model->SenderType->find('BIZORGANIZATION') ? '' : ' style="display:none"'; ?>>
        <?php $this->widget('ext.widgets.RelationAjaxSelect2Row.RelationAjaxSelect2Row', array(
            'model' => $model,
            'attribute' => 'senderBizorganization',
            'relationAttributeText' => 'name',
            'form' => $form,
            'url' => $this->createUrl('select/govorganizationSelectSearch'),
        )); ?>
    </div>
</div>
