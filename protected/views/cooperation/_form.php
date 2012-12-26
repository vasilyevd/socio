<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'cooperation-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->select2Row($model, 'linkOrganization', array(
        // 'data' => CHtml::listData(Organization::model()->findAll(), 'id', 'name'),
        'asDropDownList' => false, // Tag mode.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => empty($model->link) ? 'Введите название...' : CHtml::encode($model->link), // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
	          'likeinput'=>true,
	          'likeinputAtribute'=>'link',
	          'multiple' => false,
            'width' => '500px',
            'minimumInputLength' => 1,
	          'maximumSelectionSize'=>1,
            'ajax' => array(
                'url' => $this->createUrl('dynamicSearchOrganizations'),
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

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
