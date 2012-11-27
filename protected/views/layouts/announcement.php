<?php
$this->menu = array(
    array('label' => 'Управление Событиями'),
    array('label' => 'Добавить Новость', 'icon' => 'cog', 'url' => array('announcement/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Мероприятие', 'icon' => 'cog', 'url' => array('event/create', 'org' => $this->menu_org->id)),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>

<?php $this->widget('bootstrap.widgets.TbMenu', array(
    'type' => 'tabs', // '', 'tabs', 'pills' (or 'list')
    // 'stacked' => true, // stacked state for tabs and pills
    'items' => array(
        array('label' => 'Лента', 'url' => array('announcement/index', 'org' => $this->menu_org->id)),
        array('label' => 'Новости', 'url' => array('announcement/news', 'org' => $this->menu_org->id)),
        array('label' => 'Мероприятия', 'url' => array('event/index', 'org' => $this->menu_org->id)),
    ),
)); ?>

<?php echo $content; ?>

<?php $this->endContent(); ?>
