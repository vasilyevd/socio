<?php echo CHtml::link('Create', array('create'), array('class' => 'btn')); ?>

<h1>Inforequests</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
    'dataProvider' => $dataProvider,
    'itemView' => '_view',
)); ?>
