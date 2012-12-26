<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'partnership-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $this->renderPartial('_partMain',array('form'=>$form, 'model'=>$model)); ?>

    <h2>Проверка Партнерства</h2>

    <?php echo $this->renderPartial('_partVerification',array('form'=>$form, 'model'=>$model)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>
<?php $this->endWidget(); ?>
