<?php
/** @var $this Controller  */
$this->menu = array_merge(array(
    array('label' => 'Управление Событиями'),
    array('label' => 'Добавить Новость', 'icon' => 'cog', 'url' => array('announcement/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Мероприятие', 'icon' => 'cog', 'url' => array('event/create', 'org' => $this->menu_org->id)),
), $this->menu);
// @todo : after change of all view with "$this->menu" replaxe by array of menu-items
$this->menu_operations = $this->menu;
?>

<?php
/* SET MENU ITEMS FOR - announcement part of organization page */
$this->menu_item_sub = array(
	array('label' => 'Лента', 'url' => array('announcement/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='announcement'),
	array('label' => 'Новости', 'url' => array('news/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='news'),
	array('label' => 'Мероприятия', 'url' => array('event/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='event'),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>
	<?php echo $content; ?>
<?php $this->endContent(); ?>
