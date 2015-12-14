<?php 
$url=  Attachments::getUrl($data);
?>
<div class="col-sm-3 col-md-3">
    <div class="thumbnail">
      <?php echo "<img src='{$url}' class='img-responsive'/>";?>
      <div class="caption">
        <p><?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?></p>
        <p>上传于：<?php echo tools::formatTime($data->cTime); ?></p>
        <p><?php $this->renderPartial('/common/manageBar',array('table'=>'attachments','keyid'=>$data->id,'status'=>$data->status));?></p>
      </div>
    </div>
  </div>