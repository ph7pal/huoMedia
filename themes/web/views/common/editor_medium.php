<?php
/**
 * @filename editor_medium.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2015-12-23  15:46:51 
 */
$cs = Yii::app()->clientScript;
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/ajaxfileupload.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/jsCssSrc/js/jquery.caret.min.js', CClientScript::POS_END);
$cs->registerScriptFile(Yii::app()->baseUrl . '/medium/js/medium-editor.min.js', CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->baseUrl . '/medium/ext/dist/js/medium-editor-insert-plugin.min.js', CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/medium-editor.min.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/themes/bootstrap.min.css');
?>
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
<div class="editable" id="content-textarea"></div>
<div id="editor-extra-btns">
    <i class="fa fa-plus-circle toggle-funcs-btn"></i>
    <a href="javascript:;" onclick="$('#upload-file').click();"><i class="fa fa-image func-btn"></i></a>
    <a href="javascript:;"><i class="fa fa-video-camera func-btn"></i></a>
    <a href="javascript:;"><i class="fa fa-table func-btn"></i></a>
    <input type="file" name="upload-file" id="upload-file" onchange="ajaxFileUpload()"/>
</div>
<script>
    function ajaxFileUpload() {
        $.ajaxFileUpload({
            url: '<?php echo Yii::app()->createUrl('attachments/upload', array()); ?>',
            fileElementId: 'upload-file',
            type: 'post',
            multi: true,
            data: {'PHPSESSID': '<?php echo Yii::app()->session->sessionID; ?>', 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            dataType: 'json',
            success: function (res) {

            }
        })
    }    
    function showBtns(action){
        var btndom=$('#editor-extra-btns');
        if(action=='hide'){
            btndom.fadeOut(300);
        }else{
            var holderPos=$('#content-textarea').offset();        
            var pos=$('.editable').caret('position');            
            btndom.css('top',pos.top+holderPos.top-8);
            btndom.fadeIn(300);
        }
    }
    $("document").ready(function () {        
        var HighlighterButton = MediumEditor.Extension.extend({
            name: 'highlighter',
            init: function () {
                this.button = this.document.createElement('button');
                this.button.classList.add('medium-editor-action');
                this.button.innerHTML = '<div style="position:relative"></div>';
                this.button.title = 'Highlight';

                this.on(this.button, 'click', this.handleClick.bind(this));
            },
            getButton: function () {
                return this.button;
            },
            handleClick: function (event) {
                //this.classApplier.toggleSelection();
                //alert('my func');
            }
        });

        var editor = new MediumEditor('.editable', {
            autoLink: true,
            imageDragging: true,
            buttonLabels: 'fontawesome',
            toolbar: {
                buttons: [
                    {
                        name: 'bold',
                        aria: '加粗'
                    },
                    {
                        name: 'italic',
                        aria: '斜体'
                    },
                    {
                        name: 'underline',
                        aria: '下划线'
                    },
                    {
                        name: 'anchor',
                        aria: '加链接'
                    },
                    {
                        name: 'h1',
                        aria: 'H1'
                    },
                    {
                        name: 'h2',
                        aria: 'H2'
                    },
                    {
                        name: 'quote',
                        aria: '引用'
                    },
                    {
                        name: 'removeFormat',
                        aria: '清除样式'
                    },
                    'highlighter'
                ]
            },
            placeholder: {
                text: '这里输入内容'
            },
            paste: {
                forcePlainText: true,
                cleanAttrs: ['style', 'dir'],
                cleanTags: ['label', 'meta']
            },
            anchorPreview: {
                hideDelay: 300
            },
            keyboardCommands: {
                commands: [
                    {
                        command: 'highlighter',
                        key: '0',
                        meta: true,
                        shift: true,
                        alt: true
                    }
                ],
            },
            extensions: {
                'highlighter': new HighlighterButton()
            }
        });
        
        
        editor.subscribe('editableInput', function (event, editable) {
            showBtns();            
            //editor.getFocusedElement();
        });
        $('.editable').focusin(function(){
            showBtns();  
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
        //editor.setContent('<img src="http://img.inwedding.cn/posts/2015/12/11/BE2F80B8-DF16-FB5E-49E3-10D392705616.jpg/c650"/>');
    })
</script>