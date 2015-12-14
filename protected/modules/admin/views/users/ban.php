<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ban-form',
)); ?>
<div class="alert alert-danger">
	禁止用户 - <?php echo $info->truename;?>
</div>
<p><b>当前状态</b>：<?php echo Users::userStatus($info->status);?>
    <?php echo CHtml::link('查看用户内容',array('/users/index','id'=>$info['id']),array('target'=>'_blank'));?></p>
<?php if(!empty($records)){?>
<div class="well well-sm">
<table class="table table-hover">
   <tr>
		<th width="25%">操作时间</th>
		<th width="25%">操作者</th>
		<th width="25%">操作</th>
		<th>原因</th>	
  </tr>
<?php foreach($records as $record){?>
	<tr>
		<td><?php echo tools::formatTime($record->cTime);?></td>
		<td><?php echo $record->authorInfo->truename;?></td>
		<td>置为<?php echo Users::userStatus($record->acvalue);?></td>
		<td><?php echo $record->desc;?></td>
	</tr>
<?php }?>
</table>
</div>
<?php }else{?>
<hr/>
<?php }?>
<p>	<b>禁止类型</b>：</p>
<?php echo CHtml::radioButtonList('ban[type]',$info->status,Users::userStatus());?>
<hr/>

<p><b>清空该用户相关内容</b>：</p>
<div class="checkbox"><label><input type="checkbox" class="checkall">全选</label></div>
<div class="chk_area row">
      <?php echo CHtml::checkBoxList('ban[contents][]','',Users::banTypes(),array('separator'=>'','template'=>'<div class="col-xs-2 col-sm-2 no-padding">{input} {label}</div>'));?>
 </div>

<hr/>
<p><b>理由</b>：</p>
<?php echo CHtml::textArea('ban[reason]','',array('class'=>'form-control'));?>

<hr/>
<div class="form-group">
		<?php echo CHtml::submitButton('更新',array('class'=>'btn btn-primary')); ?>
</div>
<?php $this->endWidget(); ?>