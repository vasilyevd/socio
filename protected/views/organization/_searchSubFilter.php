<div class="filter-side">
<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
    'htmlOptions'=>array('class'=>'organization-filter'),
)); ?>

	<div class="input-block">
    <?php echo $form->textFieldRow($model, 'city_id', array(
        'onkeyup' => 'dynamicListviewUpdate("organization-listview", "organization-filter")',
    )); ?>
	</div>
    <?php echo $form->select2Row($model, 'directions', array(
        'data' => CHtml::listData(Direction::model()->findAll(), 'id', 'name'),
        'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            //'width' => '100%',
	        'containerCssClass'=>'input-block',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("organization-listview", "organization-filter"); }',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'problems', array(
        'data' => CHtml::listData(
            Lookup::itemsListReplace(
                'ProblemGroup',
                Problem::model()->findAll(),
                'group'
            ),
            'id',
            'name',
            'group'
        ),
        'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            //'width' => '250px',
	        'containerCssClass'=>'input-block',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("organization-listview", "organization-filter"); }',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'foundation_year', array(
        'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
        // 'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            //'width' => '250px',
	        'containerCssClass'=>'input-block',
        ),
        'events' => array(
            'change' => 'js:function() { dynamicListviewUpdate("organization-listview", "organization-filter"); }',
        ),
    )); ?>
<?php $this->endWidget(); ?>
</div>
