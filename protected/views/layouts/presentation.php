<?php
$this->menu = array_merge(array(
    array('label' => 'Управление Презентацией'),
    array('label' => 'Изменить Организацию', 'icon' => 'cog', 'url' => array('organization/update', 'id' => $this->menu_org->id)),
    array('label' => 'Добавить Достижение', 'icon' => 'cog', 'url' => array('achievement/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Элемент СМИ', 'icon' => 'cog', 'url' => array('massmedia/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Пиар Компанию', 'icon' => 'cog', 'url' => array('company/create', 'org' => $this->menu_org->id)),
), $this->menu);
?>

<?php
/* SET MENU ITEMS FOR - PRESENTATION part of organization page */
$this->menu_item_sub = array(
	array('label' => 'О Нас', 'url' => array('organization/view', 'id' => $this->menu_org->id)),
	array('label' => 'Достижения', 'url' => array('achievement/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='achievement'),
	array('label' => 'Мы в СМИ', 'url' => array('massmedia/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='massmedia'),
	array('label' => 'Пиар Компании', 'url' => array('company/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='company'),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>
	<?php echo $content; ?>
<?php $this->endContent(); ?>
