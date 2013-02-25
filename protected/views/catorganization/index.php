<?php echo CHtml::link('Добавить Организацию', array('create'), array('class' => 'btn')); ?>

<h1>Общественные Организации</h1>

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'catorganization-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'name',
        array(
            'name' => 'registration_date',
            'class' => 'bootstrap.widgets.TbEditableColumn',
	          'value'=> '$data->registration_date=="0000-00-00"?"нет":$data->registration_date',
            'editable' => array(
                'type' => 'date',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'format' => 'yyyy-mm-dd',
                'viewformat'  => 'yyyy-mm-dd',
                'placement' => 'top',
                'enabled' => true,
            ),
        ),
        array(
            'name' => 'is_legal',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'source' => array(false => 'Нет', true => 'Да'),
                'placement' => 'top',
                'enabled' => true,
            ),
            'filter' => array(false => 'Нет', true => 'Да'),
        ),
        array(
            'name' => 'is_branch',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'source' => array(false => 'Нет', true => 'Да'),
                'placement' => 'top',
                'enabled' => true,
            ),
            'filter' => array(false => 'Нет', true => 'Да'),
        ),
        array(
            'name' => 'is_verified',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'source' => array(false => 'Нет', true => 'Да'),
                'placement' => 'left',
                'enabled' => true,
                'onRender' => 'js: function(e, edt) {
                    var colors = {0: "red", 1: "green"};
                    $(this).css("color", colors[edt.value]);
                }'
            ),
            'filter' => array(false => 'Нет', true => 'Да'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
