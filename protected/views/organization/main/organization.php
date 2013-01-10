<?php echo CHtml::link(CHtml::encode($data->name),array('organization/view', 'id'=> $data->id)); ?>

<div class="pull-right">
    (<?php echo CHtml::encode($data->type->name); ?>)
    (<?php echo CHtml::encode(Lookup::item('OrganizationActionArea',$data->action_area)); ?>)
</div>

<?php if (!empty($data->description)): ?>
    <p><?php echo mb_substr(CHtml::encode(strip_tags($data->description)), 0, 300, 'UTF-8'), '...'; ?></p>
<?php endif; ?>

<hr>
