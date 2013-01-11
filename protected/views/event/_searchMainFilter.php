<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'type'=>'horizontal',
    'htmlOptions' => array('class' => 'announcement-filter'),
)); ?>

    <?php echo $form->textField($model, 'name', array(
        'class' => 'span4',
        'maxlength' => 128,
        'onkeyup' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")',
    )); ?>

    <?php echo $this->renderPartial('//announcement/_calendar', array('model' => $model, 'attribute' => 'start_time')); ?>

<?php $this->endWidget(); ?>
