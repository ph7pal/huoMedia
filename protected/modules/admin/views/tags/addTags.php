<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ads-addAuthor-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// See class documentation of CActiveForm for details on this,
	// you need to use the performAjaxValidation()-method described there.
	'enableAjaxValidation'=>true,
)); ?>
 <?php echo $form->errorSummary($model); ?>
<?php echo $form->hiddenField($model,'id',array('value'=>$info['id'])); ?>
<div class="form-group">
    <?php echo $form->labelEx($model,'title'); ?>
    <?php echo $form->textField($model,'title',array('class'=>'form-control','value'=>$info['title'])); ?>
     <p class="help-block"><?php echo $form->error($model,'title'); ?></p>
</div>
<div class="form-group">
    <?php echo $form->labelEx($model,'classify'); ?>
    <?php echo $form->dropDownList($model,'classify',Tags::classify(),array('class'=>'form-control','options' => array($info['classify']=>array('selected'=>true)))); ?>
     <p class="help-block"><?php echo $form->error($model,'classify'); ?></p>
</div>  
<?php echo CHtml::submitButton('提交',array('class'=>'btn btn-default')); ?>
       
<?php $this->endWidget(); ?>
</div><!-- form -->