<?php
/* @var $this ServiceBlogsController */
/* @var $model ServiceBlogs */
/* @var $form CActiveForm */
?>

<div class="form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-blogs-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>
	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
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
	</div>
	<div class="form-group">
            <?php echo $form->labelEx($model,'level',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->dropDownList($model,'level',  ServiceBlogs::level('admin'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
		<?php echo $form->error($model,'level'); ?>
            </div>
	</div>
	<div class="form-group">
            <?php echo $form->labelEx($model,'area',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php $this->renderPartial('/content/_area',array('model'=>$model));?>
                <?php echo $form->hiddenField($model,'area',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'area'); ?>
            </div>
	</div>
        <div class="form-group">
            <?php echo $form->labelEx($model,'nickname',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'nickname'); ?>
            </div>
		
	</div>    
	<div class="form-group">
            <?php echo $form->labelEx($model,'url',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
            </div>
		
	</div>
	<div class="form-group">
            <?php echo $form->labelEx($model,'hits',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'hits',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'hits'); ?>
            </div>		
	</div>
	<div class="form-group">
            <?php echo $form->labelEx($model,'price',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'price'); ?>
            </div>		
	</div>

	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
            </div>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->