<?php
/**
 * @filename editor_boot.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2015-12-28  16:01:47 
 */
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/web-bootstrap.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/jquery.hotkeys.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/bootstrap-wysiwyg.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/common/uploadify/jquery.uploadify.min.js', CClientScript::POS_END);
?>
<style>
    #editor {
        max-height: 250px;
        height: 250px;
        background-color: white;
        border-collapse: separate; 
        border: 1px solid rgb(204, 204, 204); 
        padding: 4px; 
        box-sizing: content-box; 
        -webkit-box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset; 
        box-shadow: rgba(0, 0, 0, 0.0745098) 0px 1px 1px 0px inset;
        border-top-right-radius: 3px; border-bottom-right-radius: 3px;
        border-bottom-left-radius: 3px; border-top-left-radius: 3px;
        overflow: scroll;
        outline: none;
    }
    #voiceBtn {
        width: 20px;
        color: transparent;
        background-color: transparent;
        transform: scale(2.0, 2.0);
        -webkit-transform: scale(2.0, 2.0);
        -moz-transform: scale(2.0, 2.0);
        border: transparent;
        cursor: pointer;
        box-shadow: none;
        -webkit-box-shadow: none;
    }

    div[data-role="editor-toolbar"] {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }

    .dropdown-menu a {
        cursor: pointer;
    }
    .uploadify-button{
        padding: 5px 0;
        border: none;
        line-height: 25px
    }
</style>
<script>
    $("document").ready(function () {
        var editor=$('#editor').wysiwyg();
        
        singleUploadify({
            placeHolder:'uploadFiles',
            limit:<?php echo isset($num) ? $num : 30; ?>,
            uploadUrl:"http://upload.qiniu.com/",
            type:'posts',
            height:32,
            width:32,
            buttonText:'<i class="fa fa-image"></i>'
        });
    })
</script>
<div class="btn-toolbar" data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="" data-original-title="Bold (Ctrl/Cmd+B)"><i class="fa fa-bold"></i></a>
        <a class="btn" data-edit="italic" title="" data-original-title="Italic (Ctrl/Cmd+I)"><i class="fa fa-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="" data-original-title="Strikethrough"><i class="fa fa-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="" data-original-title="Underline (Ctrl/Cmd+U)"><i class="fa fa-underline"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="" data-original-title="Bullet list"><i class="fa fa-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="" data-original-title="Number list"><i class="fa fa-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="" data-original-title="Reduce indent (Shift+Tab)"><i class="fa fa-indent"></i></a>
        <a class="btn" data-edit="indent" title="" data-original-title="Indent (Tab)"><i class="fa fa-outdent"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn btn-info" data-edit="justifyleft" title="" data-original-title="Align Left (Ctrl/Cmd+L)"><i class="fa fa-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="" data-original-title="Center (Ctrl/Cmd+E)"><i class="fa fa-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="" data-original-title="Align Right (Ctrl/Cmd+R)"><i class="fa fa-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="" data-original-title="Justify (Ctrl/Cmd+J)"><i class="fa fa-align-justify"></i></a>
      </div>      
      <div class="btn-group">
          <span id="uploadFiles"></span>
      </div>   
    </div>
<div id="editor" contenteditable="true">
      Go ahead…
    </div>
