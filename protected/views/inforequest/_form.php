<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'inforequest-form',
    'enableAjaxValidation' => false,
    'enableClientValidation' => true,
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

    <?php echo $this->renderPartial('_form/sender', array('model' => $model, 'form' => $form)); ?>

    <?php $this->widget('ext.widgets.RelationAjaxSelect2Row.RelationAjaxSelect2Row', array(
        'model' => $model,
        'attribute' => 'receiverGovorganization',
        'relationAttributeText' => 'name',
        'form' => $form,
        'url' => $this->createUrl('select/govorganizationSelectSearch'),
    )); ?>

    <?php echo $form->radioButtonListInlineRow($model, 'finished_status', $model->FinishedStatus->list); ?>

    <?php echo $form->datepickerRow($model, 'receive_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
