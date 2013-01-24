<?php
Yii::app()->clientScript->registerScript('branch-toggle', "
$('.branch-trigger').change(function(){
    $('.branch-toggle').toggle();
    return false;
});
");
?>

<?php $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
    'id' => 'catorganization-form',
    'enableAjaxValidation' => false,
    'type' => 'horizontal',

    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->textFieldRow($model,'name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->datepickerRow($model, 'registration_date', array(
        'options' => array('format' => 'yyyy-mm-dd', 'weekStart' => 1),
        'append' => '<i class="icon-calendar"></i>',
    )); ?>

    <?php echo $form->textFieldRow($model,'address',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'address_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'city_id',array('class'=>'span5')); ?>

    <?php echo $form->textFieldRow($model,'region_id',array('class'=>'span5')); ?>

    <?php echo $form->select2Row($model, 'action_area', array(
        'data' => Lookup::items('OrganizationActionArea'),
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'directions', array(
        'data' => CHtml::listData(Direction::model()->findAll(), 'id', 'name'),
        'multiple' => true,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->textFieldRow($model,'directions_more',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'chief_fio',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'registration_num',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'phone',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-globe"></i>')); ?>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128,'append'=>'<i class="icon-envelope"></i>')); ?>

    <?php echo $form->select2Row($model, 'organization', array(
        'asDropDownList' => false,
        'prompt' => '',
        'options' => array(
            'placeholder' => 'Выбрать...',
            'allowClear' => true,
            'width' => '400px',
            'minimumInputLength' => 1,
            'ajax' => array(
                'url' => $this->createUrl('cooperation/dynamicSearchOrganizations'),
                'quietMillis'=>500,
                'dataType' => 'json',
                'data' => 'js:function(term, page) {
                    return { query: term };
                }',
                'results' => 'js:function(data, page) {
                    return { results: data.organizations };
                }',
            ),
            'formatResult' => 'js:function(model) {
                markup = "<table><tr>";
                markup += "<td><img style=\"height: 50px;\" src=\"" + model.logo + "\"/></td>";
                markup += "<td><strong>" + model.name + "</strong><br />" + model.description + "</td>";
                markup += "</tr></table>";
                return markup;
            }',
            'formatSelection' => 'js:function(model) {
                return model.name;
            }',
        ),
    )); ?>

    <?php echo $form->radioButtonListInlineRow($model, 'is_legal', array('' => 'Не известно', true => 'Да', false => 'Нет')); ?>

    <?php echo $form->fileFieldRow($model,'logo'); ?>

    <?php echo $form->checkBoxRow($model, 'is_branch', array('class' => 'branch-trigger')); ?>

    <div class="branch-toggle"<?php echo empty($model->is_branch) ? ' style="display:none"' : ''; ?>>
        <?php echo $form->textFieldRow($model,'branch_master',array('class'=>'span5','maxlength'=>128)); ?>
    </div>

    <?php echo $form->checkBoxRow($model, 'is_verified'); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType' => 'submit',
            'type' => 'primary',
            'label' => $model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>