<b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
(<?php echo CHtml::encode(Lookup::item('EventCategory', $data->category)); ?>)
<br />

<?php echo CHtml::encode($data->start_time); ?>
<br />

<?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?>
<br />
<br />
