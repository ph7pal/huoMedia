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
        <p>评论</p>
    </div>
</div>