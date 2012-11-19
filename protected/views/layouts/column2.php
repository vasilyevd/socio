<?php /* @var $this Controller */ ?>

<?php $this->beginContent('//layouts/main'); ?>

<div class="span3">
    <?php if(!empty($this->menu_org->logo)): ?>
        <div class="well">
            <a href="<?php echo $this->menu_org->getUploadUrl('logo', $this->menu_org->logo); ?>">
                <img src="<?php echo $this->menu_org->getUploadUrl('logo', $this->menu_org->logo); ?>" alt="Logo">
            </a>
        </div>
    <?php endif; ?>

    <?php
        $this->widget('bootstrap.widgets.TbMenu', array(
            'type'=>'list', // '', 'tabs', 'pills' (or 'list')
            // 'stacked'=>true, // stacked state for tabs and pills
            'htmlOptions'=>array('class'=>'well'), // bg for list
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
        ));
    ?>

    Followers Here (in well)
</div>

<div class="span9">
    <?php echo $content; ?>
</div>

<?php $this->endContent(); ?>
