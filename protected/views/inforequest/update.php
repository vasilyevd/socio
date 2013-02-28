<?php echo CHtml::link('Index', array('index'), array('class' => 'btn')); ?>

<?php echo CHtml::link('View', array('view', 'id' => $model->id), array('class' => 'btn')); ?>

<h1>Изменить Inforequest</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
