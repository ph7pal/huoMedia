<?php
/**
 * @filename ServiceWeiboController.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2016 阿年飞少 
 * @datetime 2016-03-12 14:53:02 */
?>

<div class="wide form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'action'=>Yii::app()->createUrl($this->route),
    'method'=>'get',
)); ?>
    <div class="form-group">
        <?php echo $form->label($model,'id'); ?>
        <?php echo $form->textField($model,'id',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'uid'); ?>
        <?php echo $form->textField($model,'uid',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'classify'); ?>
        <?php echo $form->textField($model,'classify',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'nickname'); ?>
        <?php echo $form->textField($model,'nickname',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'url'); ?>
        <?php echo $form->textField($model,'url',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'favors'); ?>
        <?php echo $form->textField($model,'favors',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'shenfen'); ?>
        <?php echo $form->textField($model,'shenfen',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'area'); ?>
        <?php echo $form->textField($model,'area',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'location'); ?>
        <?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'sex'); ?>
        <?php echo $form->textField($model,'sex'); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'ptzhuanfa'); ?>
        <?php echo $form->textField($model,'ptzhuanfa',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'ptzhifa'); ?>
        <?php echo $form->textField($model,'ptzhifa',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'ygzhuanfa'); ?>
        <?php echo $form->textField($model,'ygzhuanfa',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'ygzhifa'); ?>
        <?php echo $form->textField($model,'ygzhifa',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'desc'); ?>
        <?php echo $form->textField($model,'desc',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'postscript'); ?>
        <?php echo $form->textField($model,'postscript',array('size'=>60,'maxlength'=>255)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'cTime'); ?>
        <?php echo $form->textField($model,'cTime',array('size'=>10,'maxlength'=>10)); ?>
    </div>
    <div class="form-group">
        <?php echo $form->label($model,'status'); ?>
        <?php echo $form->textField($model,'status'); ?>
    </div>
    <div class="form-group">
        <?php echo CHtml::submitButton('搜索',array('class'=>'btn btn-primary')); ?>
    </div>
<?php $this->endWidget(); ?>
</div><!-- search-form -->