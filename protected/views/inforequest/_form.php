<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'inforequest-form',
    'enableAjaxValidation' => true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model, 'name', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textAreaRow($model, 'description', array('rows' => 6, 'cols' => 50, 'class' => 'span8')); ?>

    <?php echo $form->textFieldRow($model, 'type', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'create_time', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'send_date', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'receive_date', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'finished_status', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'user_id', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'sender', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textFieldRow($model, 'sender_id', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'sender_type', array('class' => 'span5')); ?>

    <?php echo $form->textFieldRow($model, 'receiver', array('class' => 'span5', 'maxlength' => 128)); ?>

    <?php echo $form->textFieldRow($model, 'receiver_id', array('class' => 'span5')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
