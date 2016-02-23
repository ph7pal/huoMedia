<?php
/* @var $this ServiceForumsController */
/* @var $model ServiceForums */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-forums-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <div class="row">
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'classify'); ?>
                    <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('forumClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'classify'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'forumClassify'));?></p>
                </div>
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'forum'); ?>
                    <?php echo $form->dropDownList($model,'forum',  Tags::getClassifyTags('forumForum'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'forum'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'forumForum'));?></p>
                </div>
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'type'); ?>
                    <?php echo $form->dropDownList($model,'type',  Tags::getClassifyTags('forumType'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'type'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'forumType'));?></p>
                </div>
            </div>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forDigest'); ?>
		<?php echo $form->textField($model,'forDigest',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forDigest'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forDay'); ?>
		<?php echo $form->textField($model,'forDay',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forDay'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forWeek'); ?>
		<?php echo $form->textField($model,'forWeek',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forWeek'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forTwoWeek'); ?>
		<?php echo $form->textField($model,'forTwoWeek',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forTwoWeek'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forMonth'); ?>
		<?php echo $form->textField($model,'forMonth',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forMonth'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forQuarter'); ?>
		<?php echo $form->textField($model,'forQuarter',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forQuarter'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forHalfYear'); ?>
		<?php echo $form->textField($model,'forHalfYear',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forHalfYear'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'forYear'); ?>
		<?php echo $form->textField($model,'forYear',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'forYear'); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->