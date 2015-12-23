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
$cs->registerScriptFile(Yii::app()->baseUrl . '/medium/js/medium-editor.min.js', CClientScript::POS_END);
//$cs->registerScriptFile(Yii::app()->baseUrl . '/medium/ext/dist/js/medium-editor-insert-plugin.min.js', CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/medium-editor.min.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/themes/bootstrap.min.css');
?>
<div class="editable"></div>
<script>
    function ajaxFileUpload() {
        $.ajaxFileUpload({
            url: '<?php echo Yii::app()->createUrl('attachments/upload', array()); ?>',
            fileElementId: 'upload-file',
            type: 'post',
            multi:true,
            data: {'PHPSESSID': '<?php echo Yii::app()->session->sessionID; ?>', 'YII_CSRF_TOKEN': '<?php echo Yii::app()->request->csrfToken; ?>'},
            dataType: 'json',
            success: function (res) {

            }
        })
    }
    $("document").ready(function () {
        var HighlighterButton = MediumEditor.Extension.extend({
            name: 'highlighter',
            init: function () {
                this.button = this.document.createElement('button');
                this.button.classList.add('medium-editor-action');
                this.button.innerHTML = '<div style="position:relative"><i class="fa fa-image"></i><input type="file" name="upload-file" id="upload-file" style="opacity: 0; position: absolute; top: 0px; left: 0px; width: 60px; height: 60px;" onchange="ajaxFileUpload()"></div>';
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
    })
</script>