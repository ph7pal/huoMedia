<?php
/**
 * @filename _comment.php 
 * @Description
 * @author 阿年飞少 <ph7pal@qq.com> 
 * @link http://www.newsoul.cn 
 * @copyright Copyright©2015 阿年飞少 
 * @datetime 2016-1-4  17:16:29 
 */
?>
<?php //$_uname=Users::getUserInfo($data['uid'],'truename'); ?>
<div class="media" id="comment_<?php echo $data['id']; ?>">   
    <div class="media-body">
        <p><b>用户</b></p>
        <p><?php echo $data['content']; ?></p>
        <p class="help-block">
            <?php echo zmf::formatTime($data['cTime']); ?>
            <span class="pull-right">
                <?php echo CHtml::link('回复','javascript:;',array('onclick'=>"replyOne('".$data['id']."','".$data['logid']."','网页')"));?>                
                <?php if($this->uid==$postInfo['uid']){echo CHtml::link('删除','javascript:;',array('onclick'=>''));}?>                
            </span>
        </p>
    </div>
</div>