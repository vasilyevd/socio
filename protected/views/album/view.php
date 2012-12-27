<?php
$this->breadcrumbs=array(
    'Галерея' => array('index', 'org' => $this->menu_org->id),
    $model->name,
);

$this->menu=array(
    array('label' => 'Управление Галереей'),
    array('label'=>'Изменить Альбом', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label'=>'Удалить Альбом', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);

Yii::app()->clientScript->registerScript('manageDialogLink', "
function manageDialogLink(targetUrl) {
    // Global var handler.
    if (targetUrl.length) {
        window.targetUrl = targetUrl;
    }
    " . CHtml::ajax(array(
        // 'url' => array('image/addImageToAlbum'),
        // 'url' => array('image/addImageToAlbum', 'image' => 1, 'album' => 1),
        // 'url' => 'js:\'' . $this->createUrl('image/addImageToAlbum', array('album' => $model->id, 'image' => '')) . '\'+image',
        'url' => 'js:window.targetUrl',
        'data' => 'js:$(this).serialize()',
        'type' => 'post',
        'dataType' => 'json',
        'success' => "function(data) {
            if (data.status == 'failure') {
                $('#dialog-link div.dialog-link-content').html(data.content);
                // Here is the trick: on submit-> once again this function!
                $('#dialog-link div.dialog-link-content form').submit(manageDialogLink);
            } else if (data.status == 'success' || data.status == 'refresh') {
                $('#dialog-link div.dialog-link-content').html(data.content);
                setTimeout(\"$('#dialog-link').dialog('close')\", 2000);
            }
            if (data.status == 'refresh') {
                window.location.reload();
            }
        }",
    )) . "
    return false;
}", CClientScript::POS_END);

Yii::app()->clientScript->registerScriptFile(
    Yii::app()->baseUrl.'/js/lightbox.js'
);
Yii::app()->clientScript->registerCssFile(
    Yii::app()->baseUrl.'/css/lightbox.css'
);
?>

<h1><?php echo $model->name; ?></h1>

<?php if(!empty($model->images)): ?>
    <?php $this->widget('bootstrap.widgets.TbThumbnails',array(
        'dataProvider' => new CArrayDataProvider($model->images, array('pagination'=>array('pageSize'=>9))),
        'itemView' => '_imageDetailed',
        'viewData' => array('albumId' => $model->id),
        // 'template' => '{items}{pager}', // Hide summary header.
        // 'itemsCssClass' => 'row', // Change items container class. Default: items.
    )); ?>
<?php endif; ?>

<?php $this->beginWidget('zii.widgets.jui.CJuiDialog', array(
    'id' => 'dialog-link',
    'options' => array(
        'title' => 'Добавить Изображение в Альбом',
        'autoOpen' => false,
        'modal' => true,
        'width' => 550,
        'height' => 470,
    ),
));?>
<div class="dialog-link-content"></div>
<?php $this->endWidget();?>
