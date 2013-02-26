<?php
Yii::app()->clientScript->registerScript('sender_typeChange', "
function sender_typeChange(value) {
    switch (value) {
        case '" . $model->SenderType->find('USER') . "':
            $('.sender_type-toggle').show();
            $('.sender_type-toggle2').hide();
            $('.sender_type-toggle3').hide();
            break;
        case '" . $model->SenderType->find('ORGANIZATION') . "':
            $('.sender_type-toggle').hide();
            $('.sender_type-toggle2').show();
            $('.sender_type-toggle3').hide();
            break;
        case '" . $model->SenderType->find('BIZORGANIZATION') . "':
            $('.sender_type-toggle').hide();
            $('.sender_type-toggle2').hide();
            $('.sender_type-toggle3').show();
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
        array('onchange' => 'sender_typeChange(this.value);')
    ); ?>

    <div class="sender_type-toggle"<?php echo $model->sender_type == $model->SenderType->find('USER') ? '' : ' style="display:none"'; ?>>
        <?php echo $form->textFieldRow($model, 'sender_text', array('class' => 'span5', 'maxlength' => 128)); ?>

        <?php echo $form->checkBoxRow($model, 'isSenderUserSelf'); ?>
    </div>

    <div class="sender_type-toggle2"<?php echo $model->sender_type == $model->SenderType->find('ORGANIZATION') ? '' : ' style="display:none"'; ?>>
        <?php
            if (is_object($model->senderOrganization)) {
                $selectText = $model->senderOrganization->name;
                $model->senderOrganization = $model->senderOrganization->id;
            } else {
                $selectText = '';
            }
        ?>
        <?php echo $form->select2Row($model, 'senderOrganization', array(
            'asDropDownList' => false,
            'prompt' => '',
            'options' => array(
                'placeholder' => 'Выбрать...',
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => 1,
                'ajax' => array(
                    'url' => $this->createUrl('select/organizationSelectSearch'),
                    'quietMillis' => 500,
                    'dataType' => 'json',
                    'data' => 'js:function(term, page) {
                        return {query : term};
                    }',
                    'results' => 'js:function(data, page) {
                        return {results : data};
                    }',
                ),
                'formatResult' => 'js:function(model) {
                    markup = "<table><tr>";
                    markup += "<td><img style=\"height: 50px;\" src=\"" + model.logo + "\"/></td>";
                    markup += "<td><strong>" + model.name + "</strong><br />" + model.description + "</td>";
                    markup += "</tr></table>";
                    return markup;
                }',
                'formatSelection' => 'js:function(model) {
                    return model.name;
                }',
                'initSelection' => 'js:function(element, callback) {
                    callback({id : element.val(), name : "' . $selectText . '"});
                }',
            ),
        )); ?>
    </div>

    <div class="sender_type-toggle3"<?php echo $model->sender_type == $model->SenderType->find('BIZORGANIZATION') ? '' : ' style="display:none"'; ?>>
        <?php
            if (is_object($model->senderBizorganization)) {
                $selectText = $model->senderBizorganization->name;
                $model->senderBizorganization = $model->senderBizorganization->id;
            } else {
                $selectText = '';
            }
        ?>
        <?php echo $form->select2Row($model, 'senderBizorganization', array(
            'asDropDownList' => false,
            'prompt' => '',
            'options' => array(
                'placeholder' => 'Выбрать...',
                'allowClear' => true,
                'width' => '400px',
                'minimumInputLength' => 1,
                'ajax' => array(
                    'url' => $this->createUrl('select/govorganizationSelectSearch'),
                    'quietMillis' => 500,
                    'dataType' => 'json',
                    'data' => 'js:function(term, page) {
                        return {query : term};
                    }',
                    'results' => 'js:function(data, page) {
                        return {results : data};
                    }',
                ),
                'formatResult' => 'js:function(model) {
                    markup = "<table><tr>";
                    markup += "<td><img style=\"height: 50px;\" src=\"" + model.logo + "\"/></td>";
                    markup += "<td><strong>" + model.name + "</strong><br />" + model.description + "</td>";
                    markup += "</tr></table>";
                    return markup;
                }',
                'formatSelection' => 'js:function(model) {
                    return model.name;
                }',
                'initSelection' => 'js:function(element, callback) {
                    callback({id : element.val(), name : "' . $selectText . '"});
                }',
            ),
        )); ?>
    </div>
</div>
