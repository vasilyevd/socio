<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'support-form',
    'enableAjaxValidation'=>true,
    // Upload handler.
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->radioButtonListRow($model, 'source', Lookup::items('SupportSource')); ?>

    <?php echo $form->select2Row($model, 'type', array(
        'data' => Lookup::items('SupportType'),
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
                'url' => $this->createUrl('organization/dynamicOrganizationSearch'),
                'quietMillis'=>500,
                'dataType' => 'json',
                'data' => 'js:function(term, page) {
                    return { name : term, multiple : true };
                }',
                'results' => 'js:function(data, page) {
                    return { results : data };
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
        'events' => array(
            'change' => 'js:function(e) {
                if (e.val == "") {
                    $(".logo-toggle").show();
                } else {
                    $(".logo-toggle").hide();
                }
                return false;
            }',
        ),
    )); ?>

    <div class="logo-toggle">
        <?php echo $form->fileFieldRow($model,'logo'); ?>
    </div>

    <?php echo $form->select2Row($model, 'funds', array(
        'data' => Lookup::items('SupportFunds'),
        // 'asDropDownList' => false, // Tag mode.
        // 'multiple' => true, // Multiple mode without 'asDropDownList'.
        'prompt' => '', // Blank for all drop.
        'options' => array(
            // 'multiple' => true, // Multiple mode with 'asDropDownList'.
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '300px',
        ),
        'events' => array(
            'change' => 'js:function(e) {
                if (e.val == "' . Support::FUNDS_OTHER . '") {
                    $(".funds-specific-toggle").show();
                } else {
                    $(".funds-specific-toggle").hide();
                }
                return false;
            }',
        ),
    )); ?>

    <div class="funds-specific-toggle"<?php echo empty($model->funds_specific) ? ' style="display:none"' : ''; ?>>
        <?php echo $form->textFieldRow($model,'funds_specific',array('class'=>'span5','maxlength'=>128)); ?>
    </div>

    <?php echo $form->select2Row($model, 'delivery_year', array(
        'data' => array_combine(range(date('Y'), 1900), range(date('Y'), 1900)),
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

    <?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>

    <div class="form-actions">
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'type'=>'primary',
            'label'=>$model->isNewRecord ? 'Добавить' : 'Сохранить',
        )); ?>
    </div>

<?php $this->endWidget(); ?>
