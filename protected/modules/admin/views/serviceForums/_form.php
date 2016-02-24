<?php
/* @var $this ServiceForumsController */
/* @var $model ServiceForums */
/* @var $form CActiveForm */
?>

<div class="form-horizontal">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-forums-form',
	'enableAjaxValidation'=>false,
)); ?>
	<?php echo $form->errorSummary($model); ?>

	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
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
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'url',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
		<?php echo $form->error($model,'url'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forDigest',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forDigest',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forDigest'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forDay',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forDay',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forDay'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forWeek',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forWeek',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forWeek'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forTwoWeek',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forTwoWeek',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forTwoWeek'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forMonth',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forMonth',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forMonth'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forQuarter',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forQuarter',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forQuarter'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forHalfYear',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forHalfYear',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forHalfYear'); ?>
            </div>		
	</div>

	<div class="form-group">
            <?php echo $form->labelEx($model,'forYear',array('class'=>'col-sm-2 control-label')); ?>
            <div class="col-sm-10">
                <div class="input-group">
                    <?php echo $form->textField($model,'forYear',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                    <span class="input-group-addon">元</span>
                </div>
		<?php echo $form->error($model,'forYear'); ?>
            </div>
	</div>

	<div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
            </div>		
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->