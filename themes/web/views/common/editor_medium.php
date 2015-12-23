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
$cs->registerScriptFile(Yii::app()->baseUrl . '/medium/js/medium-editor.min.js', CClientScript::POS_END);
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/medium-editor.min.css');
$cs->registerCssFile(Yii::app()->baseUrl . '/medium/css/themes/bootstrap.min.css');
?>
<div class="editable"></div>
<script>
    $("document").ready(function () {
        var editor = new MediumEditor('.editable', {
            autoLink: true,
            imageDragging: true,
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
                    {
                        name: 'upload',
                        action: 'upload',
                        aria: 'upload',
                        tagNames: ['img'],
                        contentDefault: '<b>H1</b>',
                        classList: ['custom-class-h1'],
                        attrs: {
                            'data-custom-attr': 'attr-value-h1'
                        }
                    }
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
            extensions: {
//                upload:function(e){
//                    console.log('heheh');
//                }
            }
        });
    })
</script>