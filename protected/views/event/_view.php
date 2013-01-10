<b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
(<?php echo CHtml::encode(Lookup::item('EvtypeCategory', $data->category)); ?>)

<div class="pull-right">
    <?php echo CHtml::encode($data->start_time); ?>
</div>

<p><?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?></p>

<hr>
