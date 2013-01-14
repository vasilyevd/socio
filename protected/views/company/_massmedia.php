<strong><?php echo CHtml::link(CHtml::encode($data->title),array('mmview','id'=>$data->id)); ?></strong>

<p><?php echo mb_substr(CHtml::encode(strip_tags($data->content)), 0, 300, 'UTF-8'), '...'; ?></p>
<hr>
