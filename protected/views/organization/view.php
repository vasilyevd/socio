<?php
/** @var $this Controller  */
$this->menu_org = $model;
$this->escalation['model'] = $model;
$this->layout = '//layouts/presentation';

$this->breadcrumbs=array(
    'О Нас',
);
?>

<div class="row">

<?php if(!empty($model->foundation_year)): ?>
<div class="span4">
	<b><?php echo CHtml::encode($model->getAttributeLabel('foundation_year')); ?>:</b>
	<?php echo CHtml::encode($model->foundation_year); ?>
</div>
<?php endif; ?>

<?php if(!empty($model->staff_size)): ?>
<div class="span4">
	<b><?php echo CHtml::encode($model->getAttributeLabel('staff_size')); ?>:</b>
	<?php echo CHtml::encode($model->staff_size); ?>
</div>
<?php endif; ?>

<?php if(!empty($model->website) || !empty($model->email)): ?>
	<?php if(!empty($model->website)): ?>
	<div class="span4">
		<b><?php echo CHtml::encode($model->getAttributeLabel('website')); ?>:</b>
		<a href="<?php echo CHtml::encode($model->website); ?>" target="_blank"><?php echo CHtml::encode($model->website); ?></a>
	</div>
	<?php endif; ?>
	<?php if(!empty($model->email)): ?>
	<div class="span4">
		<b><?php echo CHtml::encode($model->getAttributeLabel('email')); ?>:</b>
		<a href="mailto:<?php echo CHtml::encode($model->email); ?>"><?php echo CHtml::encode($model->email); ?></a>
	</div>
	<?php endif; ?>
<?php endif; ?>

<?php if(!empty($model->city_id) || !empty($model->address_id)): ?>
        <?php if(!empty($model->city_id)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('city_id')); ?>:</b>
                <?php echo CHtml::encode($model->city_id); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($model->address_id)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('address_id')); ?>:</b>
                <?php echo CHtml::encode($model->address_id); ?>
            </div>
        <?php endif; ?>
<?php endif; ?>

<?php if(!empty($model->phone_num)): ?>
<div class="span9">
	<b><?php echo CHtml::encode($model->getAttributeLabel('phone_num')); ?>: </b>
	<?php echo CHtml::encode($model->phone_num); ?>
</div>
<?php endif; ?>

</div>


<?php if(!empty($model->description) || !empty($model->goal)): ?>
    <hr>
    <div class="row">
        <?php if(!empty($model->description)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b><br />
                <?php echo $model->description; ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($model->goal)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('goal')); ?>:</b><br />
                <?php echo $model->goal; ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

