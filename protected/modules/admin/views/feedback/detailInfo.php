<div class="alert" id="item<?php echo $row->id;?>" style="clear:both">
    <p><b>内容：</b><span class="pull-right"><?php if($row['status']==Posts::STATUS_STAYCHECK){if($row['uid']>0 && $row['uid']!=Yii::app()->user->id){ echo CHtml::link('发消息','javascript:;',array('onclick'=>"addModal(".$row['uid'].",".$row['id'].")"));} echo '&nbsp;&nbsp;'.CHtml::ajaxLink(
         '标记为已处理',
         Yii::app()->createUrl("admin/feedback/manage"),
         array('type'=>'POST','success' => "function( data ){data = eval('('+data+')');if(data['status']){ $('#item".$row->id."').fadeOut();".($alert ? "alert(data['msg']);": '')."}else{alert(data['msg']);}}",
             'data'=>array('type'=>'del','feedid'=>$row->id,'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken)),array('href' => Yii::app()->createUrl("admin/feedback/manage")));}else{echo '已处理';}?></span><br/><?php echo nl2br($row->content);?></p>
    <p><b>来源：</b><?php echo $row->classify;?></p>
    <p><b>软件版本：</b><?php echo $row->appversion;?></p>
    <p><b>系统版本：</b><?php echo $row->os;?></p>
    <p><b>平台信息：</b><?php echo $row->platform;?></p>
    <p><b>联系页面：</b><?php echo $row->url;?></p>
    <p><b>联系方式：</b><?php if($row['uid']>0){ $uname=  Users::getUserInfo($row['uid'], 'truename');echo CHtml::link($uname,array('users/view','id'=>$row['uid']));?><?php }?><?php echo $row->email;?></p>
    <p><b>创建IP：</b><?php echo long2ip($row->ip);?></p>
    <p><b>创建时间：</b><?php echo tools::formatTime($row->cTime);?></p>
    <hr/>
</div>
