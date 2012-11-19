<?php
$this->menu_org = $model;

$this->breadcrumbs=array(
    'Организации'=>array('index'),
    CHtml::encode($model->name),
);

$this->menu=array(
    array('label' => 'Управление Организацией'),
    array('label' => 'Изменить Организацию', 'icon' => 'cog', 'url' => array('update', 'id' => $model->id)),
);
?>

<h1><?php echo CHtml::encode($model->name); ?></h1>

<hr>
<div class="row">
    <div class="span4">
        <b><?php echo CHtml::encode($model->getAttributeLabel('type')); ?>:</b>
        <?php echo CHtml::encode(Lookup::item('OrganizationType',$model->type)); ?>
    </div>
    <div class="span4">
        <b><?php echo CHtml::encode($model->getAttributeLabel('action_area')); ?>:</b>
        <?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$model->action_area)); ?>
    </div>
    <?php if(!empty($model->direction)): ?>
        <div class="span9">
            <b><?php echo CHtml::encode($model->getAttributeLabel('direction')); ?>:</b>
            <?php echo CHtml::encode(implode(', ', Lookup::itemsByCodes('OrganizationDirection', $model->direction))); ?>
        </div>
    <?php endif; ?>
    <?php if(!empty($model->problem)): ?>
        <div class="span9">
            <b><?php echo CHtml::encode($model->getAttributeLabel('problem')); ?>:</b>
            <?php echo CHtml::encode(implode(', ', CHtml::listData(Problem::model()->findAllByPk($model->problem), 'id', 'name'))); ?>
        </div>
    <?php endif; ?>
</div>

<?php if(!empty($model->city_id) || !empty($model->address_id)): ?>
    <hr>
    <div class="row">
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
    </div>
<?php endif; ?>

<?php if(!empty($model->description) || !empty($model->goal) || !empty($model->foundation_year) || !empty($model->staff_size) || !empty($model->phone_num)): ?>
    <hr>
    <div class="row">
        <?php if(!empty($model->description)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('description')); ?>:</b><br />
                <?php echo CHtml::encode($model->description); ?>
            </div>
        <?php endif; ?>
        <?php if(!empty($model->goal)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('goal')); ?>:</b><br />
                <?php echo CHtml::encode($model->goal); ?>
            </div>
        <?php endif; ?>
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
        <?php if(!empty($model->phone_num)): ?>
            <div class="span9">
                <b><?php echo CHtml::encode($model->getAttributeLabel('phone_num')); ?>:</b><br />
                <?php echo CHtml::encode($model->phone_num); ?>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>

<?php if(!empty($model->website) || !empty($model->email)): ?>
    <hr>
    <div class="row">
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
    </div>
<?php endif; ?>
