<div class="span3 feed-list">
    <br />
    <b><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></b>
    (<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $data->category)); ?>)
    <br />

    <?php echo CHtml::encode($data->publication_time); ?>
    <br />

    <?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>

    <b><?php echo CHtml::link('Подробнее',array('view','id'=>$data->id),array('class'=>'btn btn-info btn-mini')); ?></b>
</div>

<?php if(($index + 1) % 3 == 0): ?>
    </div>
    <div class="row">
<?php endif; ?>
