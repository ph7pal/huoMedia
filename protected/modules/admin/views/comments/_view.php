<div class="view">
<?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?>：<?php echo tools::formatTime($data->cTime); ?><br />
评论了：<br/>
<?php echo zmf::filterOutput($data['content'],true); ?>
</div>
<div class="manage-bar">
    <?php $this->renderPartial('/common/manageBar',array('table'=>'comments','keyid'=>$data->id,'status'=>$data->status));?>
</div>