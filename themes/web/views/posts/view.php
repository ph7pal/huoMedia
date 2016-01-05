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
        <div class="post-fixed-actions text-center">
            <p><i class="fa fa-heart-o" data-toggle="tooltip" data-placement="right" title="点赞"></i></p>
            <p><i class="fa fa-comment-o" data-toggle="tooltip" data-placement="right" title="评论"></i></p>
            <p><i class="fa fa-qrcode" data-toggle="tooltip" data-placement="right" title="分享"></i></p>
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
        <?php $this->renderPartial('/posts/_addComment', array('keyid' => $info['id'], 'type' => 'posts')); ?>
    </div>
</div>