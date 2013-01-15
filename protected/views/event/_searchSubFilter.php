<?php
Yii::app()->clientScript->registerScript('dynamicType', "
var typeOptgroups;
function dynamicType() {
    var select = '#Event_type_id';

    // Get select optgroups once.
    if (!typeOptgroups) {
        typeOptgroups = {};
        $(select).find('optgroup').each(function() {
            typeOptgroups[$(this).attr('label')] = $(this);
        });
    }

    // Get all selected checkboxes from list.
    var selectedCheckboxes = new Array();
    $('#event-checkboxlist input:checked').each(function() {
        // Get label text of current checkbox.
        var label = $('label[for=\"' + $(this).attr('id') + '\"]');
        selectedCheckboxes.push(label.text());
    });

    // Blank select.
    $(select).empty();
    // Add empty option for select.
    $(select).append('<option value=\"\"></option>');

    if (selectedCheckboxes.length == 0) {
        // Add all options.
        jQuery.each(typeOptgroups, function() {
            $(select).append(this);
        });
    } else {
        // Add all checked options.
        jQuery.each(selectedCheckboxes, function() {
            $(select).append(typeOptgroups[this]);
        });
    }

    // Select empty value before submit.
    $(select).select2('val', '');
};
", CClientScript::POS_END);
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'announcement-filter'),
)); ?>

    <?php echo $form->textFieldRow($model, 'city_id', array(
        'class' => 'span2',
        'onkeyup' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")',
    )); ?>

    <div id="event-checkboxlist">
        <?php echo $form->checkBoxListRow($model, 'category', Lookup::items('EvtypeCategory'), array(
            'onchange' => 'dynamicType(); dynamicListviewUpdate("announcement-listview", "announcement-filter");',
        )); ?>
    </div>

    <?php echo $form->select2Row($model, 'type_id', array(
        'data' => CHtml::listData(
            Lookup::itemsListReplace(
                'EvtypeCategory',
                Evtype::model()->findAll(array('order' => 'position')),
                'category'
            ),
            'id',
            'name',
            'category'
        ),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '250px',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("announcement-listview", "announcement-filter"); }',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'status', array(
        'data' => Lookup::items('EventStatus'),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '250px',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("announcement-listview", "announcement-filter"); }',
        ),
    )); ?>

    <?php echo $form->radioButtonListRow($model, 'end_time', array('' => 'Все') + Lookup::items('EventEndTime'), array(
        'onchange' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")',
    )); ?>

<?php $this->endWidget(); ?>
