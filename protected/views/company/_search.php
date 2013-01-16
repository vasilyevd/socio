<?php
Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/dynamicListviewUpdate.js'
);
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type' => 'horizontal',
    'htmlOptions' => array('class' => 'company-filter'),
)); ?>

    Проходящие:
    <?php echo $this->renderPartial('//announcement/_calendar', array('model' => $model, 'attribute' => 'compareDate', 'listview' => 'company-listview', 'filter' => 'company-filter')); ?>

    <?php echo $form->radioButtonListInlineRow($model, 'compareDateType',
        array(
            '' => 'Все',
            Company::COMPARE_DATE_TYPE_BEFORE => 'До',
            Company::COMPARE_DATE_TYPE_AFTER => 'После',
        ),
        array(
            'onchange' => 'dynamicListviewUpdate("company-listview", "company-filter")',
        )
    ); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('CompanyType'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("company-listview", "company-filter"); }',
        ),
    )); ?>

<?php $this->endWidget(); ?>
