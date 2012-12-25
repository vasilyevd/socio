<?php
$this->menu_org = $model->organization;

$this->breadcrumbs=array(
    'Сотрудничество' => array('index', 'org' => $this->menu_org->id),
    $model->link,
);

$this->menu=array(
    array('label' => 'Управление Сотрудничеством'),
    array('label' => 'Изменить Сотрудничество', 'icon' => 'cog', 'url'=>array('update','id'=>$model->id)),
    array('label' => 'Удалить Сотрудничество', 'icon' => 'cog', 'url'=>'#','linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Вы уверены, что хотите удалить данный элемент?')),
);
?>

<h1><?php echo $model->link; ?></h1>

<?php if (!empty($model->linkOrganization)): ?>
    <div class="row cooperation-view">
        <div class="span3">
            <?php echo CHtml::link(
                CHtml::image(
                    $model->linkOrganization->getUploadUrl('logo'),
                    'Лого организации'
                ),
                array('organization/view', 'id' => $model->linkOrganization->id),
                array(
                    'class' => 'thumbnail',
                    'rel' => 'tooltip',
                    'data-title' => CHtml::encode($model->link),
                )
            ); ?>
        </div>
        <?php if (!empty($model->linkOrganization->description)): ?>
            <div class="span6">
                <?php echo $model->linkOrganization->description; ?>
            </div>
        <?php endif; ?>
    </div>
    <br />
<?php endif; ?>

<?php echo CHtml::encode($model->description); ?>
