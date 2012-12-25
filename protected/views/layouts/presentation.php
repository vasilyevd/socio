<?php
$this->menu=array(
    array('label' => 'Управление Организацией'),
    array('label' => 'Изменить Организацию', 'icon' => 'cog', 'url' => array('organization/update', 'id' => $this->menu_org->id)),
    array('label' => 'Добавить Достижение', 'icon' => 'cog', 'url' => array('achievement/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Элемент СМИ', 'icon' => 'cog', 'url' => array('massmedia/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Компанию СМИ', 'icon' => 'cog', 'url' => array('company/create', 'org' => $this->menu_org->id)),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked' => true, // stacked state for tabs and pills
    'items' => array(
        array('label' => 'О Нас', 'url' => array('organization/view', 'id' => $this->menu_org->id)),
        array('label' => 'Достижения', 'url' => array('achievement/index', 'org' => $this->menu_org->id)),
        array('label' => 'Мы в СМИ', 'url' => array('massmedia/index', 'org' => $this->menu_org->id)),
    ),
)); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
