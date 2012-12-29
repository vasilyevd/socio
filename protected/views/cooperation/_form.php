<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'cooperation-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->radioButtonListRow($model, 'source', Lookup::items('CooperationSource')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('CooperationSource'),
        // 'asDropDownList' => false, // Tag mode.
        // 'multiple' => true, // Multiple mode without 'asDropDownList'.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            // 'multiple' => true, // Multiple mode with 'asDropDownList'.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
    )); ?>

    <?php echo $form->select2Row($model, 'linkOrganization', array(
        // 'data' => CHtml::listData(Organization::model()->findAll(), 'id', 'name'),
        'asDropDownList' => false, // Tag mode.
        'prompt' => '', // Blank for all drop.
        'events' => array(
            'change' => 'js:function(e) {
                if (e.val == "") {
                    $(".form-hide-toggle").show();
                } else {
                    $(".form-hide-toggle").hide();
                }
                return false;
            }',
        ),
        'options' => array(
            'placeholder' => 'Введите название...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'likeinput' => true,
            'likeinputAtribute' => 'link',
            'multiple' => false,
            'width' => '500px',
            'minimumInputLength' => 1,
            'maximumSelectionSize' => 1,
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

    <div class="form-hide-toggle">
        <?php echo $form->fileFieldRow($model,'logo'); ?>
    </div>

    <?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textFieldRow($model,'contact_name',array('class'=>'span5','maxlength'=>128)); ?>

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
