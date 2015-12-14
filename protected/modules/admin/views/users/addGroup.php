<fieldset>
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-group-addGroup-form',
	'enableAjaxValidation'=>true,
)); ?>
<table>	
	<?php echo $form->errorSummary($model); ?>
	<?php echo $form->hiddenField($model,'id'); ?>
        <tr>
            <td class="post_title"><?php echo $form->labelEx($model,'title'); ?></td><td>&nbsp;</td>
        </tr>
        <tr>
            <td><?php echo $form->textField($model,'title',array('class'=>'form-control')); ?></td><td><?php echo $form->error($model,'title'); ?></td>
        </tr>
  </table>
    <label>用户组操作权限</label>
   <ul class="list-group">
        <?php $powers=GroupPowers::getDesc('super');foreach($powers as $key=>$val){
            echo "<li style='color:red' class='list-group-item'><span>{$val['desc']}</span></li>";
            foreach($val['detail'] as $k=>$v){
               echo "<li class='list-group-item'><label class='checkbox-inline'><span>&nbsp;&nbsp;<input type='checkbox' name='powers[]' value='{$k}'";
               if(in_array('all',$mine)){
                   echo "checked='checked'";
                }elseif(in_array($k,$mine)){
                   echo "checked='checked'"; 
                }
               echo "/>{$v}</label></li>";  
            }
        }?>
    </ul> 
    <label>用户组发布内容数量权限</label>
    <?php $this->renderPartial('/userPower/_form',array('model'=>$upmodel,'form'=>$form));?>
    <?php echo CHtml::submitButton('提交',array('class'=>'btn btn-primary')); ?> 
<?php $this->endWidget(); ?>
</div><!-- form -->
</fieldset>