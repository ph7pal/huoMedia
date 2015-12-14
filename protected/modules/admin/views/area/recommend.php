<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'recommend-area-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php foreach($areas as $area){?>
<h2><?php echo $area['title'];?></h2>
<?php $preOrder=$area['children'][1]['theorder'];foreach($area['children'] as $k=>$one){if($k==0){continue;}?>
<div class="col-xs-2 col-sm-2 no-padding">
    <label><h5><?php echo CHtml::checkBox('selected[]',($one['hot']?'checked':'') ,array('value'=>$one['id']));?> <?php echo $one['title'];?></h5></label>
</div>
<?php if($one['theorder']!=$preOrder){?>
<div class="clearfix"></div>
<hr/>
<?php }$preOrder=$one['theorder'];?>
<?php }?>
<div class="clearfix"></div>
<hr/>
<?php }?>
<div class="form-group">
    <?php echo CHtml::submitButton('提交', array('class'=>'btn btn-success'));?>
</div>
<?php $this->endWidget(); ?>