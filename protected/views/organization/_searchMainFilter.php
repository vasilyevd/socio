<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'organization-filter'),
)); ?>
    <?php echo $form->textField($model, 'name', array(
        'class' => 'span8',
        'maxlength' => 128,
        'onkeyup' => 'dynamicOrganizationFilter()',
    )); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Поиск',
        'icon' => 'search',
        'htmlOptions' => array('onclick' => 'dynamicOrganizationFilter()'),
    )); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:dynamicOrganizationFilter',
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
        'events' => array(
            'change' => 'js:dynamicOrganizationFilter',
        ),
    )); ?>
<?php $this->endWidget(); ?>
