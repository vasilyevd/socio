<?php echo CHtml::link('Список Организаций', array('index'), array('class' => 'btn')); ?>

<h1>Создать Государственную Организацию</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
