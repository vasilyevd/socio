<?php
$this->sectionMain = 'org';
$this->breadcrumbs=array(
    'Организации',
);

$this->layout='//layouts/column1';

Yii::app()->clientScript->registerScript('search', "
// Dynamic listview update.
var ajaxUpdateTimeout;
function dynamicOrganizationFilter() {
    clearTimeout(ajaxUpdateTimeout);
    ajaxUpdateTimeout = setTimeout(
        function() {
            $.fn.yiiListView.update(
                // This is the id of the CListView.
                'organization-listview',
                { data: $('.organization-filter').serialize() }
            )
        },
        // This is the delay.
        500
    );
    return false;
};
", CClientScript::POS_END);
?>

<?php if (!empty($model->type)): ?>
    <p class="lead">Поиск по типу: <?php echo CHtml::encode($model->type->name); ?></p>
<?php endif; ?>
<?php if (!empty($model->directions)): ?>
    <p class="lead">
        Поиск по категории:
        <?php echo CHtml::encode(implode(', ', CHtml::listData($model->directions, 'name', 'name'))); ?>
    </p>
<?php endif; ?>
<?php if (!empty($model->problems)): ?>
    <p class="lead">
        Поиск по проблематику:
        <?php echo CHtml::encode(implode(', ', CHtml::listData($model->problems, 'name', 'name'))); ?>
    </p>
<?php endif; ?>

<div class="row">
    <div class="span9">
        <?php $this->renderPartial('_searchMainFilter',array(
            'model'=>$model,
        )); ?>

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
    </div>

    <div class="span3">
        <?php $this->renderPartial('_searchSubFilter',array(
            'model'=>$model,
        )); ?>
    </div>
</div>
