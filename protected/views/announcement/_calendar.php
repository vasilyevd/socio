<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => $attribute,
    'language' => 'ru',
    // jQuery plugin options.
    'options' => array(
        'dateFormat' => 'yy-mm-dd',
        'onSelect' => 'js:function(date) {
            // Format date for link.
            if (date) {
                var month = ["января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря"];
                $(".r-calendar-link").text($.datepicker.formatDate("За d MM, yy", new Date(date), { monthNames: month }));
                $(".r-calendar-toggle").show();
            } else {
                $(".r-calendar-link").text("За всё время");
                $(".r-calendar-toggle").hide();
            }
            dynamicListviewUpdate("' . $listview . '", "' . $filter . '");
        },',
    ),
    'htmlOptions' => array(
        'class' => 'r-calendar-widget',
        'style' => 'visibility:hidden; width:0; height:0; padding:0; margin:0; border:0;',
    ),
)); ?>

<?php echo CHtml::link('За всё время', '#', array(
    'class' => 'r-calendar-link',
    'onclick' => '$(".r-calendar-widget").datepicker("show"); return false;',
)); ?>

<?php echo CHtml::link('<i class="icon-remove"></i>', '#', array(
    'class' => 'r-calendar-toggle',
    'style' => 'display:none',
    'onclick' => '$.datepicker._clearDate($(".r-calendar-widget")); return false;',
)); ?>
