<?php
$this->menu_org = Organization::model()->findByPk($_GET['org']);
$this->layout = '//layouts/presentation';

$this->breadcrumbs=array(
    'Мы в СМИ',
);
?>

<p class="lead">Компании СМИ</p>
<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'massmedia-listview',
    'dataProvider' => new CArrayDataProvider(Mmcompany::model()->findAll()),
    'itemView' => '_mmcompany',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    // 'sortableAttributes' => array(
    //     'title',
    // ),
)); ?>

<hr>
<p class="lead">Теги</p>
<?php foreach (Mmtag::model()->with('massmedias')->findAll('massmedias.organization_id=:organization_id', array(':organization_id' => $_GET['org'])) as $t): ?>
    [<?php echo CHtml::link(
        CHtml::encode($t->name),
        array(
            'index',
            'org' => $_GET['org'],
            'Massmedia[tags][]' => $t->id,
        )
    ); ?>]
<?php endforeach; ?>

<hr>
<p class="lead">Элементы СМИ</p>
<?php $this->widget('bootstrap.widgets.TbListView',array(
    // 'id' => 'massmedia-listview',
    'dataProvider' => $model->search(),
    'itemView' => '_view',
    // 'viewData' => array('albumId' => $model->id),
    // 'template' => '{items}{pager}', // Hide summary header.
    // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    'sortableAttributes' => array(
        'title',
    ),
)); ?>
