<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>

    <?php echo $form->textFieldRow($model,'id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'organization_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'author_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'category',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'type_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'type_other',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'create_time',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'start_time',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'end_time',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_other',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'address_description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php echo $form->textFieldRow($model,'status',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'invite_closed',array('class'=>'span5')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type'=>'primary',
            'label'=>'Search',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
