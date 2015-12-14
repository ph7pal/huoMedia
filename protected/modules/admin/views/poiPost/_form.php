<?php
/* @var $this PoiPostController */
/* @var $model PoiPost */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'poi-post-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'uid'); ?>
		<?php echo $form->textField($model,'uid',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'uid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'logid'); ?>
		<?php echo $form->textField($model,'logid',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'logid'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->textField($model,'classify',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'content'); ?>
		<?php echo $form->textArea($model,'content',array('rows'=>6, 'cols'=>50,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'score'); ?>
		<?php echo $form->textField($model,'score',array('size'=>6,'maxlength'=>6,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'score'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cost'); ?>
		<?php echo $form->textField($model,'cost',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cost'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'favor'); ?>
		<?php echo $form->textField($model,'favor',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'favor'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nouse'); ?>
		<?php echo $form->textField($model,'nouse',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nouse'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'platform'); ?>
		<?php echo $form->textField($model,'platform',array('size'=>16,'maxlength'=>16,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'platform'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hits'); ?>
		<?php echo $form->textField($model,'hits',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'hits'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cTime'); ?>
		<?php echo $form->textField($model,'cTime',array('size'=>11,'maxlength'=>11,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'cTime'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'comments'); ?>
		<?php echo $form->textField($model,'comments',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'comments'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'lastupdate'); ?>
		<?php echo $form->textField($model,'lastupdate',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'lastupdate'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->