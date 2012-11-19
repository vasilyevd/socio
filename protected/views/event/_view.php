<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('organization_id')); ?>:</b>
    <?php echo CHtml::encode($data->organization_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('author_id')); ?>:</b>
    <?php echo CHtml::encode($data->author_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
    <?php echo CHtml::encode($data->category); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type_id')); ?>:</b>
    <?php echo CHtml::encode($data->type_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type_other')); ?>:</b>
    <?php echo CHtml::encode($data->type_other); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
    <?php echo CHtml::encode($data->create_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('start_time')); ?>:</b>
    <?php echo CHtml::encode($data->start_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('end_time')); ?>:</b>
    <?php echo CHtml::encode($data->end_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('city_id')); ?>:</b>
    <?php echo CHtml::encode($data->city_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('address_id')); ?>:</b>
    <?php echo CHtml::encode($data->address_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('address_other')); ?>:</b>
    <?php echo CHtml::encode($data->address_other); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('address_description')); ?>:</b>
    <?php echo CHtml::encode($data->address_description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('status')); ?>:</b>
    <?php echo CHtml::encode($data->status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('invite_closed')); ?>:</b>
    <?php echo CHtml::encode($data->invite_closed); ?>
    <br />

    */ ?>

</div>
