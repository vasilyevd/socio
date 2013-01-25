<?php
/** @var $this Controller */
$this->sectionMain = "org";
$this->sectionMainSub='org';
$model = $this->escalation['organization'];

$this->breadcrumbs = array_merge(array(
    'Организации' => array('organization/index'),
    CHtml::encode($this->menu_org->name) => array('organization/view', 'id' => $this->menu_org->id),
), $this->breadcrumbs);
?>
<style type="text/css">
	.content{ background-color: #F2F2F2; }
</style>

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
		        <?php
		        // echo $model->logo;
		        /** @var $model Organization */
		        if(!empty($model->logobg)) :
				      echo CHtml::tag('div',array('class'=>'item-header-bg'));
				      echo CHtml::image($model->getUploadUrl('logobg'));
				      echo CHtml::closeTag('div');
		        endif;
		        ?>

		        <!-- LOGO -->
	          <?php
		        $logo_class = array('item-header-logo spn3');
		        if (empty($model->logobg)) $logo_class[] = 'no-bg';
		        echo CHtml::tag('div',array('class'=>implode(' ', $logo_class)));
		        ?>
			        <img src="<?php echo $this->menu_org->getUploadUrl('logo'); ?>" alt="Logo">
		        </div>

		        <!-- TEXT -->
		        <div class="item-header-content offset3">
			        <p><?php echo CHtml::encode(Lookup::item('OrgtypeGroup', $model->type_group)); ?></p>
			        <p>
				        <span class="pre-info">Тип: </span>
				        <?php echo CHtml::encode($model->type->name); ?>
			        </p>
			        <?php if(!empty($model->directions)): ?>
	            <p>
		            <span class="pre-info">Направления деятельности:</span>
		            <?php echo CHtml::encode(implode(', ', CHtml::listData($model->directions, 'id', 'name'))); ?>
	            </p>
			        <?php endif; ?>
			        <?php if(!empty($model->problems)): ?>
			        <p>
				        <span class="pre-info"><?php echo CHtml::encode($model->getAttributeLabel('problems')); ?>:</span>
				        <?php echo CHtml::encode(implode(', ', CHtml::listData($model->problems, 'id', 'name'))); ?>
			        </p>
			        <?php endif; ?>

		        </div>

		        <!-- INFO-RIGHT -->
		        <div class="item-header-widget" style="background-image: linear-gradient(to bottom, rgba(242, 242, 242, 0.45), #F2F2F2 60%); margin: 0 10px; min-height: 175px; padding: 10px 0; position: absolute; right: 0;
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
	        <div class="navbar-inverse">
		        <div class="span3"></div>
		        <?php
		        $this->widget('bootstrap.widgets.TbMenu', array(
				        'htmlOptions'=>array('class'=>'nav-pills item-header-pading-from-logo padding3'),
				        'items'=>$this->menu_item_sub,
			        ));
		        ?>
	        </div>


	    <div>
		    <?php /*
		    $this->widget('bootstrap.widgets.TbSelect2', array(
				    'asDropDownList' => false,
				    'name' => 'clevertech',
				    'options' => array(
					    'tags' => array('clever','is', 'better', 'clevertech'),
					    'placeholder' => 'disciplines',
					    'width' => '40%',
					    //'tokenSeparators' => array(',', ' ')
				    )));
*/
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
