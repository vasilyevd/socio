<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/dynamicListviewUpdate.js'
);
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'massmedia-filter'),
)); ?>

    <?php echo $form->select2Row($model, 'tags', array(
        'data' => CHtml::listData(Mmtag::getTagsForOrganization($this->escalation['organization']->id), 'id', 'name'),
        'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("massmedia-listview", "massmedia-filter"); }',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'category', array(
        'data' => Lookup::items('MassmediaCategory'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("massmedia-listview", "massmedia-filter"); }',
        ),
    )); ?>

    <?php echo $form->radioButtonListRow($model, 'direction', array('' => 'Все', false => 'СМИ о нас', true => 'Мы в СМИ'), array(
        'onchange' => 'dynamicListviewUpdate("massmedia-listview", "massmedia-filter")',
    )); ?>

<?php $this->endWidget(); ?>
