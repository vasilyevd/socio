<?php
$this->breadcrumbs=array(
    'Организации',
);

// $this->menu=array(
//     array('label'=>'Create Organization','url'=>array('create')),
//     array('label'=>'Manage Organization','url'=>array('admin')),
// );

$this->layout='//layouts/column1';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    // This is listview id.
    $.fn.yiiListView.update('organization-listview', {
        data: $(this).serialize()
    });
    return false;
});
// On type listview update.
var ajaxUpdateTimeout;
var ajaxRequest;
$('input.fast-search').keyup(function(){
    ajaxRequest = $(this).serialize();
    clearTimeout(ajaxUpdateTimeout);
    ajaxUpdateTimeout = setTimeout(function () {
        $.fn.yiiListView.update(
            // This is the id of the CListView.
            'organization-listview',
            {data: ajaxRequest}
        )
    },
    // This is the delay.
    300);
});
");
?>

<div class="search-form">
    <?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm',array(
        'action'=>Yii::app()->createUrl($this->route),
        'method'=>'get',
    )); ?>
        <div class="row">
            <div class="offset3">
                <div class="form-search">
                    <div class="input-append">
                        <?php echo $form->textField($model,'name',array('class'=>'span5 search-query fast-search','maxlength'=>128)); ?>
                        <?php $this->widget('bootstrap.widgets.TbButton', array(
                            'buttonType'=>'submit',
                            'label'=>'Поиск',
                        )); ?>
                    </div>
                </div>
                <?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button')); ?>
            </div>
        </div>
    <?php $this->endWidget(); ?>
</div>

<?php if (!empty($model->directionSearch)): ?>
    <h1>Поиск по категории <?php echo CHtml::encode(Direction::model()->findByPk($model->directionSearch)->name); ?></h1>
<?php endif; ?>

<div class="search-form" style="display:none">
    <?php echo CHtml::link('Обычный поиск','#',array('class'=>'search-button')); ?>
    <?php $this->renderPartial('_search',array(
        'model'=>$model,
    )); ?>
</div>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'organization-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Items container class. Default: items.
    'sortableAttributes' => array(
        'name',
        'type_id',
        'action_area',
        'foundation_year',
    ),
)); ?>
