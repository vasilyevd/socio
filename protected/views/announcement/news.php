<?php
$this->breadcrumbs=array(
    'Новости',
);

Yii::app()->clientScript->registerScript('search', "
// On select widget listview update.
var ajaxUpdateTimeout;
var ajaxRequest;
// This is the id of the source.
$('input.calendar-search').change(function(){
    ajaxRequest = $(this).serialize();
    clearTimeout(ajaxUpdateTimeout);
    ajaxUpdateTimeout = setTimeout(function () {
        $.fn.yiiListView.update(
            // This is the id of the CListView.
            'events-listview',
            {data: ajaxRequest}
        )
    },
    // This is the delay.
    300);
});
");
?>

<div class="input-append">
    <?php $this->widget('zii.widgets.jui.CJuiDatePicker', array(
        'model' => $model,
        'attribute' => 'publication_time',
        'language' => 'ru',
        'options' => array(
            'dateFormat' => 'yy-mm-dd',
        ), // jquery plugin options
        'htmlOptions' => array(
            'class' => 'calendar-search',
        ),
    )); ?>
    <span class="add-on"><i class="icon-calendar"></i></span>
</div>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'events-listview',
    'dataProvider' => $model->searchNews(),
    'itemView' => '_news',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'title',
        'publication_time',
        'category',
    ),
)); ?>
