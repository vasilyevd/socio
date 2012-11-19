<li class="span3">
    <?php if (isset($albumId)): ?>
        <a href="<?php echo $data->getUploadUrl('file', $data->file); ?>" class="thumbnail" rel="lightbox[<?php echo $albumId; ?>]" title="<?php echo CHtml::encode($data->getAlbumComment($albumId)); ?>">
    <?php else: ?>
        <a href="<?php echo $data->getUploadUrl('file', $data->file); ?>" class="thumbnail" rel="lightbox[default]" title="">
    <?php endif; ?>
        <img src="<?php echo $data->getUploadUrl('file', $data->file); ?>" alt="Image">
    </a>
</li>
