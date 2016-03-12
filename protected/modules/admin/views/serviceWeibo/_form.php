<?php
/**
 * @filename ServiceWeiboController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:02 */
?>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'service-weibo-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php echo $form->errorSummary($model); ?>
    <div class="form-group">
        <?php echo $form->labelEx($model,'classify'); ?>
        <?php echo $form->dropDownList($model,'classify',  Tags::getClassifyTags('weiboClassify'),array('class'=>'form-control','empty'=>'--请选择--')); ?>
        <?php echo $form->error($model,'classify'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'nickname'); ?>
        <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'nickname'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'url'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'favors'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'favors',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">人</span>
        </div>
        <?php echo $form->error($model,'favors'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'shenfen'); ?>
        <?php echo $form->textField($model,'shenfen',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'shenfen'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'area'); ?>
        <?php $this->renderPartial('/content/_area',array('model'=>$model,'extraCss'=>'btn-block'));?>
        <?php echo $form->hiddenField($model,'area',array('class'=>'form-control')); ?>
        <?php echo $form->error($model,'area'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'ptzhuanfa'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'ptzhuanfa',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'ptzhuanfa'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'ptzhifa'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'ptzhifa',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'ptzhifa'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'ygzhuanfa'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'ygzhuanfa',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'ygzhuanfa'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'ygzhifa'); ?>
        <div class="input-group">
            <?php echo $form->textField($model,'ygzhifa',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
            <span class="input-group-addon">元</span>
        </div>
        <?php echo $form->error($model,'ygzhifa'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'desc'); ?>
        <?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'desc'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model,'postscript'); ?>
        <?php echo $form->textField($model,'postscript',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
        <?php echo $form->error($model,'postscript'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton($model->isNewRecord ? '新增' : '更新',array('class'=>'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->