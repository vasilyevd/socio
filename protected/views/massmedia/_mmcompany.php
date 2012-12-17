<div class="row">
    <div class="span9">
        <?php echo CHtml::link(CHtml::encode($data->name),array('mmcompany/view','id'=>$data->id)); ?>
        (<?php echo CHtml::encode(Lookup::item('MmcompanyType', $data->type)); ?>)
    </div>
</div>
