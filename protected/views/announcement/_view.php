<b><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></b>
(<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $data->category)); ?>)
<br />

<?php echo CHtml::encode($data->publication_time); ?>
<br />

<?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>
<br />
<br />
