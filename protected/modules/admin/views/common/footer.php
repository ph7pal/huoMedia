<?php assets::jsConfig('web','admin');?>
<script>
var setStatusUrl="<?php echo Yii::app()->createUrl('admin/ajax/setstatus');?>";
var changeOrderUrl="<?php echo Yii::app()->createUrl('admin/ajax/changeorder');?>";
var delTagNameUrl="<?php echo Yii::app()->createUrl('admin/ajax/deltag');?>";
var userGroupUrl="<?php echo Yii::app()->createUrl('admin/ajax/usergroup');?>";
var delAvatorUrl="<?php echo Yii::app()->createUrl('admin/ajax/delavator');?>";
var delUserUrl="<?php echo Yii::app()->createUrl('admin/ajax/deluser');?>";
function addTopArea(id,type){
    if(!id){
        alert('缺少参数');
        return false;
    }
    if(!type){
        type='addTop';
    }
      $.get('<?php echo Yii::app()->createUrl( "admin/area/manage");?>','type='+type+'&keyid='+id,function(result){
            result = eval('(' + result + ')');
            if(result['status']==0){
                alert(result['msg']);
                return false;
            }else if(result['status']==1){
                //window.location.reload();
                alert(result['msg']);
                return false;
            }
      });
}
</script>