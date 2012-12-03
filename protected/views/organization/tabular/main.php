<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->select2Row($model, 'type', array(
    'data' => CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),
    // 'multiple' => true,
    'prompt' => '', // Blank for all drop.
    'options' => array(
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>

<?php echo $form->select2Row($model, 'action_area', array(
    'data' => Lookup::items('OrganizationActionArea'),
    // 'multiple' => true,
    'prompt' => '', // Blank for all drop.
    'options' => array(
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>

<?php echo $form->select2Row($model, 'directions', array(
    'data' => CHtml::listData(Direction::model()->findAll(), 'id', 'name'),
    'multiple' => true,
    'prompt' => '', // Blank for all drop.
    'options' => array(
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
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
        'width' => '300px',
    ),
)); ?>
