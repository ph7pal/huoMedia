<?php 
$title='';
$_poiInfo=$data->poiInfo;
if($_poiInfo->title_cn!=''){
    $title=$_poiInfo->title_cn;
}elseif($_poiInfo->title_en!=''){
    $title=$_poiInfo->title_en;
}else{
    $title=$_poiInfo->title_local;
}
?>
<div class="view">
    <?php echo CHtml::link(CHtml::encode($data->authorInfo->truename),array('users/view','id'=>$data->uid)); ?>：<?php echo tools::formatTime($data->cTime); ?><br />
    <p><b>点评：</b><?php echo CHtml::link($title,array('/position/view','id'=>$data->logid));?></p>
    <?php echo zmf::text(array(), $data['content'],false,170);?>
</div>
<div class="manage-bar">
    <?php echo CHtml::link('编辑',array('/poipost/create', 'id'=>$data->id));?>
    <?php $this->renderPartial('/common/manageBar',array('table'=>'poipost','keyid'=>$data->id,'status'=>$data->status));?>
</div>