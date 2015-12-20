<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.config.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.all.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/lang/zh-cn/zh-cn.js', CClientScript::POS_END);
?>
<script id="<?php echo CHtml::activeId($model,'content');?>" name="<?php echo CHtml::activeName($model,'content');?>" type="text/plain"><?php echo $model->content;?></script>
<script>
    $("document").ready(function(){
        var ue = UE.getEditor('<?php echo CHtml::activeId($model,'content');?>', {
            autoHeight: false
        });
    })
</script>