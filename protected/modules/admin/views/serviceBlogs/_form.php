<?php
/* @var $this ServiceBlogsController */
/* @var $model ServiceBlogs */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-blogs-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <div class="row">
                <div class="col-xs-6 col-sm-6">
                    <?php echo $form->labelEx($model,'type'); ?>
                    <?php echo $form->dropDownList($model,'type',  Tags::getClassifyTags('blogType'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'type'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'blogType'));?></p>
                </div>
                <div class="col-xs-6 col-sm-6">
                    <?php echo $form->labelEx($model,'classify'); ?>
                    <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('blogClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>		
                    <?php echo $form->error($model,'classify'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'blogClassify'));?></p>
                </div>
            </div>		
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'level'); ?>
		<?php echo $form->dropDownList($model,'level',  ServiceBlogs::level('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'level'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'area'); ?>
		<?php echo $form->textField($model,'area',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'area'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'hits'); ?>
		<?php echo $form->textField($model,'hits',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'hits'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->