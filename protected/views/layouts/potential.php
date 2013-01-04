<?php
$this->menu = array_merge(array(
    array('label' => 'Управление Потенциалом'),
    array('label' => 'Добавить Сотрудничество', 'icon' => 'cog', 'url' => array('cooperation/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Партнерство', 'icon' => 'cog', 'url' => array('partnership/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Поддержку', 'icon' => 'cog', 'url' => array('support/create', 'org' => $this->menu_org->id)),
    array('label' => 'Добавить Донора', 'icon' => 'cog', 'url' => array('donorship/create', 'org' => $this->menu_org->id)),
), $this->menu);
?>

<?php
/* SET MENU ITEMS FOR - POTENCIAL part of organization page */
$this->menu_item_sub = array(
    array('label' => 'Сотрудничество', 'url' => array('cooperation/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='cooperation'),
    array('label' => 'Партнерство', 'url' => array('partnership/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='partnership'),
    array('label' => 'Поддержка', 'url' => array('massmedia/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='massmedia'),
    array('label' => 'Доноры', 'url' => array('donorship/index', 'org' => $this->menu_org->id), 'active'=>$this->uniqueId =='donorship'),
);
?>

<?php $this->beginContent('//layouts/organization'); ?>
	<?php echo $content; ?>
<?php $this->endContent(); ?>
