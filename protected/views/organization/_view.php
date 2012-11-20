<div class="org-listitem">
    <div class="well">
        <a href="<?php echo $data->getUploadUrl('logo', $data->logo); ?>"><img src="<?php echo $data->getUploadUrl('logo', $data->logo); ?>" alt="Logo"></a>

        <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
        (<?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)); ?>)
        <?php if (!empty($data->description)): ?>
            <br />
            <br />

            <?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?>
        <?php endif; ?>
    </div>
</div>
