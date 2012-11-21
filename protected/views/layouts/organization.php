<?php
$this->breadcrumbs = array_merge(array(
    'Организации' => array('organization/index'),
    CHtml::encode($this->menu_org->name) => array('organization/view', 'id' => $this->menu_org->id),
), $this->breadcrumbs);
?>

<?php $this->beginContent('//layouts/main'); ?>

<div class="row">
    <div class="span12">
        <div class="well">
            <div class="org-header">
                <div class="row">
                    <div class="span3">
                        <a href="<?php echo $this->menu_org->getUploadUrl('logo', $this->menu_org->logo); ?>">
                            <img src="<?php echo $this->menu_org->getUploadUrl('logo', $this->menu_org->logo); ?>" alt="Logo">
                        </a>
                    </div>

                    <div class="span3">
                        <h3><?php echo CHtml::encode($this->menu_org->name); ?></h3>
                    </div>

                    <div class="span2 pull-right">
                        <h3><?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$this->menu_org->action_area)); ?></h3>
                        <?php if (!empty($this->menu_org->city_id)): ?>
                            <h3>г. <?php echo CHtml::encode($this->menu_org->city_id); ?></h3>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="span3">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'list', // '', 'tabs', 'pills' (or 'list')
            // 'stacked' => true, // stacked state for tabs and pills
            'htmlOptions' => array('class' => 'well'), // bg for list
            'items' => array_merge(array(
                array('label' => 'Организация'),
                array('label' => 'События', 'icon' => 'book', 'url' => array('organization/feed', 'id' => $this->menu_org->id)),
                array('label' => 'Пресса', 'icon' => 'wrench', 'url' => array('organization/index')),
                '---',
                array('label' => 'Презентация', 'icon' => 'list', 'url' => array('organization/view', 'id' => $this->menu_org->id)),
                array('label' => 'Коллектив', 'icon' => 'wrench', 'url' => array('organization/index')),
                array('label' => 'Галерея', 'icon' => 'camera', 'url' => array('album/index', 'org' => $this->menu_org->id)),
                '---',
                array('label' => 'Развитие', 'icon' => 'wrench', 'url' => array('organization/index')),
                array('label' => 'Потенциал', 'icon' => 'wrench', 'url' => array('organization/index')),
                array('label' => 'Деятельность', 'icon' => 'wrench', 'url' => array('organization/index')),
            ), $this->menu),
        )); ?>

        Followers Here (in well)
    </div>

    <div class="span9">
        <?php echo $content; ?>
    </div>
</div>

<?php $this->endContent(); ?>
