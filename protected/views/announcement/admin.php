<?php
$this->breadcrumbs=array(
    'Уведомления'=>array('index'),
    'Управление',
);

$this->menu=array(
    array('label'=>'List Announcement','url'=>array('index')),
    array('label'=>'Create Announcement','url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
    $('.search-form').toggle();
    return false;
});
$('.search-form form').submit(function(){
    $.fn.yiiGridView.update('announcement-grid', {
        data: $(this).serialize()
    });
    return false;
});
");
?>

<h1>Управление Новостями</h1>

<p class="help-block">Можно использовать операторы сравнения (&lt;, &lt;=, &gt;, &gt;=, &lt;&gt; или =).</p>

<?php echo CHtml::link('Расширенный поиск','#',array('class'=>'search-button btn')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
    'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('bootstrap.widgets.TbGridView',array(
    'id'=>'announcement-grid',
    'dataProvider'=>$model->search(),
    'filter'=>$model,
    'columns'=>array(
        'id',
        'title',
        'content',
        'create_time',
        'publication_time',
        'status',
        /*
        'organization_id',
        'author_id',
        'files',
        'category',
        */
        array(
            'class'=>'bootstrap.widgets.TbButtonColumn',
        ),
    ),
)); ?>
