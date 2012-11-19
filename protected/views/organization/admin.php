<?php
$this->breadcrumbs=array(
    'Организации'=>array('index'),
    'Управление',
);

// $this->menu=array(
//     array('label'=>'List Organization','url'=>array('index')),
//     array('label'=>'Create Organization','url'=>array('create')),
// );

$this->layout='//layouts/column1';

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('organization-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Управление Организациями</h1>

<p class="help-block">Можно использовать операторы сравнения (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; или =).</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'organization-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        // 'id',
        'name',
        // 'type',
        // 'action_area',
        // 'city_id',
        // 'address_id',
        // 'foundation_year',
        // 'staff_size',
        // 'description',
        // 'goal',
        // 'website',
        // 'phone_num',
        // 'email',
        // 'logo',
        array(
            'name' => 'create_time',
            'filter' => false,
        ),
        array(
            'name' => 'status',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'source' => Lookup::items('OrganizationStatus'),
                'placement' => 'top',
                'enabled' => true,
            ),
            'filter' => Lookup::items('OrganizationStatus'),
        ),
        array(
            'name' => 'verified',
            'class' => 'bootstrap.widgets.TbEditableColumn',
            'editable' => array(
                'type' => 'select',
                'url' => $this->createUrl('dynamicAdminUpdate'),
                'source' => array(false => 'Нет', true => 'Да'),
                'placement' => 'left',
                'enabled' => true,
                'onRender' => 'js: function(e, edt) {
                    var colors = {0: "red", 1: "green"};
                    $(this).css("color", colors[edt.value]);
                }'
            ),
            'filter' => array(false => 'Нет', true => 'Да'),
        ),
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
