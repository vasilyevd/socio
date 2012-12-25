<?php
$this->breadcrumbs = array_merge(array(
    'Организации' => array('organization/index'),
    CHtml::encode($this->menu_org->name) => array('organization/view', 'id' => $this->menu_org->id),
), $this->breadcrumbs);
?>

<?php $this->beginContent('//layouts/main'); ?>

<!-- HEADER FOR ORGANIZATION -->
<div class="row">
    <div class="span12">
        <div id="org-header" class="org-header">




	        <!-- NAME -->
	        <div class="main-name">
		        <?php echo CHtml::encode($this->menu_org->name); ?>
	        </div>


	        <div class="item-header-container">

		        <!-- FON -->
		        <div class="item-header-bg">
		          <?=CHtml::image('/images/orgtitile.jpg'); ?>
		        </div>

		        <!-- LOGO -->
		        <div class="item-header-logo" style="">
			        <img src="<?php echo $this->menu_org->getUploadUrl('logo'); ?>" alt="Logo">
		        </div>

		        <!-- TEXT -->
		        <div class="item-header-content">
			        <p><span class="pre-info">Группа типа: </span> Объединения граждан</p>
			        <p><span class="pre-info">Тип: </span>Государственное предприятие</p>
			        <p><span class="pre-info">Область действий: </span>Региональное</p>
			        <p><span class="pre-info">Направления:</span> </p>

		        </div>

		        <!-- INFO-RIGHT -->
		        <div class="item-header-widget" style="background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0.45), #FFFFFF 60%); margin: 10px; min-height: 170px; padding: 10px 0; position: absolute; right: 0;
top: 0; width: 160px;">

			        <div class="info" style="font-family: PTSansNarrow; font-size: 16px; font-weight: bold; text-align: center; text-transform: uppercase; margin-bottom: 7px;">
				        <?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$this->menu_org->action_area)); ?>
			        </div>

			        <?php if (!empty($this->menu_org->city_id)): ?>
			        <div class="info" style="font-family: PTSansNarrow; font-size: 16px; font-weight: bold; text-align: center; text-transform: uppercase; margin-bottom: 7px;">
			        г. <?php echo CHtml::encode($this->menu_org->city_id); ?>
					    </div>
			        <?php endif; ?>

		        </div>


	        </div>



	        <!-- MENU -->
	        <div>
		        <?php
		        $this->widget('bootstrap.widgets.TbMenu', array(
				        'htmlOptions'=>array('class'=>'nav-pills'),
				        'items'=>array(
					        array('label'=>'Описание', 'url'=>'#'),
					        array('label'=>'Новости', 'url'=>'#'),
					        array('label'=>'Достижения', 'url'=>'#'),
					        '',
					        array('label'=>'Галерея', 'url'=>'#'),
					        array('label'=>'Коллектив', 'url'=>'#'),
				        ),
			        ));
		        ?>
	        </div>



        </div>
    </div>
</div>

	<!-- UNDER HEADER - LEFT MENU & CONTENT -->
<div class="row">
    <div class="span3">
        <?php $this->widget('bootstrap.widgets.TbMenu', array(
            'type' => 'list', // '', 'tabs', 'pills' (or 'list')
            // 'stacked' => true, // stacked state for tabs and pills
            'htmlOptions' => array('class' => 'well'), // bg for list
            'items' => array_merge(array(
                array('label' => 'Организация'),
                array('label' => 'События', 'icon' => 'book', 'url' => array('announcement/index', 'org' => $this->menu_org->id)),
                array('label' => 'Пресса', 'icon' => 'wrench', 'url' => array('organization/index')),
                '---',
                array('label' => 'Презентация', 'icon' => 'list', 'url' => array('organization/view', 'id' => $this->menu_org->id)),
                array('label' => 'Галерея', 'icon' => 'camera', 'url' => array('album/index', 'org' => $this->menu_org->id)),
                array('label' => 'Коллектив', 'icon' => 'wrench', 'url' => array('organization/index')),
                '---',
                array('label' => 'Потенциал', 'icon' => 'certificate', 'url' => array('cooperation/index', 'org' => $this->menu_org->id)),
                array('label' => 'Пресса', 'icon' => 'wrench', 'url' => array('organization/index')),
                array('label' => 'Развитие', 'icon' => 'wrench', 'url' => array('organization/index')),
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
