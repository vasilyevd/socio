<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Партнерство' => array('index', 'org' => $this->menu_org->id),
    $model->link=>array('view','id'=>$model->id),
    'Изменить',
);
?>

<h1>Изменить Партнерство</h1>

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'partnership-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>
    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $this->renderPartial('_partMain',array('form'=>$form, 'model'=>$model)); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>
<?php $this->endWidget(); ?>
