<?php
$this->breadcrumbs=array(
    'Организации'=>array('index'),
    'Создать',
);

// $this->menu=array(
//     array('label'=>'List Organization','url'=>array('index')),
//     array('label'=>'Manage Organization','url'=>array('admin')),
// );

$this->layout='//layouts/column1';
?>

<h1>Создать Организацию</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'organization-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->dropDownListRow($model,'type',CHtml::listData(Orgtype::model()->findAll(), 'id', 'name'),array('prompt'=>'')); ?>

    <?php echo $form->dropDownListRow($model,'action_area',Lookup::items('OrganizationActionArea'),array('prompt'=>'')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Добавить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
