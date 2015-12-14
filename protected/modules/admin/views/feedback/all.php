<ul class="nav nav-tabs" role="tablist">
    <li class="<?php echo !$_GET['type'] ? 'active':'';?>"><?php echo CHtml::link('未处理',array('index','type'=>'staycheck'));?></li>
    <li class="<?php echo $_GET['type']=='deled' ? 'active':'';?>"><?php echo CHtml::link('已处理',array('index','type'=>'deled'));?></li>
</ul>
<?php if(empty($posts)){?>
<div class='flash-error'> 
    暂无内容。
</div>
<?php }else{?>
<?php foreach($posts as $row):?> 
<?php $this->renderPartial('detailInfo',array('row'=>$row));?>
 <?php endforeach;?>
<?php $this->renderPartial('//common/pager',array('pages'=>$pages));?>
<?php }?>
<script>

function addModal(toid,keyid){
  var html='<div class="form-group"><textarea id="content" touid='+toid+' class="form-control" rows="5"></textarea></div>';
  dialog({msg:html,title:'发送消息',action:'addMsg'});
  $("button[action='addMsg']").click(function(){addNotice(toid,keyid)});
}  
function addNotice(touid,keyid){
    var content=$('#content').val();
    if(!touid){
        alert('数据不全');
        return false;
    }
    if(!content){
        alert('请输入对话内容');
        return false;
    }
  $.ajax({
        type: "POST",
        url: '<?php echo Yii::app()->createUrl('admin/feedback/addnotice');?>',
        data: "touid=" + touid + '&content='+content+'&keyid='+keyid ,
        beforeSend: function() {
            
        },
        success: function(result) {
            result = eval('(' + result + ')');
            if (result['status'] == 1) {
                 $('#item'+keyid).fadeOut();
                 closeDialog();
            } else {
               alert(result['msg']);
               closeDialog();
            }
        }
    });
}  
</script>