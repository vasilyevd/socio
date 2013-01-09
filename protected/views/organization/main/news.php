<?php echo CHtml::link(CHtml::encode($data->title),array('news/view', 'id'=> $data->id)); ?>

(<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $data->category)); ?>)

<div class="pull-right">
    <?php echo CHtml::encode($data->publication_time); ?>
</div>

<p><?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?></p>
