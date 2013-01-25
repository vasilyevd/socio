<strong><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></strong>
(<?php echo Lookup::item('CompanyType', $data->type); ?>)
(<?php echo $data->min_date, ' -- ', $data->max_date; ?>)

<p><?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?></p>

<hr>
