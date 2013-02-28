<?php echo $form->select2Row($model, $attribute, array(
    'asDropDownList' => false,
    'prompt' => '',
    'options' => array(
        'placeholder' => 'Выбрать...',
        'allowClear' => true,
        'width' => '400px',
        'minimumInputLength' => 1,
        'ajax' => array(
            'url' => $url,
            'quietMillis' => 500,
            'dataType' => 'json',
            'data' => 'js:function(term, page) {
                return {query : term};
            }',
            'results' => 'js:function(data, page) {
                return {results : data};
            }',
        ),
        'formatResult' => 'js:function(input) {
            markup = "<table><tr>";
            markup += "<td><img style=\"height: 50px;\" src=\"" + input.logo + "\"/></td>";
            markup += "<td><strong>" + input.name + "</strong><br />" + input.description + "</td>";
            markup += "</tr></table>";
            return markup;
        }',
        'formatSelection' => 'js:function(input) {
            return input.name;
        }',
        'initSelection' => 'js:function(element, callback) {
            callback({id : element.val(), name : "' . $selectText . '"});
        }',
    ),
)); ?>
