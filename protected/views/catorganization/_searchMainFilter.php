<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'type'=>'horizontal',
    'htmlOptions'=>array('class'=>'organization-filter'),
)); ?>

    <?php echo $form->textField($model, 'name', array(
        'class' => 'span8',
        'maxlength' => 128,
        'onkeyup' => 'dynamicListviewUpdate("organization-listview", "organization-filter")',
    )); ?>

    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type' => 'primary',
        'label' => 'Поиск',
        'icon' => 'search',
        'htmlOptions' => array('onclick' => 'dynamicListviewUpdate("organization-listview", "organization-filter")'),
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
            'change' => 'js:function() { dynamicListviewUpdate("organization-listview", "organization-filter"); }',
        ),
    )); ?>

<?php $this->endWidget(); ?>
