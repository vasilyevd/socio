<?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->select2Row($model, 'type', array(
    'data' => CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),
    // 'asDropDownList' => false, // Tag mode.
    // 'multiple' => true, // Multiple mode without 'asDropDownList',
    'prompt' => '', // Blank for all drop.
    'options' => array(
        // 'multiple' => true, // Multiple mode with 'asDropDownList'.
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>

<?php echo $form->select2Row($model, 'action_area', array(
    'data' => Lookup::items('OrganizationActionArea'),
    // 'asDropDownList' => false, // Tag mode.
    // 'multiple' => true, // Multiple mode without 'asDropDownList',
    'prompt' => '', // Blank for all drop.
    'options' => array(
        // 'multiple' => true, // Multiple mode with 'asDropDownList'.
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>

<?php echo $form->select2Row($model, 'directions', array(
    'data' => CHtml::listData(Direction::model()->findAll(), 'id', 'name'),
    // 'asDropDownList' => false, // Tag mode.
    'multiple' => true, // Multiple mode without 'asDropDownList',
    'prompt' => '', // Blank for all drop.
    'options' => array(
        // 'multiple' => true, // Multiple mode with 'asDropDownList'.
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
    // 'asDropDownList' => false, // Tag mode.
    'multiple' => true, // Multiple mode without 'asDropDownList',
    'prompt' => '', // Blank for all drop.
    'options' => array(
        // 'multiple' => true, // Multiple mode with 'asDropDownList'.
        'placeholder' => 'Выбрать...', // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '300px',
    ),
)); ?>
