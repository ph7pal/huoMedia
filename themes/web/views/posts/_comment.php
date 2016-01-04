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
        <p><?php echo $data['content']; ?></p>
        <p class="color-grey"><?php echo zmf::formatTime($data['cTime']); ?></p>
    </div>
</div>