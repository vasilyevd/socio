<div class="row">
    <div class="span9">
        <?php echo CHtml::link(CHtml::encode($data->name),array('company/view','id'=>$data->id)); ?>
        (<?php echo CHtml::encode(Lookup::item('CompanyType', $data->type)); ?>)
    </div>
</div>
