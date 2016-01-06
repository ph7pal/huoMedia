<style>
    .module{
        position: relative
    }
    .post-fixed-actions{
        width: 48px;        
        background: #fff;
        top: 100px;
        left: 50%;
        margin-left: 325px;
        position: fixed;
        font-size: 32px;
        border: 1px solid #f8f8f8
    }
    .post-comments .media{
        border-bottom: 1px solid #f8f8f8
    }
    .comment-textarea{
        border:1px solid #f8f8f8;
        box-shadow: none;
        background-color: #f8f8f8;
    }
    .float-share-holder{
        position: absolute;
        left: 0;
        top: 200px;
        background: #fff;
        width: 360px;
        height: 222px;
    }
    .float-share-content{
        width: 340px;
        float: left;
        height: 200px;
        margin: 10px 0 10px 10px;
        border:1px solid #ccc;
        padding: 10px 15px 0 0;
        position: relative
    }
    .float-triangle{
        margin-top: 105px;
        float: right;
        width: 0;
        height: 0;
        border-top: 5px solid transparent;
        border-left: 10px solid #ccc;
        border-bottom: 5px solid transparent;
            
    }
    .float-close{
        position: absolute;
        right: 5px;
        top: 2px;
        cursor: pointer
    }
    .float-close i{
        width: 14px;
        height: 14px;
    }
    .float-close i:hover{
        -webkit-transition: -webkit-transform 250ms;
        transition: transform 250ms;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .float-btns a{
        margin-top: 15px;
        margin-bottom: 6px;
    }
</style>
<?php 
$url=zmf::config('domain').Yii::app()->createUrl('posts/view',array('id'=>$info['id']));
$qrcode=  zmf::qrcode($url, 'posts', $info['id']);
?>
<div class="float-share-holder">
    <div class="float-share-content">
        <span class="float-close"><i class="fa fa-close"></i></span>
        <div class="row">
            <div class="col-xs-6 text-center">
                <img src="<?php echo $qrcode;?>" class="img-responsive"/>
                <p class="help-block">扫码分享到微信</p>
            </div>
            <div class="col-xs-6 float-btns">
                <a href="javascript:;" class="btn btn-default btn-block">分享到微博</a>
                <a href="javascript:;" class="btn btn-default btn-block">分享到QQ</a>
                <a href="javascript:;" class="btn btn-default btn-block">复制链接</a>
            </div>
        </div>
    </div>
    <div class="float-triangle"></div>
</div>
<div class="main-part">
    <div class="module">
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
        <div class="post-fixed-actions text-center">
            <p><?php echo CHtml::link('<i class="fa '.($this->favorited ? 'fa-heart' : 'fa-heart-o').'"></i>','javascript:;',array('action'=>'favorite','action-data'=>$info['id'],'action-type'=>'post','title'=>'点赞'));?></p>
            <p><?php echo CHtml::link('<i class="fa fa-comment-o"></i>','javascript:;',array('action'=>'scroll','action-target'=>'add-comments'));?></p>
            <p><?php echo CHtml::link('<i class="fa fa-qrcode"></i>','javascript:;',array('action'=>'share','action-qrcode'=>$qrcode,'action-url'=>$url,'action-img'=>$qrcode,'action-title'=>$info['title']));?></p>
        </div>
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