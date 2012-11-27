<div class="well">
    <div class="row">
        <div class="span1">
            <?php echo CHtml::link(
                CHtml::image(
                    $data->getUploadUrl('logo', $data->logo),
                    'Organization logo'
                ),
                array('view', 'id' => $data->id),
                array(
                    'class' => 'thumbnail',
                    'rel' => 'tooltip',
                    'data-title' => CHtml::encode($data->name),
                )
            ); ?>
        </div>

        <div class="span5">
            <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>
            (<?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)); ?>)
        </div>

        <?php if (!empty($data->description)): ?>
            <div class="span11">
                <br />
                <?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
