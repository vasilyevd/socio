<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'organization-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'type',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'action_area',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'foundation_year',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'staff_size',array('class'=>'span5')); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textAreaRow($model,'goal',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'phone_num',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'logo',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'author_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'verified',array('class'=>'span5')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
