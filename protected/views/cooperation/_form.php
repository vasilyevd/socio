<?php
$cs=Yii::app()->clientScript;
$cs->registerScript('select2_index_script',"

function movieFormatResult(movie) {
    var markup = \"<table class='movie-result'><tr>\";
    if (movie.posters !== undefined && movie.posters.thumbnail !== undefined) {
        markup += \"<td class='movie-image'><img src='\" + movie.posters.thumbnail + \"'/></td>\";
    }
    markup += \"<td class='movie-info'><div class='movie-title'>\" + movie.title + \"</div>\";
    if (movie.critics_consensus !== undefined) {
        markup += \"<div class='movie-synopsis'>\" + movie.critics_consensus + \"</div>\";
    }
    else if (movie.synopsis !== undefined) {
        markup += \"<div class='movie-synopsis'>\" + movie.synopsis + \"</div>\";
    }
    markup += \"</td></tr></table>\"
    return markup;
}

function movieFormatSelection(movie) {
    return movie.title;
}

",CClientScript::POS_HEAD);
?>



<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
    'id'=>'cooperation-form',
    'enableAjaxValidation'=>true,
)); ?>

    <p class="help-block">Поля с <span class="required">*</span> обязательны.</p>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->select2Row($model, 'linkOrganization', array(
        // 'data' => CHtml::listData(Organization::model()->findAll(), 'id', 'name'),
        'asDropDownList' => false, // Tag mode.
        'multiple' => true,
        'prompt' => '', // Blank for all drop.
        'options' => array(
            'placeholder' => 'Выбрать...', // Blank for all drop.
            'allowClear' => true, // Clear for normal drop.
            'width' => '500px',
            'minimumInputLength' => 1,
            'ajax' => array(
                'url' => 'http://api.rottentomatoes.com/api/public/v1.0/movies.json',
                'url' => $this->createUrl('dynamicSearchOrganizations'),
                'dataType' => 'json',
                'data' => 'js:function(term, page) {
                    return { query: term };
                }',
                'results' => 'js:function(data, page) {
                    return { results: data.organizations };
                }',
            ),
            'formatResult' => 'js:function(model) {
                return model.name;
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
