<?php echo $form->select2Row($model, 'linkOrganization', array(
    // 'data' => CHtml::listData(Organization::model()->findAll(), 'id', 'name'),
    'asDropDownList' => false, // Tag mode.
    'prompt' => '', // Blank for all drop.
    'options' => array(
        // 'multiple' => true, // Multiple mode with 'asDropDownList',
        'placeholder' => empty($model->link) ? 'Выбрать...' : CHtml::encode($model->link), // Blank for all drop.
        'allowClear' => true, // Clear for normal drop.
        'width' => '500px',
        'minimumInputLength' => 1,
        // 'maximumSelectionSize' => 1,
        'ajax' => array(
            'url' => $this->createUrl('cooperation/dynamicSearchOrganizations'),
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