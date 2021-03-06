<div class="row feed-list">
    <div class="span7">
        <strong><?php echo CHtml::link(CHtml::encode($data->title),array('view','id'=>$data->id)); ?></strong>
        (<?php echo Lookup::item('MassmediaCategory', $data->category); ?>)
        (<?php echo $data->direction ? 'Мы в СМИ' : 'СМИ о нас'; ?>)
        <?php if (!empty($data->company)): ?>
            (<?php echo CHtml::encode($data->company->name); ?>)
        <?php endif; ?>
        (Ссылок: <?php echo $data->linksYoutubeCount; ?>)
        (Видео: <?php echo $data->linksYoutubeCount; ?>)
        (Файлов: <?php echo $data->filesCount; ?>)
    </div>

    <div class="span9">
        <?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?>
        <?php echo CHtml::link('Подробнее',array('view','id'=>$data->id),array('class'=>'btn btn-info btn-mini')); ?>
    </div>
</div>
<br />
