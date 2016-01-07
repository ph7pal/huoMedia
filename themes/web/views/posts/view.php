<?php 
$url=zmf::config('domain').Yii::app()->createUrl('posts/view',array('id'=>$info['id']));
$qrcode=  zmf::qrcode($url, 'posts', $info['id']);
?>
<div class="main-part">
    <div class="module">
        <div class="post-fixed-actions text-center">
            <p><?php echo CHtml::link('<i class="fa '.($this->favorited ? 'fa-heart' : 'fa-heart-o').'"></i>','javascript:;',array('action'=>'favorite','action-data'=>$info['id'],'action-type'=>'post','title'=>'点赞'));?></p>
            <p><?php echo CHtml::link('<i class="fa fa-comment-o"></i>','javascript:;',array('action'=>'scroll','action-target'=>'add-comments'));?></p>
            <p><?php echo CHtml::link('<i class="fa fa-qrcode"></i>','javascript:;',array('action'=>'share','action-qrcode'=>$qrcode,'action-url'=>$url,'action-img'=>$qrcode,'action-title'=>$info['title']));?></p>
        </div>
        <h1><?php echo $info['title'];?></h1>
        <div class="post-content">
            <?php echo zmf::text(array(),$info['content']);?>
        </div>
        <?php if(!empty($tags)){?>
        <div class="tags-container">
            <span><i class="fa fa-tags"></i></span>
            <?php foreach($tags as $tag){?>
            <span><?php echo CHtml::link($tag['title'],array('index/index','tagid'=>$tag['id']));?></span>
            <?php }?>
        </div>
        <?php }?>        
    </div>
    <?php if($info['lat']!='' && $info['long']!='' && $info['lat']!='0' && $info['long']!='0'){?>
    <div class="module">
        <p>
            <img data-original="http://ditu.google.cn/maps/api/staticmap?center=<?php echo $info['lat'];?>,<?php echo $info['long'];?>&amp;zoom=<?php echo $info['mapZoom'];?>&amp;size=600x371&amp;markers=color:red%7Clabel:A%7C<?php echo $info['lat'];?>,<?php echo $info['long'];?>&amp;sensor=false&amp;key=AIzaSyDcT5ZLTs6jrOa2zkDcERh0ijiOvMA-l5o" class="lazy" src="http://ditu.google.cn/maps/api/staticmap?center=<?php echo $info['lat'];?>,<?php echo $info['long'];?>&amp;zoom=<?php echo $info['mapZoom'];?>&amp;size=600x371&amp;markers=color:red%7Clabel:A%7C<?php echo $info['lat'];?>,<?php echo $info['long'];?>&amp;sensor=false&amp;key=AIzaSyDcT5ZLTs6jrOa2zkDcERh0ijiOvMA-l5o" alt="<?php echo $info['title'];?>">
        </p>
    </div>
    <?php }?>
    <div class="module">
        <p>相关文章</p>
    </div>
    <div class="module">
        <div id="comments-posts-<?php echo $info['id'];?>-box" class="post-comments">
            <div id="comments-posts-<?php echo $info['id'];?>">
                <?php if(!empty($comments)){?>
                <?php foreach($comments as $comment){?>
                <?php $this->renderPartial('/posts/_comment',array('data'=>$comment));?>
                <?php }?>
                <?php }else{?>
                <p class="help-block text-center">暂无评论！</p>
                <?php }?>
            </div>
            <?php if($loadMore){?>
            <div class="loading-holder"><a class="btn btn-default btn-block" action="get-contents" action-data="<?php echo $info['id'];?>" action-type="comments" action-target="comments-posts-<?php echo $info['id'];?>" href="javascript:;" action-page="2">加载更多</a></div>
            <?php }?>
        </div>
        <div style="margin-top: 15px"></div>
        <div id="add-comments">
        <?php $this->renderPartial('/posts/_addComment', array('keyid' => $info['id'], 'type' => 'posts')); ?>
        </div>
    </div>
</div>