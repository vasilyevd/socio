<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions'=>array('class'=>'well'),
    'type'=>'horizontal',
)); ?>
    <?php echo CHtml::link('Обычный поиск','#',array('class'=>'search-button')); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'action_area', array(
        'data' => Lookup::items('OrganizationActionArea'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->select2Row($model, 'foundation_year', array(
        'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Поиск',
        )); ?>
    </div>
<?php $this->endWidget(); ?>
