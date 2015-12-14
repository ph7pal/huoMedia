<div class="alert" id="item<?php echo $row->id;?>" style="clear:both">
 <p><span style="float:left;">举报理由：</span><div style="margin-left:58px;"><?php echo $row->desc;?></div><div class="clear"></div></p>
 <p>链接地址：<a href="<?php echo $row->url;?>" target="_blank"><?php echo $row->url;?></a></p>
<?php
if ($row->classify == 'posts') {
    $url = '【文章】' . CHtml::link($row->logid, array('posts/view','id' => $row->logid));
} elseif ($row->classify == 'poipost') {
    $table = 'comment';
    $url = '【点评】' . CHtml::link($row->logid, array('poiPost/view','id' => $row->logid));
} elseif ($row->classify == 'poitips') {
    $table = 'attachment';
    $url = '【短评】' . CHtml::link($row->logid, array('poiTips/view', 'id' => $row->logid));
} elseif ($row->classify == 'comments') {
    $table = 'attachment';
    $url = '【评论】' . $row->logid;    
} elseif ($row->classify == 'answer') {
    $table = 'attachment';
    $url =  CHtml::link('【回答】' .$row->logid, array('answer/view',  'id' => $row->logid));
} elseif ($row->classify == 'question') {
    $table = 'attachment';
    $url =  CHtml::link('【问题】' .$row->logid, array('question/view', 'id' => $row->logid));
} else {
    $url = $row->classify;
}
?>
<p>类型：<?php echo $url;?></p>
<p>举报人：<?php echo CHtml::link($row->authorInfo->truename,array('users/view','id'=>$row->uid));?></p>
<p>所在IP：<?php echo long2ip($row->ip);?></p>
<p>举报时间：<?php echo tools::formatTime($row->cTime);?></p>
<div class="">  
    <?php
foreach($manageArr as $ma){
echo CHtml::ajaxLink($ma['title'],Yii::app()->createUrl('admin/reports/manage'),array('type'=>'POST','success' => "function( data ){data = eval('('+data+')');if(data['status']){ $('#item".$row->id."').fadeOut();}else{alert(data['msg']);}}",'data'=>array('type'=>$ma['type'],'reportid'=>$row->id)),array('href' => Yii::app()->createUrl( 'admin/reports/manage'))).'&nbsp;&nbsp;';
    }
    ?>
</div>
</div>