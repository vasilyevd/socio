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
                $(".announcement-calendar-link").text($.datepicker.formatDate("За d MM, yy", new Date(date), { monthNames: month }));
                $(".announcement-calendar-toggle").show();
            } else {
                $(".announcement-calendar-link").text("За всё время");
                $(".announcement-calendar-toggle").hide();
            }
            dynamicListviewUpdate("announcement-listview", "announcement-filter");
        },',
    ),
    'htmlOptions' => array(
        'class' => 'announcement-calendar-widget',
        'style' => 'visibility:hidden; width:0; height:0; padding:0; margin:0; border:0;',
    ),
)); ?>

<?php echo CHtml::link('За всё время', '#', array(
    'class' => 'announcement-calendar-link',
    'onclick' => '$(".announcement-calendar-widget").datepicker("show"); return false;',
)); ?>

<?php echo CHtml::link('<i class="icon-remove"></i>', '#', array(
    'class' => 'announcement-calendar-toggle',
    'style' => 'display:none',
    'onclick' => '$.datepicker._clearDate($(".announcement-calendar-widget")); return false;',
)); ?>
