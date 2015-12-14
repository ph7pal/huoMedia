<div class="view">
<?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid));?>：<?php echo tools::formatTime($data->cTime); ?><br />
<b>问题：</b><?php echo CHtml::link($data->title,array('/question/view','id'=>$data->id)); ?><br />
<b>描述：</b><?php echo zmf::text(array(), $data['content'],false,170);?>
</div>
<div class="manage-bar">
    <?php echo CHtml::link('编辑',array('/question/create', 'id'=>$data->id));?>
    <?php $this->renderPartial('/common/manageBar',array('table'=>'question','keyid'=>$data->id,'status'=>$data->status));?>
</div>