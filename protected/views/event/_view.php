<div class="row feed-list">
    <div class="span7">
        <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
        (<?php echo CHtml::encode(Lookup::item('EvtypeCategory', $data->category)); ?>)
    </div>

    <div class="pull-right">
        <?php echo CHtml::encode($data->start_time); ?>
    </div>

    <div class="span9">
        <?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?>
        <?php echo CHtml::link('Подробнее',array('view','id'=>$data->id),array('class'=>'btn btn-info btn-mini')); ?>
    </div>
</div>

<hr>
