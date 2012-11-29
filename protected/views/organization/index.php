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

<div class="search-form" style="display:none">
    <?php $this->renderPartial('_searchUserFilter',array(
        'model'=>$model,
    )); ?>
</div>

<?php if (!empty($model->directions)): ?>
    <h3>Поиск по категории &laquo;<?php echo CHtml::encode($model->directions[0]->name); ?>&raquo;</h3>
<?php endif; ?>
<?php if (!empty($model->problems)): ?>
    <h3>Поиск по проблематику &laquo;<?php echo CHtml::encode($model->problems[0]->name); ?>&raquo;</h3>
<?php endif; ?>
<?php if (!empty($model->type)): ?>
    <h3>Поиск по типу &laquo;<?php echo CHtml::encode($model->type->name); ?>&raquo;</h3>
<?php endif; ?>

<?php $this->widget('bootstrap.widgets.TbListView',array(
    'id' => 'organization-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    'itemsCssClass' => 'org-search-list', // Items container class. Default: items.
    'sortableAttributes' => array(
        'name',
        'type',
        'action_area',
    ),
)); ?>
