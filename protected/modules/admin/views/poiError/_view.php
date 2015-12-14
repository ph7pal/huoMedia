<?php
$info=$data->poiInfo;
$_title = '';
if ($info['title_cn'] != '') {
    $_title = $info['title_cn'];
} elseif ($info['title_en'] != '') {
    $_title = $info['title_en'];
} else {
    $_title = $info['title_local'];
}
?>

<div class="well well-sm" id="list-item-<?php echo $data->id;?>">
    <p>
        <b><?php echo $data->uid>0 ? CHtml::link($data->authorInfo->truename,array('users/view','id'=>$data->uid)) : '网友'; ?></b> <?php echo tools::formatTime($data->cTime); ?> 纠正 <?php echo CHtml::link($_title,array('position/view','id'=>$data->logid)); ?>：
        <span class="pull-right">
        <?php if($data->status==  Posts::STATUS_STAYCHECK){
         echo CHtml::ajaxLink(
         '同意纠错',
         Yii::app()->createUrl("admin/poiError/manage"),
         array(
             'type'=>'POST',
             'success' => "function( data ){data = eval('('+data+')');if(data['status']){ $('#list-item-".$data->id."').fadeOut();}else{alert(data['msg']);}}",
             'data'=>array('id'=>$data->id,'YII_CSRF_TOKEN'=>Yii::app()->request->csrfToken)
        ),
         array('href' => Yii::app()->createUrl( "admin/poiError/manage")));
        }else{echo '已同意';}?></span>
    </p>
    <p><b><?php echo CHtml::encode($data->getAttributeLabel('type')); ?>：</b><?php echo PoiError::types($data->type); ?></p>
    <p><?php echo CHtml::encode($data->content); ?></p>
</div>