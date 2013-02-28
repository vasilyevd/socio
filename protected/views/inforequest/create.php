<?php echo CHtml::link('Index', array('index'), array('class' => 'btn')); ?>

<h1>Создать Inforequest</h1>

<?php echo $this->renderPartial('_form', array('model' => $model)); ?>
