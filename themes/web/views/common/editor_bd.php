<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.config.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.all.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/lang/zh-cn/zh-cn.js', CClientScript::POS_END);
?>
<textarea id="<?php echo CHtml::activeId($model,'content');?>" name="<?php echo CHtml::activeName($model,'content');?>">
fgfgfg
</textarea>
<script>
    $("document").ready(function(){
        var ue = UE.getEditor("<?php echo CHtml::activeId($model,'content');?>",{
            toolbar: ["bold","italic","underline","link","unlink","image","source","paragraph","insertcode"],
            initialStyle:".edui-editor-body .edui-body-container p{font-size:13px;line-height:1.3em;}.edui-container .edui-toolbar{z-index:0 !important}",
            textarea:"<?php echo CHtml::activeName($model,'content');?>"
        });
    })
</script>
