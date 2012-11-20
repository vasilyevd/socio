<?php
$this->menu_org = $model;

$this->breadcrumbs=array(
    // 'Организации'=>array('index'),
    // CHtml::encode($model->name)=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Организацию</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'organization-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php $this->widget('bootstrap.widgets.TbTabs', array(
        'type'=>'tabs', // 'tabs' or 'pills'
        // 'placement'=>'below', // 'above', 'right', 'below' or 'left'
        'tabs'=>array(
            array('label'=>'Основные', 'content'=>$this->renderPartial('tabular/main',array('form'=>$form,'model'=>$model),true), 'active'=>true),
            array('label'=>'География', 'content'=>$this->renderPartial('tabular/geo',array('form'=>$form,'model'=>$model),true)),
            array('label'=>'Подробности', 'content'=>$this->renderPartial('tabular/details',array('form'=>$form,'model'=>$model),true)),
            array('label'=>'Интеграция', 'content'=>$this->renderPartial('tabular/integration',array('form'=>$form,'model'=>$model),true)),
        ),
    )); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
