<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id),array('view', 'id' => $data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
    <?php echo CHtml::encode($data->description); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>:</b>
    <?php echo CHtml::encode($data->type); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('create_time')); ?>:</b>
    <?php echo CHtml::encode($data->create_time); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('send_date')); ?>:</b>
    <?php echo CHtml::encode($data->send_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('receive_date')); ?>:</b>
    <?php echo CHtml::encode($data->receive_date); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('finished_status')); ?>:</b>
    <?php echo CHtml::encode($data->finished_status); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
    <?php echo CHtml::encode($data->user_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sender')); ?>:</b>
    <?php echo CHtml::encode($data->sender); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sender_id')); ?>:</b>
    <?php echo CHtml::encode($data->sender_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('sender_type')); ?>:</b>
    <?php echo CHtml::encode($data->sender_type); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('receiver')); ?>:</b>
    <?php echo CHtml::encode($data->receiver); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('receiver_id')); ?>:</b>
    <?php echo CHtml::encode($data->receiver_id); ?>
    <br />

    */ ?>

</div>
