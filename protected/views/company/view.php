<?php
$this->layout = '//layouts/presentation';
$this->breadcrumbs=array(
    'Мы в СМИ' => array('massmedia/index', 'org' => $this->menu_org->id),
    $model->name,
);

$this->menu=array(
    array('label' => 'Управление Компаниями СМИ'),
    array('label' => 'Изменить Компанию СМИ', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Компанию СМИ', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->name; ?></h1>

<div class='row'>
    <div class='span9'>
        <?php echo CHtml::encode($model->description); ?>
    </div>
</div>

<hr>
<p class="lead">Элементы СМИ</p>
<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'massmedia-listview',
    'dataProvider' => new CArrayDataProvider($model->massmedias),
    'itemView' => '_massmedia',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    // 'sortableAttributes' => array(
    //     'title',
    // ),
)); ?>
