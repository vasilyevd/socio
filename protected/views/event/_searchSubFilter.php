<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action' => Yii::app()->createUrl($this->route),
    'method' => 'get',
    'htmlOptions' => array('class' => 'announcement-filter'),
)); ?>

    <?php echo $form->textFieldRow($model, 'city_id', array(
        'class' => 'span2',
        'onkeyup' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")',
    )); ?>

    <?php echo $form->checkBoxListRow($model, 'category', Lookup::items('EvtypeCategory'), array('onchange' => 'dynamicListviewUpdate("announcement-listview", "announcement-filter")')); ?>

    <p>---------Зависимый ajax select</p>

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

    <p>---------Чекбоксы</p>
    <p>---------[ ] Прошедшие</p>
    <p>---------[ ] Не прошедшие</p>

<?php $this->endWidget(); ?>
