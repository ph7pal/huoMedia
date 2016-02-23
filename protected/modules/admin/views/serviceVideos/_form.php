<?php
/* @var $this ServiceVideosController */
/* @var $model ServiceVideos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-videos-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <div class="row">
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'type'); ?>
                    <?php echo $form->dropDownList($model,'type',  Tags::getClassifyTags('videoType'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'type'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'videoPosition'));?></p>
                </div>
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'classify'); ?>
                    <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('videoClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'classify'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'videoPosition'));?></p>
                </div>
                <div class="col-xs-4 col-sm-4">
                    <?php echo $form->labelEx($model,'position'); ?>
                    <?php echo $form->dropDownList($model,'position',  Tags::getClassifyTags('videoPosition'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
                    <?php echo $form->error($model,'position'); ?>
                    <p class="help-block"><?php echo CHtml::link('点此新增',array('tags/create','classify'=>'videoPosition'));?></p>
                </div>
            </div>		
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'url'); ?>
		<?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'stayTime'); ?>
		<?php echo $form->textField($model,'stayTime',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'stayTime'); ?>
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