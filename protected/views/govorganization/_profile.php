<?php $model = empty($model) ? new Govprofile : $model; ?>

<?php echo $form->hiddenField($model, 'id'); ?>

<?php
    if (!is_object($model->parent)) {
        $model->parent = Govorganization::model()->findByPk($model->parent);
    }
    if ($model->parent === null) {
        $selectText = '';
    } else {
        $selectText = $model->parent->name;
        $model->parent = $model->parent->id;
    }
?>
<?php echo $form->select2Row($model, 'parent', array(
    'asDropDownList' => false,
    'prompt' => '',
    'options' => array(
        'placeholder' => 'Выбрать...',
        'allowClear' => true,
        'width' => '400px',
        'minimumInputLength' => 1,
        'ajax' => array(
            'url' => $this->createUrl('govorganizationSelectSearch'),
            'quietMillis' => 500,
            'dataType' => 'json',
            'data' => 'js:function(term, page) {
                return {query : term};
            }',
            'results' => 'js:function(data, page) {
                return {results : data};
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
        'initSelection' => 'js:function(element, callback) {
            callback({id : element.val(), name : "' . $selectText . '"});
        }',
    ),
)); ?>
