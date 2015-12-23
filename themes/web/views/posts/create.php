<?php

/**
 * @filename create.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2015-12-18  16:36:08 
 */
?>
<style>
    .add-post-form{
        width: 640px;
        margin: 50px auto 0;
        padding: 0 10px
    }
</style>
<?php $uploadurl=Yii::app()->createUrl('attachments/upload',array('type'=>'posts','imgsize'=>600));?>
<div class="add-post-form">
    <?php $form=$this->beginWidget('CActiveForm', array(
            'id'=>'posts-form',
            'enableAjaxValidation'=>false,
    )); ?>
            <?php echo $form->errorSummary($model); ?>
            <div class="form-group">
                <?php echo $form->labelEx($model,'title'); ?>
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control')); ?>
                <?php echo $form->error($model,'title'); ?>
            </div>
            <div class="form-group">
                <?php echo $form->labelEx($model,'content'); ?>
                <?php //$this->renderPartial('/common/editor_bd', array('model' => $model,'content' => $model->content,'uploadurl'=>$uploadurl)); ?>
                <?php $this->renderPartial('/common/editor_medium', array('model' => $model,'content' => $model->content)); ?>
                <?php echo $form->error($model,'content'); ?>
            </div>
            <div class="form-group">
                    <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '更新',array('class'=>'btn btn-success pull-right','id'=>'editorSubmit')); ?>
            </div>
    <?php $this->endWidget(); ?>
</div><!-- form -->
