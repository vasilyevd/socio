<div class="view">

    <b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->id),array('view','id'=>$data->id)); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
    <?php echo CHtml::encode($data->name); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('content')); ?>:</b>
    <?php echo CHtml::encode($data->content); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('doc_date')); ?>:</b>
    <?php echo CHtml::encode($data->doc_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('geography')); ?>:</b>
    <?php echo CHtml::encode($data->geography); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('registration_num')); ?>:</b>
    <?php echo CHtml::encode($data->registration_num); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('docauthor_id')); ?>:</b>
    <?php echo CHtml::encode($data->docauthor_id); ?>
    <br />

    <?php /*
    <b><?php echo CHtml::encode($data->getAttributeLabel('doctype_id')); ?>:</b>
    <?php echo CHtml::encode($data->doctype_id); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('publication_date')); ?>:</b>
    <?php echo CHtml::encode($data->publication_date); ?>
    <br />

    <b><?php echo CHtml::encode($data->getAttributeLabel('is_active')); ?>:</b>
    <?php echo CHtml::encode($data->is_active); ?>
    <br />

    */ ?>

</div>
