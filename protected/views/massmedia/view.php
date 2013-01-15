<?php
$this->layout = '//layouts/presentation';
$this->breadcrumbs=array(
    'Мы в СМИ' => array('index', 'org' => $this->menu_org->id),
    $model->title,
);

$this->menu=array(
    array('label' => 'Управление Элементами СМИ'),
    array('label' => 'Изменить Элемент СМИ', 'icon' => 'cog', 'url'=>array($routePrefix . 'update','id'=>$model->id)),
    array('label' => 'Удалить Элемент СМИ', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array($routePrefix . 'delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/lightbox.js'
);
Yii::app()->clientScript->registerCssFile(
    Yii::app()->baseUrl.'/css/lightbox.css'
);
?>

<h1><?php echo $model->title; ?></h1>

<div class='row'>
    <div class='span9'>
        <?php echo $model->content; ?>
    </div>
</div>

<hr>
<p class="lead">Файлы</p>
<?php $this->widget('bootstrap.widgets.TbListView',array(
    'dataProvider' => new CArrayDataProvider(
        $model->files,
        array('pagination'=>false)
    ),
    'itemView' => '//massmedia/_mmfile',
    'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'items org-main-direction-items', // Items container class. Default: items.
    'htmlOptions' => array('class'=>'') // Blank class for list-view to remove padding top.
)); ?>


<hr>
<p class="lead">Ссылки</p>
<ul class="unstyled">
    <?php foreach ($model->linksYoutube as $m): ?>
        <li><?php $this->widget('ext.Yiitube.Yiitube', array('v' => $m->name)); ?></li>
    <?php endforeach; ?>
    <?php foreach ($model->linksGeneral as $m): ?>
        <li><?php echo CHtml::link(CHtml::encode($m->name), $m->name, array('target' => '_blank')); ?></li>
    <?php endforeach; ?>
</ul>

<hr>
<p class="lead">Теги</p>
<?php foreach ($model->tags as $m): ?>
    [<?php echo CHtml::link(
        CHtml::encode($m->name),
        array(
            'massmedia/index',
            'org' => $model->organization->id,
            'Massmedia[tags][]' => $m->id,
        )
    ); ?>]
<?php endforeach; ?>
