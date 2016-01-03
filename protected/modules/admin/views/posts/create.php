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
    .tags-holder{
        background: #fff;
        padding: 10px 5px;
        border:1px solid #ccc
    }
    .tags-holder .tag-item{
        margin-right: 5px;
        word-break: keep-all;
        display: inline-block;
        padding: 2px 5px;
        margin-bottom: 10px;
        border: 1px solid #fff
    }
    .tags-holder .tag-item a{
        text-decoration: none;
        color: #333
    }
    .tags-holder .tag-item i{
        color: #fff
    }
    .tags-holder .tag-item:hover{
        border: 1px solid green
    }
    .tags-holder .tag-item:hover>a>i{
        color: #333
    }
    .tags-holder .active{
        background: green;        
    }
    .tags-holder .active a{
        color: #fff
    }
    .tags-holder .active:hover>a>i{
        color: #fff
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
                <?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255,'class'=>'form-control','placeholder'=>'文章标题')); ?>
            </div>
            <div class="form-group">
                <?php $this->renderPartial('/common/editor_um', array('model' => $model,'content' => $model->content,'uploadurl'=>$uploadurl)); ?>
                <?php //$this->renderPartial('/common/editor_medium', array('model' => $model,'content' => $model->content)); ?>                
                <?php //$this->renderPartial('/common/editor_boot', array('model' => $model,'content' => $model->content)); ?>                
            </div>
    <div class="tags-holder">
        <?php foreach ($tags as $tagid=>$tagname){?>
        <span class="tag-item">
            <?php echo CHtml::link($tagname.' <i class="fa fa-check"></i>','javascript:;',array('action'=>'select-tag','action-data'=>$tagid));?>
        </span>
        
        
        <?php }?>
    </div>
            <div class="form-group">
                    <?php echo CHtml::submitButton($model->isNewRecord ? '提交' : '更新',array('class'=>'btn btn-success pull-right','id'=>'editorSubmit')); ?>
            </div>
    <?php $this->endWidget(); ?>
    
</div><!-- form -->
