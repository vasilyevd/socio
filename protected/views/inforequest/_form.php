<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'inforequest-form',
    'enableAjaxValidation' => true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => $model->Type->list,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->datepickerRow($model, 'send_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <?php echo $form->radioButtonListRow($model, 'sender_type', $model->SenderType->list); ?>

    <?php
        if (is_numeric($model->senderUser)) {
            $model->senderUser = PersonUser::model()->findByPk($model->senderUser);
        }
        if (is_object($model->senderUser)) {
            $selectText = $model->senderUser->fio;
            $model->senderUser = $model->senderUser->id;
        } else {
            $selectText = '';
        }
    ?>
    <?php echo $form->select2Row($model, 'senderUser', array(
        'asDropDownList' => false,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '400px',
            'minimumInputLength' => 1,
            'ajax' => array(
                'url' => $this->createUrl('select/userSelectSearch'),
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
                markup += "<td><strong>" + model.fio + "</strong><br />" + model.description + "</td>";
                markup += "</tr></table>";
                return markup;
            }',
            'formatSelection' => 'js:function(model) {
                return model.fio;
            }',
            'initSelection' => 'js:function(element, callback) {
                callback({id : element.val(), fio : "' . $selectText . '"});
            }',
        ),
    )); ?>

    <?php
        if (is_numeric($model->senderOrganization)) {
            $model->senderOrganization = Organization::model()->findByPk($model->senderOrganization);
        }
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

    <?php
        if (is_numeric($model->senderBizorganization)) {
            $model->senderBizorganization = Govorganization::model()->findByPk($model->senderBizorganization);
        }
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

    <?php echo $form->radioButtonListInlineRow($model, 'is_finished', array('' => 'Неизвестно', true => 'Пришел', false => 'Не пришел')); ?>

    <?php echo $form->datepickerRow($model, 'receive_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <?php
        if (is_numeric($model->receiver)) {
            $model->receiver= Govorganization::model()->findByPk($model->receiver);
        }
        if (is_object($model->receiver)) {
            $selectText = $model->receiver->name;
            $model->receiver= $model->receiver->id;
        } else {
            $selectText = '';
        }
    ?>
    <?php echo $form->select2Row($model, 'receiver', array(
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

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
