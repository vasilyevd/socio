<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions'=>array('class'=>'well'),
    'type'=>'horizontal',
)); ?>
    <?php echo CHtml::link('Обычный поиск','#',array('class'=>'search-button')); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->dropDownListRow($model,'type',CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),array('prompt'=>'')); ?>

    <?php echo $form->dropDownListRow($model,'action_area',Lookup::items('OrganizationActionArea'),array('prompt'=>'')); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->dropDownListRow($model,'foundation_year',range(date('Y'), 1900),array('class' => 'span1', 'prompt'=>'')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Поиск',
        )); ?>
    </div>
<?php $this->endWidget(); ?>
