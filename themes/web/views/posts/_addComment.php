<div id="replyoneHolder-<?php echo $keyid;?>" class="replyoneHolder"></div>
<div class="form-group">    
    <?php echo CHtml::textArea('content-'.$type.'-'.$keyid,'',array('class'=>'form-control','action'=>'comment'));?>
</div>
<div class="form-group pull-right">
    <?php echo CHtml::link('评论','javascript:;',array('class'=>'btn btn-success','action'=>'add-comment','action-data'=>$keyid,'action-type'=>$type));?>
</div>
<div class="clearfix"></div>