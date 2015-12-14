<div class="view">
<?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?>：<?php echo tools::formatTime($data->cTime); ?><br />
回答：<?php echo CHtml::link(CHtml::encode($data->questionInfo->title),array('/question/view','id'=>$data->logid)); ?><br/>
<?php echo zmf::text(array(), $data['content'],false,170);?>
</div>
<div class="manage-bar">
    <?php echo CHtml::link('编辑',array('/question/reply', 'id'=>$data->logid,'aid'=>$data->id));?>
    <?php $this->renderPartial('/common/manageBar',array('table'=>'answer','keyid'=>$data->id,'status'=>$data->status));?>
</div>