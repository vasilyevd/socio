<div class="span3">
    <b><?php echo CHtml::link(CHtml::encode($data->title),array('announcement/view','id'=>$data->id)); ?></b>
    <br />

    <?php echo CHtml::encode($data->publication_time); ?>
    <br />

    <?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>
    <br />
</div>

<?php if(($index + 1) % 3 == 0): ?>
    </div>
    <div class="row">
<?php endif; ?>
