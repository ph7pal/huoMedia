<?php

/**
 * @filename more.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-2-25  13:42:44 
 */
?>
<style>
    .con-type-box li.toggle-area{
        display: none
    }
    .con-type-box li a.toggle-btn{
        color: #999
    }
</style>
<div class="container">
    <div class="panel panel-default content">
        <div class="panel-heading">
            <div class="row">
                <div class="col-sm-9">
                    <h3 class="panel-title"><?php echo $title;?></h3>
                </div>
                <div class="col-sm-3">
                    <?php if(!in_array($table,array('forum','video'))){?>
                    <?php $form=$this->beginWidget('CActiveForm', array(
                            'id'=>'search-form',
                            'method'=>'GET',
                    )); ?>
                        <div class="input-group">
                            <input type="text" name="keyword" class="form-control" placeholder="请输入关键词">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="submit">搜索</button>
                            </span>
                        </div>
                    <?php $this->endWidget(); ?>
                    <?php }?>
                </div>
            </div>
        </div>
        <div class="conditions">
            <?php foreach($tags as $_key=>$arr){if(!empty($arr['items'])){?>
            <div class="con-type-item">
                <span class="con-type-title"><?php echo $arr['label'];?></span>
                <ul class="con-type-box">
                    <?php if($table=='site' && $_key=='type'){}else{?>
                    <li class="<?php echo !$_GET[$_key] ? 'active' : '';?>"><?php echo CHtml::link('不限',  Posts::url($_key,''));?></li>
                    <?php }?>
                    <?php foreach($arr['items'] as $_id=>$_tag){?>
                    <li class="<?php echo ($_GET[$_key]==$_tag['id'] ? 'active' : '').($_id>70 ? ' toggle-area':'');?>"><?php echo CHtml::link($_tag['title'],Posts::url($_key,$_tag['id']));?></li>
                    <?php }?>
                    <?php if($_id>70){?>
                    <li><?php echo CHtml::link('展开 <i class="fa fa-angle-double-down"></i>','javascript:;',array('class'=>'toggle-btn'));?></li>
                    <?php }?>
                </ul>
            </div>
            <?php }}?>
        </div>
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'download-form',
                'action'=>  Yii::app()->createUrl('index/download'),
        )); ?>
        <input type="hidden" name="table" value="<?php echo $table;?>"/>
        <input type="hidden" name="download" value="<?php echo $downloadCode;?>"/>
        <?php $this->renderPartial($view, array('posts' => $posts,'from'=>'detail','type'=>$type)); ?>
        <div class="row content-pager">
            <div class="col-sm-9 col-xs-12">
                <?php $this->renderPartial('/common/pager',array('pages'=>$pages));?>
            </div>
            <div class="col-sm-3 col-xs-12">
                <div class="hidden-xs">
                    <div class="btn-group pull-right" role="group">
                        <input id="allcheck" type="button" value="全选" class="btn btn-default btn-sm" onclick="selectAll('selected[]','allcheck');">
                        <button type="submit" class="btn btn-default btn-sm">导出选中到Excel</button>
                    </div>
                </div>
            </div>
        </div>
        <?php $this->endWidget(); ?>
    </div>
</div>
<script>
function selectAll(divc,inputs){
    if($("#"+inputs).attr('value') == '全选'){
            $("input[name='"+divc+"']").attr('checked',true);
            $("#"+inputs).attr('value','取消全选');
    }else{
            $("input[name='"+divc+"']").attr('checked',false);
            $("#"+inputs).attr('value','全选');
    }
}
$(document).ready(function() {        
    $('.toggle-btn').on("click",function () {
        var dom=$(this);
        var _dom=dom.children('.fa');
        var t=0;
        dom.parent('li').parent('.con-type-box').children('.toggle-area').each(function(){
            t+=1;
            $(this).removeClass('toggle-area').addClass('toggle-area-show');
        });
        if(t===0){
            dom.parent('li').parent('.con-type-box').children('.toggle-area-show').each(function(){
                $(this).removeClass('toggle-area-show').addClass('toggle-area');
            });
        }
        if(_dom.hasClass('fa-angle-double-down')){
            _dom.removeClass('fa-angle-double-down').addClass('fa-angle-double-up');
        }else{
            _dom.removeClass('fa-angle-double-up').addClass('fa-angle-double-down');
        }
    });
});
</script>