<?php 
$title='';
if($data->title_cn!=''){
    $title=$data->title_cn;
}elseif($data->title_en!=''){
    $title=$data->title_en;
}else{
    $title=$data->title_local;
}
?>
<tr>
    <td><b><?php echo CHtml::link($title, array('/position/view', 'id'=>$data->id)); ?></b></td>
    <td>
        <?php echo CHtml::link('详细',array('/position/view','id'=>$data->id));?>
        <?php echo CHtml::link('编辑',array('position/update','id'=>$data->id));?>
        <?php $this->renderPartial('/common/manageBar',array('table'=>'position','keyid'=>$data->id,'status'=>$data->status));?>
    </td>
</tr>