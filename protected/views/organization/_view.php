<div class="well">
    <div class="span1">
        <?php echo CHtml::link(
            CHtml::image(
                $data->getUploadUrl('logo'),
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

    <b><?php echo CHtml::link(CHtml::encode($data->name),array('view','id'=>$data->id)); ?></b>

    <div class="pull-right">
        <?php $this->widget('bootstrap.widgets.TbBadge', array(
            'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
            'label' => CHtml::encode($data->type->name),
        )); ?>
        <?php $this->widget('bootstrap.widgets.TbBadge', array(
            'type' => 'info', // 'success', 'warning', 'important', 'info' or 'inverse'
            'label' => CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)),
        )); ?>
    </div>

    <?php if (!empty($data->description)): ?>
        <p><?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?></p>
    <?php endif; ?>
</div>
