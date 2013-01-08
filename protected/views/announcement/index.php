<?php
$this->breadcrumbs=array(
    'Лента',
);

Yii::app()->clientScript->registerScript('search', "
// Dynamic listview update.
var ajaxUpdateTimeout;
function dynamicAnnouncementFilter() {
    clearTimeout(ajaxUpdateTimeout);
    ajaxUpdateTimeout = setTimeout(
        function() {
            $.fn.yiiListView.update(
                // This is the id of the CListView.
                'announcement-listview',
                { data: $('.announcement-calendar-widget').serialize() }
            )
        },
        // This is the delay.
        500
    );
    return false;
};
", CClientScript::POS_END);
?>

<?php echo CHtml::link('За всё время', '#', array(
    'class' => 'announcement-calendar-link',
    'onclick' => '$(".announcement-calendar-widget").datepicker("show"); return false;',
)); ?>
<?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'model' => $model,
    'attribute' => 'publication_time',
    'language' => 'ru',
    // jQuery plugin options.
    'options' => array(
        'dateFormat' => 'yy-mm-dd',
        'onSelect' => 'js:function(date) {
            $(".announcement-calendar-link").text(date);
            dynamicAnnouncementFilter();
        },',
    ),
    'htmlOptions' => array(
        'class' => 'announcement-calendar-widget',
        'style' => 'display:none',
    ),
)); ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'announcement-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'title',
        'publication_time',
        'category',
    ),
)); ?>
