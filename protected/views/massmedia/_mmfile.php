<?php if(($index == 0) || (($index) % 3 == 0)): ?>
    <div class="row">
<?php endif; ?>

<div class="span3">
    <div class="well well-small">
        <?php echo CHtml::link(CHtml::encode($data->name), $data->getUploadUrl('name'), array('target' => '_blank')); ?>
        (<?php echo CHtml::encode(Lookup::item('MmfileCategory', $data->category)); ?>)

        <?php if ($data->preview): ?>
            <?php $thumbnail = $data->getThumbUrl(); ?>
            <?php $gallery = $data->getGallery(); ?>

            <?php if (!empty($thumbnail)): ?>
                <?php echo CHtml::link(
                    CHtml::image(
                        $thumbnail,
                        'Предварительный просмотр файла'
                    ),
                    $gallery[0],
                    array(
                        'class' => 'thumbnail',
                        'rel' => 'lightbox[' . $index . ']',
                        'title' => CHtml::encode($data->name),
                    )
                ); ?>
            <?php else: ?>
                <div class="thumbnail">
                    <?php echo CHtml::image(
                        Yii::app()->baseUrl . '/images/icons/absent_preview_140x140.jpg',
                        'Предварительный просмотр файла'
                    ); ?>
                </div>
            <?php endif; ?>

            <?php foreach (array_slice($gallery, 1) as $url): ?>
                <?php echo CHtml::link(
                    '',
                    $url,
                    array(
                        'rel' => 'lightbox[' . $index . ']',
                        'title' => CHtml::encode($data->name),
                    )
                ); ?>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="thumbnail">
                <?php echo CHtml::image(
                    Yii::app()->baseUrl . '/images/icons/loading_preview_140x140.jpg',
                    'Предварительный просмотр файла'
                ); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php if(($index + 1 == $widget->dataProvider->getItemCount()) || (($index + 1) % 3 == 0)): ?>
    </div>
<?php endif; ?>
