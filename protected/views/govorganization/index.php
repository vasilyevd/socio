<?php echo CHtml::link('Добавить Организацию', array('create'), array('class' => 'btn')); ?>

<h1>Государственные Организации</h1>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider'=>$dataProvider,
    'itemView'=>'_view',
)); ?>
