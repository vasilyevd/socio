<?php
$this->breadcrumbs=array(
    'Лента',
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/dynamicListviewUpdate.js'
);
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type'=>'horizontal',
    'htmlOptions' => array('class' => 'announcement-filter'),
)); ?>

    <?php echo $form->textField($model, 'title', array(
        'class' => 'span5',
        'maxlength' => 128,
        'onkeyup' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")',
    )); ?>

    <?php echo $this->renderPartial('_calendar', array('model' => $model, 'attribute' => 'publication_time', 'listview' => 'announcement-listview', 'filter' => 'announcement-filter')); ?>

    <?php $this->beginWidget('zii.widgets.jui.CJuiButton', array(
        'name' => CHtml::activeId($model, 'category') . '-buttonset',
        'buttonType' => 'buttonset'
    )); ?>
        <?php echo CHtml::activeCheckBoxList($model, 'category', Lookup::items('AnnouncementCategory'), array('separator' => '', 'onchange' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")')); ?>
    <?php $this->endWidget(); ?>

<?php $this->endWidget(); ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'announcement-listview',
    'dataProvider' => empty($dataProvider) ? $model->search() : $dataProvider,
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
