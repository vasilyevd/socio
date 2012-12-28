<?php
$this->menu = array_merge(array(
    array('label' => 'Управление Потенциалом'),
    array('label' => 'Добавить Сотрудничество', 'icon' => 'cog', 'url' => array('cooperation/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Партнерство', 'icon' => 'cog', 'url' => array('partnership/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Поддержку', 'icon' => 'cog', 'url' => array('support/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Донора', 'icon' => 'cog', 'url' => array('donorship/create', 'org' => $this->menu_org->id)),
), $this->menu);
?>

<?php $this->beginContent('//layouts/organization'); ?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked' => true, // stacked state for tabs and pills
    'items' => array(
        array('label' => 'Сотрудничество', 'url' => array('cooperation/index', 'org' => $this->menu_org->id)),
        array('label' => 'Партнерство', 'url' => array('partnership/index', 'org' => $this->menu_org->id)),
        array('label' => 'Поддержка', 'url' => array('support/index', 'org' => $this->menu_org->id)),
        array('label' => 'Доноры', 'url' => array('donorship/index', 'org' => $this->menu_org->id)),
    ),
)); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
