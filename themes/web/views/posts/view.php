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
</style>
<div class="main-part">
    <div class="module">
        <h1><?php echo $info['title'];?></h1>
        <div class="post-content">
            <?php echo zmf::text(array(),$info['content']);?>
        </div>
        <div class="tags-container">
            <span><i class="fa fa-tags"></i></span>
            <?php foreach($tags as $tag){?>
            <span><?php echo CHtml::link($tag['title'],array('index/index','tagid'=>$tag['id']));?></span>
            <?php }?>
        </div>
        <div class="post-fixed-actions text-center">
            <p><?php echo CHtml::link('<i class="fa '.($this->favorited ? 'fa-heart' : 'fa-heart-o').'"></i>','javascript:;',array('action'=>'favorite','action-data'=>$info['id'],'action-type'=>'post','title'=>'点赞'));?></p>
            <p><?php echo CHtml::link('<i class="fa fa-comment-o"></i>','javascript:;',array('action'=>'scroll','action-target'=>'add-comments'));?></p>
            <p><i class="fa fa-qrcode" title="分享"></i></p>
        </div>
    </div>
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