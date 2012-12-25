<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'company-form',
    'enableAjaxValidation'=>false,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->radioButtonListRow($model, 'type', Lookup::items('CompanyType')); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <?php $massmedias = $model->getHomelessMassmedia(); ?>
    <?php if (empty($massmedias)): ?>
        <div class="alert">
            <strong>Внимание!</strong> У вас нет свободных Элементов СМИ.
        </div>
    <?php else: ?>
        <?php echo $form->select2Row($model, 'massmedias', array(
            'data' => CHtml::listData(
                Lookup::itemsListReplace(
                    'MassmediaCategory',
                    $massmedias,
                    'category'
                ),
                'id',
                'title',
                'category'
            ),
            'multiple' => true,
            'prompt' => '', // Blank for all drop.
            'options' => array(
                'placeholder' => 'Выбрать...', // Blank for all drop.
                'allowClear' => true, // Clear for normal drop.
                'width' => '300px',
            ),
        )); ?>
    <?php endif; ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
