<?php
/* @var $this TagsController */
/* @var $model Tags */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'tags-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
        <?php if(!$model->classify){?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'classify'); ?>
		<?php echo $form->dropDownList($model,'classify',  Tags::classify('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'classify'); ?>
	</div>
        <?php }if($model->classify=='forumType'){?>
        <div class="form-group">
		<?php echo $form->labelEx($model,'pid'); ?>
		<?php echo $form->dropDownList($model,'pid',$belongTags,array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'pid'); ?>
	</div>
        <?php }?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>        
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '保存',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->