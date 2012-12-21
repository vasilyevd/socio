<?php
$this->menu=array(
    array('label' => 'Управление Потенциалом'),
    array('label' => 'Добавить Сотрудничество', 'icon' => 'cog', 'url' => array('cooperation/create', 'org' => $this->menu_org->id)),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked' => true, // stacked state for tabs and pills
    'items' => array(
        array('label' => 'Сотрудничество', 'url' => array('cooperation/index', 'org' => $this->menu_org->id)),
        array('label' => 'Партнерство', 'url' => array('achievement/index', 'org' => $this->menu_org->id)),
        array('label' => 'Поддержка', 'url' => array('massmedia/index', 'org' => $this->menu_org->id)),
    ),
)); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
