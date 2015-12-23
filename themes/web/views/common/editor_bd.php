<script>
    URL= window.UEDITOR_HOME_URL||"<?php echo Yii::app()->baseUrl;?>/ueditor/";
    (function(){window.UEDITOR_CONFIG={
            UEDITOR_HOME_URL:URL
            ,lang:"zh-cn"
            , toolbars: [["bold","italic","underline","link","unlink","simpleupload"]]
            ,initialFrameHeight:320
            ,elementPathEnabled : false
            ,wordCount:false
            ,autoHeight: false
            ,enableContextMenu: false
            ,focus:false
            ,pasteplain:true
            ,textarea:'<?php echo CHtml::activeName($model,'content');?>'
            ,serverUrl: "<?php echo zmf::config('domain').Yii::app()->createUrl('attachments/upload');?>"
        }})();
</script>
<?php
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.all.min.js', CClientScript::POS_END);
Yii::app()->clientScript->registerScriptFile(Yii::app()->baseUrl.'/ueditor/lang/zh-cn/zh-cn.js', CClientScript::POS_END);
?>
<script id="<?php echo CHtml::activeId($model,'content');?>" name="<?php echo CHtml::activeName($model,'content');?>" type="text/plain"><?php echo $model->content;?></script>
<script>
    $("document").ready(function(){
        var ue = UE.getEditor('<?php echo CHtml::activeId($model,'content');?>');
    })
</script>