<div class="row feed-list">
    <div class="span7">
        <strong><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></strong>
        (<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $data->category)); ?>)
    </div>

    <div class="pull-right">
        <?php echo CHtml::encode($data->publication_time); ?>
    </div>

    <div class="span9">
        <?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>
        <?php echo CHtml::link('Подробнее',array('view','id'=>$data->id),array('class'=>'btn btn-info btn-mini')); ?>
    </div>
</div>

<hr>
