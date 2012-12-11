<li class="span3">
    <a href="#" onclick="manageDialogLink(<?php echo '\'', $this->createUrl('updateAlbumImage', array('album' => $albumId, 'image' => $data->id)), '\''; ?>); $('#dialog-link').dialog('open'); return false;"><i class="icon-edit"></i></a>
    <a href="#" onclick="manageDialogLink(<?php echo '\'', $this->createUrl('createAlbumImage', array('album' => $albumId, 'image' => $data->id)), '\''; ?>); $('#dialog-link').dialog('open'); return false;"><i class="icon-share"></i></a>
    <?php echo CHtml::ajaxLink(
        '<i class="icon-remove"></i>',
        array(
            'deleteAlbumImage',
            'album' => $albumId,
            'image' => $data->id,
        ),
        array(
            'type' => 'POST',
            'success' => 'function() { window.location.reload(); }',
        ),
        array(
            'confirm' => 'Вы уверены, что хотите удалить данный элемент?',
        )
    ); ?>

    <a href="<?php echo $data->getUploadUrl('file'); ?>" class="thumbnail" rel="lightbox[default]" title="<?php echo CHtml::encode($data->getAlbumComment($albumId)); ?>">
        <img src="<?php echo $data->getUploadUrl('file'); ?>" alt="Image">
    </a>
</li>

<?php if(($index + 1) % 3 == 0): ?>
    </ul>
    <ul class="thumbnails">
<?php endif; ?>
