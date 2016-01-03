<script>
    URL= window.UEDITOR_HOME_URL||"<?php echo Yii::app()->baseUrl;?>/ueditor/";
    (function(){window.UEDITOR_CONFIG={
            UEDITOR_HOME_URL:URL
            ,lang:"zh-cn"
            , toolbars: [["bold","italic","underline","link","unlink"]]
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
<style>
    #editor-extra-btns{
        position: absolute;
        left: 50%;
        top: 100px;
        width: auto;
        height: 32px;
        margin-left: -352px;/*320+32*/
        font-size: 18px;
        line-height: 32px;
        display: none
    }
    #editor-extra-btns .toggle-funcs-btn{
        padding: 0 10px;
    }
    #editor-extra-btns .func-btn{
        margin-right: 5px;
        display: none
    }
    #editor-extra-btns a{
        text-decoration: none
    }
    #editor-extra-btns a:hover{
        text-decoration: none
    }
    .toggle-funcs-btn-rotate{
        -webkit-transition: -webkit-transform 250ms;
        transition: transform 250ms;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    #upload-file{
        display:none
    }
    .editable{
        min-height: 300px
    }
</style>
<?php
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl.'/ueditor/ueditor.all.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl.'/ueditor/lang/zh-cn/zh-cn.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/jquery.caret.min.js', CClientScript::POS_END);
?>
<div id="test"></div>
<textarea id="<?php echo CHtml::activeId($model,'content');?>" name="<?php echo CHtml::activeName($model,'content');?>"><?php echo $model->content;?></textarea>
<div id="editor-extra-btns">
    <i class="fa fa-plus-circle toggle-funcs-btn"></i>
    <a href="javascript:;" onclick="$('#upload-file').click();"><i class="fa fa-image func-btn"></i></a>
    <a href="javascript:;"><i class="fa fa-video-camera func-btn"></i></a>
    <a href="javascript:;"><i class="fa fa-table func-btn"></i></a>
    <input type="file" name="filedata" id="upload-file" onchange="ajaxFileUpload()"/>
</div>
<script>
    function showBtns(action){
        var btndom=$('#editor-extra-btns');
        if(action=='hide'){
            btndom.fadeOut(300);
        }else{
            var holderPos=$('#<?php echo CHtml::activeId($model,'content');?>').offset();   
            console.log(holderPos);
            
            ifr = $('#ueditor_0')[0];
       $ckBody = $('body', ifr.contentDocument);
       $ckBody.on('keyup mouseup', function() {
         var pos = $ckBody.caret('position');
         console.log(pos);
         btndom.css('top',pos.top+holderPos.top-8);
            btndom.fadeIn(300);
       });
            
//            var pos=$($('#ueditor_0')[0]).caret('position', {iframe: $('#ueditor_0')[0]}); 
//            console.log(pos);
            
        }
    }
    $("document").ready(function(){
        var ueditor = UE.getEditor('<?php echo CHtml::activeId($model,'content');?>');
        ueditor.addListener("focus",function(){
            showBtns();
        });
        ueditor.addListener("keyup",function(){
            showBtns();
            //var location = UE.dom.domUtils.getXY( document.getElementById("test") );
            
        });
        $('.toggle-funcs-btn').unbind('click').click(function(){
            var dom=$(this);
            if(dom.hasClass('toggle-funcs-btn-rotate')){
                dom.removeClass('toggle-funcs-btn-rotate');
                $('.func-btn').each(function(){
                    $(this).fadeOut(500);
                });
            }else{
                dom.addClass('toggle-funcs-btn-rotate');
                $('.func-btn').each(function(){
                    $(this).fadeIn(500);
                });
            }            
        });
    })
</script>