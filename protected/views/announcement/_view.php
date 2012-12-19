<?php if(($index == 0) || (($index) % 3 == 0)): ?>
    <div class="row">
<?php endif; ?>

<div class="span3 feed-list">
    <br />
    <strong><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></strong>
    <?php if (!empty($data->category)): ?>
        (<?php echo CHtml::encode(Lookup::item('AnnouncementCategory', $data->category)); ?>)
    <?php endif; ?>
    <br />

    <?php echo CHtml::encode($data->publication_time); ?>
    <br />

    <?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>

    <?php echo CHtml::link('Подробнее',array('view','id'=>$data->id),array('class'=>'btn btn-info btn-mini')); ?>
</div>

<?php if(($index + 1 == $widget->dataProvider->getItemCount()) || (($index + 1) % 3 == 0)): ?>
    </div>
<?php endif; ?>
