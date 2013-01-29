<?php echo $form->radioButtonListRow($model, 'source', Lookup::items('PartnershipSource')); ?>

<?php echo $form->select2Row($model, 'type', array(
    'data' => Lookup::items('PartnershipType'),
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
)); ?>

<div class="form-hide-toggle">
    <?php echo $form->fileFieldRow($model,'logo'); ?>
</div>

<?php echo $form->textFieldRow($model,'email',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->textFieldRow($model,'website',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->textFieldRow($model,'contact_name',array('class'=>'span5','maxlength'=>128)); ?>

<?php echo $form->textAreaRow($model,'description',array('rows'=>6, 'cols'=>50, 'class'=>'span8')); ?>
